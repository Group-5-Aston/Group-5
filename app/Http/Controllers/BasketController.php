<?php

namespace App\Http\Controllers;

use App\Models\BasketItem;
use App\Models\ProductOption;
use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
class BasketController extends Controller
{
    // Show the basket page
    public function index()
    {
        // Fetch the user's basket
        $basket = auth()->user()->basket;

        if ($basket) {
            // Fetch basket items associated with this basket
            $basketItems = $basket->items;
        } else {
            $basketItems = collect(); // Empty collection if no basket exists
        }
        return view('basket.index', compact('basket', 'basketItems'));
    }




    public function addToBasket(Request $request, Product $product)
    {

        //Validates the form request (Adding product to basket)
        $data = $request->validate([
            'quantity' => 'required|integer',
            'size' => ['nullable', 'string', 'max:255',],
            'flavor' => ['nullable', 'string', 'max:255',],
        ]);

        /* Sets $basket to the basket entry for this user in the
        Baskets table, if the entry doesn't exist then makes one */
        $basket = auth()->user()->basket;

        if (!$basket) {
            $basket = auth()->user()->basket()->create([
                'user_id' => auth()->id(),
                'total' => 0.00,
            ]);
        }

        /* Fetches the Product Option from the request data, then stores
        the Product option ID for later use */
        $queryOption = ProductOption::where('product_id', $product->product_id);

        if (isset($data['size'])) {
            $queryOption->where('size', $data['size']);
        } else {
            $queryOption->whereNull('size');
        }

        if (isset($data['flavor'])) {
            $queryOption->where('flavor', $data['flavor']);
        } else {
            $queryOption->whereNull('flavor');
        }

        $optionId = $queryOption->first()->option_id;

        /* Creates the data for the Basket Item from the Request, the Product
        and the Product option */
        $basketItemData = [
            'basket_id' => $basket->basket_id,
            'option_id' => $optionId,
            'quantity' => $data['quantity'],
            'price' =>  $product->price,
            'total' => $product->price * $data['quantity'],
        ];

        /* Sets $basketItem to the Basket item with that matches the Product
        item and the users current basket, if it exists */
        $basketItem = BasketItem::where('option_id', $optionId)
            ->where('basket_id', $basket->basket_id)
            ->first();

        /* If the $basketItem exists, instead of adding the same item to basket,
        increase its quantity as long as it doesn't exceed stock levels.
        If it doesn't exist create the Basket item as long as it doesn't exceed
        stock levels*/

        $optionStock = ProductOption::where('option_id', $optionId)->first()->stock;

        if ($basketItem) {
            $existingItem = $basketItem->first();

            if(($data['quantity'] + $basketItem->first()->quantity) <= $optionStock ) {
                $basketItem->increment('quantity', $data['quantity']);
                $newQuantity = $existingItem->quantity + $data['quantity'];
                $basketItem->update(['total' => $newQuantity * $existingItem->price]);
            } else {
                return redirect()->back()->with('error', 'Quantity exceeds stock');
            }
        } else {
            if ($data['quantity'] <= $optionStock) {
                BasketItem::create($basketItemData);
            } else {
                return redirect()->back()->with('error', 'Quantity exceeds stock');
            }

        }

        //Update the total of the basket by adding all Basket item totals
        $basket->total = BasketItem::where('basket_id', $basket->basket_id)->sum('total');
        $basket->save();

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
