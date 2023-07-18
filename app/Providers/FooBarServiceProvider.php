<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Data\Foo;
use App\Data\Bar;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider; //untuk interface DeferrableProvider

//MATERI SERVICE PROVIDER - Deferred Provider
//mulai meng-implements DeferrableProvider
class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
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
        echo 'FooBarServiceProvider'; //cuma debug, untuk cek apakah Service Provider ini jalan atau tidak
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

    //MATERI SERVICE PROVIDER - Deferred Provider
    public function provides(): array 
    {
        return [HelloService::class, Foo::class, Bar::class];
        //jadi isi method ini me-return array, isinya semua class yang terlibat di Service Provider ini
        //Service Provider ini gaakan dijalankan, kecuali kalo kita pakai (memanggil) dan butuh dependency dari class yang ada di list array atas itu barulah dijalankan
    }
}
