<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meals = [
            [
                //'id' => Str::uuid(),
                'id' => 1,
                'name' => 'Classic Burger',
                'description' => 'Juicy beef patty with lettuce, tomato, and cheese',
                'price' => 10.99,
                'rating' => 4.5,
                'url' => 'meals/burger1.jpg',
                'menu_category_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Vegetarian Burger',
                'description' => 'Grilled vegetable patty with avocado and sprouts',
                'price' => 12.99,
                'rating' => 4.2,
                'url' => 'meals/burger2.jpg',
                'menu_category_id' => 1,
            ]
        ];
        // Insert the meal data into the meals table
        DB::table('meals')->insert($meals);
    }
}
