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
        $this->get('/youtube') //yg bawah ini parameter-nya mau diisi '/pzn' atau 'pzn' atau 'http://localhost/pzn', test-nya tetap berhasil
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

    //MATERI ROUTE PARAMETER - Route Parameter
    public function testRouteParameter() {
        $this->get('/products/1')
            ->assertSeeText('Product : 1');
        $this->get('/products/5')
            ->assertSeeText('Product : 5');
        $this->get('/products/2/items/xxx')
            ->assertSeeText('Product : 2, Item : xxx');
        $this->get('/products/8/items/yyy')
            ->assertSeeText('Product : 8, Item : yyy');
    }

    //MATERI ROUTE PARAMETER - Regular Expression Constraints
    public function testRouteParameterRegex() {
        $this->get('/categories/1234')
            ->assertSeeText('Category : 1234');
        $this->get('/categories/salah')
            ->assertSeeText('404 by Programmer Zaman Now'); //output-nya yg dari Fallback Route
        $this->get('/tasks/6/answers/c')
            ->assertSeeText('Task : 6, Answer : c');
        $this->get('/tasks/8/answers/ab')
            ->assertSeeText('404 by Programmer Zaman Now');
    }

    //MATERI ROUTE PARAMETER - Optional Route Parameter
    public function testRouteOptionalParameter() {
        $this->get('/users/Fajar')
            ->assertSeeText('User : Fajar');
        $this->get('/users')
            ->assertSeeText('User : 404'); //output-nya yg dari Fallback Route
    }

    //MATERI ROUTE PARAMETER - Routing Conflict
    public function testRouteConflict() {
        $this->get('/conflict/budi')
            ->assertSeeText('Conflict budi');
        $this->get('/conflict/fajar')
            ->assertSeeText('Conflict Fajar Budi');
    }

    //MATERI NAMED ROUTE
    public function testNamedRoute() {
        $this->get('/produk/12345')
            ->assertSeeText('Link : http://localhost/products/12345'); //link '/products/12345' gagal, harus lengkap 'http://localhost/products/12345' agar test berhasil
        $this->get('/produk-redirect/12345')
            ->assertRedirect('/products/12345'); //diisi '/products/12345' atau 'products/12345' atau 'http://localhost/products/12345', semua test hasilnya berhasil
    } //kehusus link string yg dikembalikan route() akan berbentuk lengkap jika di-test dari sisi penulisan teks,
    //untuk test redirect asalkan path tujuan yg dimaksud sama, maka tetap berhasil walau penulisan link path berbeda
    //route() itu kembalikan pakai domain 'http://localhost' karena kita me-running di unit test (kalo dihosting bisa jadi beda lagi)
}
