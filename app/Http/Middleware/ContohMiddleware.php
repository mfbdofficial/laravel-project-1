<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContohMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    //MATERI MIDDLEWARE - Membuat Middleware
    /*
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY');
        if($apiKey == 'jojojojo') {
            return $next($request);
        } else {
            return response('Access Denied', 401);
        } //kita bisa return apapun seperti HTTP Response, kalo mau RedirectResponse-pun juga bisa dilakukan
    }
    */

    //MATERI MIDDLEWARE - Middleware Parameter
    public function handle(Request $request, Closure $next, string $key, int $status): Response
    {
        $apiKey = $request->header('X-API-KEY');
        if($apiKey == $key) { //beda-nya sama yg atas maka sekarang kode perbandingan value header 'X-API-KEY'-nya tidak di-hard code di Middleware, tapi ditaruh di Routing-nya
            return $next($request);
        } else {
            return response('Access Denied', $status); //lalu untuk status-nya juga tidak di-hard code di Middleware, tapi di Routing-nya
        }
    }
}
