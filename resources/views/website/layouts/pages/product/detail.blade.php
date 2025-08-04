@extends('website.layouts.app')

@section('body')
    <!-- ======= MAIN CONTENT START ======= -->
    <main>
        <!-- single product detail content start -->
        <section class="single-product-details">
            <div class="container">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Single Product</li>
                    </ol>
                </nav>

                <div class="row mt-4">
                    <div class="col-lg-6 mb-4">
                        <!-- Main Product Image -->
                        <div class="bg-white p-4 rounded shadow-sm mb-3"
                            style="height: 400px; display: flex; align-items: center; justify-content: center;">
                            {{-- <img id="mainProductImage" src="{{ asset($product->thumbnail) }}"
                                 alt="Samsung Galaxy Z Fold3 5G" class="img-fluid"
                                 style="max-height: 100%; object-fit: contain; cursor: zoom-in;"> --}}
                            <img src="{{ asset('frontend/assets/images/wood-3.png') }}" alt="Samsung Galaxy Z Fold3 5G"
                                class="img-fluid" style="max-height: 100%; object-fit: contain; cursor: zoom-in;"
                                alt="Wood Image">
                        </div>

                        <!-- Thumbnail Gallery -->
                        <div class="thumbnail-gallery d-flex justify-content-start gap-2">
                            <div class="thumbnail-item border p-2 rounded"
                                style="width: 80px; height: 80px; cursor: pointer;">
                                {{-- <img src="{{ asset($product->thumbnail) }}" alt="Thumbnail 1"
                                    class="img-fluid h-100 w-100 object-fit-cover"
                                    onclick="changeMainImage('{{ asset($product->thumbnail) }}')"> --}}
                                <img src="{{ asset('frontend/assets/images/wood-3.png') }}"
                                    class="img-fluid h-100 w-100 object-fit-cover"
                                    onclick="changeMainImage('{{ asset($product->thumbnail) }}')">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <p class="product-category">{{ $product->category->category_name }}</p>
                        <h1 class="product-title">{{ $product->product_name }}</h1>

                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="ms-2 text-black"> 4.6 <span class="text-muted">Reviews</span> </span>
                        </div>

                        <h5>Size: {{ $product->sizes }}</h5>

                        <div class="price">
                            <span class="product-current-price">৳{{ number_format($product->discount_price, 2) }}</span>
                            <span class="product-original-price">৳{{ number_format($product->regular_price, 2) }}</span>
                        </div>

                        <p class="product-description">
                            {{ $product->short_description }}
                        </p>

                        <form action="{{ route('buy.now') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="product-options">
                                <div class="quantity-selector d-flex align-items-center">
                                    <button type="button" class="quantity-btn minus btn btn-sm btn-outline-secondary me-1">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                    <input type="text" name="quantity"
                                        class="quantity-input form-control form-control-sm text-center" value="1"
                                        min="1" style="width: 80px;">

                                    <button type="button" class="quantity-btn plus btn btn-sm btn-outline-secondary ms-1">
                                        <i class="fas fa-plus"></i>
                                    </button>

                                    <button type="submit" class="marco-btn btn-buy ms-3">
                                        <i class="fas fa-shopping-cart me-2"></i> Buy Now
                                    </button>
                                </div>
                            </div>
                        </form>


                        <div class="product-meta">
                            {{--                            <div class="meta-item"> --}}
                            {{--                                <span class="meta-label">Category:</span> --}}
                            {{--                                <span class="meta-value">Kitchen</span> --}}
                            {{--                            </div> --}}
                            {{--                            <div class="meta-item"> --}}
                            {{--                                <span class="meta-label">Tags:</span> --}}
                            {{--                                <span class="meta-value">Boot, Partner</span> --}}
                            {{--                            </div> --}}
                        </div>

                        <!-- share product -->
                        <div class="share-product-container">
                            <div class="share-product-link d-flex align-items-center mb-3">
                                <a href="#" class="action-link text-decoration-none d-flex align-items-center me-3">
                                    <i class="fas fa-share-alt me-2"></i>
                                    <span>Share This Product</span>
                                </a>
                                <div class="social-share-icons d-flex gap-2">
                                    <a href="{{ $website_social_icons->facebook_url }}" target="_blank" class="social-icon"
                                        title="Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="{{ $website_social_icons->instagram_url }}" target="_blank"
                                        class="social-icon instagram" title="Share on Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="{{ $website_social_icons->twitter_url }}" target="_blank"
                                        class="social-icon twitter" title="Share on Twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="{{ $website_social_icons->pinterest_url }}" target="_blank"
                                        class="social-icon pinterest" title="Share on Pinterest">
                                        <i class="fab fa-pinterest-p"></i>
                                    </a>
                                    <a href="{{ $website_social_icons->messanger_url }}" target="_blank"
                                        class="social-icon fa-facebook-messenger" title="Share via Facebook Messenger">
                                        <i class="fab fa-facebook-messenger"></i>
                                    </a>
                                    <a href="{{ $website_social_icons->youtube_url }}" target="_blank"
                                        class="social-icon youtube" title="Share via Youtube">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                    <a href="{{ $website_social_icons->tiktok_url }}" target="_blank"
                                        class="social-icon fa-tiktok" title="Share via Tiktok">
                                        <i class="fab fa-tiktok"></i>
                                    </a>
                                    <a href="#" class="social-icon link" title="Copy link">
                                        <i class="fas fa-link"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product Descriptions -->
                <div class="row">
                    <div class="col-12">
                        <div class="product-tabs">
                            <ul class="nav nav-tabs" id="productTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description" type="button" role="tab"
                                        aria-controls="description" aria-selected="true">Description</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                        data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews"
                                        aria-selected="false">Reviews (3)</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="productTabsContent">
                                <!-- Description Tab -->
                                <div class="tab-pane fade show active description-content" id="description"
                                    role="tabpanel" aria-labelledby="description-tab" style="text-align: justify">
                                    {!! $product->long_description !!}
                                </div>

                                <!-- Reviews Tab -->
                                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">

                                    @foreach ($reviews as $review)
                                        <div class="review-item">
                                            <div class="reviewer-info">
                                                <img src="https://randomuser.me/api/portraits/women/68.jpg"
                                                    alt="Emily Rodriguez" class="reviewer-avatar">
                                                <div>
                                                    <div class="reviewer-name">{{ $review->name }}</div>
                                                    <div class="review-date">{{ $review->created_at->format('F d, Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                            </div>
                                            <div class="review-text">
                                                {{ $review->review }}
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Products -->
                <div class="related-products py-3">
                    <div class="section-title text-start">
                        <h2>Related Products</h2>
                    </div>
                    <!-- products row -->
                    <div class="row g-4">

                        @foreach ($relatedProducts as $relatedProduct)
                            <!-- Shoe Card 1 -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3" data-aos="zoom-in">
                                <div class="card product-card h-100">
                                    <img src="{{ 'frontend' }}/assets/images/product/men_s-running.png"
                                        class="card-img-top product-img" alt="Men's Running Shoes" />
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="product-name"><a href="singleProduct.html">Men's Running Shoes</a></h5>
                                        <p class="text-muted">Breathable & Lightweight Comfort</p>
                                        <div class="product-price">
                                            <span class="current-price">৳49.99</span>
                                            <span class="original-price">৳89.99</span>
                                            <span class="discount-percent">45% OFF</span>
                                        </div>

                                        <!-- Quantity Section (Initially Hidden) -->
                                        <div class="quantity-section d-none my-3">
                                            <input type="number" min="1" value="1"
                                                class="form-control quantity-input" />
                                            <button class="btn btn-sm btn-success submit-cart-btn ms-2">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </div>

                                        <!-- Add to Cart Button -->
                                        <button class="marco-btn btn-buy mt-auto add-to-cart-btn">
                                            <i class="fas fa-shopping-cart me-2"></i> Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- ======= MAIN CONTENT END ======= -->
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.quantity-selector').forEach(function(container) {
            const input = container.querySelector('.quantity-input');
            const plusBtn = container.querySelector('.plus');
            const minusBtn = container.querySelector('.minus');

            plusBtn.addEventListener('click', () => {
                input.value = parseInt(input.value || 1) + 1;
            });

            minusBtn.addEventListener('click', () => {
                const current = parseInt(input.value || 1);
                if (current > 1) input.value = current - 1;
            });
        });
    });
</script>
