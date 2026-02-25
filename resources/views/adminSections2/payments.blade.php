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
</style>
