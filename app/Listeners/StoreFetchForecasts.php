<?php

namespace App\Listeners;

use App\Events\ForecastsFetched;
use App\Http\Traits\ForecastTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class StoreFetchForecasts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use ForecastTrait;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\ForecastsFetched $event
     * @return void
     */
    public function handle(ForecastsFetched $event)
    {
        $data = $event->weathforecast ?? [];
        $this->storeForecasts($data);

    }
}
