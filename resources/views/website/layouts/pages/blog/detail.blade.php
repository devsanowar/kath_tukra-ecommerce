@extends('website.layouts.app')

@section('body')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
        }

        .blog-title {
            font-size: 1.8rem;
            font-weight: bold;
            margin: 1rem 0;
        }

        .blog-meta span {
            margin-right: 1rem;
            color: #888;
        }

        .blog-content p {
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .sidebar .list-group-item {
            border: none;
            padding-left: 0;
        }

        .blog-tags a {
            text-decoration: none;
            margin-right: 0.5rem;
            color: #0d6efd;
        }

        .social-icons a {
            margin-right: 10px;
            color: #333;
        }

        .comment {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .comment img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 1rem;
        }

        footer {
            background-color: #f1f1f1;
            padding: 2rem 0;
        }
    </style>

    <!-- Blog Details Content -->

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="blog-title">{{ $blog->post_title }}</h2>
                <div class="blog-meta mb-3">
                    <span>By Admin</span>
                    <span><i class="bi bi-chat"></i> 10 Comments</span>
                </div>
                {{-- <img src="{{ asset($blog->image) }}" class="img-fluid mb-4" alt="blog main image"> --}}
                <img src="{{ asset('frontend/assets/images/w10.jpg') }}" class="img-fluid mb-4 w-100" alt="Blog Image">
                <div class="blog-content" style="text-align: justify">
                    <p>
                        {!! $blog->post_content !!}
                    </p>
                </div>
            </div>
            <div class="col-lg-4 sidebar">
                <div class="mb-4">
                    <h5>Latest Post</h5>
                    <ul class="list-group">

                        @foreach ($posts as $item)
                            @if ($item->id !== $blog->id)
                                <li class="list-group-item">
                                    <a href="{{ route('blog.detail', ['post_slug' => $item->post_slug]) }}">
                                        {{ $item->post_title }}
                                    </a>
                                </li>
                            @endif
                        @endforeach

                    </ul>
                </div>
                <div class="mb-4">
                    <h5>Categories</h5>
                    <ul class="list-group">

                        @foreach ($categories as $category)
                            <li class="list-group-item"> <a href="#">{{ $category->category_name }}</a> </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
