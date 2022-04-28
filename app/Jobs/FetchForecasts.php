<?php

namespace App\Jobs;

use App\Events\ForecastsFetched;
use App\Http\Traits\ForecastTrait;
use App\Models\Forecast;
use Carbon\Carbon;
use Dnsimmons\OpenWeather\OpenWeather;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchForecasts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use ForecastTrait;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $date = Carbon::now()->format("m/d/Y");

        //Check if events already exist for this day
        $forecasts = Forecast::where("formatted_date", $date)->with('city')->get();

        if ($forecasts->count() == 0) {
            $openWeather = new OpenWeather();
            $newYork = $openWeather->getForecastWeatherByCityName('New York');
            if (!empty($newYork["location"]) && !empty($newYork['location']['id'])) {
                ForecastsFetched::dispatch($newYork);
            }
            $london = $openWeather->getForecastWeatherByCityName('London');
            if (!empty($london["location"]) && !empty($london['location']['id'])) {
                ForecastsFetched::dispatch($london);
            }
            $paris = $openWeather->getForecastWeatherByCityName('Paris');
            if (!empty($paris["location"]) && !empty($paris['location']['id'])) {
                ForecastsFetched::dispatch($paris);
            }
            $berlin = $openWeather->getForecastWeatherByCityName('Berlin');
            if (!empty($berlin["location"]) && !empty($berlin['location']['id'])) {
                ForecastsFetched::dispatch($berlin);
            }
            $tokyo = $openWeather->getForecastWeatherByCityName('Tokyo');
            if (!empty($tokyo["location"]) && !empty($tokyo['location']['id'])) {
                ForecastsFetched::dispatch($tokyo);
                //$this->storeForecasts($tokyo);
            }
        }

    }
}
