<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;


class ContactController extends Controller
{
    public function showContact() {
        return view('newpages.newcontact');
    }

    public function submitContact(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'message' => 'required|string',
        ]);

        Mail::send([], [], function ($message) use ($request) {
            $message->to('rnettleford@gmail.com')
                ->subject('Contact Form Submission')
                ->from($request->email, $request->name)
                ->html(
                    '<p><strong>Name:</strong> ' . e($request->name) . '</p>'
                    . '<p><strong>Email:</strong> ' . e($request->email) . '</p>'
                    . '<p><strong>Phone:</strong> ' . e($request->phone) . '</p>'
                    . '<p><strong>Message:</strong><br>' . nl2br(e($request->message)) . '</p>'
                );
        });

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }
}

