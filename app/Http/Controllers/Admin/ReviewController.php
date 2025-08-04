<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Intervention\Image\Laravel\Facades\Image;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('admin.layouts.pages.review.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layouts.pages.review.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        $addReviewImage = $this->reviewImage($request);
        Review::create([
            'name' => $request->name,
            'profession' => $request->profession,
            'review_number' => $request->review_number,
            'review' => $request-> review,
            'image' => $addReviewImage,
        ]);

        Toastr::success('Review added successfully.');
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
        $review = Review::find($id);
        return view('admin.layouts.pages.review.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, string $id)
    {
        $review = Review::find($id);
        $reviewNewImage = $this->reviewImage($request);
        if($reviewNewImage){
            if (!empty($review->image)) {
                $oldImagePath = public_path($review->image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $review->image = $reviewNewImage;
        }
        $review->update([
            'name' => $request->name,
            'profession' => $request->profession,
            'review_number' => $request->review_number,
            'review' => $request->review,
            'image' => $review->image,
        ]);

        Toastr::success('Review updated successfully.');
        return redirect()->route('review.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::find($id);

        if($review){
            $oldImagePath = public_path($review->image);
            if(file_exists($oldImagePath)){
                unlink($oldImagePath);
            }
        }
        $review->delete();
        Toastr::success('Review deleted successfully.');
        return redirect()->route('review.index');
    }


    // Image edit and update code here
    private function reviewImage(Request $request){
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/review_images/');
            $image->save($destinationPath . $imageName);
            return 'uploads/review_images/' . $imageName;

        }
        return null;
    }

}
