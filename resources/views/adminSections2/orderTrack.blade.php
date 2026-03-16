{{-- <div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h4 class="fw-bold mb-0">Order Tracking</h4>
            <small class="text-muted">Manage and monitor your current orders</small>
        </div>
    </div>

    <!-- Filters -->
    <form hx-get="{{ route('orderTrack') }}" hx-target="#orderTrack-table" hx-push-url="true"
        hx-trigger="keyup changed delay:400ms" class="order-filter-bar mb-4">

        <input type="text" name="q" class="form-control" placeholder="Search by customer or status"
            value="{{ request('q') }}">

        <a href="{{ route('orderTrack') }}" class="btn btn-outline-secondary" hx-get="{{ route('orderTrack') }}"
            hx-target="#content-area" hx-push-url="true" hx-indicator=".htmx-indicator">
            Clear
        </a>
    </form>

    <!-- Orders Table -->
    <div id="orderTrack-table" class="order-table-wrapper">
        @include('partials.orderTrack-table')
    </div>

</div>

<!-- Order Details Modals -->
@foreach ($orders as $order)
    <div class="modal fade" id="orderDetailsModal-{{ $order->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">
                        Order #{{ $order->id }}
                    </h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- Customer Info -->
                    <div class="mb-4">
                        <h6 class="fw-semibold mb-2">Customer Information</h6>
                        <p class="mb-1"><strong>Name:</strong> {{ $order->customer->name }}</p>
                        <p class="mb-1"><strong>Phone:</strong> {{ $order->customer->phone }}</p>
                        <p class="mb-1"><strong>Pickup:</strong> {{ $order->pickup_address }}</p>
                        <p class="mb-0"><strong>Delivery:</strong> {{ $order->delivery_address }}</p>
                    </div>

                    <!-- Items -->
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Service</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $subtotal = 0; @endphp
                                @foreach ($order->items as $item)
                                    @php
                                        $itemSubtotal = $item->price * $item->quantity;
                                        $subtotal += $itemSubtotal;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->service_type }}</td>
                                        <td>₦{{ number_format($item->price) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>₦{{ number_format($itemSubtotal) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Subtotal</th>
                                    <th>₦{{ number_format($subtotal) }}</th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-end">Service Fee</th>
                                    <th>₦{{ number_format($order->service_fee) }}</th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-end fw-bold">Total</th>
                                    <th class="fw-bold">
                                        ₦{{ number_format($subtotal + $order->service_fee) }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>

                    <!-- Status Update -->
                    @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                Update Status
                            </button>
                            <ul class="dropdown-menu">
                                @foreach (['pending', 'In progress', 'completed', 'delivered'] as $status)
                                    <li>
                                        <form method="POST" action="{{ route('orders.updateStatus', $order->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="dropdown-item" type="submit" name="status"
                                                value="{{ $status }}">
                                                {{ $status }}
                                            </button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endforeach

<style>
    /* Global */
    body {
        background-color: #f6f8fb;
        font-family: 'Segoe UI', sans-serif;
    }

    /* Filter Bar */
    .order-filter-bar {
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(12px);
        border-radius: 16px;
        padding: 1rem;

        display: flex;
        gap: 0.75rem;
        align-items: center;

        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .order-filter-bar .form-control {
        border-radius: 12px;
    }

    /* Table Wrapper */
    .order-table-wrapper {
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(12px);
        border-radius: 18px;
        padding: 1.2rem;

        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    }

    /* Table */
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

    .badge.bg-warning {
        background: rgba(255, 193, 7, 0.18) !important;
        color: #856404 !important;
    }

    .badge.bg-info {
        background: rgba(13, 202, 240, 0.18) !important;
        color: #055160 !important;
    }

    .badge.bg-success {
        background: rgba(25, 135, 84, 0.18) !important;
        color: #0f5132 !important;
    }

    .badge.bg-primary {
        background: rgba(13, 110, 253, 0.18) !important;
        color: #084298 !important;
    }

    /* Modal */
    .modal-content {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(14px);
        border-radius: 18px;
        border: none;
    }

    .modal-header,
    .modal-footer {
        border: none;
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

    @media (max-width: 768px) {
        .order-filter-bar {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style> --}}


{{-- <div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
        <div>
            <div class="notifs-label">Orders</div>
            <h4 class="notifs-title mb-0">Order Tracking</h4>
            <p class="notifs-sub mb-0">Manage and monitor your current orders</p>
        </div>
    </div>

    <!-- Filter Bar -->
    <form hx-get="{{ route('orderTrack') }}" hx-target="#orderTrack-table" hx-push-url="true"
        hx-trigger="keyup changed delay:400ms" class="h-filter mb-3">

        <div class="h-search-wrap">
            <i class="fa fa-search"></i>
            <input type="text" name="q" class="h-search" placeholder="Search by customer or status..."
                value="{{ request('q') }}">
        </div>

        <a href="{{ route('orderTrack') }}" class="n-btn n-btn-secondary text-decoration-none"
            hx-get="{{ route('orderTrack') }}" hx-target="#content-area" hx-push-url="true"
            hx-indicator=".htmx-indicator">
            <i class="fa fa-xmark"></i> Clear
        </a>
    </form>

    <!-- Table -->
    <div id="orderTrack-table" class="h-table-card">
        @include('partials.orderTrack-table')
    </div>

</div>


<!-- Order Details Modals -->
@foreach ($orders as $order)
    <div class="modal fade" id="orderDetailsModal-{{ $order->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content od-modal">

                <div class="od-modal-header">
                    <div>
                        <div class="od-order-num">Order #{{ $order->id }}</div>
                        <div class="od-order-sub">{{ $order->created_at->format('M d, Y') }}</div>
                    </div>
                    <button class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
                </div>

                <div class="od-modal-body">

                    <!-- Customer Info -->
                    <div class="od-info-grid mb-4">
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-user me-1"></i> Customer</div>
                            <div class="od-info-value">{{ $order->customer->name }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-phone me-1"></i> Phone</div>
                            <div class="od-info-value">{{ $order->customer->phone }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-location-dot me-1"></i> Pickup</div>
                            <div class="od-info-value">{{ $order->pickup_address }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-truck me-1"></i> Delivery</div>
                            <div class="od-info-value">{{ $order->delivery_address }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-circle-dot me-1"></i> Status</div>
                            <div class="od-info-value">{{ $order->status }}</div>
                        </div>
                    </div>

                    <!-- Items Table -->
                    <div class="od-table-wrap">
                        <table class="table od-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Service</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $subtotal = 0; @endphp
                                @foreach ($order->items as $item)
                                    @php
                                        $itemSubtotal = $item->price * $item->quantity;
                                        $subtotal += $itemSubtotal;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->item_name }}</td>
                                        <td><span class="od-service-tag">{{ $item->service_type }}</span></td>
                                        <td>₦{{ number_format($item->price) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>₦{{ number_format($itemSubtotal) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="od-tfoot-row">
                                    <td colspan="4" class="text-end text-muted small">Subtotal</td>
                                    <td class="fw-600">₦{{ number_format($subtotal) }}</td>
                                </tr>
                                <tr class="od-tfoot-row">
                                    <td colspan="4" class="text-end text-muted small">Service Fee</td>
                                    <td class="fw-600">₦{{ number_format($order->service_fee) }}</td>
                                </tr>
                                <tr class="od-total-row">
                                    <td colspan="4" class="text-end">Total</td>
                                    <td>₦{{ number_format($subtotal + $order->service_fee) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>

                <div class="od-modal-footer">
                    <button class="n-btn n-btn-secondary" data-bs-dismiss="modal">Close</button>

                    @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
                        <div class="dropdown">
                            <button class="n-btn n-btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-pen-to-square me-1"></i> Update Status
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end od-status-menu">
                                @foreach (['pending', 'In progress', 'completed', 'delivered'] as $status)
                                    <li>
                                        <form method="POST" action="{{ route('orders.updateStatus', $order->id) }}">
                                            @csrf @method('PATCH')
                                            <button class="dropdown-item od-status-item" type="submit" name="status"
                                                value="{{ $status }}">
                                                {{ ucfirst($status) }}
                                            </button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endforeach


<style>
    /* Reuse shared styles */
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

    .n-btn-primary {
        background: #4f46e5;
        color: #fff;
    }

    .n-btn-primary:hover {
        background: #4338ca;
    }

    .h-table-card {
        background: #fff;
        border: 1px solid #f0f0f8;
        border-radius: 14px;
        overflow: hidden;
    }

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

    .badge.bg-info {
        background: rgba(6, 182, 212, .12) !important;
        color: #0e7490 !important;
    }

    .badge.bg-danger {
        background: rgba(225, 29, 72, .1) !important;
        color: #9f1239 !important;
    }

    /* Modal */
    .od-modal {
        border-radius: 16px;
        border: 1px solid #f0f0f8;
        overflow: hidden;
    }

    .od-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 1.2rem 1.4rem;
        border-bottom: 1px solid #f5f5fb;
    }

    .od-order-num {
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
    }

    .od-order-sub {
        font-size: .75rem;
        color: #9ca3af;
        margin-top: 2px;
    }

    .od-close {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        border: none;
        background: #f3f4f6;
        color: #6b7280;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background .15s;
    }

    .od-close:hover {
        background: #e9eaec;
        color: #111827;
    }

    .od-modal-body {
        padding: 1.2rem 1.4rem;
    }

    .od-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: .75rem;
    }

    .od-info-card {
        background: #fafafc;
        border: 1px solid #f0f0f8;
        border-radius: 10px;
        padding: .7rem .9rem;
    }

    .od-info-label {
        font-size: .72rem;
        color: #9ca3af;
        font-weight: 600;
        margin-bottom: 3px;
    }

    .od-info-value {
        font-size: .83rem;
        color: #111827;
        font-weight: 500;
    }

    .od-table-wrap {
        border: 1px solid #f0f0f8;
        border-radius: 10px;
        overflow: hidden;
    }

    .od-table thead th {
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: .05em;
        color: #9ca3af;
        background: #fafafc;
        border-bottom: 1px solid #f0f0f8;
        padding: .6rem .9rem;
    }

    .od-table tbody td {
        font-size: .83rem;
        color: #374151;
        border-color: #f5f5fb;
        padding: .65rem .9rem;
    }

    .od-service-tag {
        background: #eef2ff;
        color: #4f46e5;
        font-size: .72rem;
        font-weight: 600;
        padding: .25em .6em;
        border-radius: 6px;
    }

    .od-tfoot-row td {
        border-top: 1px solid #f0f0f8;
        padding: .5rem .9rem;
        font-size: .83rem;
    }

    .od-total-row td {
        border-top: 2px solid #f0f0f8;
        padding: .65rem .9rem;
        font-weight: 700;
        font-size: .88rem;
        color: #111827;
    }

    .od-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: .6rem;
        padding: 1rem 1.4rem;
        border-top: 1px solid #f5f5fb;
    }

    .od-status-menu {
        border-radius: 10px;
        border: 1px solid #f0f0f8;
        padding: .3rem 0;
        font-size: .83rem;
    }

    .od-status-item {
        padding: .5rem 1rem;
        color: #374151;
    }

    .od-status-item:hover {
        background: #f5f5ff;
        color: #4f46e5;
    }

    @media(max-width:576px) {
        .h-filter {
            flex-direction: column;
            align-items: stretch;
        }

        .od-info-grid {
            grid-template-columns: 1fr;
        }
    }
</style> --}}
<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
        <div>
            <div class="notifs-label">Orders</div>
            <h4 class="notifs-title mb-0">Order Tracking</h4>
            <p class="notifs-sub mb-0">Manage and monitor your current orders</p>
        </div>
    </div>

    <!-- Filter Bar -->
    <form hx-get="{{ route('orderTrack') }}" hx-target="#orderTrack-table" hx-push-url="true"
        hx-trigger="keyup changed delay:400ms" class="h-filter mb-3">
        <div class="h-search-wrap">
            <i class="fa fa-search"></i>
            <input type="text" name="q" class="h-search" placeholder="Search by customer or status..."
                value="{{ request('q') }}">
        </div>
        <a href="{{ route('orderTrack') }}" class="n-btn n-btn-secondary text-decoration-none"
            hx-get="{{ route('orderTrack') }}" hx-target="#content-area" hx-push-url="true"
            hx-indicator=".htmx-indicator">
            <i class="fa fa-xmark"></i> Clear
        </a>
    </form>

    <!-- Table -->
    <div id="orderTrack-table" class="h-table-card">
        @include('partials.orderTrack-table')
    </div>

</div>

<!-- Order Detail Modals -->
@foreach ($orders as $order)
    @php
        $balance = max(0, $order->total_amount - $order->amount_paid);
        $payStatus = $order->payment_status ?? 'pending';
        $isPartial = in_array($payStatus, ['pending', 'partial']);
        $invoiceNo = 'INV-' . str_pad($order->id, 4, '0', STR_PAD_LEFT);
        $createdByUser = $order->createdBy;
        $createdBy = $createdByUser?->name ?? '—';
        $createdByRole = $createdByUser ? ucfirst($createdByUser->role) : null;
    @endphp

    <div class="modal fade" id="orderDetailsModal-{{ $order->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width:700px;">
            <div class="modal-content od-modal">

                <div class="od-modal-header">
                    <div>
                        <div class="od-order-num">
                            {{ $invoiceNo }}
                            <span class="od-order-id-sub">· Order #{{ $order->id }}</span>
                        </div>
                        <div class="od-order-sub">{{ $order->created_at->format('M d, Y · h:i A') }}</div>
                    </div>
                    <button class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
                </div>

                <div class="od-modal-body">

                    {{-- Payment alert --}}
                    @if ($isPartial)
                        <div class="pay-alert-banner mb-3">
                            <i class="fa fa-triangle-exclamation"></i>
                            <span>Outstanding balance of <strong>₦{{ number_format($balance) }}</strong> — payment not
                                complete</span>
                        </div>
                    @endif

                    <!-- Info grid -->
                    <div class="od-info-grid mb-4">
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-user me-1"></i> Customer</div>
                            <div class="od-info-value">{{ $order->customer?->name }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-phone me-1"></i> Phone</div>
                            <div class="od-info-value">{{ $order->customer?->phone }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-location-dot me-1"></i> Pickup</div>
                            <div class="od-info-value">{{ $order->pickup_address }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-truck me-1"></i> Delivery</div>
                            <div class="od-info-value">{{ $order->delivery_address }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-circle-dot me-1"></i> Order Status</div>
                            <div class="od-info-value">{{ ucfirst($order->status) }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-credit-card me-1"></i> Payment</div>
                            <div class="od-info-value">
                                <span class="pay-badge pay-badge-{{ $payStatus }}">{{ ucfirst($payStatus) }}</span>
                                @if ($balance > 0)
                                    <span style="font-size:.75rem;color:#dc2626;margin-left:5px;">
                                        ₦{{ number_format($balance) }} due
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{-- Created By --}}
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-pen me-1"></i> Created By</div>
                            <div class="od-info-value">
                                {{ $createdBy }}
                                @if ($createdByRole)
                                    <span class="created-by-role">{{ $createdByRole }}</span>
                                @endif
                                <div class="created-by-time">
                                    <i class="fa fa-clock me-1"></i>
                                    {{ $order->created_at->format('D, M d Y · h:i A') }}
                                </div>
                            </div>
                        </div>
                        {{-- Invoice Number --}}
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-file-invoice me-1"></i> Invoice No.</div>
                            <div class="od-info-value">
                                <span class="inv-number-modal">{{ $invoiceNo }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment breakdown -->
                    <div class="pay-breakdown mb-4">
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

                    <!-- Items table -->
                    <div class="od-table-wrap">
                        <table class="table od-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Item Description</th>
                                    <th>Service</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $subtotal = 0; @endphp
                                @foreach ($order->items as $item)
                                    @php
                                        $itemSub = $item->price * $item->quantity;
                                        $subtotal += $itemSub;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->item_name }}</td>
                                        <td><span class="od-service-tag">{{ $item->service_type }}</span></td>
                                        <td>₦{{ number_format($item->price) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>₦{{ number_format($itemSub) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="od-tfoot-row">
                                    <td colspan="4" class="text-end text-muted small">Subtotal</td>
                                    <td class="fw-600">₦{{ number_format($subtotal) }}</td>
                                </tr>
                                <tr class="od-tfoot-row">
                                    <td colspan="4" class="text-end text-muted small">Service Fee</td>
                                    <td class="fw-600">₦{{ number_format($order->service_fee) }}</td>
                                </tr>
                                <tr class="od-total-row">
                                    <td colspan="4" class="text-end">Total</td>
                                    <td>₦{{ number_format($subtotal + $order->service_fee) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>

                <div class="od-modal-footer">
                    <button class="n-btn n-btn-secondary" data-bs-dismiss="modal">Close</button>

                    <button class="n-btn n-btn-secondary" onclick="printInvoice({{ $order->id }})">
                        <i class="fa fa-print me-1"></i> Print Invoice
                    </button>

                    @if (
                        $isPartial &&
                            auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
                        <button class="n-btn n-btn-primary" data-bs-toggle="modal"
                            data-bs-target="#recordPaymentModal-{{ $order->id }}" data-bs-dismiss="modal">
                            <i class="fa fa-plus me-1"></i> Record Payment
                        </button>
                    @endif

                    @if ($isPartial && auth()->user()->role === 'customer')
                        <a href="{{ route('order.completePayment', $order->id) }}"
                            class="n-btn n-btn-primary text-decoration-none">
                            <i class="fa fa-credit-card me-1"></i> Complete Payment
                        </a>
                    @endif

                    @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
                        <div class="dropdown">
                            <button class="n-btn n-btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-pen-to-square me-1"></i> Update Status
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end od-status-menu">
                                @foreach (['pending', 'In progress', 'completed', 'delivered'] as $status)
                                    <li>
                                        <form method="POST" action="{{ route('orders.updateStatus', $order->id) }}">
                                            @csrf @method('PATCH')
                                            <button class="dropdown-item od-status-item" type="submit"
                                                name="status" value="{{ $status }}">
                                                {{ ucfirst($status) }}
                                            </button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    {{-- Record Payment Modal --}}
    @if (
        $isPartial &&
            auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
        <div class="modal fade" id="recordPaymentModal-{{ $order->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" style="max-width:400px;">
                <div class="modal-content od-modal">
                    <div class="od-modal-header">
                        <div>
                            <div class="od-order-num">Record Payment</div>
                            <div class="od-order-sub">{{ $invoiceNo }} — Balance: ₦{{ number_format($balance) }}
                            </div>
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
                            <div>
                                <label class="p-label">Payment Method</label>
                                <select name="payment_method" class="p-input" required>
                                    <option value="cash">Cash</option>
                                    <option value="bank">Bank Transfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="od-modal-footer">
                            <button type="button" class="n-btn n-btn-secondary"
                                data-bs-dismiss="modal">Cancel</button>
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
    }

    .n-btn-primary {
        background: #4f46e5;
        color: #fff;
    }

    .n-btn-primary:hover {
        background: #4338ca;
    }

    .h-table-card {
        background: #fff;
        border: 1px solid #f0f0f8;
        border-radius: 14px;
        overflow: hidden;
    }

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

    .badge.bg-info {
        background: rgba(6, 182, 212, .12) !important;
        color: #0e7490 !important;
    }

    .badge.bg-danger {
        background: rgba(225, 29, 72, .1) !important;
        color: #9f1239 !important;
    }

    .pay-badge {
        font-size: .72rem;
        font-weight: 700;
        padding: .28em .65em;
        border-radius: 6px;
    }

    .pay-badge-paid {
        background: #ecfdf5;
        color: #065f46;
    }

    .pay-badge-partial {
        background: #fff7ed;
        color: #c2410c;
        border: 1px solid #fed7aa;
    }

    .pay-badge-pending {
        background: #fffbeb;
        color: #92400e;
    }

    .pay-alert-banner {
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 10px;
        padding: .65rem 1rem;
        display: flex;
        align-items: center;
        gap: .5rem;
        font-size: .83rem;
        color: #92400e;
    }

    .pay-alert-banner i {
        color: #d97706;
    }

    .pay-breakdown {
        background: #fafafc;
        border: 1px solid #f0f0f8;
        border-radius: 10px;
        padding: .9rem 1rem;
    }

    .pay-breakdown-row {
        display: flex;
        justify-content: space-between;
        font-size: .85rem;
        color: #6b7280;
        padding: .3rem 0;
    }

    .pay-breakdown-row.total {
        font-size: .9rem;
        font-weight: 700;
        color: #111827;
    }

    .pay-breakdown-divider {
        height: 1px;
        background: #e5e7eb;
        margin: .4rem 0;
    }

    .od-modal {
        border-radius: 16px;
        border: 1px solid #f0f0f8;
        overflow: hidden;
    }

    .od-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 1.2rem 1.4rem;
        border-bottom: 1px solid #f5f5fb;
    }

    .od-order-num {
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
    }

    .od-order-sub {
        font-size: .75rem;
        color: #9ca3af;
        margin-top: 2px;
    }

    .od-close {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        border: none;
        background: #f3f4f6;
        color: #6b7280;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background .15s;
    }

    .od-close:hover {
        background: #e9eaec;
    }

    .od-modal-body {
        padding: 1.2rem 1.4rem;
    }

    .od-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: .6rem;
        padding: 1rem 1.4rem;
        border-top: 1px solid #f5f5fb;
        flex-wrap: wrap;
    }

    .od-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: .75rem;
    }

    .od-info-card {
        background: #fafafc;
        border: 1px solid #f0f0f8;
        border-radius: 10px;
        padding: .7rem .9rem;
    }

    .od-info-label {
        font-size: .72rem;
        color: #9ca3af;
        font-weight: 600;
        margin-bottom: 3px;
    }

    .od-info-value {
        font-size: .83rem;
        color: #111827;
        font-weight: 500;
    }

    .od-table-wrap {
        border: 1px solid #f0f0f8;
        border-radius: 10px;
        overflow: hidden;
    }

    .od-table thead th {
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: .05em;
        color: #9ca3af;
        background: #fafafc;
        border-bottom: 1px solid #f0f0f8;
        padding: .6rem .9rem;
    }

    .od-table tbody td {
        font-size: .83rem;
        color: #374151;
        border-color: #f5f5fb;
        padding: .65rem .9rem;
    }

    .od-service-tag {
        background: #eef2ff;
        color: #4f46e5;
        font-size: .72rem;
        font-weight: 600;
        padding: .25em .6em;
        border-radius: 6px;
    }

    .od-tfoot-row td {
        border-top: 1px solid #f0f0f8;
        padding: .5rem .9rem;
        font-size: .83rem;
    }

    .od-total-row td {
        border-top: 2px solid #f0f0f8;
        padding: .65rem .9rem;
        font-weight: 700;
        font-size: .88rem;
        color: #111827;
    }

    .od-status-menu {
        border-radius: 10px;
        border: 1px solid #f0f0f8;
        padding: .3rem 0;
        font-size: .83rem;
    }

    .od-status-item {
        padding: .5rem 1rem;
        color: #374151;
    }

    .od-status-item:hover {
        background: #f5f5ff;
        color: #4f46e5;
    }

    .fw-600 {
        font-weight: 600;
    }

    .p-label {
        font-size: .78rem;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 5px;
        display: block;
    }

    .p-input {
        width: 100%;
        border-radius: 9px;
        border: 1px solid #e5e7eb;
        padding: .52rem .75rem;
        font-size: .85rem;
        color: #111827;
        background: #fafafa;
        transition: all .15s;
        outline: none;
        appearance: auto;
    }

    .p-input:focus {
        border-color: #a5b4fc;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, .08);
    }

    .created-by-role {
        display: inline-block;
        font-size: .68rem;
        font-weight: 600;
        color: #4f46e5;
        background: #eef2ff;
        border-radius: 5px;
        padding: .1em .5em;
        margin-left: .35rem;
        vertical-align: middle;
    }

    .created-by-time {
        font-size: .72rem;
        color: #9ca3af;
        margin-top: 3px;
    }

    @media(max-width:576px) {
        .h-filter {
            flex-direction: column;
            align-items: stretch;
        }

        .od-info-grid {
            grid-template-columns: 1fr;
        }

        .od-modal-footer {
            justify-content: stretch;
        }

        .od-modal-footer .n-btn {
            justify-content: center;
            flex: 1;
        }
    }
</style>

@include('partials.OrderPrintFunction')
