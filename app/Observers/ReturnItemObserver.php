<?php

namespace App\Observers;

use App\Models\ReturnItem;
use App\Models\User;
use App\Notifications\PendingReturnNotification;
use Illuminate\Support\Facades\Notification;


class ReturnItemObserver
{
    /*
     *
     */
    public function updated(ReturnItem $returnItem)
    {
        if($returnItem->status == 'returned') {
            $admins = User::where('usertype', 'admin')->get();
            Notification::send($admins, new PendingReturnNotification($returnItem));
        }
    }
}
