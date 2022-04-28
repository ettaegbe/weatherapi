<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use ReindertVetter\ApiVersionControl\Middleware\ApiVersionControl;

class RouteServiceProvider extends ServiceProvider
{
    //protected $namespaceApi = 'App\\Http\\Controllers\\Api';

    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            /*Route::middleware('api')
                ->namespace($this->namespaceApi)
                ->prefix('api')
                ->group(base_path('routes/api.php'));*/

            Route::middleware(['api', ApiVersionControl::class])
                ->prefix('api')
                ->as('default.')
                ->group(base_path('routes/api.php'));

            Route::middleware(['api', ApiVersionControl::class])
                ->prefix('api/{version}')
                ->where(['version' => 'v\d{1,3}'])
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
