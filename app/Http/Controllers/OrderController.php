<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
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

    public function returnForm(OrderItem $orderItem) {
        return view('newpages.returnitem', compact('orderItem'));
    }

    public function createReturn(Request $request, OrderItem $orderItem) {

        return redirect()->route('order.return.address');
    }

    public function returnAddress() {
        return view('newpages.returnaddress');
    }

}
