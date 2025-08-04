@extends('admin.layouts.app')
@section('title', 'All Posts')

@push('styles')

<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">

@endpush


@section('admin_content')


<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4> All Posts<span><a href="{{ route('post.create') }}" class="btn btn-primary text-white text-uppercase text-bold right">
                        + Add Post
                   </a></span></h4>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th style="width: 40px">Image</th>
								<th>Post Title</th>
								<th>Category</th>
								<th>Content</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($posts as $key=>$post)
                            <tr>
                                <td>{{$key+1 }}</td>
                                <td><img src="{{ asset($post->image) }}" alt="" width="30"></td>
								<td>{{ Str::words($post->post_title, 6, '...') }}</td>
								<td>{{ $post->category->category_name }}</td>
								<td>{!! Str::words($post->post_content, 4, '...') !!}</td>
                                <td>
                                    <button data-id="{{ $post->id }}" class="btn btn-sm status-toggle-btn {{ $post->is_active ? 'btn-success' : 'btn-danger' }}">
                                        {{ $post->is_active ? 'Active' : 'DeActive' }}
                                    </button>
                                </td>

                                <td>

                                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning btn-sm"> <i class="material-icons text-white">edit</i></a>


                                    <form class="d-inline-block" action="{{ route('post.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm show_confirm"><i class="material-icons">delete</i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')

<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('backend') }}/assets/bundles/datatablescripts.bundle.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>


<!-- Custom Js -->
<script src="{{ asset('backend') }}/assets/js/pages/tables/jquery-datatable.js"></script>
<script src="{{ asset('backend') }}/assets/js/sweetalert2.all.min.js"></script>

<script>
    const postStatusRoute = "{{ route('post.status') }}";
    const csrfToken = "{{ csrf_token() }}";
</script>
<script src="{{ asset('backend') }}/assets/js/post.js"></script>



@endpush
