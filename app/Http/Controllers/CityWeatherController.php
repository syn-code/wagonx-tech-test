<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\Contracts\DTOMappingInterface;
use App\Services\OpenWeatherApi\Persist\PersistOpenWeatherGeoLocation;
use App\Services\OpenWeatherApi\Request\Contracts\OpenWeatherApiGeoLocationInterface;
use App\Services\OpenWeatherApi\Request\Contracts\OpenWeatherApiInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityWeatherController extends Controller
{
    public function __construct(
        private OpenWeatherApiGeoLocationInterface $apiGeoLocation,
        private DTOMappingInterface $mapper,
        private OpenWeatherApiInterface $openWeatherApi
    ) {
    }

    public function index(Request $request, string $cityNames): Response
    {
        $geoLocationPayload = $this->apiGeoLocation->getCityByGeoLocation($cityNames);
        //need to open the search a lot wider
        $geoLocation = $this->mapper->map($geoLocationPayload);
        $persistedGeoLocation = (new PersistOpenWeatherGeoLocation())->persist($geoLocation);
        //
        $getWeatherForecast = $this->openWeatherApi->getWeatherForCity(
            $persistedGeoLocation->lat,
            $persistedGeoLocation->lon
        );




        return new Response(
        );
    }
}
