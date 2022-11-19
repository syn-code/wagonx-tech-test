<?php

namespace App\DataTransferObjects;


class OpenWeatherGeoLocationDTO
{
    private string $city;
    private string $country;
    private string $state;
    private float $longitude;
    private float $latitude;

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setLongitude(float $lon): self
    {
        $this->longitude = $lon;
        return $this;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }
}
