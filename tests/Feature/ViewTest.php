<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testViews()
    {
        $this->get('/awesome')->assertSeeText('Hello Eko');
        $this->get('/hello')->assertSeeText('Hello Eko');
    }
    public function testNested()
    {
        $this->get('/home')->assertSeeText('World Eko');
        
    }

    public function testViewWithoutRoute()
    {
        $this->view('hello',['name'=>'Eko'])->assertSeeText('Hello Eko');
        $this->view('home.world',['name'=>'Vicky'])->assertSeeText('World Vicky');
    }
}
