    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap.min.css" />
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/slick.css" />
    <!-- line awesome -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/line-awesome.min.css" />
    <!-- countdown css link-->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/jquery.classycountdown.min.css" />
    <!-- range css -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/jquery-ui.css" />
    <!-- magnific css link -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/magnific-popup.css" />

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/main.css" />
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

@php
    use App\Models\WebsiteColor;
    $websiteColor = WebsiteColor::first();
@endphp

<style>
    :root {
  --priamary: {{ $websiteColor->primary_color }};
  --secondary: {{ $websiteColor->secondary_color }};
  --base: {{ $websiteColor->base_color }};
  --black: rgb(51, 51, 51);
  --white: rgb(255, 255, 255);
  --basebg: {{ $websiteColor->base_bg_color }};
  --heading-font: "Nunito", sans-serif;
  --title-font: "Pacifico", cursive;
  --body-font: "Roboto", sans-serif;
  --heading-three: 27px;
}
</style>


@stack('styles')
