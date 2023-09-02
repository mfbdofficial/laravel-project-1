<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse; //jangan lupa use namespace untuk JsonResponse
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    //MATERI COOKIE - Membuat Cookie
    public function createCookie(Request $request): Response
    {
        return response('Hello Cookie')
            ->cookie('User-Id', 'Fajar', 1000, '/') //expire 1000 menit, path-nya slash "/"
            ->cookie('Is-Member', 'true', 1000, '/'); //jadi tiap akses domain lalu slash "/", maka cookie akan dikirim
    }

    //MATERI COOKIE - Menerima Cookie
    public function getCookie(Request $request): JsonResponse
    {
        return response()
            ->json([
                'userId' => $request->cookie('User-Id', 'guest'),
                'isMember' => $request->cookie('Is-Member', 'false')
            ]);
    }

    //MATERI COOKIE - Clear Cookie
    public function clearCookie(Request $request): Response 
    {
        return response('Clear Cookie')
            ->withoutCookie('User-Id')
            ->withoutCookie('Is-Member');
    }
}
