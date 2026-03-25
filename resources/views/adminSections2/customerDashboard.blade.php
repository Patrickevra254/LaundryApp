<div class="container-fluid">

    <!-- Header -->
    <div class="mb-4">
        <div class="notifs-label">Welcome back</div>
        <h4 class="notifs-title mb-0">{{ auth()->user()->name }}</h4>
        <p class="notifs-sub mb-0">Here's a summary of your laundry activity</p>
    </div>

    <!-- Quick Action -->
    <div class="cust-book-banner mb-4">
        <div>
            <div class="cust-book-title">Ready for fresh laundry?</div>
            <div class="cust-book-sub">Place a new order and we'll handle the rest.</div>
        </div>
        <a href="{{ route('bookLaundry') }}"
            hx-get="{{ route('bookLaundry') }}"
            hx-target="#content-area"
            hx-push-url="true"
            hx-indicator=".htmx-indicator"
            class="cust-book-btn">
            <i class="fa fa-plus me-1"></i> Book Laundry
        </a>
    </div>

    <!-- Stat Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="dash-card-label">Total Orders</div>
                    <div class="dash-icon blue"><i class="fa fa-bag-shopping"></i></div>
                </div>
                <div class="dash-card-value">{{ number_format($totalOrders) }}</div>
                <div class="dash-card-sub">All time</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="dash-card-label">Total Spent</div>
                    <div class="dash-icon green"><i class="fa fa-wallet"></i></div>
                </div>
                <div class="dash-card-value">₦{{ number_format($totalSpent) }}</div>
                <div class="dash-card-sub">Amount paid</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="dash-card-label">Active Orders</div>
                    <div class="dash-icon amber"><i class="fa fa-spinner"></i></div>
                </div>
                <div class="dash-card-value">{{ number_format($activeOrders) }}</div>
                <div class="dash-card-sub">In progress</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="dash-card-label">Outstanding</div>
                    <div class="dash-icon red"><i class="fa fa-circle-exclamation"></i></div>
                </div>
                <div class="dash-card-value">₦{{ number_format($outstandingBal) }}</div>
                <div class="dash-card-sub">Balance due</div>
            </div>
        </div>
    </div>

    <div class="row g-3">

        <!-- Active Orders -->
        <div class="col-12 col-lg-7">
            <div class="dash-chart-card mb-3">
                <div class="dash-chart-header">
                    <div>
                        <div class="dash-chart-title">Active Orders</div>
                        <div class="dash-chart-sub">Pending & in progress</div>
                    </div>
                    <a href="{{ route('orderTrack') }}" hx-get="{{ route('orderTrack') }}"
                        hx-target="#content-area" hx-push-url="true" hx-indicator=".htmx-indicator"
                        class="dash-view-all">View all <i class="fa fa-arrow-right ms-1"></i></a>
                </div>

                @forelse($activeOrdersList as $order)
                    @php
                        $payStatus = $order->payment_status ?? 'pending';
                        $balance   = max(0, $order->total_amount - $order->amount_paid);
                    @endphp
                    <div class="cust-order-row">
                        <div class="cust-order-left">
                            <div class="cust-order-inv">INV-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</div>
                            <div class="cust-order-meta">
                                {{ $order->items->sum('quantity') }} item(s) ·
                                {{ $order->created_at->format('M d, Y') }}
                            </div>
                        </div>
                        <div class="cust-order-right">
                            <div class="cust-order-amount">₦{{ number_format($order->total_amount) }}</div>
                            <div class="d-flex gap-1 justify-content-end mt-1 flex-wrap">
                                <span class="dash-badge badge-{{ strtolower(str_replace(' ','_',$order->status)) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <span class="pay-badge pay-badge-{{ $payStatus }}">
                                    {{ ucfirst($payStatus) }}
                                </span>
                            </div>
                            @if($balance > 0)
                                <div style="font-size:.7rem;color:#dc2626;font-weight:600;margin-top:2px;">
                                    ₦{{ number_format($balance) }} due
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4" style="color:#9ca3af;font-size:.84rem;">
                        <i class="fa fa-check-circle mb-2" style="font-size:1.8rem;display:block;color:#d1d5db;"></i>
                        No active orders right now.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent History -->
        <div class="col-12 col-lg-5">
            <div class="dash-chart-card">
                <div class="dash-chart-header">
                    <div>
                        <div class="dash-chart-title">Recent History</div>
                        <div class="dash-chart-sub">Completed orders</div>
                    </div>
                    <a href="{{ route('history') }}" hx-get="{{ route('history') }}"
                        hx-target="#content-area" hx-push-url="true" hx-indicator=".htmx-indicator"
                        class="dash-view-all">View all <i class="fa fa-arrow-right ms-1"></i></a>
                </div>

                @forelse($recentHistory as $order)
                    <div class="cust-history-row">
                        <div>
                            <div class="cust-order-inv">INV-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</div>
                            <div class="cust-order-meta">{{ $order->created_at->format('M d, Y') }}</div>
                        </div>
                        <div class="text-end">
                            <div class="cust-order-amount">₦{{ number_format($order->total_amount) }}</div>
                            <span class="dash-badge badge-{{ strtolower($order->status) }} mt-1">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4" style="color:#9ca3af;font-size:.84rem;">
                        No completed orders yet.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>

