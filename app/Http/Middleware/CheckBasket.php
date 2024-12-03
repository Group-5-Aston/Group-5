<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBasket
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
        // Check if there are items in the basket (typically stored in session)
        if (!session()->has('basket') || count(session('basket')) === 0) {
            return redirect()->route('basket.index')->with('error', 'Your basket is empty. Please add items before proceeding.');
        }

        return $next($request);
    }
}
