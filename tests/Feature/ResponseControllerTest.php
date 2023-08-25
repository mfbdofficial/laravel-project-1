<?php

namespace Tests\Feature;

use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //MATERI RESPONSE
    public function testResponse()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText('Hello Response');
    }

    //MATERI RESPONSE - HTTP Response Header
    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText('Fajar')->assertSeeText('Budi')
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'MFBD Coorporation')
            ->assertHeader('App', 'Learn Laravel');
    }

    //MATERI RESPONSE - Response Type
    public function testView()
    {
        $this->get('/response/type/view')
            ->assertSeeText('Hello Fajar');
    }

    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertJson([
                'firstName' => 'Fajar', 
                'lastName' => 'Budi'
            ]); //assertJson() mengecek JSON-nya sama atau tidak
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            //->assertHeader('Content-Type', 'image/png');
            ->assertHeader('Content-Type', 'image/jpeg'); //untuk cek file yg di-render agak sulit, jadi kita cek dari header-nya saja
            //kalo tipe gambar yg dikirim extensi .png maka "Content-Type"-nya "image/png"
            //kalo tipe gambar yg dikirim extensi .jpg dan .jpeg maka "Content-Type"-nya "image/jpeg"

            //KODE DI ATAS BERJALAN NORMAL, DI BAWAH DIABAIKAN SAJA
            //->assertHeader('Content-Type', 'text/html; charset=UTF-8');
            //keanehan, header "Content-Type"-nya selalu hasilkan "text/html; charset=UTF-8" walau tipe response yg kita berikan itu jpg atau png
            //harusnya isi "Content-Type"-nya bisa menjadi "image/jpg" atau "image/png" dll sesuai tipe file yg di-render
            //hal di atas ini bisa terjadi karena sekarang response()->file() di Laravel tidak secara otomatis me-set "Content-Type" header berdasarkan tipe file yg di-upload
            //karena secara utamanya ia menyediakan file dari filesystem server, default-nya menjadi "text/html; charset=UTF-8" untuk beberapa alasan keamanan
            //set "Content-Type" berdasarkan tipe file bisa beresiko karena bergantung dari extension file-nya, itu bisa dimanipulasi user dan tidak secara akurat merefleksikan isi konten file yg sebenarnya 
            //ini bisa menjadi kelemahan security, seperti melakukan serve (penyediaan) file yg berpotensi berbahaya dengan header yg salah
            //jika sudah melakukan set header secara manual, maka header "Content-Type" berisi "image/png" atau "image/jpg" atau dll sesuai yg diatur sudah bisa berjalan
            //ABAIKAN SAMPAI SINI
    }

    public function testDownload()
    {
        $this->get('response/type/download')
            ->assertDownload('coffee-download.jpg'); //assertDownload() untuk cek file yg di-download, pakai parameter nama file yg di-download
    }
}