<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Data\Foo;
use App\Data\Bar;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;

class FooBarServiceProvider extends ServiceProvider
{
    //MATERI SERVICE PROVIDER - Bindings & Singletons Properties
    public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class
    ];
    
    /**
     * Register services.
     */
    //MATERI SERVICE PROVIDER - Registrasi Service Provider
    public function register(): void
    {
        $this->app->singleton(Foo::class, function($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function($app) {
            return new Bar($app->make(Foo::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
