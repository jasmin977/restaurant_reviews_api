<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = [
            [

                'name' => 'Le Petit Bistro',
                'streetAddress' => 'Rue de la Liberté',
                'city' => 'Tunis',
                'state' => 'Tunisia',
                'cuisineType' => 'Italian',
                'rating' => 4.5,
                'startWorkingTime' => '09:00:00',
                'finishWorkingTime' => '21:00:00',
                'imageUrl' => 'restaurants/cover/_1.jpg',
                'logoUrl' => 'restaurants/logo/logo_1.jpg',
                'tage' => 'Cozy,Bistro,Delightful',
                'latitude' => 36.801383,
                'longitude' => 10.179355,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'name' => 'Maison des Saveurs',
                'streetAddress' => 'Avenue Habib Bourguiba',
                'city' => 'Tunis',
                'state' => 'Tunisia',
                'cuisineType' => 'Italian',
                'rating' => 3.5,
                'startWorkingTime' => '09:00:00',
                'finishWorkingTime' => '21:00:00',
                'imageUrl' => 'restaurants/cover/_2.jpg',
                'logoUrl' => 'restaurants/logo/logo_2.jpg',
                'tage' => 'Gastronomic Journey, Wide Range',

                'latitude' => 35.829114,
                'longitude' => 10.641634,

                'created_at' => now(),
                'updated_at' => now(),

            ],
            [

                'name' => "Le Jardin Enchanté",
                'streetAddress' => 'Rue du Lac',
                'city' => 'Tunis',
                'state' => 'Tunisia',
                'cuisineType' => 'Mexican',
                'rating' => 4.9,
                'startWorkingTime' => '12:00:00',
                'finishWorkingTime' => '23:00:00',
                'imageUrl' => 'restaurants/cover/_3.jpg',
                'logoUrl' => 'restaurants/logo/logo_3.jpg',
                'tage' => 'Magical,Exquisite Cuisine',

                'latitude' => 36.848433,
                'longitude' => 10.237551,

                'created_at' => now(),
                'updated_at' => now(),

            ],
            [

                'name' => "L'Oasis Bleue",
                'streetAddress' => "Boulevard de l'Environnement",
                'city' => 'Hammamet',
                'state' => 'Tunisia',
                'cuisineType' => 'French',
                'rating' => 2.7,
                'startWorkingTime' => '10:00:00',
                'finishWorkingTime' => '22:00:00',
                'imageUrl' => 'restaurants/cover/_4.jpg',
                'logoUrl' => 'restaurants/logo/logo_4.jpg',
                'tage' => 'Tranquil ,International,Local Dishes',

                'latitude' => 36.40066,
                'longitude' => 10.614416,

                'created_at' => now(),
                'updated_at' => now(),

            ],
            [

                'name' => 'Maison des Saveurs',
                'streetAddress' => 'Avenue Habib Bourguiba',
                'city' => 'Tunis',
                'state' => 'Tunisia',
                'cuisineType' => 'Italian',
                'rating' => 3.5,
                'startWorkingTime' => '11:00:00',
                'finishWorkingTime' => '23:00:00',
                'imageUrl' => 'restaurants/cover/_5.jpg',
                'logoUrl' => 'restaurants/logo/logo_5.jpg',
                'tage' => 'Snacks ,Drinks, Relaxed, Delicious',

                'latitude' => 36.796448,
                'longitude' => 10.18153,

                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('restaurants')->insert($restaurants);

        // You can add more data rows as needed
    }
}
