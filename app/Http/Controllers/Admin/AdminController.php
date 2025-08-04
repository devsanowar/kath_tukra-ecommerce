<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user_count = User::count();
        $order_count = Order::count();
        $total_order_amount = Order::sum('total_price');
        $message_count = Contact::count();
        $website_setting = WebsiteSetting::first();

        $status_counts = Order::select('status', DB::raw('count(*) as count'))
            ->whereIn('status', ['pending', 'cancelled', 'confirmed', 'shipped', 'delivered'])
            ->groupBy('status')
            ->pluck('count', 'status');

        $pending_order_count = $status_counts['pending'] ?? 0;
        $cancelled_order_count = $status_counts['cancelled'] ?? 0;
        $confirmed_order_count = $status_counts['confirmed'] ?? 0;
        $shipped_order_count = $status_counts['shipped'] ?? 0;
        $delivered_order_count = $status_counts['delivered'] ?? 0;


        return view('admin.dashboard', compact(
            'user_count',
            'order_count',
            'total_order_amount',
            'message_count',
            'website_setting',
            'pending_order_count',
            'cancelled_order_count',
            'confirmed_order_count',
            'shipped_order_count',
            'delivered_order_count',
        ));
    }


public function filterDashboardData(Request $request)
{
    $daysInput = $request->input('days', 1);

    // তারিখ সেটআপ
    $fromDate = null;
    $toDate = null;

    if ($daysInput !== 'all') {
        $days = (int) $daysInput;
        $fromDate = $days === 1 ? Carbon::today() : Carbon::now()->subDays($days);
        $toDate = Carbon::now();
    }

    // Dynamic date filter scopes
    $applyCreatedAtFilter = function ($query) use ($fromDate, $toDate) {
        if ($fromDate && $toDate) {
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }
    };

    $applyStatusDateFilter = function ($query) use ($fromDate, $toDate) {
        if ($fromDate && $toDate) {
            $query->whereBetween(DB::raw('COALESCE(status_updated_at, updated_at)'), [$fromDate, $toDate]);
        }
    };

    // Aggregated counts and totals
    $user_count = User::where($applyCreatedAtFilter)->count();
    $message_count = Contact::where($applyCreatedAtFilter)->count();
    $order_count = Order::where($applyCreatedAtFilter)->count();
    $total_order_amount = Order::where($applyCreatedAtFilter)->sum('total_price');

    // Status-wise count & total
    $statuses = ['pending', 'confirmed', 'cancelled', 'shipped', 'delivered'];
    $status_data = [];

    foreach ($statuses as $status) {
        $orders = Order::where('status', $status)->where($applyStatusDateFilter);
        $status_data[$status] = [
            'count' => $orders->count(),
            'amount' => $orders->sum('total_price'),
        ];
    }

    // Final JSON response
    return response()->json([
        'user_count' => $user_count,
        'message_count' => $message_count,
        'order_count' => $order_count,
        'total_order_amount' => $total_order_amount,
        'statuses' => $status_data,
    ]);
}





}
