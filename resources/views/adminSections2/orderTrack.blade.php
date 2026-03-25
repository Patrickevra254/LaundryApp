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

{{-- ═══ SINGLE LOOP — modals + invoice templates together ═══ --}}
@foreach ($orders as $order)
    @php
        $balance = max(0, $order->total_amount - $order->amount_paid);
        $payStatus = $order->payment_status ?? 'pending';
        $isPartial = in_array($payStatus, ['pending', 'partial']);
        $invoiceNo = 'INV-' . str_pad($order->id, 4, '0', STR_PAD_LEFT);
        $subtotal = $order->items->sum(fn($i) => $i->price * $i->quantity);
        $createdByUser = $order->createdBy;
        $createdBy = $createdByUser?->name ?? '—';
        $createdByRole = $createdByUser ? ucfirst($createdByUser->role) : null;
    @endphp

    {{-- ── Order Detail Modal ────────────────────────────────── --}}
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

                    @if ($isPartial)
                        <div class="pay-alert-banner mb-3">
                            <i class="fa fa-triangle-exclamation"></i>
                            <span>Outstanding balance of <strong>₦{{ number_format($balance) }}</strong> — payment not
                                complete</span>
                        </div>
                    @endif

                    <div class="od-info-grid mb-4">

                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-user me-1"></i> Customer</div>
                            <div class="od-info-value">{{ $order->customer?->name }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-file-invoice me-1"></i> Invoice No.</div>
                            <div class="od-info-value">
                                <span class="inv-number-modal">{{ $invoiceNo }}</span>
                            </div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-phone me-1"></i> Phone</div>
                            <div class="od-info-value">{{ $order->customer?->phone }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-location-dot me-1"></i> Pickup Address</div>
                            <div class="od-info-value">{{ $order->pickup_address }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-truck me-1"></i> Delivery Address</div>
                            <div class="od-info-value">{{ $order->delivery_address }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-truck me-1"></i> Pickup Date</div>
                            <div class="od-info-value">{{ $order->pickup_date }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-truck me-1"></i> Delivery Date</div>
                            <div class="od-info-value">{{ $order->delivery_date }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-circle-dot me-1"></i> Order Status</div>
                            <div class="od-info-value">{{ ucfirst($order->status) }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-building me-1"></i> Branch</div>
                            <div class="od-info-value">{{ $order->branch?->name ?? '—' }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-credit-card me-1"></i> Payment</div>
                            <div class="od-info-value">
                                <span class="pay-badge pay-badge-{{ $payStatus }}">{{ ucfirst($payStatus) }}</span>
                                @if ($balance > 0)
                                    <span
                                        style="font-size:.75rem;color:#dc2626;margin-left:5px;">₦{{ number_format($balance) }}
                                        due</span>
                                @endif
                            </div>
                        </div>
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
                        {{-- <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-file-invoice me-1"></i> Invoice No.</div>
                            <div class="od-info-value">
                                <span class="inv-number-modal">{{ $invoiceNo }}</span>
                            </div>
                        </div> --}}
                        
                        {{-- Staff Assignment (only shown if set) --}}
                        @if ($order->wash_assigned_to || $order->iron_assigned_to)
                            <div class="od-info-card">
                                <div class="od-info-label"><i class="fa fa-droplet me-1" style="color:#3b82f6;"></i>
                                    Assigned Washer</div>
                                <div class="od-info-value">{{ $order->wash_assigned_to ?: '—' }}</div>
                            </div>
                            <div class="od-info-card">
                                <div class="od-info-label"><i class="fa fa-fire me-1" style="color:#f59e0b;"></i>
                                    Assigned Ironer</div>
                                <div class="od-info-value">{{ $order->iron_assigned_to ?: '—' }}</div>
                            </div>
                        @endif
                    </div>

                    <div class="pay-breakdown mb-4">
                        <div class="pay-breakdown-row"><span>Order
                                Total</span><span>₦{{ number_format($order->total_amount) }}</span></div>
                        <div class="pay-breakdown-row"><span>Amount Paid</span><span
                                class="text-success fw-bold">₦{{ number_format($order->amount_paid) }}</span></div>
                        <div class="pay-breakdown-divider"></div>
                        <div class="pay-breakdown-row total">
                            <span>Balance Due</span>
                            <span
                                class="{{ $balance > 0 ? 'text-danger' : 'text-success' }} fw-bold">₦{{ number_format($balance) }}</span>
                        </div>
                    </div>

                    <div class="od-table-wrap">
                        <table class="table od-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Item Description</th>
                                    <th>Service</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $itemsSubtotal = 0;
                                    $extraTotal = 0;
                                @endphp
                                @foreach ($order->items as $item)
                                    @php
                                        $itemSub = $item->price * $item->quantity;
                                        $itemsSubtotal += $itemSub;
                                        $extraTotal += $item->extra_charge ?? 0;
                                        $hasCare =
                                            $item->description ||
                                            $item->observations ||
                                            $item->requirements ||
                                            $item->starch_level ||
                                            $item->heat_level ||
                                            $item->finish;
                                    @endphp
                                    {{-- Main item row --}}
                                    <tr class="item-main-row">
                                        <td style="width:30px;">
                                            @if ($hasCare)
                                                <button type="button" class="care-toggle n-icon-btn"
                                                    data-target="care-{{ $order->id }}-{{ $item->id }}"
                                                    title="View care details">
                                                    <i class="fa fa-chevron-right care-chevron"
                                                        style="font-size:.6rem;"></i>
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $item->item_name }}
                                            @if ($item->description)
                                                <div style="font-size:.72rem;color:#9ca3af;margin-top:2px;">
                                                    {{ $item->description }}</div>
                                            @endif
                                        </td>
                                        <td><span
                                                class="od-service-tag">{{ ucwords(str_replace('_', ' ', $item->service_type)) }}</span>
                                        </td>
                                        <td>₦{{ number_format($item->price) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>
                                            ₦{{ number_format($itemSub) }}
                                            @if (($item->extra_charge ?? 0) > 0)
                                                <div style="font-size:.68rem;color:#c2410c;font-weight:600;">
                                                    +₦{{ number_format($item->extra_charge) }} extra</div>
                                            @endif
                                        </td>
                                    </tr>
                                    {{-- Collapsible care details row --}}
                                    @if ($hasCare)
                                        <tr class="care-detail-row"
                                            id="care-{{ $order->id }}-{{ $item->id }}" style="display:none;">
                                            <td colspan="6" style="padding:0;">
                                                <div class="care-detail-panel">
                                                    <div class="care-detail-grid">
                                                        @if ($item->starch_level)
                                                            <div class="care-chip">
                                                                <span class="care-chip-label">Starch</span>
                                                                <span
                                                                    class="care-chip-val">{{ $item->starch_label }}</span>
                                                            </div>
                                                        @endif
                                                        @if ($item->heat_level)
                                                            <div class="care-chip">
                                                                <span class="care-chip-label">Heat</span>
                                                                <span
                                                                    class="care-chip-val">{{ $item->heat_label }}</span>
                                                            </div>
                                                        @endif
                                                        @if ($item->finish)
                                                            <div class="care-chip">
                                                                <span class="care-chip-label">Finish</span>
                                                                <span
                                                                    class="care-chip-val">{{ $item->finish_label }}</span>
                                                            </div>
                                                        @endif
                                                        @if (($item->extra_charge ?? 0) > 0)
                                                            <div class="care-chip care-chip-cost">
                                                                <span class="care-chip-label">Extra Charge</span>
                                                                <span
                                                                    class="care-chip-val">₦{{ number_format($item->extra_charge) }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    @if ($item->observations)
                                                        <div class="care-note">
                                                            <span class="care-note-label"><i
                                                                    class="fa fa-eye me-1"></i>Observations:</span>
                                                            {{ $item->observations }}
                                                        </div>
                                                    @endif
                                                    @if ($item->requirements)
                                                        <div class="care-note">
                                                            <span class="care-note-label"><i
                                                                    class="fa fa-comment-dots me-1"></i>Requirements:</span>
                                                            {{ $item->requirements }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="od-tfoot-row">
                                    <td colspan="5" class="text-end text-muted small">Subtotal</td>
                                    <td class="fw-600">₦{{ number_format($itemsSubtotal) }}</td>
                                </tr>
                                <tr class="od-tfoot-row">
                                    <td colspan="5" class="text-end text-muted small">Service Fee</td>
                                    <td class="fw-600">₦{{ number_format($order->service_fee) }}</td>
                                </tr>
                                @if (($order->extra_charges ?? 0) > 0)
                                    <tr class="od-tfoot-row">
                                        <td colspan="5" class="text-end text-muted small">Extra Charges</td>
                                        <td class="fw-600" style="color:#c2410c;">
                                            ₦{{ number_format($order->extra_charges) }}</td>
                                    </tr>
                                @endif
                                <tr class="od-total-row">
                                    <td colspan="5" class="text-end">Total</td>
                                    <td>₦{{ number_format($order->total_amount) }}</td>
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

                    @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
                        <button class="n-btn n-btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#editDetailsModal-{{ $order->id }}" data-bs-dismiss="modal">
                            <i class="fa fa-pen-to-square me-1"></i> Edit Details
                        </button>
                    @endif

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
                                                name="status"
                                                value="{{ $status }}">{{ ucfirst($status) }}</button>
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

    {{-- ── Record Payment Modal ──────────────────────────────── --}}
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
                                <div style="font-size:.75rem;color:#9ca3af;margin-top:4px;">Max:
                                    ₦{{ number_format($balance) }}</div>
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

    {{-- ── Edit Details Modal (staff/admin only) ──────────────── --}}
    @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
        <div class="modal fade" id="editDetailsModal-{{ $order->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" style="max-width:520px;">
                <div class="modal-content od-modal">
                    <div class="od-modal-header">
                        <div>
                            <div class="od-order-num"><i class="fa fa-pen-to-square me-2"></i>Edit Order Details</div>
                            <div class="od-order-sub">{{ $invoiceNo }} — {{ $order->customer?->name }}</div>
                        </div>
                        <button class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
                    </div>

                    <form method="POST" action="{{ route('orders.updateDetails', $order->id) }}">
                        @csrf @method('PATCH')
                        <div class="od-modal-body">

                            {{-- Staff Assignment --}}
                            <div class="row g-3 mb-3">
                                <div class="col-12">
                                    <div class="edit-section-label">
                                        <i class="fa fa-users me-1"></i> Staff Assignment
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="p-label">
                                        <i class="fa fa-droplet me-1" style="color:#3b82f6;"></i> Assigned Washer
                                    </label>
                                    <input type="text" name="wash_assigned_to" class="p-input"
                                        value="{{ $order->wash_assigned_to }}" placeholder="Enter name of washer">
                                </div>
                                <div class="col-md-6">
                                    <label class="p-label">
                                        <i class="fa fa-fire me-1" style="color:#f59e0b;"></i> Assigned Ironer
                                    </label>
                                    <input type="text" name="iron_assigned_to" class="p-input"
                                        value="{{ $order->iron_assigned_to }}" placeholder="Enter name of ironer">
                                </div>
                            </div>

                            {{-- Extra Charges --}}
                            <div class="row g-3 mb-3">
                                <div class="col-12">
                                    <div class="edit-section-label">
                                        <i class="fa fa-plus-circle me-1"></i> Extra Charges
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label class="p-label">Amount (₦)</label>
                                    <div class="partial-input-wrap">
                                        <span class="partial-prefix">₦</span>
                                        <input type="number" name="extra_charges" class="p-input" min="0"
                                            value="{{ $order->extra_charges ?? 0 }}" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <label class="p-label">Reason / Note</label>
                                    <input type="text" name="extra_charges_note" class="p-input"
                                        value="{{ $order->extra_charges_note }}"
                                        placeholder="e.g. High starch + special folding">
                                </div>
                                <div class="col-12">
                                    <div class="edit-recalc-note">
                                        <i class="fa fa-circle-info me-1"></i>
                                        Changing extra charges will automatically recalculate the order total.
                                        Current total: <strong>₦{{ number_format($order->total_amount) }}</strong>
                                    </div>
                                </div>
                            </div>

                            {{-- Per-item Staff Observations --}}
                            @if ($order->items->count() > 0)
                                <div class="row g-2">
                                    <div class="col-12">
                                        <div class="edit-section-label">
                                            <i class="fa fa-eye me-1"></i> Staff Observations per Item
                                        </div>
                                    </div>
                                    @foreach ($order->items as $item)
                                        <div class="col-12">
                                            <label class="p-label">{{ $item->item_name }}
                                                <span style="color:#9ca3af;font-weight:400;">
                                                    ({{ ucwords(str_replace('_', ' ', $item->service_type)) }})
                                                </span>
                                            </label>
                                            <textarea name="item_observations[{{ $item->id }}]" class="p-input" rows="2"
                                                placeholder="e.g. Stain on left sleeve, missing button...">{{ $item->observations }}</textarea>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>

                        <div class="od-modal-footer">
                            <button type="button" class="n-btn n-btn-secondary"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="n-btn n-btn-primary">
                                <i class="fa fa-check me-1"></i> Save Changes
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif

    {{-- ── Hidden Invoice Print Template ───────────────────────── --}}
    <div id="invoice-print-{{ $order->id }}" style="display:none;">
        <div class="inv-doc">
            <div class="inv-header">
                <div class="inv-brand">
                    <div class="inv-brand-icon">🧺</div>
                    <div>
                        <div class="inv-brand-name">LaundryPro</div>
                        <div class="inv-brand-tag">Professional Laundry Services</div>
                    </div>
                </div>
                <div class="inv-meta">
                    <div class="inv-number">{{ $invoiceNo }}</div>
                    <div class="inv-date">{{ $order->created_at->format('D, M d Y · h:i A') }}</div>
                    <span class="inv-status-badge inv-status-{{ $payStatus }}">{{ ucfirst($payStatus) }}</span>
                </div>
            </div>
            <div class="inv-divider"></div>
            <div class="inv-info-row">
                <div class="inv-info-col">
                    <div class="inv-section-label">Bill To</div>
                    <div class="inv-info-name">{{ $order->customer?->name ?? '—' }}</div>
                    <div class="inv-info-detail">{{ $order->customer?->phone ?? '' }}</div>
                </div>
                <div class="inv-info-col">
                    <div class="inv-section-label">Pickup & Delivery</div>
                    <div class="inv-info-detail"><strong>From:</strong> {{ $order->pickup_address }}</div>
                    <div class="inv-info-detail"><strong>To:</strong> {{ $order->delivery_address }}</div>
                    <div class="inv-info-detail"><strong>Pickup:</strong> {{ $order->pickup_date }}</div>
                    <div class="inv-info-detail"><strong>Delivery:</strong> {{ $order->delivery_date }}</div>
                </div>
                <div class="inv-info-col">
                    <div class="inv-section-label">Order Info</div>
                    <div class="inv-info-detail"><strong>Order #:</strong> {{ $order->id }}</div>
                    <div class="inv-info-detail"><strong>Status:</strong> {{ ucfirst($order->status) }}</div>
                    <div class="inv-info-detail"><strong>Created By:</strong> {{ $createdByUser?->name ?? '—' }}
                        @if ($createdByUser)
                            ({{ ucfirst($createdByUser->role) }})
                        @endif
                    </div>
                </div>
            </div>
            <div class="inv-divider"></div>
            <div class="inv-section-label mb-2">Items</div>
            <table class="inv-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Service</th>
                        <th>Unit Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ ucwords(str_replace('_', ' ', $item->service_type)) }}</td>
                            <td>₦{{ number_format($item->price) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₦{{ number_format($item->price * $item->quantity) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="inv-totals">
                <div class="inv-totals-row"><span>Subtotal</span><span>₦{{ number_format($subtotal) }}</span></div>
                <div class="inv-totals-row"><span>Service
                        Fee</span><span>₦{{ number_format($order->service_fee) }}</span></div>
                <div class="inv-totals-divider"></div>
                <div class="inv-totals-row grand">
                    <span>Total</span><span>₦{{ number_format($order->total_amount) }}</span>
                </div>
                <div class="inv-totals-row paid"><span>Amount
                        Paid</span><span>₦{{ number_format($order->amount_paid) }}</span></div>
                <div class="inv-totals-row {{ $balance > 0 ? 'balance-due' : 'balance-clear' }}">
                    <span>Balance Due</span><span>₦{{ number_format($balance) }}</span>
                </div>
            </div>
            <div class="inv-divider"></div>
            <div class="inv-footer">
                <p>Thank you for choosing LaundryPro. For inquiries, please reference
                    <strong>{{ $invoiceNo }}</strong>.
                </p>
                <p class="inv-footer-small">Printed on {{ now()->format('M d, Y · h:i A') }}</p>
            </div>
        </div>
    </div>

@endforeach
{{-- ═══ END SINGLE LOOP ═══ --}}

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

    .od-order-id-sub {
        font-size: .75rem;
        font-weight: 400;
        color: #9ca3af;
        margin-left: .35rem;
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

    .inv-number-modal {
        font-weight: 700;
        color: #4f46e5;
        font-size: .85rem;
        font-family: monospace;
        background: #eef2ff;
        padding: .2em .6em;
        border-radius: 5px;
        letter-spacing: .03em;
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

    /* ── Care detail collapsible rows ───────────────────────── */
    .care-toggle {
        background: #f0f4ff;
        color: #4f46e5;
        border: none;
    }

    .care-toggle:hover {
        background: #e0e7ff;
    }

    .care-chevron {
        transition: transform .2s ease;
    }

    .care-chevron.open {
        transform: rotate(90deg);
    }

    .care-detail-panel {
        background: #f8f7ff;
        border-top: 1px solid #e0e7ff;
        border-bottom: 1px solid #e0e7ff;
        padding: .7rem 1rem;
    }

    .care-detail-grid {
        display: flex;
        flex-wrap: wrap;
        gap: .4rem;
        margin-bottom: .5rem;
    }

    .care-chip {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        background: #eef2ff;
        border: 1px solid #c7d2fe;
        border-radius: 6px;
        padding: .25em .6em;
        font-size: .72rem;
    }

    .care-chip-label {
        color: #6b7280;
        font-weight: 500;
    }

    .care-chip-val {
        color: #4f46e5;
        font-weight: 700;
    }

    .care-chip-cost {
        background: #fff7ed;
        border-color: #fed7aa;
    }

    .care-chip-cost .care-chip-val {
        color: #c2410c;
    }

    .care-note {
        font-size: .75rem;
        color: #6b7280;
        margin-top: .35rem;
        line-height: 1.5;
    }

    .care-note-label {
        font-weight: 600;
        color: #374151;
        margin-right: .3rem;
    }

    /* ── Edit Details Modal ──────────────────────────────────── */
    .edit-section-label {
        font-size: .72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #9ca3af;
        padding-bottom: .4rem;
        border-bottom: 1px solid #f0f0f8;
    }

    .edit-recalc-note {
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 8px;
        padding: .45rem .7rem;
        font-size: .75rem;
        color: #92400e;
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

<script>
    function printInvoice(orderId) {
        const content = document.getElementById('invoice-print-' + orderId);
        if (!content) return;

        const openModal = document.querySelector('.modal.show');
        if (openModal) {
            const bsModal = bootstrap.Modal.getInstance(openModal);
            if (bsModal) {
                openModal.addEventListener('hidden.bs.modal', function handler() {
                    openModal.removeEventListener('hidden.bs.modal', handler);
                    document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
                    document.body.classList.remove('modal-open');
                    document.body.style.removeProperty('overflow');
                    document.body.style.removeProperty('padding-right');
                    openPrintWindow(content);
                });
                bsModal.hide();
                return;
            }
        }
        openPrintWindow(content);
    }

    function openPrintWindow(content) {
        const win = window.open('', '_blank', 'width=800,height=500');
        if (!win) {
            alert('Pop-up blocked. Please allow pop-ups for this site to print invoices.');
            return;
        }
        win.document.write(
            `<!DOCTYPE html><html><head><title>Invoice</title><meta charset="UTF-8"><style>
            * { margin:0; padding:0; box-sizing:border-box; }
            body { font-family:'Segoe UI',Arial,sans-serif; font-size:13px; color:#111827; background:#fff; padding:40px; }
            .inv-doc { max-width:740px; margin:0 auto; }
            .inv-header { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:24px; }
            .inv-brand { display:flex; align-items:center; gap:12px; }
            .inv-brand-icon { font-size:2rem; }
            .inv-brand-name { font-size:1.4rem; font-weight:700; color:#4f46e5; }
            .inv-brand-tag  { font-size:.75rem; color:#9ca3af; margin-top:2px; }
            .inv-meta { text-align:right; }
            .inv-number { font-size:1.1rem; font-weight:700; color:#111827; font-family:monospace; }
            .inv-date   { font-size:.78rem; color:#6b7280; margin-top:4px; }
            .inv-status-badge { display:inline-block; margin-top:6px; font-size:.72rem; font-weight:700; padding:.2em .7em; border-radius:5px; }
            .inv-status-paid    { background:#ecfdf5; color:#065f46; }
            .inv-status-partial { background:#fff7ed; color:#c2410c; border:1px solid #fed7aa; }
            .inv-status-pending { background:#fffbeb; color:#92400e; }
            .inv-divider { height:1px; background:#e5e7eb; margin:20px 0; }
            .inv-info-row { display:flex; gap:24px; margin-bottom:8px; }
            .inv-info-col { flex:1; }
            .inv-section-label { font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:#9ca3af; margin-bottom:6px; }
            .inv-info-name   { font-size:.95rem; font-weight:700; color:#111827; margin-bottom:4px; }
            .inv-info-detail { font-size:.8rem; color:#6b7280; margin-bottom:3px; }
            .mb-2 { margin-bottom:8px; }
            .inv-table { width:100%; border-collapse:collapse; margin-bottom:16px; }
            .inv-table thead tr { background:#f5f5fb; }
            .inv-table th { font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.06em; color:#9ca3af; padding:8px 10px; text-align:left; border-bottom:2px solid #e5e7eb; }
            .inv-table td { padding:9px 10px; font-size:.82rem; color:#374151; border-bottom:1px solid #f0f0f8; }
            .inv-table tbody tr:last-child td { border-bottom:none; }
            .inv-totals { margin-left:auto; width:280px; margin-top:8px; }
            .inv-totals-row { display:flex; justify-content:space-between; padding:5px 0; font-size:.83rem; color:#6b7280; }
            .inv-totals-row.grand { font-size:.95rem; font-weight:700; color:#111827; padding:8px 0; }
            .inv-totals-row.paid  { color:#059669; font-weight:600; }
            .inv-totals-row.balance-due   { color:#dc2626; font-weight:700; }
            .inv-totals-row.balance-clear { color:#059669; font-weight:700; }
            .inv-totals-divider { height:1px; background:#e5e7eb; margin:6px 0; }
            .inv-footer { text-align:center; margin-top:24px; }
            .inv-footer p { font-size:.8rem; color:#6b7280; margin-bottom:4px; }
            .inv-footer-small { font-size:.72rem; color:#9ca3af; }
            @media print { body { padding:20px; } @page { margin:1cm; } }
        </style></head><body>${content.innerHTML}<script>window.onload=function(){window.print();}<\/script></body></html>`
        );
        win.document.close();
    }

    // ── Care detail row toggles ──────────────────────────────
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.care-toggle');
        if (!btn) return;

        const targetId = btn.dataset.target;
        const row = document.getElementById(targetId);
        const chevron = btn.querySelector('.care-chevron');
        if (!row) return;

        const isOpen = row.style.display !== 'none';
        row.style.display = isOpen ? 'none' : 'table-row';
        chevron?.classList.toggle('open', !isOpen);
    });
</script>
