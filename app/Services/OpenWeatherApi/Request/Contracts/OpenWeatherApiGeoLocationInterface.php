<?php

namespace App\Services\OpenWeatherApi\Request\Contracts;

interface OpenWeatherApiGeoLocationInterface
{
    public function getCityByGeoLocation(string $cityCollection, int $limit): array;
}
