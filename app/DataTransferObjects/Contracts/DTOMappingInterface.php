<?php

namespace App\DataTransferObjects\Contracts;

use App\DataTransferObjects\OpenWeatherGeoLocationDTO;

interface DTOMappingInterface
{
    public function map(array $data): OpenWeatherGeoLocationDTO;
    public function toJson(): string;
}
