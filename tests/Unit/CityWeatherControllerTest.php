<?php

namespace Tests\Unit;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CityWeatherControllerTest extends TestCase
{
    private const CITY_API_URL = '/api/weather-for-city/';

    /** @test */
    public function can_access_api_route_through_request_and_get_200_status()
    {
       $requestUrl = self::CITY_API_URL . 'cardiff';
       $this
           ->get($requestUrl)
           ->assertStatus(RESPONSE::HTTP_OK);
    }

    /** @test */
    public function can_get_json_weather_data_for_a_city()
    {
        $requestUrl = self::CITY_API_URL . 'cardiff';
        $response = $this->get($requestUrl);

        $this->assertJson($response->getContent());
    }

}
