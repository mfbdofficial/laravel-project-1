<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env; //ini muncul dan di-import
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testGetEnv() {
        $youtube = env('YOUTUBE'); //mengambil nilai environment untuk key "YOUTUBE"
        self::assertEquals('MFBD Programmer', $youtube);
    }

    public function testDefaultEnv() {
        //$author = env('AUTHOR', 'Fajar');
        $author = Env::get('AUTHOR', 'Fajar'); //Env-nya pilih yang Illuminate\Support\Env
        self::assertEquals('Fajar', $author);     
    }

    //saran PHP, single quotes itu performance-nya lebih cepat
    //pakai double quotes untuk string hanya jika perlu include variable di dalam string atau jika ingin pakai escape sequences
}
