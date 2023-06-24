<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Person;
use App\Data\Bar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependency() 
    {
        //ada field bernama "app" di dalam unit test ini, dibuat oleh Laravel secara otomatis
        $foo1 = $this->app->make(Foo::class); //seperti melakukan new Foo()
        $foo2 = $this->app->make(Foo::class); //jadi keduanya itu object yg berbeda

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo1->foo());
        self::assertNotSame($foo1, $foo2); //mengecek jika object $foo1 dan $foo2 adalah object yang berbeda
    }

    public function testBind()
    {
        /*
        $person = $this->app->make(Person::class); //error, Laravel bingung karena harusnya class Person butuh parameter (firstName dan lastName)
        self::assertNotNull($person);
        */
        //solusinya pakai bind(), untuk kasih tahu Laravel gimana cara membuat object dari class Person ini
        //sebenernya seolah bikin rules dulu pakai method bind()
        $this->app->bind(Person::class, function($app) {
            return new Person('Fajar', 'Budi');
        }); //jadi tiap kali kita lakukan make() untuk class Person, maka yang dijalankan adalah function closure yang kita kasih
        //dan isi dari function closure tersebut adalah membuat object dari class Person dengan membawa 2 parameter

        $person1 = $this->app->make(Person::class); //seolah melakukan new Person('Fajar', 'Budi')
        $person2 = $this->app->make(Person::class); //yaitu memanggil function closure-nya dari method aturan bind() yg dibuat

        self::assertEquals('Fajar', $person1->firstName);
        self::assertEquals('Fajar', $person2->firstName);
        self::assertEquals('Budi', $person1->lastName);
        self::assertEquals('Budi', $person2->lastName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton() 
    {
        $this->app->singleton(Person::class, function($app) {
            return new Person('Fajar', 'Budi');
        });

        //variable bernama "person1" di bawah ini tidak nabrak dengan yang atas
        //karena variable scope tingkat function berbeda dengan function lainnya
        $person1 = $this->app->make(Person::class); //sama saja lakukan new Person('Fajar', 'Budi'); jika belum ada
        $person2 = $this->app->make(Person::class); //return existing, yaitu mengembalikan object yang sama itu jika sudah ada
        //jadi cara kerjanya hanya membuat 1 object yang sama, lalu kembalikan object yang sama

        self::assertEquals('Fajar', $person1->firstName);
        self::assertEquals('Fajar', $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person('Fajar', 'Budi');
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); //mengembalikan object $person
        $person2 = $this->app->make(Person::class); //mengembalikan object $person
        $person3 = $this->app->make(Person::class); //mengembalikan object $person

        self::assertEquals('Fajar', $person1->firstName);
        self::assertEquals('Fajar', $person2->firstName);
        self::assertSame($person, $person1);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection1()
    {
        $foo = $this->app->make(Foo::class); //object ini dbuat cuma untuk memastikan bahwa $foo yang dipakai di sebagai dependency di bawah itu tidak sama
        //sebenarnya walaupun kita tidak buat $foo di atas, tidak akan error
        $bar1 = $this->app->make(Bar::class); //Laravel sudah tahu, kalo kita buat object yang butuh object lain maka dia akan langsung buat object lain tersebut
        $bar2 = $this->app->make(Bar::class); //Laravel otomatis melakukan new Foo() untuk sebagai dependency object $bar kita
        //jadi Laravel sudah pintar, kamu butuh dependency apa? maka akan Laravel buat (kalo belum ada) dan inject-kan ke sana

        self::assertNotSame($foo, $bar1->foo); //lihat saja, $foo yg kita buat tidak sama dengan yang dijadikan dependency (hasil Laravel buatin secara otomatis)
        self::assertNotSame($bar1->foo, $bar2->foo); //foo yang dimiliki $bar1 dan $bar2 pun juga berbeda
    }

    public function testDependencyInjection2()
    {
        $this->app->singleton(Foo::class, function($app) {
            return new Foo();
        }); //nah di sini kita buat object $foo untuk dipergunakan secara konsep singleton

        $foo = $this->app->make(Foo::class); //jadi misal 1 kali kita membuat object $foo
        $bar1 = $this->app->make(Bar::class); //maka di sini object $foo yg sudah ada lah yg digunakan sebagai dependency
        $bar2 = $this->app->make(Bar::class); //ini juga akan pakai object $foo yg sudah ada untuk dependency

        self::assertSame($foo, $bar1->foo); //makanya hasilnya sama
        self::assertSame($bar1->foo, $bar2->foo); //ini juga dari object $foo yang sama
    }
}
