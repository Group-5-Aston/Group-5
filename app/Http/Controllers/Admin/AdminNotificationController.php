<?php

namespace App\Http\Controllers\Admin;
class AdminNotificationController
{
    public function destroy($notification) {
        auth()->user()->notifications()->where('id', $notification)->delete();
        return redirect()->back();
    }
}
