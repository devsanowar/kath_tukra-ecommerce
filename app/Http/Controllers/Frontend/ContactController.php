<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactStoreRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contact()
    {
        return view('website.layouts.contact');
    }


    public function contactForm(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'subject' => 'required|string|max:100',
            'message' => 'required|string|max:1000',
        ]);


        Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('contact_message', 'Message sent successfully!');

    }
}
