@extends('admin.layouts.app')
@section('title', 'All Upazila')

@push('styles')

<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />

<style>
.form-line.case-input {
	border: 1px solid #b8b8b8;
}

</style>



@endpush


@section('admin_content')

<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>
                        All upazila
                        <span>
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-warning text-white text-uppercase text-bold right" data-toggle="modal" data-target="#addupazilaModal">
                                + Add New
                            </button>
                        </span>
                    </h4>
                </div>
                <div class="body">
                    <table id="upazilaDataTable" class="table table-bordered table-striped table-hover dataTable js-exportable" >
                        <thead>
                            <tr>
                                <th style="width: 60px">S/N</th>
                                <th>Upazila Name</th>
                                <th>District Name</th>

                                <th style="width: 60px">Status</th>
                                <th style="width: 160px">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($upazilas as $key=>$upazila)

                            <tr id="upazilaRow-{{ $upazila->id }}">
                                <td>{{ $key+1 }}</td>
                                <td class="upazila-name">{{ $upazila->upazila_name }}</td>
                                <td class="upazila-name">{{ $upazila->district->district_name }}</td>

                                {{-- <td>
                                    @if($upazila->is_active == 1)
                                        <a href="{{ route('upazila.status',$upazila->id) }}" class="btn btn-success">Active</a>
                                    @else
                                        <a href="{{ route('upazila.status',$upazila->id) }}" class="btn btn-danger">DeActive</a>
                                    @endif
                                </td> --}}

                                <td>
                                    <button data-id="{{ $upazila->id }}" class="btn btn-sm status-toggle-btn {{ $upazila->is_active ? 'btn-success' : 'btn-danger' }}">
                                        {{ $upazila->is_active ? 'Active' : 'DeActive' }}
                                    </button>
                                </td>


                                <td>
                                    <a href="javascript:void(0)" class="btn btn-warning btn-sm editUpazila"
                                        data-id="{{ $upazila->id }}"
                                        data-name="{{ $upazila->upazila_name }}"
                                        data-district="{{ $upazila->district_id }}"
                                        data-shipping="{{ $upazila->shipping_cost }}"
                                        data-status="{{ $upazila->is_active }}">
                                            <i class="material-icons text-white">edit</i>
                                    </a>


                                    <form class="d-inline-block" action="{{ route('upazila.destroy',$upazila->id) }}" method="POST">
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

                <!--Add upazila Bootstrap Modal -->
                @include('admin.layouts.pages.upazila.create')


                <!-- Edit Upazila Modal -->
               @include('admin.layouts.pages.upazila.edit')



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


 <!-- Script For status change -->
<script>
    const upazilaStatusRoute = "{{ route('upazila.status') }}";
    const csrfToken = "{{ csrf_token() }}";
</script>
<script src="{{ asset('backend') }}/assets/js/upazila.js"></script>





@endpush
