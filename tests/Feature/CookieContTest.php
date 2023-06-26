<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieContTest extends TestCase
{
   public function testCreateCookie(){
    $this->get('/cookie/set')->assertSeeText('Hello COOKIE')
    ->assertCookie('User-Id',"Vicky")->assertCookie('Is-Member',"true");
   }
   public function testGetCookie(){
      $this->withCookie("User-Id","Vicky")
      ->withCookie("Is-Member","true")
      ->get('/cookie/get')
      ->assertJson([
         "userId" => "Vicky",
         "isMember" => "true"
      ]);
   }
}
