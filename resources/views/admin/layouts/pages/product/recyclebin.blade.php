@extends('admin.layouts.app')
@section('title', 'Deleted Products')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/sweetalert2.min.css">
@endpush
@section('admin_content')

@php
    $countDeletedData = App\Models\Product::onlyTrashed()->get();
@endphp


<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class=""> Deleted Product ( {{ $countDeletedData->count() }} )  <span> <a href="{{ route('product.index') }}" class="btn btn-warning text-white text-bold text-uppercase right">
                        All Product
                    </a></span> </h4>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Product Thumbnail</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $key=>$product)
                            <tr>
                                <td>{{$key+1 }}</td>
                                <td><img src="{{ asset($product->thumbnail) }}" alt="" width="50"></td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->selling_price }}</td>
                                <td>{{ $product->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('product.restore',$product->id) }}" class="btn btn-primary btn-sm"> Restore </a>

                                    <form class="d-inline-block" action="{{ route('product.forceDelete',$product->id ) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm show_confirm">Permanently delete</button>
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
            confirmButtonText: "Yes, Permanently delete it!"
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


