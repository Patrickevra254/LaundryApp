<!-- Orders Table -->
{{-- <div class="card shadow-sm rounded-3 mb-3">
    <div class="card-body p-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between flex-wrap align-items-center gap-3">
            <h5 class="mb-0 fw-bold">Recent Orders</h5>

            <div class="input-group" style="max-width: 260px;">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control rounded" placeholder="Search order...">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mobile-friendly" id="ordersTable">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Pickup</th>
                        <th>Delivery</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->items->sum('quantity') }} items</td>
                            <td>
                                ₦{{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity) + $order->service_fee) }}
                            </td>
                            <td>{{ $order->pickup_date }}</td>
                            <td>{{ $order->delivery_date }}</td>
                            <td>
                                <span
                                    class="badge
                                        {{ strtolower($order->status) == 'pending'
                                            ? 'bg-warning text-dark'
                                            : ($order->status == 'In progress'
                                                ? 'bg-info text-dark'
                                                : ($order->status == 'completed'
                                                    ? 'bg-success'
                                                    : ($order->status == 'delivered'
                                                        ? 'bg-primary'
                                                        : ''))) }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#orderDetailsModal-{{ $order->id }}">
                                    <i class="fa fa-eye"></i>
                                </button>

                                @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
                                    <form action="" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                No orders found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center">
    {{ $orders->links('pagination::bootstrap-5') }}
</div> --}}

<div class="table-responsive">
    <table class="table table-hover align-middle mb-0 mobile-friendly">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Items</th>
                <th>Total</th>
                <th>Pickup</th>
                <th>Delivery</th>
                <th>Order Status</th>
                <th>Payment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                @php
                    $balance = max(0, $order->total_amount - $order->amount_paid);
                    $payStatus = $order->payment_status ?? 'pending';
                    $orderBadge = match (strtolower($order->status)) {
                        'pending' => 'bg-warning',
                        'in progress' => 'bg-info',
                        'completed' => 'bg-success',
                        'delivered' => 'bg-primary',
                        default => 'bg-secondary',
                    };
                    $payBadge = match ($payStatus) {
                        'paid' => 'pay-badge-paid',
                        'partial' => 'pay-badge-partial',
                        default => 'pay-badge-pending',
                    };
                @endphp
                <tr>
                    <td data-label="#">
                        <span style="font-weight:600;color:#374151;">#{{ $order->id }}</span>
                    </td>
                    <td data-label="Customer">{{ $order->customer?->name ?? '—' }}</td>
                    <td data-label="Items">{{ $order->items->sum('quantity') }} item(s)</td>
                    <td data-label="Total">₦{{ number_format($order->total_amount) }}</td>
                    <td data-label="Pickup" style="font-size:.8rem;color:#6b7280;">{{ $order->pickup_date }}</td>
                    <td data-label="Delivery" style="font-size:.8rem;color:#6b7280;">{{ $order->delivery_date }}</td>
                    <td data-label="Order Status">
                        <span class="badge {{ $orderBadge }}">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td data-label="Payment">
                        <span class="pay-badge {{ $payBadge }}">{{ ucfirst($payStatus) }}</span>
                        @if ($balance > 0)
                            <div style="font-size:.72rem;color:#dc2626;margin-top:2px;font-weight:600;">
                                ₦{{ number_format($balance) }} due
                            </div>
                        @endif
                    </td>
                    <td data-label="Actions">
                        <div style="display:flex;gap:.4rem;flex-wrap:wrap;">
                            <button class="n-icon-btn" data-bs-toggle="modal"
                                data-bs-target="#orderDetailsModal-{{ $order->id }}" title="View Order">
                                <i class="fa fa-eye" style="color:#4f46e5;"></i>
                            </button>
                            {{-- @if (auth()->user()->hasAnyRole(['admin', 'superAdmin'])) --}}
                            @if (auth()->user()->hasAnyRole(['superAdmin']))
                                <form method="POST" action="{{ route('orders.destroy', $order->id) }}"
                                    onsubmit="return confirm('Delete Order #{{ $order->id }}? This cannot be undone.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="n-icon-btn danger" title="Delete Order">
                                        <i class="fa fa-trash" style="color:#dc2626;"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center py-4" style="color:#9ca3af;font-size:.85rem;">
                        No orders found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center py-3">
    {{ $orders->links('pagination::bootstrap-5') }}
</div>

<style>
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

    .n-icon-btn {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        border: none;
        background: #f3f4f6;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: .75rem;
        cursor: pointer;
        transition: background .15s;
    }

    .n-icon-btn:hover {
        background: #eef2ff;
    }

    .n-icon-btn.danger:hover {
        background: #fee2e2;
    }

    /* Mobile stacking */
    @media (max-width: 768px) {
        .mobile-friendly thead {
            display: none;
        }

        .mobile-friendly tr {
            display: block;
            border: 1px solid #f0f0f8;
            border-radius: 12px;
            margin-bottom: .75rem;
            padding: .5rem .75rem;
            background: #fff;
        }

        .mobile-friendly td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: .4rem 0;
            border: none;
            border-bottom: 1px solid #f5f5fb;
            font-size: .83rem;
        }

        .mobile-friendly td:last-child {
            border-bottom: none;
        }

        .mobile-friendly td::before {
            content: attr(data-label);
            font-size: .72rem;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .04em;
            flex-shrink: 0;
            margin-right: .75rem;
        }
    }
</style>
