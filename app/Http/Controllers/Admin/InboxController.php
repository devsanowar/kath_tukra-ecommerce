<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index(){
        $messages = Contact::latest()->get();
        return view('admin.layouts.pages.contact-message.index', compact('messages'));
    }

    public function show($id){
        $message = Contact::findOrFail($id);
        return view('admin.layouts.pages.contact-message.show', compact('message'));
    }

    public function destroy($id){
        $message = Contact::findOrFail($id);
        $message->delete();
        Toastr::success('Message Deleted Successfully');
        return redirect()->back();
    }
}
