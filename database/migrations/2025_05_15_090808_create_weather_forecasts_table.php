<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weather_forecasts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('city_id')->constrained()->onDelete('cascade');
                $table->timestamp('forecast_time');
                $table->decimal('temperature', 5, 2);
                $table->decimal('feels_like', 5, 2);
                $table->decimal('humidity', 5, 2);
                $table->decimal('wind_speed', 5, 2);
                $table->string('description');
                $table->timestamps();

                $table->unique(['city_id', 'forecast_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_forecasts');
    }
};
