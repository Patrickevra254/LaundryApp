   <!-- History Table -->
    <div class="card shadow-sm rounded-3 mb-3">
        <div class="card-body p-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between flex-wrap align-items-center gap-3">
                <h5 class="mb-0 fw-bold">Recent Completed Orders</h5>

                <div class="input-group" style="max-width: 260px;">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control rounded" placeholder="Search orders...">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mobile-friendly" id="historyTable">
                    <thead class="table-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Pickup</th>
                            <th>Delivery</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->items->sum('quantity') }} item(s)</td>
                                <td>
                                    ₦{{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity) + $order->service_fee) }}
                                </td>
                                <td>{{ $order->pickup_date }}</td>
                                <td>{{ $order->delivery_date }}</td>
                                <td>
                                    <span
                                        class="badge {{ $order->status === 'Completed' ? 'bg-success' : 'bg-primary' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    No history records found
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
    </div>
