@include('website.layouts.inc.header')

@include('website.layouts.inc.bradecramp')
<section style="padding:40px 0px">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="accordion" id="faqAccordion">
                    @forelse ($faqs as $index => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button @if ($index != 0) collapsed @endif"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $index }}"
                                    aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                    aria-controls="collapse{{ $index }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}"
                                class="accordion-collapse collapse @if ($index == 0) show @endif"
                                aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <h2 class="text-center" style="font-size: 20px; color: #979797;">FAQ not found!!</h2>
                    @endforelse
                </div>


            </div>
        </div>
    </div>
</section>
<!--============================feature section start here =======================-->
<div class="feature-section bg-img py-60"
    style="
        background-image: url({{ asset('frontend') }}/assets/images/thumbs/feature/feature-img.png);
      ">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-3 col-sm-6 col-xxsm-6">
                <div class="feature-item">
                    <div class="feature-item__thumb">
                        <img src="{{ asset('frontend') }}/assets/images/thumbs/feature/f04.png" alt="" />
                    </div>
                    <div class="feature-item__info">
                        <h5 class="feature-item__title">FREE SHIPPING</h5>
                        <span class="feature-item__payment">
                            For All Order Over $99
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xxsm-6">
                <div class="feature-item">
                    <div class="feature-item__thumb">
                        <img src="{{ asset('frontend') }}/assets/images/thumbs/feature/f03.png" alt="" />
                    </div>
                    <div class="feature-item__info">
                        <h5 class="feature-item__title">FRIENDLY SUPPORT</h5>
                        <span class="feature-item__payment">
                            24/7 Customer Support
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xxsm-6">
                <div class="feature-item">
                    <div class="feature-item__thumb">
                        <img src="{{ asset('frontend') }}/assets/images/thumbs/feature/f02.png" alt="" />
                    </div>
                    <div class="feature-item__info">
                        <h5 class="feature-item__title">SECURE PAYMENT</h5>
                        <span class="feature-item__payment">100% Secure Payment</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xxsm-6">
                <div class="feature-item">
                    <div class="feature-item__thumb">
                        <img src="{{ asset('frontend') }}/assets/images/thumbs/feature/f01.png" alt="" />
                    </div>
                    <div class="feature-item__info">
                        <h5 class="feature-item__title">SHIPPING & RETURN</h5>
                        <span class="feature-item__payment">
                            within 30days For Refund
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==========================feature setion end here ============================-->
@include('website.layouts.inc.footer')
