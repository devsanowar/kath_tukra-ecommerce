@extends('admin.layouts.app')
@section('title')
Website Social Icon
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
                        <a href="{{ route('website_setting') }}"
                            class="btn btn-primary text-white text-uppercase font-weight-bold mx-2">
                            Website Setting
                        </a>

                        <a href="{{ route('admin_panel_setting') }}"
                            class="btn btn-primary text-white text-uppercase font-weight-bold mx-2">
                            Admin Panel Setting
                        </a>

                        <a href="{{ route('website_social_icon.index') }}" class="btn btn-primary text-white text-uppercase font-weight-bold mx-2">
                            Social Icon
                        </a>

                        <a href="{{ route('website_color.edit') }}" class="btn btn-primary text-white text-uppercase font-weight-bold mx-2">
                            Color Theme
                        </a>
                    </div>
                </h4>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h4 class=""> Admin login page Settings</h4>
                </div>
                <div class="body">
                    <form class="form-horizontal" action="{{ route('admin_panel_setting.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="customFile"><b>Admin login Background Image (Size:1900 by 500 and Max:500kb)</b></label>
                            <div class="form-group">
                                <div class="mb-2" style="border: 1px solid #ccc">
                                    <input type="file" name="login_page_bg" class="form-control"
                                        id="customFile" />
                                </div>
                                <img src="{{ asset($admin_panel->login_page_bg) }}" alt="" width="40">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="customFile"><b>Admin Login Background Color</b></label>
                            <div class="form-group">
                                <div class="input-group colorpicker">
                                    <div class="form-line" style="border: 1px solid #ccc">
                                        <input type="text" class="form-control" name="login_page_bg_color"  value="{{ $admin_panel->login_page_bg_color }}">
                                    </div>
                                    <span class="input-group-addon"> <i></i> </span>
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
