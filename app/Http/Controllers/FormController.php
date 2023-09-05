<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response; //jangan lupa use untuk Response

class FormController extends Controller
{
    //MATERI CROSS SITE REQUEST FORGERY - CSRF Token
    public function renderForm(): Response
    {
        return response()->view('form'); //Method Controller untuk me-render View
    }

    public function submitForm(Request $request): Response
    {
        $nama = $request->input('name');
        return response()->view('hello', ['name' => $nama]);
    }
}
