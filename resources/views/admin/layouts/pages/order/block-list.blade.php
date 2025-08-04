@extends('admin.layouts.app')
@section('title', 'Block List')

@push('styles')
    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">
@endpush


@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Block lists</h4>
                        <a href="{{ route('order.index') }}" class="btn btn-primary">Orders</a>
                    </div>

                    <div class="body">
                        <table id="blocklistDatatable"
                            class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th style="width: 60px">S/N</th>
                                    <th>Number</th>
                                    <th style="width: 160px">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($blocklists as $key => $blocklist)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $blocklist->number }}</td>

                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm unblock-btn"
                                                data-id="{{ $blocklist->id }}">
                                                <i class="material-icons">lock_open</i> Unblock
                                            </button>
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
        $.extend(true, $.fn.dataTable.defaults, {
            "pageLength": 20,
            "lengthMenu": [
                [10, 20, 50, -1],
                [10, 20, 50, "All"]
            ]
        });

        $(document).ready(function() {
            $('#blocklistDatatable').DataTable();
        });


        $(document).ready(function() {
            // Event delegation
            $(document).on('click', '.unblock-btn', function() {
                let button = $(this);
                let id = button.data('id');

                if (confirm('Are you sure you want to unblock this number?')) {
                    $.ajax({
                        url: '/admin/unblock/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "timeOut": "1500",
                            "extendedTimeOut": "1000"
                        };
                            toastr.success(response.success);

                            // Remove the row from table
                            button.closest('tr').remove();
                        },
                        error: function(xhr) {
                            toastr.error('Something went wrong!');
                        }
                    });
                }
            });
        });
    </script>
@endpush
