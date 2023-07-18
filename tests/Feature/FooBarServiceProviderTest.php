<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Data\Foo;
use App\Data\Bar;
use App\Services\HelloService;

use function PHPUnit\Framework\assertEquals;

class FooBarServiceProviderTest extends TestCase
{
    //MATERI SERVICE PROVIDER - Registrasi Service Provider
    public function testServiceProvider() 
    {
        //karena Service Provider sudah langsung di-load Laravel, jadi kita sudah membuat registrasi dependency-nya di sana
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

    //MATERI SERVICE PROVIDER - Bindings & Singletons Properties
    public function testPropertySingletons()
    {
        $helloService1 = $this->app->make(HelloService::class); //namespace untuk class HelloService masih diperlukan
        $helloService2 = $this->app->make(HelloService::class);
        //tidak perlu ditulis namespace-nya di atas untuk class HelloServiceIndonesia
        //karena sudah dijalankan di Service Provider yang sudah kita buat yaitu FooBarServiceProvider

        self::assertSame($helloService1, $helloService2);
        self::assertEquals('Halo Fajar', $helloService1->hello('Fajar'));
    }
    //tambahkan test yang tidak butuh dependency dari FooBarServiceProvider
    public function testEmpty()
    {
        self::assertTrue(true);
    }
}
