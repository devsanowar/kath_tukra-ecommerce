<div class="product-area pt-20 pb-20 pos-relative fix">

    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 offset-lg-3 offset-xl-3">
                <div class="section-title text-center section-circle mb-70">
                    <h2>Our Product</h2>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <ul class="nav product-tab justify-content-center mb-75" id="myTab" role="tablist">
                    @foreach ($categories as $index => $category)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $category->id }}"
                                data-bs-toggle="tab" href="#category-{{ $category->id }}" role="tab">
                                <div class="product-tab-content flex flex-col items-center justify-center text-center">
                                    <div>
                                        <img class="w-10 h-10"
                                            src="{{ asset($category->image ?? 'img/icon/default.png') }}"
                                            alt="icon">
                                    </div>
                                    <h4>{{ $category->category_name }}</h4>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content" id="myTabContent">
                    @foreach ($categories as $index => $category)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                            id="category-{{ $category->id }}" role="tabpanel">
                            <div class="row">
                                @forelse ($category->products as $product)
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                        <div class="product-wrapper text-center mb-30">
                                            <div class="product2-img">
                                                <a href="{{ route('product_single.page', $product->id) }}"><img
                                                        src="{{ asset($product->thumbnail) }}" alt="img"></a>
                                                <div class="product-action">
                                                    <a href="#"><i class="fas fa-shopping-cart"></i></a>
                                                    <a href="#"><i class="fas fa-heart"></i></a>
                                                    <a href="#"><i class="fas fa-search"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-text product2-text">
                                                <h4><a
                                                        href="{{ route('product_single.page', $product->id) }}">{{ $product->product_name }}</a>
                                                </h4>
                                                <div class="pro-price mb-2">
                                                    {{-- <span>BDT:{{ number_format($product->regular_price, 2) }}</span> --}}
                                                    @if ($product->discount_price && $product->discount_type === 'flat')
                                                        @php
                                                            $product_discount_price =
                                                                $product->regular_price - $product->discount_price;
                                                        @endphp
                                                        <span>৳{{ number_format($product_discount_price, 2) }}</span>
                                                        <span
                                                            class="old-price">৳{{ number_format($product->regular_price, 2) }}</span>
                                                    @elseif ($product->discount_price && $product->discount_type === 'percent')
                                                        @php
                                                            $discount_amount =
                                                                ($product->regular_price * $product->discount_price) /
                                                                100;
                                                            $product_discount_price =
                                                                $product->regular_price - $discount_amount;
                                                        @endphp
                                                        <span>৳{{ number_format($product_discount_price, 2) }}</span>
                                                        <span
                                                            class="old-price">৳{{ number_format($product->regular_price, 2) }}</span>
                                                    @else
                                                        <span>৳{{ number_format($product->regular_price, 2) }}</span>
                                                    @endif
                                                </div>
                                                <form class="add-to-cart-form">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="order_qty" value="1">
                                                    <button type="submit" class="btn btn-primary btn-buy">
                                                        Add to Cart
                                                        <span class="spinner-border spinner-border-sm d-none"></span>
                                                    </button>
                                                </form>


                                                {{-- <button class="btn btn-primary">Add to Cart</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p class="text-center">No products found in {{ $category->category_name }}</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    $(document).ready(function() {
        $(document).on('submit', '.add-to-cart-form', function(e) {
            e.preventDefault();

            let form = $(this);
            let formData = form.serialize();

            let button = form.find('.btn-buy');
            let spinner = button.find('.spinner-border');

            button.prop('disabled', true);
            spinner.removeClass('d-none');

            $.ajax({
                url: "{{ route('addToCart') }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    toastr.success(response.message, '', { timeOut: 1500 });
                    $('#cart-count').text(response.cart_count);

                    // Optionally display the updated cart content if needed
                    console.log(response.cart_contents);

                    spinner.addClass('d-none');
                    button.prop('disabled', false);

                    $('#cart-count').text(response.itemCount);
                },
                error: function() {
                    toastr.error('Failed to add product.', '', { timeOut: 2000 });
                    spinner.addClass('d-none');
                    button.prop('disabled', false);
                }
            });
        });
    });
</script>

@endpush


