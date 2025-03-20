<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(OrderItem $orderItem) {
        return view('newpages.review', compact('orderItem'));
    }

    public function store(Request $request, OrderItem $orderItem)
    {

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'reviews' => 'required|string'
        ]);

        $product = $orderItem->productOption->product;

        //Prevent reviewing product that no longer exists
        if(!$product) {
            return back()->with('error', 'That product no longer exists');
        }

        //Prevent reviewing product that the user has never bought
        if(!Auth::user()->orderItems()->where('option_id', $orderItem->productOption->option_id)->exists()) {
            return back()->with('error', 'You have never ordered this product');
        }

        if(Auth::user()->reviews()->where('product_id', $product->product_id)->exists()) {
            return back()->with('error', 'You have already reviewed this product');
        }

        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $product->product_id,
            'rating' => $request->rating,
            'review' => $request->reviews,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }
}
