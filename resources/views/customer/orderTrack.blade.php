<div class="customer-track-page">

    <!-- Header -->
    <div class="text-center mb-5">
        <h3 class="fw-bold">Track Your Laundry</h3>
        <p class="text-muted">
            Follow the progress of your laundry orders in real time
        </p>
    </div>

    <!-- Orders -->
    <div class="row g-4">
        @forelse($orders as $order)
            <div class="col-md-6 col-lg-4">
                <div class="order-card h-100">

                    <!-- Order Header -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold">
                            Order #{{ $order->id }}
                        </span>

                        <span class="status-pill status-{{ Str::slug($order->status) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <!-- Order Info -->
                    <div class="small text-muted mb-3">
                        <div>
                            <i class="fa fa-calendar me-1"></i>
                            {{ $order->created_at->format('M d, Y') }}
                        </div>
                        <div>
                            <i class="fa fa-map-marker-alt me-1"></i>
                            Pickup scheduled
                        </div>
                    </div>

                    <!-- Progress -->
                    <div class="order-progress mb-4">
                        @php
                            $steps = ['pending', 'in progress', 'completed', 'delivered'];
                            $currentStep = array_search(strtolower($order->status), $steps);
                        @endphp

                        @foreach ($steps as $index => $step)
                            <div class="progress-step {{ $index <= $currentStep ? 'active' : '' }}">
                                <span></span>
                                <small>{{ ucfirst($step) }}</small>
                            </div>
                        @endforeach
                    </div>

                    <!-- Action -->
                    <button class="btn btn-outline-primary btn-sm w-100" data-bs-toggle="modal"
                        data-bs-target="#customerOrderModal-{{ $order->id }}">
                        View Details
                    </button>

                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                You have no orders yet.
            </div>
        @endforelse
    </div>

</div>

{{-- Order Details Modal --}}
@foreach ($orders as $order)
    <div class="modal fade" id="customerOrderModal-{{ $order->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content customer-modal">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">
                        Order #{{ $order->id }}
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
                        <strong>Pickup Address</strong>
                        <p class="mb-0 text-muted">{{ $order->pickup_address }}</p>
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

                    <div class="fw-semibold">
                        Total: ₦{{ number_format($order->total_amount) }}
                    </div>

                </div>

            </div>
        </div>
    </div>
@endforeach

<style>
    .customer-track-page {
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    .order-card {
        background: #ffffff;
        border-radius: 22px;
        padding: 1.4rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.25s ease;
    }

    .order-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.14);
    }

    .status-pill {
        font-size: 0.7rem;
        font-weight: 600;
        padding: 0.35rem 0.7rem;
        border-radius: 999px;
    }

    .status-pending {
        background: rgba(255, 193, 7, .18);
        color: #856404;
    }

    .status-in-progress {
        background: rgba(13, 202, 240, .18);
        color: #055160;
    }

    .status-completed {
        background: rgba(25, 135, 84, .18);
        color: #0f5132;
    }

    .status-delivered {
        background: rgba(79, 70, 229, .18);
        color: #312e81;
    }

    /* Progress */
    .order-progress {
        display: flex;
        justify-content: space-between;
        gap: .4rem;
    }

    .progress-step {
        text-align: center;
        flex: 1;
    }

    .progress-step span {
        display: block;
        height: 6px;
        border-radius: 4px;
        background: #e9ecef;
        margin-bottom: .3rem;
    }

    .progress-step.active span {
        background: linear-gradient(135deg, #4f46e5, #0d6efd);
    }

    .progress-step small {
        font-size: .65rem;
        color: #6c757d;
    }

    .customer-modal {
        border-radius: 20px;
        border: none;
    }
</style>
