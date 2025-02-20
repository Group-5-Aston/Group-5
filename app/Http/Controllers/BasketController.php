<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
class BasketController extends Controller
{
    // Show the basket page
    public function index()
    {
        // Retrieve the basket from the session, or use a default basket if not set
        $basket = session()->get('basket', []);

        // Debugging basket data

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

        session()->put('basket', $basket);

        // Get all products
        $products = Product::all();

        // Debugging products data

        // Pass data to the view
        return view('basket.index', compact('basket', 'subtotal', 'shipping', 'vat', 'total', 'products'));
    }


    public function addToBasket(Request $request, Product $product)
    {
    if ($product === null) {
        dd("Product not found with ID: " . $product_id);
    }

    $quantity = (int) $request->input('quantity', 1);
    $flavor = $request->input('flavor'); // Retrieve flavor
    $size = $request->input('size', null); // Retrieve size
    $name = $request->input('name', null);
    //$psize = $request->input('psize', null); // Retrieve product size

    // Get additional values from the request
    $subtotal = $request->input('subtotal');
    $shipping = $request->input('shipping');
    $vat = $request->input('vat');
    $total = $request->input('total');


    // Store product details in the session (price, image, etc.)
    $basket = session()->get('basket', []);
    $exists = false;

    foreach ($basket as &$item) {
        if ($item['product_id'] == $product->product_id && $item['flavor'] == $flavor && $item['size'] == $size) {
            $item['quantity'] += $quantity; // Update quantity if product is already in the basket
            $exists = true;
            break;
        }
    }


    if (!$exists) {
        $basket[] = [
            'product_id' => $product->product_id,
            'quantity' => $quantity,
            'name' => $product->name,
            'price' => $product->price, // This will stay in the session, not the database
            'image' => Storage::url($product->image), // Assuming the image column in the product table
            'flavor' => $flavor, // Add flavor to the session
            //'psize' => $psize, // Store psize if necessary
            'size' => $size, // Store size if necessary
        ];
    }

    $subtotal = 0;
    foreach ($basket as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }

    $shipping = 4.99; // Example shipping cost
    $vat = 2.00; // Example VAT
    $total = $subtotal + $shipping + $vat;

    // Update the session with the new basket
    session()->put('basket', $basket);


    // Only insert product_id and quantity into the database
    Basket::create([
        'product_id' => $product->product_id,
        'name' => $name,
        'quantity' => $quantity,
        'flavor' => $flavor,  // Store flavor in DB
        'size' => $size,      // Store size in DB
        //'psize' => $psize,    // Store psize in DB
        'total' => $total,
        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'vat' => $total,
    ]);


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

    // Ensure the index exists before proceeding
    if (!isset($basket[$index])) {
        return redirect()->route('basket.index')->with('error', 'Item not found.');
    }

    // Retrieve the product_id from the session item to remove it from the database
    $product_id = $basket[$index]['product_id'];
    $quantity = $basket[$index]['quantity'];

    // Remove the item from the session
    unset($basket[$index]);
    $basket = array_values($basket); // Reindex the array

    // Update the session
    session()->put('basket', $basket);

    // Remove the item from the database
    Basket::where('product_id', $product_id)
        ->where('quantity', $quantity)
        ->delete();

    // Redirect with a success message
    return redirect()->route('basket.index')->with('success', 'Item removed from the basket.');
}




}
