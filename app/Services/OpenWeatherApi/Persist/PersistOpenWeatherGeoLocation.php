<?php

namespace App\Services\OpenWeatherApi\Persist;

use App\Models\City;

class PersistOpenWeatherGeoLocation
{
    private array $cityCollection = [];

    public function persist(array $cityNames): array
    {
        foreach ($cityNames as $city) {

            $existingCity = City::where('city', $city->getCity())->first();

            if ($existingCity) {
                $this->cityCollection[] = $existingCity;
            } else {
                $createdCity = City::create([
                    'city' => $city->getCity(),
                    'country' => $city->getCountry(),
                    'state' => $city->getState(),
                    'lon' => $city->getLongitude(),
                    'lat' => $city->getLatitude(),
                ]);

                $this->cityCollection[] = $createdCity;
            }
        }

        return $this->cityCollection;
    }
}
