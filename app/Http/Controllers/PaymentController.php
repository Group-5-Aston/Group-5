<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function prepareOrder(Request $request)
    {

        //Get necessary order data
        $basket = auth()->user()->basket;
        $basketItems = auth()->user()->basket->items;
        $address = $request->input('address');
        $shipping = $basket->total < 30.01;

        //Store the data for order
        session(
            [
                'pending order' => [
                    //Order data
                    'user_id' => auth()->id(),
                    'total' => $basket->total,
                    'shipping' => $shipping,
                    'address' => $address,
                ]
            ]
        );
        return redirect()->route('payment.index');
    }

    public function index()
    {
        return view('payment.index');
    }

    public function process(Request $request)
    {
        //validates the card details
        $request->validate([
            'card_number' => ['required', 'digits:16', 'numeric'],
            'expiry_date' => [
                'required',
                'regex:/^(0[1-9]|1[0-2])\/\d{2}$/',
                //Function to make sire expiry date is valid
                function ($attribute, $value, $fail) {
                    [$month, $year] = explode('/', $value);

                    $year = '20' . $year;

                    $expiryDate = Carbon::create($year, $month)->endOfMonth();

                    if ($expiryDate->isPast()) {
                        $fail('Invalid expiry date');
                    }
                }
            ],
            'cvv' => ['required', 'digits_between:3,4', 'numeric']
        ]);

        $basket = auth()->user()->basket;

        //Checks if all items in the basket have enough stock
        foreach ($basket->items as $item) {
            if (!$item->stockCheck()) {
                return redirect()->route('basket.index')->with('error', 'Not enough stock for ' . $item->productOption->product->name . '. Only ' . $item->productOption->stock . 'left!');
            }
        }

        //Fetch the Order info, returns if there is no order data
        $data = session('pending order', []);

        if (empty($data)) {
            return back()->with('error', 'No pending order found.');
        }

        //Creates the order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $data['total'],
            'shipping' => $data['shipping'],
            'address' => $data['address'],
        ]);

        //Creates the Order Items
        foreach ($basket->items as $item) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'option_id' => $item->option_id,
                'name' => $item->productOption->product->name,
                'image' => $item->productOption->product->image,
                'size' => $item->productOption->size,
                'flavor' => $item->productOption->flavor,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total' => $item->quantity * $item->price,
            ]);
        }

        //Reduces stock
        foreach ($basket->items as $item) {
            $item->productOption->decrement('stock', $item->quantity);
        }

        //Delete the basket so the user can shop again
        $basket->delete();
        return redirect()->route('basket.index')->with('success', 'Payment processed successfully! Order has been placed!');
    }
}
