<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse; //jangan lupa namespace untuk RedirectResponse
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    //MATERI REDIRECT
    public function redirectTo(): string
    {
        return 'Redirect to';
    }

    public function redirectFrom(): RedirectResponse
    {
        return redirect('/redirect/to');
    }

    //MATERI REDIRECT - Redirect to Named Routes
    public function redirectName(): RedirectResponse 
    {
        return redirect()->route('redirect.hello', ['name' => 'Fajar']);
        //"redirect.hello" adalah nama route yg sudah kita buat, mengarah untuk path "/redirect/name/{name}"
    }

    public function redirectHello(string $name): string 
    {
        return "Hello $name";
    }

    //MATERI REDIRECT - Redirect to Controller Action
    public function redirectAction(): RedirectResponse 
    {
        return redirect()->action([RedirectController::class, 'redirectHello'], ['name' => 'Budi']);
        //maka melakukan redirect ke class "RedirectController" method "redirectHello" (path-nya akan otomatis dicari Laravel)
        //Laravel otomatis tahu route-nya dan url-nya yg mana
    }

    //MATERI REDIRECT - Redirect to External Domain
    public function redirectAway(): RedirectResponse
    {
        return redirect()->away('https://github.com/mfbdofficial'); //dituliskan lengkap bersama nama domain-nya
    }
}
