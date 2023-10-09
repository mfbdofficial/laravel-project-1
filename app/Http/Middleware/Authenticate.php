<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        //MATERI PENERAPAN LARAVEL UNTUK FITUR PROJECT - User Authentication in Laravel - Memanfaatkan Hasil Session Login - Membuat Route Tertentu Hanya Bisa Diakses Pasca Login
        return $request->expectsJson() ? null : route('login'); //artinya menuju Named Route yg memiliki name "login"
    }
}
