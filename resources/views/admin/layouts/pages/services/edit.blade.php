@extends('admin.layouts.app')
@section('title', 'Edit Service')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />
@endpush
@section('admin_content')
<div class="container-fluid">
    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-uppercase"> Edit Service <span><a href="{{ route('service.index') }}" class="btn btn-primary right">All Services</a></span></h4>

                </div>
                <div class="body">
                    <form class="form-horizontal" action="{{ route('service.update', $service->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="service_id"><b>Service Title*</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="service_id" name="service_title" class="form-control @error('service_title')invalid @enderror"
                                        placeholder="Enter service title " value="{{ $service->service_title }}">
                                </div>
                                @error('service_title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="banner_description"><b>Service Description</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <textarea type="text" id="ckeditor" name="description" class="form-control" >
                                        {!! $service->description !!}
                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="service_url_id"><b>Project Url*</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="service_url_id" name="service_url" class="form-control @error('service_url')invalid @enderror"
                                        placeholder="Enter service url " value="{{ $service->service_url }}">
                                </div>
                                @error('service_url')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="customFile"><b>Service Icon Image* ( Max size : 20px )</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="file" class="form-control @error('image')invalid @enderror" id="customFile" / name="image">
                                    <img class="mt-2" src="{{ asset($service->image) }}" alt="" width="40">
                                </div>
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="brand_id"><b>Status</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <select name="is_active" class="form-control show-tick">
                                        <option @if($service->is_active ==1 ) selected @endif value="1">Active</option>
                                        <option @if($service->is_active ==0 ) selected @endif value="0">DeActive</option>
                                    </select>
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
    <!-- #END# Horizontal Layout -->
</div>
@endsection

@push('scripts')
<script src="{{ asset('backend') }}/assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor -->
<script src="{{ asset('backend') }}/assets/js/pages/forms/editors.js"></script>
@endpush
