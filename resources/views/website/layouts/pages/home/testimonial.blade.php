<div class="testimonial-area pt-110 pb-90">
    <div class="container">
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="section-title section-circle">

                <h2>Clients Reviews</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmotempor incididunt ut labore
                    et dolore magna aliqua enim minim veniam</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-7 col-lg-7">
                <div class="testimonial-img mb-30">
                    <img src="https://img.freepik.com/premium-photo/mechanic-working-vehicle-repair-shop_1048944-16514743.jpg?ga=GA1.1.147526028.1739157987&semt=ais_hybrid&w=740" alt="img">
                </div>
            </div>
            <div class="col-xl-5 col-lg-5">
                <div class="testimonial-active owl-carousel">
                    @forelse ($reviews as $review)
                    <div class="testimonial-wrapper mb-30">
                        <div class="testimonial-text">
                            <p>
                                {!! $review->review !!}
                            </p>
                            <div class="testimonial-content">
                                <div class="testimonial2-img">
                                    <img src="{{ asset($review->image) }}" alt="img">
                                </div>
                                <div class="testimonial-name">
                                    <h4>{{ $review->name }}</h4>
                                    <span>{{ $review->profession }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="testimonial-wrapper mb-30">
                        <div class="testimonial-text">
                            <h4>Review not found!!</h4>
                        </div>
                    </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
