<div class="container-fluid staff-page mt-2">

    <!-- Page Header -->
    <div class="page-header mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h4 class="fw-bold mb-1">Staffs</h4>
            <small class="text-muted">Manage all registered staffs</small>
        </div>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
            <i class="fa fa-user-plus me-1"></i> Add Staff
        </button>
    </div>

    <!-- Filters -->
    <form hx-get="{{ route('staff') }}" hx-target="#staff-table" hx-push-url="true" hx-trigger="keyup changed delay:400ms"
        class="d-flex gap-2 mb-3">

        <input type="text" name="search" class="form-control" placeholder="Search by name, email or phone"
            value="{{ request('search') }}">

        <a href="{{ route('staff') }}" class="btn btn-outline-secondary" hx-get="{{ route('staff') }}"
            hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
            Clear
        </a>
    </form>

    <!-- Staff Table -->
    <div class="glass-card">
        <div id="staff-table" class="table-responsive">
            @include('partials.staff-table')
        </div>
    </div>
</div>

{{-- ================= VIEW STAFF MODAL ================= --}}
<div class="modal fade" id="viewStaffModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content glass-modal">
            <div class="modal-header">
                <h5 class="modal-title fw-bold"><i class="fa fa-user me-2 text-primary"></i> Staff Details</h5>
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

{{-- ================= EDIT STAFF MODAL ================= --}}
<div class="modal fade" id="editStaffModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content glass-modal">
            <form method="POST" id="editStaffForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold"><i class="fa fa-edit me-2 text-primary"></i> Edit Staff</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
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
                        <input type="text" name="phone" id="edit-phone" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Address</label>
                        <input type="text" name="address" id="edit-address" class="form-control">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary w-100">Update Staff</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ================= ADD STAFF MODAL ================= --}}
<div class="modal fade" id="addStaffModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content glass-modal">
            <form method="POST" action="{{ route('staff.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold"><i class="fa fa-user-plus me-2 text-primary"></i> Add Staff</h5>
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
                                <input type="tel" name="phone" class="form-control border-start-0 ps-0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Address</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0"><i
                                        class="fas fa-location-dot text-muted"></i></span>
                                <input type="text" name="address" class="form-control border-start-0 ps-0">
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0"><i
                                        class="fas fa-lock text-muted"></i></span>
                                <input type="password" name="password" id="addStaffPassword"
                                    class="form-control border-start-0 ps-0" required>
                                <span class="input-group-text border-start-0"
                                    onclick="togglePassword('addStaffPassword', this)">
                                    <i class="fas fa-eye text-muted"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0"><i
                                        class="fas fa-lock text-muted"></i></span>
                                <input type="password" name="password_confirmation" id="addStaffConfirmPassword"
                                    class="form-control border-start-0 ps-0" required>
                                <span class="input-group-text border-start-0"
                                    onclick="togglePassword('addStaffConfirmPassword', this)">
                                    <i class="fas fa-eye text-muted"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="role" value="staff">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100">Create Staff</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .staff-page {
        background: radial-gradient(circle at top, #eef3ff, #f6f8fb);
        font-family: 'Segoe UI', sans-serif;
    }

    /* Glass card */
    .glass-card {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(14px);
        border-radius: 18px;
        padding: 1.5rem;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
    }

    /* Glass modals */
    .glass-modal {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 18px;
        border: none;
    }

    .form-control,
    .form-select {
        border-radius: 12px;
    }

    .btn {
        border-radius: 14px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd, #4f46e5);
        border: none;
    }

    .table thead th {
        text-transform: uppercase;
        font-size: 0.75rem;
        color: #6c757d;
    }
</style>

<script>
    // Toggle password visibility
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

    // View Staff
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            fetch(`/staff/${this.dataset.id}`)
                .then(res => res.json())
                .then(user => {
                    document.getElementById('view-name').textContent = user.name;
                    document.getElementById('view-email').textContent = user.email;
                    document.getElementById('view-phone').textContent = user.phone;
                    document.getElementById('view-address').textContent = user.address;
                    document.getElementById('view-status').textContent = user.active ? 'Active' :
                        'Inactive';
                    new bootstrap.Modal(document.getElementById('viewStaffModal')).show();
                });
        });
    });

    // Edit Staff
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            fetch(`/staff/${this.dataset.id}`)
                .then(res => res.json())
                .then(user => {
                    document.getElementById('edit-name').value = user.name;
                    document.getElementById('edit-email').value = user.email;
                    document.getElementById('edit-phone').value = user.phone;
                    document.getElementById('edit-address').value = user.address;
                    document.getElementById('edit-active').value = user.active;
                    document.getElementById('editStaffForm').action = `/staff/${user.id}`;
                    new bootstrap.Modal(document.getElementById('editStaffModal')).show();
                });
        });
    });
</script>
