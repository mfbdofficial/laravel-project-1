<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request) 
    {
        //MATERI FILE UPLOAD
        //$request->allFiles() //allFiles() untuk mengembalikan semua uploaded file, bedanya kalo file() itu pakai parameter key
        $pictureUploaded = $request->file('picture'); //file() bisa mengembalikan object uploaded file, array, null
        //$pictureUploaded->path() //path() untuk ketahui path-nya, karena sebelum dipindahkan pakai store, posisi file masih disimpan di temporary file
        $pictureUploaded->storePubliclyAs('pictures', $pictureUploaded->getClientOriginalName(), 'public'); //storePubliclyAs() untuk menyimpan file dengan visibility public
        //$pictureUploaded->store() //store() akan membuat nama file-nya di-generate random

        return 'File uploaded successfully : ' . $pictureUploaded->getClientOriginalName();
        
        //best practice from Laravel 10 documentation
        /*
        $pictureUploaded = $request->file('picture');
        $pictureUploaded->storeAs('pictures', $pictureUploaded->hashName(), 'public');

        return 'File uploaded successfully, the file extension is :' . $pictureUploaded->extension();
        */
    }
}
