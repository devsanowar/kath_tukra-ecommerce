@extends('admin.layouts.app')
@section('title')
    About Page
@endsection
@push('styles')

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
                            <a href="{{ route('mission_vision.page') }}"
                                class="btn btn-primary text-white text-uppercase font-weight-bold mx-2">
                                + Our Mission And Vision
                            </a>
                        </div>
                    </h4>
                </div>
            </div>
        </div>


        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class=""> Chariman Information</h4>
                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('chairman.update', $chairman->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="name_id"><b>Name</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="name_id" name="name" class="form-control"
                                            placeholder="Enter Full Name "
                                            value="{{ $chairman->name }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="position_id"><b>Position</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="position_id" name="position" class="form-control"
                                            placeholder="Enter Position "
                                            value="{{ $chairman->position }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="about_chairman"><b>About Chairman</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <textarea type="text" id="ckeditor" name="about_chairman" class="form-control">{!! $chairman->about_chairman !!}</textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="customFile"><b>Chairman Image (Image Size:1000 by 1000 and Max size:120kb)</b></label>
                                <div class="form-group">
                                    <div class="mb-2" style="border: 1px solid #ccc">
                                        <input type="file" class="form-control  @error('image') is-invalid @enderror" id="customFile" name="image" />
                                    </div>
                                </div>
                                <img src="{{ asset($chairman->image) }}" alt="" width="40">
                                @error('image')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
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
