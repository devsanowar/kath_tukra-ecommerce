@section('title')
    Checkout Page
@endsection
@include('website.layouts.inc.header')


<!-- ==================== Breadcumb Start Here ==================== -->
<section class="breadcumb py-120 bg-img" style="background-image: url({{ asset('frontend') }}/assets/images/thumbs/breadcumb-img.png)">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcumb__wrapper">
                    <h1 class="breadcumb__title">Check Out</h1>
                    <ul class="breadcumb__list">
                        <li class="breadcumb__item">
                            <a href="{{ route('home') }}" class="breadcumb__link">
                                <i class="las la-home"></i> Home</a>
                        </li>
                        <li class="breadcumb__item">/</li>
                        <li class="breadcumb__item">
                            <span class="breadcumb__item-text"> Check Out </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== Breadcumb End Here ==================== -->

<!-- =================check out section start here ===================-->

<div class="checkout-section" style="background-color: #f8f9fa">
    <div class="container">

        <div class="row gy-4">
            @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

            <div class="col-lg-7">
                <form action="{{ route('place_an_order') }}" method="POST">
                    @csrf
                    <div class="billing-details">
                        <h5 class="billing-details__title">Billing Details</h5>
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="first-name" class="form--label">First Name<span
                                            class="required">*</span></label>
                                    <input type="text" name="first_name" class="form--control" id="first-name" value="{{ old('first_name') }}" />
                                    @error('first_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="last-name" class="form--label">Last Name<span
                                            class="required">*</span></label>
                                    <input type="text" class="form--control" name="last_name" id="last-name" value="{{ old('last_name') }}" />
                                    @error('last_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="tel" class="form--label"> Phone Number </label>
                                    <input type="text" class="form--control" name="phone" id="tel" value="{{ old('phone') }}"/>
                                    @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="district" class="form--label">
                                        District <span class="required">*</span></label>
                                    <select class="select" name="district_id" id="district" required>
                                        <option value="">Select District</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->district_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('district_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="upazila" class="form--label">
                                        Country / Region<span class="required">*</span></label>
                                    <select class="select" name="upazila_id" id="upazila" required>
                                        <option value="">Select Upazila</option>
                                    </select>
                                </div>
                                @error('upazila_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="address" class="form--label">
                                        Address<span class="required">*</span></label>
                                    <textarea type="text" name="address" id="address" rows="4" class="form--control" id="address">{{ old('address') }}</textarea>

                                </div>
                                 @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                            </div>

                            <div class="col-xl-6">
                                <div
                                    class="billing-details__button d-flex flex-wrap justify-content-between align-items-center">
                                    <a href="{{ route('shop_page') }}"
                                        class="btn btn--base pill billing-details__button-margin">CONTINUE SHOPPING</a>
                                    <a href="route('cart.page')" class="color-style">Return to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-lg-5">
                <div class="your-order">
                    <div class="your-order-table table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-name">Product</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartContents as $cartContent)
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            {{ $cartContent['name'] }}<strong class="product__quantity"> ×
                                                {{ $cartContent['quantity'] }}</strong>
                                        </td>
                                        <td class="product-total">
                                            <span
                                                class="amount">৳{{ $cartContent['price'] * $cartContent['quantity'] }}</span>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Cart Subtotal</th>
                                    <td><span id="subtotal" data-amount="{{ $totalAmount }}">৳ {{ $totalAmount }}</span></td>
                                </tr>
                                <tr class="shipping">
                                    <th>Shipping</th>
                                    <td>
                                        <ul>
                                            @foreach ($shippings as $shipping)
                                                <li>
                                                    <input type="radio" name="shipping_charge"
                                                        class="shipping-radio"
                                                        value="{{ $shipping->shipping_charge }}" required>
                                                    <label>
                                                        {{ $shipping->shipping_area }}:
                                                        <span class="amount">৳{{ $shipping->shipping_charge }}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </td>
                                </tr>

                                <p style="display:none;">
                                    <span id="subtotal" data-amount="{{ $totalAmount }}"></span>
                                </p>

                                <tr class="order-total">
                                    <th>Order Total</th>
                                    <td>
                                        <strong>
                                            <span class="amount">৳ <span
                                                    id="total-amount">{{ $totalAmount }}</span></span>
                                        </strong>
                                    </td>
                                </tr>

                                <tr class="payment-method">
                                    <th>Payment Method</th>
                                    <td>
                                        <ul>

                                            @foreach ($paymentMethods as $paymentMethod)
                                                <li>
                                                    <input type="radio" name="payment_method"
                                                        value="{{ $paymentMethod->name }}" required>
                                                    <label>{{ $paymentMethod->name }}</label>
                                                </li>
                                            @endforeach

                                            <div id="bkash-fields" style="display: none;">
                                                <input type="text" name="transaction_number" class="form-control"
                                                    placeholder="Transaction Number">
                                                <input type="text" name="transaction_id" class="form-control"
                                                    placeholder="Transaction ID">
                                            </div>

                                        </ul>
                                    </td>

                                </tr>

                            </tfoot>
                        </table>
                    </div>


                    <div class="payment-method">

                        <div class="order-button-payment">
                            <button type="submit" class="btn btn--base pill">Place order</button>
                        </div>
                    </div>

                </div>

                </form>
            </div>

        </div>
    </div>
</div>

<!-- =================checkout section end here===================== -->
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














@push('scripts')
    <script>
        document.querySelectorAll('.payment-method-radio').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const method = this.value.toLowerCase();
                if (method === 'bkash') {
                    document.getElementById('bkash-fields').style.display = 'block';
                } else {
                    document.getElementById('bkash-fields').style.display = 'none';
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#district').on('change', function() {
                let district_id = $(this).val();

                $('#upazila').empty().append('<option>Loading...</option>');

                if (district_id) {
                    $.ajax({
                        url: '/get-upazilas/' + district_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#upazila').empty().append(
                                '<option value="">Select Upazila</option>');
                            $.each(data, function(index, upazila) {
                                $('#upazila').append('<option value="' + upazila.id +
                                    '">' + upazila.upazila_name + '</option>');
                            });
                        },
                        error: function() {
                            $('#upazila').empty().append('<option>Error loading</option>');
                        }
                    });
                }
            });
        });
    </script>

    <script>
        document.querySelectorAll('.shipping-radio').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const shipping = parseFloat(this.value);
                const subtotal = parseFloat(document.querySelector('#subtotal').dataset.amount);
                const total = shipping + subtotal;
                document.querySelector('#total-amount').innerText = total.toFixed(2);
            });
        });
    </script>


@endpush

@include('website.layouts.inc.footer')
