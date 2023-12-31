<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//MATERI ROUTE GROUP - Route Prefix
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});  //artinya karena ada prefix() untuk Route di file ini, aslinya itu path di atas adalah '/api/user'

//MATERI ROUTING - Routing Kalo Kita Membuat API
Route::get('/posts', function() {
    return response()->json([
        'posts' => [
            'title' => 'Post One',
            'description' => 'This is post number one.'
        ]
        ]);
});
