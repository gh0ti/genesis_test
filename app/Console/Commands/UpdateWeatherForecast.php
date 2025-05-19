<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateWeatherForecast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-weather-forecast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update weather forecasts for all cities';

    /**
     * Execute the console command.
     */
    public function handle(WeatherService $weatherService)
    {
        $cities = City::all();

        foreach ($cities as $city) {
            $this->info("Updating forecast for {$city->name}");
            $result = $weatherService->updateForecast($city);

            if ($result) {
                $this->info("Forecast updated successfully");
            } else {
                $this->error("Failed to update forecast");
            }
        }

        return Command::SUCCESS;
    }
}
