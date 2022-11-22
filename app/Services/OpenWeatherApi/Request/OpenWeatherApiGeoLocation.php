<?php

declare(strict_types=1);

namespace App\Services\OpenWeatherApi\Request;

use App\DataTransferObjects\Mapper\OpenWeatherGeoLocationDTOMapper;
use App\DataTransferObjects\OpenWeatherGeoLocationDTO;
use App\Services\OpenWeatherApi\Request\Contracts\OpenWeatherApiGeoLocationInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Client\HttpClientException;
use InvalidArgumentException;

final class OpenWeatherApiGeoLocation implements OpenWeatherApiGeoLocationInterface
{
    private ClientInterface $client;
    private array $geoLocationsAggregate = [];

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param  string  $locations
     * @return array
     * @throws HttpClientException
     */
    public function getCityByGeoLocation(string $locations): array
    {
        try {

            if (empty($locations)) {
                throw new InvalidArgumentException(
                    'No City was entered'
                );
            }

            $cities = explode(',', $locations);

            $geoLocationUrl = getenv('OPEN_WEATHER_GEO_API');
            $appKey = getenv('OPEN_WEATHER_API_KEY');

            foreach ($cities as $key => $city) {
                $url = "$geoLocationUrl?q=$city&appid=$appKey";
                $response =  $this->client->request('GET', $url);
                $this->mapResult(
                    json_decode((string)$response->getBody())
                );
            }

        } catch (GuzzleException $exception) {
            throw new HttpClientException('Error Occurred, please try again');
        }

       return $this->geoLocationsAggregate;
    }

    private function mapResult(array $location): void
    {
        $dtoMapper = new OpenWeatherGeoLocationDTOMapper(new OpenWeatherGeoLocationDTO());
        $this->geoLocationsAggregate[] = $dtoMapper->map($location);
    }
}
