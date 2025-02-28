<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ReturnItem;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\Storage;


Class  AdminViewOrderController extends Controller
{
    //Redirects to the order view page and passes along price data
    public function showOrder(Order $order)
    {
        $orderItems = $order->orderItems;
        $returnItems = $order->returnItems;

        if ($order->shipping == '1') {
            $shipping = 4.99;
            $subtotal = ($order->total - $shipping) / 1.20;
            $vat = (($order->total - $shipping) * 0.20) / 1.20;
        } else {
            $shipping = 0;
            $subtotal = ($order->total) / 1.20;
            $vat = (($order->total) * 0.20) / 1.20;
        }

        return view('newpages.newadminpages.adminvieworder', compact('order',
            'orderItems',
            'shipping',
            'subtotal',
            'vat',
            'returnItems'
        ));
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

    public function confirmRefund(ReturnItem $returnItem) {
        $returnItem->update(['status' => 'refunded']);
        return redirect()->back()->with('success', 'Item refunded.');

        //Need to make it so it increases stock later
    }

    public function rejectRefund(ReturnItem $returnItem) {
        $returnItem->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Order rejected.');
    }
}
