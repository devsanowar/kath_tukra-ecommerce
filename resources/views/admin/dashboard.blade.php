@extends('admin.layouts.app')


@section('admin_content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <h2>Dashboard
                    <small class="text-muted">Welcome to {{ $website_setting->website_title }} web application</small>
                </h2>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <ul class="breadcrumb" id="dashboard-tabs" style="gap: 10px;">
                    <li><button class="btn btn-primary filter-btn active" data-days="1">1 Day</button></li>
                    <li><button class="btn btn-primary filter-btn" data-days="7">7 Days</button></li>
                    <li><button class="btn btn-primary filter-btn" data-days="15">15 Days</button></li>
                    <li><button class="btn btn-primary filter-btn" data-days="{{ now()->daysInMonth }}">30/31 Days</button>
                    </li>
                    <li><button class="btn btn-primary filter-btn" data-days="all">All</button></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" target="_blank">
                            <i class="zmdi zmdi-home"></i> {{ $website_setting->website_title }}</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row clearfix" id="dashboard-stats">
            @php
                $cards = [
                    ['icon' => 'zmdi-money-box', 'value' => $total_order_amount, 'label' => 'Total Sale'],
                    ['icon' => 'zmdi-shopping-cart', 'value' => $order_count, 'label' => 'Total Orders'],
                    ['icon' => 'zmdi-shopping-cart', 'value' => $pending_order_count, 'label' => 'Pending Orders'],
                    ['icon' => 'zmdi-shopping-cart', 'value' => $cancelled_order_count, 'label' => 'Cancelled Orders'],
                    [
                        'icon' => 'zmdi-confirmation-number',
                        'value' => $confirmed_order_count,
                        'label' => 'Confirmed Order',
                    ],
                    ['icon' => 'zmdi-shopping-cart', 'value' => $shipped_order_count, 'label' => 'Shipped Order'],
                    ['icon' => 'zmdi-check-all', 'value' => $delivered_order_count, 'label' => 'Delivered Orders'],
                    ['icon' => 'zmdi-accounts', 'value' => $user_count, 'label' => 'Users'],
                    ['icon' => 'zmdi-email', 'value' => $message_count, 'label' => 'Inbox'],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                    <div class="card tasks_report">
                        <div class="body">
                            <span class="dashboard-icons"><i class="zmdi {{ $card['icon'] }}"></i></span>
                            <h2 class="mt-3">{{ $card['value'] }}</h2>
                            <p>{{ $card['label'] }}</p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart Plugins Js -->


<script>
    function loadDashboardStats(days = 1) {
        $.ajax({
            url: "{{ route('admin.dashboard.filter') }}",
            method: "GET",
            data: {
                days: days
            },
            success: function(response) {
                let statsHtml = '';

                const statusData = response.statuses || {};

                const formatAmount = (amount) => {
                    return (amount || 0).toLocaleString(); // format number with commas
                }

                const cards = [
                    {
                        icon: 'zmdi-money-box',
                        value: formatAmount(response.total_order_amount),
                        label: 'Total Sale'
                    },
                    {
                        icon: 'zmdi-shopping-cart',
                        value: response.order_count || 0,
                        label: 'Total Orders'
                    },
                    {
                        icon: 'zmdi-time-restore',
                        value: statusData.pending?.count || 0,
                        label: `Pending Orders (${formatAmount(statusData.pending?.amount)} TK)`
                    },
                    {
                        icon: 'zmdi-close',
                        value: statusData.cancelled?.count || 0,
                        label: `Cancelled Orders (${formatAmount(statusData.cancelled?.amount)} TK)`
                    },
                    {
                        icon: 'zmdi-confirmation-number',
                        value: statusData.confirmed?.count || 0,
                        label: `Confirmed Orders (${formatAmount(statusData.confirmed?.amount)} TK)`
                    },
                    {
                        icon: 'zmdi-truck',
                        value: statusData.shipped?.count || 0,
                        label: `Shipped Orders (${formatAmount(statusData.shipped?.amount)} TK)`
                    },
                    {
                        icon: 'zmdi-check-all',
                        value: statusData.delivered?.count || 0,
                        label: `Delivered Orders (${formatAmount(statusData.delivered?.amount)} TK)`
                    },
                    {
                        icon: 'zmdi-accounts',
                        value: response.user_count || 0,
                        label: 'Users'
                    },
                    {
                        icon: 'zmdi-email',
                        value: response.message_count || 0,
                        label: 'Inbox'
                    }
                ];

                cards.forEach(card => {
                    statsHtml += `
                        <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                            <div class="card tasks_report">
                                <div class="body">
                                    <span class="dashboard-icons"><i class="zmdi ${card.icon}"></i></span>
                                    <h2 class="mt-3">${card.value}</h2>
                                    <p>${card.label}</p>
                                </div>
                            </div>
                        </div>
                    `;
                });

                $('#dashboard-stats').html(statsHtml);
            },
            error: function() {
                alert("Something went wrong while fetching dashboard data.");
            }
        });
    }

    $(document).ready(function () {
        // ডিফল্ট লোড
        loadDashboardStats(1);

        // ট্যাব ক্লিক হ্যান্ডল
        $('.filter-btn').on('click', function () {
            $('.filter-btn').removeClass('active');
            $(this).addClass('active');

            const days = $(this).data('days');
            loadDashboardStats(days);
        });
    });
</script>


@endpush
