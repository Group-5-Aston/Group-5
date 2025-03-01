<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ReturnItem;

class AdminHomeController extends Controller
{
    public function home() {
        $lowStockOptions = ProductOption::where('stock', '<', 10)->get();
        $pendingOrders = Order::where('status', 'pending')->get();
        $pendingReturns = ReturnItem::where('status', 'returned')->get();
        return view('newpages.newadminpages.adminhome', compact('lowStockOptions', 'pendingOrders', 'pendingReturns'));
    }
}
