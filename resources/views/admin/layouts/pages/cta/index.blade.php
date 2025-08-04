@extends('admin.layouts.app')
@section('title', 'CTA (Call To Action)')

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
                            CTA (Call To Action)
                            <span>
                                <!-- Button to trigger modal -->
                                <a href="{{ route('cta.create') }}"
                                    class="btn btn-warning text-white text-uppercase text-bold right">
                                    + Add New
                                </a>
                            </span>
                        </h4>
                    </div>
                    <div class="body">
                        <table id="ctaDataTable"
                            class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th style="width: 60px">S/N</th>
                                    <th>Bg Image</th>
                                    <th>Title</th>
                                    <th>Sub Title</th>
                                    <th>status</th>
                                    <th style="width: 160px">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($ctas as $key => $cta)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset($cta->image) }}" alt="" width="60"></td>
                                        <td>{{ $cta->title }}</td>
                                        <td>{{ $cta->sub_title }}</td>

                                        <td>
                                            <button data-id="{{ $cta->id }}"
                                                class="btn btn-sm status-toggle-btn {{ $cta->is_active ? 'btn-success' : 'btn-danger' }}">
                                                {{ $cta->is_active ? 'Active' : 'DeActive' }}
                                            </button>
                                        </td>
                                        <td>
                                            <a href="{{ route('cta.edit', $cta->id) }}"
                                                class="btn btn-warning btn-sm editcta">
                                                <i class="material-icons text-white">edit</i>
                                            </a>

                                            <form class="d-inline-block" action="{{ route('cta.destroy', $cta->id) }}"
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


@endsection

@push('scripts')
    <script src="{{ asset('backend') }}/assets/js/sweetalert2.all.min.js"></script>
    <script>
        const ctaStatusRoute = "{{ route('cta.status') }}";
        const csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('backend') }}/assets/js/cta.js"></script>
@endpush
