<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'country_code', 'latitude', 'longitude'];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function forecasts()
    {
        return $this->hasMany(WeatherForecast::class);
    }
}
