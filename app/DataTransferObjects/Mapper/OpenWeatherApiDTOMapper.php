<?php

namespace App\DataTransferObjects\Mapper;

use App\DataTransferObjects\Contracts\DTOMappingInterface;
use App\DataTransferObjects\OpenWeatherApiDTO;
use DateTimeImmutable;

class OpenWeatherApiDTOMapper implements DTOMappingInterface
{
    private array $weatherAggreate;

    public function __construct(
        private OpenWeatherApiDTO $dto
    ){
    }

    public function map(array $data, int $cityId = 0)
    {
        $weather = array_shift($data['weather']);

        $this->dto
            ->setCityId($cityId)
            ->setWeather($weather['main'])
            ->setDescription($weather['description'])
            ->setIcon($weather['icon'])
            ->setDateTimeWeatherCalculated(new DateTimeImmutable($data['dt_txt']));

        return $this->dto;
    }
}
