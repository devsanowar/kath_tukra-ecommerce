@extends('admin.layouts.app')
@section('title', 'Orders Page')
@push('styles')
    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">

    <!-- Bootstrap Material Datetime Picker Css -->
    <link
        href="{{ asset('backend') }}/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />

    <style>

        .table td,
        .table th {
            vertical-align: middle;
        }

        .bootstrap-select.btn-group.show-tick>.btn {
            padding-left: 10px;
            padding-right: -5px;
        }


        .filter-form {
            padding: 0px 5px;
            margin-bottom: 40px;
            margin-top: 20px;
        }

        .filter-form label {
            font-weight: 600;
            font-size: 15px;
            color: #333;
            margin-bottom: 6px;
            display: block;
        }


        .filter-form .custom_btn {
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            transition: all 0.3s ease-in-out;
        }

        .filter-form .custom_btn:hover {
            background-color: #e69500;
            color: #fff;
        }

        @media (max-width: 768px) {

            .filter-form .col-lg-3,
            .filter-form .col-lg-2 {
                margin-bottom: 15px;
            }
        }
    </style>
@endpush



@php
    $orderAmountSum = App\Models\Order::sum('total_price');
@endphp



@section('admin_content')

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">

                <div class="card">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <h4>All Orders</h4>
                        <div>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#blocklistModal">
                                Add to Blocklist
                            </button>
                        </div>
                        <div>
                            <a href="{{ route('block.list') }}" class="btn btn-primary">Block Lists</a>
                        </div>
                    </div>
                    <div class="body">
                        <form id="orderFilterForm" class="filter-form">
                            @csrf
                            <div class="row g-3 align-items-center">

                                <div class="col-lg-3 col-md-6 d-flex align-items-center">
                                    <input type="date" name="start_date" id="start_date" class="form-control"
                                        style="width: 100%">
                                </div>

                                <div class="col-lg-3 col-md-6 d-flex align-items-center">
                                    <label for="end_date" class="me-2 mb-0 fw-bold" style="width: 20%">To</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control"
                                        style="width: 80%">
                                </div>

                                <div class="col-lg-4 col-md-6 d-flex align-items-center">
                                    <label for="status" class="me-2 mb-0 fw-bold" style="width: 60%">Order Status</label>
                                    <select name="status" id="status" class="form-control show-tick" style="width: 40%">
                                        <option value="">All</option>
                                        <option value="pending">Pending</option>
                                        <option value="cancelled">Cancelled</option>
                                        <option value="confirmed">Confirmed</option>
                                        <option value="shipped">Shipped</option>
                                        <option value="delivered">Delivered</option>
                                    </select>
                                </div>

                                <div class="col-lg-2 col-md-6 d-flex align-items-center justify-content-start">
                                    <button type="submit" class="btn btn-warning custom_btn text-white">Show</button>
                                </div>

                            </div>
                        </form>

                        <table id="orderDataTable"
                            class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th style="width: 30px">S/N</th>
                                    <th style="width: 60px">Date</th>
                                    <th style="width: 70px">Order No</th>
                                    <th>Phone</th>
                                    <th>Amount</th>
                                    <th style="width: 194px">Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <th style="width: 30px"></th>
                                <th style="width: 60px"></th>
                                <th style="width: 60px"></th>
                                <th></th>
                                <th>Total : </th>
                                <th> TK. {{ round($orderAmountSum) }}</th>
                                <th style="width: 194px"></th>

                            </tfoot>

                            <tbody id="orderTableBody">

                                @foreach ($orders as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                        <td>#{{ $item->id }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->total_price }}</td>

                                        <td>
                                            <form class="order-status-form d-inline-block" data-id="{{ $item->id }}">
                                                @csrf
                                                <div class="form-group mb-0">
                                                    <div class="row clearfix" id="custom-select-form">
                                                        <div class="col-lg-8 col-md-8">
                                                            <select name="status"
                                                                class="form-control status-select show-tick">
                                                                <option value="pending" @selected($item->status == 'pending')> Pending </option>
                                                                <option @selected($item->status == 'cancelled') value="cancelled">Cancelled</option>
                                                                <option value="confirmed" @selected($item->status == 'confirmed')>Confirmed</option>
                                                                <option value="shipped" @selected($item->status == 'shipped')>Shipped</option>
                                                                <option value="delivered" @selected($item->status == 'delivered')>Delivered</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 status-update-button pl-0 mt-1">
                                                            <button type="submit"
                                                                class="btn btn-warning btn-sm text-white">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>


                                        <td>
                                            <a href="{{ route('orders.show', $item->id) }}" class="btn btn-primary btn-sm">
                                                <i class="material-icons">visibility</i></a>

                                            <form class="d-inline-block" action="{{ route('orders.destroy', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm"><i
                                                        class="material-icons">delete</i></button>
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

    @include('admin.layouts.pages.order.add-block')


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

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script
        src="{{ asset('backend') }}/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js">
    </script>

    <script src="{{ asset('backend') }}/assets/js/pages/forms/basic-form-elements.js"></script>


    <script>
        $('.show_confirm').click(function(event) {
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

        // Order filter
        $('#orderFilterForm').on('submit', function(e) {
            e.preventDefault();

            let start_date = $('input[name="start_date"]').val();
            let end_date = $('input[name="end_date"]').val();
            let status = $('select[name="status"]').val();

            $.ajax({
                url: "{{ route('filter.orders') }}",
                type: 'GET',
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    status: status
                },
                success: function(response) {
                    $('#orderTableBody').html(response.html);
                },
                error: function() {
                    alert("Something went wrong!");
                }
            });
        });

        //Order status change
        $(document).on('submit', '.order-status-form', function(e) {
            e.preventDefault();
            let form = $(this);
            let orderId = form.data('id');
            let status = form.find('select[name="status"]').val();
            let token = form.find('input[name="_token"]').val();

            if (!status) {
                alert('Status is required');
                return;
            }

            $.ajax({
                url: '/admin/order/change-status/' + orderId,
                type: 'POST',
                data: {
                    _token: token,
                    status: status
                },
                success: function(res) {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "timeOut": "1500",
                        "extendedTimeOut": "1000"
                    };
                    toastr.success(res.message);
                },
                error: function(xhr) {
                    toastr.error('Something went wrong');
                    console.log(xhr.responseText);
                }
            });
        });


        // Pagination override from dataTable
        $.extend(true, $.fn.dataTable.defaults, {
            "pageLength": 20,
            "lengthMenu": [
                [10, 20, 50, -1],
                [10, 20, 50, "All"]
            ]
        });

        $(document).ready(function() {
            $('#orderDataTable').DataTable();
        });


        // Block number added script
        $(document).ready(function() {
            $('#blocklistForm').submit(function(e) {
                e.preventDefault();

                let form = $(this);
                let url = form.attr('action');
                let formData = form.serialize();

                // Clear previous error
                $('#numberError').text('');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "timeOut": "1500",
                            "extendedTimeOut": "1000"
                        };
                        toastr.success(response.success);
                        $('#blocklistModal').modal('hide');
                        form[0].reset();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.number) {
                                $('#numberError').text(errors.number[0]);
                            }
                        } else {
                            toastr.success(response.error);
                        }
                    }
                });
            });
        });

    </script>

@endpush
