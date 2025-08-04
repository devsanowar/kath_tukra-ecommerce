<?php

namespace App\Http\Controllers\Admin;

use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Str;
use App\Models\Postcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Redirect;

class PostCategoryController extends Controller
{
    public function index()
    {
        $categories = Postcategory::latest()->get();
        return view('admin.layouts.pages.postcategory.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:postcategories,category_name',
            'is_active' => 'required|in:0,1',
        ]);

        Postcategory::create([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Post Category Added Successfully.');
        return redirect()->route('post_category.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:postcategories,category_name,' . $request->id,
            'is_active' => 'required|in:0,1',
        ]);

        $postcategory = Postcategory::find($request->id);

        if (!$postcategory) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $postcategory->update([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
            'is_active' => (int) $request->is_active,
        ]);

        return response()->json([
            'success' => 'Post category updated successfully!',
            'category_name' => $postcategory->category_name,
            'category_slug' => $postcategory->category_slug,
            'is_active' => $postcategory->is_active,
        ]);
    }

    public function destroy($id)
    {
        $postcategory = Postcategory::findOrFail($id);

        if ($postcategory->category_slug == 'default') {
            Toastr::error('Default category cannot be deleted.');
            return back();
        }

        $defaultCategory = Postcategory::where('category_slug', 'default')->first();
        if (!$defaultCategory) {
            Toastr::error('Category deleted successfully.');
            return back();
        }

        $postcategory->posts()->update([
            'category_id' => $defaultCategory->id
        ]);


        $postcategory->delete();
        return response()->json(['success' => 'Post Category deleted successfully.']);
    }

    public function changeStatus(Request $request)
    {
        $postcategory = Postcategory::find($request->id);

        if (!$postcategory) {
            return response()->json(['status' => false, 'message' => 'Post category not found.']);
        }

        $postcategory->is_active = !$postcategory->is_active;
        $postcategory->save();

        return response()->json([
            'status' => true,
            'message' => 'Status changed successfully.',
            'new_status' => $postcategory->is_active ? 'Active' : 'DeActive',
            'class' => $postcategory->is_active ? 'btn-success' : 'btn-danger',
        ]);
    }
}
