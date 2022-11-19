<?php

use App\Http\Controllers\CityWeatherController;
use Illuminate\Support\Facades\Route;


Route::get('/weather-for-city/{cityName}', [CityWeatherController::class, 'index'] );

