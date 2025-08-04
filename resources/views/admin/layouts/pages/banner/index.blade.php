@extends('admin.layouts.app')
@section('title')
    All Banner
@endsection
@push('styles')
    <style>
        .form-group .form-control {
            padding-left: 10px;
        }
    </style>
@endpush

@section('admin_content')
<div class="container-fluid">
    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-uppercase"> Banner Data Update
                        <span>
                                <a href="{{ route('banner.create') }}" class="btn btn-primary right">Add Banner</a>
                        </span>
                    </h4>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Button Name</th>
                                <th>Button URL</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse ($banners as $key => $banner)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td><img src="{{ asset($banner->image) }}" alt="category image" width="40"></td>
                                    <td>{{ Str::limit($banner->title, 30) }}</td>
                                    <td>{{ $banner->button_name }}</td>
                                    <td>{{ Str::limit($banner->button_url, 20) }}</td>
                                    <td>
                                        <a href="{{ route('banner.edit', $banner->id) }}"
                                           class="btn btn-warning"><i class="material-icons text-white">edit</i></a>

                                        <form class="d-inline-block" action="{{ route('banner.destroy',$banner->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-raised bg-pink waves-effect show_confirm"> <i
                                                    class="material-icons">delete</i> </button>
                                        </form>
                                    </td>

                                <tr>
                                    @empty
                                        <table>
                                            <thead>
                                            <tr>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                Category Not Found! :) Please Add Category. Thank you
                                            </tr>
                                            </tbody>
                                        </table>

                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- #END# Horizontal Layout -->
</div>
@endsection
