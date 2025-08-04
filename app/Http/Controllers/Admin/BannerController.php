<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Laravel\Facades\Image;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.layouts.pages.banner.index', compact('banners'));
    }
    public function create()
    {
        return view('admin.layouts.pages.banner.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'sub_title'    => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
            'button_name'  => 'nullable|string|max:100',
            'button_url'   => 'nullable|url|max:255',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/banner'), $imageName);
            $imagePath = 'uploads/banner/' . $imageName;
        }

        Banner::create([
            'title'        => $request->title,
            'sub_title'    => $request->sub_title,
            'description'  => $request->description,
            'image'        => $imagePath,
            'button_name'  => $request->button_name,
            'button_url'   => $request->button_url,
        ]);

        Toastr::success('Banner created successfully.');
        return redirect()->back();
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.layouts.pages.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'sub_title'    => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:300',
            'button_name'  => 'nullable|string|max:100',
            'button_url'   => 'nullable|url|max:255',
        ]);

        $banner = Banner::findOrFail($id);
        $newImage = $this->bannerImage($request);
        if ($newImage) {
            $oldImagePath = public_path($banner->image);
            if ($banner->image && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $banner->image = $newImage;
        }

        $banner->update([
            'title'       => $request->title,
            'sub_title'   => $request->sub_title,
            'description' => $request->description,
            'image'       => $banner->image,
            'button_name' => $request->button_name,
            'button_url'  => $request->button_url,
        ]);

        Toastr::success('Banner updated successfully.');
        return redirect()->route('banner.index');

    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        if (file_exists($banner->image))
        {
            unlink($banner->image);
        }
        $banner->delete();

        Toastr::success('Banner deleted successfully.');
        return redirect()->route('banner.index');
    }

    private function bannerImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/banner_image/');
            $image->save($destinationPath . $imageName);

            return 'uploads/banner_image/' . $imageName;

        }
        return null;
    }

}
