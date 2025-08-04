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

        .input-group .form-line+.input-group-addon {
            padding-right: 10px;
            top: 13px;
        }

        .input-group input[type="text"],
        .input-group .form-control {
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
                            <a href="{{ route('admin_panel_setting') }}"
                                class="btn btn-primary text-white text-uppercase font-weight-bold mx-2">
                                + Admin Panel Setting
                            </a>

                            <a href="{{ route('website_social_icon.index') }}"
                                class="btn btn-primary text-white text-uppercase font-weight-bold mx-2">
                                + Social Icon
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
                        <h4 class=""> Website Color Settings</h4>
                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('website_color.update', $website_color->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-7 mb-3">
                                    <label for="customFile"><b>Primary Color</b></label>
                                    <div class="form-group">
                                        <div class="input-group colorpicker">
                                            <div class="form-line" style="border: 1px solid #ccc">
                                                <input type="text" class="form-control" name="primary_color"
                                                    value="{{ $website_color->primary_color }}">
                                            </div>
                                            <span class="input-group-addon"> <i></i> </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-7 mb-3">
                                    <label for="customFile"><b>Secondary Color</b></label>
                                    <div class="form-group">
                                        <div class="input-group colorpicker">
                                            <div class="form-line" style="border: 1px solid #ccc">
                                                <input type="text" class="form-control" name="secondary_color"
                                                    value="{{ $website_color->secondary_color }}">
                                            </div>
                                            <span class="input-group-addon"> <i></i> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-7 mb-3">
                                    <label for="customFile"><b>Base Color</b></label>
                                    <div class="form-group">
                                        <div class="input-group colorpicker">
                                            <div class="form-line" style="border: 1px solid #ccc">
                                                <input type="text" class="form-control" name="base_color"
                                                    value="{{ $website_color->base_color }}">
                                            </div>
                                            <span class="input-group-addon"> <i></i> </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-7 mb-3">
                                    <label for="customFile"><b>Base background Color</b></label>
                                    <div class="form-group">
                                        <div class="input-group colorpicker">
                                            <div class="form-line" style="border: 1px solid #ccc">
                                                <input type="text" class="form-control" name="base_bg_color"
                                                    value="{{ $website_color->base_bg_color }}">
                                            </div>
                                            <span class="input-group-addon"> <i></i> </span>
                                        </div>
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
    <script src="{{ asset('backend') }}/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js -->
    <script src="{{ asset('backend') }}/assets/js/pages/forms/advanced-form-elements.js"></script>
@endpush
