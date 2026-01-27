<!-- Customers Table -->
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0 mobile-friendly">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                        @if ($user->role === 'customer')
                            <tr>
                                <td data-label="#">{{ $user->id }}</td>

                                <td data-label="Customer">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-primary text-white rounded-circle me-2">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $user->name }}</div>
                                            <small class="text-muted">Customer</small>
                                        </div>
                                    </div>
                                </td>

                                <td data-label="Email">{{ $user->email }}</td>

                                <td data-label="Status">
                                    @if ($user->active)
                                        <span class="badge bg-success-subtle text-success">● Active</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary">● Inactive</span>
                                    @endif
                                </td>

                                <td data-label="Actions" class="text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>

                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="#" class="dropdown-item view-btn"
                                                    data-id="{{ $user->id }}">
                                                    <i class="fa fa-eye me-2"></i> View
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#" class="dropdown-item edit-btn"
                                                    data-id="{{ $user->id }}">
                                                    <i class="fa fa-edit me-2"></i> Edit
                                                </a>
                                            </li>

                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>

                                            <li>
                                                <form method="POST"
                                                    action="{{ route('customer.destroy', $user->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger"
                                                        onclick="return confirm('Delete this customer?')">
                                                        <i class="fa fa-trash me-2"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No customers found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<!-- Pagination -->
<div class="mt-4 d-flex justify-content-center">
    {{ $users->links('pagination::bootstrap-5') }}
</div>
