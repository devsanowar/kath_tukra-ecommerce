<?php

namespace App\Http\Controllers\Admin;

use App\Models\Chairman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\UpdateChairmanRequest;
use App\Models\MissionAndVission;
use Intervention\Image\Laravel\Facades\Image;

class AboutPageController extends Controller
{
    public function index(){
        $chairman = Chairman::first();
        return view('admin.layouts.pages.about-page.index', compact('chairman'));
    }

    public function update(UpdateChairmanRequest $request, $id){
        $chairman = Chairman::find($id);

        $chairmanNewImage = $this->chairmanImage($request);
        if($chairmanNewImage){
            if (!empty($chairman->image)) {
                $oldImagePath = public_path($chairman->image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $chairman->image = $chairmanNewImage;
        }
        $chairman->update([
            'name' => $request->name,
            'position' => $request->position,
            'about_chairman' => $request->about_chairman,
            'image' => $chairman->image,
        ]);

        Toastr::success('Chairman information updated successfully.');
        return redirect()->route('about.index');
    }


    public function missionVision(){
        $mission_vission = MissionAndVission::first();
        return view('admin.layouts.pages.about-page.mission-vission', compact('mission_vission'));
    }

    public function missionUpdate(Request $request){
        $missionUpdate = MissionAndVission::first();
        $missionUpdate->update([
            'mission_content' =>$request->mission_content
        ]);

        Toastr::success('Mission updated successfully.');
        return redirect()->back();

    }


    public function visionUpdate(Request $request){
        $visionUpdate = MissionAndVission::first();
        $visionUpdate->update([
            'vision_content' =>$request->vision_content
        ]);

        Toastr::success('Vision updated successfully.');
        return redirect()->back();
    }




    // Image edit and update code here
    private function chairmanImage(Request $request){
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/chairman_image/');
            $image->save($destinationPath . $imageName);
            return 'uploads/chairman_image/' . $imageName;

        }
        return null;
    }
}
