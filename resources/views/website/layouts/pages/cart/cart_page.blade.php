@extends('website.layouts.app')

@section('body')
    <!-- checkout body content start -->
    <div class="chekout-cart-section">
        <div class="container py-5">
            <div class="row">
                <!-- Cart Table -->
                <div class="col-lg-8 mb-4">
                    <div class="table-responsive">
                        <h5 class="text-center text-success">{{ session('message') }}</h5>
                        <table class="table table-bordered table-hover bg-white">
                            <thead class="table-light">
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Size</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cartContents as $productId => $cartItem)
                                <tr>
                                    <!-- Product Image -->
                                    <td>
                                        <img src="{{ asset($cartItem['thumbnail']) }}" class="product-img" alt="Product" />
                                    </td>

                                    <!-- Product Name -->
                                    <td>{{ $cartItem['name'] }}</td>

                                    <!-- Size (if not stored, use fallback) -->
                                    <td>{{ $cartItem['sizes'] ?? 'Medium' }}</td>

                                    <!-- Unit Price -->
                                    <td>৳{{ number_format($cartItem['discount_price']) }}</td>

                                    <!-- Subtotal -->
                                    <td>৳{{ number_format($cartItem['discount_price'] * $cartItem['quantity']) }}</td>

                                    <!-- Quantity input with update form -->
                                    <td style="width: 100px">
                                        <form id="update-form-{{ $productId }}" action="{{ route('cart.update', $productId) }}" method="POST">
                                            @csrf
                                            <input type="number" name="quantity"
                                                   class="form-control form-control-sm"
                                                   value="{{ $cartItem['quantity'] }}" min="1">
                                        </form>
                                    </td>

                                    <td>
                                        <button type="button"
                                                class="btn btn-sm btn-primary mt-1 update-btn"
                                                data-form-id="update-form-{{ $productId }}">
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                        <a href="{{ route('removefrom.cart', $productId) }}"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Are you sure you want to remove this item?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>

                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Checkout Summary -->
                <div class="col-lg-4">
                    <!-- Order Summary -->
                    <div class="card card-summary p-4 mb-4">
                        <h5 class="mb-3">Order Summary</h5>

                        @php
                            $shipping = 0;
                            $grandTotal = $totalAmount + $shipping;
                        @endphp

                        <!-- Totals -->
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Subtotal</span>
                                <strong>৳{{ number_format($totalAmount) }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Shipping</span>
                                <strong>৳{{ number_format($shipping) }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total</span>
                                <strong>৳{{ number_format($grandTotal) }}</strong>
                            </li>
                        </ul>

                        @if(count($cartContents) > 0)
                            <button class="marco-btn w-100" id="checkoutBtn">Proceed to Checkout</button>
                        @else
                            <div class="alert alert-warning">Your cart is empty.</div>
                        @endif

                    </div>

                    <!-- Order Confirmation Form (Hidden by default) -->
                    <div class="card p-4" id="orderForm"
                         style="display: none; opacity: 0; transition: opacity 0.5s ease;">
                        <h5 class="mb-3">Place Your Order</h5>
                        <form id="orderConfirmForm" action="{{ route('place_an_order') }}" method="POST">
                            @csrf

                            <input type="hidden" name="sizes" id="sizesInput">

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name or Company name"
                                       required />
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" name="phone" id="phone" placeholder="+8801XXXXXXXXX"
                                       required />
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Shipping Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3"
                                          placeholder="Your shop/company address..." required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="paymentMethod" class="form-label">Payment Method</label>
                                <select class="form-select" id="paymentMethod" name="payment_method" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="Cash">Cash On Delivery</option>
                                </select>
                            </div>

                            <button type="submit" class="marco-btn w-100">Confirm & Place Order</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkoutBtn = document.getElementById('checkoutBtn');
        const orderForm = document.getElementById('orderForm');

        checkoutBtn.addEventListener('click', function () {
            if (orderForm.style.display === 'none' || orderForm.style.opacity === '0') {
                orderForm.style.display = 'block';
                // Small delay to allow transition
                setTimeout(() => {
                    orderForm.style.opacity = '1';
                }, 50);
                // Optionally scroll to form
                orderForm.scrollIntoView({ behavior: 'smooth' });
            } else {
                // If you want toggle functionality, hide form again on second click
                orderForm.style.opacity = '0';
                setTimeout(() => {
                    orderForm.style.display = 'none';
                }, 500);
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateButtons = document.querySelectorAll('.update-btn');

        updateButtons.forEach(button => {
            button.addEventListener('click', function () {
                const formId = this.getAttribute('data-form-id');
                document.getElementById(formId).submit();
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.quantity-selector').forEach(function (container) {
            const input = container.querySelector('.quantity-input');
            const plusBtn = container.querySelector('.plus');
            const minusBtn = container.querySelector('.minus');

            plusBtn.addEventListener('click', () => {
                input.value = parseInt(input.value || 1) + 1;
            });

            minusBtn.addEventListener('click', () => {
                const current = parseInt(input.value || 1);
                if (current > 1) input.value = current - 1;
            });
        });
    });
</script>

<script>
    document.getElementById('orderConfirmForm').addEventListener('submit', function(e) {
        let sizes = [];

        document.querySelectorAll('table tbody tr').forEach(row => {
            let sizeCell = row.querySelectorAll('td')[2];
            if (sizeCell) {
                sizes.push(sizeCell.textContent.trim());
            }
        });

        document.getElementById('sizesInput').value = sizes.join(',');
    });

</script>

