<?php

namespace App\Http\Controllers;

use App\Services\OpenWeatherApi\Request\Contracts\OpenWeatherApiGeoLocationInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityWeatherController extends Controller
{
    public function __construct(
        private OpenWeatherApiGeoLocationInterface $apiGeoLocation
    ) {
    }

    public function index(Request $request, string $cityNames): Response
    {
        $geoLocation = $this->apiGeoLocation->getCityByGeoLocation($cityNames);

        dd(json_decode($geoLocation->getBody()));
        return new Response();
    }
}
