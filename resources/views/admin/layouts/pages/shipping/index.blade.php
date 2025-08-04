@extends('admin.layouts.app')
@section('title', 'Shipping')

@push('styles')

<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />

<script>
    $(document).ready(function() {
        $('.select2').select2({
            minimumResultsForSearch: 0, // Enables search for all dropdowns
            placeholder: "Select Status",
            allowClear: true
        });
    });
</script>

<style>

.form-line.case-input {
	border: 1px solid #8a8a8a;
}

.input-group .input-group-addon {
	padding-left: 10px;
}

.input-group .input-group-addon + .form-line {
	padding-left: 35px;
}

.bootstrap-select.btn-group.show-tick > .btn {
	border: 1px solid #444 !important;
	padding-left: 10px;
	color: #888;
	font-size: 17px;
	padding-bottom: 0;
	font-weight: 300;
}

.dropdown-toggle::after {
	display: inline-block;
	margin-left: .255em;
	vertical-align: .480em;
	content: "";
	border-top: .3em solid;
	border-right: .3em solid transparent;
	border-bottom: 0;
	border-left: .3em solid transparent;
}



.bootstrap-select > .dropdown-toggle.bs-placeholder, .bootstrap-select > .dropdown-toggle.bs-placeholder:hover, .bootstrap-select > .dropdown-toggle.bs-placeholder:focus, .bootstrap-select > .dropdown-toggle.bs-placeholder:active {
	color: #444;
}


.cus-file {
	padding-left: 6px !important;
}


.form-group .form-line.access_info {
	border: 1px solid #424242 !important;
	padding-left: 10px;
}
.btn.btn-primary.btn-lg.custom_btn {
	padding: 10px 15px;
}
.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show > .btn-primary.dropdown-toggle {
	color: #fff;
	background-color: #0062cc !important;
	border-color: #005cbf;
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
                        Shipping
                        <span>
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-warning text-white text-uppercase text-bold right" data-toggle="modal" data-target="#addShippingModal">
                                + Add New
                            </button>
                        </span>
                    </h4>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" >
                        <thead>
                            <tr>
                                <th style="width: 60px">S/N</th>
                                <th>Area Name</th>
                                <th>Shipping Charge</th>

                                <th style="width: 60px">Status</th>
                                <th style="width: 160px">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($shippings as $key=>$shipping)

                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $shipping->shipping_area }}</td>
                                <td>{{ $shipping->shipping_charge }}</td>

                                <td>
                                    @if($shipping->is_active == 1)
                                        <a href="{{ route('shipping.status',$shipping->id) }}" class="btn btn-success">Active</a>
                                    @else
                                        <a href="{{ route('shipping.status',$shipping->id) }}" class="btn btn-danger">DeActive</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                        class="btn btn-warning btn-sm editShippingBtn"
                                        data-id="{{ $shipping->id }}"
                                        data-name="{{ $shipping->shipping_area }}"
                                        data-charge="{{ $shipping->shipping_charge }}"
                                        data-status="{{ $shipping->is_active }}">
                                        <i class="material-icons text-white">edit</i>
                                    </a>


                                    <form class="d-inline-block" action="{{ route('shipping.destroy',$shipping->id) }}" method="POST">
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
                @include('admin.layouts.pages.shipping.create')


                <!-- Edit Upazila Modal -->
               @include('admin.layouts.pages.shipping.edit')



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

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

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
