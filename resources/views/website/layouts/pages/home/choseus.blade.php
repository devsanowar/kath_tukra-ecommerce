<div class="choose-us-area pt-20 pb-10" style="background: #f0f0f063;" >
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 ">
                <div class="choose2-img mb-30">
                    <img src="{{ asset($about->image) }}" alt="img">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="single-choose mb-30">
                    <div class="choose-title">
                        <h2>{{ $about->about_title ?? 'About title' }}</h2>
                    </div>
                    <div class="choose2-content">
                        <div class="choose2-text">
                            <p>{!! $about->description ?? 'About Contents' !!}</p>
                        </div>
                    </div>

                    <div class="choose-button">
                        <a class="btn" href="#">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




