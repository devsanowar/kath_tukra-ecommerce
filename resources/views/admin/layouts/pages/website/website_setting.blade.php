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
                            <a href="{{ route('admin_panel_setting') }}"
                                class="btn btn-primary text-white text-uppercase font-weight-bold mx-2">
                                + Admin Panel Setting
                            </a>

                            <a href="{{ route('website_social_icon.index') }}" class="btn btn-primary text-white text-uppercase font-weight-bold mx-2">
                                + Social Icon
                            </a>

                            <a href="{{ route('website_color.edit') }}" class="btn btn-primary text-white text-uppercase font-weight-bold mx-2">
                                + Color Theme
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
                        <h4 class=""> Website Settings</h4>
                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('website_setting.update', $website_setting->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="website_title"><b>Website Title</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="website_title" name="website_title" class="form-control"
                                            placeholder="Enter website title "
                                            value="{{ $website_setting->website_title }}">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="customFile"><b>Website Logo (Image Size:300 by 300 and Max size:30kb)</b></label>
                                <div class="form-group">
                                    <div class="mb-2" style="border: 1px solid #ccc">
                                        <input type="file" class="form-control  @error('website_logo') is-invalid @enderror" id="customFile" name="website_logo" />
                                    </div>
                                </div>
                                <img src="{{ asset($website_setting->website_logo) }}" alt="" width="40">
                                @error('website_logo')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="customFile"><b>Favicon (Image Size:100 by 100 and Max size:30kb)</b></label>
                                <div class="form-group">
                                    <div class="mb-2" style="border: 1px solid #ccc">
                                        <input type="file" class="form-control" name="website_favicon" id="customFile" />
                                    </div>
                                    <img src="{{ asset($website_setting->website_favicon) }}" alt="" width="40">
                                </div>
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="customFile"><b>Footer Logo (Image Size:300 by 300 and Max size:30kb)</b></label>
                                <div class="form-group">
                                    <div class="mb-2" style="border: 1px solid #ccc">
                                        <input type="file" name="website_footer_logo" class="form-control"
                                            id="customFile" />
                                    </div>
                                    <img src="{{ asset($website_setting->website_footer_logo) }}" alt=""
                                        width="40">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="customFile"><b>Footer Background Image (Size:1900 by 500 and Max:100kb)</b></label>
                                <div class="form-group">
                                    <div class="mb-2" style="border: 1px solid #ccc">
                                        <input type="file" name="website_footer_bg" class="form-control"
                                            id="customFile" />
                                    </div>
                                    <img src="{{ asset($website_setting->website_footer_bg) }}" alt=""
                                        width="40">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="customFile"><b>Footer Bg Color</b></label>
                                <div class="form-group">
                                    <div class="input-group colorpicker">
                                        <div class="form-line" style="border: 1px solid #ccc">
                                            <input type="text" class="form-control" name="website_footer_color"  value="{{ $website_setting->website_footer_color }}">
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

                <div class="card">
                    <div class="card-header">
                        <h4 class=""> Google Map</h4>
                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('googlemap.update') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="googleMap"><b>Google Map</b></label>
                                <div class="form-group">
                                    <div class="mb-2" style="border: 1px solid #ccc">
                                        <input type="text" id="googleMap" name="google_map" class="form-control" value="{{ $website_setting->google_map }}" />
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
                            <h4 class=""> Breadcrumb Image </h4>
                        </div>
                        <div class="body">
                            <form class="form-horizontal" action="{{ route('bredcrumb.update') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                    <label for="customFile"><b>Bredcrumb Image (Size:1900 by 300 and Max:100kb)</b></label>
                                    <div class="form-group">
                                        <div class="mb-2" style="border: 1px solid #ccc">
                                            <input type="file" name="image" class="form-control"
                                                id="customFile" />
                                        </div>
                                        <img src="{{ asset($website_setting->image) }}" alt=""
                                            width="100">
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                                    <button type="submit"
                                        class="btn btn-raised btn-primary m-t-15 waves-effect">UPDATE</button>
                                </div>

                            </form>
                        </div>
                    </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class=""> Footer Information </h4>
                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('website_footer_info.update', $website_setting->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="phone_number"><b>Phone</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="phone_number" name="phone" class="form-control"
                                            placeholder="Enter your phone number" value="{{ $website_setting->phone }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="email"><b>Email</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="Enter your email" value="{{ $website_setting->email }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="address"><b>Address</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="address" name="address" class="form-control"
                                            placeholder="Enter your address" value="{{ $website_setting->address }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="footer_content"><b>Footer Content</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <textarea rows="5" id="footer_content" name="footer_content" class="form-control"
                                            placeholder="Enter your address"> {!! $website_setting->footer_content !!} </textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="copyright_text"><b>Copyright Text</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" name="copyright_text" id="copyright_text"
                                            class="form-control" placeholder="Enter your copyright text"
                                            value="{{ $website_setting->copyright_text }}">
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
