<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if there are items in the cart (typically stored in session)
        if (!session()->has('cart') || count(session('cart')) === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Please add items before proceeding.');
        }

        return $next($request);
    }
}
