<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            ['category' => 'Fast Food'],
            ['category' => 'Deli'],
            ['category' => 'Bakery'],
            ['category' => 'Fine Dining'],
            ['category' => 'Budget Pack'],
            ['category' => 'Korean'],
            ['category' => 'Chinese'],
            ['category' => 'Italian'],
            ['category' => 'Resto Bar'],
        ];
        foreach ($data as $datum) {
            DB::table('restaurant_categories')->insert([
                'category' => $datum['category'],
            ]);
        }
    }
}
