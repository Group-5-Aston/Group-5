<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = auth()->user()->order;
        return view('newpages.orders', compact('orders'));
    }

    public function cancel(Order $order) {
        $order->update(['status' => 'cancelled']);
        return redirect()->route('order.index')->with('success', 'Order rejected.');

    }
}
