@extends('admin.layouts.app')
@section('title')
    About
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
                        <h4 class="text-uppercase"> About Information Update </h4>
                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('about.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="about_title_id"><b>About Title</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="about_title_id" name="about_title" class="form-control"
                                            placeholder="Enter about title " value="{{ $about->about_title }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="banner_description"><b>Short Description</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <textarea type="text" id="ckeditor" name="description" class="form-control">{!! $about->description !!}</textarea>
                                    </div>
                                </div>
                            </div>


{{--                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">--}}
{{--                                <label for="customFile"><b>About Image</b></label>--}}
{{--                                <div class="form-group">--}}
{{--                                    <div class="mb-2" style="border: 1px solid #ccc">--}}
{{--                                        <input type="file" class="form-control" id="customFile" name="image">--}}
{{--                                    </div>--}}
{{--                                    <img src="{{ asset($about->image) }}" alt="" width="40">--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="help_number_id"><b>Year Of Excellence*</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="help_number_id" name="help_number" class="form-control @error('help_number') is-invalid @enderror"
                                            placeholder="Enter Contact number " value="{{ $about->help_number }}">
                                    </div>
                                    @error('help_number')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
    <script src="{{ asset('backend') }}/assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor -->
    <script src="{{ asset('backend') }}/assets/js/pages/forms/editors.js"></script>
@endpush

