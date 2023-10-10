<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserFollowed;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 2)->with(['followers', 'followings', 'likes'])->get();
        return response()->json(["success" => true, "users" => $users], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Check if the request contains an 'avatar' field
        if ($request->has('avatar')) {
            // Update the 'avatar' field with the new value
            $user->avatar = $request->input('avatar');
        }

        // Update other fields if needed
        $user->update($request->except('avatar'));

        return response()->json(["success" => true, "user" => $user], 200);
    }

    public function show($id)
    {
        $user = User::with([
            'followers', 'followings', 'likes',
            'reviews' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }, 'reviews.user', 'reviews.restaurant'
        ])->findOrFail($id);

        // Assume $loggedInUserId represents the ID of the currently authenticated user
        $loggedInUserId = auth()->user()->id ?? null;

        if ($loggedInUserId) {
            // Check if the currently authenticated user is following the user with $id
            $isFollowing = $user->followers->contains($loggedInUserId);
        } else {
            // If not authenticated, set isFollowing to false
            $isFollowing = false;
        }

        // Add the isFollowing attribute to the response
        $user->setAttribute('isFollowing', $isFollowing);

        return response()->json(["success" => true, "user" => $user], 200);
    }

    public function followUser(Request $request, $userId)
    {
        $userToFollow = User::findOrFail($userId);

        // Check if the authenticated user is not already following
        if (!$request->user()->followings()->where('following_id', $userId)->exists()) {
            $request->user()->followings()->attach($userToFollow);

            // Notify the user being followed
            $userToFollow->notify(new UserFollowed($request->user()));
            //the loggedIN user id is gonna be onthe other user who being followed


            return response()->json(['message' => 'User followed successfully', "user" => $userToFollow]);
        }

        return response()->json(['message' => 'User is already being followed']);
    }

    public function unfollowUser(Request $request, $userId)
    {
        $userToUnfollow = User::findOrFail($userId);

        // Check if the authenticated user is following
        if ($request->user()->followings()->where('following_id', $userId)->exists()) {
            $request->user()->followings()->detach($userToUnfollow);
            return response()->json(['message' => 'User unfollowed successfully', "user" => $userToUnfollow]);
        }

        return response()->json(['message' => 'User is not being followed']);
    }
}
