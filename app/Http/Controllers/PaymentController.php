<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.index'); // Display the payment form
    }

    public function process(Request $request)
    {
        // Simulate payment processing logic
        $paymentStatus = (rand(0, 1) === 1) ? 'success' : 'failure';

        return view('payment.index', compact('paymentStatus')); // Redirect to the same payment page with status
    }
}
