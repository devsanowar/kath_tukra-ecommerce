@extends('admin.layouts.app')
@section('title', 'All Costs')

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

@endpush


@section('admin_content')

<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="uppercase"> All Costs<span><a href="{{ route('cost.create') }}" class="btn btn-primary text-white text-uppercase text-bold right">
                        + Add Cost
                   </a></span></h4>
                </div>
                <div class="body">

                    <form method="GET" action="{{ route('cost.index') }}" class="d-flex justify-content-center mb-4" style="padding-left: 15px">

                        <div style="padding-right: 6px">
                            <label for="start_date"><b>Start Date</b></label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>

                        <div style="padding-right: 6px">
                            <label for="end_date"><b>End Date</b></label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>

                        <div style="padding-right: 6px">
                            <label for="category_id"><b>Category</b></label>
                            <select name="category_id" id="category_id" class="form-control show-tick">
                                <option value="">All</option>
                                @foreach($cost_categories as $cost_category)
                                    <option value="{{ $cost_category->id }}" {{ request('category_id') == $cost_category->id ? 'selected' : '' }}>
                                        {{ $cost_category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div style="padding-right: 6px">
                            <label for="field_of_cost_id"><b>Field of Cost</b></label>
                            <select name="field_of_cost_id" id="field_of_cost_id" class="form-control show-tick">
                                <option value="">All</option>
                                @foreach($fields as $field)
                                    <option value="{{ $field->id }}" {{ request('field_of_cost_id') == $field->id ? 'selected' : '' }}>
                                        {{ $field->field_of_cost }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div style="padding-right: 12px; width: 150px">
                            <label for="spend_by"><b>Spend By</b></label>
                            <input type="text" name="spend_by" id="spend_by" class="form-control" value="{{ request('spend_by') }}">
                        </div>

                        <div style="padding-right: 3px; margin-top:35px !important;">
                            <button type="submit" class="btn btn-success" style="margin-right: 3px">Filter</button>
                            <a href="{{ route('cost.index') }}" class="btn btn-danger">Reset</a>
                        </div>

                    </form>

                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>S/N</th>
								<th>Date</th>
								<th>Category</th>
								<th>Field</th>
{{--								<th>Description</th>--}}
								<th>Amount</th>
								<th>Spend By</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php($sum = 0)
                            @foreach ($all_costs as $key=>$cost)
                            <tr>
                                <td>{{$key+1 }}</td>
								<td>{{ $cost->date }}</td>
								<td>{{ $cost->category->category_name }}</td>
								<td>{{ $cost->fieldOfCost->field_of_cost }}</td>
{{--								<td>{{ Str::words($cost->description, 3, '...') }}</td>--}}
								<td>{{ number_format($cost->amount, 2) }}</td>
								<td>{{ $cost->spend_by }}</td>

                                <td>

                                    <a href="{{ route('cost.detail', $cost->id) }}" class="btn btn-warning btn-sm"> <i class="material-icons text-white">info</i></a>
                                    <a href="{{ route('cost.edit', $cost->id) }}" class="btn btn-warning btn-sm"> <i class="material-icons text-white">edit</i></a>

                                    <form class="d-inline-block" action="{{ route('cost.destroy', $cost->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm show_confirm"><i class="material-icons">delete</i></button>
                                    </form>
                                </td>
                            </tr>
                            @php ($sum += $cost->amount)
                            @endforeach

                        </tbody>

                        <tfoot>
                        <tr>
                            <td colspan="4" class="text-end" style="text-align: right"><strong> Total Cost = </strong></td>
                            <td><strong>{{ number_format($sum, 2) }}</strong></td>
                            <td colspan="3"></td>
                        </tr>
                        </tfoot>

                    </table>

                </div>
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

    <script src="{{ asset('backend') }}/assets/js/post.js"></script>

@endpush
