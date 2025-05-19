<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeatherForecast>
 */
class WeatherForecastFactory extends Factory {
    public function definition() {
        $cityId = City::query()->inRandomOrder()->value('id');

        if (!$cityId) {
            $cityId = City::factory()->create()->id;
        }

        return [
            'city_id' => $cityId,
            'datetime' => $this->faker->dateTime(),
            'temperature' => $this->faker->randomFloat(2, -30, 50),
            'humidity' => $this->faker->randomFloat(2, 0, 100),
            'description' => $this->faker->sentence(),
        ];
    }
}
