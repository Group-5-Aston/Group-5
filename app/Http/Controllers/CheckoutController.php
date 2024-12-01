<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Display the checkout page with cart data
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        return view('checkout.index', compact('cart', 'total'));
    }

    // Process the order and checkout
    public function process(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('checkout.index')->with('error', 'Your cart is empty.');
        }

        // Begin a transaction to place the order
        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $request->input('total'),
            ]);

            // Save each item in the order
            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            // Clear the cart session after placing the order
            session()->forget('cart');

            // Commit the transaction
            DB::commit();

            return redirect()->route('home')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            return redirect()->route('checkout.index')->with('error', 'Something went wrong. Please try again.');
        }
    }
}
