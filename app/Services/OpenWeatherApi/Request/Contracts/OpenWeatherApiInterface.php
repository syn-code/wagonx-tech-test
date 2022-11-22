<?php

namespace App\Services\OpenWeatherApi\Request\Contracts;

interface OpenWeatherApiInterface
{
    public function getWeatherForCity(array $geoLocations): array;
}
