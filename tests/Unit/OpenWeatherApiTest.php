<?php

namespace Tests\Unit;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Tests\TestCase;

class OpenWeatherApiTest extends TestCase
{
    private ClientInterface $client;
    const WRONG_API_KEY = '88puchnYcVwarkLnlaBrTItW4rsbsfVZ';
    private string $openWeatherApiGeoUrl;
    private string $openWeatherApiKey;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new Client($this->clientConfig());
        $this->openWeatherApiGeoUrl = getenv('OPEN_WEATHER_GEO_API');
        $this->openWeatherApiKey = getenv('OPEN_WEATHER_API_KEY');
    }

    public function tearDown(): void
    {
        unset($this->geoApi);
    }

    /** @test */
    public function query_open_weather_api_with_invalid_api_key_throws_http_exception(): void
    {
        $uri = $this->openWeatherApiGeoUrl . '?q=cardiff&limit=1&appid=' . self::WRONG_API_KEY;
        $this->expectException(GuzzleException::class);
        $response = $this->client->request('get', $uri);
    }

    /** @test */
    public function query_open_weather_api_to_get_longitude_and_latitude_for_a_city(): void
    {
        $expectedLongitude = -3.1791934;
        $expectedLatitude = 51.4816546;

        $uri = $this->openWeatherApiGeoUrl . '?q=cardiff&limit=1&appid=' . $this->openWeatherApiKey;
        $response = $this->client->request('GET', $uri);

        $jsonData = json_decode($response->getBody(), true);
        $jsonData = (object)array_shift($jsonData);

        $this->assertEquals($expectedLongitude, $jsonData->lon);
        $this->assertEquals($expectedLatitude, $jsonData->lat);
    }

    private function clientConfig(): array
    {
        return [
            'base_uri' => getenv('OPEN_WEATHER_BASE_URL'),
            'redirects' => false,
        ];
    }

}
