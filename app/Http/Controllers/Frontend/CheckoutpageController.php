<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Product;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Shipping;
use App\Models\Blocklist;
use App\Models\Orderitem;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Models\Paymentmethod;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutpageController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'phone'          => ['required', 'regex:/^(01[3-9][0-9]{8}|\+8801[3-9][0-9]{8})$/'],
            'address'        => 'required|string',
            'sizes'          => 'nullable||max:255',
            'payment_method' => 'required|string|max:50',
        ]);

        $selectedSize = session('selected_size');

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Cart Empty');
        }

        $blockNumber = Blocklist::pluck('number')->toArray();

        if (in_array($request->phone, $blockNumber)) {
            return back()->with('error', 'Sorry, this mobile number is blocked, try with another number.');
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $shipping_charge = 0;
        if ($request->has('shipping_charge') && floatval($request->shipping_charge) > 0) {
            $shipping_charge = floatval($request->shipping_charge);
            $total += $shipping_charge;
        }

        $order = Order::create([
            'name'            => $request->name,
            'phone'           => $request->phone,
            'address'         => $request->address,
            'payment_method'  => $request->payment_method,
            'shipping_charge' => $shipping_charge,
            'total_price'     => $total,
            'status'          => 'pending',
        ]);

        foreach ($cart as $item) {
            Orderitem::create([
                'order_id'   => $order->id,
                'product_id' => $item['id'],
                'quantity'   => $item['quantity'],
                'sizes'      => $item['sizes'] ?? null,
                'price'      => $item['price'],
            ]);

            $product = Product::find($item['id']);
            if ($product) {
                $product->stock_quantity = max(0, $product->stock_quantity - $item['quantity']);
                $product->save();
            }
        }

        session()->forget('cart');

        return redirect()->route('order.confirmation', $order->id)->with('success', 'Order is successfully placed.');
    }

    public function showOrderConfirmation($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        return view('website.layouts.pages.order.confirmation', compact('order'));
    }
//    public function downloadInvoice($id)
//    {
//        $order = Order::findOrFail($id);
//
//        $pdf = Pdf::loadView('website.layouts.inc.invoice', compact('order'));
//        return $pdf->download('invoice-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf');
//    }
}
