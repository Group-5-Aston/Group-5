<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\User;


class AdminProfileController extends Controller
{
    //Takes the userID from the route and inputs it here as the parameter, opening a page with that users details
  public function showUser(User $user)
  {
      return view('newpages.newadminpages.admineditcustomers', compact('user'));
  }

    public function update(AdminUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()->route('profile.show', $user)->with('status', 'User updated successfully');
    }
}





