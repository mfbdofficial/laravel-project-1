<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //MATERI CONTROLLER - Membuat Function di Controller
    public function testHello()
    {
        /*
        $this->get('/controller/hello')
            ->assertSeeText('Hello World');
        */
        //MATERI CONTROLLER - Dependency Injection
        $this->get('/controller/hello/Fajar')
            ->assertSeeText('Halo Fajar');
    }

    //MATERI REQUEST - Request Method
    public function testRequest()
    {
        $this->get('/controller/hello/request', ['Accept' => 'plain/text']) //test dengan melakukan request get, sembari mambawa nilai header (yg parameter bentuk array)
            ->assertSeeText('/controller/hello/request')
            ->assertSeeText('http://localhost/controller/hello/request')
            ->assertSeeText('GET')
            ->assertSeeText('plain/text');
        //jumlah assert yg diberikan tidak harus sama dengan yg dilakukan pada function request di Controller HelloController
        //karena misal assertSeeText() hanya untuk cek apakan return yg diberikan mengembalikan atau mengandung text yg sesuai?
        //selama syarat terpenuhi, maka hasil unit test berhasil dan tidak error
    }
}
