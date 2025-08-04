@extends('admin.layouts.app')
@section('title')
    Website Settings
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />

    <style>
        .form-group .form-control {
            padding-left: 10px;
        }

        .input-group .form-line + .input-group-addon {
            padding-right: 10px;
            top: 13px;
        }

        .input-group input[type="text"], .input-group .form-control {
                padding-left: 10px;
            }


    </style>
@endpush
@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                <div>
                    <h4 class="text-center mb-0">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('about_page.page') }}"
                                class="btn btn-primary text-white text-uppercase font-weight-bold mx-2">
                                + Chairman Information
                            </a>

                        </div>
                    </h4>
                </div>
            </div>
        </div>


        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class=""> Our Mission</h4>
                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('mission.update') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="mission_content_id"><b>Mission Content</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <textarea rows="5" name="mission_content" class="form-control">{!! $mission_vission->mission_content !!}</textarea>
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


            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class=""> Our Vision </h4>
                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('vision.update') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="footer_content"><b>Vision Contents</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <textarea rows="5" name="vision_content" class="form-control">{!! $mission_vission->vision_content !!}</textarea>
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
    </div>
@endsection

@push('scripts')
<script src="{{ asset('backend') }}/assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor -->
    <script src="{{ asset('backend') }}/assets/js/pages/forms/editors.js"></script>
@endpush
