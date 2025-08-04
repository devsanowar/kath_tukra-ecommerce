<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Laravel\Facades\Image;
use App\Http\Requests\SubcategoryStoreRequest;
use App\Http\Requests\SubcategoryUpdateRequest;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::latest()->get();
        return view('admin.layouts.pages.subcategory.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layouts.pages.subcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubcategoryStoreRequest $request)
    {
        $newSubategoryImage = $this->subcategoryImage($request);
        SubCategory::create([
            'category_id' => null,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name),
            'description' => $request->description,
            'image' => $newSubategoryImage,
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Subcategory added successfully.');
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
        $Subcategory = SubCategory::find($id);
        return view('admin.layouts.pages.subcategory.edit', compact('Subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubcategoryUpdateRequest $request, string $id)
    {
        $subcategory = SubCategory::find($id);

        $subCategoryImage = $this->subcategoryImage($request);
        if($subCategoryImage){
            if (!empty($subcategory->image)) {
                $oldImagePath = public_path($subcategory->image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $subcategory->image = $subCategoryImage;
        }

        $subcategory->update([
            'category_id' => null,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => Str::slug($request->subcategory_name),
            'description' => $request->description,
            'image' => $subcategory->image,
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Subcategory updated successfully.');
        return redirect()->route('subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    // Image add and update code here
    private function subcategoryImage(Request $request){
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/subcategory_image/');
            $image->save($destinationPath . $imageName);
            return 'uploads/subcategory_image/' . $imageName;

        }
        return null;
    }

}
