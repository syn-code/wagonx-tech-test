<?php

namespace App\DataTransferObjects;

use DateTimeInterface;

class OpenWeatherApiDTO
{
    private int $id;
    private int $cityId;
    private string $main;
    private string $description;
    private string $icon;
    private DateTimeInterface $dateTimeWeatherCalculated;

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setCityId(int $cityId): self
    {
        $this->cityId = $cityId;
        return $this;
    }

    public function getCityId(): int
    {
        return $this->cityId;
    }

    public function setMain(string $main): self
    {
        $this->main = $main;
        return $this;
    }

    public function getMain(): string
    {
        return $this->main;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setDateTimeWeatherCalculated(DateTimeInterface $dateTimeWeatherCalculated): self
    {
        $this->dateTimeWeatherCalculated = $dateTimeWeatherCalculated;
        return $this;
    }

    public function getDateTimeWeatherCalculated(): DateTimeInterface
    {
        return $this->dateTimeWeatherCalculated;
    }

}
