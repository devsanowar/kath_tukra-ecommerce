<?php

namespace App\Http\Controllers\Admin;

use App\Models\Achievement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Laravel\Facades\Image;
use App\Http\Requests\StoreAchievementRequest;
use App\Http\Requests\UpdateAchievementRequest;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achievements = Achievement::latest()->get();
        return view('admin.layouts.pages.achievement.index', compact('achievements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layouts.pages.achievement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAchievementRequest $request)
    {
        $achievementImage = $this->achievementImage($request);
        Achievement::create([
            'title' => $request->title,
            'count_number' => $request->count_number,
            'image' => $achievementImage,
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Achievement added successfully.');
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
    $achievement = Achievement::find($id);
        return view('admin.layouts.pages.achievement.edit', compact('achievement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAchievementRequest $request, string $id)
    {
        $achievement = Achievement::find($id);

        $achievementNewImage = $this->achievementImage($request);
        if($achievementNewImage){
            if (!empty($achievement->image)) {
                $oldImagePath = public_path($achievement->image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $achievement->image = $achievementNewImage;
        }
        $achievement->update([
            'title' => $request->title,
            'count_number' => $request->count_number,
            'image' => $achievement->image,
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Achievement updated successfully.');
        return redirect()->route('achievement.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $achievement = Achievement::find($id);

        if($achievement){
            if(!empty($achievement->image)){
                $oldImagePath = public_path($achievement->image);
                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }
            }
        }
        $achievement->delete();
        Toastr::success('Achievement deleted successfully.');
        return redirect()->route('achievement.index');
    }


    // Image edit and update code here
    private function achievementImage(Request $request){
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/achievement_image/');
            $image->save($destinationPath . $imageName);
            return 'uploads/achievement_image/' . $imageName;

        }
        return null;
    }


}
