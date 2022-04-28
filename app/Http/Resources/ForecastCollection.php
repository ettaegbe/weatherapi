<?php

namespace App\Http\Resources;

use App\Models\Forecast;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ForecastCollection extends ResourceCollection
{
    public $collects = Forecast::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "data" => $this->collection,
        ];
    }

}
