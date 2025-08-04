@php
include_once resource_path('views/admin/layouts/inc/active-variable.blade.php');
use App\Models\ManageMenuItem;
$menuItem = ManageMenuItem::first();
@endphp

<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ asset(Auth::user()->image) }}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown">{{ Auth::user()->name }}</div>
            {{-- <div class="email">{{ Auth::user()->email }}</div> --}}
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="active">
                <a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
            </li>

            {{-- Home Page Menu (Shared) --}}
            <li class="{{ $isHomePageActive ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-view-headline"></i>
                    <span>Home Page</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ request()->routeIs('banner.*') ? 'active' : '' }}">
                        <a href="{{ route('banner.index') }}"><span>Banner</span></a>
                    </li>

{{--                    <li class="{{ request()->routeIs('promobanner.*') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('promobanner.index') }}"><span>Promo Banner</span></a>--}}
{{--                    </li>--}}

                    <li class="{{ request()->routeIs('home.about.*') ? 'active' : '' }}">
                        <a href="{{ route('home.about.index') }}"><span>About</span></a>
                    </li>

{{--                    <li class="{{ request()->routeIs('why-choose-us.*') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('why-choose-us.index') }}"><span>Why choose us</span></a>--}}
{{--                    </li>--}}

{{--                    <li class="{{ request()->routeIs('cta.*') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('cta.index') }}"><span>CTA</span></a>--}}
{{--                    </li>--}}

{{--                    <li class="{{ request()->routeIs('achievement.*') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('achievement.index') }}"><span>Achievement</span></a>--}}
{{--                    </li>--}}
                    <li class="{{ request()->routeIs('review.*') ? 'active' : '' }}">
                        <a href="{{ route('review.index') }}"><span>Review</span></a>
                    </li>
{{--                    <li class="{{ request()->routeIs('faq.*') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('faq.index') }}"><span>FAQ</span></a>--}}
{{--                    </li>--}}

                </ul>
            </li>

           <li class="{{ $isAboutPageActive ? 'active' : '' }}">
               <a href="{{ route('about.index') }}">
                    <i class="zmdi zmdi-assignment"></i><span>About Page</span>
               </a>
             </li>

            <li class="{{ $isProductActive ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle"> <i class="zmdi zmdi-shopping-cart"></i>
                    <span>Product</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ request()->routeIs('product.create') ? 'active' : '' }}">
                        <a href="{{ route('product.create') }}">Add Product</a>
                    </li>
                    <li class="{{ request()->routeIs('product.index') ? 'active' : '' }}">
                        <a href="{{ route('product.index') }}">All Product</a>
                    </li>
                    <li class="{{ request()->routeIs('category.*') ? 'active' : '' }}">
                        <a href="{{ route('category.index') }}">Category</a>
                    </li>
{{--                    @if($menuItem->subcategory_status)--}}
{{--                    <li class="{{ request()->routeIs('subcategory.*') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('subcategory.index') }}">Sub Category</a>--}}
{{--                    </li>--}}
{{--                    @endif--}}

                    <li class="{{ request()->routeIs('brand.*') ? 'active' : '' }}">
                        <a href="{{ route('brand.index') }}">Brand</a>
                    </li>

                </ul>
            </li>

{{--            <li class="{{ $isShippingPageActive ? 'active' : '' }}">--}}
{{--                <a href="{{ route('shipping.index') }}"><i class="zmdi zmdi-money-box"></i>--}}
{{--                    <span>Shipping</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            --}}{{-- District Menu --}}
{{--            <li class="{{ $isDistrictPageActive ? 'active' : '' }}">--}}
{{--                <a href="{{ route('district.index') }}"><i class="zmdi zmdi-map"></i><span>District</span></a>--}}
{{--            </li>--}}

