<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\Contracts\DTOMappingInterface;
use App\Services\OpenWeatherApi\Persist\PersistOpenWeatherGeoLocation;
use App\Services\OpenWeatherApi\Request\Contracts\OpenWeatherApiGeoLocationInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityWeatherController extends Controller
{
    public function __construct(
        private OpenWeatherApiGeoLocationInterface $apiGeoLocation,
        private DTOMappingInterface $mapper
    ) {
    }

    public function index(Request $request, string $cityNames): Response
    {
        $geoLocationPayload = $this->apiGeoLocation->getCityByGeoLocation($cityNames);
        $geoLocation = $this->mapper->map($geoLocationPayload);
        $persistedData = (new PersistOpenWeatherGeoLocation())->persistData($geoLocation);

        dd($persistedData);
        return new Response(
        );
    }
}
