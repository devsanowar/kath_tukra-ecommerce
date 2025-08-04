
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/morrisjs/morris.css" />
<!-- Custom Css -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/main.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/custom.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/color_skins.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/toastr.css">
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
}
</style>
@stack('styles')
