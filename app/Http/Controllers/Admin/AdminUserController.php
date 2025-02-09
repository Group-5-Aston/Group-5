<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class AdminUserController extends Controller
{
    public function adminCustomers(Request $request) {
        $search = $request->input('search');
        $users = User::query();

        if (!empty($search)) {
            $users->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('usertype', 'like', "%$search%");
        }

        $users = $users->get();

        if ($request->ajax()) {
            return response()->json(['users' => $users]);
        }

        return view('newpages.newadminpages.admincustomers', compact('users'));
    }
}


