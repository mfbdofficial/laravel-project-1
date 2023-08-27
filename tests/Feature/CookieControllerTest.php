<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //MATERI COOKIE - Membuat Cookie
    public function testCreateCookie()
    {
        $this->get('/cookie/set') //bisa pakai assertCookie untuk test Cookie (sudah disediakan Laravel)
            ->assertSeeText('Hello Cookie')
            ->assertCookie('User-Id', 'Fajar') //1 baris ini akan dihitung sebagai 2 assertions
            ->assertCookie('Is-Member', 'true'); //ditambah ini dengan atas, maka jadi 4 assertions
            //pada unit-test sudah dilakukan dekripsi secara otomatis
            //ada banyak function test Cookie yg lain seperti assertCookieExpired(), assertCookieMissing(), assertCookieNotExpired() dll
    }

    //MATERI COOKIE - Menerima Cookie
    public function testGetCookie()
    {
        //jadi cara unit test-nya (karena bukan dari browser) kita lakukan saja HTTP Request GET d
        //dengan permisalan membawa data cookie (ceritanya sudah di-set), dan lihat apakah tertangkap oleh Controller dan method controller-nya
        $this->withCookie('User-Id', 'Fajar') //permisalan membawa data cookie dengan function withCookie()
            ->withCookie('Is-Member', 'true')
            ->get('/cookie/get') //ini HTTP Request GET seperti biasa
            ->assertJson([ //data JSON berdasarkan cookie yg kita tangkap
                'userId' => 'Fajar',
                'isMember' => true
            ]); 
    }
}
