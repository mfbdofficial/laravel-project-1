<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    //MATERI REQUEST INPUT - Mengambil Input HTTP Request
    public function hello(Request $request): string
    {
        $name = $request->input('name'); //Laravel akan cek key 'name' kalo ada di query parameter maka akan diambil, kalo gaada akan cek di body ada atau engga
        //MATERI REQUEST INPUT - Dynamic Properties
        /*
        $name = $request->name; //kalo ada property bernama "name", maka property akan diprioritaskan dibanding dari data input
        */
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

    //MATERI REQUEST INPUT - Input Query String
    public function helloQueryParameter(Request $request): string 
    {
        $inputQueryParameter = $request->query();
        return json_encode($inputQueryParameter);
    }

    //MATERI INPUT TYPE - Boolean & Date
    public function inputType(Request $request): string 
    {
        $name = $request->input('name');
        $married = $request->boolean('married');
        $birthDate = $request->date('birth_date', 'Y-m-d'); //bentuk format Y-m-d artinya tahun 4 digit, bulan 2 digit dan hari 2 digit
        //ngambilnya bisa saja pakai input('married') juga input('birth_date'), tapi nanti tipe datanya cuma string
        return json_encode([
            'name' => $name,
            'married' => $married,
            'birth_date' => $birthDate//->format('Y-m-d')
        ]);
        //sebelum pakai method format() di atas, bentuk $birthDate sebenarnya sudah bertipe data Date (tapi masih dalam library Carbon)
        //format() adalah method dari library carbon juga, digunakan untuk customize how the date or timestamp is displayed (misal ketika ambil data dari database)
        //format() allows you to specify a format string using the same formatting codes as the date() from PHP. 
    }

    //MATERI FILTER REQUEST INPUT - Method Filter Request Input
    public function filterOnly(Request $request): string 
    {
        $name = $request->only(['name.first', 'name.last']);
        return json_encode($name);
    }

    public function filterExcept(Request $request): string 
    {
        $user = $request->except(['admin']);
        return json_encode($user);
    }

    //MATERI FILTER REQUEST INPUT - FIlter Merge
    public function filterMerge(Request $request): string 
    {
        $request->merge(['admin' => false]);
        $user = $request->input();
        return json_encode($user);
    }
}
