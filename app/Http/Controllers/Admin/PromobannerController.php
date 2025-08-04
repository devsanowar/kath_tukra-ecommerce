<?php

namespace App\Http\Controllers\Admin;

use App\Models\Promobanner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Laravel\Facades\Image;
use App\Http\Requests\PromobannerStoreRequest;
use App\Http\Requests\UpdatePromobannerRequest;

class PromobannerController extends Controller
{
    public function index()
    {
        $promobanners = Promobanner::latest()->get(['id', 'image', 'url', 'is_active']);
        return view('admin.layouts.pages.promo.index', compact('promobanners'));
    }

    public function store(PromobannerStoreRequest $request)
    {
        $promoBanner = $this->promoImage($request);
        Promobanner::create([
            'image' => $promoBanner,
            'url' => $request->url,
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Promo Banner added successfully.');
        return redirect()->back();
    }

    public function update(UpdatePromobannerRequest $request)
    {
        $promobanner = Promobanner::find($request->id);

        if (!$promobanner) {
            return response()->json(['error' => 'Promo banner not found'], 404);
        }

        $promobannerImage = $this->promoImage($request);
        if ($promobannerImage) {
            if (!empty($promobanner->image)) {
                $oldImagePath = public_path($promobanner->image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $promobanner->image = $promobannerImage;
        }

        // Update the correct column name
        $promobanner->update([
            'image' => $promobanner->image,
            'url' => $request->url,
            'is_active' => $request->is_active,
        ]);

        return response()->json([
            'success' => 'Promo Banner updated successfully!',
            'image' => asset($promobanner->image),
            'url' => $promobanner->url,
            'status' => $promobanner->is_active ? 'Active' : 'Inactive',
        ]);
    }

    public function destroy($id)
    {
        $promobanner = Promobanner::findOrFail($id);

        if ($promobanner->image) {
            $oldImagePath = public_path($promobanner->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $promobanner->delete();

        Toastr::success('Promo Banner deleted successfully.');
        return redirect()->route('promobanner.index');
    }

    // Status change
    public function PromoBannerChangeStatus(Request $request) {
        $promobanner = Promobanner::find($request->id);

        if (!$promobanner) {
            return response()->json(['status' => false, 'message' => 'Promo banner not found.']);
        }

        $promobanner->is_active = !$promobanner->is_active;
        $promobanner->save();

        return response()->json([
            'status' => true,
            'message' => 'Status changed successfully.',
            'new_status' => $promobanner->is_active ? 'Active' : 'DeActive',
            'class' => $promobanner->is_active ? 'btn-success' : 'btn-danger',
        ]);
    }

    // Image edit and update code here
    private function promoImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/promo_banners/');
            $image->save($destinationPath . $imageName);
            return 'uploads/promo_banners/' . $imageName;
        }
        return null;
    }
}
