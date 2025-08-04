@extends('admin.layouts.app')
@section('title', 'Cost Detail')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />
<link rel="stylesheet" href="{{ asset( 'backend') }}/assets/plugins/summernote/summernote.css"/>

<style>
    .table th{
        text-align: left;
        width: 150px;
    }
    .table td {
        text-align: left;
    }
</style>

@endpush
@section('admin_content')
<div class="container-fluid">
    <!-- Horizontal Layout -->
    <div class="row clearfix justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-uppercase"> Cost Detail <span><a href="{{ route('cost.index') }}" class="btn btn-primary right">All Costs</a></span></h4>
                </div>

                <div class="body mx-auto" style="width: 60%;">

                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Date</th>
                            <td>:</td>
                            <td>{{ $cost->date }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>:</td>
                            <td>{{ $cost->category->category_name }}</td>
                        </tr>
                        <tr>
                            <th>Field</th>
                            <td>:</td>
                            <td>{{ $cost->fieldOfCost->field_of_cost }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>:</td>
                            <td style="text-align: justify">{{ $cost->description }}</td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>:</td>
                            <td>{{ $cost->amount }}</td>
                        </tr>
                        <tr>
                            <th>Amount (In Word)</th>
                            <td>:</td>
                            <td>{{ $cost->amount }}</td>
                        </tr>
                        <tr>
                            <th>Spend By</th>
                            <td>:</td>
                            <td>{{ $cost->spend_by }}</td>
                        </tr>

                    </table>

                </div>

            </div>
        </div>


    </div>
    <!-- #END# Horizontal Layout -->
</div>
@endsection

@push('scripts')
<script src="{{ asset('backend') }}/assets/plugins/summernote/summernote.js"></script>

@endpush
