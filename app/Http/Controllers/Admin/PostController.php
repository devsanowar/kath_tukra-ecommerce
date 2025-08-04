<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Postcategory;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->latest()->get(['id', 'category_id', 'post_title', 'post_content', 'image', 'is_active']);

        return view('admin.layouts.pages.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', 1)->latest()->get();
        return view('admin.layouts.pages.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $newPostImage = $this->postImage($request);
        Post::create([
            'user_name'    => Auth::user()->name,
            'category_id'  => $request->category_id,
            'post_title'   => $request->post_title,
            'post_slug'    => Str::slug($request->post_title),
            'post_content' => $request->post_content,
            'image'        => $newPostImage,
            'is_active'    => $request->is_active,
        ]);

        Toastr::success('Post added successfully.');
        return redirect()->route('post.create');

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
        $categories = Postcategory::where('is_active', 1)->latest()->get();
        $post = Post::find($id);
        return view('admin.layouts.pages.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $post = Post::find($id);
        $postNewImage = $this->postImage($request);
        if ($postNewImage) {
            if (!empty($service->image)) {
                $oldImagePath = public_path($post->image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $post->image = $postNewImage;
        }

        $post->update([
            'user_name'    => Auth::user()->name,
            'category_id'  => $request->category_id,
            'post_title'   => $request->post_title,
            'post_slug'    => Str::slug($request->post_title),
            'post_content' => $request->post_content,
            'image'        => $post->image,
            'is_active'    => $request->is_active,
        ]);

        Toastr::success('Post updated successfully.');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        if ($post) {
            if (!empty($post->image)) {
                $oldImagePath = public_path($post->image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }
        $post->delete();
        Toastr::success('Post deleted successfully.');
        return redirect()->route('post.index');

    }

    // Image edit and update code here
    private function postImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/post_image/');
            $image->save($destinationPath . $imageName);
            return 'uploads/post_image/' . $imageName;

        }
        return null;
    }

    public function postChangeStatus(Request $request)
    {
        $post = Post::find($request->id);

        if (!$post) {
            return response()->json(['status' => false, 'message' => 'Post not found.']);
        }

        $post->is_active = !$post->is_active;
        $post->save();

        return response()->json([
            'status'     => true,
            'message'    => 'Status changed successfully.',
            'new_status' => $post->is_active ? 'Active' : 'DeActive',
            'class'      => $post->is_active ? 'btn-success' : 'btn-danger',
        ]);
    }


}
