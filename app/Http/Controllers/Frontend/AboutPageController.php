<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Chairman;
use App\Models\MissionAndVission;
use App\Models\Review;
use App\Models\WhyChoseUs;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function about()
    {
        $about = About::first();
        $reviews = Review::latest()->get();
        return view('website.layouts.about', compact('about', 'reviews'));
    }
}

