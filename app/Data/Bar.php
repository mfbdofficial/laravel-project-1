<?php

namespace App\Data;

class Bar 
{
    /*
    private Foo $foo; //artinya attribute $foo harus jenis object dari class
    */
    public Foo $foo; //di materi Service Container jadikan public, agar bisa diakses

    //ceritanya class Bar ini depend ke class Foo
    //method __construct ini harus jalan, dan dia perlu parameter object dari class bernama "Foo"
    public function __construct(Foo $foo)
    {
        $this->foo = $foo; //attribute $foo yang ada di object ini, diisi dengan $foo dari parameter method __construct
    }

    public function bar(): string 
    {
        //kita sudah punya attribute foo yang berubah object dari class Foo, sekarang pakai method foo()-nya
        return $this->foo->foo() . " and Bar";
    }
}

//Bar depends-on Foo atau Foo adalah dependecy untuk Bar
//Dependency Injection berarti kita perlu masukkan object dari class Foo ke dalam Bar, sehingga Bar bisa gunakan object Foo
//kita gunakan Constructor untuk lakukan injection (memasukkan dependency), sebenarnya ada cara lain seperti gunakan Attribute atau Function
//sangat direkomendasikan gunakan cara Constructor agar terlihat jelas dependecies-nya dan kita tidak bisa lupa menambahkan dependencies-nya