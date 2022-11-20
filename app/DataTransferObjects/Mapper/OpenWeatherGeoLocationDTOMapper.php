<?php

namespace App\DataTransferObjects\Mapper;

use App\DataTransferObjects\Contracts\DTOMappingInterface;
use App\DataTransferObjects\OpenWeatherGeoLocationDTO;

class OpenWeatherGeoLocationDTOMapper implements DTOMappingInterface
{
    public function __construct(
        private OpenWeatherGeoLocationDTO $dto,
    ){
    }

    public function map(array $data): OpenWeatherGeoLocationDTO
    {
       $data = array_shift($data);

       $this->dto
           ->setCity($data->name)
           ->setCountry($data->country)
           ->setState($data->state)
           ->setLongitude($data->lon)
           ->setLatitude($data->lat);

       return $this->dto;
    }

    public function toJson(): string
    {
        return json_encode(
            get_object_vars($this->dto)
        );
    }
}
