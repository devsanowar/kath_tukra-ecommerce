<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Laravel\Facades\Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.layouts.pages.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layouts.pages.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'nullable|string|max:255',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:200',
        ]);

        $brandImage = $this->brandImage($request);
        Brand::create([
            'brand_name' => $request->brand_name,
            'image'      => $brandImage,
            'is_active'  => $request->is_active,
        ]);

        Toastr::success('Brand added successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::find($id);
        return view('admin.layouts.pages.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:200',
        ]);

        $brand = Brand::find($id);
        $newImage = $this->brandImage($request);
        if ($newImage) {
            $oldImagePath = public_path($brand->image);
            if ($brand->image && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $brand->image = $newImage;
        }

        $brand->update([
            'brand_name' => $request->brand_name,
            'image'      => $brand->image,
            'is_active'  => $request->is_active,
        ]);

        Toastr::success('Brand updated successfully.');
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            $oldImagePath = public_path($brand->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $brand->delete();
        Toastr::success('Brand deleted successfully.');
        return redirect()->route('brand.index');
    }

    private function brandImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/brand_image/');
            $image->save($destinationPath . $imageName);
            return 'uploads/brand_image/' . $imageName;
        }
        return null;
    }

    public function brandChangeStatus(Request $request)
    {
        $brand = Brand::find($request->id);

        if (!$brand) {
            return response()->json(['status' => false, 'message' => 'Brand not found.']);
        }

        $brand->is_active = !$brand->is_active;
        $brand->save();

        return response()->json([
            'status'     => true,
            'message'    => 'Status changed successfully.',
            'new_status' => $brand->is_active ? 'Active' : 'DeActive',
            'class'      => $brand->is_active ? 'btn-success' : 'btn-danger',
        ]);
    }
}
