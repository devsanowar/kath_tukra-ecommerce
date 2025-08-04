@php
    use App\Models\WebsiteSetting;
    $website_setting = WebsiteSetting::first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>@yield('title') {{ $website_setting->website_title }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset($website_setting->website_favicon) }}" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/all.min.css') }}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">

    <!-- responsiveness -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">

    <style>
        #searchBar {
            transition: all 0.3s ease;
        }
    </style>

</head>

<body>
    <!---------- Header Start --------->
    <!-- Topbar -->
    <div class="topbar py-2 border-bottom bg-light">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <!-- Left Side - Contact Numbers -->
                <div class="d-flex flex-wrap gap-3 mb-2 mb-md-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-phone-alt me-2 text-secondary"></i>
                        <span class="text-muted">Customer Service: <a href="tel:01960473828"
                                class="text-decoration-none">{{ $website_setting->phone }}</a></span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-headset me-2 text-secondary"></i>
                        <span class="text-muted">Dealer Support: <a href="tel:01907109181"
                                class="text-decoration-none">{{ $website_setting->phone }}</a></span>
                    </div>
                </div>

                <!-- Right Side - Social Links -->
                <div class="d-flex gap-2 align-items-center">
                    <a href="{{ $website_social_icons->facebook_url }}" target="_blank" class="social-icon"
                        title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    {{--                <a href="{{ $website_social_icons->instagram_url }}" target="_blank" --}}
                    {{--                   class="social-icon instagram" title="Share on Instagram"> --}}
                    {{--                    <i class="fab fa-instagram"></i> --}}
                    {{--                </a> --}}
                    {{--                <a href="{{ $website_social_icons->twitter_url }}" target="_blank" --}}
                    {{--                   class="social-icon twitter" title="Share on Twitter"> --}}
                    {{--                    <i class="fab fa-twitter"></i> --}}
                    {{--                </a> --}}
                    {{--                <a href="{{ $website_social_icons->pinterest_url }}" target="_blank" --}}
                    {{--                   class="social-icon pinterest" title="Share on Pinterest"> --}}
                    {{--                    <i class="fab fa-pinterest-p"></i> --}}
                    {{--                </a> --}}
                    {{--                <a href="{{ $website_social_icons->messanger_url }}" target="_blank" --}}
                    {{--                   class="social-icon fa-facebook-messenger" title="Share via Facebook Messenger"> --}}
                    {{--                    <i class="fab fa-facebook-messenger"></i> --}}
                    {{--                </a> --}}
                    <a href="{{ $website_social_icons->youtube_url }}" target="_blank" class="social-icon youtube"
                        title="Share via Youtube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    {{--                <a href="{{ $website_social_icons->tiktok_url }}" target="_blank" --}}
                    {{--                   class="social-icon fa-tiktok" title="Share via Tiktok"> --}}
                    {{--                    <i class="fab fa-tiktok"></i> --}}
                    {{--                </a> --}}
                    {{--                <a href="#" class="social-icon link" title="Copy link"> --}}
                    {{--                    <i class="fas fa-link"></i> --}}
                    {{--                </a> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Header Menu Start -->
    <header>
        <div class="container">
            <div class="top-bar">
                <div class="left">
                    <div class="menu-toggle" onclick="toggleMobileNav()">
                        <span></span><span></span><span></span>
                    </div>
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            {{-- <img src="{{ asset($website_setting->website_logo) }}" alt="Marco Footwear Logo" class="img-fluid"
                             style="height: 45px;"> --}}
                            <img src="{{ asset('frontend/assets/images/logo/kathtukra-logo-main.png') }}"
                                class="img-fluid" style="height: 55px;" alt="kathtukra logo">
                        </a>
                    </div>
                </div>

                <div class="center">
                    <div class="search-bar">
                        <input type="text" id="searchInput" placeholder="Search..." />
                        <button><i class="fas fa-search"></i></button>
                    </div>
                </div>

                @php
                    $cart = session()->get('cart', []);
                    $itemCount = array_sum(array_column($cart, 'quantity'));
                @endphp

                <div class="right">
                    <div class="icon">
                        <a href="{{ route('cart.page') }}">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span>{{ $itemCount }}</span>
                        </a>
                    </div>
                </div>

                <!-- mobile sticky bar menu -->
                <div class="mobile-sticky-bar-menu">
                    <div class="menu-toggle" onclick="toggleMobileNav()">
                        <span></span><span></span><span></span>
                    </div>
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset($website_setting->website_logo) }}" alt="Marco Footwear Logo"
                                class="img-fluid" style="height: 30px;">
                        </a>
                    </div>
                    <div class="user-cart-icons d-flex align-items-center gap-3">
                        <div class="icon">
                            <a href="{{ route('cart.page') }}"><i class="fa-solid fa-cart-shopping"></i>
                                <span>{{ $itemCount }}</span> </a>
                        </div>
                    </div>
                </div>
                <!-- Mobile Sticky Bottom Menu Start-->
                <div id="mobile-sticky-bottom-menu">
                    <ul class="mobile-bottom-ul">
                        <li class="menu-item">
                            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><i
                                    class="fas fa-home"></i><span></span></a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><i
                                    class="fa-solid fa-table"></i><span></span></a>
                        </li>
                        <li class="menu-item">
                            <a href="#" id="searchToggle"><i class="fas fa-search"></i></a>
                        </li>

                        <!-- Hidden Search Form -->
                        <li class="menu-item d-none" id="searchBar">
                            <form action="{{ route('search') }}" method="GET">
                                <input type="text" name="query" placeholder="Search..." class="form-control">
                            </form>
                        </li>

                        <li class="menu-item">
                            <a href="{{ route('cart.page') }}"><i class="fas fa-shopping-cart"></i><span></span></a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('shop') }}"
                                class="{{ request()->routeIs('shop') ? 'active' : '' }}"><i
                                    class="fas fa-shopping-bag"></i><span></span></a>
                        </li>
                        <li class="search-field" id="searchField">
                            <form id="searchForm" onsubmit="event.preventDefault();">
                                <input type="text" placeholder="Search products..." />
                                <button type="button" id="closeSearch"><i class="fas fa-times"></i></button>
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- Mobile Sticky Bottom Menu End-->
            </div>
        </div>
        <!-- Desktop Menu Items Start-->
        <div class="navbar-menu-items">
            <div class="container">
                <div class="nav-bar">
                    <nav class="navbar navbar-expand-lg navbar-light p-0">
                        <ul class="navbar-nav d-flex flex-row flex-wrap gap-3">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('home') ? 'active-menu' : '' }}"
                                    href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('shop') ? 'active-menu' : '' }}"
                                    href="{{ route('shop') }}">Shop</a>
                            </li>

                            <li class="nav-item dropdown position-relative">
                                <button class="nav-link btn border-0 bg-transparent" id="categoryToggle"
                                    onclick="toggleCategoryDropdown()">
                                    Categories <i class="fas fa-caret-down ms-1"></i>
                                </button>
                                <ul class="dropdown-menu-custom" id="categoryDropdown">
                                    @foreach ($categories as $category)
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ url('/shop?category=' . $category->id) }}">
                                                {{ $category->category_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('about') ? 'active-menu' : '' }}"
                                    href="{{ route('about') }}">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('blog') ? 'active-menu' : '' }}"
                                    href="{{ route('blog') }}">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('contact') ? 'active-menu' : '' }}"
                                    href="{{ route('contact') }}">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- ------------Mobile Menu--------------- -->
        <div class="mobile-nav" id="mobileNav">
            <div class="mobile-close" onclick="toggleMobileNav()">×</div>

            <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
            <a class="{{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}">Shop</a>

            <!-- Categories Toggle -->
            <button class="mobile-categories-toggle" onclick="toggleMobileCategories()">
                Categories <i class="fas fa-angle-down"></i>
            </button>

            <!-- Dropdown Items -->
            <div id="mobileCategoriesDropdown" class="mobile-categories-dropdown">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ url('/shop?category=' . $category->id) }}">
                            {{ $category->category_name }}
                        </a>
                    </li>
                @endforeach
            </div>

            <a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
            <a class="{{ request()->routeIs('blog') ? 'active' : '' }}" href="{{ route('blog') }}">Blog</a>
            <a class="{{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
        </div>
    </header>
    <!---------- Header End ----------->
