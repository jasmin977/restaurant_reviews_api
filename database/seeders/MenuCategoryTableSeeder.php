<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define restaurant-specific menu categories
        $menuCategories = [
            [

                'restaurant_id' => 1,
                'categories' => ['Burgers', 'Pizzas', 'Desserts', 'Salads', 'Breakfast', 'Seafood'],
            ],
            [

                'restaurant_id' => 2,
                'categories' => ['Burgers', 'Pizzas', 'Desserts', 'Salads', 'Breakfast', 'Seafood'],
            ],
            [

                'restaurant_id' => 3,
                'categories' => ['Burgers', 'Pizzas', 'Desserts', 'Salads', 'Breakfast', 'Seafood'],
            ],
            [

                'restaurant_id' => 4,
                'categories' => ['Burgers', 'Pizzas', 'Desserts', 'Salads', 'Breakfast', 'Seafood'],
            ],
            [

                'restaurant_id' => 5,
                'categories' => ['Burgers', 'Pizzas', 'Desserts', 'Salads', 'Breakfast', 'Seafood'],
            ],

        ];

        // Seed menu categories for each restaurant
        foreach ($menuCategories as $menuCategoryData) {
            $restaurantId = $menuCategoryData['restaurant_id'];
            $categories = $menuCategoryData['categories'];

            foreach ($categories as $category) {
                DB::table('menu_categories')->insert([
                    //  'id' => Str::uuid(),
                    'category' => $category,
                    'restaurant_id' => $restaurantId,
                ]);
            }
        }
    }
}
