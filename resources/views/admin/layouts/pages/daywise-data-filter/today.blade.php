@extends('admin.layouts.app')
@section('title', 'Today\'s Orders')

@section('admin_content')
    <div class="container-fluid">

        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12 mt-4 mb-4 text-center">
                <div class="btn-group" role="group" aria-label="Date Filters" style="box-shadow:unset">
                    <a class="btn btn-primary mx-1" href="{{ route('sevenday') }}">07 Day</a>
                    <a class="btn btn-primary mx-1" href="{{ route('fiftinday') }}">15 Day</a>
                    <a class="btn btn-primary mx-1" href="{{ route('thirtyday') }}">Monthly</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Today's Orders ({{ \Carbon\Carbon::today()->format('d M Y') }})</h4>
            </div>
            <div class="card-body">
                @if ($orders->isEmpty())
                    <p>No orders found today.</p>
                @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Order Time</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Order Time</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $order->customer_name ?? 'N/A' }}</td>
                                    <td>{{ $order->phone ?? 'N/A' }}</td>
                                    <td>{{ $order->total_amount }}</td>
                                    <td>{{ ucfirst($order->status) }}</td>
                                    <td>{{ $order->created_at->format('h:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
