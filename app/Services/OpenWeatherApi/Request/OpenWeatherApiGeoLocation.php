<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherApi\Request;

use App\Services\OpenWeatherApi\Request\Contracts\OpenWeatherApiGeoLocationInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use http\Exception\InvalidArgumentException;

final class OpenWeatherApiGeoLocation implements OpenWeatherApiGeoLocationInterface
{
    private ClientInterface $client;
    private const MAX_LIMIT = 5;
    private const MIN_LIMIT = 1;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param  string  $cityNames
     * @param  int  $limit
     * @return array
     */
    public function getCityByGeoLocation(string $cityNames, int $limit = self::MIN_LIMIT): array
    {
        try {

            if ($limit > self::MAX_LIMIT) {
                throw new InvalidArgumentException(
                    'City Search is passed it\'s limit it cannot be more than 5'
                );
            }

            $geoLocationUrl = getenv('OPEN_WEATHER_GEO_API');
            $appKey = getenv('OPEN_WEATHER_API_KEY');
            $queryString = $cityNames;
            $url = "$geoLocationUrl?q=$queryString&limit=$limit&appid=$appKey";

            $response =  $this->client->request('GET', $url);

        } catch (GuzzleException $exception) {
            throw new InvalidArgumentException('Error Occurred, please try again');
        }

        return json_decode(
            (string)$response->getBody()
        );
    }
}
