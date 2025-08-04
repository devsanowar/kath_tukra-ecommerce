@extends('admin.layouts.app')
@section('title', 'Edit Product')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />

    <style>
        .image-wrapper:hover .delete-image-btn {
            display: block !important;
        }
        .image-wrapper:hover .multiple-image{
            background: #000;
        }


        .img-preview-wrapper {
            position: relative;
            display: inline-block;
            margin: 10px;
        }

        .img-preview {
            max-width: 150px;
            max-height: 150px;
            border-radius: 10px;
            border: 1px solid #ccc;
            object-fit: cover;
        }

        .remove-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 14px;
            width: 24px;
            height: 24px;
            cursor: pointer;
            z-index: 10;
        }

    </style>


@endpush
@section('admin_content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-uppercase"> Edit Product <span><a href="{{ route('product.index') }}"
                                    class="btn btn-primary right">All Product</a></span></h4>
                    </div>
                    <div class="body">
                        {{-- <form class="form-horizontal" action="{{ route('subcategory.store') }}"
                        method="POST" enctype="multipart/form-data"> --}}
                        <form id="productForm" action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label for="product_name"><b>Product Name</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <input type="text" id="product_name" name="product_name" class="form-control"
                                            placeholder="Enter Product name" value="{{ $product->product_name }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="regular_price"><b>Regular Price</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <input type="text" id="regular_price" name="regular_price" class="form-control"
                                            placeholder="Enter regular price" value="{{ $product->regular_price }}">
                                    </div>
                                </div>


                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label for="category_id"><b>Product Category</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <select name="category_id" class="form-control show-tick">
                                            <option disabled selected>Select Category ....</option>
                                            @foreach ($categories as $category)
                                                <option @if($category->id == $product->category_id) selected @endif value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="discount_price"><b>Discount Price</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <input type="text" id="discount_price" name="discount_price" class="form-control"
                                            placeholder="Enter discount price" value="{{ $product->discount_price }}">
                                    </div>
                                </div>



                            </div>

                            <div class="row mb-3">

                                <div class="col-lg-6">
                                    <label for="brand_id"><b>Brand</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <select name="brand_id" class="form-control show-tick" id="brand_id">
                                            <option disabled selected>Select Brand ....</option>
                                            @foreach ($brands as $brand)
                                                <option @if($brand->id == $product->brand_id) selected @endif value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <label for="discount_type"><b>Discount Type</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <select name="discount_type" class="form-control show-tick">
                                            <option @if($product->discount_type == 'flat') selected @endif value="flat">Flat</option>
                                            <option @if($product->discount_type == 'percent') selected @endif value="percent">Percent</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <label for="short_description"><b>Short Description (Optional)</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <textarea rows="4" id="short_description" name="short_description" class="form-control">{!! $product->short_description !!}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <label for="long_description"><b>Long Description (Optional)</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <textarea rows="4" id="ckeditor" name="long_description" class="form-control">{!! $product->long_description !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label for="stock_quantity"><b>Stock Quantity</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <input type="text" id="stock_quantity" name="stock_quantity" class="form-control"
                                            placeholder="Enter stock Quantity" value="{{ $product->stock_quantity }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="sizes"><b>Size</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <input type="text" id="sizes" name="sizes" class="form-control"
                                               placeholder="Enter product size" value="{{ $product->sizes }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label for="thumbnail"><b>Thumbnail Image*</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <input type="file" class="form-control @error('thumbnail')invalid @enderror"
                                            id="thumbnail" name="thumbnail">
                                    </div>

                                    @if($product->thumbnail)
                                        <img class="mt-2" src="{{ asset($product->thumbnail) }}" alt="" width="80">
                                    @endif

                                    @error('thumbnail')
                                            <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="col-lg-6">
                                    <label for="imageInput"><b>Images</b></label>
                                    <div class="form-group mb-2 p-2 border rounded bg-white">
                                        <input type="file" class="form-control" id="imageInput" name="images[]" multiple>
                                    </div>

                                    <div class="row g-3 mt-2" id="previewContainer">
                                        {{-- Existing Images --}}
                                        @if($product->images && is_array(json_decode($product->images, true)))
                                            @foreach(json_decode($product->images, true) as $image)
                                                <div class="col-4 col-md-3 col-lg-2 position-relative old-image-wrapper" data-image-path="{{ $image }}">
                                                    <div class="border rounded shadow-sm overflow-hidden position-relative bg-light">
                                                        <img src="{{ asset($image) }}" class="img-fluid" style="width: 200px; object-fit: cover;">
                                                        <button type="button"
                                                                class="btn btn-sm btn-danger position-absolute remove-old-image"
                                                                style="top: 5px; right: 5px;" title="Remove">
                                                            &times;
                                                        </button>
                                                        <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label for="is_featured"><b>Featured</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <select name="is_featured" class="form-control show-tick">
                                            <option @if($product->is_featured == true) selected @endif value="1">Featured</option>
                                            <option @if($product->is_featured == false) selected @endif value="0">No Featured</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="is_active"><b>Status</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <select name="is_active" class="form-control show-tick">
                                            <option @if($product->is_active == 1) selected @endif value="1">Active</option>
                                            <option @if($product->is_active == 0) selected @endif value="0">DeActive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary right" id="submitBtn">
                                        <span id="submitBtnText">UPDATE PRODUCT</span>
                                        <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('backend') }}/assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor -->
<script src="{{ asset('backend') }}/assets/js/pages/forms/editors.js"></script>

<script>
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('previewContainer');
    let dt = new DataTransfer();

    imageInput.addEventListener('change', function () {
        // Remove any previous new image previews
        previewContainer.querySelectorAll('.new-image-wrapper').forEach(el => el.remove());

        dt = new DataTransfer();

        Array.from(this.files).forEach((file, index) => {
            dt.items.add(file);
            const reader = new FileReader();
            reader.onload = function (e) {
                const wrapper = document.createElement('div');
                wrapper.classList.add('col-4', 'col-md-3', 'col-lg-2', 'position-relative', 'new-image-wrapper');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-fluid');
                img.style.width = '200px';
                img.style.objectFit = 'cover';

                const removeBtn = document.createElement('button');
                removeBtn.innerHTML = '&times;';
                removeBtn.classList.add('btn', 'btn-sm', 'btn-danger', 'position-absolute');
                removeBtn.style.top = '5px';
                removeBtn.style.right = '5px';

                removeBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    dt.items.remove(index);
                    imageInput.files = dt.files;
                    wrapper.remove();
                });

                wrapper.appendChild(img);
                wrapper.appendChild(removeBtn);
                previewContainer.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });

        imageInput.files = dt.files;
    });

    // Handle removing old images (just from view & form)
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-old-image')) {
            const wrapper = e.target.closest('.old-image-wrapper');
            wrapper.remove(); // remove from DOM
        }
    });
</script>

@endpush
