<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; //untuk cara Facade di bawah

class SessionController extends Controller
{
    //MATERI SESSION - Menyimpan Data ke Session
    public function createSession(Request $request): string
    {
        /*
        session()->put('userId', 'FajarBudi'); //ini pake cara Helper Function, sama saja
        \Illuminate\Support\Facades\Session::put('userId', 'FajarBudi'); //ini pake cara Facade Session, sama saja
        Session::put('userId', 'FajarBudi'); //cara Facade juga bisa ditulis seperti ini, tapi jangan lupa untuk use namespace-nya
        */
        $request->session()->put('userId', 'FajarBudi');
        $request->session()->put('isMember', 'true');

        return 'Session was maded.';
    }

    //MATERI SESSION - Mengambil Data dari Session
    public function getSession(Request $request): string
    {
        $userId = $request->session()->get('userId', 'guest');
        $isMember = $request->session()->get('isMember', 'false');

        //return "User Id : ${userId}, Is Member : ${isMember}."; //ini sama saja tidak masalah, tapi tidak dianjurkan oleh extension PHP Intelephense
        return 'User Id : ' . $userId . ", Is Member : " . $isMember . ".";
    }
}
