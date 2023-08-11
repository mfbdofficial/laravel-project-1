<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    //MATERI REQUEST INPUT - Mengambil Input HTTP Request
    public function hello(Request $request): string
    {
        $name = $request->input('name'); //Laravel akan cek key 'name' kalo ada di query parameter maka akan diambil, kalo gaada akan cek di body ada atau engga
        return 'Hello ' . $name; //jadi code-nya bisa 1 dan ga perlu khawatir dari HTTP Method apa dan posisi datanya ada dimana
    }

    //MATERI REQUEST INPUT - Nested Input
    public function helloFirstName(Request $request): string
    {
        $firstName = $request->input('name.first');
        /*
        return 'Hello' . $firstName; //bisa juga pakai cara dibawah pakai kutip dua ("") kalo ada variable biar simple
        */
        return "Hello $firstName"; //jadi variable bisa langsung diselipkan
    }

    //MATERI REQUEST INPUT - Mengambil Semua Input
    public function helloInput(Request $request): string 
    {
        $input = $request->input(); //semua input akan di-combine menjadi 1 array
        return json_encode($input); //kita konversi bentuknya menjadi JSON
    }

    //MATERI REQUEST INPUT - Mengambil Array Input 
    public function helloArray(Request $request): string
    {
        $names = $request->input('products.*.name'); //mengambil bagian name dari semua products
        return json_encode($names);
    }
}
