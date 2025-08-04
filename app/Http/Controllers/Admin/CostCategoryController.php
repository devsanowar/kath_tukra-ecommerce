<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CostCategory;

class CostCategoryController extends Controller
{
    public function index()
    {
        $cost_categories = CostCategory::latest()->get();
        return view('admin.layouts.pages.cost-category.index', compact('cost_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:cost_categories,category_name',
            'is_active'     => 'required|in:0,1',
        ]);

        CostCategory::create([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
            'is_active'     => $request->is_active,
        ]);

        Toastr::success('Cost Category Added Successfully.');
        return redirect()->route('cost_category.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:cost_categories,category_name,' . $request->id,
            'is_active'     => 'required|in:0,1',
        ]);

        $cost_category = CostCategory::find($request->id);

        if (!$cost_category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $cost_category->update([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
            'is_active'     => $request->is_active,
        ]);

        return response()->json([
            'success'       => 'Cost Category updated successfully!',
            'category_name' => $cost_category->category_name,
            'category_slug' => $cost_category->category_slug,
            'is_active'     => $cost_category->is_active,
        ]);
    }

    public function destroy($id)
    {
        $cost_category = CostCategory::findOrFail($id);

        if ($cost_category->category_slug == 'default') {
            Toastr::error('Default category cannot be deleted.');
            return back();
        }

        $defaultCategory = CostCategory::where('category_slug', 'default')->first();
        if (!$defaultCategory) {
            Toastr::error('Default category not found. Cannot reassign costs.');
            return back();
        }

        $cost_category->costs()->update([
            'category_id' => $defaultCategory->id
        ]);

        $cost_category->delete();

        Toastr::success('Cost Category deleted successfully.');
        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $cost_category = CostCategory::find($request->id);

        if (!$cost_category) {
            return response()->json(['status' => false, 'message' => 'Cost Category not found.']);
        }

        $cost_category->is_active = !$cost_category->is_active;
        $cost_category->save();

        return response()->json([
            'status'     => true,
            'message'    => 'Status changed successfully.',
            'new_status' => $cost_category->is_active ? 'Active' : 'DeActive',
            'class'      => $cost_category->is_active ? 'btn-success' : 'btn-danger',
        ]);
    }
}
