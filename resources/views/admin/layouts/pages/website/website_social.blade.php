@extends('admin.layouts.app')
@section('title')
Website Color Settings
@endsection

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
                    <h4 class=""> Website Color Settings</h4>
                </div>
                <div class="body">
                    <form class="form-horizontal" action="{{ route('website_social_icon.update') }}" method="POST">
                        @csrf
                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="facebook_url"><b>Facebook</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="facebook_url" class="form-control"
                                        placeholder="Enter facebook url " name="facebook_url" value="{{ $social_icon_setting ? $social_icon_setting->facebook_url : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="messanger_url"><b>Messanger</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="messanger_url" class="form-control"
                                        placeholder="Enter messanger url " name="messanger_url" value="{{ $social_icon_setting ? $social_icon_setting->messanger_url : '' }}">
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="linkedin_url"><b>Linkedin</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="linkedin_url" class="form-control"
                                        placeholder="Enter linkedin url " name="linkedin_url" value="{{ $social_icon_setting ? $social_icon_setting->linkedin_url : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="instagram_url"><b>Instagram</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="instagram_url" class="form-control"
                                        placeholder="Enter Instagram url " name="instagram_url" value="{{ $social_icon_setting ? $social_icon_setting->instagram_url : '' }}" >
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="twitter_url"><b>Twitter</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="twitter_url" class="form-control"
                                        placeholder="Enter twitter url" name="twitter_url" value="{{ $social_icon_setting ? $social_icon_setting->twitter_url : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="youtube_url"><b>Youtube</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="youtube_url" class="form-control"
                                        placeholder="Enter youtube url" name="youtube_url" value="{{ $social_icon_setting ? $social_icon_setting->youtube_url : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="pinterest_url"><b>Pinterest</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="pinterest_url" class="form-control"
                                        placeholder="Enter pinterest url " name="pinterest_url" value="{{ $social_icon_setting ? $social_icon_setting->pinterest_url : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="googleplus_url"><b>Google Plus</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="googleplus_url" class="form-control"
                                        placeholder="Enter googleplus url " name="googleplus_url" value="{{ $social_icon_setting ? $social_icon_setting->googleplus_url : '' }}">
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
