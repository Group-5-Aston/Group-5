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
    $basket = session()->get('basket', []);

    


    $subtotal = collect($basket)->sum(fn($item) => $item['price'] * $item['quantity']);
    $shipping = 4.99; // Example shipping cost
    $vat = 2.00; // Example VAT
    $total = $subtotal + $shipping + $vat;

    return view('checkout.index', compact('basket', 'subtotal', 'shipping', 'vat', 'total'));
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
        
                session()->forget('basket'); // Clear the basket after the order is placed
                DB::commit();
        
                return redirect()->route('home')->with('success', 'Order placed successfully!');
            } catch (\Exception $e) {
                DB::rollBack();
                \Log::error('Order processing error: ' . $e->getMessage());
        
                return redirect()->route('checkout.index')->with('error', 'Something went wrong. Please try again.');
            }
        }
        

}