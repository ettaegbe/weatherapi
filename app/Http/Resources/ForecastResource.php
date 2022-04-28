<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use ReindertVetter\ApiVersionControl\Concerns\VersionStatement;
class ForecastResource extends JsonResource
{
    use VersionStatement;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "temp" => $this->temp,
            "temp_min" => $this->temp_min,
            "temp_max" => $this->temp_max,
            "pressure" => $this->pressure,
            "humidity" => $this->humidity,
            "wind_speed" => $this->wind_speed,
            "wind_deg" => $this->wind_deg,
            "wind_direction" => $this->wind_direction,
            "condition_name" => $this->condition_name,
            "condition_description" => $this->condition_description,
            "condition_icon" => $this->condition_icon,
            "timestamp" => $this->timestamp,
            "timestamp_sunrise" => $this->timestamp_sunrise,
            "timestamp_sunset" => $this->timestamp_sunset,
            "formatted_date" => $this->formatted_date,
            "formatted_day" => $this->formatted_day,
            "formatted_time" => $this->formatted_time,
            "formatted_sunrise" => $this->formatted_sunrise,
            "formatted_sunset" => $this->formatted_sunset,
            "city_id" => $this->city_id,
            "city" => $this->city,
        ];


    }
}
