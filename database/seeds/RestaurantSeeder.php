<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $restaurantList = [
            ['name' => "Bon Appetit Restaurant", 'address' => 'Plaza Del Carmen, Poblacion District, Davao City, 8000 Davao del Sur', 'latitude' => 7.0826, 'longitude' => 125.6136, 'speciality' => 1, 'category' => 1],
            ['name' => "Kaizen Davao Japanese Street Dining", 'address' => 'Poblacion, Dabaw, 8000 Lalawigan ng Davao del Sur', 'latitude' => 7.0827, 'longitude' => 125.6115, 'speciality' => 2, 'category' => 2],
            ['name' => "Yellow Fin", 'address' => 'Prime Square II, F. Torres St, Poblacion, Dabaw, 8000 Lalawigan ng Davao del Sur', 'latitude' => 7.0815944, 'longitude' => 125.6112534, 'speciality' => 3, 'category' => 3],
            ['name' => "Nonki Japanese Restaurant", 'address' => 'AutoVille Building, F. Torres St, Poblacion District, Davao City, 8000 Davao del Sur', 'latitude' => 7.0817, 'longitude' => 125.6102, 'speciality' => 4, 'category' => 4],
            ['name' => "Tiny Kitchen & Dulce Vida", 'address' => 'F. Torres St, Poblacion District, Davao City, Davao del Sur', 'latitude' => 7.0811, 'longitude' => 125.6097, 'speciality' => 5, 'category' => 5],
            ['name' => "DIMYUM SEAFOOD RESTAURANT", 'address' => 'Door 5, Belles Apartment, P. Sobrecarey St, Poblacion District, Davao City, 8000 Davao del Sur', 'latitude' => 7.0827, 'longitude' => 125.6144, 'speciality' => 6, 'category' => 6],
            ['name' => "Ahfat Sea Foods Plaza", 'address' => '3 Km 7, Poblacion District, Davao City, 8000 Davao del Sur', 'latitude' => 7.0884, 'longitude' => 125.6127, 'speciality' => 7, 'category' => 7],
            ['name' => "Davao Dencia Restaurant", 'address' => 'General Luna St, Poblacion District, Davao City, Davao del Sur', 'latitude' => 7.0699, 'longitude' => 125.6069, 'speciality' => 8, 'category' => 8],
            ['name' => "Bondi&Bourke Davao", 'address' => '115 P Pelayo St, Poblacion District, Davao City, 8000 Davao del Sur', 'latitude' => 7.0680, 'longitude' => 125.6062, 'speciality' => 9, 'category' => 9],
            ['name' => "Placas BarBQ", 'address' => 'Nidea St, Obrero, Davao City, Davao del Sur', 'latitude' => 7.0836207, 'longitude' => 125.6154713, 'speciality' => 10, 'category' => 10]
        ];
        foreach ($restaurantList as $restaurant) {
            DB::table('restaurants')->insert([
                'name' => $restaurant['name'],
                'address' => $restaurant['address'],
                'latitude' => $restaurant['latitude'],
                'longitude' => $restaurant['longitude'],
                'restaurant_speciality_id' => $restaurant['speciality'],
                'restaurant_category_id' => $restaurant['category']
            ]);
        }

    }
}
