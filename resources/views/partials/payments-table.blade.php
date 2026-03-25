  <!-- PAYMENTS TABLE -->
  {{-- <div class="card shadow-sm rounded-3">
      <div class="card-header bg-white py-3 d-flex justify-content-between flex-wrap align-items-center gap-3">
          <h5 class="mb-0 fw-bold">Recent Payments</h5>

          <div class="input-group" style="max-width: 260px;">
              <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
              <input type="text" class="form-control rounded" placeholder="Search payments...">
          </div>
      </div>

      <div class="table-responsive">
          <table class="table table-hover align-middle mobile-friendly mb-0">
              <thead class="table-light">
                  <tr>
                      <th>#Ref</th>
                      <th>User</th>
                      <th>Amount</th>
                      <th>Method</th>
                      <th>Date</th>
                      <th>Status</th>

                      <th></th>
                  </tr>
              </thead>

              <tbody>
                  @forelse ($payments as $payment)
                      <tr>
                          <td>#{{ $payment->reference }}</td>
                          <td>{{ $payment->order->customer->name }}</td>
                          <td>{{ $payment->amount }}</td>
                          <td>{{ $payment->method }}</td>
                          <td>{{ $payment->created_at->format('M d, Y g:i A') }}</td>
                          <td>
                              <span
                                  class="badge
                                    {{ strtolower($payment->status) == 'pending'
                                        ? 'bg-warning text-dark'
                                        : ($payment->status == 'success'
                                            ? 'bg-success'
                                            : ($payment->status == 'failed'
                                                ? 'bg-danger'
                                                : '')) }}">
                                  {{ $payment->status }}
                              </span>




                          </td>
                          <td>
                              <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                  data-bs-target="#orderDetailsModal-{{ $payment->id }}">
                                  <i class="fa fa-eye"></i>
                              </button>

                              <form action="" method="POST" class="d-inline">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-sm btn-outline-danger">
                                      <i class="fa fa-trash"></i>
                                  </button>
                              </form>
                          </td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="8" class="text-center py-4 text-muted">
                              No payment with this parameter
                          </td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
  </div>

  <!-- Pagination -->
  <div class="d-flex mt-5 justify-content-center">
      {{ $payments->links('pagination::bootstrap-5') }}
  </div> --}}

 <div class="table-responsive">
    <table class="table table-hover align-middle mb-0 mobile-friendly">
        <thead class="table-light">
            <tr>
                <th>#Ref</th>
                <th>Customer</th>
                <th>Paid</th>
                <th>Order Total</th>
                <th>Balance Due</th>
                <th>Method</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                @php
                    $order = $payment->order;
                    $balance = $order ? max(0, $order->total_amount - $order->amount_paid) : 0;
                    $payStatus = $order?->payment_status ?? 'unknown';
                    $badgeClass = match ($payStatus) {
                        'paid'    => 'bg-success',
                        'partial' => 'bg-warning',
                        'pending' => 'bg-warning',
                        default   => 'bg-primary',
                    };
                @endphp
                <tr>
                    <td data-label="#Ref">
                        <span style="font-size:.78rem;font-weight:600;color:#374151;">#{{ $payment->reference }}</span>
                    </td>
                    <td data-label="Customer">{{ $order?->customer?->name ?? '—' }}</td>
                    <td data-label="Paid" class="fw-bold text-success">₦{{ number_format($payment->amount) }}</td>
                    <td data-label="Order Total">₦{{ $order ? number_format($order->total_amount) : '—' }}</td>
                    <td data-label="Balance Due">
                        @if ($balance > 0)
                            <span style="color:#dc2626;font-weight:600;">₦{{ number_format($balance) }}</span>
                        @else
                            <span style="color:#059669;font-weight:600;">—</span>
                        @endif
                    </td>
                    <td data-label="Method">
                        <span class="method-tag method-{{ strtolower($payment->method) }}">
                            {{ ucfirst($payment->method) }}
                        </span>
                    </td>
                    <td data-label="Status">
                        <span class="badge {{ $badgeClass }}">{{ ucfirst($payStatus) }}</span>
                        @if ($payStatus === 'partial')
                            <span class="incomplete-tag ms-1">Incomplete</span>
                        @endif
                    </td>
                    <td data-label="Actions">
                        <div style="display:flex;gap:.4rem;flex-wrap:wrap;">
                            <button class="n-icon-btn" data-bs-toggle="modal"
                                data-bs-target="#paymentModal-{{ $payment->id }}" title="View Details">
                                <i class="fa fa-eye" style="color:#4f46e5;"></i>
                            </button>
                            @if (auth()->user()->hasAnyRole(['superAdmin']))
                                <form method="POST" action="{{ route('payments.destroy', $order->id) }}"
                                    class="swal-delete-form"
                                    data-name="INV-{{ str_pad($order?->id, 4, '0', STR_PAD_LEFT) }}"
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
                    <td colspan="8" class="text-center py-4" style="color:#9ca3af;font-size:.85rem;">
                        No payments found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center py-3">
    {{ $payments->links('pagination::bootstrap-5') }}
</div>

<style>
    .method-tag { font-size:.72rem; font-weight:600; padding:.25em .6em; border-radius:6px; }
    .method-tag.method-cash     { background:#ecfdf5; color:#065f46; }
    .method-tag.method-bank     { background:#eff6ff; color:#1d4ed8; }
    .method-tag.method-paystack { background:#eef2ff; color:#4f46e5; }
    .incomplete-tag { font-size:.68rem; font-weight:700; background:#fff7ed; color:#c2410c; border:1px solid #fed7aa; border-radius:5px; padding:.15em .5em; }
    .n-icon-btn { width:28px; height:28px; border-radius:7px; border:none; background:#f3f4f6; display:inline-flex; align-items:center; justify-content:center; font-size:.75rem; cursor:pointer; transition:background .15s; }
    .n-icon-btn:hover       { background:#eef2ff; }
    .n-icon-btn.danger:hover { background:#fee2e2; }

    @media (max-width: 768px) {
        .mobile-friendly thead { display:none; }
        .mobile-friendly tr { display:block; border:1px solid #f0f0f8; border-radius:12px; margin-bottom:.75rem; padding:.5rem .75rem; background:#fff; }
        .mobile-friendly td { display:flex; justify-content:space-between; align-items:center; padding:.4rem 0; border:none; border-bottom:1px solid #f5f5fb; font-size:.83rem; }
        .mobile-friendly td:last-child { border-bottom:none; }
        .mobile-friendly td::before { content:attr(data-label); font-size:.72rem; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:.04em; flex-shrink:0; margin-right:.75rem; }
    }
</style>

<script>
    document.addEventListener('submit', function(e) {
        const form = e.target.closest('.swal-delete-form');
        if (!form) return;
        e.preventDefault();
        const name = form.dataset.name || 'this order';
        Swal.fire({
            icon: 'warning',
            title: 'Delete Order?',
            html: `Are you sure you want to delete <strong>${name}</strong>?<br><span style="font-size:.82rem;color:#9ca3af;">This will delete the order and all its payments. This cannot be undone.</span>`,
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
