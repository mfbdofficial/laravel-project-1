<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile; //pakai ini untuk class UploadedFile, agar bisa pakai fitur Fake 
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //MATERI FILE UPLOAD
    public function testUpload()
    {
        //pakai fitur Fake dari Laravel untuk membuat suatu hal yg palsu
        $picture = UploadedFile::fake()->image('budi.png'); //ini fitur fake, bikin tipe image, dengan nama file "fajar.png"
        //image fake di atas akan hasilkan gambar kotak hitam saja
        $this->post('/file/upload', [
            'picture' => $picture
        ])->assertSeeText('File uploaded successfully : budi.png');
    }
}
