<?php

namespace App\Http\Controllers\Admin;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\DistrictStoreRequest;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::orderByDesc('id')->get();
        return view('admin.layouts.pages.district.index', compact('districts'));
    }

    public function store(DistrictStoreRequest $request)
    {
        District::create([
            'district_name' => $request->district_name,
            'is_active' => filled($request->is_active),
        ]);

        $toastr = Toastr();
        $toastr->success('District created successfully.');
        return redirect()->route('district.index');
    }

    public function update(Request $request)
    {
        $district = District::find($request->id);

        if (!$district) {
            return response()->json(['error' => 'District not found'], 404);
        }

        // Update the correct column name
        $district->update([
            'district_name' => $request->district_name, // Ensure this matches your database column
        ]);

        return response()->json(['success' => 'District updated successfully!']);
    }

    public function destroy($id)
    {
        $district = District::find($id);

        if ($district->district_name == 'Default') {
            Toastr::error('Default District cannot be deleted.');
            return back();
        }

        $defaultDistrict = District::where('district_name', 'Default')->first();
        if (!$defaultDistrict) {
            Toastr::error('District deleted successfully.');
            return back();
        }

        $district->upazilas()->update([
            'district_id' => $defaultDistrict->id
        ]);

        $district->delete();

        $toastr = Toastr();
        $toastr->success('District created successfully.');
        return redirect()->route('district.index');
    }

    public function districtChangeStatus(Request $request)
    {
        $district = District::find($request->id);

        if (!$district) {
            return response()->json(['status' => false, 'message' => 'District not found.']);
        }

        $district->is_active = !$district->is_active;
        $district->save();

        return response()->json([
            'status' => true,
            'message' => 'Status changed successfully.',
            'new_status' => $district->is_active ? 'Active' : 'DeActive',
            'class' => $district->is_active ? 'btn-success' : 'btn-danger',
        ]);
    }
}
