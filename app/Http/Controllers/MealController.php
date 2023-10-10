<?php

namespace App\Http\Controllers;

use App\Events\MealAddedEvent;
use App\Models\Meal;
use App\Models\MenuCategory;
use App\Models\User;
use App\Notifications\MealAddedNotification;
use Illuminate\Http\Request;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meals = Meal::all();
        return response()->json(["success" => true, "meals" => $meals], 200);
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
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'rating' => 'required|numeric',
            'url' => 'nullable|string',
            'menu_category_id' => 'required|exists:menu_categories,id',

        ]);

        $meal = Meal::create($request->all());
        // Dispatch the event for adding a new meal
        event(new MealAddedEvent($meal));

        // Notify users about the new meal

        $restaurant = $meal->menuCategory->restaurant;
        foreach ($restaurant->likes as $follower) {
            $follower->notify(new MealAddedNotification($meal));
        }




        return response()->json(["success" => true, "meal" => $meal], 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meal = Meal::findOrFail($id);
        return response()->json(["success" => true, "meal" => $meal], 200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function edit(Meal $meal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'string',
            'description' => 'string',
            'price' => 'numeric',
            'rating' => 'numeric',
            'url' => 'nullable|string',
            'menu_category_id' => 'exists:menu_categories,id',
        ]);

        $meal = Meal::findOrFail($id);
        $meal->update($request->all());

        return response()->json(["success" => true, "meal" => $meal], 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meal = Meal::findOrFail($id);
        $meal->delete();

        return response()->json(["success" => true, "message" => "Meal deleted successfully"], 200);
    }
}
