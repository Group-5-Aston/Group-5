<?php

namespace App\Observers;

use App\Models\ProductOption;
use App\Models\User;
use App\Notifications\NoStockNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LowStockNotification;


class ProductOptionObserver
{
    /*
     * Send a no stock notification if stock = 0, send a low stock notification if
     * the product has less than 10 stock but only once until stocked back to 10 or
     * above.
     */
    public function updated(ProductOption $productOption)
    {
        if($productOption->stock == 0) {
            $admins = User::where('usertype', 'admin')->get();
            Notification::send($admins, new NoStockNotification($productOption));
        } else if ($productOption->stock < 10 && !$productOption->low_stock_notification_sent) {
            $admins = User::where('usertype', 'admin')->get();
            Notification::send($admins, new LowStockNotification($productOption));

            $productOption->update(['low_stock_notification_sent' => true]);

        }
        if ($productOption->stock >= 10 && $productOption->low_stock_notification_sent) {
            $productOption->update(['low_stock_notification_sent' => false]);
        }

    }
}

