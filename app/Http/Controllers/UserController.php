<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserController extends Controller
{
    //Returns the name of the user if logged in, returns 'Log In' otherwise
    public function userNameOrGuest() {

    }

    public function basket()
{
    return $this->hasOne(Basket::class);
}

}
