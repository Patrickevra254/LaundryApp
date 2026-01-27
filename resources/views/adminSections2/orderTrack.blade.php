<div class="container-fluid mt-2">

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
</style>
