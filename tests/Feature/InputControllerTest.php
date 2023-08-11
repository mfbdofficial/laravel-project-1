<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //MATERI REQUEST INPUT - Mengambil Input HTTP Request
    public function testInput()
    {
        $this->get('/input/hello?name=Fajar') //ini pakai query parameter
            ->assertSeeText('Hello Fajar'); 
        $this->post('/input/hello', ['name' => 'Fajar']) //ini pakai form POST
            ->assertSeeText('Hello Fajar'); 
        //boleh juga kalo bentuk yg ideal dari Pak Eko (Programmer Zaman Now) seperti ini
        $this->post('/input/hello', [
            'name' => 'Fajar'
        ])->assertSeeText('Hello Fajar'); 
        //kalau mau pakai Postman, Insomnia atau tools HTTP Request Test lain silahkan coba saja
    }

    //MATERI REQUEST INPUT - Nested Input
    public function testNestedInput()
    {
        $this->post('/input/hello/first', ['name' => ['first' => 'Fajar', 'last' => 'Budi']])
            ->assertSeeText('Hello Fajar');
        //boleh juga dibuat bentuk array-nya yg rapi seperti ini
        $this->post('/input/hello/first', 
            [
                'name' => 
                [
                    'first' => 'Fajar', 
                    'last' => 'Budi'
                ]
            ])
            ->assertSeeText('Hello Fajar');
        //boleh juga kalo bentuk yg ideal dari Pak Eko (Programmer Zaman Now) seperti ini
        $this->post('/input/hello/first', [
            'name' => [
                'first' => 'Fajar', 
                'last' => 'Budi'
            ]
        ])->assertSeeText('Hello Fajar');
    }

    //MATERI REQUEST INPUT - Mengambil Semua Input
    public function testInputAll() 
    {
        $this->post('/input/hello/input', [
            'name' => [
                'first' => 'Fajar', 
                'last' => 'Budi'
            ]
        ])->assertSeeText('name')->assertSeeText('first')
            ->assertSeeText('Fajar')->assertSeeText('last')
            ->assertSeeText('Budi');
    }

    //MATERI REQUEST INPUT - Mengambil Array Input 
    public function testArrayInput()
    {
        $this->post('/input/hello/array', [
            'products' => [
                [
                    'name' => 'Apple Mac Book Pro',
                    'price' => 30000000
                ],
                [
                    'name' => 'Samsung Galaxy S10',
                    'price' => 15000000
                ]
            ]
        ])->assertSeeText('Apple Mac Book Pro')->assertSeeText('Samsung Galaxy S');
    }
}
