<!------------ Main Content Start ----------->
<main>
    <!-- About Content -->
    <section class="about-marco py-5">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Column - Text Content -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="pe-lg-5">
                        <h6 class="text-uppercase mb-3">ABOUT MARCO FOOTWEAR</h6>
                        <h2 class="display-5 fw-bold mb-4">{{ $about->about_title }}</h2>
                        <p class="lead mb-4">At marco Footwear, we craft shoes that blend fashion, functionality,
                            and innovation. Whether it’s for daily wear or special occasions, our designs ensure
                            maximum comfort and enduring style for every step you take.</p>

                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled mb-4 mb-md-0">
                                    <li class="mb-2 d-flex align-items-start">
                                        <span class="me-2 text-primary">✓</span>
                                        <span>Premium quality materials</span>
                                    </li>
                                    <li class="mb-2 d-flex align-items-start">
                                        <span class="me-2 text-primary">✓</span>
                                        <span>Trendy and timeless styles</span>
                                    </li>
                                    <li class="d-flex align-items-start">
                                        <span class="me-2 text-primary">✓</span>
                                        <span>Engineered for comfort</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2 d-flex align-items-start">
                                        <span class="me-2 text-primary">✓</span>
                                        <span>Wide range of collections</span>
                                    </li>
                                    <li class="mb-2 d-flex align-items-start">
                                        <span class="me-2 text-primary">✓</span>
                                        <span>Craftsmanship & precision</span>
                                    </li>
                                    <li class="d-flex align-items-start">
                                        <span class="me-2 text-primary">✓</span>
                                        <span>Customer satisfaction first</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Experience Badge -->
                <div class="col-lg-6">
                    <div class="experience-badge bg-light p-5 rounded text-center position-relative"
                         style="max-width: 300px; margin: 0 auto;">
                        <div class="position-absolute top-0 start-50 translate-middle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                             style="width: 80px; height: 80px; transform: translateY(-50%);">
                            <span class="fw-bold fs-4">{{ $about->help_number }}+</span>
                        </div>
                        <h3 class="mt-5 mb-3 fw-bold">Years of Excellence</h3>
                        <a href="#" class="marco-btn px-4">Explore Our Story</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Testimonials section start -->
    <section id="testimonials-section" class="testimonials-section"
             style="background: url({{ 'frontend/assets/images/testimonial_bg.png' }});
                 background-size: cover; background-position: center center;
                 background-repeat: no-repeat;">
        <div class="container">
            <div class="section-title">
                <h2>Cleints Feedback</h2>
            </div>
            <div class="swiper testimonial-slider">
                <div class="swiper-wrapper">

                    @foreach($reviews as $review)
                        <!-- Slide 1 -->
                            <div class="swiper-slide">
                                <div class="single-testimonial">
                                    <div class="reviews">
                                        <i class="fa-solid fa-star text-warning"></i><i
                                            class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i><i
                                            class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                    </div>
                                    <p>
                                        {{ $review->review }}
                                    </p>
                                    <div class="testimonial-footer">
                                        <img src="{{ asset($review->image) }}" alt="John Doe" />
                                        <div>
                                            <h4>{{ $review->name }}</h4>
                                            <p>{{ $review->profession }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach

                </div>

                <!-- pagination bullets -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <!-- Testimonials section end -->

</main>
<!------------ Main Content End ----------->
