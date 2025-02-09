<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function adminCustomers() {
        $users = User::all();

        return view('newpages.newadminpages.admincustomers', compact('users'));
    }
}
