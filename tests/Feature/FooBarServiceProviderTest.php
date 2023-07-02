<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Data\Foo;
use App\Data\Bar;

class FooBarServiceProviderTest extends TestCase
{
    public function testServiceProvider() 
    {
        //karena Service Provider sudah langsung diload Laravel, jadi kita sudah membuat registrasi dependency-nya di sana
        //di sini tidak perlu membuat registrasi dependency lagi untuk lakukan dependency injection
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertSame($foo1, $foo2);

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($bar1, $bar2);

        self::assertSame($foo1, $bar2->foo);
        self::assertSame($foo2, $bar1->foo);
    }
}