{{--            --}}{{-- District Menu --}}
{{--            <li class="{{ $isUpazilaPageActive ? 'active' : '' }}">--}}
{{--                <a href="{{ route('upazila.index') }}"><i class="zmdi zmdi-map"></i><span>Upazila</span></a>--}}
{{--            </li>--}}

            <li class="{{ $isOrderPageActive ? 'active' : '' }}">
                <a href="{{ route('order.index') }}"><i class="zmdi zmdi-shopping-cart"></i><span>Orders <span
                            class="order-count">{{ $pendingOrder }}</span></span></a>
            </li>


            <li class="{{ $isPaymentMethodPageActive ? 'active' : '' }}">
                <a href="{{ route('payment_method.index') }}"><i class="zmdi zmdi-money"></i><span>Payment
                        Method</span></a>
            </li>


            {{-- Post Menu --}}

            <li class="{{ $isPostActive ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-border-color"></i>
                    <span>Post</span>
                </a>
                <ul class="ml-menu">
{{--                    <li class="{{ request()->routeIs('post_category.index') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('post_category.index') }}">Category</a>--}}
{{--                    </li>--}}
                    <li class="{{ request()->routeIs('post.create') ? 'active' : '' }}">
                        <a href="{{ route('post.create') }}">Add Post</a>
                    </li>
                    <li class="{{ request()->routeIs('post.index') ? 'active' : '' }}">
                        <a href="{{ route('post.index') }}">All Post</a>
                    </li>
                </ul>
            </li>


            {{-- Only Admin can see Users Menu --}}
            @if (Auth::user()->system_admin === 'Admin')
                <li class="{{ $isUserPageActive ? 'active' : '' }}">
                    <a href="{{ route('user.create') }}"><i class="zmdi zmdi-accounts"></i><span>Users</span></a>
                </li>
            @endif

            <li class="{{ Request::is('moblieSMS*') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-email"></i><span>SMS</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ Request::is('moblieSMS/sms') ? 'active' : '' }}">
                        <a href="{{ route('message.index') }}">Send SMS</a>
                    </li>
                    <li class="{{ Request::is('moblieSMS/custom-sms') ? 'active' : '' }}">
                        <a href="{{ route('custom.sms') }}">Custom SMS</a>
                    </li>
                    <li class="{{ Request::is('moblieSMS/sms-report') ? 'active' : '' }}">
                        <a href="{{ route('sms-report.index') }}">SMS Report</a>
                    </li>
                </ul>
            </li>

            {{-- Shared: Inbox, Settings, Logout --}}



            <li class="{{ request()->routeIs('newslatter') ? 'active' : '' }}">
                <a href="{{ route('newslatter') }}"><i class="zmdi zmdi-accounts"></i>
                    <span>Subscriber</span>
                </a>
            </li>

            <li class="{{ $isCostActive ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle"> <i class="zmdi zmdi-money"></i>
                    <span>Cost Module</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ request()->routeIs('category.*') ? 'active' : '' }}">
                        <a href="{{ route('cost_category.index') }}">Category</a>
                    </li>
                    <li class="{{ request()->routeIs('field.*') ? 'active' : '' }}">
                        <a href="{{ route('field_of_cost.index') }}">Field of Cost</a>
                    </li>
                    <li class="{{ request()->routeIs('add_cost.*') ? 'active' : '' }}">
                        <a href="{{ route('cost.create') }}">Add Cost</a>
                    </li>
                    <li class="{{ request()->routeIs('manage_cost.*') ? 'active' : '' }}">
                        <a href="{{ route('cost.index') }}">All Cost</a>
                    </li>

                </ul>
            </li>

            <li class="{{ $isMessagePageActive ? 'active' : '' }}">
                <a href="{{ route('contact.index') }}"><i class="zmdi zmdi-email-open"></i>
                    <span>Messages</span>
                </a>
            </li>



            <li class="{{ request()->routeIs('block-list.*') ? 'active' : '' }}">
                <a href="{{ route('block.list') }}"><i class="zmdi zmdi-accounts"></i>
                    <span>Account Block Lists</span>
                </a>
            </li>


{{--            <li class="{{ $isPagesMenuActive ? 'active open' : '' }}">--}}
{{--                <a href="javascript:void(0);" class="menu-toggle">--}}
{{--                    <i class="zmdi zmdi-folder"></i>--}}
{{--                    <span>Pages</span>--}}
{{--                </a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li class="{{ request()->routeIs('privacy_policy') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('privacy_policy') }}">Privacy Policy</a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ request()->routeIs('terms_and_condtion') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('terms_and_condtion') }}">Terms And Condition</a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ request()->routeIs('return_refund') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('return_refund') }}">Return & Refund</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}


            <li
                class="{{ request()->routeIs('sms-settings.*') || request()->routeIs('website_setting') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-settings"></i>
                    <span>Settings</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ request()->routeIs('sms-settings.*') ? 'active' : '' }}">
                        <a href="{{ route('sms-settings.edit') }}">
                            <span>SMS API Settings</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('website_setting') ? 'active' : '' }}">
                        <a href="{{ route('website_setting') }}">Website Setting</a>
                    </li>
                </ul>
            </li>

{{--            <li--}}
{{--                class="{{ request()->routeIs('privilege.*') }}">--}}
{{--                <a href="javascript:void(0);" class="menu-toggle">--}}
{{--                    <i class="zmdi zmdi-settings"></i>--}}
{{--                    <span>Privilege</span>--}}
{{--                </a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li class="{{ request()->routeIs('privilege') ? 'active' : '' }}">--}}
{{--                        <a href="{{ route('privilege') }}">Manage Website</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="zmdi zmdi-power"></i><span>Logout</span>
                    </a>
                </form>
            </li>
        </ul>

    </div>
    <!-- #Menu -->
</aside>
