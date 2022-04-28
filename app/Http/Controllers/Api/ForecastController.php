<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexForecastRequest;
use App\Http\Resources\ForecastCollection;
use App\Http\Resources\ForecastResource;
use App\Http\Traits\ForecastTrait;
use App\Models\City;
use App\Models\Forecast;
use App\Http\Requests\StoreForecastRequest;
use App\Http\Requests\UpdateForecastRequest;
use Carbon\Carbon;
use Dnsimmons\OpenWeather\OpenWeather;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ForecastController extends Controller
{
    use ForecastTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexForecastRequest $request, ForecastResource $resource)
    {

        $date = Carbon::parse($request->date)->format("m/d/Y");

        $forecasts = Forecast::where("formatted_date", $date)->with('city')->get();
        /*->paginate($request->input('per_page', 100));*/

        if ($forecasts->count() == 0) {
            $openWeather = new OpenWeather();
            $newYork = $openWeather->getForecastWeatherByCityName('New York');
            if (!empty($newYork["location"]) && !empty($newYork['location']['id'])) {
                $this->storeForecasts($newYork);
            }
            $london = $openWeather->getForecastWeatherByCityName('London');
            if (!empty($london["location"]) && !empty($london['location']['id'])) {
                $this->storeForecasts($london);
            }
            $paris = $openWeather->getForecastWeatherByCityName('Paris');
            if (!empty($paris["location"]) && !empty($paris['location']['id'])) {
                $this->storeForecasts($paris);
            }
            $berlin = $openWeather->getForecastWeatherByCityName('Berlin');
            if (!empty($berlin["location"]) && !empty($berlin['location']['id'])) {
                $this->storeForecasts($berlin);
            }
            $tokyo = $openWeather->getForecastWeatherByCityName('Tokyo');
            if (!empty($tokyo["location"]) && !empty($tokyo['location']['id'])) {
                $this->storeForecasts($tokyo);
            }
            $forecasts = Forecast::where("formatted_date", $date)->with('city')->get();
            if ($forecasts->count() == 0) {
                return response()->json(["error" => __("No data available")], 500);
            }
        }
        return $resource->collection($forecasts);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreForecastRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreForecastRequest $request)
    {
        return $request->get("data");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Forecast $forecast
     * @return \Illuminate\Http\Response
     */
    public function show(Forecast $forecast)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateForecastRequest $request
     * @param \App\Models\Forecast $forecast
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateForecastRequest $request, Forecast $forecast)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Forecast $forecast
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forecast $forecast)
    {
        //
    }
}
