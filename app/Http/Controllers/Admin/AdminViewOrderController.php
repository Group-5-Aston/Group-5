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

    //Updates the order message
    public function updateMessage(Order $order, Request $request) {
        $validate = $request->validate([
            'message' => ['required', 'string'],
        ]);

        $order->update($validate);
        return redirect()->route('adminorder.show', $order)->with('success', 'Message updated.');
    }

    public function process(Order $order) {
        $order->update([
            'status' => 'complete',
            'delivered_at' => now()]);
        return redirect()->route('adminorder.show', $order)->with('success', 'Order dispatched.');
    }

    public function cancel(Order $order) {
        if($order->status != 'pending') {
            return redirect()->route('adminorder.show', $order)->with('error', 'Can not cancel an active order');
        }
        $order->update(['status' => 'cancelled']);
        return redirect()->route('adminorder.show', $order)->with('success', 'Order cancelled.');
    }

    public function confirmRefund(ReturnItem $returnItem) {
        if($returnItem->status != 'returned') {
            return redirect()->route('adminorder.show', $returnItem)->with('error', 'Order must be returned to confirm refund.');
        }
        $returnItem->update(['status' => 'refunded']);

        $order = $returnItem->order;



        return redirect()->route('adminorder.show', $order)->with('success', 'Item refunded. Please update stock levels if item in condition for resale.');
    }

    public function rejectRefund(ReturnItem $returnItem) {
        if($returnItem->status != 'returned') {
            return redirect()->route('adminorder.show', $returnItem)->with('error', 'Order must be returned to reject refund.');
        }
        $returnItem->update(['status' => 'rejected']);

        $order = $returnItem->order;

        return redirect()->route('adminorder.show', $order)->with('success', 'Order rejected.');
    }
}
