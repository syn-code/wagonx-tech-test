<?php

namespace App\Services\OpenWeatherApi\Request;

use App\Services\OpenWeatherApi\Request\Contracts\OpenWeatherApiInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

class OpenWeatherApi implements OpenWeatherApiInterface
{
    private array $weatherPayload = [];
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function getWeatherForCity(float $lat, float $lon): array
    {
        try {
            $openWeatherApiUrl = getenv('OPEN_WEATHER_API');
            $appKey = getenv('OPEN_WEATHER_API_KEY');
            $url = "$openWeatherApiUrl?lat=$lat&lon=$lon&appid=$appKey";

            $response = $this->client->request('GET', $url);
            dd(json_decode($response->getBody()));

        } catch (GuzzleException $exception) {
            throw new InvalidArgumentException('Error Occurred, please try again');
        }

    }

    public function push(array $weatherData): void
    {
        $this->weatherPayload[] = $weatherData;
    }

    public function getWeatherPayload(): array
    {
        return $this->weatherPayload;
    }

}
