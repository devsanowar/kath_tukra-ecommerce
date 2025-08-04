<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SocialWork;
use Illuminate\Http\Request;

class SocialworkPageController extends Controller
{
    public function socialWorkPage(){
        $socialWorkImages = SocialWork::latest()->get(['id', 'images']);
        return view('frontend.social_worok', compact('socialWorkImages'));
    }
}
