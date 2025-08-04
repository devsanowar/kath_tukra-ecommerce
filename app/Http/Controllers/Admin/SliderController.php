<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Colors\Rgb\Channels\Red;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::latest()->get(['id','slider_title','slider_content','image','is_active']);
        return view('admin.layouts.pages.slider.index', compact('sliders'));
    }

    public function create(){
        return view('admin.layouts.pages.slider.create');
    }

    public function store(StoreSliderRequest $request){
        $sliderImage = $this->sliderImage($request);
        Slider::create([
            'slider_title' =>$request->slider_title,
            'slider_content' =>$request->slider_content,
            'button_url' =>$request->button_url,
            'image' =>$sliderImage,
            'is_active' =>$request->is_active,
        ]);

        Toastr::success('Slider added successfully.');
        return redirect()->route('slider.create');
    }

    public function edit($id){
        $slider = Slider::findOrFail($id);
        return view('admin.layouts.pages.slider.edit', compact('slider'));
    }


    public function update(UpdateSliderRequest $request, $id){
        $slider = Slider::findOrFail($id);
        $sliderNewImage = $this->sliderImage($request);
        if($sliderNewImage){
            if (!empty($slider->image)) {
                $oldImagePath = public_path($slider->image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $slider->image = $sliderNewImage;
        }

        $slider->update([
            'slider_title' => $request->slider_title,
            'slider_content' => $request->slider_content,
            'button_url' => $request->button_url,
            'image' => $slider->image,
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Slider updated successfully.');
        return redirect()->route('slider.index');

    }


    public function destroy(string $id)
    {
        $slider = Slider::find($id);

        if($slider){
            if(!empty($slider->image)){
                $oldImagePath = public_path($slider->image);
                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }
            }
        }
        $slider->delete();
        Toastr::success('Slider deleted successfully.');
        return redirect()->route('slider.index');
    }




    // Image edit and update code here
    private function sliderImage(Request $request){
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/slider_image/');
            $image->save($destinationPath . $imageName);
            return 'uploads/slider_image/' . $imageName;

        }
        return null;
    }


}
