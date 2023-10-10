<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DataTypesTableSeeder::class,
            DataRowsTableSeeder::class,
            MenusTableSeeder::class,
            MenuItemsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            /*  PostsTableSeeder::class,
            PagesTableSeeder::class, */
            // TranslationsTableSeeder::class,
            RestaurantsTableSeeder::class,
            MenuCategoryTableSeeder::class,
            MealTableSeeder::class,

        ]);
    }
}
