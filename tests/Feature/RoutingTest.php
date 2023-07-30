<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //MATERI ROUTING - Basic Routing
    public function testGet()
    {
        $this->get('/pzn') //Helper Function bernama "get()" artinya melakukan HTTP Request GET
            ->assertStatus(200) //test kalo status yg dikembalikan itu 200 (artinya berhasil)
            ->assertSeeText('Programmer Zaman Now'); //test isi konten teks web-nya)
    }

    //MATERI ROUTING - Redirect
    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/pzn'); //test jika sudah lakukan HTTP Request GET ke "youtube" maka akan redirect ke "pzn"
            //di atas akan dihitung sebagai 2 assertion, penyebabnya belum ditemukan
            //->assertSeeText('Programmer Zaman Now'); //ini akan error, karena "youtube" return-nya itu melakukan redirect ke "pzn" bukannya sama percis seperti "pzn"
    }

    //MATERI ROUTING - Fallback Route
    public function testFallback()
    {
        $this->get('/404')
            ->assertSeeText('404 by Programmer Zaman Now');
        $this->get('/tidak-ada')
            ->assertSeeText('404 by Programmer Zaman Now');
        $this->get('/unknown-page')
            ->assertSeeText('404 by Programmer Zaman Now');
        //jadi konsepnya tiap kali kita akses halaman apapun yang tidak ada maka yg di-return adalah yg dari static function fallback
        //yg sudah kita atur me-return teks "404 by Programmer Zaman Now"
    }
}
