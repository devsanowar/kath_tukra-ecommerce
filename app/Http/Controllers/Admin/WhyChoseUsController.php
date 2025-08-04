<?php

namespace App\Http\Controllers\Admin;

use App\Models\WhyChoseUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Laravel\Facades\Image;
use App\Http\Requests\StoreWhyChooseUsRequest;
use App\Http\Requests\UpdateWhyChooseUsRequest;

class WhyChoseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $whyChose_us = WhyChoseUs::latest()->get(['id','title','description','image','is_active']);
        return view('admin.layouts.pages.why_choose_us.index', compact('whyChose_us'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layouts.pages.why_choose_us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWhyChooseUsRequest $request)
    {

        $whychoseImage = $this->whychoseImage($request);
        WhyChoseUs::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $whychoseImage,
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Why Choose Us added successfully.');
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
        $whychooseUs = WhyChoseUs::find($id);
        return view('admin.layouts.pages.why_choose_us.edit', compact('whychooseUs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWhyChooseUsRequest $request, string $id)
    {
        $whyChooseUs = WhyChoseUs::find($id);

        $whyChooseUsNewImage = $this->whychoseImage($request);
        if($whyChooseUsNewImage){
            if (!empty($whyChooseUs->image)) {
                $oldImagePath = public_path($whyChooseUs->image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $whyChooseUs->image = $whyChooseUsNewImage;
        }
        $whyChooseUs->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $whyChooseUs->image,
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Why Choose Us updated successfully.');
        return redirect()->route('why-choose-us.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $whyChoseUs = WhyChoseUs::find($id);

        if($whyChoseUs){
            if(!empty($whyChoseUs->image)){
                $oldImagePath = public_path($whyChoseUs->image);
                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }
            }
        }
        $whyChoseUs->delete();
        Toastr::success('Why Choose Us deleted successfully.');
        return redirect()->route('service.index');
    }


    // Image edit and update code here
    private function whychoseImage(Request $request){
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/why_choose_us_image/');
            $image->save($destinationPath . $imageName);
            return 'uploads/why_choose_us_image/' . $imageName;

        }
        return null;
    }



}
