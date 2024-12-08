<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasketController extends Controller
{
    // Show the basket page
    public function index()
{
    // Retrieve the basket from the session, or use a default basket if not set
    $basket = session()->get('basket', []);
    return view('basket.index', compact('basket'));

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

public function addToBasket(Request $request)
{
    
    // Retrieve the current basket from the session
    $basket = session()->get('basket', []);
    
    // Create a new product array
    $product = [
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'quantity' => $request->input('quantity'),
        'image' => $request->input('image'),
        'size' => $request->input('size', null),
        'flavor' => $request->input('flavor', null),
        'psize' => $request->input('psize', null)

    ];

    $exists = false;
    foreach ($basket as &$item) {
        if ($item['name'] == $product['name']) {
            $item['quantity'] += $product['quantity']; // Increment quantity
            $exists = true;
            break;
        }
    }

    // If the product does not exist, add it to the basket
    if (!$exists) {
        $basket[] = $product;
    }

    // Store the updated basket in the session
    session()->put('basket', $basket);

    // Redirect back to the product page or basket page
    return redirect()->route('basket.index')->with('success', 'Item added to basket');

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