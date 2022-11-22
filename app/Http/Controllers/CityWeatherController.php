<?php

namespace App\Http\Controllers;

use App\Services\OpenWeatherApi\Persist\PersistOpenWeatherGeoLocation;
use App\Services\OpenWeatherApi\Persist\PersistOpenWeatherResult;
use App\Services\OpenWeatherApi\Request\Contracts\OpenWeatherApiGeoLocationInterface;
use App\Services\OpenWeatherApi\Request\Contracts\OpenWeatherApiInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityWeatherController extends Controller
{
    public function __construct(
        private OpenWeatherApiGeoLocationInterface $apiGeoLocation,
        private OpenWeatherApiInterface $openWeatherApi
    ) {
    }

    public function index(Request $request, string $cityNames): Response
    {
        $geoLocationPayload = $this->apiGeoLocation->getCityByGeoLocation($cityNames);
        $storedGeoLocations = (new PersistOpenWeatherGeoLocation())->persist($geoLocationPayload);
        $weatherForecast = $this->openWeatherApi->getWeatherForCity($storedGeoLocations);
        $weatherForCities = (new PersistOpenWeatherResult())->persist($weatherForecast);

        $data =  $weatherForCities->map(function ($weather) {
            return [
                'city' => $weather->city->city,
                'weather' => $weather->main,
                'weather_description' => $weather->description,
                'weather_icon' => $weather->icon,
                'date_of_forecast' => $weather->date_time_weather_calculated,
            ];
        })->toJson();

        return new Response($data);
    }
}
