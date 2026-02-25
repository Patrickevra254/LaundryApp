{{-- <div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h4 class="fw-bold mb-0">History</h4>
            <small class="text-muted">View completed and past orders</small>
        </div>
    </div>

    <!-- Filters -->
    <form hx-get="{{ route('history') }}" hx-target="#history-table" hx-push-url="true"
        hx-trigger="keyup changed delay:400ms" class="history-filter-bar mb-4">

        <input type="text" name="q" class="form-control" placeholder="Search by customer or status"
            value="{{ request('q') }}">

        <a href="{{ route('history') }}" class="btn btn-outline-secondary" hx-get="{{ route('history') }}"
            hx-target="#content-area" hx-push-url="true" hx-indicator=".htmx-indicator">
            Clear
        </a>
    </form>

    <!-- History Table -->
    <div id="history-table" class="history-table-wrapper">
        @include('partials.history-table')
    </div>
</div>

<style>
    /* Global */
    body {
        background-color: #f6f8fb;
        font-family: 'Segoe UI', sans-serif;
    }

    /* Filter Bar */
    .history-filter-bar {
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(12px);
        border-radius: 16px;
        padding: 1rem;

        display: flex;
        gap: 0.75rem;
        align-items: center;

        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .history-filter-bar .form-control {
        border-radius: 12px;
    }

    /* Table Wrapper */
    .history-table-wrapper {
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

    /* Completed */
    .badge.bg-success {
        background: rgba(25, 135, 84, 0.18) !important;
        color: #0f5132 !important;
    }

    /* Delivered */
    .badge.bg-primary {
        background: rgba(13, 110, 253, 0.18) !important;
        color: #084298 !important;
    }

    /* Buttons */
    .btn {
        border-radius: 12px;
    }

    .btn-outline-secondary {
        font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .history-filter-bar {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style> --}}

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
        <div>
            <div class="notifs-label">Orders</div>
            <h4 class="notifs-title mb-0">History</h4>
            <p class="notifs-sub mb-0">View completed and past orders</p>
        </div>
    </div>

    <!-- Filter Bar -->
    <form hx-get="{{ route('history') }}" hx-target="#history-table" hx-push-url="true"
        hx-trigger="keyup changed delay:400ms" class="h-filter mb-3">

        <div class="h-search-wrap">
            <i class="fa fa-search"></i>
            <input type="text" name="q" class="h-search" placeholder="Search by customer or status..."
                value="{{ request('q') }}">
        </div>

        <a href="{{ route('history') }}" class="n-btn n-btn-secondary text-decoration-none"
            hx-get="{{ route('history') }}" hx-target="#content-area" hx-push-url="true" hx-indicator=".htmx-indicator">
            <i class="fa fa-xmark"></i> Clear
        </a>
    </form>

    <!-- Table -->
    <div id="history-table" class="h-table-card">
        @include('partials.history-table')
    </div>

</div>

<style>
    /* Reuse global page header styles from notifications */
    .notifs-label {
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: #a5b4fc;
    }

    .notifs-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0f0f1a;
        letter-spacing: -.02em;
    }

    .notifs-sub {
        font-size: .82rem;
        color: #9ca3af;
        margin-top: 2px;
    }

    /* Filter bar */
    .h-filter {
        display: flex;
        gap: .6rem;
        align-items: center;
    }

    .h-search-wrap {
        position: relative;
        flex: 1;
    }

    .h-search-wrap i {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #c4c9d4;
        font-size: .8rem;
        pointer-events: none;
    }

    .h-search {
        width: 100%;
        border-radius: 9px;
        border: 1px solid #e5e7eb;
        padding: .52rem .75rem .52rem 2.1rem;
        font-size: .85rem;
        background: #fafafa;
        outline: none;
        transition: all .15s;
        color: #111827;
    }

    .h-search:focus {
        border-color: #a5b4fc;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, .08);
    }

    .h-search::placeholder {
        color: #c4c9d4;
    }

    /* Reuse button styles */
    .n-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: .45rem .85rem;
        border-radius: 8px;
        font-size: .8rem;
        font-weight: 600;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all .15s;
        white-space: nowrap;
    }

    .n-btn-secondary {
        background: #f3f4f6;
        border-color: #e5e7eb;
        color: #374151;
    }

    .n-btn-secondary:hover {
        background: #e9eaec;
        color: #111827;
    }

    /* Table card */
    .h-table-card {
        background: #fff;
        border: 1px solid #f0f0f8;
        border-radius: 14px;
        overflow: hidden;
    }

    /* Table */
    .h-table-card .table {
        margin: 0;
        font-size: .84rem;
    }

    .h-table-card .table thead th {
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #9ca3af;
        font-weight: 600;
        background: #fafafc;
        border-bottom: 1px solid #f0f0f8;
        padding: .75rem 1rem;
    }

    .h-table-card .table tbody td {
        padding: .75rem 1rem;
        color: #374151;
        border-color: #f5f5fb;
        vertical-align: middle;
    }

    .h-table-card .table-hover tbody tr:hover {
        background: #f8f8fd;
    }

    /* Badges */
    .badge {
        border-radius: 999px;
        padding: .35em .75em;
        font-size: .7rem;
        font-weight: 600;
    }

    .badge.bg-success {
        background: rgba(5, 150, 105, .12) !important;
        color: #065f46 !important;
    }

    .badge.bg-primary {
        background: #eef2ff !important;
        color: #4f46e5 !important;
    }

    .badge.bg-warning {
        background: rgba(217, 119, 6, .12) !important;
        color: #92400e !important;
    }

    .badge.bg-danger {
        background: rgba(225, 29, 72, .1) !important;
        color: #9f1239 !important;
    }

    @media(max-width:576px) {
        .h-filter {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>
