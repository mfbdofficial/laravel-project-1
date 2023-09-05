<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        //perhatikan bagian routes ini
        $this->routes(function () {
            Route::middleware('api') ////MATERI ROUTE GROUP - Route Middleware, semuanya pakai Middleware yg berada di Middleware Groups 'api'
                ->prefix('api') //jadi semua yg prefix-nya "api", maka pakai Middleware Group yg 'api'
                ->group(base_path('routes/api.php')); //routes-nya ke sini untuk api (ini file yang dieksekusi)
                //lihatlah ini juga pakai function prefix() seperti MATERI ROUTE GROUP - Route Prefix

            Route::middleware('web') //MATERI ROUTE GROUP - Route Middleware, semuanya pakai Middleware yg berada di Middleware Groups 'web' 
                ->group(base_path('routes/web.php')); //selain yg prefix-nya "api", maka pakai Middleware Group yg 'web', routes-nya ke sini untuk web (ini file yang dieksekusi)
        }); //jadi Middleware Group 'api' dipakai untuk routing yg ada di routes/api.php (yg mengandung prefix "api"), 
    } //kalo Middleware Group 'web' dipakai untuk routing yg selain api.php (tidak mengandung prefix "api"), misal di routes/web.php dll
}
