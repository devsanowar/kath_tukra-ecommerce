@extends('admin.layouts.app')
@section('title', 'Add CTA')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/summernote/summernote.css" />
@endpush
@section('admin_content')
    <div class="container-fluid">
        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-uppercase"> Create CTA <span><a href="{{ route('cta.index') }}"
                                    class="btn btn-primary right">All CTA</a></span></h4>
                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('cta.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="title"><b>Title*</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="title" name="title"
                                            class="form-control @error('title')is-invalid @enderror"
                                            placeholder="Enter title ">
                                    </div>
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="sub_title"><b>Sub Title</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="sub_title" name="sub_title" class="form-control"
                                            placeholder="Enter Sub title ">
                                    </div>
                                    @error('sub_title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="content"><b>Contents</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <textarea type="text" name="content" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="button_name"><b>Button Name</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="button_name" name="button_name" class="form-control"
                                            placeholder="Enter button text ">
                                    </div>
                                    @error('button_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="button_url"><b>Button URL</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="button_url" name="button_url" class="form-control"
                                            placeholder="Enter button url ">
                                    </div>
                                    @error('button_url')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="customFile"><b>Post Image(Image Size : 1900 X 500)* ( Max:300kb )</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="file" class="form-control @error('image')invalid @enderror"
                                            id="customFile" / name="image">
                                    </div>
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <div class="form-group">
                                <label><b>Status</b></label>
                                <select class="form-control show-tick" name="is_active">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                                <div class="text-danger font-weight-bold mt-2" id="statusError"></div>
                            </div>
                        </div>
                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                                <button type="submit" class="btn btn-raised btn-primary m-t-15 waves-effect">SAVE</button>
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

@endpush
