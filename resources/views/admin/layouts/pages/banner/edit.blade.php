@extends('admin.layouts.app')
@section('title')
    Edit Banner
@endsection
@push('styles')
    <style>
        .form-group .form-control {
            padding-left: 10px;
        }
    </style>
@endpush

@section('admin_content')
    <div class="container-fluid">
        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-uppercase"> Edit Banner
                            <span>
                                <a href="{{ route('banner.index') }}" class="btn btn-primary right">All Banner</a>
                            </span>
                        </h4>
                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('banner.update', $banner->id) }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="banner_title"><b>Banner Title</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="banner_title" name="title" class="form-control"
                                               value="{{ $banner->title }}" placeholder="Enter website title ">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="banner_subtitle"><b>Sub Title</b></label>
                                <div class="form-group">
                                    <div class="mb-2" style="border: 1px solid #ccc">
                                        <input type="text" class="form-control" name="sub_title" id="banner_subtitle"
                                               value="{{ $banner->sub_title }}" placeholder="Enter sub title" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="banner_description"><b>Short Description</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <textarea type="text" id="banner_description" name="description"
                                                  class="form-control" rows="4">{{ $banner->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="button_name"><b>Button Name</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" name="button_name" id="button_name" class="form-control"
                                               value="{{ $banner->button_name }}" placeholder="Enter button name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="button_url"><b>Button URL</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" name="button_url" id="button_url" class="form-control"
                                               value="{{ $banner->button_url }}" placeholder="Enter button url">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="customFile"><b> Image</b></label>
                                <div class="form-group">
                                    <div class="mb-2" style="border: 1px solid #ccc">
                                        <input type="file" class="form-control" id="customFile" name="image">
                                    </div>
                                    <img src="{{ asset($banner->image) }}" alt="" height="40">
                                </div>
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                                <button type="submit"
                                        class="btn btn-raised btn-primary m-t-15 waves-effect">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


        </div>
        <!-- #END# Horizontal Layout -->
    </div>
@endsection
