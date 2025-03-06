<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function prepareOrder(Request $request)
    {

        //Get necessary order data
        $basket = auth()->user()->basket;
        $basketItems = auth()->user()->basket->items;
        $address = $request->input('address');
        if ($basket->total < 30.01) {
            $shipping = '1';
        } else {
            $shipping = '0';
        }

        //Store the data for order
        session(['pending order' => [
            //Order data
            'user_id' => auth()->id(),
            'total' => $basket->total,
            'shipping' => $shipping,
            'address' => $address,
            ]]
        );
        return redirect()->route('payment.index'); // Display the payment form
    }

    public function index()
    {
        return view('payment.index');
    }

    public function process(Request $request)
    {
        $request->validate([
            'card_number' => ['required', 'digits:16', 'numeric'],
            'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'cvv' => ['required', 'digits_between:3,4', 'numeric']
        ]);

        foreach (auth()->user()->basket->items as $item) {
            if(!$item->stockCheck()) {
                return redirect()->route('basket.index')->with('error', 'Not enough stock for ' . $item->productOption->product->name . '. Only ' . $item->productOption->stock. 'left!');
            }
        }

            $data = session('pending order', []);

        if (empty($data)) {
            return back()->withErrors(['error' => 'No pending order found.']);
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $data['total'],
            'shipping' => $data['shipping'],
            'address' => $data['address'],
        ]);


        foreach (auth()->user()->basket->items as $item) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'option_id' => $item->option_id,
                'name' => $item->productOption->product->name,
                'image' => $item->productOption->product->image,
                'size' => $item->productOption->size,
                'flavor' => $item->productOption->flavor,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total' => $item->quantity * $item->price,
            ]);
        }

        return redirect()->route('payment.index')->with('success', 'Payment processed successfully!');
    }
}
