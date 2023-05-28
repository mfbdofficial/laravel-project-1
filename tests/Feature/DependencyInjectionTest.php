<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo; //jangan lupa tambahnya namespace-nya kalo mau pake class dari sumber file tertentu
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DependencyInjectionTest extends TestCase
{
    
    public function testDependencyInjection()
    {
        $foo = new Foo;
        $bar = new Bar($foo); //direkomendasikan memakai cara __construct ini

        /*
        $bar->setFoo($foo); //cara Dependency Injection kalo pakai function
        $bar->foo = $foo; //cara Dependency Injection kalo pakai attribute
        */

        self::assertEquals('Foo and Bar', $bar->bar());
    }
}
