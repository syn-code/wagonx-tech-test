<?php

namespace App\Services\OpenWeatherApi\Request\Contracts;

interface OpenWeatherApiGeoLocationInterface
{
    public function getCityByGeoLocation(string $locations): array;
}
