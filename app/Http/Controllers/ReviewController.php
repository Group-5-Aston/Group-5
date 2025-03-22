<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //Gets the users review for a product using the orderitem
    private function thisReview(OrderItem $orderItem)
    {
        return auth()->user()->reviews()->where('product_id', $orderItem->productOption->product->product_id)->first();
    }
    public function index(OrderItem $orderItem) {
        //If user has reviewed this product before, pass the review along.
        $review = $this->thisReview($orderItem) ?? null;
        return view('newpages.review', compact('orderItem', 'review'));
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

        return redirect()->route('order.index')->with('success', 'Review submitted successfully!');
    }

    public function destroy(OrderItem $orderItem)
    {
        $review = $this->thisReview($orderItem);
        $review->delete();
        return redirect()->route('order.index')->with('success', 'Review deleted successfully!');
    }

    public function update(Request $request, OrderItem $orderItem)
    {
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'reviews' => 'required|string'
        ]);

        $review = $this->thisReview($orderItem);
        $review->update([
            'rating' => $data['rating'],
            'review' => $data['reviews'],
        ]);

        return redirect()->route('order.index')->with('success', 'Review updated successfully!');
    }
}
