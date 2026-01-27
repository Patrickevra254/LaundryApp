<div class="container-fluid customers-page mt-2">

    <!-- Page Header -->
    <div class="page-header mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h4 class="fw-bold mb-1">Customers</h4>
            <small class="text-muted">Manage all registered customers</small>
        </div>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
            <i class="fa fa-user-plus me-1"></i> Add Customer
        </button>
    </div>

    <!-- Filters -->
    <form hx-get="{{ route('customer') }}" hx-target="#customer-table" hx-push-url="true"
        hx-trigger="keyup changed delay:400ms" class="d-flex gap-2 mb-3">

        <input type="text" name="search" class="form-control" placeholder="Search by name, email or phone"
            value="{{ request('search') }}">

        <a href="{{ route('customer') }}" class="btn btn-outline-secondary" hx-get="{{ route('customer') }}"
            hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
            Clear
        </a>
    </form>

    <!-- Customer Table -->
    <div class="glass-card">
        <div id="customer-table" class="table-responsive">
            @include('partials.customer-table')
        </div>
    </div>

    {{-- ================= VIEW CUSTOMER MODAL ================= --}}
    <div class="modal fade" id="viewCustomerModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content glass-modal">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold"><i class="fa fa-user me-2 text-primary"></i> Customer Details</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Name:</strong> <span id="view-name"></span></li>
                        <li class="list-group-item"><strong>Email:</strong> <span id="view-email"></span></li>
                        <li class="list-group-item"><strong>Phone:</strong> <span id="view-phone"></span></li>
                        <li class="list-group-item"><strong>Address:</strong> <span id="view-address"></span></li>
                        <li class="list-group-item"><strong>Status:</strong> <span id="view-status"></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= EDIT CUSTOMER MODAL ================= --}}
    <div class="modal fade" id="editCustomerModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content glass-modal">
                <form method="POST" id="editCustomerForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold"><i class="fa fa-edit me-2 text-primary"></i> Edit Customer</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name" id="edit-name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" id="edit-email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone</label>
                                <input type="text" name="phone" id="edit-phone" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Address</label>
                                <input type="text" name="address" id="edit-address" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="active" id="edit-active" class="form-select">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">New Password (optional)</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary w-100">Update Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ================= ADD CUSTOMER MODAL ================= --}}
    <div class="modal fade" id="addCustomerModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content glass-modal">
                <form method="POST" action="{{ route('customer.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold"><i class="fa fa-user-plus me-2 text-primary"></i> Add Customer
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="fas fa-user text-muted"></i></span>
                                    <input type="text" name="name" class="form-control border-start-0 ps-0"
                                        placeholder="John Doe" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" name="email" class="form-control border-start-0 ps-0"
                                        placeholder="name@company.com" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="fas fa-phone text-muted"></i></span>
                                    <input type="tel" name="phone" class="form-control border-start-0 ps-0"
                                        placeholder="+1 234 567 8900" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Address</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="fas fa-location-dot text-muted"></i></span>
                                    <input type="text" name="address" class="form-control border-start-0 ps-0"
                                        placeholder="123 Main Street, City, Country" required>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="fas fa-lock text-muted"></i></span>
                                    <input type="password" name="password" id="addCustomerPassword"
                                        class="form-control border-start-0 ps-0" required>
                                    <span class="input-group-text border-start-0"
                                        onclick="togglePassword('addCustomerPassword', this)">
                                        <i class="fas fa-eye text-muted"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i
                                            class="fas fa-lock text-muted"></i></span>
                                    <input type="password" name="password_confirmation"
                                        id="addCustomerConfirmPassword" class="form-control border-start-0 ps-0"
                                        required>
                                    <span class="input-group-text border-start-0"
                                        onclick="togglePassword('addCustomerConfirmPassword', this)">
                                        <i class="fas fa-eye text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="role" value="customer">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100">Add Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .customers-page {
            background: radial-gradient(circle at top, #eef3ff, #f6f8fb);
            font-family: 'Segoe UI', sans-serif;
        }

        /* Glass containers */
        .glass-card {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(14px);
            border-radius: 18px;
            padding: 1.5rem;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
        }

        .glass-modal {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 18px;
            border: none;
        }

        /* Inputs */
        .form-control,
        .form-select {
            border-radius: 12px;
        }

        /* Buttons */
        .btn {
            border-radius: 14px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0d6efd, #4f46e5);
            border: none;
        }

        /* Tables */
        .table thead th {
            text-transform: uppercase;
            font-size: 0.75rem;
            color: #6c757d;
        }
    </style>

</div>

<script>
    function togglePassword(inputId, icon) {
        const input = document.getElementById(inputId);
        const iconElement = icon.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            iconElement.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            iconElement.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // View Customer
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            fetch(`/customer/${this.dataset.id}`)
                .then(res => res.json())
                .then(user => {
                    document.getElementById('view-name').textContent = user.name;
                    document.getElementById('view-email').textContent = user.email;
                    document.getElementById('view-phone').textContent = user.phone;
                    document.getElementById('view-address').textContent = user.address;
                    document.getElementById('view-status').textContent = user.active ? 'Active' :
                        'Inactive';
                    new bootstrap.Modal(document.getElementById('viewCustomerModal')).show();
                });
        });
    });

    // Edit Customer
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            fetch(`/customer/${this.dataset.id}`)
                .then(res => res.json())
                .then(user => {
                    document.getElementById('edit-name').value = user.name;
                    document.getElementById('edit-email').value = user.email;
                    document.getElementById('edit-phone').value = user.phone;
                    document.getElementById('edit-address').value = user.address;
                    document.getElementById('edit-active').value = user.active;
                    document.getElementById('editCustomerForm').action = `/customer/${user.id}`;
                    new bootstrap.Modal(document.getElementById('editCustomerModal')).show();
                });
        });
    });
</script>
