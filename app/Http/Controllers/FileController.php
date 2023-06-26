<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request): string
    {
        $pic = $request->file('picture');

        $pic->storePubliclyAs("pics", $pic->getClientOriginalName(), "public");

        return "OK " . $pic->getClientOriginalName();
    }
}
