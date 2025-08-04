<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\UpdateAboutRequest;
use Intervention\Image\Laravel\Facades\Image;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('admin.layouts.pages.about.index', compact('about'));
    }


    public function update(UpdateAboutRequest $request)
    {

        $about = About::first();
        $newImage = $this->aboutImage($request);
        if ($newImage) {
            $oldImagePath = public_path($about->image);
            if ($about->image && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $about->image = $newImage;
        }

        $about->update([
            'about_title' => $request->about_title,
            'description' => $request->description,
            'help_number' => $request->help_number,
            'image'       => $about->image,
        ]);

        Toastr::success('About updated successfully.');
        return redirect()->back();
    }


    private function aboutImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/about_image/');
            $image->save($destinationPath . $imageName);

            return 'uploads/about_image/' . $imageName;

        }
        return null;
    }


}
