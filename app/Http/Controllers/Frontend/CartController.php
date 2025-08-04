<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;


class CartController extends Controller
{
    public function cartPage()
    {
        $cartContents = session()->get('cart', []);

        $totalAmount = 0;
        foreach ($cartContents as $item) {
            $totalAmount += $item['discount_price'] * $item['quantity'];
        }

        return view('website.layouts.pages.cart.cart_page', compact('cartContents', 'totalAmount'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $qty = $request->order_qty ?? 1;

        $final_price = $product->regular_price;

        if ($product->discount_price > 0) {
            if ($product->discount_type === 'percent') {
                $final_price = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
            } elseif ($product->discount_type === 'flat') {
                $final_price = $product->discount_price;
            }
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $qty;
        } else {
            $cart[$product->id] = [
                'id'             => $product->id,
                'name'           => $product->product_name,
                'price'          => $final_price,
                'quantity'       => $qty,
                'sizes'          => $request->sizes,
                'thumbnail'      => $product->thumbnail,
                'regular_price'  => $product->regular_price,
                'discount_price' => $product->discount_price,
                'discount_type'  => $product->discount_type,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }

    public function buyNow(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        $cart[$product->id] = [
            'id'             => $product->id,
            'name'           => $product->product_name,
            'thumbnail'      => $product->thumbnail,
            'quantity'       => $request->quantity,
            'sizes'          => $request->sizes,
            'price'          => $product->discount_price ?? $product->regular_price,
            'discount_price' => $product->discount_price ?? $product->regular_price,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.page')->with('message', 'Product added for direct purchase!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return back()->with('message', 'Product removed from cart successfully!');
        } else {
            Toastr::warning('Product not found in cart!', 'Warning');
        }
        return back();
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $newQty = max(1, (int)$request->quantity);
            $cart[$id]['quantity'] = $newQty;

            session()->put('cart', $cart);
        }
        return back()->with('message', 'Quantity updated successfully!');
    }

}
