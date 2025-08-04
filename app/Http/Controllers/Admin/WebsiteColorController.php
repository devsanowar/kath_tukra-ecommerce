<?php

namespace App\Http\Controllers\Admin;

use App\Models\WebsiteColor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class WebsiteColorController extends Controller
{
    public function edit(){
        $website_color = WebsiteColor::first();
        return view('admin.layouts.pages.website.website_color', compact('website_color'));
    }

    public function update(Request $reques, $id){
        $websiteColor = WebsiteColor::findOrFail($id);
        $websiteColor->update([
            'primary_color' => $reques->primary_color,
            'secondary_color' => $reques->secondary_color,
            'base_color' => $reques->base_color,
            'base_bg_color' => $reques->base_bg_color,
        ]);

        Toastr::success('Website settings updated successfully.');
        return redirect()->back();


    }
}
