<?php

namespace App\Providers;

use App\Http\Controllers\Api\ForecastController;
use App\Http\Resources\ForecastResource;
use App\Http\Resources\ForecastResourceV1;
use App\Jobs\FetchForecasts;
use App\Models\Forecast;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Request;
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

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::after(function (FetchForecasts $event) {
            // do stuffs like sending clients devices with notifications about the new weather forecast

            // $event->connectionName
            // $event->job
            // $event->job->payload()
        });
    }
}