<style>
    .notifs-label { font-size:.7rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#a5b4fc; }
    .notifs-title { font-size:1.4rem; font-weight:700; color:#0f0f1a; letter-spacing:-.02em; }
    .notifs-sub   { font-size:.82rem; color:#9ca3af; margin-top:2px; }

    /* Book banner */
    .cust-book-banner { background:linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); border-radius:14px; padding:1.4rem 1.6rem; display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap; }
    .cust-book-title  { font-size:1rem; font-weight:700; color:#fff; margin-bottom:3px; }
    .cust-book-sub    { font-size:.82rem; color:rgba(255,255,255,.75); }
    .cust-book-btn    { display:inline-flex; align-items:center; gap:5px; background:#fff; color:#4f46e5; font-size:.82rem; font-weight:700; padding:.55rem 1.1rem; border-radius:9px; text-decoration:none; transition:all .15s; white-space:nowrap; }
    .cust-book-btn:hover { background:#eef2ff; color:#3730a3; }

    /* Stat cards */
    .dash-card { background:#fff; border:1px solid #f0f0f8; border-radius:14px; padding:1.1rem 1.2rem; height:100%; transition:box-shadow .2s; }
    .dash-card:hover { box-shadow:0 4px 20px rgba(0,0,0,.07); }
    .dash-card-top   { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:.5rem; }
    .dash-card-label { font-size:.72rem; color:#9ca3af; font-weight:600; text-transform:uppercase; letter-spacing:.05em; }
    .dash-card-value { font-size:1.45rem; font-weight:700; color:#111827; line-height:1.2; margin-bottom:3px; }
    .dash-card-sub   { font-size:.72rem; color:#9ca3af; }
    .dash-icon { width:36px; height:36px; border-radius:9px; display:flex; align-items:center; justify-content:center; font-size:.85rem; flex-shrink:0; }
    .dash-icon.blue  { background:#eff6ff; color:#2563eb; }
    .dash-icon.green { background:#ecfdf5; color:#059669; }
    .dash-icon.amber { background:#fffbeb; color:#d97706; }
    .dash-icon.red   { background:#fff1f2; color:#e11d48; }

    /* Chart/list cards */
    .dash-chart-card   { background:#fff; border:1px solid #f0f0f8; border-radius:14px; padding:1.2rem 1.4rem; }
    .dash-chart-header { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:1rem; }
    .dash-chart-title  { font-size:.9rem; font-weight:700; color:#111827; }
    .dash-chart-sub    { font-size:.75rem; color:#9ca3af; margin-top:2px; }
    .dash-view-all     { font-size:.78rem; font-weight:600; color:#4f46e5; text-decoration:none; display:flex; align-items:center; }
    .dash-view-all:hover { color:#3730a3; }

    /* Order rows */
    .cust-order-row { display:flex; justify-content:space-between; align-items:flex-start; padding:.75rem 0; border-bottom:1px solid #f5f5fb; }
    .cust-order-row:last-child { border-bottom:none; }
    .cust-history-row { display:flex; justify-content:space-between; align-items:flex-start; padding:.65rem 0; border-bottom:1px solid #f5f5fb; }
    .cust-history-row:last-child { border-bottom:none; }
    .cust-order-inv  { font-size:.82rem; font-weight:700; color:#4f46e5; font-family:monospace; }
    .cust-order-meta { font-size:.72rem; color:#9ca3af; margin-top:2px; }
    .cust-order-amount { font-size:.88rem; font-weight:700; color:#111827; }

    /* Badges */
    .dash-badge { font-size:.68rem; font-weight:700; padding:.25em .65em; border-radius:5px; display:inline-block; }
    .badge-pending     { background:#fffbeb; color:#92400e; }
    .badge-in_progress { background:#eff6ff; color:#1d4ed8; }
    .badge-completed   { background:#ecfdf5; color:#065f46; }
    .badge-delivered   { background:#eef2ff; color:#4f46e5; }
    .pay-badge { font-size:.68rem; font-weight:700; padding:.25em .65em; border-radius:5px; display:inline-block; }
    .pay-badge-paid    { background:#ecfdf5; color:#065f46; }
    .pay-badge-partial { background:#fff7ed; color:#c2410c; }
    .pay-badge-pending { background:#fffbeb; color:#92400e; }
</style>
