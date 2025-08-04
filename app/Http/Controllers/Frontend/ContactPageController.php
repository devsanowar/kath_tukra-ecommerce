<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactStoreRequest;
use Brian2694\Toastr\Facades\Toastr;

class ContactPageController extends Controller
{
    public function contactForm(ContactStoreRequest $request)
    {
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        session()->flash('success', 'Thank you! Your message has been sent.');

        return Redirect()->back();

    }
}
