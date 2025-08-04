<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomeAbout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class HomeAboutController extends Controller
{
    public function index()
    {
        $homeAbout = HomeAbout::first();
        return view('admin.layouts.pages.home-about.index', compact('homeAbout'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
            'image_one' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:200',
            'image_two' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:200',
        ]);

        // Update existing record (assuming only one row)
        $homeAbout = HomeAbout::firstOrNew(['id' => 1]);

        $homeAbout->title = $request->title;
        $homeAbout->description = $request->description;

        // Save features as JSON
        $homeAbout->features = $request->has('features') ? json_encode($request->features) : json_encode([]);

        // Handle image one
        if ($request->hasFile('image_one')) {
            if (File::exists(public_path($homeAbout->image_one))) {
                File::delete(public_path($homeAbout->image_one));
            }
            $file1 = $request->file('image_one');
            $filename1 = time() . '_one.' . $file1->getClientOriginalExtension();
            $file1->move(public_path('uploads/about'), $filename1);
            $homeAbout->image_one = 'uploads/about/' . $filename1;
        }

        // Handle image two
        if ($request->hasFile('image_two')) {
            if (File::exists(public_path($homeAbout->image_two))) {
                File::delete(public_path($homeAbout->image_two));
            }
            $file2 = $request->file('image_two');
            $filename2 = time() . '_two.' . $file2->getClientOriginalExtension();
            $file2->move(public_path('uploads/about'), $filename2);
            $homeAbout->image_two = 'uploads/about/' . $filename2;
        }

        $homeAbout->save();

        Toastr::success('Home About section updated successfully.');
        return redirect()->back();
    }
}
