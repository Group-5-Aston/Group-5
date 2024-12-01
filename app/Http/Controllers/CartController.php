<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Display the contents of the cart
    public function index()
    {
        // Get the cart from the session or an empty array if no cart exists
        $cart = session()->get('cart', []);

        // Calculate the total price of items in the cart
        $total = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        // Return the cart view with cart items and total price
        return view('cart.index', compact('cart', 'total'));
    }

    // Add an item to the cart
    public function add(Request $request, $productId)
    {
        // Validate incoming request
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        // Check if the product already exists in the cart
        if (isset($cart[$productId])) {
            // If it exists, update the quantity
            $cart[$productId]['quantity'] += $validated['quantity'];
        } else {
            // If it doesn't exist, add it to the cart
            $cart[$productId] = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'quantity' => $validated['quantity'],
            ];
        }

        // Save the cart back to the session
        session()->put('cart', $cart);

        // Redirect to cart index with a success message
        return redirect()->route('cart.index')->with('success', 'Item added to cart');
    }

    // Update the quantity of an item in the cart
    public function update(Request $request, $productId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Get the cart from the session
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            // Update the quantity of the product in the cart
            $cart[$productId]['quantity'] = $validated['quantity'];

            // Save the updated cart back to the session
            session()->put('cart', $cart);

            return redirect()->route('cart.index')->with('success', 'Cart updated successfully');
        }

        return redirect()->route('cart.index')->with('error', 'Item not found in cart');
    }

    // Remove an item from the cart
    public function remove($productId)
    {
        // Get the cart from the session
        $cart = session()->get('cart', []);

        // Check if the product exists in the cart
        if (isset($cart[$productId])) {
            // Remove the item from the cart
            unset($cart[$productId]);

            // Save the updated cart back to the session
            session()->put('cart', $cart);

            return redirect()->route('cart.index')->with('success', 'Item removed from cart');
        }

        return redirect()->route('cart.index')->with('error', 'Item not found in cart');
    }

    // Clear all items in the cart
    public function clear()
    {
        // Remove all items from the cart
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Cart cleared');
    }
}
