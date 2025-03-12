<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request, $product_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'reviews' => 'required|string'
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $product_id,
            'rating' => $request->rating,
            'review' => $request->reviews,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }
}
