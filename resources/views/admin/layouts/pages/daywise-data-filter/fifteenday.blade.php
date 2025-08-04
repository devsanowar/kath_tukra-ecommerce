@extends('admin.layouts.app')
@section('title', 'Last 15 Days Orders')

@push('styles')
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
@endpush

@section('admin_content')

<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
            <div class="col-lg-12 mt-4 mb-4 text-center">
                <div class="btn-group" role="group" aria-label="Date Filters" style="box-shadow:unset">
                    <a class="btn btn-primary ml-2" href="{{ route('today') }}">Today Day</a>
                    <a class="btn btn-primary ml-2" href="{{ route('sevenday') }}">7 Day</a>
                    <a class="btn btn-primary ml-2" href="{{ route('thirtyday') }}">30 Day</a>
                </div>
            </div>
        </div>


        <div class="card mb-3">
            <div class="card-header">
                <h4><strong>15 day's order lists</strong></h4>
            </div>
            <div class="body">

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
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->first_name ?? 'N/A' }}</td>
                                    <td>{{ $order->total_price }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

            </div>
        </div>


</div>

@endsection

@push('scripts')
<script src="{{ asset('backend') }}/assets/bundles/datatablescripts.bundle.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/pages/tables/jquery-datatable.js"></script>

<script>
    $.extend(true, $.fn.dataTable.defaults, {
        "pageLength": 20,
        "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]]
    });

    $(document).ready(function() {
        $('.js-exportable').each(function() {
            $(this).DataTable();
        });
    });
</script>
@endpush
