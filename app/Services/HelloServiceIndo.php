<?php

namespace App\Services;


class HelloServiceIndo implements HelloService
{
    public function hello(string $name): string
    {
        return "Halo $name";
    }
}
