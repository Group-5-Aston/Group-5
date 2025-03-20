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
        if (!auth()->check()) {
            return redirect()->route('loginpage')->with('error', 'You need to be logged in to view your basket.');
        }

        // Get the authenticated user
        $user = auth()->user();

        // Get this user’s Basket model, eager-load basket items
        $basket = $user->basket()
            ->with('items.productOption.product')
            ->first();

        // If the user doesn't have a basket yet, create one
        if (!$basket) {
            $basket = $user->basket()->create([
                'user_id' => $user->id,
                'total' => 0.00,
            ]);
        }

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
            'price' => $product->price,
            'total' => $product->price * $data['quantity'],
        ];

        /* Sets $basketItem to the Basket item with that matches the Product
        item and the users current basket, if it exists */
        $basketItem = BasketItem::where('option_id', $optionId)
            ->where('basket_id', $basket->basket_id);

        /* If the $basketItem exists, instead of adding the same item to basket,
        increase its quantity as long as it doesn't exceed stock levels.
        If it doesn't exist create the Basket item as long as it doesn't exceed
        stock levels*/

        $optionStock = ProductOption::where('option_id', $optionId)->first()->stock;

        if ($basketItem->exists()) {
            $existingItem = $basketItem->first();

            if (($data['quantity'] + $basketItem->first()->quantity) <= $optionStock) {
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


        /* Old code--
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

    */
    }


    public function removeItem(BasketItem $bitem)
    {

        $bitem->delete();
        $basket = auth()->user()->basket;
        $basket->total = $basket->items->sum('total');
        $basket->save();

        return redirect()->route('basket.index')->with('success', 'Item removed from basket.');
    }

    public function quantity(Request $request, BasketItem $bitem)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer',
        ]);

        $quantity = $validated['quantity'];

        $bitem->update([
            'quantity' => $quantity,
            'total' => $bitem->price * $quantity,
        ]);


        $basket = auth()->user()->basket;
        $basket->total = $basket->items->sum('total');
        $basket->save();

        return redirect()->route('basket.index')->with('success', 'Item quantity updated.');
    }
}
