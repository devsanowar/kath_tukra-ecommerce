@forelse ($products as $product)
    @php
        $final_price = $product->regular_price;
        if ($product->discount_price > 0) {
            if ($product->discount_type === 'percent') {
                $final_price = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
            } elseif ($product->discount_type === 'flat') {
                $final_price = $product->regular_price - $product->discount_price;
            }
        }
    @endphp
    @include('website.layouts.partials.product_search_by_category', ['product' => $product, 'final_price' => $final_price])
@empty
    <h4>Product not found!!</h4>
@endforelse
e
