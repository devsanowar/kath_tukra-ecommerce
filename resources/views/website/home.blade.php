@extends('website.layouts.app')

@section('body')
    @include('website.layouts.pages.home.slider')

    <!------------ Main Content Start ----------->
    <main>
        <!-------- About Experience Section Start ------->
        <section
            style="background-color: #f9f9f9; background-image: url('{{ asset('frontend/assets/images/about/white-waves.webp') }}'); background-repeat: repeat; background-position: center top; background-size: auto;"
            class="py-5">

            <div class="container">
                <div class="row align-items-center g-5">
                    <!-- Left Image (Person with tools) -->
                    <div class="col-lg-5 text-center text-lg-start">
                        {{-- <img src="your-worker-image.png" alt="Worker" class="img-fluid"> --}}
                        <img src="{{ asset($homeAbout->image_one ?? 'frontend/assets/images/about/about-wood.png') }}" class="img-fluid"
                            alt="Wood Icon">
                    </div>

                    <!-- Right Content -->
                    <div class="col-lg-7">
                        <h3 class="section-title fw-bold mb-3 text-uppercase text-start">{{ $homeAbout->title ?? 'Over 15 Years Experience In Industry' }}
                        </h3>
                        <p class="text-muted mb-4">
                            {!! $homeAbout->description ?? 'Default description goes here.' !!}
                        </p>

                        <div class="row g-3">
                            <div class="col-md-7">
                                <ul class="list-unstyled experience-list">
                                    @php
                                        $features = is_array($homeAbout->features) ? $homeAbout->features : json_decode($homeAbout->features ?? '[]', true);
                                    @endphp
                                    @foreach($features as $feature)
                                    <li><i class="fas fa-check-circle text-warning me-2"></i>{{ $feature }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-md-5">
                                <div class="experience-thumb">
                                    <img src="{{ asset($homeAbout->image_two ?? 'frontend/assets/images/wood-2.png') }}" class="img-fluid"
                                        alt="Wood Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-------- About Experience Section End ------->
        <!-------- Categories Section Start ------->
        <section class="categories-section" id="contentArea">
            <div class="container">
                <div class="section-title text-center">
                    <h2>
                        <span>
                            <img src="{{ asset('frontend/assets/images/wood-2.png') }}" class="img-fluid" width="50"
                                height="50" alt="Wood Icon">
                        </span>
                        Wood <span class="section-span-text text-secondary">Categories</span>
                        <span>
                            <img src="{{ asset('frontend/assets/images/wood-2.png') }}" class="img-fluid" width="50"
                                height="50" alt="Wood Icon">
                        </span>
                    </h2>
                </div>
                <div class="all-categories-row">
                    <div class="row">
                        <!-- Category 1 -->
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 filter-item" data-name="furniture">
                            <div class="single-category text-center">
                                <a href="/shop?category=furniture">
                                    <img src="{{ asset('frontend/assets/images/wood-2.png') }}" class="img-fluid"
                                        alt="Furniture">
                                </a>
                                <h4><a href="/shop?category=furniture">Furniture</a></h4>
                            </div>
                        </div>

                        <!-- Category 2 -->
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 filter-item" data-name="timber">
                            <div class="single-category text-center">
                                <a href="/shop?category=timber">
                                    <img src="{{ asset('frontend/assets/images/wood-3.png') }}" class="img-fluid"
                                        alt="Timber">
                                </a>
                                <h4><a href="/shop?category=timber">Timber</a></h4>
                            </div>
                        </div>

                        <!-- Category 3 -->
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 filter-item" data-name="plywood">
                            <div class="single-category text-center">
                                <a href="/shop?category=plywood">
                                    <img src="{{ asset('frontend/assets/images/wood-4.png') }}" class="img-fluid"
                                        alt="Plywood">
                                </a>
                                <h4><a href="/shop?category=plywood">Plywood</a></h4>
                            </div>
                        </div>

                        <!-- Category 4 -->
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 filter-item" data-name="doors">
                            <div class="single-category text-center">
                                <a href="/shop?category=doors">
                                    <img src="{{ asset('frontend/assets/images/wood-3.png') }}" class="img-fluid"
                                        alt="Doors">
                                </a>
                                <h4><a href="/shop?category=doors">Doors</a></h4>
                            </div>
                        </div>

                        <!-- Category 5 -->
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 filter-item" data-name="flooring">
                            <div class="single-category text-center">
                                <a href="/shop?category=flooring">
                                    <img src="{{ asset('frontend/assets/images/wood-2.png') }}" class="img-fluid"
                                        alt="Flooring">
                                </a>
                                <h4><a href="/shop?category=flooring">Flooring</a></h4>
                            </div>
                        </div>

                        <!-- Category 6 -->
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 filter-item" data-name="decor">
                            <div class="single-category text-center">
                                <a href="/shop?category=decor">
                                    <img src="{{ asset('frontend/assets/images/wood-4.png') }}" class="img-fluid"
                                        alt="Decor Items">
                                </a>
                                <h4><a href="/shop?category=decor">Decor Items</a></h4>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row">
                        @foreach ($categories as $category)
                            <!-- single wood category -->
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2 filter-item"
                                data-name="{{ strtolower($category->category_name) }}">
                                <div class="single-category text-center">
                                    <a href="{{ url('/shop?category=' . $category->id) }}">
                                        <img src="{{ asset($category->image) }}" class="img-fluid" alt="Wood Category">
                                    </a>
                                    <h4>
                                        <a
                                            href="{{ url('/shop?category=' . $category->id) }}">{{ $category->category_name }}</a>
                                    </h4>
                                </div>
                            </div>
                        @endforeach
                    </div> --}}
                </div>
            </div>
        </section>

        {{-- <section class="categories-section" id="contentArea">
            <div class="container">
                <div class="section-title">
                    <h2> <span><img src="{{ 'frontend' }}/assets/images/shoes/running-shoe.png" class="img-fluid" width="50px" height="50px"
                                    alt=""></span>
                        Shoes <span class="section-span-text text-secondary">Categories</span>
                        <span><img src="{{ 'frontend' }}/assets/images/shoes/rotated-running-shoe.png.png" class="img-fluid" width="50px"
                                   height="50px" alt=""></span>
                    </h2>
                </div>
                <div class="all-categories-row">
                    <div class="row">
                        @foreach ($categories as $category)
                            <!-- single colum category -->
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2 filter-item" data-name="{{ strtolower($category->category_name) }}">
                                    <div class="single-category">
                                        <a href="{{ url('/shop?category=' . $category->id) }}"><img src="{{ $category->image }}" class="img-fluid" alt="category_1_img"></a>
                                        <h4><a href="{{ url('/shop?category=' . $category->id) }}">{{ $category->category_name }}</a></h4>
                                    </div>
                                </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section> --}}

        <!------Quality Product Section Start ------>
        <section class="quality-product-section">
            <div class="container">
                <div class="section-title text-center">
                    <h2>
                        <span>
                            <img src="{{ asset('frontend/assets/images/wood-2.png') }}" class="img-fluid" width="50"
                                height="50" alt="Wood Icon">
                        </span>
                        Quality <span class="section-span-text text-secondary">Products</span>
                        <span>
                            <img src="{{ asset('frontend/assets/images/wood-2.png') }}" class="img-fluid" width="50"
                                height="50" alt="Wood Icon">
                        </span>
                    </h2>
                </div>
                <div class="row g-4">

                    @foreach ($products as $product)
                        <!-- Shoe Card 1 -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 filter-item"
                            data-name="{{ strtolower($product->product_name . ' ' . $product->category->category_name . ' ' . $product->sizes) }}">
                            <div class="card product-card h-100">
                                <span
                                    class="badge bg-danger text-white position-absolute top-0 start-0 m-3 rounded-circle d-flex justify-content-center align-items-center"
                                    style="width: 40px; height: 40px; font-size: 14px;">
                                    {{ $product->sizes }}
                                </span>
                                {{-- <img src="{{ $product->thumbnail }}" class="card-img-top product-img"
                                    alt="Men's Running Shoes" /> --}}
                                <img src="{{ asset('frontend/assets/images/w10.jpg') }}" class="img-fluid"
                                    alt="Wood">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="product-name">
                                        <a href="{{ route('product-detail', $product->id) }}">
                                            {{ $product->product_name }}
                                        </a>
                                    </h5>
                                    <p class="text-muted">{{ $product->category->category_name }}</p>
                                    <div class="product-price">
                                        <span
                                            class="current-price">৳{{ number_format($product->discount_price) }}/-</span>
                                        <span
                                            class="original-price">৳{{ number_format($product->regular_price) }}/-</span>
                                        <span
                                            class="discount-percent">{{ round((($product->regular_price - $product->discount_price) * 100) / $product->regular_price) }}%
                                            OFF</span>
                                    </div>

                                    <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                        @csrf

                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

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
            </div>
        </section>

        <!---------- Featured logo Section Start ------------>
        <section id="featured-logo-section">
            <div class="container">
                <div class="row align-items-center featured-section">
                    <div class="col-md-2 d-flex align-items-center">
                        <h3 class="featured-title">Featured In</h3>
                    </div>
                    <div class="col-md-10">
                        <div class="featured-logo-wrapper overflow-hidden">
                            <div class="featured-logo-track d-flex" id="logoTrack">
                                @foreach ($brands as $brand)
                                    {{-- <img src="{{ $brand->image }}" class="img-fluid logo-item" alt=""
                                        height="100" width="200" /> --}}
                                    <img src="{{ asset('frontend/assets/images/wood-2.png') }}"
                                        class="img-fluid logo-item" alt="" height="100" width="200" />
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!------------- Main Content End --------------->
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.add-to-cart-form').forEach(form => {
            const addButton = form.querySelector('.add-to-cart-btn');
            const qtySection = form.querySelector('.quantity-section');

            addButton.addEventListener('click', function() {
                if (qtySection.classList.contains('d-none')) {
                    qtySection.classList.remove('d-none');
                    form.querySelector('input[name="order_qty"]').focus();
                    addButton.innerHTML =
                        '<i class="fas fa-shopping-cart me-2"></i> Confirm Quantity';
                } else {
                    form.submit();
                }
            });

            form.addEventListener('submit', () => {
                addButton.disabled = true;
                addButton.innerHTML = 'Adding...';
            });
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
