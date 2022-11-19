<?php

namespace App\Services\OpenWeatherApi\Request;

use Psr\Http\Message\ResponseInterface;

interface OpenWeatherApiGeoLocationInterface
{
    public function getCityByGeoLocation(string $cityCollection, int $limit): ResponseInterface;
}
