<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContohMiddlewareTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //MATERI MIDDLEWARE - Registrasi Middleware - Route Middleware
    public function testInvalid()
    {
        $this->get('/middleware/api') //kita coba akses dengan tanpa membawa header
            ->assertStatus(401)    
            ->assertSeeText('Access Denied');
    }

    public function testValid()
    {
        $this->withHeader('X-API-KEY', 'jojojojo') //kita coba akses dengan mambawa header "X-API-KEY" yg value-nya sesuai
            ->get('/middleware/api')
            ->assertStatus(200)
            ->assertSeeText('OK');
    }

    //MATERI MIDDLEWARE - Middleware Group
    public function testGroupInvalid()
    {
        $this->get('/middleware/group')
            ->assertStatus(401)    
            ->assertSeeText('Access Denied');
    }

    public function testGroupValid()
    {
        $this->withHeader('X-API-KEY', 'jojojojo')
            ->get('/middleware/group')
            ->assertStatus(200)
            ->assertSeeText('GROUP');
    }
}
