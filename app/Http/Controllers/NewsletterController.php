<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->get('email');

        Mail::to($email)->send(new NewsletterEmail($email));

        return back()->with('success', 'Thank you for subscribing! Check your email.');
    }
}
