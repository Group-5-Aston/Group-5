<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ReturnItem;

class HomeController extends Controller
{
    public function index() {
            $lowStockOptions = ProductOption::where('stock', '<', 10)->get();
            $pendingOrders = Order::where('status', 'pending')->orderBy('created_at', 'desc')->get();
            $pendingReturns = ReturnItem::where('status', 'returned')->orderBy('updated_at', 'desc')->get();
            $notifications = auth()->user()->notifications()->whereNull('read_at')->orderBy('created_at', 'desc')->get();
            return view('admin.index'
                , compact('lowStockOptions'
                    , 'pendingOrders'
                    , 'pendingReturns'
                    , 'notifications'
                ));
            
    }

    public function home() {
        return view('newpages.newhome');
    }
}
