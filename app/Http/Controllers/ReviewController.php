<?php

namespace App\Http\Controllers;

use App\Events\ReviewAddedEvent;
use App\Models\Review;
use App\Models\User;
use App\Notifications\addReviewNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1); // Get the page number, default to 1.
        $limit = $request->input('limit', 10); // Get the number of records per page, default to 10.

        // Calculate the offset based on the page and limit
        $offset = ($page - 1) * $limit;
        // Get the restaurant_id from the request
        $restaurantId = $request->input('restaurant_id');

        // Query reviews with pagination and optional restaurant_id filter
        $query = Review::with(['restaurant', 'user'])
            ->when($restaurantId, function ($query) use ($restaurantId) {
                return $query->where('restaurant_id', $restaurantId);
            })
            ->orderBy('created_at', 'desc')
            ->skip($offset)
            ->take($limit);

        // Fetch reviews
        $reviews = $query->get();
        return response()->json([$reviews], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'restaurant_id' => 'required',
            'caption' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5',
        ]);

        // Get the authenticated user's ID
        $user_id = auth()->user()->id;

        if ($user_id === null) {
            return response()->json(['error' => 'User ID not available'], 400);
        }
        $reviewd_by = User::findOrFail($user_id);
        // Create a new review
        $review = Review::create([
            'restaurant_id' => $validatedData['restaurant_id'],
            'user_id' => $user_id,
            'caption' => $validatedData['caption'],
            'rating' => $validatedData['rating'],
        ]);

        event(new ReviewAddedEvent($review));

        echo $reviewd_by->followers;
        // Notify the followers of the user
        foreach ($reviewd_by->followers as $follower) {
            // Check if $follower is not null before calling notify
            if ($follower) {
                $follower->notify(new AddReviewNotification($review));
            }
        }
        // Notify the users who liked the restaurant
        $likedUsers = $review->restaurant->likes->pluck('user');

        foreach ($likedUsers as $likedUser) {
            if ($likedUser) {
                $likedUser->notify(new AddReviewNotification($review));
            }
        }

        return ['review' =>  $review->load('user')];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reviews = Review::findOrFail($id);
        $reviews->update($request->all());
        return response()->json(['message' => 'review updated successfully', 'reviews' => $reviews], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return response()->json(['message' => 'review deleted successfully'], 204);
    }
}
