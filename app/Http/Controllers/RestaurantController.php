<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::with(['reviews.user', 'menuCategories.meals', 'likes'])->get();
        return response()->json(["success" => true, "restaurants" => $restaurants], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'streetAddress' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'cuisineType' => 'required|in:Italian,Mexican,Chinese,Japanese,Indian,French,American,Spanish,Thai,Greek,Other',
            'rating' => 'required|numeric|min:0|max:5',
            'startWorkingTime' => 'required|date_format:H:i:s',
            'finishWorkingTime' => 'required|date_format:H:i:s',
            'imageUrl' => 'nullable|string|max:255',
            'logoUrl' => 'nullable|string|max:255',
        ]);
        // Create a new restaurant using the validated data
        $restaurant = Restaurant::create($validatedData);

        return response()->json(['message' => 'Restaurant created successfully', 'restaurant' => $restaurant], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $restaurant = Restaurant::with(['reviews.user', 'menuCategories.meals', 'likes'])->find($id);
        if ($restaurant) {
            $restaurant->reviews = $restaurant->reviews()->orderBy('created_at', 'desc')->get();
        }
        return response()->json(["success" => true, "restaurant" => $restaurant], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update($request->all());
        return response()->json(['message' => 'Restaurant updated successfully', 'restaurant' => $restaurant], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();
        return response()->json(['message' => 'Restaurant deleted successfully'], 204);
    }


    public function likeRestaurant(Request $request, $restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        $userId = $request->user()->id;
        if (!$restaurant->likes()->where('restaurant_id', $restaurantId)->where('user_id', $userId)->exists()) {

            $restaurant->likes()->attach($userId);
            //  $restaurant->likes()->create(['restaurant_id' => $restaurantId]);
            return response()->json(['message' => 'Restaurant liked successfully']);
        }

        return response()->json(['message' => 'Restaurant is already liked']);
    }

    public function unlikeRestaurant(Request $request, $restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);


        if ($request->user()->likes()->where('restaurant_id', $restaurantId)->exists()) {
            $request->user()->likes()->where('restaurant_id', $restaurantId)->delete();
            return response()->json(['message' => 'Restaurant unliked successfully']);
        }

        return response()->json(['message' => 'Restaurant is not liked']);
    }

    public function saveRestaurant(Request $request, $restaurantId)
    {

        // Check if the authenticated user has not already liked
        if (!$request->user()->saves()->where('restaurant_id', $restaurantId)->exists()) {
            $request->user()->saves()->create(['restaurant_id' => $restaurantId]);
            return response()->json(['message' => 'Restaurant saved successfully']);
        }

        return response()->json(['message' => 'Restaurant is already saved']);
    }

    public function unsaveRestaurant(Request $request, $restaurantId)
    {

        if ($request->user()->saves()->where('restaurant_id', $restaurantId)->exists()) {
            $request->user()->saves()->where('restaurant_id', $restaurantId)->delete();
            return response()->json(['message' => 'Restaurant unsaved successfully']);
        }

        return response()->json(['message' => 'Restaurant is not saved']);
    }
}
