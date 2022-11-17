<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signIn()
    {
        return view('signIn');
    }

    public function signUp()
    {
        return view('signUp');
    }
}
