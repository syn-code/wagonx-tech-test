<?php

namespace App\Services\OpenWeatherApi\Request;

use App\DataTransferObjects\Mapper\OpenWeatherApiDTOMapper;
use App\DataTransferObjects\OpenWeatherApiDTO;
use App\Services\OpenWeatherApi\Request\Contracts\OpenWeatherApiInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

class OpenWeatherApi implements OpenWeatherApiInterface
{
    private array $weatherAggregate = [];
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function getWeatherForCity(array $geoLocations): array
    {
        try {
            $openWeatherApiUrl = getenv('OPEN_WEATHER_API');
            $appKey = getenv('OPEN_WEATHER_API_KEY');
            $url = '';
            foreach ($geoLocations as $key => $value) {
                $url = "$openWeatherApiUrl?lat={$value['lat']}&lon={$value['lon']}&cnt=5&appid=$appKey";
                $response = $this->client->request('GET', $url);
                $this->mapResults(json_decode($response->getBody(), true), $value['id']);
            }
        } catch (GuzzleException $exception) {
            throw new InvalidArgumentException('Error Occurred, please try again');
        }

        return $this->weatherAggregate;
    }

    public function mapResults(array $weatherData, int $cityId): void
    {
        foreach ($weatherData['list'] as $key => $weather) {
            $this->weatherAggregate[] = (new OpenWeatherApiDTOMapper(new OpenWeatherApiDTO()))->map($weather, $cityId);
        }
    }
}
