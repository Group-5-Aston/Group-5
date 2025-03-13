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
        if ($order->status != 'pending') {
            return back()->withErrors('You cannot cancel an order that is already on the way');
        }

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

        //Make sure the User can't return more than they've ordered.
        $totalOrdered = $orderItem->quantity;
        $alreadyReturned = ReturnItem::where('order_item_id', $orderItem->order_item_id)->sum('quantity');
        $remainingQuantity = $totalOrdered - $alreadyReturned;

        if ($data['quantity'] > $remainingQuantity) {
            return back()->withErrors(['quantity' => 'You can only return up to ' . $remainingQuantity . ' item(s).']);
        }

        ReturnItem::create([
            'order_id' => $orderItem->order->order_id,
            'order_item_id' => $orderItem->order_item_id,
            'reason' => $data['reason'],
            'quantity' => $data['quantity'],
            'total' => ($data['quantity']*$orderItem->price),
            'status' => 'returned'
        ]);
        return redirect()->route('order.return.address');
    }

    public function returnAddress() {
        return view('newpages.returnaddress');
    }

}
