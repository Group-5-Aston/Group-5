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
            return response()->json([
                'users' => $users->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'usertype' => $user->usertype,
                        'phone' => $user->phone,
                        'address' => $user->address,
                        'created_at' => $user->created_at->format('Y-m-d H:i:s'),
                        'updated_at' => $user->updated_at->format('Y-m-d H:i:s'),
                        'profile_url' => route('profile.show', $user->id)
                    ];
                })
            ]);
        }

        return view('newpages.newadminpages.admincustomers', compact('users'));
    }
}


