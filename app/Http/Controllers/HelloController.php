<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; //ini sudah ada default saat pertama membuat Controller
use App\Services\HelloService;

class HelloController extends Controller
{
    private HelloService $helloService;

    //MATERI CONTROLLER - Dependency Injection
    //ingat sebelumnya kita sudah membuat dependency bernama HelloService.php di folder app/Services
    //lalu ingat juga kita sudah membuat registrasi di Service Provider bernama FooBarServiceProvider.php, kita sudah melakukan binding interface ke class (secara singleton) pada HelloService.php
    //maka kalo ada pembuatan object HelloService.php, misal dengan function make(), maka yg dikembalikan adalah object HelloServiceIndonesia.php
    public function __contruct(HelloService $helloService) //Laravel otomatis melakukan Dependency Injection (HelloService akan diambil dari Service Provider dan dimasukkan ke sini)
    { 
        $this->helloService = $helloService; //property $helloService di class ini dimasukkan dengan $helloService yg dari parameter __construct
    } //jadi kalo butuh dependency lagi yg lain, tinggal taruh saja lagi di __construct(), nanti akan Laravel inject-kan

    //MATERI CONTROLLER - Membuat Function di Controller
    /*
    public function hello(string $name): string 
    {
        return 'Hello World';
    }
    */

    //MATERI CONTROLLER - Dependency Injection
    /*
    public function hello(string $name): string 
    {
        return $this->helloService->hello($name); //dari mekanisme di atas, maka ini memakai function hello() yg ada di HelloServiceIndonesia.php
    }
    */

    //MATERI REQUEST 
    //coba tambahkan parameter object $request dari class Request, Laravel akan secara otomatis meng-inject data request-nya
    public function hello(Request $request, string $name): string 
    {
        //MATERI REQUEST - Request Path
        $request->path();
        $request->url();
        $request->fullUrl();

        return $this->helloService->hello($name); //dari mekanisme di atas, maka ini memakai function hello() yg ada di HelloServiceIndonesia.php
    }

    //MATERI REQUEST - Request Method
    public function request(Request $request): string 
    {
        return $request->path() . PHP_EOL .
            $request->url() . PHP_EOL .
            $request->fullUrl() . PHP_EOL .
            $request->method() . PHP_EOL .
            $request->header('Accept') . PHP_EOL;
        //PHP_EOL itu tujuannya untuk menghasilkan new line di halaman web (tapi entah kenapa tidak bisa berfungsi di Laravel)
    }
}
