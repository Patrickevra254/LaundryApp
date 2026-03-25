{{-- <div class="container-fluid ">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h4 class="fw-bold mb-0">Payments</h4>
            <small class="text-muted">Overview of all transactions and records</small>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-4">

        <!-- Total Payments -->
        <div class="col-12 col-md-4">
            <div class="payment-widget">
                <div class="payment-icon bg-success bg-opacity-25 text-success">
                    <i class="fa fa-wallet"></i>
                </div>
                <div class="payment-content">
                    <h6 class="payment-title">Total Payments</h6>
                    <h3 class="payment-value">₦245,000</h3>
                    <div class="payment-meta text-success">
                        <i class="fa fa-arrow-up"></i>
                        +12% this month
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="col-12 col-md-4">
            <div class="payment-widget">
                <div class="payment-icon bg-warning bg-opacity-25 text-warning">
                    <i class="fa fa-clock"></i>
                </div>
                <div class="payment-content">
                    <h6 class="payment-title">Pending</h6>
                    <h3 class="payment-value">₦38,000</h3>
                    <div class="payment-meta text-warning">
                        • 3 pending
                    </div>
                </div>
            </div>
        </div>

        <!-- Failed -->
        <div class="col-12 col-md-4">
            <div class="payment-widget">
                <div class="payment-icon bg-danger bg-opacity-25 text-danger">
                    <i class="fa fa-times-circle"></i>
                </div>
                <div class="payment-content">
                    <h6 class="payment-title">Failed Payments</h6>
                    <h3 class="payment-value">₦12,500</h3>
                    <div class="payment-meta text-danger">
                        • 1 failed
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Filters -->
    <form hx-get="{{ route('payments') }}" hx-target="#payment-table" hx-push-url="true"
        hx-trigger="keyup changed delay:400ms" class="payment-filter-bar mb-4">

        <input type="text" name="search_text" class="form-control" placeholder="Search by name or status"
            value="{{ request('search_text') }}">

        <a href="{{ route('payments') }}" class="btn btn-outline-secondary" hx-get="{{ route('payments') }}"
            hx-target="#content-area" hx-push-url="true" hx-indicator=".htmx-indicator">
            Clear
        </a>
    </form>

    <!-- Payments Table -->
    <div id="payment-table" class="payment-table-wrapper">
        @include('partials.payments-table')
    </div>

</div>



<style>
    /* Global */
    body {
        background-color: #f6f8fb;
        font-family: 'Segoe UI', sans-serif;
    }

    /* ===============================
   Payment Summary Widgets
================================ */
    .payment-widget {
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(12px);
        border-radius: 16px;
        padding: 1.6rem;

        display: flex;
        align-items: center;
        gap: 1.2rem;

        min-height: 130px;

        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .payment-widget:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.18);
    }

    .payment-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .payment-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .payment-title {
        font-size: 0.95rem;
        opacity: 0.85;
        margin-bottom: 2px;
    }

    .payment-value {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
    }

    .payment-meta {
        font-size: 0.85rem;
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* ===============================
   Filters
================================ */
    .payment-filter-bar {
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(12px);
        border-radius: 16px;
        padding: 1rem;

        display: flex;
        gap: 0.75rem;
        align-items: center;

        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .payment-filter-bar .form-control {
        border-radius: 12px;
    }

    /* ===============================
   Table Wrapper
================================ */
    .payment-table-wrapper {
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(12px);
        border-radius: 18px;
        padding: 1.2rem;

        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    }

    /* Table */
    .table {
        margin-bottom: 0;
    }

    .table thead th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6c757d;
        border-bottom: none;
    }

    .table-hover tbody tr:hover {
        background: rgba(13, 110, 253, 0.08);
    }

    /* Status Pills */
    .badge {
        border-radius: 999px;
        padding: 0.45em 0.75em;
        font-size: 0.7rem;
        font-weight: 600;
    }

    /* Buttons */
    .btn {
        border-radius: 12px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        border: none;
        font-weight: 600;
    }

    .btn-outline-secondary {
        font-weight: 500;
    }

    /* Mobile */
    @media (max-width: 768px) {
        .payment-filter-bar {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style> --}}

{{-- <div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
        <div>
            <div class="notifs-label">Finance</div>
            <h4 class="notifs-title mb-0">Payments</h4>
            <p class="notifs-sub mb-0">Overview of all transactions and records</p>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-3 mb-3">
        <div class="col-12 col-md-4">
            <div class="pay-card">
                <div class="pay-card-icon green"><i class="fa fa-wallet"></i></div>
                <div>
                    <div class="pay-card-label">Total Payments</div>
                    <div class="pay-card-value">₦245,000</div>
                    <div class="pay-card-meta green"><i class="fa fa-arrow-trend-up"></i> +12% this month</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="pay-card">
                <div class="pay-card-icon amber"><i class="fa fa-clock"></i></div>
                <div>
                    <div class="pay-card-label">Pending</div>
                    <div class="pay-card-value">₦38,000</div>
                    <div class="pay-card-meta amber"><i class="fa fa-circle-dot"></i> 3 pending</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="pay-card">
                <div class="pay-card-icon red"><i class="fa fa-circle-xmark"></i></div>
                <div>
                    <div class="pay-card-label">Failed Payments</div>
                    <div class="pay-card-value">₦12,500</div>
                    <div class="pay-card-meta red"><i class="fa fa-circle-dot"></i> 1 failed</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
    <form hx-get="{{ route('payments') }}" hx-target="#payment-table" hx-push-url="true"
        hx-trigger="keyup changed delay:400ms" class="h-filter mb-3">

        <div class="h-search-wrap">
            <i class="fa fa-search"></i>
            <input type="text" name="search_text" class="h-search" placeholder="Search by name or status..."
                value="{{ request('search_text') }}">
        </div>

        <a href="{{ route('payments') }}" class="n-btn n-btn-secondary text-decoration-none"
            hx-get="{{ route('payments') }}" hx-target="#content-area"
            hx-push-url="true" hx-indicator=".htmx-indicator">
            <i class="fa fa-xmark"></i> Clear
        </a>
    </form>

    <!-- Table -->
    <div id="payment-table" class="h-table-card">
        @include('partials.payments-table')
    </div>

</div>

<style>
    /* Shared header */
    .notifs-label { font-size:.7rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#a5b4fc; }
    .notifs-title { font-size:1.4rem; font-weight:700; color:#0f0f1a; letter-spacing:-.02em; }
    .notifs-sub   { font-size:.82rem; color:#9ca3af; margin-top:2px; }

    /* Summary cards */
    .pay-card { background:#fff; border:1px solid #f0f0f8; border-radius:14px; padding:1.2rem 1.3rem; display:flex; align-items:center; gap:1rem; transition:box-shadow .2s; }
    .pay-card:hover { box-shadow:0 4px 20px rgba(0,0,0,.07); }
    .pay-card-icon { width:46px; height:46px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0; }
    .pay-card-icon.green { background:#ecfdf5; color:#059669; }
    .pay-card-icon.amber { background:#fffbeb; color:#d97706; }
    .pay-card-icon.red   { background:#fff1f2; color:#e11d48; }
    .pay-card-label { font-size:.78rem; color:#9ca3af; font-weight:500; margin-bottom:2px; }
    .pay-card-value { font-size:1.45rem; font-weight:700; color:#111827; line-height:1.2; }
    .pay-card-meta  { font-size:.75rem; font-weight:500; margin-top:4px; display:flex; align-items:center; gap:5px; }
    .pay-card-meta.green { color:#059669; }
    .pay-card-meta.amber { color:#d97706; }
    .pay-card-meta.red   { color:#e11d48; }

    /* Filter & search */
    .h-filter { display:flex; gap:.6rem; align-items:center; }
    .h-search-wrap { position:relative; flex:1; }
    .h-search-wrap i { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:#c4c9d4; font-size:.8rem; pointer-events:none; }
    .h-search { width:100%; border-radius:9px; border:1px solid #e5e7eb; padding:.52rem .75rem .52rem 2.1rem; font-size:.85rem; background:#fafafa; outline:none; transition:all .15s; color:#111827; }
    .h-search:focus { border-color:#a5b4fc; background:#fff; box-shadow:0 0 0 3px rgba(79,70,229,.08); }
    .h-search::placeholder { color:#c4c9d4; }

    /* Buttons */
    .n-btn { display:inline-flex; align-items:center; gap:5px; padding:.45rem .85rem; border-radius:8px; font-size:.8rem; font-weight:600; border:1px solid transparent; cursor:pointer; transition:all .15s; white-space:nowrap; }
    .n-btn-secondary { background:#f3f4f6; border-color:#e5e7eb; color:#374151; }
    .n-btn-secondary:hover { background:#e9eaec; color:#111827; }

    /* Table */
    .h-table-card { background:#fff; border:1px solid #f0f0f8; border-radius:14px; overflow:hidden; }
    .h-table-card .table { margin:0; font-size:.84rem; }
    .h-table-card .table thead th { font-size:.72rem; text-transform:uppercase; letter-spacing:.06em; color:#9ca3af; font-weight:600; background:#fafafc; border-bottom:1px solid #f0f0f8; padding:.75rem 1rem; }
    .h-table-card .table tbody td { padding:.75rem 1rem; color:#374151; border-color:#f5f5fb; vertical-align:middle; }
    .h-table-card .table-hover tbody tr:hover { background:#f8f8fd; }

    /* Badges */
    .badge { border-radius:999px; padding:.35em .75em; font-size:.7rem; font-weight:600; }
    .badge.bg-success { background:rgba(5,150,105,.12) !important; color:#065f46 !important; }
    .badge.bg-primary { background:#eef2ff !important; color:#4f46e5 !important; }
    .badge.bg-warning { background:rgba(217,119,6,.12) !important; color:#92400e !important; }
    .badge.bg-danger  { background:rgba(225,29,72,.1) !important; color:#9f1239 !important; }

    @media(max-width:576px) {
        .h-filter { flex-direction:column; align-items:stretch; }
        .pay-card-value { font-size:1.2rem; }
    }
</style> --}}

{{-- <div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
        <div>
            <div class="notifs-label">Finance</div>
            <h4 class="notifs-title mb-0">Payments</h4>
            <p class="notifs-sub mb-0">Overview of all transactions and records</p>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-3 mb-3">
        <div class="col-12 col-md-4">
            <div class="pay-card">
                <div class="pay-card-icon green"><i class="fa fa-wallet"></i></div>
                <div>
                    <div class="pay-card-label">Total Collected</div>
                    <div class="pay-card-value">₦{{ number_format($payments->sum('amount')) }}</div>
                    <div class="pay-card-meta green"><i class="fa fa-circle-check"></i> All time</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="pay-card">
                <div class="pay-card-icon amber"><i class="fa fa-clock"></i></div>
                <div>
                    <div class="pay-card-label">Pending / Partial</div>
                    <div class="pay-card-value">
                        ₦{{ number_format($payments->filter(fn($p) => in_array($p->order?->payment_status, ['pending','partial']))->sum(fn($p) => $p->order?->total_amount - $p->order?->amount_paid)) }}
                    </div>
                    <div class="pay-card-meta amber"><i class="fa fa-circle-dot"></i> Balance due</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="pay-card">
                <div class="pay-card-icon red"><i class="fa fa-circle-xmark"></i></div>
                <div>
                    <div class="pay-card-label">Failed Payments</div>
                    <div class="pay-card-value">{{ $payments->where('status','failed')->count() }}</div>
                    <div class="pay-card-meta red"><i class="fa fa-circle-dot"></i> transactions</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
    <form hx-get="{{ route('payments') }}" hx-target="#payment-table" hx-push-url="true"
        hx-trigger="keyup changed delay:400ms" class="h-filter mb-3">
        <div class="h-search-wrap">
            <i class="fa fa-search"></i>
            <input type="text" name="search_text" class="h-search" placeholder="Search by name, reference or status..."
                value="{{ request('search_text') }}">
        </div>
        <a href="{{ route('payments') }}" class="n-btn n-btn-secondary text-decoration-none"
            hx-get="{{ route('payments') }}" hx-target="#content-area" hx-push-url="true" hx-indicator=".htmx-indicator">
            <i class="fa fa-xmark"></i> Clear
        </a>
    </form>

    <!-- Table -->
    <div id="payment-table" class="h-table-card">
        @include('partials.payments-table')
    </div>

</div> --}}

<!-- Payment Detail Modals -->
{{-- @foreach ($payments as $payment)
    @php
        $order   = $payment->order;
        $balance = $order ? ($order->total_amount - $order->amount_paid) : 0;
        $isPartial = $order && in_array($order->payment_status, ['pending', 'partial']);
    @endphp
    <div class="modal fade" id="paymentModal-{{ $payment->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width:520px;">
            <div class="modal-content od-modal">

                <div class="od-modal-header">
                    <div>
                        <div class="od-order-num">Payment #{{ $payment->reference }}</div>
                        <div class="od-order-sub">{{ $payment->created_at->format('M d, Y g:i A') }}</div>
                    </div>
                    <button class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
                </div>

                <div class="od-modal-body">

                    @if ($order)
                        <!-- Payment status banner -->
                        @if ($isPartial)
                            <div class="pay-alert-banner mb-3">
                                <i class="fa fa-triangle-exclamation"></i>
                                <span>This order has an outstanding balance of <strong>₦{{ number_format($balance) }}</strong></span>
                            </div>
                        @endif

                        <!-- Order + Customer info -->
                        <div class="od-info-grid mb-3">
                            <div class="od-info-card">
                                <div class="od-info-label"><i class="fa fa-user me-1"></i> Customer</div>
                                <div class="od-info-value">{{ $order->customer?->name ?? '—' }}</div>
                            </div>
                            <div class="od-info-card">
                                <div class="od-info-label"><i class="fa fa-hashtag me-1"></i> Order</div>
                                <div class="od-info-value">#{{ $order->id }}</div>
                            </div>
                            <div class="od-info-card">
                                <div class="od-info-label"><i class="fa fa-credit-card me-1"></i> Method</div>
                                <div class="od-info-value">{{ ucfirst($payment->method) }}</div>
                            </div>
                            <div class="od-info-card">
                                <div class="od-info-label"><i class="fa fa-circle-dot me-1"></i> Order Status</div>
                                <div class="od-info-value">{{ ucfirst($order->status) }}</div>
                            </div>
                        </div>

                        <!-- Payment breakdown -->
                        <div class="pay-breakdown">
                            <div class="pay-breakdown-row">
                                <span>Order Total</span>
                                <span>₦{{ number_format($order->total_amount) }}</span>
                            </div>
                            <div class="pay-breakdown-row">
                                <span>Amount Paid</span>
                                <span class="text-success fw-bold">₦{{ number_format($order->amount_paid) }}</span>
                            </div>
                            <div class="pay-breakdown-divider"></div>
                            <div class="pay-breakdown-row total">
                                <span>Balance Due</span>
                                <span class="{{ $balance > 0 ? 'text-danger' : 'text-success' }} fw-bold">
                                    ₦{{ number_format($balance) }}
                                </span>
                            </div>
                        </div>

                        <!-- Payment history for this order -->
                        @if ($order->payments && $order->payments->count() > 0)
                            <div class="mt-3">
                                <div class="p-label mb-2">Payment History</div>
                                <div class="pay-history">
                                    @foreach ($order->payments as $p)
                                        <div class="pay-history-row">
                                            <div>
                                                <div class="pay-history-ref">#{{ $p->reference }}</div>
                                                <div class="pay-history-date">{{ $p->created_at->format('M d, Y g:i A') }}</div>
                                            </div>
                                            <div class="text-end">
                                                <div class="pay-history-amount">₦{{ number_format($p->amount) }}</div>
                                                <span class="badge {{ $p->status === 'success' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $p->status }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    @else
                        <p class="text-muted text-center py-3">Order details not available.</p>
                    @endif

                </div>

                <div class="od-modal-footer">
                    <button class="n-btn n-btn-secondary" data-bs-dismiss="modal">Close</button>

                    @if ($isPartial)
                        <!-- Staff: record cash/bank payment -->
                        @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
                            <button class="n-btn n-btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#recordPaymentModal-{{ $order->id }}"
                                data-bs-dismiss="modal">
                                <i class="fa fa-plus me-1"></i> Record Payment
                            </button>
                        @endif

                        <!-- Customer: complete payment online -->
                        @if (auth()->user()->role === 'customer')
                            <a href="{{ route('order.completePayment', $order->id) }}"
                                class="n-btn n-btn-primary text-decoration-none">
                                <i class="fa fa-credit-card me-1"></i> Complete Payment
                            </a>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </div>

    <!-- Record Payment Modal (staff only) -->
    @if ($isPartial && auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
        <div class="modal fade" id="recordPaymentModal-{{ $order->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" style="max-width:400px;">
                <div class="modal-content od-modal">
                    <div class="od-modal-header">
                        <div>
                            <div class="od-order-num">Record Payment</div>
                            <div class="od-order-sub">Order #{{ $order->id }} — Balance: ₦{{ number_format($balance) }}</div>
                        </div>
                        <button class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
                    </div>
                    <form method="POST" action="{{ route('order.recordPayment', $order->id) }}">
                        @csrf
                        <div class="od-modal-body">
                            <div class="mb-3">
                                <label class="p-label">Amount Received (₦)</label>
                                <input type="number" name="amount" class="p-input" min="1"
                                    max="{{ $balance }}" value="{{ $balance }}" required>
                                <div style="font-size:.75rem;color:#9ca3af;margin-top:4px;">
                                    Max: ₦{{ number_format($balance) }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="p-label">Payment Method</label>
                                <select name="payment_method" class="p-input" required>
                                    <option value="cash">Cash</option>
                                    <option value="bank">Bank Transfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="od-modal-footer">
                            <button type="button" class="n-btn n-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="n-btn n-btn-primary">
                                <i class="fa fa-check me-1"></i> Record Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endforeach --}}

{{-- <style>
    .notifs-label { font-size:.7rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#a5b4fc; }
    .notifs-title { font-size:1.4rem; font-weight:700; color:#0f0f1a; letter-spacing:-.02em; }
    .notifs-sub   { font-size:.82rem; color:#9ca3af; margin-top:2px; }

    .pay-card { background:#fff; border:1px solid #f0f0f8; border-radius:14px; padding:1.2rem 1.3rem; display:flex; align-items:center; gap:1rem; transition:box-shadow .2s; }
    .pay-card:hover { box-shadow:0 4px 20px rgba(0,0,0,.07); }
    .pay-card-icon { width:46px; height:46px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0; }
    .pay-card-icon.green { background:#ecfdf5; color:#059669; }
    .pay-card-icon.amber { background:#fffbeb; color:#d97706; }
    .pay-card-icon.red   { background:#fff1f2; color:#e11d48; }
    .pay-card-label { font-size:.78rem; color:#9ca3af; font-weight:500; margin-bottom:2px; }
    .pay-card-value { font-size:1.45rem; font-weight:700; color:#111827; line-height:1.2; }
    .pay-card-meta  { font-size:.75rem; font-weight:500; margin-top:4px; display:flex; align-items:center; gap:5px; }
    .pay-card-meta.green { color:#059669; }
    .pay-card-meta.amber { color:#d97706; }
    .pay-card-meta.red   { color:#e11d48; }

    .h-filter { display:flex; gap:.6rem; align-items:center; }
    .h-search-wrap { position:relative; flex:1; }
    .h-search-wrap i { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:#c4c9d4; font-size:.8rem; pointer-events:none; }
    .h-search { width:100%; border-radius:9px; border:1px solid #e5e7eb; padding:.52rem .75rem .52rem 2.1rem; font-size:.85rem; background:#fafafa; outline:none; transition:all .15s; color:#111827; }
    .h-search:focus { border-color:#a5b4fc; background:#fff; box-shadow:0 0 0 3px rgba(79,70,229,.08); }
    .h-search::placeholder { color:#c4c9d4; }

    .n-btn { display:inline-flex; align-items:center; gap:5px; padding:.45rem .85rem; border-radius:8px; font-size:.8rem; font-weight:600; border:1px solid transparent; cursor:pointer; transition:all .15s; white-space:nowrap; }
    .n-btn-secondary { background:#f3f4f6; border-color:#e5e7eb; color:#374151; }
    .n-btn-secondary:hover { background:#e9eaec; }
    .n-btn-primary { background:#4f46e5; color:#fff; }
    .n-btn-primary:hover { background:#4338ca; }

    .h-table-card { background:#fff; border:1px solid #f0f0f8; border-radius:14px; overflow:hidden; }
    .h-table-card .table { margin:0; font-size:.84rem; }
    .h-table-card .table thead th { font-size:.72rem; text-transform:uppercase; letter-spacing:.06em; color:#9ca3af; font-weight:600; background:#fafafc; border-bottom:1px solid #f0f0f8; padding:.75rem 1rem; }
    .h-table-card .table tbody td { padding:.75rem 1rem; color:#374151; border-color:#f5f5fb; vertical-align:middle; }
    .h-table-card .table-hover tbody tr:hover { background:#f8f8fd; }

    .badge { border-radius:999px; padding:.35em .75em; font-size:.7rem; font-weight:600; }
    .badge.bg-success { background:rgba(5,150,105,.12) !important; color:#065f46 !important; }
    .badge.bg-primary { background:#eef2ff !important; color:#4f46e5 !important; }
    .badge.bg-warning { background:rgba(217,119,6,.12) !important; color:#92400e !important; }
    .badge.bg-danger  { background:rgba(225,29,72,.1) !important; color:#9f1239 !important; }

    /* Modal */
    .od-modal { border-radius:16px; border:1px solid #f0f0f8; overflow:hidden; }
    .od-modal-header { display:flex; justify-content:space-between; align-items:flex-start; padding:1.2rem 1.4rem; border-bottom:1px solid #f5f5fb; }
    .od-order-num { font-size:1rem; font-weight:700; color:#111827; }
    .od-order-sub { font-size:.75rem; color:#9ca3af; margin-top:2px; }
    .od-close { width:30px; height:30px; border-radius:8px; border:none; background:#f3f4f6; color:#6b7280; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:background .15s; }
    .od-close:hover { background:#e9eaec; }
    .od-modal-body { padding:1.2rem 1.4rem; }
    .od-modal-footer { display:flex; justify-content:flex-end; gap:.6rem; padding:1rem 1.4rem; border-top:1px solid #f5f5fb; }

    .od-info-grid { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; }
    .od-info-card { background:#fafafc; border:1px solid #f0f0f8; border-radius:10px; padding:.7rem .9rem; }
    .od-info-label { font-size:.72rem; color:#9ca3af; font-weight:600; margin-bottom:3px; }
    .od-info-value { font-size:.83rem; color:#111827; font-weight:500; }

    /* Alert banner */
    .pay-alert-banner { background:#fffbeb; border:1px solid #fde68a; border-radius:10px; padding:.65rem 1rem; display:flex; align-items:center; gap:.5rem; font-size:.83rem; color:#92400e; }
    .pay-alert-banner i { color:#d97706; }

    /* Breakdown */
    .pay-breakdown { background:#fafafc; border:1px solid #f0f0f8; border-radius:10px; padding:.9rem 1rem; }
    .pay-breakdown-row { display:flex; justify-content:space-between; font-size:.85rem; color:#6b7280; padding:.3rem 0; }
    .pay-breakdown-row.total { font-size:.9rem; font-weight:700; color:#111827; }
    .pay-breakdown-divider { height:1px; background:#e5e7eb; margin:.4rem 0; }

    /* Payment history */
    .pay-history { display:flex; flex-direction:column; gap:.5rem; }
    .pay-history-row { display:flex; justify-content:space-between; align-items:center; background:#fafafc; border:1px solid #f0f0f8; border-radius:9px; padding:.6rem .85rem; }
    .pay-history-ref { font-size:.8rem; font-weight:600; color:#374151; }
    .pay-history-date { font-size:.72rem; color:#9ca3af; }
    .pay-history-amount { font-size:.85rem; font-weight:700; color:#111827; margin-bottom:2px; }

    .p-label { font-size:.78rem; font-weight:600; color:#6b7280; margin-bottom:5px; display:block; }
    .p-input { width:100%; border-radius:9px; border:1px solid #e5e7eb; padding:.52rem .75rem; font-size:.85rem; color:#111827; background:#fafafa; transition:all .15s; outline:none; appearance:auto; }
    .p-input:focus { border-color:#a5b4fc; background:#fff; box-shadow:0 0 0 3px rgba(79,70,229,.08); }

    @media(max-width:576px) {
        .h-filter { flex-direction:column; align-items:stretch; }
        .od-info-grid { grid-template-columns:1fr; }
    }
</style> --}}

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
        <div>
            <div class="notifs-label">Finance</div>
            <h4 class="notifs-title mb-0">Payments</h4>
            <p class="notifs-sub mb-0">Overview of all transactions and records</p>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-3 mb-3">
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="pay-card">
                <div class="pay-card-icon green"><i class="fa fa-wallet"></i></div>
                <div>
                    <div class="pay-card-label">All Time</div>
                    <div class="pay-card-value">₦{{ number_format($totalAllTime) }}</div>
                    <div class="pay-card-meta green"><i class="fa fa-circle-check"></i> Total collected</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="pay-card">
                <div class="pay-card-icon blue"><i class="fa fa-calendar-day"></i></div>
                <div>
                    <div class="pay-card-label">Today</div>
                    <div class="pay-card-value">₦{{ number_format($totalToday) }}</div>
                    <div class="pay-card-meta blue"><i class="fa fa-circle-dot"></i> {{ now()->format('M d, Y') }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="pay-card">
                <div class="pay-card-icon purple"><i class="fa fa-calendar-week"></i></div>
                <div>
                    <div class="pay-card-label">This Week</div>
                    <div class="pay-card-value">₦{{ number_format($totalWeek) }}</div>
                    <div class="pay-card-meta purple"><i class="fa fa-circle-dot"></i> {{ now()->startOfWeek()->format('M d') }} – {{ now()->endOfWeek()->format('M d') }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="pay-card">
                <div class="pay-card-icon teal"><i class="fa fa-calendar"></i></div>
                <div>
                    <div class="pay-card-label">This Month</div>
                    <div class="pay-card-value">₦{{ number_format($totalMonth) }}</div>
                    <div class="pay-card-meta teal"><i class="fa fa-circle-dot"></i> {{ now()->format('F Y') }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="pay-card">
                <div class="pay-card-icon amber"><i class="fa fa-clock"></i></div>
                <div class="flex-grow-1">
                    <div class="pay-card-label">Pending / Partial</div>
                    <div class="pay-card-value">₦{{ number_format($totalPending) }}</div>
                    <div class="pay-card-meta amber"><i class="fa fa-circle-dot"></i> Balance due</div>
                </div>
                <a href="{{ route('orderTrack') }}"
                    hx-get="{{ route('orderTrack') }}"
                    hx-target="#content-area"
                    hx-push-url="true"
                    hx-indicator=".htmx-indicator"
                    class="pay-card-view-btn" title="View pending orders">
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="pay-card">
                <div class="pay-card-icon red"><i class="fa fa-circle-xmark"></i></div>
                <div>
                    <div class="pay-card-label">Failed</div>
                    <div class="pay-card-value">{{ $totalFailed }}</div>
                    <div class="pay-card-meta red"><i class="fa fa-circle-dot"></i> transactions</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
    <form hx-get="{{ route('payments') }}" hx-target="#payment-table" hx-push-url="true"
        hx-trigger="keyup changed delay:400ms" class="h-filter mb-3">
        <div class="h-search-wrap">
            <i class="fa fa-search"></i>
            <input type="text" name="search_text" class="h-search" placeholder="Search by name, reference or status..."
                value="{{ request('search_text') }}">
        </div>
        <a href="{{ route('payments') }}" class="n-btn n-btn-secondary text-decoration-none"
            hx-get="{{ route('payments') }}" hx-target="#content-area" hx-push-url="true" hx-indicator=".htmx-indicator">
            <i class="fa fa-xmark"></i> Clear
        </a>
    </form>

    <!-- Table -->
    <div id="payment-table" class="h-table-card">
        @include('partials.payments-table')
    </div>

</div>

<!-- Payment Detail Modals -->
@foreach ($payments as $payment)
    @php
        $order     = $payment->order;
        $balance   = $order ? max(0, $order->total_amount - $order->amount_paid) : 0;
        $isPartial = $order && in_array($order->payment_status, ['pending', 'partial']);
    @endphp
    <div class="modal fade" id="paymentModal-{{ $payment->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width:520px;">
            <div class="modal-content od-modal">

                <div class="od-modal-header">
                    <div>
                        <div class="od-order-num">Payment #{{ $payment->reference }}</div>
                        <div class="od-order-sub">{{ $payment->created_at->format('M d, Y g:i A') }}</div>
                    </div>
                    <button class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
                </div>

                <div class="od-modal-body">

                    @if ($order)
                        {{-- Payment status banner --}}
                        @if ($isPartial)
                            <div class="pay-alert-banner mb-3">
                                <i class="fa fa-triangle-exclamation"></i>
                                <span>This order has an outstanding balance of <strong>₦{{ number_format($balance) }}</strong></span>
                            </div>
                        @endif

                        <!-- Order + Customer info -->
                        <div class="od-info-grid mb-3">
                            <div class="od-info-card">
                                <div class="od-info-label"><i class="fa fa-user me-1"></i> Customer</div>
                                <div class="od-info-value">{{ $order->customer?->name ?? '—' }}</div>
                            </div>
                            <div class="od-info-card">
                                <div class="od-info-label"><i class="fa fa-hashtag me-1"></i> Order</div>
                                <div class="od-info-value">#{{ $order->id }}</div>
                            </div>
                            <div class="od-info-card">
                                <div class="od-info-label"><i class="fa fa-credit-card me-1"></i> Method</div>
                                <div class="od-info-value">{{ ucfirst($payment->method) }}</div>
                            </div>
                            <div class="od-info-card">
                                <div class="od-info-label"><i class="fa fa-circle-dot me-1"></i> Order Status</div>
                                <div class="od-info-value">{{ ucfirst($order->status) }}</div>
                            </div>
                        </div>

                        <!-- Payment breakdown -->
                        <div class="pay-breakdown mb-3">
                            <div class="pay-breakdown-row">
                                <span>Order Total</span>
                                <span>₦{{ number_format($order->total_amount) }}</span>
                            </div>
                            <div class="pay-breakdown-row">
                                <span>Amount Paid</span>
                                <span class="text-success fw-bold">₦{{ number_format($order->amount_paid) }}</span>
                            </div>
                            <div class="pay-breakdown-divider"></div>
                            <div class="pay-breakdown-row total">
                                <span>Balance Due</span>
                                <span class="{{ $balance > 0 ? 'text-danger' : 'text-success' }} fw-bold">
                                    ₦{{ number_format($balance) }}
                                </span>
                            </div>
                        </div>

                        <!-- Payment history -->
                        @if ($order->payments && $order->payments->count() > 0)
                            <div class="mb-2">
                                <div class="p-label mb-2">Payment History</div>
                                <div class="pay-history">
                                    @foreach ($order->payments as $p)
                                        <div class="pay-history-row">
                                            <div>
                                                <div class="pay-history-ref">#{{ $p->reference }}</div>
                                                <div class="pay-history-date">{{ $p->created_at->format('M d, Y g:i A') }}</div>
                                            </div>
                                            <div class="text-end">
                                                <div class="pay-history-amount">₦{{ number_format($p->amount) }}</div>
                                                <span class="badge {{ $p->status === 'success' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $p->status }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    @else
                        <p class="text-muted text-center py-3">Order details not available.</p>
                    @endif

                </div>

                <div class="od-modal-footer">

                    {{-- Delete — admin/superAdmin only --}}
                    @if (auth()->user()->hasAnyRole(['admin', 'superAdmin']))
                        <form method="POST" action="{{ route('payments.destroy', $payment->id) }}" class="me-auto"
                            onsubmit="return confirm('Delete this payment record? This cannot be undone.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="n-btn n-btn-danger">
                                <i class="fa fa-trash me-1"></i> Delete
                            </button>
                        </form>
                    @endif

                    <button class="n-btn n-btn-secondary" data-bs-dismiss="modal">Close</button>

                    @if ($isPartial)
                        {{-- Staff: record cash/bank payment --}}
                        @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
                            <button class="n-btn n-btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#recordPaymentModal-{{ $order->id }}"
                                data-bs-dismiss="modal">
                                <i class="fa fa-plus me-1"></i> Record Payment
                            </button>
                        @endif

                        {{-- Customer: complete payment online --}}
                        @if (auth()->user()->role === 'customer')
                            <a href="{{ route('order.completePayment', $order->id) }}"
                                class="n-btn n-btn-primary text-decoration-none">
                                <i class="fa fa-credit-card me-1"></i> Complete Payment
                            </a>
                        @endif
                    @endif

                </div>

            </div>
        </div>
    </div>

    {{-- Record Payment Modal (staff/admin only) --}}
    @if ($order && $isPartial && auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
        <div class="modal fade" id="recordPaymentModal-{{ $order->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" style="max-width:400px;">
                <div class="modal-content od-modal">
                    <div class="od-modal-header">
                        <div>
                            <div class="od-order-num">Record Payment</div>
                            <div class="od-order-sub">Order #{{ $order->id }} — Balance: ₦{{ number_format($balance) }}</div>
                        </div>
                        <button class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
                    </div>
                    <form method="POST" action="{{ route('order.recordPayment', $order->id) }}">
                        @csrf
                        <div class="od-modal-body">
                            <div class="mb-3">
                                <label class="p-label">Amount Received (₦)</label>
                                <input type="number" name="amount" class="p-input" min="1"
                                    max="{{ $balance }}" value="{{ $balance }}" required>
                                <div style="font-size:.75rem;color:#9ca3af;margin-top:4px;">
                                    Max: ₦{{ number_format($balance) }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="p-label">Payment Method</label>
                                <select name="payment_method" class="p-input" required>
                                    <option value="cash">Cash</option>
                                    <option value="bank">Bank Transfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="od-modal-footer">
                            <button type="button" class="n-btn n-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="n-btn n-btn-primary">
                                <i class="fa fa-check me-1"></i> Record Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endforeach

<style>
    .notifs-label { font-size:.7rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#a5b4fc; }
    .notifs-title { font-size:1.4rem; font-weight:700; color:#0f0f1a; letter-spacing:-.02em; }
    .notifs-sub   { font-size:.82rem; color:#9ca3af; margin-top:2px; }

    .pay-card { background:#fff; border:1px solid #f0f0f8; border-radius:14px; padding:1.2rem 1.3rem; display:flex; align-items:center; gap:1rem; transition:box-shadow .2s; }
    .pay-card:hover { box-shadow:0 4px 20px rgba(0,0,0,.07); }
    .pay-card-view-btn {
        width:30px; height:30px; border-radius:8px; background:#fff7ed;
        border:1px solid #fed7aa; color:#d97706; display:flex;
        align-items:center; justify-content:center; font-size:.75rem;
        flex-shrink:0; text-decoration:none; transition:all .15s; margin-left:auto;
    }
    .pay-card-view-btn:hover { background:#d97706; color:#fff; border-color:#d97706; }
    .pay-card-icon { width:46px; height:46px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0; }
    .pay-card-icon.green  { background:#ecfdf5; color:#059669; }
    .pay-card-icon.amber  { background:#fffbeb; color:#d97706; }
    .pay-card-icon.red    { background:#fff1f2; color:#e11d48; }
    .pay-card-icon.blue   { background:#eff6ff; color:#2563eb; }
    .pay-card-icon.purple { background:#f5f3ff; color:#7c3aed; }
    .pay-card-icon.teal   { background:#f0fdfa; color:#0d9488; }
    .pay-card-label { font-size:.78rem; color:#9ca3af; font-weight:500; margin-bottom:2px; }
    .pay-card-value { font-size:1.25rem; font-weight:700; color:#111827; line-height:1.2; }
    .pay-card-meta  { font-size:.72rem; font-weight:500; margin-top:4px; display:flex; align-items:center; gap:5px; }
    .pay-card-meta.green  { color:#059669; }
    .pay-card-meta.amber  { color:#d97706; }
    .pay-card-meta.red    { color:#e11d48; }
    .pay-card-meta.blue   { color:#2563eb; }
    .pay-card-meta.purple { color:#7c3aed; }
    .pay-card-meta.teal   { color:#0d9488; }

    .h-filter { display:flex; gap:.6rem; align-items:center; }
    .h-search-wrap { position:relative; flex:1; }
    .h-search-wrap i { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:#c4c9d4; font-size:.8rem; pointer-events:none; }
    .h-search { width:100%; border-radius:9px; border:1px solid #e5e7eb; padding:.52rem .75rem .52rem 2.1rem; font-size:.85rem; background:#fafafa; outline:none; transition:all .15s; color:#111827; }
    .h-search:focus { border-color:#a5b4fc; background:#fff; box-shadow:0 0 0 3px rgba(79,70,229,.08); }
    .h-search::placeholder { color:#c4c9d4; }

    .n-btn { display:inline-flex; align-items:center; gap:5px; padding:.45rem .85rem; border-radius:8px; font-size:.8rem; font-weight:600; border:1px solid transparent; cursor:pointer; transition:all .15s; white-space:nowrap; }
    .n-btn-secondary { background:#f3f4f6; border-color:#e5e7eb; color:#374151; }
    .n-btn-secondary:hover { background:#e9eaec; }
    .n-btn-primary { background:#4f46e5; color:#fff; }
    .n-btn-primary:hover { background:#4338ca; }
    .n-btn-danger { background:#fff1f2; border-color:#fecdd3; color:#e11d48; }
    .n-btn-danger:hover { background:#ffe4e6; }

    .h-table-card { background:#fff; border:1px solid #f0f0f8; border-radius:14px; overflow:hidden; }
    .h-table-card .table { margin:0; font-size:.84rem; }
    .h-table-card .table thead th { font-size:.72rem; text-transform:uppercase; letter-spacing:.06em; color:#9ca3af; font-weight:600; background:#fafafc; border-bottom:1px solid #f0f0f8; padding:.75rem 1rem; }
    .h-table-card .table tbody td { padding:.75rem 1rem; color:#374151; border-color:#f5f5fb; vertical-align:middle; }
    .h-table-card .table-hover tbody tr:hover { background:#f8f8fd; }

    .badge { border-radius:999px; padding:.35em .75em; font-size:.7rem; font-weight:600; }
    .badge.bg-success { background:rgba(5,150,105,.12) !important; color:#065f46 !important; }
    .badge.bg-primary { background:#eef2ff !important; color:#4f46e5 !important; }
    .badge.bg-warning { background:rgba(217,119,6,.12) !important; color:#92400e !important; }
    .badge.bg-danger  { background:rgba(225,29,72,.1) !important; color:#9f1239 !important; }

    /* Modal */
    .od-modal { border-radius:16px; border:1px solid #f0f0f8; overflow:hidden; }
    .od-modal-header { display:flex; justify-content:space-between; align-items:flex-start; padding:1.2rem 1.4rem; border-bottom:1px solid #f5f5fb; }
    .od-order-num { font-size:1rem; font-weight:700; color:#111827; }
    .od-order-sub { font-size:.75rem; color:#9ca3af; margin-top:2px; }
    .od-close { width:30px; height:30px; border-radius:8px; border:none; background:#f3f4f6; color:#6b7280; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:background .15s; }
    .od-close:hover { background:#e9eaec; }
    .od-modal-body { padding:1.2rem 1.4rem; }
    .od-modal-footer { display:flex; justify-content:flex-end; align-items:center; gap:.6rem; padding:1rem 1.4rem; border-top:1px solid #f5f5fb; flex-wrap:wrap; }

    .od-info-grid { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; }
    .od-info-card { background:#fafafc; border:1px solid #f0f0f8; border-radius:10px; padding:.7rem .9rem; }
    .od-info-label { font-size:.72rem; color:#9ca3af; font-weight:600; margin-bottom:3px; }
    .od-info-value { font-size:.83rem; color:#111827; font-weight:500; }

    .pay-alert-banner { background:#fffbeb; border:1px solid #fde68a; border-radius:10px; padding:.65rem 1rem; display:flex; align-items:center; gap:.5rem; font-size:.83rem; color:#92400e; }
    .pay-alert-banner i { color:#d97706; }

    .pay-breakdown { background:#fafafc; border:1px solid #f0f0f8; border-radius:10px; padding:.9rem 1rem; }
    .pay-breakdown-row { display:flex; justify-content:space-between; font-size:.85rem; color:#6b7280; padding:.3rem 0; }
    .pay-breakdown-row.total { font-size:.9rem; font-weight:700; color:#111827; }
    .pay-breakdown-divider { height:1px; background:#e5e7eb; margin:.4rem 0; }

    .pay-history { display:flex; flex-direction:column; gap:.5rem; }
    .pay-history-row { display:flex; justify-content:space-between; align-items:center; background:#fafafc; border:1px solid #f0f0f8; border-radius:9px; padding:.6rem .85rem; }
    .pay-history-ref { font-size:.8rem; font-weight:600; color:#374151; }
    .pay-history-date { font-size:.72rem; color:#9ca3af; }
    .pay-history-amount { font-size:.85rem; font-weight:700; color:#111827; margin-bottom:2px; }

    .p-label { font-size:.78rem; font-weight:600; color:#6b7280; margin-bottom:5px; display:block; }
    .p-input { width:100%; border-radius:9px; border:1px solid #e5e7eb; padding:.52rem .75rem; font-size:.85rem; color:#111827; background:#fafafa; transition:all .15s; outline:none; appearance:auto; }
    .p-input:focus { border-color:#a5b4fc; background:#fff; box-shadow:0 0 0 3px rgba(79,70,229,.08); }

    /* ── Mobile responsive stacked table ── */
    @media(max-width:767px) {
        .h-filter { flex-direction:column; align-items:stretch; }
        .pay-card-value { font-size:1.2rem; }
        .od-info-grid { grid-template-columns:1fr; }
        .od-modal-footer { justify-content:stretch; gap:.5rem; }
        .od-modal-footer > * { flex:1; justify-content:center; }

        /* Stack the payments table rows */
        .h-table-card .table thead { display:none; }
        .h-table-card .table tbody tr {
            display:block;
            border:1px solid #f0f0f8;
            border-radius:12px;
            margin:.6rem .75rem;
            padding:.5rem .75rem;
            background:#fff;
            box-shadow:0 1px 4px rgba(0,0,0,.04);
        }
        .h-table-card .table tbody td {
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:.4rem .25rem;
            border:none;
            font-size:.83rem;
        }
        .h-table-card .table tbody td::before {
            content: attr(data-label);
            font-size:.7rem;
            font-weight:600;
            color:#9ca3af;
            text-transform:uppercase;
            letter-spacing:.05em;
            flex-shrink:0;
            margin-right:.75rem;
        }
        .h-table-card .table tbody td:last-child { justify-content:flex-end; }
        .h-table-card .table tbody td:last-child::before { display:none; }
        .h-table-card .table tbody td[colspan] { display:block; text-align:center; }
        .h-table-card .table tbody td[colspan]::before { display:none; }
    }
</style>
