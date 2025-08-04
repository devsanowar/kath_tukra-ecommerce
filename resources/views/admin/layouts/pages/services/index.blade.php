@extends('admin.layouts.app')
@section('title', 'All Services')

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
                    <h4> All Services<span><a href="{{ route('service.create') }}" class="btn btn-primary text-white text-uppercase text-bold right">
                        + Add Service
                   </a></span></h4>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th style="width: 40px">Image</th>
								<th>Service Title</th>
								<th>Slug</th>
								<th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($services as $key=>$service)
                            <tr>
                                <td>{{$key+1 }}</td>
                                <td><img src="{{ asset($service->image) }}" alt="" width="30"></td>
								<td>{{ $service->service_title }}</td>
								<td>{{ $service->service_slug }}</td>
								<td>{!! Str::words($service->description, 6, '...') !!}</td>
                                <td>
                                    @if($service->is_active == 1)
                                        <a href="" class="btn btn-success">Active</a>
                                    @else
                                        <a href="" class="btn btn-danger">DeActive</a>
                                    @endif
                                </td>

                                <td>

                                    <a href="{{ route('service.edit', $service->id) }}" class="btn btn-warning btn-sm"> <i class="material-icons text-white">edit</i></a>


                                    <form class="d-inline-block" action="{{ route('service.destroy', $service->id) }}" method="POST">
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
    $('.show_confirm').click(function(event){
        let form = $(this).closest('form');
        event.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
                });
            }
            });

    });


</script>

@endpush
