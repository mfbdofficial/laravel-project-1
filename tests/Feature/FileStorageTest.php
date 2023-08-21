<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage; //jangan lupa use namepsace-nya untuk memakai suatu Facades
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //MATERI FILE STORAGE - File System
    public function testStorage()
    {
        $fileSystem = Storage::disk('local'); //mengembalikan sebuah object file system, karena local maka pakai konfigurasi yg local (disimpan di laravel-project-1/storage/app)
        $fileSystem->put('file.txt', 'Ini adalah file yang dibuat untuk contoh menambahkan file'); //put() untuk menambah file baru, parameter 1 untuk nama file + ekstensi-nya, parameter 2 untuk isi konten
        //method $fileSystem->get() di bawah berfungsi untuk mengambil isi konten file yg disimpan
        $this->assertEquals('Ini adalah file yang dibuat untuk contoh menambahkan file', $fileSystem->get('file.txt'));
        //sistem ini bukan dari library bawaan PHP, tapi disediakan oleh Laravel
    }

    //MATERI FILE STORAGE - Storage Link
    public function testPublic()
    {
        $fileSystem = Storage::disk('public'); //mengembalikan sebuah object file system, karena public maka pakai konfigurasi yg local (disimpan di laravel-project-1/storage/app/public)
        $fileSystem->put('file2.txt', 'Ini adalah file yang dibuat untuk contoh menambahkan file yg sudah ada symbolic link');
        
        $this->assertEquals('Ini adalah file yang dibuat untuk contoh menambahkan file yg sudah ada symbolic link', $fileSystem->get('file2.txt'));
    }
}
