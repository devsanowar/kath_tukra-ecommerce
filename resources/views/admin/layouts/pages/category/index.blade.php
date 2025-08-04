@extends('admin.layouts.app')
@section('title', 'Category')
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
                        <h4 class="text-uppercase"> All Categories
                            <span>
                                <a href="{{ route('category.create') }}" class="btn btn-primary right">Add Category</a>
                            </span>
                        </h4>
                    </div>


                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($categories as $key => $category)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td><img src="{{ asset($category->image) }}" alt="category image" width="40"></td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>
                                            <button data-id="{{ $category->id }}" class="btn btn-sm status-toggle-btn {{ $category->is_active ? 'btn-success' : 'btn-danger' }}">
                                                {{ $category->is_active ? 'Active' : 'DeActive' }}
                                            </button>
                                        </td>
                                        <td>
                                            <a href="{{ route('category.edit', $category->id) }}"
                                            class="btn btn-warning"><i class="material-icons text-white">edit</i></a>

                                            <form class="d-inline-block" action="{{ route('category.destroy',$category->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-raised bg-pink waves-effect show_confirm"> <i
                                                        class="material-icons">delete</i> </button>
                                            </form>
                                        </td>

                                    <tr>
                                    @empty
                                    <table>
                                        <thead>
                                            <tr>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                 Category Not Found! :) Please Add Category. Thank you
                                            </tr>
                                        </tbody>
                                    </table>

                                @endforelse

                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- #END# Horizontal Layout -->
    </div>
@endsection

@push('scripts')
<script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/sweetalert2.all.min.js"></script>

 <script>
    const categoryStatusRoute = "{{ route('category.status') }}";
    const csrfToken = "{{ csrf_token() }}";
</script>
<script src="{{ asset('backend') }}/assets/js/category.js"></script>




@endpush
