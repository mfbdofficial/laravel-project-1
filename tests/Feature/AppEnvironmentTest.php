<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App; //ini muncul dan di-import
use Tests\TestCase;

class AppEnvironmentTest extends TestCase
{
    public function testAppEnv() {
        var_dump(App::environment()); //akan kembalikan value app environment saat ini
        //kembalikan "testing" karena kena overwrite dari file phpunit.xml
        //pakai App itu yang namespace-nya Illuminate\Support\Facades\App
        //melakukan test, cek apakah App::environment('testing') bernilai true?
        if(App::environment('testing')) {
            self::assertTrue(true); //test nilai true yang diisi parameter true saja (langsung dianggap benar)
        }
    }
}
