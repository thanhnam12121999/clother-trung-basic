<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signIn()
    {
        return view('user.auth.sign-in');
    }

    public function signUp()
    {
        return view('user.auth.sign-up');
    }
}
