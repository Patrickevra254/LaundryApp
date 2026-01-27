<div class="customer-history-page">

    <!-- Header -->
    <div class="text-center mb-5">
        <h3 class="fw-bold">Order History</h3>
        <p class="text-muted">
            View your completed and delivered laundry orders
        </p>
    </div>

    <!-- History List -->
    <div class="row g-4">
        @forelse($orders as $order)
            <div class="col-md-6 col-lg-4">
                <div class="history-card h-100">

                    <!-- Top -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold">
                            Order #{{ $order->id }}
                        </span>

                        <span class="status-pill status-{{ Str::slug($order->status) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <!-- Meta -->
                    <div class="small text-muted mb-3">
                        <div>
                            <i class="fa fa-calendar-check me-1"></i>
                            {{ $order->updated_at->format('M d, Y') }}
                        </div>
                        <div>
                            <i class="fa fa-box me-1"></i>
                            {{ $order->items->sum('quantity') }} items
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="fw-semibold mb-3">
                        Total Paid: ₦{{ number_format($order->total_amount) }}
                    </div>

                    <!-- Action -->
                    <button class="btn btn-outline-primary btn-sm w-100" data-bs-toggle="modal"
                        data-bs-target="#historyOrderModal-{{ $order->id }}">
                        View Receipt
                    </button>

                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                You have no completed orders yet.
            </div>
        @endforelse
    </div>

</div>

{{-- Order Receipt Modal --}}
@foreach ($orders as $order)
    <div class="modal fade" id="historyOrderModal-{{ $order->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content customer-modal">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">
                        Order #{{ $order->id }} Receipt
                    </h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <strong>Status:</strong>
                        <span class="status-pill status-{{ Str::slug($order->status) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <strong>Delivered On</strong>
                        <p class="mb-0 text-muted">
                            {{ $order->updated_at->format('M d, Y') }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <strong>Items</strong>
                        <ul class="list-unstyled small text-muted mb-0">
                            @foreach ($order->items as $item)
                                <li>
                                    {{ $item->item_name }} × {{ $item->quantity }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fw-semibold">
                        <span>Total Paid</span>
                        <span>₦{{ number_format($order->total_amount) }}</span>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endforeach

<style>
    .customer-history-page {
    font-family: 'Inter', 'Segoe UI', sans-serif;
}

.history-card {
    background: #ffffff;
    border-radius: 22px;
    padding: 1.4rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: all 0.25s ease;
}

.history-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(0,0,0,0.14);
}

/* Reuse status pills from tracking page */

.status-pill {
        font-size: 0.7rem;
        font-weight: 600;
        padding: 0.35rem 0.7rem;
        border-radius: 999px;
    }
</style>
