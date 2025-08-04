<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Paymentmethod;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Laravel\Facades\Image;
use App\Http\Requests\PaymentmethodStoreRequest;
use App\Http\Requests\PaymentmethodUpdateRequest;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = Paymentmethod::latest()->get();
        return view('admin.layouts.pages.payment-method.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('admin.layouts.pages.payment-method.create');
    }

    public function store(PaymentmethodStoreRequest $request)
    {
        $newImage = $this->paymentMethodImage($request);
        Paymentmethod::create([
            'name' => $request->name,
            'payment_number' => $request->payment_number,
            'method_type' => $request->method_type,
            'image' => $newImage,
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Payment method successfully inserted!!', 'success');
        return redirect()->route('payment_method.create');
    }


    public function edit($id){
        $payment_method = Paymentmethod::findOrFail($id);
        return view('admin.layouts.pages.payment-method.edit', compact('payment_method'));
    }


    public function update(PaymentmethodUpdateRequest $request, $id){
        $payment_method_update = Paymentmethod::findOrFail($id);
        $newImage = $this->paymentMethodImage($request);
        if($newImage){
            if (!empty($payment_method_update->image)) {
                $oldImagePath = public_path($payment_method_update->image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $payment_method_update->image = $newImage;
        }

        $payment_method_update->update([
            'name' => $request->name,
            'payment_number' => $request->payment_number,
            'method_type' => $request->method_type,
            'image' => $payment_method_update->image,
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Payment method successfully updated!!', 'success');
        return redirect()->route('payment_method.index');

    }


    public function destroy($id){
        $paymentMethod = Paymentmethod::findOrFail($id);
        if (!empty($paymentMethod->image)) {
            $oldImagePath = public_path($paymentMethod->image);
            if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $paymentMethod->delete();
        Toastr::success('Payment method successfully deleted!!', 'success');
        return redirect()->route('payment_method.index');

    }


        public function paymentMethodChangeStatus(Request $request)
        {
            $payment_method = Paymentmethod::find($request->id);

            if (!$payment_method) {
                return response()->json(['status' => false, 'message' => 'Payment method not found.']);
            }

            $payment_method->is_active = !$payment_method->is_active;
            $payment_method->save();

            return response()->json([
                'status' => true,
                'message' => 'Status changed successfully.',
                'new_status' => $payment_method->is_active ? 'Active' : 'DeActive',
                'class' => $payment_method->is_active ? 'btn-success' : 'btn-danger',
            ]);
        }

    // Image edit and update code here
    private function paymentMethodImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/payment_method_image/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->save($destinationPath . $imageName);

            return 'uploads/payment_method_image/' . $imageName;
        }

        return null;
    }
}
