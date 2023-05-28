<?php

namespace App\Data;

class Person
{
    //fitur Laravel 8 bisa langsung deklarasi property di method __construct
    public function __construct(public string $firstName, public string $lastName)
    {
        
    }
}