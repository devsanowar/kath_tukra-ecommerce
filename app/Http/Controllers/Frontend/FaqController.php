<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(){
        $pageTitle = 'Faq';
        $faqs = Faq::select(['id', 'question', 'answer'])->get();
        return view('website.layouts.faq', compact('faqs', 'pageTitle'));
    }
}
