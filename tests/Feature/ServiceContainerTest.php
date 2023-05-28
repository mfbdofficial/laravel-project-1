<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependencyInjection() 
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
}
