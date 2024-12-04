<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login() {
        return view('newpages.newlogin');
    }

    public function signUp() {
        return view('newpages.newsignup');
    }
}
