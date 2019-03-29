<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $sales = [
            ['res_id' => 1, 'daily' => 20000.00, 'monthly' => 222000.00],
            ['res_id' => 2, 'daily' => 22200.00, 'monthly' => 642000.00],
            ['res_id' => 3, 'daily' => 23100.00, 'monthly' => 322000.00],
            ['res_id' => 4, 'daily' => 40000.00, 'monthly' => 822000.00],
            ['res_id' => 5, 'daily' => 30000.00, 'monthly' => 922000.00],
            ['res_id' => 6, 'daily' => 60000.00, 'monthly' => 622000.00],
            ['res_id' => 7, 'daily' => 80000.00, 'monthly' => 722000.00],
            ['res_id' => 8, 'daily' => 10000.00, 'monthly' => 322000.00],
            ['res_id' => 9, 'daily' => 50000.00, 'monthly' => 522000.00],
            ['res_id' => 10, 'daily' => 15010.00, 'monthly' => 122200.00]
        ];
        foreach ($sales as $sale) {
            DB::table('restaurant_sales')->insert([
                'restaurant_id' => $sale['res_id'],
                'total_daily_sales' => $sale['daily'],
                'total_monthly_sales' => $sale['monthly'],
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d h:m:s'),
                'updated_at' =>  \Carbon\Carbon::now()->format('Y-m-d h:m:s'),
            ]);
        }
    }
}
