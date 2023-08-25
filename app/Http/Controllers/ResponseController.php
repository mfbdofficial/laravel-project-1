<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response; //jangan lupa namespace untuk class Response
use Illuminate\Http\JsonResponse; //kalo me-return response type JSON, pakai class JsonResponse yg namespace-nya ini
use Symfony\Component\HttpFoundation\BinaryFileResponse; //kalo me-return response type file (untuk render file), pakai class BinaryFileResponse

class ResponseController extends Controller
{
    //MATERI RESPONSE 
    public function response(Request $request): Response
    {
        return response('Hello Response'); //parameter untuk object response bisa View, string, array dll
    }

    //MATERI RESPONSE - HTTP Response Header
    public function header(Request $request): Response
    {
        $body = [
            'firstName' => 'Fajar', 
            'lastName' => 'Budi'
        ];
        return response(json_encode($body), 200)
            ->header('Content-Type', 'application/json') //menambahkan header
            ->withHeaders([
                'Author' => 'MFBD Coorporation',
                'App' => 'Learn Laravel'
            ]); //menambahkan header lagi
    }

    //MATERI RESPONSE - Response Type
    public function responseView(Request $request): Response 
    {
        return response()
            ->view('hello', ['name' => 'Fajar']);
    }

    public function responseJson(Request $request): JsonResponse
    {
        $body = [
            'firstName' => 'Fajar',
            'lastName' => 'Budi'
        ];
        return response()
            ->json($body);
    }

    public function responseFile(Request $request): BinaryFileResponse 
    {
        
        return response()
            //->file(storage_path('app/public/pictures/fajar.png')); 
            ->file(storage_path('app/public/pictures/coffee-1-unsplash.jpg')); //ini hanya me-render (menampilkan) file

        //KODE DI ATAS BERJALAN NORMAL, DI BAWAH DIABAIKAN SAJA
        //karena aturan baru header "Content-Type" yg default-nya "text/html; charset=UTF-8" dari Laravel untuk keperluan security,
        //maka untuk header "Content-Type"-nya ditentukas secara manual saja dengan function herader() atau menambah parameter kedua (array)
        /*
        return response()
            ->file(storage_path('app/public/pictures/fajar.png'), ['Content-Type' => 'image/png']);
        */
        /*
        $responseResult = response()->file(storage_path('app/public/pictures/fajar.png'));
        $responseResult->headers->set('Content-Type', 'image/png');
        return $responseResult;
        */
        //ABAIKAN SAMPAI SINI
    }

    public function responseDownload(Request $request): BinaryFileResponse 
    {
        return response()
            ->download(storage_path('app/public/pictures/coffee-1-unsplash.jpg'), 'coffee-download.jpg'); //ini paksa download lalu ditampilkan
    }
}
