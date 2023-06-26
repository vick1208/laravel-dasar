<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerateTest extends TestCase
{
    public function testUrlCurrent()
    {
        $this->get('/url/current?name=Kuta')
            ->assertSeeText("/url/current?name=Kuta");
    }

    public function testNamed()
    {
        $this->get('/redirect/named')
            ->assertSeeText("/redirect/name/Eko");
    }

    public function testAction()
    {
        $this->get('/url/action')
            ->assertSeeText("/form");
    }

}
