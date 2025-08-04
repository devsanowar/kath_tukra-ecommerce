<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Brian2694\Toastr\Facades\Toastr;

class NewslatterController extends Controller
{
    public function index(){
        $subscribers = NewsletterSubscriber::latest()->get();
        return view('admin.layouts.pages.subscriber.index', compact('subscribers'));
    }

    public function destroy($id){
        $message = NewsletterSubscriber::findOrFail($id);
        $message->delete();
        Toastr::success('Subscriber Deleted Successfully');
        return redirect()->back();
    }
}
