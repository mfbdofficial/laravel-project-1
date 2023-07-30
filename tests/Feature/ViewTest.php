<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //MATERI VIEW - Rendering View
    public function testView(): void
    {
        $this->get('/hello')
            ->assertSeeText('Hello Fajar');
        $this->get('/hello-again')
            ->assertSeeText('Hello Fajar');
    }

    //MATERI VIEW - Nested View Directory
    public function testViewNested(): void
    {
        $this->get('/hello-world')
            ->assertSeeText('World Fajar');
    }

    //MATERI VIEW - Test View Tanpa Routing
    public function testViewWithoutRoute() {
        //integration test Laravel sudah menyediakan method view() untuk malukan test pada View yg tidak ada routing-nya
        //jadi kita hanya mengetes template-nya saja
        $this->view('hello', ['name' => 'Fajar'])
            ->assertSeeText('Hello Fajar');
        $this->view('hello.world', ['name' => 'Fajar'])
            ->assertSeeText('World Fajar');
    }
}
