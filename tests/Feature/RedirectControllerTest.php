<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //MATERI REDIRECT
    public function testRedirect()
    {
        $this->get('/redirect/from')
            ->assertRedirect('/redirect/to'); //di hasilnya entah kenapa dihitung sebagai 2 assertion 
    }

    //MATERI REDIRECT - Redirect to Named Routes
    public function testRedirectName()
    {
        $this->get('/redirect/name')
            ->assertRedirect('/redirect/name/Fajar');
    }

    //MATERI REDIRECT - Redirect to Controller Action
    public function testRedirectAction()
    {
        $this->get('/redirect/action')
            ->assertRedirect('/redirect/name/Budi'); //"/redirect/name/Budi" adalah path yg nantinya akan otomatis dicarikan oleh Laravel
    }

    //MATERI REDIRECT - Redirect to External Domain
    public function testRedirectAway()
    {
        $this->get('/redirect/away')
            ->assertRedirect('https://github.com/mfbdofficial');
    }
}
