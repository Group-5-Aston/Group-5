<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\Storage;


Class  AdminViewOrderController extends Controller
{
    //Redirects to the order view page and passes along price data
    public function showOrder(Order $order)
    {
        $orderItems = $order->orderItems;

        if ($order->shipping == '1') {
            $shipping = 4.99;
            $subtotal = ($order->total - $shipping) / 1.20;
            $vat = (($order->total - $shipping) * 0.20) / 1.20;
        } else {
            $shipping = 0;
            $subtotal = ($order->total) / 1.20;
            $vat = (($order->total) * 0.20) / 1.20;
        }
        return view('newpages.newadminpages.adminvieworder', compact('order', 'orderItems', 'shipping', 'subtotal', 'vat'));
    }

    public function updateMessage(Order $order, Request $request) {
        $validate = $request->validate([
            'message' => ['required', 'string'],
        ]);

        $order->update($validate);
        return redirect()->back()->with('success', 'Message updated.');
    }

    public function process(Order $order) {
        $order->update(['status' => 'dispatched']);
        return redirect()->back()->with('success', 'Order dispatched.');
    }

    public function cancel(Order $order) {
        $order->update(['status' => 'cancelled']);
        return redirect()->back()->with('success', 'Order cancelled.');
    }
}
