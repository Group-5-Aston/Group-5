<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Display the checkout page with basket data
    public function index()
{
    // Get the basket data from the session
    $basket = auth()->user()->basket;

    if ($basket->total < '30.01') {
        $shipping = 4.99;
        $subtotal = ($basket->total) / 1.20;
        $vat = (($basket->total) * 0.20) / 1.20;
        $total = $basket->total + $shipping;
    } else {
        $shipping = 0;
        $subtotal = ($basket->total) / 1.20;
        $vat = (($basket->total) * 0.20) / 1.20;
        $total = $basket->total;
    }

    $basketItems = $basket->items;

    return view('checkout.index', compact('basket', 'subtotal', 'shipping', 'vat', 'total', 'basketItems'));
}


    // Process the order and checkout
    public function process(Request $request)
    {
        $basket = session()->get('basket', []);

        if (empty($basket)) {
            return redirect()->route('checkout.index')->with('error', 'Your basket is empty.');
        }

        // Validate the total
        $request->validate([
            'total' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $request->input('total'),
            ]);

            // Loop through the basket and create order items
            foreach ($basket as $item) {
                // You need to adjust this part depending on your actual basket data
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_name' => $item['name'], // assuming you store the product name in basket
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            session()->forget('basket');
            DB::commit();

            return redirect()->route('home')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Order processing error: ' . $e->getMessage());

            return redirect()->route('checkout.index')->with('error', 'Something went wrong. Please try again.');
        }
    }


}
