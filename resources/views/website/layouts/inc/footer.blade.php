<!---------------- Footer Start ---------------->
<footer class="footer-section pt-5">
    <div class="footer-logo-area">
        <div class="container">
            <div class="row d-flex align-items-center py-4">
                <div class="col-md-6">
                    <div class="footer-logo text-start">
                        <a href="#">
                            {{-- <img src="{{ asset($website_setting->website_logo) }}" alt="Marco Footwear Logo" class="img-fluid" style="height: 40px;"> --}}
                            <img src="{{ asset('frontend/assets/images/logo/kathtukra-logo-main.png') }}"
                                class="img-fluid" style="height: 55px;" alt="kathtukra logo">
                        </a>
                    </div>
                </div>
                <div class="col-md-6 text-end d-flex justify-content-end gap-2">
                    <a href="{{ $website_social_icons->facebook_url }}" target="_blank" class="social-icon facebook"
                        title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="{{ $website_social_icons->instagram_url }}" target="_blank" class="social-icon instagram"
                        title="Share on Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="{{ $website_social_icons->twitter_url }}" target="_blank" class="social-icon twitter"
                        title="Share on Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="{{ $website_social_icons->pinterest_url }}" target="_blank" class="social-icon pinterest"
                        title="Share on Pinterest">
                        <i class="fab fa-pinterest-p"></i>
                    </a>
                    {{--                    <a href="{{ $website_social_icons->messanger_url }}" target="_blank" --}}
                    {{--                       class="social-icon fa-facebook-messenger" title="Share via Facebook Messenger"> --}}
                    {{--                        <i class="fab fa-facebook-messenger"></i> --}}
                    {{--                    </a> --}}
                    <a href="{{ $website_social_icons->youtube_url }}" target="_blank" class="social-icon youtube"
                        title="Share via Youtube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    {{--                    <a href="{{ $website_social_icons->tiktok_url }}" target="_blank" --}}
                    {{--                       class="social-icon fa-tiktok" title="Share via Tiktok"> --}}
                    {{--                        <i class="fab fa-tiktok"></i> --}}
                    {{--                    </a> --}}
                    {{--                    <a href="#" class="social-icon link" title="Copy link"> --}}
                    {{--                        <i class="fas fa-link"></i> --}}
                    {{--                    </a> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="footer-row-content">
        <div class="container">
            <div class="row">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0 text-start border-right-colum">
                    <div class="footer-left-content">
                        <h3 class="footer-contact-heading text-uppercase mb-4">Business Contact</h3>
                        <div class="business-contact">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-map-marker-alt me-2" style="color: #47ffb3;"></i>
                                    {{ $website_setting->address }}
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-phone-alt me-2" style="color: #4795ff;"></i>
                                    {{ $website_setting->phone }}
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-envelope me-2" style="color: #ffb347;"></i>
                                    {{ $website_setting->email }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Newsletter -->
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0 text-start border-right-colum">
                    <div class="footer-middle-content">
                        <h5 class="text-uppercase mb-4">Subscribe Newsletter</h5>
                        <p class="small">We invite you to register to read the latest news, offers and events about our
                            company.
                            We
                            promise not to spam your inbox.</p>
                        <h5 class="text-success text-center">{{ session('message') }}</h5>
                        <form action="{{ route('newsletter.subscribe') }}" method="POST">
                            @csrf
                            <div class="input-group subscriber-input mb-3 d-flex">
                                <input type="text" class="form-control form-control-sm" name="phone"
                                    placeholder="Enter your mobile number..." aria-label="Mobile">
                                <button class="btn btn-sm text-white bg-primary" type="submit">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 mb-md-0 text-start">
                    <div class="footer-right-content">
                        <div class="row">
                            <!-- About Us -->
                            <div class="col-md-6">
                                <h5 class="text-uppercase mb-4">About Us</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-1"><a href="{{ route('about') }}"
                                            class="text-decoration-none">About Us</a></li>
                                    <li class="mb-1"><a href="{{ route('contact') }}"
                                            class="text-decoration-none">Contact Us</a></li>
                                    <li class="mb-1"><a href="{{ route('shop') }}" class="text-decoration-none">Our
                                            Store</a></li>
                                    <li><a href="#{{ route('home') }}" class="text-decoration-none">Our Story</a></li>
                                </ul>
                            </div>
                            <!-- Resources -->
                            <div class="col-md-6">
                                <h5 class="text-uppercase mb-4">Resources</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-1"><a href="#" class="text-decoration-none">Privacy
                                            Policies</a></li>
                                    <li class="mb-1"><a href="#" class="text-decoration-none">Terms &
                                            Conditions</a></li>
                                    <li class="mb-1"><a href="#" class="text-decoration-none">Returns &
                                            Refunds</a></li>
                                    <li class="mb-1"><a href="#" class="text-decoration-none">FAQ's</a></li>
                                    <li><a href="#" class="text-decoration-none">Shipping</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-1" style="border-color: rgba(255,255,255,0.1);">

    <!-- Copyright -->
    <div class="copy-right-text">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-start">
                    <p class="small"> &copy; 2025 by <span class="text-primary">Marco Footwear</span>. All Rights
                        Reserved.</p>
                </div>
                <div class="col-md-6 developer-text text-end">
                    <p class="small mb-0">Developed By <a href="https://www.freelanceit.com.bd/"
                            class="developed-link" target="_blank">Freelance IT</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!------------------- Footer End ---------------->


<!-- Bootstrap JS & Custom JS -->
<script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<!-- Mobile Responsive JS -->
<script src="{{ asset('frontend/assets/js/mobileResponsive.js') }}"></script>

<!-- Font Awesome JS -->
<script src="{{ asset('frontend/assets/js/all.min.js') }}"></script>

<!-- Testimonial Js -->
<script src="{{ asset('frontend/assets/js/testimonial.js') }}"></script>

<!-- Hero Slider JS -->
<script src="{{ asset('frontend/assets/js/heroSlider.js') }}"></script>

<!-- Logo Slider JS -->
<script src="{{ asset('frontend/assets/js/logoSlider.js') }}"></script>

<!-- Sticky Search JS -->
<script src="{{ asset('frontend/assets/js/sticky-search.js') }}"></script>

<!-- Dropdown Menu JS -->
<script src="{{ asset('frontend/assets/js/dropdown-menu.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('frontend/assets/js/script.js') }}"></script>

<!-- Single Product Details JS -->
<script src="{{ asset('frontend/assets/js/singleProduct.js') }}"></script>
<script src="{{ asset('frontend/assets/js/singlProductImage.js') }}"></script>
<script src="{{ asset('frontend/assets/js/singleProductSelect.js') }}"></script>

<!-- Script -->
<script>
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    const items = document.querySelectorAll('#contentArea .item');

    function filterItems() {
        const filter = searchInput.value.toLowerCase();

        items.forEach(function(item) {
            const text = item.textContent.toLowerCase();
            if (text.includes(filter)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Option 1: Filter on input typing
    searchInput.addEventListener('input', filterItems);

    // Option 2: Filter on button click
    searchBtn.addEventListener('click', function(e) {
        e.preventDefault();
        filterItems();
    });
</script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</body>

</html>
