@extends('admin.layouts.app')
@section('title', 'Add Product')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />

    <style>


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
                        <h4 class="text-uppercase"> Add Product <span><a href="{{ route('product.index') }}"
                                    class="btn btn-primary right">All Product</a></span></h4>
                    </div>
                    <div class="body">
                        {{-- <form class="form-horizontal" action="{{ route('subcategory.store') }}"
                        method="POST" enctype="multipart/form-data"> --}}
                        <form id="productForm" enctype="multipart/form-data" class="form-horizontal">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label for="product_name"><b>Product Name</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <input type="text" id="product_name" name="product_name" class="form-control"
                                            placeholder="Enter Product name">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="regular_price"><b>Regular Price</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <input type="text" id="regular_price" name="regular_price" class="form-control"
                                            placeholder="Enter regular price">
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
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="discount_price"><b>Discount Price</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <input type="text" id="discount_price" name="discount_price" class="form-control"
                                            placeholder="Enter discount price">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label for="category_id"><b>Brand</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <select name="category_id" class="form-control show-tick">
                                            <option disabled selected>Select Brand ....</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <label for="discount_type"><b>Discount Type</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <select name="discount_type" class="form-control show-tick">
                                            <option value="flat">Flat</option>
                                            <option value="percent">Percent</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <label for="short_description"><b>Short Description (Optional)</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <textarea rows="4" id="short_description" name="short_description" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <label for="long_description"><b>Long Description (Optional)</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <textarea rows="4" id="ckeditor" name="long_description" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label for="stock_quantity"><b>Stock Quantity</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <input type="text" id="stock_quantity" name="stock_quantity" class="form-control"
                                            placeholder="Enter stock Quantity">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="sizes"><b>Size</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <input type="text" id="sizes" name="sizes" class="form-control"
                                               placeholder="Enter product size">
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

                                    @error('thumbnail')
                                            <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="images"><b>Images</b></label>
                                    <div class="form-group">
                                        <div class="mb-2" style="border: 1px solid #ccc">
                                            <input class="form-control" type="file" id="imageInput" name="images[]" multiple
                                                accept="image/*">
                                        </div>
                                        <div id="previewContainer" class="d-flex flex-wrap"></div>
                                    </div>
                                    @error('images')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label for="is_featured"><b>Featured</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <select name="is_featured" class="form-control show-tick">
                                            <option value="1">Featured</option>
                                            <option value="0">No Featured</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="is_active"><b>Status</b></label>
                                    <div class="form-group" style="border: 1px solid #ccc">
                                        <select name="is_active" class="form-control show-tick">
                                            <option value="1">Active</option>
                                            <option value="0">DeActive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary right" id="submitBtn">
                                        <span id="submitBtnText">SAVE PRODUCT</span>
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

    imageInput.addEventListener('change', function() {
        // Clear old previews
        previewContainer.innerHTML = '';

        // Reset DataTransfer and rebuild with new selection
        dt = new DataTransfer();

        Array.from(this.files).forEach((file, index) => {
            dt.items.add(file); // Add file to DataTransfer
            const reader = new FileReader();
            reader.onload = function(e) {
                const wrapper = document.createElement('div');
                wrapper.classList.add('img-preview-wrapper');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-preview');

                const removeBtn = document.createElement('button');
                removeBtn.innerHTML = '&times;';
                removeBtn.classList.add('remove-btn');
                removeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    dt.items.remove(index); // Remove from DataTransfer
                    imageInput.files = dt.files; // Reset input with new files
                    renderPreviews(); // Re-render
                });

                wrapper.appendChild(removeBtn);
                wrapper.appendChild(img);
                previewContainer.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });

        imageInput.files = dt.files; // Set files to input
    });

    function renderPreviews() {
        previewContainer.innerHTML = '';
        Array.from(dt.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const wrapper = document.createElement('div');
                wrapper.classList.add('img-preview-wrapper');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-preview');

                const removeBtn = document.createElement('button');
                removeBtn.innerHTML = '&times;';
                removeBtn.classList.add('remove-btn');
                removeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    dt.items.remove(index);
                    imageInput.files = dt.files;
                    renderPreviews();
                });

                wrapper.appendChild(removeBtn);
                wrapper.appendChild(img);
                previewContainer.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
    }
</script>


<script>
    $('#productForm').on('submit', function(e) {
        e.preventDefault();

        // Show spinner and disable submit button
        $('#submitBtn').attr('disabled', true);
        $('#spinner').removeClass('d-none');
        $('#submitBtnText').text('Saving...');

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('product.store') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Hide spinner and enable submit button
                $('#submitBtn').attr('disabled', false);
                $('#spinner').addClass('d-none');
                $('#submitBtnText').text('SAVE PRODUCT');

                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "positionClass": "toast-top-right",
                };
                toastr.success('Product successfully created!');
                $('#productForm')[0].reset(); // Reset form
            },
            error: function(xhr) {
                // Hide spinner and enable submit button
                $('#submitBtn').attr('disabled', false);
                $('#spinner').addClass('d-none');
                $('#submitBtnText').text('Save');

                toastr.error('Something went wrong!');
            }
        });
    });
</script>

@endpush
