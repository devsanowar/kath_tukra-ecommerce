@extends('admin.layouts.app')
@section('title', 'Privilege')
@section('admin_content')
    <div class="container-fluid">
        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-uppercase"> Manage Sidebar Menu </h5>
                    </div>
                    <div class="body">
                        <div class="demo-switch">
                            <form id="privilegeForm">
                                @csrf
                                <div class="row clearfix">

                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <div class="demo-switch-title">Category</div>
                                        <div class="switch">
                                            <label>
                                                <input type="checkbox" name="category_status" @checked($menuStatus->category_status)>
                                                <span class="lever"></span></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <div class="demo-switch-title">Sub Category</div>
                                        <div class="switch">
                                            <label>
                                                <input type="checkbox" name="subcategory_status"
                                                    @checked($menuStatus->subcategory_status)>
                                                <span class="lever"></span></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <div class="demo-switch-title">Brand</div>
                                        <div class="switch">
                                            <label>
                                                <input type="checkbox" name="brand_status" @checked($menuStatus->brand_status)>
                                                <span class="lever"></span></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <div class="demo-switch-title">Website Color</div>
                                        <div class="switch">
                                            <label>
                                                <input type="checkbox" name="website_color_status"
                                                    @checked($menuStatus->website_color_status)>
                                                <span class="lever"></span></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <div class="demo-switch-title">User Setting</div>
                                        <div class="switch">
                                            <label>
                                                <input type="checkbox" name="user_status" @checked($menuStatus->user_status)>
                                                <span class="lever"></span></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <div class="demo-switch-title">
                                            <button type="submit" class="btn btn-primary">UPDATE</button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- #END# Horizontal Layout -->
    </div>
@endsection

@push('scripts')
    <script>
        $('#privilegeForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('privilege.update') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    toastr.success(response.message);
                },
                error: function(xhr) {
                    toastr.error('Something went wrong! Please try again.');
                }
            });
        });
    </script>
@endpush
