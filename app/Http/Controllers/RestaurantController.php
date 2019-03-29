<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    //

    public function search() {
        $search_query = request()->search;

        $query = Restaurant::query();

        if (isset($search_query)) {
            $result = $query->with('speciality', 'category', 'sale')->where('name', 'LIKE', "%{$search_query}%")->get();
            if ($result->count() > 0) {
                return response()->json([
                    'status' => 'success',
                    'query' => 'subset',
                    'data' => $result
                ]);
            } else {
                return response()->json([
                    'status' => 'success',
                    'query' => 'all',
                    'data' => Restaurant::with('speciality', 'category', 'sale')->get()
                ]);
            }
        }

        return response()->json([
            'status' => 'error',
            'data' => []
        ]);
    }
}
