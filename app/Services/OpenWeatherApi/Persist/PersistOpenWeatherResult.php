<?php

namespace App\Services\OpenWeatherApi\Persist;

use App\Models\CityWeatherResult;

class PersistOpenWeatherResult
{
    private array $weatherCollection = [];

    public function persist(array $weather): array
    {
        foreach ($weather as $key => $value) {
            $weather = CityWeatherResult::create([
                'city_id' => $value->getCityId(),
                'main' => $value->getWeather(),
                'description' => $value->getDescription(),
                'icon' => $value->getIcon(),
                'date_time_weather_calculated' => $value->getDateTimeWeatherCalculated(),
            ]);

            array_push($this->weatherCollection, $weather);
        }

        return $this->weatherCollection;
    }
}
