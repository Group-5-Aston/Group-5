<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ReturnItem;
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

    public function returnForm(OrderItem $orderItem, Order $order) {
        return view('newpages.returnitem', compact('orderItem', 'order'));
    }

    public function createReturn(Request $request, OrderItem $orderItem) {
        $data = $request->validate([
            'quantity' => 'required|numeric|min:1',
            'reason' => 'required|string|max:1000',
        ]);

        $order = $orderItem->order;

        ReturnItem::create([
            'order_id' => $order->order_id,
            'order_item_id' => $orderItem->order_item_id,
            'reason' => $data['reason'],
            'quantity' => $data['quantity'],
            'total' => ($data['quantity']*$orderItem->price),
        ]);
        return redirect()->route('order.return.address');
    }

    public function returnAddress() {
        return view('newpages.returnaddress');
    }

}
