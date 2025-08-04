<?php

namespace App\Http\Controllers\Admin;

use App\Models\Upazila;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpazilaStoreRequest;

class UpazilaController extends Controller
{
    public function index()
    {
        $districts = District::all();
        $upazilas = Upazila::with('district')->latest()->get();
        return view('admin.layouts.pages.upazila.index', compact('districts', 'upazilas'));
    }

    public function storeUpazila(UpazilaStoreRequest $request)
    {
        $upazila = Upazila::create([
            'upazila_name' => $request->upazila_name,
            'district_id' => $request->district_id,
            'is_active' => filled($request->is_active),
        ]);
        $toastr = Toastr();
        $toastr->success('Upazila created successfully.');
        return redirect()->route('upazila.index');
    }

    public function update(Request $request, $id)
    {
        $upazila = Upazila::findOrFail($id);

        $upazila->update([
            'upazila_name' => $request->upazila_name,
            'district_id' => $request->district_id,
            'shipping_cost' => $request->shipping_cost,
            'is_active' => $request->is_active,
        ]);

        return response()->json(['message' => 'Upazila updated successfully!']);
    }

    public function destroyUpazila($id)
    {
        $upazila = Upazila::find($id);
        $upazila->delete();
        $toastr = Toastr();
        $toastr->success('Upazila deleted successfully.');
        return redirect()->route('upazila.index');
    }

    public function upazilaChangeStatus(Request $request)
    {
        $upazila = Upazila::find($request->id);

        if (!$upazila) {
            return response()->json(['status' => false, 'message' => 'Upazila not found.']);
        }

        $upazila->is_active = !$upazila->is_active;
        $upazila->save();

        return response()->json([
            'status' => true,
            'message' => 'Status changed successfully.',
            'new_status' => $upazila->is_active ? 'Active' : 'DeActive',
            'class' => $upazila->is_active ? 'btn-success' : 'btn-danger',
        ]);
    }
}
