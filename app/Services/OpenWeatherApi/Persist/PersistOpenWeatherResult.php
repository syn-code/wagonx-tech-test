<?php

namespace App\Services\OpenWeatherApi\Persist;

use App\Models\CityWeatherResult;

class PersistOpenWeatherResult
{
    private array $weatherCollection = [];

    public function persist(array $weather)
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

        $ids = array_map(function ($weather) {
            return $weather->id;
        }, $this->weatherCollection);

        return CityWeatherResult::whereIn('id', array_values($ids))->get();
    }
}
