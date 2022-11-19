<?php

namespace App\DataTransferObjects\Mapper;

use App\DataTransferObjects\Contracts\DTOMappingInterface;
use App\DataTransferObjects\OpenWeatherGeoLocationDTO;

class OpenWeatherGeoLocationDTOMapper implements DTOMappingInterface
{

    public function __construct(
        private array $data,
        private OpenWeatherGeoLocationDTO $dto
    ){
    }

    public function map(): void
    {
       $this->dto
        ->setCity($this->data['city'])
       ->setCountry($this->data['country'])
       ->setState($this->data['state'])
       ->setLongitude($this->data['lon'])
       ->setLatitude($this->data['lat']);

    }

    public function toJson(): string
    {
        return json_encode(
            get_object_vars($this->dto)
        );
    }
}
