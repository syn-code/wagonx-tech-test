<?php

namespace App\Services\OpenWeatherApi\Request\Contracts;

interface OpenWeatherApiInterface
{
    public function getWeatherForCity(float $lat, float $lon): array;
}
