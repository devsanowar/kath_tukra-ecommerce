<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialWork;
use Illuminate\Http\Request;

class SocialWorkController extends Controller
{
    public function index()
    {
        $SocialWorkImages = SocialWork::latest()->get(['id', 'images']);
        return view('admin.layouts.pages.social-work.index', compact('SocialWorkImages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('images')) {
            $uploadedPaths = [];

            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/social_work_image'), $filename);

                $path = 'uploads/social_work_image/' . $filename;

                SocialWork::create([
                    'images' => $path,
                ]);

                $uploadedPaths[] = $path;
            }

            return response()->json([
                'success' => true,
                'paths' => $uploadedPaths,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'No files uploaded.']);
    }


    public function socialWorkallImages(){
        $socialWorkImages = SocialWork::latest()->get(['id', 'images']);
        return view('admin.layouts.pages.social-work.all_images', compact('socialWorkImages'));
    }

    public function destroy($id)
    {
        $image = SocialWork::findOrFail($id);

        if (file_exists(public_path($image->images))) {
            unlink(public_path($image->images));
        }

        $image->delete();

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }
}
