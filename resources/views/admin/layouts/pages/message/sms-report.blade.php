@extends('admin.layouts.app')
@section('title', 'All sent Message')

@push('styles')

    <style>
        .dt-buttons {
            margin-top: 0 !important;
        }
    </style>

    <!-- JSZip for Excel export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <!-- pdfmake for PDF export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- JQuery DataTable Css -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">

@endpush

@section('admin_content')

<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-uppercase"> SMS Delivery Report ({{ $totalSmsCount }})</h4>
                </div>
                <div class="body">

                    <form method="GET" action="" class="row justify-content-center mb-4">
                        <div class="col-md-3">
                            <label for="start_date"><b>Start Date</b></label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date"><b>End Date</b></label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-success" style="margin-right: 5px">Filter</button>
                            <a href="{{ url()->current() }}" class="btn btn-danger">Reset</a>
                        </div>
                    </form>

                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Used SMS</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        @php
                            $totalSmsCount = 0;
                        @endphp

                        <tbody>
                            @foreach ($sms_reports as $key=>$sms_report)

                                @php
                                    $message = $sms_report->message_body;
                                    $charCount = mb_strlen($message, 'UTF-8');

                                    $isUnicode = preg_match('/[^\x00-\x7F]/', $message);
                                    $segmentSize = $isUnicode ? 70 : 160;

                                    $smsCount = ceil($charCount / $segmentSize);
                                    if ($sms_report->success == 1) {
                                        $totalSmsCount += $smsCount;
                                    }

                                @endphp

                            <tr>
                                <td>{{$key+1 }}</td>
                                <td>
                                    {{ $sms_report->order?->name ?? 'Custom Number' }}
                                </td>
                                <td>{{ $sms_report->mobile }}</td>
                                <td>{{ $smsCount }} SMS</td>


                                <td>{{ $sms_report->created_at->format('d-m-Y h:i A') }}</td>
                                <td>
                                    @if($sms_report->success == 1)
                                        <a href="" class="btn btn-success">Success</a>
                                    @else
                                        <a href="" class="btn btn-danger">Failed</a>
                                    @endif
                                </td>

                                <td>

                                    @auth
                                        @if(auth()->user()->system_admin === 'Admin')
                                            <form class="d-inline-block" action="{{ route('sms-report.destroy', $sms_report->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm"><i class="material-icons">delete</i></button>
                                            </form>
                                        @endif
                                    @endauth
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total Used SMS =</strong></td>
                            <td colspan="4"><strong>{{ $totalSmsCount }} SMS</strong></td>
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



<script>
    $('.show_confirm').click(function(event){
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


</script>

@endpush
