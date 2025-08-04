@extends('admin.layouts.app')
@section('title', 'All Cost Category')

@push('styles')
    <!-- JSZip for Excel export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <!-- pdfmake for PDF export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />


    <style>
        .form-line.case-input {
            border: 1px solid #8a8a8a;
        }

        .input-group .input-group-addon {
            padding-left: 10px;
        }

        .input-group .input-group-addon+.form-line {
            padding-left: 35px;
        }

        .bootstrap-select.btn-group.show-tick>.btn {
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

        .bootstrap-select>.dropdown-toggle.bs-placeholder,
        .bootstrap-select>.dropdown-toggle.bs-placeholder:hover,
        .bootstrap-select>.dropdown-toggle.bs-placeholder:focus,
        .bootstrap-select>.dropdown-toggle.bs-placeholder:active {
            color: #444;
        }

        .form-group .form-line.access_info {
            border: 1px solid #424242 !important;
            padding-left: 10px;
        }

        .btn.btn-primary.btn-lg.custom_btn {
            padding: 10px 15px;
        }

        .btn-primary:not(:disabled):not(.disabled).active,
        .btn-primary:not(:disabled):not(.disabled):active,
        .show>.btn-primary.dropdown-toggle {
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
                            All Cost Category
                            <span>
                                <!-- Button to trigger modal -->
                                <button type="button" class="btn btn-warning text-white text-uppercase text-bold right"
                                    data-toggle="modal" data-target="#addPostcategoryModal">
                                    + Add New
                                </button>
                            </span>
                        </h4>
                    </div>
                    <div class="body">
                        <table id="postCategoryDataTable"
                            class="table table-bordered table-striped table-hover dataTable js-basic-example">
                            <thead>
                                <tr>
                                    <th style="width: 60px">S/N</th>
                                    <th>Category Name</th>
                                    <th>Slug</th>
                                    <th style="width: 60px">Status</th>
                                    <th style="width: 160px">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($cost_categories as $key => $cost_category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="category-name">{{ $cost_category->category_name }}</td>
                                        <td class="category-slug">{{ $cost_category->category_slug }}</td>

                                        <td>
                                            <button data-id="{{ $cost_category->id }}"
                                                class="btn btn-sm status-toggle-btn {{ $cost_category->is_active ? 'btn-success' : 'btn-danger' }}">
                                                {{ $cost_category->is_active ? 'Active' : 'DeActive' }}
                                            </button>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-warning btn-sm editcategory"
                                                data-id="{{ $cost_category->id }}" data-name="{{ $cost_category->category_name }}"
                                                data-status="{{ $cost_category->is_active }}">
                                                <i class="material-icons text-white">edit</i>
                                            </a>

                                            <form id="delete-form-{{ $cost_category->id }}"
                                                  action="{{ route('cost_category.destroy', $cost_category->id) }}"
                                                  method="POST"
                                                  class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" data-id="{{ $cost_category->id }}" class="btn btn-danger btn-sm show_confirm">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </form>


                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <!--Add category Bootstrap Modal -->
                    @include('admin.layouts.pages.cost-category.create')

                    <!-- Edit category Modal -->
                    @include('admin.layouts.pages.cost-category.edit')

                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')

    <script>
        $(function () {
            $('.js-basic-example').DataTable({
                dom:
                    "<'row d-flex align-items-center mb-2'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                pageLength: 100,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                stateSave: true,
            });
        });
    </script>
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
        const categoryStatusRoute = "{{ route('post_category.status') }}";
        const csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('backend') }}/assets/js/postcategory.js"></script>

    <script>
        $('.show_confirm').click(function (event) {
            event.preventDefault();
            const id = $(this).data('id');
            const form = document.getElementById(`delete-form-${id}`);

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
                }
            });
        });

    </script>

@endpush
