<?php

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
        // $this->call(UsersTableSeeder::class);
        foreach (['restaurants', 'restaurant_specialities', 'restaurant_categories', 'restaurant_sales'] as $table) {
            \Illuminate\Support\Facades\DB::table($table)->truncate();
        }
        $this->call([
            RestaurantSeeder::class,
            RestaurantSpecialitySeeder::class,
            RestaurantCategorySeeder::class,
            RestaurantSaleSeeder::class,
        ]);
    }
}
