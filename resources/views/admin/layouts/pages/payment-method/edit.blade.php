@extends('admin.layouts.app')
@section('title', 'Edit Method')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />
@endpush
@section('admin_content')
    <div class="container-fluid">
        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-uppercase"> Create method <span><a href="{{ route('payment_method.index') }}"
                                    class="btn btn-primary right">All payment method</a></span></h4>

                    </div>
                    <div class="body">
                        <form class="form-horizontal" action="{{ route('payment_method.update', $payment_method->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="name"><b>Method Name*</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="name" name="name"
                                            class="form-control @error('name')invalid @enderror" placeholder="Enter Name "
                                            value="{{ $payment_method->name }}">
                                    </div>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="payment_number"><b>Phone Number*</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="text" id="payment_number" name="payment_number"
                                            class="form-control @error('payment_number')invalid @enderror"
                                            placeholder="Enter Payment number "
                                            value="{{ $payment_method->payment_number }}">
                                    </div>
                                    @error('payment_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">

                                <div class="form-group">
                                    <label><b>Method type</b></label>
                                    <select class="form-control show-tick" name="method_type">
                                        <option value="">Select Method</option>
                                        <option @if ($payment_method->method_type == 'Personal') selected @endif value="Personal">Personal
                                        </option>
                                        <option @if ($payment_method->method_type == 'Agent') selected @endif value="Agent">Agent
                                        </option>
                                    </select>
                                    <div class="text-danger font-weight-bold mt-2" id="methodError"></div>
                                </div>
                            </div>



                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">
                                <label for="customFile"><b> Image* ( Max size : 150px )</b></label>
                                <div class="form-group">
                                    <div class="" style="border: 1px solid #ccc">
                                        <input type="file" class="form-control @error('image')invalid @enderror" id="customFile" / name="image">
                                    </div>
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <img src="{{ asset($payment_method->image) }}" alt="" class="mt-2" width="50">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7 mb-3">

                                <div class="form-group">
                                    <label><b>Status</b></label>
                                    <select class="form-control show-tick" name="is_active">
                                        <option value="">Select Status</option>
                                        <option @if($payment_method->is_active == 1 ) selected @endif value="1">Active</option>
                                        <option @if($payment_method->is_active == 0 ) selected @endif value="0">Deactive</option>
                                    </select>
                                    <div class="text-danger font-weight-bold mt-2" id="statusError"></div>
                                </div>
                            </div>


                            <div class="col-lg-12 col-md-12 col-sm-8 col-xs-7">
                                <button type="submit" class="btn btn-raised btn-primary m-t-15 waves-effect">UPDATE</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


        </div>
        <!-- #END# Horizontal Layout -->
    </div>
@endsection

@push('scripts')
@endpush
