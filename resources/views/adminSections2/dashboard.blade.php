<div class="container-fluid">

    <!-- Page Header -->
    <div class="mb-4">
        <div class="notifs-label">Overview</div>
        <h4 class="notifs-title mb-0">Dashboard</h4>
        <p class="notifs-sub mb-0">{{ now()->format('l, F d Y') }}</p>
    </div>

    <!-- ── Stat Cards ─────────────────────────────────────────── -->
    <div class="row g-3 mb-4">

        <div class="col-6 col-lg-3">
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="dash-card-label">Total Orders</div>
                    <div class="dash-icon blue"><i class="fa fa-bag-shopping"></i></div>
                </div>
                <div class="dash-card-value">{{ number_format($totalOrders) }}</div>
                <div class="dash-card-sub">All time</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="dash-card-label">Total Revenue</div>
                    <div class="dash-icon green"><i class="fa fa-wallet"></i></div>
                </div>
                <div class="dash-card-value">₦{{ number_format($totalRevenue) }}</div>
                <div class="dash-card-sub">Amount collected</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="dash-card-label">Total Customers</div>
                    <div class="dash-icon purple"><i class="fa fa-users"></i></div>
                </div>
                <div class="dash-card-value">{{ number_format($totalCustomers) }}</div>
                <div class="dash-card-sub">Registered</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="dash-card-label">Total Staff</div>
                    <div class="dash-icon teal"><i class="fa fa-user-tie"></i></div>
                </div>
                <div class="dash-card-value">{{ number_format($totalStaff) }}</div>
                <div class="dash-card-sub">Active members</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="dash-card-label">Pending Orders</div>
                    <div class="dash-icon amber"><i class="fa fa-clock"></i></div>
                </div>
                <div class="dash-card-value">{{ number_format($pendingOrders) }}</div>
                <div class="dash-card-sub">Awaiting processing</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="dash-card-label">Completed</div>
                    <div class="dash-icon green"><i class="fa fa-circle-check"></i></div>
                </div>
                <div class="dash-card-value">{{ number_format($completedOrders) }}</div>
                <div class="dash-card-sub">Delivered & done</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="dash-card">
                <div class="dash-card-top">
                    <div class="dash-card-label">Today's Orders</div>
                    <div class="dash-icon indigo"><i class="fa fa-calendar-day"></i></div>
                </div>
                <div class="dash-card-value">{{ number_format($todaysOrders) }}</div>
                <div class="dash-card-sub">{{ now()->format('M d, Y') }}</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
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

    <!-- ── Charts Row ─────────────────────────────────────────── -->
    <div class="row g-3 mb-4">

        <!-- Bar chart — orders per day -->
        <div class="col-12 col-lg-8">
            <div class="dash-chart-card">
                <div class="dash-chart-header">
                    <div>
                        <div class="dash-chart-title">Orders Over Time</div>
                        <div class="dash-chart-sub">Last 30 days</div>
                    </div>
                </div>
                <div id="ordersBarChart"></div>
            </div>
        </div>

        <!-- Donut — order status -->
        <div class="col-12 col-lg-4">
            <div class="dash-chart-card">
                <div class="dash-chart-header">
                    <div>
                        <div class="dash-chart-title">Order Status</div>
                        <div class="dash-chart-sub">Breakdown</div>
                    </div>
                </div>
                <div id="statusDonutChart"></div>
            </div>
        </div>

    </div>

    <div class="row g-3 mb-4">

        <!-- Line chart — revenue -->
        <div class="col-12 col-lg-8">
            <div class="dash-chart-card">
                <div class="dash-chart-header">
                    <div>
                        <div class="dash-chart-title">Revenue Over Time</div>
                        <div class="dash-chart-sub">Last 30 days</div>
                    </div>
                </div>
                <div id="revenueLineChart"></div>
            </div>
        </div>

        <!-- Donut — payment method -->
        <div class="col-12 col-lg-4">
            <div class="dash-chart-card">
                <div class="dash-chart-header">
                    <div>
                        <div class="dash-chart-title">Payment Methods</div>
                        <div class="dash-chart-sub">Breakdown</div>
                    </div>
                </div>
                <div id="methodDonutChart"></div>
            </div>
        </div>

    </div>

    <!-- ── Recent Orders ──────────────────────────────────────── -->
    <div class="dash-chart-card mb-4">
        <div class="dash-chart-header">
            <div>
                <div class="dash-chart-title">Recent Orders</div>
                <div class="dash-chart-sub">Last 5 orders</div>
            </div>
            <a href="{{ route('orderTrack') }}" hx-get="{{ route('orderTrack') }}"
                hx-target="#content-area" hx-push-url="true" hx-indicator=".htmx-indicator"
                class="dash-view-all">View all <i class="fa fa-arrow-right ms-1"></i></a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0" style="font-size:.83rem;">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Branch</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Payment</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        @php
                            $payStatus  = $order->payment_status ?? 'pending';
                            $orderBadge = match(strtolower($order->status)) {
                                'pending'     => 'badge-pending',
                                'in progress' => 'badge-progress',
                                'completed'   => 'badge-completed',
                                'delivered'   => 'badge-delivered',
                                default       => 'badge-pending',
                            };
                            $payBadge = match($payStatus) {
                                'paid'    => 'pay-badge-paid',
                                'partial' => 'pay-badge-partial',
                                default   => 'pay-badge-pending',
                            };
                        @endphp
                        <tr>
                            <td>
                                <span class="inv-number">INV-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td>{{ $order->customer?->name ?? '—' }}</td>
                            <td>
                                @if($order->branch)
                                    <span class="inv-branch-pill">{{ $order->branch->name }}</span>
                                @else
                                    <span style="color:#9ca3af;">—</span>
                                @endif
                            </td>
                            <td>₦{{ number_format($order->total_amount) }}</td>
                            <td><span class="dash-badge {{ $orderBadge }}">{{ ucfirst($order->status) }}</span></td>
                            <td><span class="pay-badge {{ $payBadge }}">{{ ucfirst($payStatus) }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4" style="color:#9ca3af;">No orders yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<style>
    .notifs-label { font-size:.7rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#a5b4fc; }
    .notifs-title { font-size:1.4rem; font-weight:700; color:#0f0f1a; letter-spacing:-.02em; }
    .notifs-sub   { font-size:.82rem; color:#9ca3af; margin-top:2px; }

    /* Stat cards */
    .dash-card { background:#fff; border:1px solid #f0f0f8; border-radius:14px; padding:1.1rem 1.2rem; height:100%; transition:box-shadow .2s; }
    .dash-card:hover { box-shadow:0 4px 20px rgba(0,0,0,.07); }
    .dash-card-top { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:.5rem; }
    .dash-card-label { font-size:.75rem; color:#9ca3af; font-weight:600; text-transform:uppercase; letter-spacing:.05em; }
    .dash-card-value { font-size:1.5rem; font-weight:700; color:#111827; line-height:1.2; margin-bottom:3px; }
    .dash-card-sub { font-size:.72rem; color:#9ca3af; }
    .dash-icon { width:36px; height:36px; border-radius:9px; display:flex; align-items:center; justify-content:center; font-size:.85rem; flex-shrink:0; }
    .dash-icon.blue   { background:#eff6ff; color:#2563eb; }
    .dash-icon.green  { background:#ecfdf5; color:#059669; }
    .dash-icon.purple { background:#f5f3ff; color:#7c3aed; }
    .dash-icon.teal   { background:#f0fdfa; color:#0d9488; }
    .dash-icon.amber  { background:#fffbeb; color:#d97706; }
    .dash-icon.red    { background:#fff1f2; color:#e11d48; }
    .dash-icon.indigo { background:#eef2ff; color:#4f46e5; }

    /* Chart cards */
    .dash-chart-card { background:#fff; border:1px solid #f0f0f8; border-radius:14px; padding:1.2rem 1.4rem; }
    .dash-chart-header { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:1.2rem; }
    .dash-chart-title { font-size:.9rem; font-weight:700; color:#111827; }
    .dash-chart-sub   { font-size:.75rem; color:#9ca3af; margin-top:2px; }
    .dash-view-all { font-size:.78rem; font-weight:600; color:#4f46e5; text-decoration:none; display:flex; align-items:center; }
    .dash-view-all:hover { color:#3730a3; }

    /* Table badges */
    .dash-badge { font-size:.7rem; font-weight:700; padding:.3em .7em; border-radius:6px; }
    .badge-pending   { background:#fffbeb; color:#92400e; }
    .badge-progress  { background:#eff6ff; color:#1d4ed8; }
    .badge-completed { background:#ecfdf5; color:#065f46; }
    .badge-delivered { background:#eef2ff; color:#4f46e5; }
    .pay-badge { font-size:.7rem; font-weight:700; padding:.3em .7em; border-radius:6px; }
    .pay-badge-paid    { background:#ecfdf5; color:#065f46; }
    .pay-badge-partial { background:#fff7ed; color:#c2410c; }
    .pay-badge-pending { background:#fffbeb; color:#92400e; }
    .inv-number { font-weight:700; color:#4f46e5; font-size:.78rem; font-family:monospace; background:#eef2ff; padding:.2em .5em; border-radius:5px; }
    .inv-branch-pill { background:#f0fdf4; color:#166534; font-size:.72rem; font-weight:600; padding:.2em .55em; border-radius:5px; border:1px solid #bbf7d0; }

    .table thead th { font-size:.7rem; text-transform:uppercase; letter-spacing:.05em; color:#9ca3af; font-weight:600; border-bottom:1px solid #f0f0f8; padding:.6rem .75rem; background:#fafafc; }
    .table tbody td { padding:.65rem .75rem; border-color:#f5f5fb; }
    .table-hover tbody tr:hover { background:#f8f8fd; }
</style>

<script>
(function() {
    const labels  = @json($orderDates);
    const orders  = @json($orderCounts);
    const revenue = @json($revenueCounts);

    const statusLabels = @json($statusBreakdown->keys()->map(fn($k) => ucfirst($k)));
    const statusData   = @json($statusBreakdown->values());
    const methodLabels = @json($methodBreakdown->keys()->map(fn($k) => ucfirst($k)));
    const methodData   = @json($methodBreakdown->values());

    const palette = ['#4f46e5','#10b981','#f59e0b','#ef4444','#8b5cf6','#06b6d4'];

    function destroyCharts() {
        ['_ordersBarChart','_revenueLineChart','_statusDonutChart','_methodDonutChart'].forEach(k => {
            if (window[k]) { try { window[k].destroy(); } catch(e) {} window[k] = null; }
        });
    }

    function initDashboardCharts() {
        // Guard — only run if chart containers exist on the page
        if (!document.getElementById('ordersBarChart')) return;

        // Always destroy first to avoid duplicate renders
        destroyCharts();

        window._ordersBarChart = new ApexCharts(document.getElementById('ordersBarChart'), {
            chart: { type: 'bar', height: 220, toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
            series: [{ name: 'Orders', data: orders }],
            xaxis: { categories: labels, labels: { style: { fontSize: '10px', colors: '#9ca3af' } }, axisBorder: { show: false }, axisTicks: { show: false } },
            yaxis: { labels: { style: { fontSize: '10px', colors: '#9ca3af' } }, min: 0, forceNiceScale: true },
            colors: ['#4f46e5'],
            plotOptions: { bar: { borderRadius: 4, columnWidth: '55%' } },
            dataLabels: { enabled: false },
            grid: { borderColor: '#f5f5fb', strokeDashArray: 4 },
            tooltip: { y: { formatter: val => val + ' orders' } },
        });
        window._ordersBarChart.render();

        window._revenueLineChart = new ApexCharts(document.getElementById('revenueLineChart'), {
            chart: { type: 'area', height: 220, toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
            series: [{ name: 'Revenue', data: revenue }],
            xaxis: { categories: labels, labels: { style: { fontSize: '10px', colors: '#9ca3af' } }, axisBorder: { show: false }, axisTicks: { show: false } },
            yaxis: { labels: { style: { fontSize: '10px', colors: '#9ca3af' }, formatter: val => '₦' + Number(val).toLocaleString() } },
            colors: ['#10b981'],
            fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.35, opacityTo: 0.05 } },
            stroke: { curve: 'smooth', width: 2 },
            dataLabels: { enabled: false },
            grid: { borderColor: '#f5f5fb', strokeDashArray: 4 },
            tooltip: { y: { formatter: val => '₦' + Number(val).toLocaleString() } },
        });
        window._revenueLineChart.render();

        window._statusDonutChart = new ApexCharts(document.getElementById('statusDonutChart'), {
            chart: { type: 'donut', height: 260, fontFamily: 'Inter, sans-serif' },
            series: statusData,
            labels: statusLabels,
            colors: palette,
            plotOptions: { pie: { donut: { size: '65%', labels: { show: true, total: { show: true, label: 'Total', fontSize: '13px', fontWeight: 700, color: '#111827' } } } } },
            dataLabels: { enabled: false },
            legend: { position: 'bottom', fontSize: '11px' },
            tooltip: { y: { formatter: val => val + ' orders' } },
        });
        window._statusDonutChart.render();

        window._methodDonutChart = new ApexCharts(document.getElementById('methodDonutChart'), {
            chart: { type: 'donut', height: 260, fontFamily: 'Inter, sans-serif' },
            series: methodData,
            labels: methodLabels,
            colors: ['#4f46e5', '#10b981', '#f59e0b', '#ef4444'],
            plotOptions: { pie: { donut: { size: '65%', labels: { show: true, total: { show: true, label: 'Total', fontSize: '13px', fontWeight: 700, color: '#111827' } } } } },
            dataLabels: { enabled: false },
            legend: { position: 'bottom', fontSize: '11px' },
            tooltip: { y: { formatter: val => val + ' payments' } },
        });
        window._methodDonutChart.render();
    }

    // Run immediately since htmx:allowScriptTags re-executes this script on swap
    setTimeout(initDashboardCharts, 100);
})();
</script>
