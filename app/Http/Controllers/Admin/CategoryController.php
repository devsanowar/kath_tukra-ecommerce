<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Intervention\Image\Laravel\Facades\Image;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.layouts.pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.layouts.pages.category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $newCategoryImage = $this->categoryImage($request);
        Category::create([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
            'description'   => $request->description,
            'image'         => $newCategoryImage,
            'is_active'     => $request->is_active,
        ]);

        Toastr::success('Category added successfully.');
        return redirect()->back();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.layouts.pages.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::find($id);

        $categoryNewImage = $this->categoryImage($request);
        if ($categoryNewImage) {
            if (!empty($category->image)) {
                $oldImagePath = public_path($category->image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $category->image = $categoryNewImage;
        }

        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
            'description'   => $request->description,
            'image'         => $category->image,
            'is_active'     => $request->is_active,
        ]);

        Toastr::success('Category updated successfully.');
        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category->category_slug == 'default') {
            Toastr::error('Default category cannot be deleted.');
            return back();
        }


        $defaultCategory = Category::where('category_slug', 'default')->first();
        if (!$defaultCategory) {
            Toastr::error('Category deleted successfully.');
            return back();
        }
        $category->products()->update([
            'category_id' => $defaultCategory->id
        ]);

        if ($category) {
            if (!empty($category->image)) {
                $oldImagePath = public_path($category->image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }

        $category->delete();
        Toastr::success('Category deleted successfully.');
        return redirect()->back();
    }

    // Image add and update code here
    private function categoryImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/category_image/');
            $image->save($destinationPath . $imageName);
            return 'uploads/category_image/' . $imageName;
        }
        return null;
    }

    public function categoryChangeStatus(Request $request)
    {
        $category = Category::find($request->id);

        if (!$category) {
            return response()->json(['status' => false, 'message' => 'Category not found.']);
        }

        $category->is_active = !$category->is_active;
        $category->save();

        return response()->json([
            'status'     => true,
            'message'    => 'Status changed successfully.',
            'new_status' => $category->is_active ? 'Active' : 'DeActive',
            'class'      => $category->is_active ? 'btn-success' : 'btn-danger',
        ]);
    }
}
