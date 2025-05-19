<?php

use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

Route::post('/subscribe', [SubscriptionController::class, 'subscribe']);
Route::get('/confirm/{confirmationToken}', [SubscriptionController::class, 'confirm']);
Route::get('/unsubscribe/{unsubscribeToken}', [SubscriptionController::class, 'subscribe']);

Route::get('/weather', [WeatherController::class, 'getWeather']);
