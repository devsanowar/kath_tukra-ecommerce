@php
    use App\Models\WebsiteSetting;
    $website_setting = WebsiteSetting::select(['image'])->first();
@endphp

<!-- ==================== Breadcumb Start Here ==================== -->
    <section class="breadcumb py-120 bg-img" style="background-image: url({{ asset($website_setting->image) }})">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcumb__wrapper" >
                        <h1 class="breadcumb__title">{{ $pageTitle }}</h1>
                        <ul class="breadcumb__list">
                            <li class="breadcumb__item">
                                <a href="{{ route('home') }}" class="breadcumb__link">
                                    <i class="las la-home"></i> Home</a>
                            </li>
                            <li class="breadcumb__item">/</li>
                            <li class="breadcumb__item">
                                <span class="breadcumb__item-text"> {{ $pageTitle }} </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== Breadcumb End Here ==================== -->
