<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingUpdateRequest;

class ShippingController extends Controller
{
    public function index()
    {
        $shippings = Shipping::all();
        return view('admin.layouts.pages.shipping.index', compact('shippings'));
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'shipping_area' => 'required|string|max:255',
            'shipping_charge' => 'required|numeric',
            'is_active' => 'required|boolean',
        ]);

        // Create a new shipping record
        Shipping::create([
            'shipping_area' => $request->shipping_area,
            'shipping_charge' => $request->shipping_charge,
            'is_active' => filled($request->is_active),
        ]);

        $toastr = Toastr();
        $toastr->success('Shipping method created successfully.');
        return redirect()->route('shipping.index');

    }

    public function edit($id) {
        // Find shipping record
        $shipping = Shipping::find($id);
        if (!$shipping) {
            return response()->json(['error' => 'Shipping record not found!'], 404);
        }

        return view('admin.layouts.pages.shipping.edit', compact('shipping'));
    }


    public function update(ShippingUpdateRequest $request, $id)
    {

        $shipping = Shipping::find($id);
        if (!$shipping) {
            return response()->json(['error' => 'Shipping record not found!'], 404);
        }

        // Update shipping info
        $shipping->update([
            'shipping_area' => $request->shipping_area,
            'shipping_charge' => $request->shipping_charge,
            'is_active' => $request->is_active
        ]);

        $toastr = Toastr();
        $toastr->success('Shipping method created successfully.');
        return redirect()->route('shipping.index');

    }




    public function destroy($id){
        // Delete the selected shipping record
        Shipping::destroy(request('id'));

        $toastr = Toastr();
        $toastr->success('Shipping method deleted successfully.');
        return redirect()->route('shipping.index');
    }


    public function shippingChangeStatus($id)
    {
        $shipping = Shipping::find($id);

        if (!$shipping) {
            return redirect()->route('shipping.index')->with('error', 'Shipping not found.');
        }

        // Toggle the status
        $shipping->is_active = !$shipping->is_active;
        $shipping->save();

        // Show success message
        Toastr()->success('Status changed successfully.');

        return redirect()->route('shipping.index');
    }




}
