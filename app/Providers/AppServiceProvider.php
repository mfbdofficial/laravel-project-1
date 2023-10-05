<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        //MATERI DATABASE IN LARAVEL - INSERT Database in Laravel
        Model::unguard(); //kita off-kan protection Laravel untuk keharusan membuat property $fillable di Model untuk INSERT database

        //MATERI PENERAPAN LARAVEL UNTUK FITUR PROJECT - Membuat Pagination
        //Paginator::useBootstrapFive(); //untuk ubah style links() pada fitur pagination
    }
}
