<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //MATERI SESSION - Menyimpan Data ke Session
    public function testCreateSession()
    {
        $this->get('/session/create')
            ->assertSeeText('Session was maded.')
            ->assertSessionHas('userId', 'FajarBudi')
            ->assertSessionHas('isMember', 'true');
    }

    //MATERI SESSION - Mengambil Data dari Session
    public function testGetSession()
    {
        $this->withSession([
            'userId' => 'FajarBudi',
            'isMember' => 'true' //kalo bentuknya ini true (boolean) maka akan error, boolean akan di-render oleh string sebagai 1 atau 0
        ])->get('/session/get')
            ->assertSeeText('User Id : FajarBudi, Is Member : true.');

        /*
        $this->withSession([])
            ->get('/session/get')
            ->assertSeeText('User Id : guest, Is Member : false.');
        */
        //kalo di atas ini dijalankan maka akan error, karena data Session-nya sudah terbawa dari yg percobaan assertion unit-test di atas-nya
        //cobalah buat function unit-test baru
    }

    public function testGetSessionFailed()
    {
        
        $this->withSession([]) //misal Session yg dibawa adalah kosong, sebenarnya tida perlu ditulis seperti di bawah juga sama saja
            ->get('/session/get')
            ->assertSeeText('User Id : guest, Is Member : false.');

        /*
        $this->get('/session/get') //ini sama saja seperti di atas, membawa Session kosong ya sama saja dengan tidak ada Session
            ->assertSeeText('User Id : guest, Is Member : false.');
        */
    }
}
