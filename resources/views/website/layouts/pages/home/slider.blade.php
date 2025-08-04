<!------------ Swiper Slider Start ---------->
<div class="swiper hero-swiper" style="background-color: #f8f9fa;">
    <div class="swiper-wrapper">

        @foreach ($banners as $banner)
            <!-- Slide 1 -->
            <div class="swiper-slide first-slide-bg">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-start">
                            <h1 class="display-5 fw-bold">{{ $banner->title }}</h1>
                            <p class="lead">{{ $banner->description }}</p>
                            <a href="{{ $banner->button_url }}" class="marco-btn mt-3">{{ $banner->button_name }}</a>
                        </div>
                        <div class="col-md-6 text-end">
                            <img src="{{ asset($banner->image) }}" alt="Fashion Product" class="img-fluid" />
                            {{-- <img src="{{ asset('frontend/assets/images/wood-2.png') }}" style="margin-left: 200px"
                                class="img-fluid" alt="Wood"> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <!-- Swiper Pagination -->
    <div class="swiper-pagination"></div>

    <!-- Swiper Navigation -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
<!------------ Swiper Slider End ------------>
