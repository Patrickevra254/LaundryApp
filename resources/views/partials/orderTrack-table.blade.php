
{{-- <div class="table-responsive">
    <table class="table table-hover align-middle mb-0 mobile-friendly">
        <thead class="table-light">
            <tr>
                <th>Invoice #</th>
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
                    <td data-label="Invoice #">
                        <span class="inv-number">INV-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
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
                            @if (auth()->user()->hasAnyRole(['superAdmin']))
                                <form method="POST" action="{{ route('orders.destroy', $order->id) }}"
                                    onsubmit="return confirm('Delete Order INV-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}? This cannot be undone.')">
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
    .inv-number {
        font-weight: 700;
        color: #4f46e5;
        font-size: .82rem;
        font-family: monospace;
        background: #eef2ff;
        padding: .2em .55em;
        border-radius: 5px;
        letter-spacing: .03em;
    }

    .pay-badge {
        font-size: .72rem;
        font-weight: 700;
        padding: .28em .65em;
        border-radius: 6px;
    }

    .pay-badge-paid    { background: #ecfdf5; color: #065f46; }
    .pay-badge-partial { background: #fff7ed; color: #c2410c; border: 1px solid #fed7aa; }
    .pay-badge-pending { background: #fffbeb; color: #92400e; }

    .n-icon-btn {
        width: 28px; height: 28px; border-radius: 7px; border: none;
        background: #f3f4f6; display: inline-flex; align-items: center;
        justify-content: center; font-size: .75rem; cursor: pointer;
        transition: background .15s;
    }
    .n-icon-btn:hover         { background: #eef2ff; }
    .n-icon-btn.danger:hover  { background: #fee2e2; }

    /* Mobile stacking */
    @media (max-width: 768px) {
        .mobile-friendly thead { display: none; }
        .mobile-friendly tr {
            display: block; border: 1px solid #f0f0f8;
            border-radius: 12px; margin-bottom: .75rem;
            padding: .5rem .75rem; background: #fff;
        }
        .mobile-friendly td {
            display: flex; justify-content: space-between;
            align-items: center; padding: .4rem 0;
            border: none; border-bottom: 1px solid #f5f5fb; font-size: .83rem;
        }
        .mobile-friendly td:last-child { border-bottom: none; }
        .mobile-friendly td::before {
            content: attr(data-label);
            font-size: .72rem; font-weight: 600; color: #9ca3af;
            text-transform: uppercase; letter-spacing: .04em;
            flex-shrink: 0; margin-right: .75rem;
        }
    }
</style> --}}


{{-- <div class="table-responsive">
    <table class="table table-hover align-middle mb-0 mobile-friendly">
        <thead class="table-light">
            <tr>
                <th>Invoice #</th>
                <th>Customer</th>
                <th>Branch</th>
                <th>Items</th>
                <th>Total</th>

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
                    <td data-label="Invoice #">
                        <span class="inv-number">INV-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td data-label="Customer">{{ $order->customer?->name ?? '—' }}</td>
                    <td data-label="Branch">
                        @if ($order->branch)
                            <span class="inv-branch-pill">
                                <i class="fa fa-building me-1"></i>{{ $order->branch->name }}
                            </span>
                        @else
                            <span style="color:#9ca3af;font-size:.8rem;">—</span>
                        @endif
                    </td>
                    <td data-label="Items">{{ $order->items->sum('quantity') }} item(s)</td>
                    <td data-label="Total">₦{{ number_format($order->total_amount) }}</td>

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
                            @if (auth()->user()->hasAnyRole(['superAdmin']))
                                <form method="POST" action="{{ route('orders.destroy', $order->id) }}"
                                    onsubmit="return confirm('Delete Order INV-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}? This cannot be undone.')">
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
                    <td colspan="10" class="text-center py-4" style="color:#9ca3af;font-size:.85rem;">
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
    .inv-number {
        font-weight: 700;
        color: #4f46e5;
        font-size: .82rem;
        font-family: monospace;
        background: #eef2ff;
        padding: .2em .55em;
        border-radius: 5px;
        letter-spacing: .03em;
    }

    .inv-branch-pill {
        display: inline-flex;
        align-items: center;
        background: #f0fdf4;
        color: #166534;
        font-size: .72rem;
        font-weight: 600;
        padding: .2em .55em;
        border-radius: 5px;
        border: 1px solid #bbf7d0;
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
</style> --}}


<div class="table-responsive">
    <table class="table table-hover align-middle mb-0 mobile-friendly">
        <thead class="table-light">
            <tr>
                <th>Invoice #</th>
                <th>Customer</th>
                <th>Branch</th>
                <th>Items</th>
                <th>Total</th>
                {{-- <th>Pickup</th> --}}
                {{-- <th>Delivery</th> --}}
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
                    <td data-label="Invoice #">
                        <span class="inv-number">INV-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td data-label="Customer">{{ $order->customer?->name ?? '—' }}</td>
                    <td data-label="Branch">
                        @if($order->branch)
                            <span class="inv-branch-pill">
                                <i class="fa fa-building me-1"></i>{{ $order->branch->name }}
                            </span>
                        @else
                            <span style="color:#9ca3af;font-size:.8rem;">—</span>
                        @endif
                    </td>
                    <td data-label="Items">{{ $order->items->sum('quantity') }} item(s)</td>
                    <td data-label="Total">₦{{ number_format($order->total_amount) }}</td>
                    {{-- <td data-label="Pickup" style="font-size:.8rem;color:#6b7280;">{{ $order->pickup_date }}</td> --}}
                    {{-- <td data-label="Delivery" style="font-size:.8rem;color:#6b7280;">{{ $order->delivery_date }}</td> --}}
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
                            @if (auth()->user()->hasAnyRole(['superAdmin']))
                                <form method="POST" action="{{ route('orders.destroy', $order->id) }}"
                                    class="swal-delete-form"
                                    data-name="INV-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}"
                                    data-type="Order">
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
                    <td colspan="10" class="text-center py-4" style="color:#9ca3af;font-size:.85rem;">
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
    .inv-number {
        font-weight: 700;
        color: #4f46e5;
        font-size: .82rem;
        font-family: monospace;
        background: #eef2ff;
        padding: .2em .55em;
        border-radius: 5px;
        letter-spacing: .03em;
    }

    .inv-branch-pill {
        display: inline-flex;
        align-items: center;
        background: #f0fdf4;
        color: #166534;
        font-size: .72rem;
        font-weight: 600;
        padding: .2em .55em;
        border-radius: 5px;
        border: 1px solid #bbf7d0;
    }

    .pay-badge {
        font-size: .72rem;
        font-weight: 700;
        padding: .28em .65em;
        border-radius: 6px;
    }

    .pay-badge-paid    { background: #ecfdf5; color: #065f46; }
    .pay-badge-partial { background: #fff7ed; color: #c2410c; border: 1px solid #fed7aa; }
    .pay-badge-pending { background: #fffbeb; color: #92400e; }

    .n-icon-btn {
        width: 28px; height: 28px; border-radius: 7px; border: none;
        background: #f3f4f6; display: inline-flex; align-items: center;
        justify-content: center; font-size: .75rem; cursor: pointer;
        transition: background .15s;
    }
    .n-icon-btn:hover         { background: #eef2ff; }
    .n-icon-btn.danger:hover  { background: #fee2e2; }

    /* Mobile stacking */
    @media (max-width: 768px) {
        .mobile-friendly thead { display: none; }
        .mobile-friendly tr {
            display: block; border: 1px solid #f0f0f8;
            border-radius: 12px; margin-bottom: .75rem;
            padding: .5rem .75rem; background: #fff;
        }
        .mobile-friendly td {
            display: flex; justify-content: space-between;
            align-items: center; padding: .4rem 0;
            border: none; border-bottom: 1px solid #f5f5fb; font-size: .83rem;
        }
        .mobile-friendly td:last-child { border-bottom: none; }
        .mobile-friendly td::before {
            content: attr(data-label);
            font-size: .72rem; font-weight: 600; color: #9ca3af;
            text-transform: uppercase; letter-spacing: .04em;
            flex-shrink: 0; margin-right: .75rem;
        }
    }
</style>

<script>
    document.addEventListener('submit', function(e) {
        const form = e.target.closest('.swal-delete-form');
        if (!form) return;
        e.preventDefault();
        const name = form.dataset.name || 'this order';
        const type = form.dataset.type || 'Order';
        Swal.fire({
            icon: 'warning',
            title: `Delete ${type}?`,
            html: `Are you sure you want to delete <strong>${name}</strong>?<br><span style="font-size:.82rem;color:#9ca3af;">This cannot be undone.</span>`,
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#f3f4f6',
            confirmButtonText: '<i class="fa fa-trash me-1"></i> Yes, delete',
            cancelButtonText: 'Cancel',
        }).then(result => {
            if (result.isConfirmed) form.submit();
        });
    });
</script>
