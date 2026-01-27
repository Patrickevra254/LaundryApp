<div class="container-fluid mt-3 customer-payments">

    <!-- Header -->
    <div class="text-center mb-4">
        <h3 class="fw-bold">My Payments</h3>
        <p class="text-muted">Track all your laundry payments and their status</p>
    </div>

    <!-- Payments List -->
    <div class="row g-4">
        @forelse($payments as $payment)
            <div class="col-md-6 col-lg-4">
                <div class="payment-card h-100">

                    <!-- Top: Payment ID + Status -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold">Payment #{{ $payment->id }}</span>
                        <span class="status-pill status-{{ Str::slug($payment->status) }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </div>

                    <!-- Date & Amount -->
                    <div class="small text-muted mb-2">
                        <div>
                            <i class="fa fa-calendar me-1"></i>
                            {{ $payment->created_at->format('M d, Y') }}
                        </div>
                        <div>
                            <i class="fa fa-money-bill me-1"></i>
                            ₦{{ number_format($payment->amount) }}
                        </div>
                    </div>

                    <!-- Related Order -->
                    @if ($payment->order)
                        <div class="mb-3 fw-semibold">
                            Order #: {{ $payment->order->id }}
                        </div>
                    @endif

                    <!-- Action -->
                    <button class="btn btn-outline-primary btn-sm w-100" data-bs-toggle="modal"
                        data-bs-target="#paymentModal-{{ $payment->id }}">
                        View Details
                    </button>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                You have no payments yet.
            </div>
        @endforelse
    </div>

</div>

{{-- Payment Details Modals --}}
@foreach ($payments as $payment)
    <div class="modal fade" id="paymentModal-{{ $payment->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content customer-modal">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Payment #{{ $payment->id }}</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-2">
                        <strong>Status:</strong>
                        <span class="status-pill status-{{ Str::slug($payment->status) }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </div>
                    <div class="mb-2">
                        <strong>Date:</strong> {{ $payment->created_at->format('M d, Y H:i') }}
                    </div>
                    <div class="mb-2">
                        <strong>Amount Paid:</strong> ₦{{ number_format($payment->amount) }}
                    </div>
                    @if ($payment->order)
                        <div class="mb-2">
                            <strong>Order #:</strong> {{ $payment->order->id }}
                        </div>
                    @endif
                    @if ($payment->method)
                        <div class="mb-2">
                            <strong>Payment Method:</strong> {{ ucfirst($payment->method) }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endforeach

<style>
    .customer-payments {
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    .payment-card {
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(12px);
        border-radius: 18px;
        padding: 1.4rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        transition: all 0.25s ease;
    }

    .payment-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.16);
    }

    .status-pill {
        border-radius: 999px;
        padding: 0.4em 0.75em;
        font-size: 0.7rem;
        font-weight: 600;
    }

    /* Status Colors */
    .status-pending {
        background: rgba(255, 193, 7, 0.18);
        color: #856404;
    }

    .status-success {
        background: rgba(25, 135, 84, 0.18);
        color: #0f5132;
    }

    .status-failed {
        background: rgba(220, 53, 69, 0.18);
        color: #842029;
    }

    .status-completed {
        background: rgba(13, 110, 253, 0.18);
        color: #084298;
    }

    .customer-modal .modal-content {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 18px;
        border: none;
    }

    .customer-modal .modal-header,
    .customer-modal .modal-footer {
        border: none;
    }
</style>
