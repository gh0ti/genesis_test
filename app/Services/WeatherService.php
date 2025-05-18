<?php

namespace App\Services;

use App\Models\City;
use App\Models\User;

class WeatherService {
    protected $fillable = ['user_id', 'city_id', 'frequency', 'is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
