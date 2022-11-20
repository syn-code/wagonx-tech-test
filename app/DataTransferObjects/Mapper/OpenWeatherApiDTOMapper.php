<?php

namespace App\DataTransferObjects\Mapper;

use App\DataTransferObjects\Contracts\DTOMappingInterface;
use App\DataTransferObjects\OpenWeatherApiDTO;

class OpenWeatherApiDTOMapper implements DTOMappingInterface
{

    public function __construct(
        private OpenWeatherApiDTO $dto
    ){
    }

    public function map(array $data): OpenWeatherApiDTO
    {
        dd($data);


        return $this->dto;
    }

    public function toJson(): string
    {
        // TODO: Implement toJson() method.
    }
}
