@extends('admin.layouts.app')
@section('title', 'Promo Banner')

@push('styles')
    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />


    <style>
        .form-line.case-input {
            border: 1px solid #8a8a8a;
        }
    </style>
@endpush


@section('admin_content')


    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            All Promo Banner
                            <span>
                                <!-- Button to trigger modal -->
                                <button type="button" class="btn btn-warning text-white text-uppercase text-bold right"
                                    data-toggle="modal" data-target="#addPromoBannerModal">
                                    + Add New
                                </button>
                            </span>
                        </h4>
                    </div>
                    <div class="body">
                        <table id="upazilaDataTable"
                            class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th style="width: 60px">S/N</th>
                                    <th>promobanner Name</th>
                                    <th>Page Url</th>
                                    <th style="width: 60px">Status</th>
                                    <th style="width: 160px">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($promobanners as $key => $promobanner)
                                    <tr id="promoBannerRow-{{ $promobanner->id }}">
                                        <td>{{ $promobanner->id }}</td>
                                        <td class="promobanner-image"><img src="{{ asset($promobanner->image) }}"
                                                alt="image" width="60"></td>
                                        <td class="promobanner-url">{{ $promobanner->url }}</td>

                                        <td>
                                            <button data-id="{{ $promobanner->id }}"
                                                class="btn btn-sm status-toggle-btn {{ $promobanner->is_active ? 'btn-success' : 'btn-danger' }}">
                                                {{ $promobanner->is_active ? 'Active' : 'DeActive' }}
                                            </button>
                                        </td>
                                        <td>

                                            <a href="javascript:void(0)" class="btn btn-warning btn-sm editPromoBanner"
                                                data-id="{{ $promobanner->id }}"
                                                data-image="{{ asset($promobanner->image) }}"
                                                data-url="{{ $promobanner->url }}"
                                                data-status="{{ $promobanner->is_active }}">
                                                <i class="material-icons text-white">edit</i>
                                            </a>


                                            {{-- <form class="d-inline-block"
                                                action="{{ route('promobanner.destroy', $promobanner->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm show_confirm_delete">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </form> --}}

                                            <button type="button" class="btn btn-danger btn-sm promo-delete-btn"
                                                data-id="{{ $promobanner->id }}">
                                                <i class="material-icons">delete</i>
                                            </button>


                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <!--Add promobanner Bootstrap Modal -->
                    @include('admin.layouts.pages.promo.create')


                    <!-- Edit promobanner Modal -->
                    @include('admin.layouts.pages.promo.edit')




                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <!-- Jquery DataTable Plugin Js -->

    <script src="{{ asset('backend') }}/assets/js/sweetalert2.all.min.js"></script>

    <!-- Script For status change -->
    <script>
        const promobannerStatusRoute = "{{ route('promobanner.status') }}";
        const csrfToken = "{{ csrf_token() }}";

        $(document).ready(function() {
            // Event delegation
            $(document).on('click', '.promo-delete-btn', function() {
                let button = $(this);
                let id = button.data('id');

                if (confirm('Are you sure you want to delete this number?')) {
                    $.ajax({
                        url: "{{ route('promobanner.destroy', '') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
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
    <script src="{{ asset('backend') }}/assets/js/promobanner.js"></script>
@endpush
