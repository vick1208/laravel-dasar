<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionContTest extends TestCase
{
    public function testCreateSession()
    {
        $this->get('/session/make')
            ->assertSeeText("Ok")
            ->assertSessionHas("userName", "EkoKhan")
            ->assertSessionHas("isMember", true);
    }

    public function testGetSession()
    {
        $this->withSession([
            "userName" => "EkoKhan",
            "isMember" => "true"
        ])->get('/session/get')
            ->assertSeeText("User Name: EkoKhan,Is Member: true");
    }

    public function testGetSessionFailed()
    {
        $this->withSession([])->get('/session/get')
            ->assertSeeText("User Name: guest,Is Member: false");
    }
}
