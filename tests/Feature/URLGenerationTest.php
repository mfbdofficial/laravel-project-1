<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //MATERI URL GENERATION - Current URL
    public function testURLCurrentFull()
    {
        $this->get('/url/currentfull?name=Fajar')
            ->assertSeeText('/url/currentfull?name=Fajar');
    }
    public function testURLCurrent()
    {
        $this->get('/url/current?name=Fajar')
            ->assertSeeText('/url/current');
    }

    //MATERI URL GENERATION - URL untuk Named Routes
    public function testURLNamed()
    {
        $this->get('/url/named')
            ->assertSeeText('/redirect/name/Fajar');
    }
}
