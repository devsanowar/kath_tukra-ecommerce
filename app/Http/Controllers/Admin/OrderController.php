<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.layouts.pages.order.index', compact('orders'));
    }

    public function orderChangeStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', Rule::in(['pending', 'cancelled', 'confirmed', 'shipped', 'delivered'])],
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status ?? 'pending';
        $order->status_updated_at = now();
        $order->save();

        return response()->json(['message' => 'Order status updated successfully.']);
    }

    public function show($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);

        return view('admin.layouts.pages.order.show', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->orderItems()->delete();

            $order->delete();

            $toast = Toastr();
            $toast->success('Order and associated items deleted successfully!', 'Success');
        } else {
            $toast = Toastr();
            $toast->error('Order not found!', 'Error');
        }

        return redirect()->back();
    }

    public function orderFilter(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $status = $request->status;

        $query = Order::query();

        if ($start_date) {
            $query->whereDate('created_at', '>=', $start_date);
        }

        if ($end_date) {
            $query->whereDate('created_at', '<=', $end_date);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->latest()->get();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.layouts.pages.order.partials.order_table', [
                    'orders' => $orders,
                    'filteredStatus' => $status,
                ])->render(),
            ]);
        }

        return view('admin.layouts.pages.order.index', compact('orders'));
    }
}
