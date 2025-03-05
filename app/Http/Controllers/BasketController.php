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
    // Get this user’s Basket model, eager-load basket items
    $basket = auth()->user()
        ->basket()
        ->with('items.productOption.product')
        ->first();

    // If the user doesn't have a basket yet, you might want to create it or just pass null
    // Example: create one if not exists:
    if (!$basket) {
        $basket = auth()->user()->basket()->create([
            'user_id' => auth()->id(),
            'total'   => 0.00,
        ]);
    }

    // Optionally calculate totals here OR you can do it in the Blade
    // For example:
    $subtotal = 0;
    foreach ($basket->items as $item) {
        $subtotal += $item->quantity * $item->price;
    }
    $shipping = 4.99;
    $vat = 2.00;
    $total = $subtotal + $shipping + $vat;

    return view('basket.index', compact('basket', 'subtotal', 'shipping', 'vat', 'total'));
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


    public function removeItem($bitem_id)
    {
        $basketItem = BasketItem::where('bitem_id', $bitem_id)
            ->whereHas('basket', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->first();

        if (!$basketItem) {
            return redirect()->route('basket.index')->with('error', 'Item not found.');
        }

        // Decrement the quantity by 1
        $basketItem->quantity -= 1;

        // If quantity hits 0, remove the row entirely
        if ($basketItem->quantity <= 0) {
            $basketItem->delete();
        } else {
            // Update the row's total if you store per-item total
            $basketItem->total = $basketItem->quantity * $basketItem->price;
            $basketItem->save();
        }

        // Optionally recalc the Basket total if needed
        $basket = auth()->user()->basket;
        $basket->total = $basket->items->sum('total');
        $basket->save();

        return redirect()->route('basket.index')->with('success', 'Item quantity updated.');
    }








}
