<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\FieldOfCost;

class FieldOfCostController extends Controller
{
    public function index()
    {
        $fields = FieldOfCost::latest()->get();
        return view('admin.layouts.pages.field-of-cost.index', compact('fields'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'field_of_cost' => 'required|string|max:255|unique:field_of_costs,field_of_cost',
            'is_active'     => 'required|in:0,1',
        ]);

        FieldOfCost::create([
            'field_of_cost' => $request->field_of_cost,
            'field_slug'    => Str::slug($request->field_of_cost),
            'is_active'     => $request->is_active,
        ]);

        Toastr::success('Field of Cost Added Successfully.');
        return redirect()->route('field_of_cost.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'field_of_cost' => 'required|string|max:255|unique:field_of_costs,field_of_cost,' . $request->id,
            'is_active'     => 'required|in:0,1',
        ]);

        $field = FieldOfCost::find($request->id);

        if (!$field) {
            return response()->json(['error' => 'Field of Cost not found'], 404);
        }

        $field->update([
            'field_of_cost' => $request->field_of_cost,
            'field_slug'    => Str::slug($request->field_of_cost),
            'is_active'     => $request->is_active,
        ]);

        return response()->json([
            'success'       => 'Cost Field updated successfully!',
            'field_of_cost' => $field->field_of_cost,
            'field_slug'    => $field->field_slug,
            'is_active'     => $field->is_active,
        ]);
    }

    public function destroy($id)
    {
        $field = FieldOfCost::findOrFail($id);

        if ($field->field_slug == 'default') {
            Toastr::error('Default field cannot be deleted.');
            return back();
        }

        $defaultField = FieldOfCost::where('field_slug', 'default')->first();
        if (!$defaultField) {
            Toastr::error('Default field not found. Cannot reassign costs.');
            return back();
        }

//        $field->fiels_of_costs()->update([
//            'field_of_cost_id' => $defaultField->id
//        ]);

        $field->delete();

        Toastr::success('Cost Field deleted successfully.');
        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $field = FieldOfCost::find($request->id);

        if (!$field) {
            return response()->json(['status' => false, 'message' => 'Cost Field not found.']);
        }

        $field->is_active = !$field->is_active;
        $field->save();

        return response()->json([
            'status'     => true,
            'message'    => 'Status changed successfully.',
            'new_status' => $field->is_active ? 'Active' : 'DeActive',
            'class'      => $field->is_active ? 'btn-success' : 'btn-danger',
        ]);
    }
}
