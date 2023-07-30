<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//MATERI ROUTING - Basic Routing
Route::get('/pzn', function() {
    return 'Hello Programmer Zaman Now';
});

//MATERI ROUTING - Redirect
Route::redirect('/youtube', '/pzn'); //yg akses path "youtube" akan di-redirect ke "pzn"

//MATERI ROUTING - Fallback Route
Route::fallback(function() {
    return '404 by Programmer Zaman Now';
});

//MATERI VIEW - Rendering View
Route::view('/hello', 'hello', ['name' => 'Fajar']);
Route::get('/hello-again', function() {
    return view('hello', ['name' => 'Fajar']);
});

//MATERI VIEW - Nested View Directory
Route::get('/hello-world', function() {
    return view('hello.world', ['name' => 'Fajar']);
});