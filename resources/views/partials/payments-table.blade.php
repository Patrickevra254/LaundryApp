  <!-- PAYMENTS TABLE -->
  <div class="card shadow-sm rounded-3">
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

                              {{-- <span @class([
                                  'badge',
                                  'bg-warning text-dark' => strtolower($payment->status) === 'pending',
                                  'bg-success' => $payment->status === 'success',
                                  'bg-danger' => $payment->status === 'failed',
                              ])>
                                  {{ $payment->status }}
                              </span> --}}


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
  </div>
