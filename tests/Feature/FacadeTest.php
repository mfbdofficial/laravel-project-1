<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config; //jangan lupa namespace-nya untuk Facades yg Illuminate\Support\Facades\
use Tests\TestCase;

class FacadeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //MATERI FACADES - Facades VS Helper Function
    public function testConfig()
    {
        $firstName1 = config('contoh.author.first'); //ini pakai Helper Function
        $firstName2 = Config::get('contoh.author.first'); //ini pakai Facades

        self::assertEquals($firstName1, $firstName2); //hasilnya yaitu sama saja

        var_dump(Config::all()); 
        //MATERI FACADES - Bagaimana Facades Bekerja?
        //jadi cara ini (Config di atas) itu faedahnya untuk mempermudah kita ngambil data di Service Container $app ($app instance dari class Application),
        //lalu tinggal manggil method-nya yg mau diigunakan
    }

    //MATERI FACADES - Bagaimana Facades Bekerja?
    public function testConfigDependency() 
    {
        $config = $this->app->make('config'); //namanya 'config', berhubungan dari getFacadeAccessor(), 
        $firstName1 = $config->get('contoh.author.first'); //yg ada di laravel-project-1/vendor/laravel/framework/src/Illuminate/Support/Facades/Config.php)
        $firstName2 = Config::get('contoh.author.first'); //bagian ini adalah model singkat dari proses dua baris di atas 
        //kita cuma pakai cara Facades kalo cara di atas yg pakai app tidak bisa dipakai

        self::assertEquals($firstName1, $firstName2);

        var_dump($config->all()); //sama saja seperti yg bawah
        //var_dump(Config::all());
    }

    //MATERI FACADES - Facades Mock
    public function testConfigMock()
    {
        //membuat Facade Mock
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('Joko Keren');
        
        $firstName1 = Config::get('contoh.author.first');
        $config = $this->app->make('config');
        $firstName2 = $config->get('contoh.author.first');
        //$firstName3 = config('contoh.author.first'); //bila sudah membuat mock untuk Facade di atas, maka jika kita menggunakan Helper Function untuk fungsi yg di-mock, hsasilnya akan error dari library Mockery-nya

        self::assertEquals('Joko Keren', $firstName1);
        self::assertEquals('Joko Keren', $firstName2);
        //self::assertEquals('Fajar', $firstName3); //ini berhasil kalo tidak ada Facade Mock di atas
    }
}
