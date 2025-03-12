<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ControllerReview extends Controller
{
    public function store(Request $request, $product_id)
    {
        $request->validate(['rating' => 'required|integer|min:0| max:5', 'review' => 'nullable|string',]);
        Review::create(['user_id' => Auth::id(), ' product_id' => $product_id, 'rating' => $request->rating, 'review' => $request->review,]);
        return back()->with('review has been submitted');
    }
}
