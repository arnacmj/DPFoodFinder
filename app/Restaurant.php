<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //
    #relation
    public function speciality() {
        return $this->hasOne(RestaurantSpeciality::class, 'id', 'restaurant_speciality_id');
    }

    public function category() {
        return $this->hasOne(RestaurantCategory::class, 'id', 'restaurant_category_id');
    }

    public function sale() {
        return $this->hasOne(RestaurantSale::class, 'restaurant_id', 'id');
    }
}
