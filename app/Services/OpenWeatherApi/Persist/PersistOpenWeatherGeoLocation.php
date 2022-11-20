<?php

namespace App\Services\OpenWeatherApi\Persist;

use App\DataTransferObjects\OpenWeatherGeoLocationDTO;
use App\Models\City;

class PersistOpenWeatherGeoLocation
{
    public function persistData(OpenWeatherGeoLocationDTO $dto): City
    {
        $existingCity = City::where('city', $dto->getCity())->first();

        if ($existingCity) {
            return $existingCity;
        }

        return City::create([
            'city' => $dto->getCity(),
            'country' => $dto->getCountry(),
            'state' => $dto->getState(),
            'lon' => $dto->getLongitude(),
            'lat' => $dto->getLatitude(),
        ]);
    }
}
