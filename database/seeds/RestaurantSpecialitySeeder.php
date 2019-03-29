<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSpecialitySeeder extends Seeder
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
            ['speciality' => 'Bulalo'],
            ['speciality' => 'Lechon Kawali'],
            ['speciality' => 'Pancit Malabon'],
            ['speciality' => 'Spicy Ribs'],
            ['speciality' => 'Bihon Guisado'],
            ['speciality' => 'Adobo'],
            ['speciality' => 'Korean Bibimbap'],
            ['speciality' => 'Letchon'],
            ['speciality' => 'Batchoy'],
            ['speciality' => 'Marinated Grilled Tuna'],
        ];
        foreach ($data as $datum) {
            DB::table('restaurant_specialities')->insert([
                'speciality' => $datum['speciality'],
            ]);
        }
    }
}
