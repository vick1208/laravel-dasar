<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')
        ->assertStatus(200)
        ->assertSeeText("Hello response");
    }
    public function testHeader(){
        $this->get('/response/header')->assertStatus(200)
        ->assertSeeText('Vicky')->assertSeeText('Susanto')
        ->assertHeader('Content-Type', 'application/json')
        ->assertHeader('Author', 'Programmer Zaman Now')
        ->assertHeader('App', 'Pelajaran Laravel Dasar');
    }
    public function testView()
    {
        $this->get('/response/type/view')
            ->assertSeeText("Hello Vicky");
    }

    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertJson([
                "firstName" => 'Vicky',
                "lastName" => "Susanto"
            ]);
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', "image/jpeg");
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('reddit-june.jpg');
    }
}
