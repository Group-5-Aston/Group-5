<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasketController extends Controller
{
    // Show the basket page
    public function index()
{
    // Retrieve the basket from the session, or use a default basket if not set
    $basket = session()->get('basket', [
        ['name' => 'Cat Bed', 'price' => 16.99, 'quantity' => 1, 'image' => 'images/cat bed.webp'],
        ['name' => 'Luxury Dog Collar', 'price' => 32.00, 'quantity' => 1, 'image' => 'images/dog collar.jpg'],
        ['name' => 'Cat Tower', 'price' => 70.00, 'quantity' => 1, 'image' => 'images/cat tower.jpg'],
    ]);

     // If basket is empty, redirect or show a message
     if (empty($basket)) {
        return view('basket.index', ['message' => 'Your basket is empty.']);
    }

    // Calculate the subtotal
    $subtotal = 0;
    foreach ($basket as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }

    // Example shipping cost and VAT
    $shipping = 4.99;
    $vat = 2.00;

    // Calculate the total
    $total = $subtotal + $shipping + $vat;

    // Pass data to the view
    return view('basket.index', compact('basket', 'subtotal', 'shipping', 'vat', 'total'));
}

public function remove($index)
{
    // Retrieve the basket from the session
    $basket = session()->get('basket', []);

    // Check if the basket is empty or the index doesn't exist
    if (empty($basket)) {
        return redirect()->route('basket.index')->with('error', 'Your basket is empty.');
    }

    if (!isset($basket[$index])) {
        return redirect()->route('basket.index')->with('error', 'Item not found.');
    }

    // Remove the item from the basket
    unset($basket[$index]);

    // Reindex the array and update the session
    $basket = array_values($basket);
    session()->put('basket', $basket);


    // Redirect with a success message
    return redirect()->route('basket.index')->with('success', 'Item removed from the basket.');
}


}