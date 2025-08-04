<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Postcategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')
            ->latest()
            ->get(['id', 'category_id', 'post_title', 'post_content', 'image', 'is_active', 'post_slug']);

        return view('website.layouts.blog', compact('posts'));
    }

    public function blogDetail($post_slug)
    {
        $categories = Category::withCount('posts')
            ->where('category_slug', '!=', 'default')
            ->get();
        $blog = Post::where('post_slug', $post_slug)->firstOrFail();
        $posts = Post::latest()->get();

        return view('website.layouts.pages.blog.detail', compact('blog', 'posts', 'categories'));
    }


}
