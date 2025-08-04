@extends('admin.layouts.app')
@section('title', 'Edit Brand')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />

@endpush
@section('admin_content')
<div class="container-fluid">
    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
            <div class="card">
                <div class="header">
                    <h2 class="text-uppercase"> Edit Brand <span><a href="{{ route('brand.index') }}" class="btn btn-primary right">All Brand</a></span></h2>
                </div>
                <div class="body">
                    <form class="form-horizontal" action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="brand_id"><b>Brand Name</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="brand_id" name="brand_name" class="form-control"
                                        placeholder="Enter brand name " value="{{ $brand->brand_name }}">
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="customFile"><b>Brand Logo*</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="file" class="form-control @error('image')invalid @enderror" id="customFile" / name="image">
                                </div>
                                <img src="{{ asset($brand->image) }}" alt="Brand Image" width="40">
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label><b>Status</b></label>
                                    <select class="form-control show-tick" name="is_active">
                                        <option value="">Select Status</option>
                                        <option @if($brand->is_active == 1 ) selected @endif value="1">Active</option>
                                        <option @if($brand->is_active == 0 ) selected @endif value="0">Deactive</option>
                                    </select>
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
<!--Jquery Spinner Plugin Js -->
<script src="{{ asset('backend') }}/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor -->

<script src="{{ asset('backend') }}/assets/js/pages/forms/editors.js"></script>

@endpush
