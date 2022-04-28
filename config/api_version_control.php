<?php
declare(strict_types=1);

use App\Http\Requests\IndexForecastRequest;
use App\Http\Requests\IndexForecastRequestV1;
use App\Http\Resources\ForecastResource;
use App\Http\Resources\ForecastResourceV1;
use Illuminate\Database\Eloquent\Collection;
use ReindertVetter\ApiVersionControl\Helper\RouteNameMatcher;
use ReindertVetter\ApiVersionControl\Helper\VersionFromHeader;
use ReindertVetter\ApiVersionControl\Middleware\Version\{Bind,
    ExamplePrepareParameterException,
    ExamplePrepareSortParameter,
    ExampleThrowHumanException
};

return [

    'releases' => [

        'forecasts.index' => [
            '<=1' => [
                //IndexForecastRequest::class,
                new Bind(IndexForecastRequest::class, IndexForecastRequestV1::class),
                new Bind(ForecastResource::class, function () {
                    $resource = app()->make(Collection::class);
                    return new ForecastResourceV1($resource);
                }),

            ],
            '>=2' => [
                IndexForecastRequest::class,
                new Bind(ForecastResource::class, function () {
                    $resource = app()->make(Collection::class);
                    return new \App\Http\Resources\ForecastResourceV2($resource);
                }),
                /* new Bind(OrderIndexRequest::class, OrderIndexRequestV2::class),
                 new Bind(OrderIndexResource::class, OrderIndexResourceV2::class),*/
            ],
        ],
        'default' => [
            '<=1' => [
                //ExampleThrowHumanException::class,
                new Bind(ForecastResource::class, function () {
                    $resource = app()->make(Collection::class);
                    return new ForecastResource($resource);
                }),
            ],
        ],

        'all' => [
            '<=1.0' => [
                //ExamplePrepareSortParameter::class,
            ],
        ],

    ],

    'route_matcher' => RouteNameMatcher::class,
//    'route_matcher' => \ReindertVetter\ApiVersionControl\Helper\RouteRegexMatcher::class,

    // 'version_parser' => VersionFromHeader::class,
    'version_parser' => \ReindertVetter\ApiVersionControl\Helper\VersionFromUri::class,

];
