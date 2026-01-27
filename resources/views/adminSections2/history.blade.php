<div class="container-fluid mt-2">

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
</style>
