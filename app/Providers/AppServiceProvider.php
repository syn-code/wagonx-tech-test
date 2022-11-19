<?php

namespace App\Providers;

use App\Services\OpenWeatherApi\Request\OpenWeatherApiGeoLocation;
use App\Services\OpenWeatherApi\Request\OpenWeatherApiGeoLocationInterface;
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
            return new OpenWeatherApiGeoLocation(new Client());
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
