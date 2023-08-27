<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt; //jangan lupa use namespace dari class Crypt untuk fitur Encyption di Laravel
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //MATERI ENCRYPTION - Melakukan Enkrip dan Dekrip
    public function testEncrypt()
    {
        $encrypt = Crypt::encrypt('Text Percobaan Enkripsi');
        var_dump($encrypt);
        $decrypt = Crypt::decrypt($encrypt);

        self::assertEquals('Text Percobaan Enkripsi', $decrypt);
    }
}
