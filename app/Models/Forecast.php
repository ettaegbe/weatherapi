<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    use HasFactory;
    protected $fillable = [
        "temp",
        "temp_min",
        "temp_max",
        "pressure",
        "humidity",
        "wind_speed",
        "wind_deg",
        "wind_direction",
        "condition_name",
        "condition_description",
        "condition_icon",
        "timestamp",
        "timestamp_sunrise",
        "timestamp_sunset",
        "formatted_date",
        "formatted_day",
        "formatted_time",
        "formatted_sunrise",
        "formatted_sunset",
        "city_id",
    ];
    public function city() {
        return $this->belongsTo('App\Models\City');
    }
}
