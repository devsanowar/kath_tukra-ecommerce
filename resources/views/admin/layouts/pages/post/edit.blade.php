@extends('admin.layouts.app')
@section('title', 'Edit Post')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />
    <link rel="stylesheet" href="{{ asset(path: 'backend') }}/assets/plugins/summernote/summernote.css" />
@endpush
@section('admin_content')
    <div class="container-fluid">
        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-uppercase"> Edit Post <span><a href="{{ route('post.index') }}"
                                    class="btn btn-primary right">All Posts</a></span></h4>

                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('post.update', $post->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="post_title_id"><b>Post Title*</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="post_title_id" name="post_title"
                                            class="form-control @error('service_title')invalid @enderror"
                                            placeholder="Enter service title " value="{{ $post->post_title }}">
                                    </div>
                                    @error('post_title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="brand_id"><b>Category</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <select name="category_id" class="form-control show-tick">
                                            @foreach ($categories as $category)
                                                <option @if ($category->id == $post->category_id) selected @endif
                                                    value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="post_content_id"><b>Post Description</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <textarea type="text" name="post_content" class="form-control summernote">{!! $post->post_content !!}</textarea>
                                    </div>
                                </div>
                            </div>




                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="customFile"><b>Post Image(Image Size : 400 X 300)* ( Max:100kb )</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="file" class="form-control @error('image')invalid @enderror"
                                            id="customFile" / name="image">
                                    </div>
                                    <img class="mt-2" src="{{ asset($post->image) }}" alt="Post Image" width="40">
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="brand_id"><b>Status</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <select name="is_active" class="form-control show-tick">
                                            <option @if ($post->is_active == 1) selected @endif value="1">Active
                                            </option>
                                            <option @if ($post->is_active == 0) selected @endif value="0">
                                                DeActive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                                <button type="submit"
                                    class="btn btn-raised btn-primary m-t-15 waves-effect">UPDATE</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


        </div>
        <!-- #END# Horizontal Layout -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend') }}/assets/plugins/summernote/summernote.js"></script>
@endpush
