<?php

namespace App\Providers;

use App\DataTransferObjects\Contracts\DTOMappingInterface;
use App\DataTransferObjects\Mapper\OpenWeatherGeoLocationDTOMapper;
use App\DataTransferObjects\OpenWeatherGeoLocationDTO;
use App\Http\Controllers\CityWeatherController;
use App\Services\OpenWeatherApi\Request\Contracts\OpenWeatherApiInterface;
use App\Services\OpenWeatherApi\Request\OpenWeatherApi;
use App\Services\OpenWeatherApi\Request\OpenWeatherApiGeoLocation;
use App\Services\OpenWeatherApi\Request\Contracts\OpenWeatherApiGeoLocationInterface;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OpenWeatherApiGeoLocationInterface::class, function($app) {
            return new OpenWeatherApiGeoLocation(
                new Client(),
            );
        });

        $this->app->bind(OpenWeatherApiInterface::class, function ($app) {
            return new OpenWeatherApi(new Client());
        });

        $this->app->when(CityWeatherController::class)
            ->needs(DTOMappingInterface::class)
            ->give(function () {
                return new OpenWeatherGeoLocationDTOMapper(new OpenWeatherGeoLocationDTO());
            });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
