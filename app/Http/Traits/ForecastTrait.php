<?php

namespace App\Http\Traits;

use App\Models\City;
use App\Models\Forecast;
use Illuminate\Support\Facades\Log;

trait ForecastTrait
{
    public function storeForecasts($data)
    {
        //check if there's a already city from open weather with the id
        //create a new city if it doesn't exist
        $city = City::where("open_weather_id", $data["location"]["id"])->first();
        if (!$city) {
            $city = new City();
        }
        $city->name = $data["location"]["name"];
        $city->country = $data["location"]["country"];
        $city->latitude = $data["location"]["latitude"];
        $city->longitude = $data["location"]["longitude"];
        $city->open_weather_id = $data["location"]["id"];
        $city->save();

        if (empty(!$data['forecast'])) {
            foreach ($data["forecast"] as $forecast) {
                //Log::channel('stderr')->info($forecast);
                $forecast = Forecast::create([
                    "temp" => $forecast['forecast']['temp'],
                    "temp_min" => $forecast['forecast']['temp_min'],
                    "temp_max" => $forecast['forecast']['temp_max'],
                    "pressure" => $forecast['forecast']['pressure'],
                    "humidity" => $forecast['forecast']['humidity'],
                    "wind_speed" => $forecast['wind']['speed'],
                    "wind_deg" => $forecast['wind']['deg'],
                    "wind_direction" => $forecast['wind']['direction'],
                    "condition_name" => $forecast['condition']['name'],
                    "condition_description" => $forecast['condition']['desc'],
                    "condition_icon" => $forecast['condition']['icon'],
                    "timestamp" => $forecast['datetime']['timestamp'],
                    "timestamp_sunrise" => $forecast['datetime']['timestamp_sunrise'],
                    "timestamp_sunset" => $forecast['datetime']['timestamp_sunset'],
                    "formatted_date" => $forecast['datetime']['formatted_date'],
                    "formatted_day" => $forecast['datetime']['formatted_day'],
                    "formatted_time" => $forecast['datetime']['formatted_time'],
                    "formatted_sunrise" => $forecast['datetime']['formatted_sunrise'],
                    "formatted_sunset" => $forecast['datetime']['formatted_sunset'],
                    "city_id" => $city->id,
                ]);
            }
        }
    }
}
