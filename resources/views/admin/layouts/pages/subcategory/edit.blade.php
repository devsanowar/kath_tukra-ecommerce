@extends('admin.layouts.app')
@section('title', 'Edit Subcategory')
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
                    <h2 class="text-uppercase"> Edit Subcategory <span><a href="{{ route('subcategory.index') }}" class="btn btn-primary right">All Subcategory</a></span></h2>

                </div>
                <div class="body">
                    <form class="form-horizontal" action="{{ route('subcategory.update',$Subcategory->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="subcategory_name"><b>Subcategory Name</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="subcategory_name" name="subcategory_name" class="form-control"
                                        placeholder="Enter Subcategory name " value="{{ $Subcategory->subcategory_name }}">
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="description"><b>Description ( Optional )</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <textarea type="text" rows="4" id="description" name="description" class="form-control"> {!! $Subcategory->description !!} </textarea>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="customFile"><b>Subcategory Image*</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="file" class="form-control @error('image')invalid @enderror" id="customFile" / name="image">
                                </div>
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <img class="mt-2" src="{{ asset($Subcategory->image) }}" alt="SubCategory image" width="80">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="brand_id"><b>Status</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <select name="is_active" class="form-control show-tick">
                                        <option @if($Subcategory->is_active == 1) selected @endif value="1">Active</option>
                                        <option @if($Subcategory->is_active == 0) selected @endif value="0">DeActive</option>
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

@endpush
