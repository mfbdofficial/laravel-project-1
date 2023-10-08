<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule; //untuk memakai fitur validasi Rule
use App\Models\User; //untuk memakai Model User

class UserController extends Controller
{
    //to show a page (form) for create a new user
    public function create()
    {
        return view('users.register');
    }

    //to store a user data from the register form page
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'], //'min:3' artinya rules-nya minimal harus ada 3 character
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            /*
            'password' => ['required', 'confirmed', 'min:6'], //di Laravel, rule 'confirmed' bisa dipakai untuk field lain yg namanya sama lalu ada "_confirmation"
            */ 
            'password' => 'required|confirmed|min:6', //ini sama saja dengan yg atas, bentuknya bisa dibuat seperti ini
            //oleh karena itu attribute name pada input di form-nya untuk konfirmasi password diberi name "password_confirmation"
            /*
            'password_confirmation'=> ['required'] //kalo sudah ada rules 'confirmed' di atas, field yg _confirmation tidak perlu lagi ditulis 
            */
            //yg masuk ke database-pun juga field password saja, tidak ada field password_confirmations
        ]);

        //lakukan hash untuk password-nya 
        $formFields['password'] = bcrypt($formFields['password']);

        //sekarang kita mau INSERT data user-nya dan langsung login secara otomatis
        $user = User::create($formFields); //INSERT data user-nya, tapi kali ini kita jadikan variable
        auth()->login($user); //langsung melakukan login, login() isi parameter-nya pakai variable bekas aksi INSERT data di atas

        return redirect('/home')->with('message', 'User created and logged in.');
    } //ketika sudah melakukan login() itu artinya ada data session yg terbuat (kita bisa lakukan sesuatu, misal ubah tampilan View berdasarkan data session itu)
}
