<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\WeatherForecast;
use Illuminate\Http\Request;

class WeatherController extends Controller {
    public function getWeather(Request $request): string {
        $cityName = $request->input('city');

        $city = City::where('name', $cityName)->first();
        if (!$city) {
            return response()->json('City not found', 404);
        }

        $forecast = WeatherForecast::query()->where('city_id', $city->id)->latest('datetime')->first();

        if (!$forecast) {
            return response()->json('Weather forecast not found', 404);
        }

        return response()->json([
            'temperature' => $forecast->temperature,
            'humidity' => $forecast->humidity,
            'description' => $forecast->description,
        ], 200);
    }
}
