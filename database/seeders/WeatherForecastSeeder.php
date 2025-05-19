<?php

namespace Database\Seeders;

use App\Models\WeatherForecast;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeatherForecastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WeatherForecast::factory(200)->create();
    }
}
