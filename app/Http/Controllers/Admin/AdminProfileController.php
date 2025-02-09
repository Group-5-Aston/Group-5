<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;


class AdminProfileController extends Controller
{
  public function showUser($id)
  {
      $user = User::findOrFail($id);
      return view('profile.show', compact('user'));
  }
}



