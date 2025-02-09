<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;


class AdminProfileController extends Controller
{
    //Takes the userID from the route and inputs it here as the parameter, opening a page with that users details
  public function showUser($id)
  {
      $user = User::findOrFail($id);
      return view('newpages.newadminpages.admineditcustomers', compact('user'));
  }
}



