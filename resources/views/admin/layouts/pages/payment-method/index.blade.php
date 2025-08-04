@extends('admin.layouts.app')
@section('title', 'Payment Method')

@push('styles')
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">
@endpush

@section('admin_content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>
                        All District
                        <span>
                            <a href="{{ route('payment_method.create') }}" class="btn btn-warning text-white text-uppercase text-bold right">
                                + Add New
                            </a>
                        </span>
                    </h4>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover" >
                        <thead>
                            <tr>
                                <th style="width: 60px">S/N</th>
                                <th>Image</th>
                                <th>Method Name</th>
                                <th>Number</th>
                                <th>Method Type</th>
                                <th>Status</th>
                                <th style="width: 100px">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($paymentMethods as $key=>$paymentMethod)

                            <tr>
                                <td>{{ $paymentMethod->id }}</td>
                                <td><img src="{{ asset($paymentMethod->image) }}" alt="" width="50"></td>
                                <td>{{ $paymentMethod->name }}</td>
                                <td>{{ $paymentMethod->payment_number }}</td>
                                <td>{{ $paymentMethod->method_type }}</td>
                                <td>
                                    <button data-id="{{ $paymentMethod->id }}" class="btn btn-sm status-toggle-btn {{ $paymentMethod->is_active ? 'btn-success' : 'btn-danger' }}">
                                        {{ $paymentMethod->is_active ? 'Active' : 'DeActive' }}
                                    </button>
                                </td>
                                <td>
                                    <a href="{{ route('payment_method.edit', $paymentMethod->id) }}" class="btn btn-warning btn-sm">
                                        <i class="material-icons text-white">edit</i>
                                    </a>

                                    <form class="d-inline-block" action="{{ route('payment_method.destroy',$paymentMethod->id) }}" method="POST">
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


<!-- Script For status change -->
<script>
    const paymentMethodStatusRoute = "{{ route('payment_method.status') }}";
    const csrfToken = "{{ csrf_token() }}";
</script>

<script src="{{ asset('backend') }}/assets/js/sweetalert2.all.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/payment_method.js"></script>

@endpush
