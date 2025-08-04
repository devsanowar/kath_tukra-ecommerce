<?php
$homePageRoutes = ['banner.*', 'home.about*', 'promobanner.*', 'why-choose-us.*', 'achievement.*', 'review.*', 'faq.*', 'cta.*'];
$isHomePageActive = false;
foreach ($homePageRoutes as $route) {
    if (request()->routeIs($route)) {
        $isHomePageActive = true;
        break;
    }
}

$isPostActive = request()->routeIs('post.*') || request()->routeIs('post_category.*');
$isProductActive =
    request()->routeIs('product.*') ||
    request()->routeIs('category.*') ||
    request()->routeIs('brand.*') ||
    request()->routeIs('subcategory.*');

$isCostActive =
    request()->routeIs('category.*') ||
    request()->routeIs('field.*') ||
    request()->routeIs('add_cost.*') ||
    request()->routeIs('manage_cost.*');

$isSettingsActive = request()->routeIs('website_setting') || request()->routeIs('website_setting.update');

$isAboutPageActive = request()->routeIs('about_page.*');
$isOrderPageActive = request()->routeIs('order.*');
$isDistrictPageActive = request()->routeIs('district.*');
$isUpazilaPageActive = request()->routeIs('upazila.*');
$isUserPageActive = request()->routeIs('user.*');
$isPaymentMethodPageActive = request()->routeIs('payment_method.*');
$isMessagePageActive = request()->routeIs('message.*') || request()->routeIs('inboxed_message') || request()->routeIs('block-list.*');
$isShippingPageActive = request()->routeIs('shipping.*');
$pendingOrder = App\Models\Order::where('status', 'pending')->count();
$isPagesMenuActive = request()->routeIs('privacy_policy') || request()->routeIs('terms_and_condtion') || request()->routeIs('return_refund');
