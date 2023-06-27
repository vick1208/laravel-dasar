<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request): string
    {
        $request->session()->put("userName", "EkoKhan");
        $request->session()->put("isMember", true);
        return "Ok";
    }
    public function getSession(Request $request): string
    {
        $user  = $request->session()->get("userName", "guest");
        $isMem = $request->session()->get("isMember", "false");
        return "User Name: {$user},Is Member: {$isMem}";
    }
}
