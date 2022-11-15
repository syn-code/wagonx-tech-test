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

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new Client($this->clientConfig());
    }


    public function tearDown(): void
    {
        unset($this->geoApi);
    }


    /** @test */
    public function query_open_weather_api_with_invalid_api_key_throws_http_exception()
    {
        $uri = getenv('OPEN_WEATHER_GEO_API') . '?q=cardiff&limit=1&appid=' . self::WRONG_API_KEY;
        $this->expectException(GuzzleException::class);
        $response = $this->client->request('get', $uri);
    }


    private function clientConfig(): array
    {
        return [
            'base_uri' => getenv('OPEN_WEATHER_BASE_URL'),
            'redirects' => false,
        ];
    }

}
