<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ReturnItem;

class AdminHomeController extends Controller
{
    //Passes queries for the multiple tables as well as all notifications for user
    public function home() {
        $lowStockOptions = ProductOption::where('stock', '<', 10)->get();
        $pendingOrders = Order::where('status', 'pending')->orderBy('created_at', 'desc')->get();
        $pendingReturns = ReturnItem::where('status', 'returned')->orderBy('updated_at', 'desc')->get();
        $notifications = auth()->user()->notifications()->whereNull('read_at')->orderBy('created_at', 'desc')->get();
        return view('newpages.newadminpages.adminhome'
            , compact('lowStockOptions'
                , 'pendingOrders'
                , 'pendingReturns'
                , 'notifications'
            ));
    }
}
