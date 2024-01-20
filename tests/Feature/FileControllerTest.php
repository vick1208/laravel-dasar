<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileControllerTest extends TestCase
{

    public function testUpload(){
// uncomment extension gd
        $picture = UploadedFile::fake()->image('vic.png');

        $this->post('/file/upload',[
            'picture' => $picture
        ])->assertSeeText("OK vic.png");

    }
}
