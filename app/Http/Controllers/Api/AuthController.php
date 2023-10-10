<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:sanctum", ['except' => ["register", "login"]]);
    }
    public function register(Request $request)
    {
        $request->validate([
            "name" => 'required|string',
            "email" => 'required|unique:users,email',
            "password" => 'required|string|confirmed',
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);
        // Get the user again with all attributes
        $user = User::find($user->id);

        //define the default avatar
        $user->avatar = "avatars/avatar_default.jpg";
        // Create a token for the user
        $token = $user->createToken("token_name")->plainTextToken;

        return response()->json([
            "sucess" => true,
            "user" => $user,
            "token" => $token,

        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(["success" => true, "message" => "Logged Out"]);
    }

    public function login(Request $request)
    {
        $request->validate([
            "name" => "required",
            "password" => "required",
        ]);

        if (!Auth::attempt($request->only('name', 'password'))) {
            return response()->json(["success" => false, "message" => "Invalid Credential"]);
        }

        $user = User::where("name", $request["name"])->first();
        $token = $user->createToken("token-name")->plainTextToken;

        return response()->json(["success" => true, "user" => $user, "token" => $token]);
    }
}
