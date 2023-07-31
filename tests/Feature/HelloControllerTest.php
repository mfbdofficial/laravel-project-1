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
}
