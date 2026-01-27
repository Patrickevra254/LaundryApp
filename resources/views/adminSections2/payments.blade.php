<div class="container-fluid mt-2">

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
</style>
