<!----------- filtering content start ------------------>
<div class="container py-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            <div class="sidebar">
                <div class="filter-title">Filter by Category</div>
                @php
                    $selectedCategory = request()->get('category');
                @endphp

                @foreach ($categories as $category)
                    <div class="form-check filter-item" data-name="{{ strtolower($category->category_name) }}">
                        <input class="form-check-input category-checkbox" type="checkbox" value="{{ $category->id }}"
                            id="category{{ $category->id }}" {{ $selectedCategory == $category->id ? 'checked' : '' }}>
                        <label class="form-check-label" for="category{{ $category->id }}">
                            {{ $category->category_name }}
                        </label>
                    </div>
                @endforeach

                <hr>

                {{-- <div class="filter-title">Filter by Size</div>

                @php
                    $uniqueSizes = collect($products)->pluck('sizes')->filter()->unique();
                @endphp

                @foreach ($uniqueSizes as $index => $size)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="size" id="size{{ $index }}"
                            value="{{ $size }}">
                        <label class="form-check-label" for="size{{ $index }}">{{ $size }}</label>
                    </div>
                @endforeach
                <hr> --}}

                <form method="GET" action="{{ route('shop') }}" id="brandFilterForm">
                    <div class="filter-title">Filter by Brands</div>

                    @foreach ($brands as $index => $brand)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $brand->id }}"
                                id="brand{{ $index }}" name="brand[]"
                                onchange="document.getElementById('brandFilterForm').submit()"
                                {{ in_array($brand->id, request()->get('brand', [])) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="brand{{ $index }}">{{ $brand->brand_name }}</label>
                        </div>
                    @endforeach
                </form>


            </div>
        </div>
        <!-- Product List -->
        <div class="col-md-9">
            <div class="row g-4">

                @foreach ($products as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 filter-item"
                        data-name="{{ strtolower($product->product_name . ' ' . $product->category->category_name . ' ' . $product->sizes) }}">
                        <div class="card product-card h-100">
                            <span
                                class="badge bg-danger text-white position-absolute top-0 start-0 m-3 rounded-circle d-flex justify-content-center align-items-center"
                                style="width: 40px; height: 40px; font-size: 14px;">
                                {{ $product->sizes }}
                            </span>

                            <img src="{{ $product->thumbnail }}" class="card-img-top product-img"
                                     alt="Men's Running Shoes" />
                            {{-- <img src="{{ asset('frontend/assets/images/wood.jpg') }}" class="img-fluid" alt="Wood"> --}}

                            <div class="card-body d-flex flex-column">
                                <h5 class="product-name">
                                    <a href="{{ route('product-detail', $product->id) }}">
                                        {{ $product->product_name }}
                                    </a>
                                </h5>
                                <p class="text-muted">{{ $product->category->category_name }}</p>
                                <div class="product-price">
                                    <span class="current-price">৳{{ number_format($product->discount_price) }}/-</span>
                                    <span class="original-price">৳{{ number_format($product->regular_price) }}/-</span>
                                    <span
                                        class="discount-percent">{{ round((($product->regular_price - $product->discount_price) * 100) / $product->regular_price) }}%
                                        OFF</span>
                                </div>

                                <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                    @csrf

                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <input type="hidden" name="sizes" value="{{ $product->sizes }}">

                                    <!-- Quantity Section (Initially Hidden) -->
                                    <div class="quantity-section d-none my-3 d-flex align-items-center">
                                        <input type="number" name="order_qty" min="1" value="1"
                                            class="form-control quantity-input w-50 me-2" />
                                        <button type="submit" class="btn btn-success confirm-add-btn">
                                            <i class="fas fa-check"></i> Confirm
                                        </button>
                                    </div>

                                    <!-- Trigger Button -->
                                    <button type="button" class="marco-btn btn-buy mt-auto add-to-cart-btn w-100">
                                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                    </button>
                                </form>


                            </div>
                        </div>
                    </div>
                @endforeach

            </div>


            <div class="d-flex justify-content-center mt-4">
                {{ $products->withQueryString()->links() }}
            </div>

        </div>
    </div>
</div>
<!----------- filtering content end ------------------>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.category-checkbox');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    // Redirect to the route with selected category
                    window.location.href = `/shop?category=${this.value}`;
                }
            });
        });
    });
</script>

<script>
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        const addButton = form.querySelector('.add-to-cart-btn');
        const qtySection = form.querySelector('.quantity-section');

        addButton.addEventListener('click', function() {
            if (qtySection.classList.contains('d-none')) {
                // Show qty input & change button text
                qtySection.classList.remove('d-none');
                form.querySelector('input[name="order_qty"]').focus();
                addButton.innerHTML = '<i class="fas fa-shopping-cart me-2"></i> Confirm Quantity';
            } else {
                // Submit form
                form.submit();
            }
        });

        // Optional: on form submit, disable button to prevent double submits
        form.addEventListener('submit', () => {
            addButton.disabled = true;
            addButton.innerHTML = 'Adding...';
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');

        if (!searchInput) return;

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            const items = document.querySelectorAll('.filter-item');

            items.forEach(item => {
                const name = item.dataset.name;
                if (name.includes(query)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>

<script>
    function updatePriceDisplay() {
        const min = document.getElementById('priceMin').value;
        const max = document.getElementById('priceMax').value;

        document.getElementById('minPriceText').textContent = min;
        document.getElementById('maxPriceText').textContent = max;
    }

    // Initialize on load
    document.addEventListener('DOMContentLoaded', updatePriceDisplay);
</script>
