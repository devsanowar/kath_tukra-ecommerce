@extends('admin.layouts.app')
@section('title', 'Edit Achievement')
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
                    <h4 class="text-uppercase"> Edit Achievement <span><a href="{{ route('achievement.index') }}" class="btn btn-primary right">All Achievement</a></span></h4>

                </div>
                <div class="body">
                    <form class="form-horizontal" action="{{ route('achievement.update', $achievement->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="title_id"><b>Title*</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="title_id" name="title" class="form-control @error('title')is-invalid @enderror"
                                        placeholder="Enter title " value="{{ $achievement->title }}">
                                </div>
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="count_number_id"><b>Number Of Achievement*</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="text" id="count_number_id" name="count_number" class="form-control @error('count_number')invalid @enderror"
                                        placeholder="Enter Number " value="{{ $achievement->count_number }}">
                                </div>
                                @error('count_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="customFile"><b>Icon Image* (Image Size: 64 by 64 - Max size : 20kb )</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <input type="file" class="form-control @error('image')invalid @enderror" id="customFile" / name="image">
                                </div>
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <img class="mt-2" src="{{ asset($achievement->image) }}" alt="Image" width="60">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                            <label for="brand_id"><b>Status</b></label>
                            <div class="form-group">
                                <div class="" style="border: 1px solid #ccc">
                                    <select name="is_active" class="form-control show-tick">
                                        <option @if($achievement->is_active == 1 ) selected @endif value="1">Active</option>
                                        <option @if($achievement->is_active == 0 ) selected @endif value="0">DeActive</option>
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
