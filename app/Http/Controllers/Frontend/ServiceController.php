<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function servicePage(){
        $services = Service::where('is_active', 1)->latest()->get(['id','service_title', 'description', 'image']);
        return view('frontend.service', compact('services'));
    }
}
