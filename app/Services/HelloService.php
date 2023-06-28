<?php

namespace App\Services;

interface HelloService 
{
    public function hello(string $name): string; //artinya method hello() ini menerima parameter $name (type string) dan hanya me-return bentuk string
}
