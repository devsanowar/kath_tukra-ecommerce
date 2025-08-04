@extends('admin.layouts.app')
@section('title', 'Monthly Order List')

@push('styles')
<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />
@endpush

@section('admin_content')

<div class="container-fluid">
    <div class="row align-items-center">
    <div class="col-lg-6 mt-4">
        <h4 class="mb-0">Monthly Order List</h4>
    </div>
    <div class="col-lg-6 mt-4 text-right">
        <div class="btn-group float-right" role="group" aria-label="Date Filters" style="box-shadow:unset">
            <a class="btn btn-primary ml-2" href="{{ route('today') }}">Today</a>
            <a class="btn btn-primary ml-2" href="{{ route('sevenday') }}">07 Day</a>
            <a class="btn btn-primary ml-2" href="{{ route('fiftinday') }}">15 Day</a>
        </div>
    </div>
</div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">

            @foreach ($ordersByMonth as $group)
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>{{ $group['month'] }}</strong>
                    </div>
                    <div class="body">
                        @if ($group['orders']->isEmpty())
                            <p class="p-3">No orders found for this month.</p>
                        @else
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th style="width: 60px">S/N</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Order Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($group['orders'] as $key => $order)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $order->order_id }}</td>
                                            <td>{{ $order->first_name ?? 'N/A' }}</td>
                                            <td>{{ $order->total_price }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            @endforeach

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
        "lengthMenu": [ [10, 20, 50, -1], [10, 20, 50, "All"] ]
    });

    $(document).ready(function() {
        // Initialize DataTables for each table individually
        $('.js-exportable').each(function() {
            $(this).DataTable();
        });
    });
</script>
@endpush
