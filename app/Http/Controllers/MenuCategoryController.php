<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuCategories = MenuCategory::all();
        return response()->json(["success" => true, "menuCategories" => $menuCategories], 200);
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
            'category' => 'required|string',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);

        $menuCategory = MenuCategory::create($request->all());

        return response()->json(["success" => true, "menuCategory" => $menuCategory], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MenuCategory  $menucategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menuCategory = MenuCategory::findOrFail($id);
        return response()->json(["success" => true, "menuCategory" => $menuCategory], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MenuCategory  $menucategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuCategory $menucategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MenuCategory  $menucategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category' => 'string',
            'restaurant_id' => 'exists:restaurants,id',
        ]);

        $menuCategory = MenuCategory::findOrFail($id);
        $menuCategory->update($request->all());

        return response()->json(["success" => true, "menuCategory" => $menuCategory], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuCategory  $menucategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menuCategory = MenuCategory::findOrFail($id);
        $menuCategory->delete();

        return response()->json(["success" => true, "message" => "Menu category deleted successfully"], 200);
    }
}
