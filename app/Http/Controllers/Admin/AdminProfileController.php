<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class AdminProfileController extends Controller
{
    //Takes the userID from the route and inputs it here as the parameter, opening a page with that users details
    public function showUser(User $user)
    {
        return view('newpages.newadminpages.admineditcustomers', compact('user'));
    }
    //Updates user details from admin.
    public function update(AdminUpdateRequest $request, User $user)
    {
        if ($user->usertype == 'admin') {
            return redirect()->route('profile.show', $user)->withErrors('You cannot edit another admin');
        }
        $user->update($request->validated());

        return redirect()->route('profile.show', $user)->with('status', 'User updated successfully');
    }

    //Deletes the user from the database.
    public function destroy(User $user)
    {
        //Cannot delete if the user in an admin or has an active return or order
        if($user->usertype === 'admin') {
            return redirect()->route('profile.show', $user)->withErrors('You cannot delete another admin.');
        } else if ($user->returnItems()->whereNot('returns.status', 'refunded')->exists()) {
            return redirect()->route('profile.show', $user)->withErrors('You cannot delete a user with an active return.');
        } else if ($user->order()->whereNot('Orders.status', 'complete')->exists()) {
            return redirect()->route('profile.show', $user)->withErrors('You cannot delete a user with an active order.');
        }
            $user->delete();
        return redirect()->route('admin.customers')->with('success', 'User deleted successfully');
    }
}





