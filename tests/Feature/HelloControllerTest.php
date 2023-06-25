<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    public function testHello()
    {
        $this->get('/control/hello/Eko')
            ->assertSeeText("Halo Eko");
    }
    public function testRequest()
    {
        $this->get('/control/hello/request', [
            "Accept" => "plain/text"
        ])->assertSeeText("control/hello/request")
            ->assertSeeText("http://localhost/control/hello/request")
            ->assertSeeText("GET")
            ->assertSeeText("plain/text");
    }

}
