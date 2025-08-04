<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\CtaStoreRequest;
use App\Http\Requests\CtaUpdateRequest;
use Intervention\Image\Laravel\Facades\Image;

class CtaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ctas = Cta::latest()->get();
        return view('admin.layouts.pages.cta.index', compact('ctas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layouts.pages.cta.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CtaStoreRequest $request)
    {
        $ctaImage = $this->ctaImage($request);
        Cta::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'content' => $request->content,
            'button_name' => $request->button_name,
            'button_url' => $request->button_url,
            'image' => $ctaImage,
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Cta Store Successfully!');
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
        $cta = Cta::findOrFail($id);
        return view('admin.layouts.pages.cta.edit', compact('cta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CtaUpdateRequest $request, string $id)
    {
        $cta = Cta::findOrFail($id);
        $newImage = $this->ctaImage($request);
        if ($newImage) {
            $oldImagePath = public_path($cta->image);
            if ($cta->image && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $cta->image = $newImage;
        }

        $cta->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'content' => $request->content,
            'image' => $cta->image,
            'button_name' => $request->button_name,
            'button_url'=> $request->button_url,
            'is_active'=> $request->is_active,
        ]);

        Toastr::success('Cta updated successfully.');
        return redirect()->route('cta.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cta = Cta::findOrFail($id);
        if($cta){
            if (!empty($cta->image)) {
                $oldImagePath = public_path($cta->image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }
        $cta->delete();
        Toastr::success('Cta deleted successfully.');
        return redirect()->route('cta.index');
    }



    // Status Change
    public function ctaChangeStatus(Request $request)
    {
        $cta = Cta::find($request->id);

        if (!$cta) {
            return response()->json(['status' => false, 'message' => 'Cta not found.']);
        }

        $cta->is_active = !$cta->is_active;
        $cta->save();

        return response()->json([
            'status' => true,
            'message' => 'Status changed successfully.',
            'new_status' => $cta->is_active ? 'Active' : 'DeActive',
            'class' => $cta->is_active ? 'btn-success' : 'btn-danger',
        ]);
    }


    // Product thumbnail image
    private function ctaImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/cta_image/');
            $image->save($destinationPath . $imageName);
            return 'uploads/cta_image/' . $imageName;
        }
        return null;
    }


}
