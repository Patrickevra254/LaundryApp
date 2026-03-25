{{-- <div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
        <div>
            <div class="notifs-label">Management</div>
            <h4 class="notifs-title mb-0">Admins</h4>
            <p class="notifs-sub mb-0">Manage all registered admins</p>
        </div>
        <button class="n-btn n-btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">
            <i class="fa fa-user-plus"></i> Add Admin
        </button>
    </div>

    <!-- Filter -->
    <form hx-get="{{ route('admin') }}" hx-target="#admin-table" hx-push-url="true"
        hx-trigger="keyup changed delay:400ms" class="h-filter mb-3">
        <div class="h-search-wrap">
            <i class="fa fa-search"></i>
            <input type="text" name="search" class="h-search" placeholder="Search by name, email or phone..."
                value="{{ request('search') }}">
        </div>
        <a href="{{ route('admin') }}" class="n-btn n-btn-secondary text-decoration-none" hx-get="{{ route('admin') }}"
            hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
            <i class="fa fa-xmark"></i> Clear
        </a>
    </form>

    <!-- Table -->
    <div class="h-table-card">
        <div id="admin-table">
            @include('partials.admin-table')
        </div>
    </div>

    <!-- View Admin Modal -->
    <div class="modal fade" id="viewAdminModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content od-modal">
                <div class="od-modal-header">
                    <div>
                        <div class="od-order-num">Admin Details</div>
                        <div class="od-order-sub">Viewing admin profile</div>
                    </div>
                    <button type="button" class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
                </div>
                <div class="od-modal-body">
                    <div class="od-info-grid">
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-user me-1"></i> Name</div>
                            <div class="od-info-value" id="view-name">—</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-envelope me-1"></i> Email</div>
                            <div class="od-info-value" id="view-email">—</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-phone me-1"></i> Phone</div>
                            <div class="od-info-value" id="view-phone">—</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-location-dot me-1"></i> Address</div>
                            <div class="od-info-value" id="view-address">—</div>
                        </div>
                    </div>
                    <div class="od-info-card mt-3">
                        <div class="od-info-label"><i class="fa fa-circle-dot me-1"></i> Status</div>
                        <div class="od-info-value" id="view-status">—</div>
                    </div>
                </div>
                <div class="od-modal-footer">
                    <button class="n-btn n-btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Admin Modal -->
    <div class="modal fade" id="editAdminModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content od-modal">
                <form method="POST" id="editAdminForm">
                    @csrf @method('PUT')
                    <div class="od-modal-header">
                        <div>
                            <div class="od-order-num">Edit Admin</div>
                            <div class="od-order-sub">Update admin account details</div>
                        </div>
                        <button type="button" class="od-close" data-bs-dismiss="modal"><i
                                class="fa fa-xmark"></i></button>
                    </div>
                    <div class="od-modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="p-label">Name</label>
                                <input type="text" name="name" id="edit-name" class="p-input" required>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Email</label>
                                <input type="email" name="email" id="edit-email" class="p-input" required>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Phone</label>
                                <input type="text" name="phone" id="edit-phone" class="p-input">
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Address</label>
                                <input type="text" name="address" id="edit-address" class="p-input">
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Status</label>
                                <select name="active" id="edit-active" class="p-input">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">New Password <span class="text-muted">(optional)</span></label>
                                <input type="password" name="password" class="p-input"
                                    placeholder="Leave blank to keep current">
                            </div>
                        </div>
                    </div>
                    <div class="od-modal-footer">
                        <button type="button" class="n-btn n-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="n-btn n-btn-primary"><i class="fa fa-floppy-disk me-1"></i>
                            Update Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Admin Modal -->
    <div class="modal fade" id="addAdminModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content od-modal">
                <form method="POST" action="{{ route('admin.store') }}">
                    @csrf
                    <input type="hidden" name="role" value="admin">
                    <div class="od-modal-header">
                        <div>
                            <div class="od-order-num">Add Admin</div>
                            <div class="od-order-sub">Create a new admin account</div>
                        </div>
                        <button type="button" class="od-close" data-bs-dismiss="modal"><i
                                class="fa fa-xmark"></i></button>
                    </div>
                    <div class="od-modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="p-label">Full Name</label>
                                <input type="text" name="name" class="p-input" placeholder="John Doe"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Email</label>
                                <input type="email" name="email" class="p-input" placeholder="name@company.com"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Phone</label>
                                <input type="tel" name="phone" class="p-input" placeholder="+1 234 567 8900"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Address</label>
                                <input type="text" name="address" class="p-input" placeholder="123 Main Street"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Password</label>
                                <div class="pw-wrap">
                                    <input type="password" name="password" id="adminPassword" class="p-input"
                                        required>
                                    <button type="button" class="pw-toggle"
                                        onclick="togglePassword('adminPassword', this)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Confirm Password</label>
                                <div class="pw-wrap">
                                    <input type="password" name="password_confirmation" id="adminConfirmPassword"
                                        class="p-input" required>
                                    <button type="button" class="pw-toggle"
                                        onclick="togglePassword('adminConfirmPassword', this)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="od-modal-footer">
                        <button type="button" class="n-btn n-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="n-btn n-btn-primary"><i class="fa fa-user-plus me-1"></i> Add
                            Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
    .notifs-label {
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: #a5b4fc;
    }

    .notifs-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0f0f1a;
        letter-spacing: -.02em;
    }

    .notifs-sub {
        font-size: .82rem;
        color: #9ca3af;
        margin-top: 2px;
    }

    .h-filter {
        display: flex;
        gap: .6rem;
        align-items: center;
    }

    .h-search-wrap {
        position: relative;
        flex: 1;
    }

    .h-search-wrap i {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #c4c9d4;
        font-size: .8rem;
        pointer-events: none;
    }

    .h-search {
        width: 100%;
        border-radius: 9px;
        border: 1px solid #e5e7eb;
        padding: .52rem .75rem .52rem 2.1rem;
        font-size: .85rem;
        background: #fafafa;
        outline: none;
        transition: all .15s;
        color: #111827;
    }

    .h-search:focus {
        border-color: #a5b4fc;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, .08);
    }

    .h-search::placeholder {
        color: #c4c9d4;
    }

    .n-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: .45rem .85rem;
        border-radius: 8px;
        font-size: .8rem;
        font-weight: 600;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all .15s;
        white-space: nowrap;
    }

    .n-btn-secondary {
        background: #f3f4f6;
        border-color: #e5e7eb;
        color: #374151;
    }

    .n-btn-secondary:hover {
        background: #e9eaec;
        color: #111827;
    }

    .n-btn-primary {
        background: #4f46e5;
        color: #fff;
    }

    .n-btn-primary:hover {
        background: #4338ca;
    }

    .h-table-card {
        background: #fff;
        border: 1px solid #f0f0f8;
        border-radius: 14px;
        overflow: hidden;
    }

    .h-table-card .table {
        margin: 0;
        font-size: .84rem;
    }

    .h-table-card .table thead th {
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #9ca3af;
        font-weight: 600;
        background: #fafafc;
        border-bottom: 1px solid #f0f0f8;
        padding: .75rem 1rem;
    }

    .h-table-card .table tbody td {
        padding: .75rem 1rem;
        color: #374151;
        border-color: #f5f5fb;
        vertical-align: middle;
    }

    .h-table-card .table-hover tbody tr:hover {
        background: #f8f8fd;
    }

    .p-label {
        font-size: .78rem;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 5px;
        display: block;
    }

    .p-input {
        width: 100%;
        border-radius: 9px;
        border: 1px solid #e5e7eb;
        padding: .52rem .75rem;
        font-size: .85rem;
        color: #111827;
        background: #fafafa;
        transition: all .15s;
        outline: none;
        appearance: auto;
    }

    .p-input:focus {
        border-color: #a5b4fc;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, .08);
    }

    .p-input::placeholder {
        color: #c4c9d4;
    }

    .od-modal {
        border-radius: 16px;
        border: 1px solid #f0f0f8;
        overflow: hidden;
    }

    .od-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 1.2rem 1.4rem;
        border-bottom: 1px solid #f5f5fb;
    }

    .od-order-num {
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
    }

    .od-order-sub {
        font-size: .75rem;
        color: #9ca3af;
        margin-top: 2px;
    }

    .od-close {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        border: none;
        background: #f3f4f6;
        color: #6b7280;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background .15s;
    }

    .od-close:hover {
        background: #e9eaec;
    }

    .od-modal-body {
        padding: 1.2rem 1.4rem;
    }

    .od-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: .6rem;
        padding: 1rem 1.4rem;
        border-top: 1px solid #f5f5fb;
    }

    .od-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: .75rem;
    }

    .od-info-card {
        background: #fafafc;
        border: 1px solid #f0f0f8;
        border-radius: 10px;
        padding: .7rem .9rem;
    }

    .od-info-label {
        font-size: .72rem;
        color: #9ca3af;
        font-weight: 600;
        margin-bottom: 3px;
    }

    .od-info-value {
        font-size: .83rem;
        color: #111827;
        font-weight: 500;
    }

    .pw-wrap {
        position: relative;
    }

    .pw-wrap .p-input {
        padding-right: 2.2rem;
    }

    .pw-toggle {
        position: absolute;
        right: 9px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: none;
        color: #9ca3af;
        cursor: pointer;
        font-size: .8rem;
        padding: 0;
        transition: color .15s;
    }

    .pw-toggle:hover {
        color: #4f46e5;
    }

    @media(max-width:576px) {
        .h-filter {
            flex-direction: column;
            align-items: stretch;
        }

        .od-info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        icon.classList.toggle('fa-eye', !isHidden);
        icon.classList.toggle('fa-eye-slash', isHidden);
    }

        // Always reuse the same instance — never stack duplicates
    function getModal(id) {
        const el = document.getElementById(id);
        return bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
    }

    // Nuke any orphaned backdrops whenever a modal closes
    document.addEventListener('hidden.bs.modal', () => {
        document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
        document.body.classList.remove('modal-open');
        document.body.style.removeProperty('overflow');
        document.body.style.removeProperty('padding-right');
    });

    function attachAdminHandlers() {
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                fetch(`/admin/${this.dataset.id}`)
                    .then(res => res.json())
                    .then(user => {
                        document.getElementById('view-name').textContent = user.name || '—';
                        document.getElementById('view-email').textContent = user.email || '—';
                        document.getElementById('view-phone').textContent = user.phone || '—';
                        document.getElementById('view-address').textContent = user.address || '—';
                        document.getElementById('view-status').textContent = user.active ?
                            'Active' : 'Inactive';
                        new bootstrap.Modal(document.getElementById('viewAdminModal')).show();
                    });
            });
        });

        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                fetch(`/admin/${this.dataset.id}`)
                    .then(res => res.json())
                    .then(user => {
                        document.getElementById('edit-name').value = user.name || '';
                        document.getElementById('edit-email').value = user.email || '';
                        document.getElementById('edit-phone').value = user.phone || '';
                        document.getElementById('edit-address').value = user.address || '';
                        document.getElementById('edit-active').value = user.active;
                        document.getElementById('editAdminForm').action = `/admin/${user.id}`;
                        new bootstrap.Modal(document.getElementById('editAdminModal')).show();
                    });
            });
        });
    }

    attachAdminHandlers();
    document.addEventListener('htmx:afterSettle', attachAdminHandlers);
</script> --}}

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
        <div>
            <div class="notifs-label">Management</div>
            <h4 class="notifs-title mb-0">Admins</h4>
            <p class="notifs-sub mb-0">Manage all registered admins</p>
        </div>


        @if (auth()->user()->hasAnyRole(['superAdmin']))
            <button class="n-btn n-btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                <i class="fa fa-user-plus"></i> Add Admin
            </button>
        @endif
    </div>

    <!-- Filter -->
    <form hx-get="{{ route('admin') }}" hx-target="#admin-table" hx-push-url="true"
        hx-trigger="keyup changed delay:400ms" class="h-filter mb-3">
        <div class="h-search-wrap">
            <i class="fa fa-search"></i>
            <input type="text" name="search" class="h-search"
                placeholder="Search by name, email, branch or phone..." value="{{ request('search') }}">
        </div>
        <a href="{{ route('admin') }}" class="n-btn n-btn-secondary text-decoration-none" hx-get="{{ route('admin') }}"
            hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
            <i class="fa fa-xmark"></i> Clear
        </a>
    </form>

    <!-- Table -->
    <div class="h-table-card">
        <div id="admin-table">
            @include('partials.admin-table')
        </div>
    </div>

    <!-- View Admin Modal -->
    <div class="modal fade" id="viewAdminModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content od-modal">
                <div class="od-modal-header">
                    <div>
                        <div class="od-order-num">Admin Details</div>
                        <div class="od-order-sub">Viewing admin profile</div>
                    </div>
                    <button type="button" class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
                </div>
                <div class="od-modal-body">
                    <div class="od-info-grid">
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-user me-1"></i> Name</div>
                            <div class="od-info-value" id="view-name">—</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-envelope me-1"></i> Email</div>
                            <div class="od-info-value" id="view-email">—</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-phone me-1"></i> Phone</div>
                            <div class="od-info-value" id="view-phone">—</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-location-dot me-1"></i> Address</div>
                            <div class="od-info-value" id="view-address">—</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-building me-1"></i> Branch</div>
                            <div class="od-info-value" id="view-branch">—</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-circle-dot me-1"></i> Status</div>
                            <div class="od-info-value" id="view-status">—</div>
                        </div>
                    </div>
                </div>
                <div class="od-modal-footer">
                    <button class="n-btn n-btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Admin Modal -->
    <div class="modal fade" id="editAdminModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content od-modal">
                <form method="POST" id="editAdminForm">
                    @csrf @method('PUT')
                    <div class="od-modal-header">
                        <div>
                            <div class="od-order-num">Edit Admin</div>
                            <div class="od-order-sub">Update admin account details</div>
                        </div>
                        <button type="button" class="od-close" data-bs-dismiss="modal"><i
                                class="fa fa-xmark"></i></button>
                    </div>
                    <div class="od-modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="p-label">Name</label>
                                <input type="text" name="name" id="edit-name" class="p-input" required>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Email</label>
                                <input type="email" name="email" id="edit-email" class="p-input" required>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Phone</label>
                                <input type="text" name="phone" id="edit-phone" class="p-input">
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Address</label>
                                <input type="text" name="address" id="edit-address" class="p-input">
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Branch <span style="color:#ef4444;">*</span></label>
                                <select name="branch_id" id="edit-branch" class="p-input" required>
                                    <option value="">— Select Branch —</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Status</label>
                                <select name="active" id="edit-active" class="p-input">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">New Password <span class="text-muted">(optional)</span></label>
                                <input type="password" name="password" class="p-input"
                                    placeholder="Leave blank to keep current">
                            </div>
                        </div>
                    </div>
                    <div class="od-modal-footer">
                        <button type="button" class="n-btn n-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="n-btn n-btn-primary">
                            <i class="fa fa-floppy-disk me-1"></i> Update Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Admin Modal -->
    <div class="modal fade" id="addAdminModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content od-modal">
                <form method="POST" action="{{ route('admin.store') }}">
                    @csrf
                    <input type="hidden" name="role" value="admin">
                    <div class="od-modal-header">
                        <div>
                            <div class="od-order-num">Add Admin</div>
                            <div class="od-order-sub">Create a new admin account</div>
                        </div>
                        <button type="button" class="od-close" data-bs-dismiss="modal"><i
                                class="fa fa-xmark"></i></button>
                    </div>
                    <div class="od-modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="p-label">Full Name</label>
                                <input type="text" name="name" class="p-input" placeholder="John Doe"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Email</label>
                                <input type="email" name="email" class="p-input" placeholder="name@company.com"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Phone</label>
                                <input type="tel" name="phone" class="p-input" placeholder="+1 234 567 8900"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Address</label>
                                <input type="text" name="address" class="p-input" placeholder="123 Main Street"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Branch <span style="color:#ef4444;">*</span></label>
                                <select name="branch_id" class="p-input" required>
                                    <option value="">— Select Branch —</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Password</label>
                                <div class="pw-wrap">
                                    <input type="password" name="password" id="adminPassword" class="p-input"
                                        required>
                                    <button type="button" class="pw-toggle"
                                        onclick="togglePassword('adminPassword', this)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Confirm Password</label>
                                <div class="pw-wrap">
                                    <input type="password" name="password_confirmation" id="adminConfirmPassword"
                                        class="p-input" required>
                                    <button type="button" class="pw-toggle"
                                        onclick="togglePassword('adminConfirmPassword', this)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="od-modal-footer">
                        <button type="button" class="n-btn n-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="n-btn n-btn-primary">
                            <i class="fa fa-user-plus me-1"></i> Add Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
    .notifs-label {
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: #a5b4fc;
    }

    .notifs-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0f0f1a;
        letter-spacing: -.02em;
    }

    .notifs-sub {
        font-size: .82rem;
        color: #9ca3af;
        margin-top: 2px;
    }

    .h-filter {
        display: flex;
        gap: .6rem;
        align-items: center;
    }

    .h-search-wrap {
        position: relative;
        flex: 1;
    }

    .h-search-wrap i {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #c4c9d4;
        font-size: .8rem;
        pointer-events: none;
    }

    .h-search {
        width: 100%;
        border-radius: 9px;
        border: 1px solid #e5e7eb;
        padding: .52rem .75rem .52rem 2.1rem;
        font-size: .85rem;
        background: #fafafa;
        outline: none;
        transition: all .15s;
        color: #111827;
    }

    .h-search:focus {
        border-color: #a5b4fc;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, .08);
    }

    .h-search::placeholder {
        color: #c4c9d4;
    }

    .n-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: .45rem .85rem;
        border-radius: 8px;
        font-size: .8rem;
        font-weight: 600;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all .15s;
        white-space: nowrap;
    }

    .n-btn-secondary {
        background: #f3f4f6;
        border-color: #e5e7eb;
        color: #374151;
    }

    .n-btn-secondary:hover {
        background: #e9eaec;
        color: #111827;
    }

    .n-btn-primary {
        background: #4f46e5;
        color: #fff;
    }

    .n-btn-primary:hover {
        background: #4338ca;
    }

    .h-table-card {
        background: #fff;
        border: 1px solid #f0f0f8;
        border-radius: 14px;
        overflow: hidden;
    }

    .h-table-card .table {
        margin: 0;
        font-size: .84rem;
    }

    .h-table-card .table thead th {
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #9ca3af;
        font-weight: 600;
        background: #fafafc;
        border-bottom: 1px solid #f0f0f8;
        padding: .75rem 1rem;
    }

    .h-table-card .table tbody td {
        padding: .75rem 1rem;
        color: #374151;
        border-color: #f5f5fb;
        vertical-align: middle;
    }

    .h-table-card .table-hover tbody tr:hover {
        background: #f8f8fd;
    }

    .p-label {
        font-size: .78rem;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 5px;
        display: block;
    }

    .p-input {
        width: 100%;
        border-radius: 9px;
        border: 1px solid #e5e7eb;
        padding: .52rem .75rem;
        font-size: .85rem;
        color: #111827;
        background: #fafafa;
        transition: all .15s;
        outline: none;
        appearance: auto;
    }

    .p-input:focus {
        border-color: #a5b4fc;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, .08);
    }

    .p-input::placeholder {
        color: #c4c9d4;
    }

    .od-modal {
        border-radius: 16px;
        border: 1px solid #f0f0f8;
        overflow: hidden;
    }

    .od-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 1.2rem 1.4rem;
        border-bottom: 1px solid #f5f5fb;
    }

    .od-order-num {
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
    }

    .od-order-sub {
        font-size: .75rem;
        color: #9ca3af;
        margin-top: 2px;
    }

    .od-close {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        border: none;
        background: #f3f4f6;
        color: #6b7280;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background .15s;
    }

    .od-close:hover {
        background: #e9eaec;
    }

    .od-modal-body {
        padding: 1.2rem 1.4rem;
    }

    .od-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: .6rem;
        padding: 1rem 1.4rem;
        border-top: 1px solid #f5f5fb;
    }

    .od-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: .75rem;
    }

    .od-info-card {
        background: #fafafc;
        border: 1px solid #f0f0f8;
        border-radius: 10px;
        padding: .7rem .9rem;
    }

    .od-info-label {
        font-size: .72rem;
        color: #9ca3af;
        font-weight: 600;
        margin-bottom: 3px;
    }

    .od-info-value {
        font-size: .83rem;
        color: #111827;
        font-weight: 500;
    }

    .pw-wrap {
        position: relative;
    }

    .pw-wrap .p-input {
        padding-right: 2.2rem;
    }

    .pw-toggle {
        position: absolute;
        right: 9px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: none;
        color: #9ca3af;
        cursor: pointer;
        font-size: .8rem;
        padding: 0;
        transition: color .15s;
    }

    .pw-toggle:hover {
        color: #4f46e5;
    }

    @media(max-width:576px) {
        .h-filter {
            flex-direction: column;
            align-items: stretch;
        }

        .od-info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        icon.classList.toggle('fa-eye', !isHidden);
        icon.classList.toggle('fa-eye-slash', isHidden);
    }

    function getModal(id) {
        const el = document.getElementById(id);
        return bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
    }

    document.addEventListener('hidden.bs.modal', () => {
        document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
        document.body.classList.remove('modal-open');
        document.body.style.removeProperty('overflow');
        document.body.style.removeProperty('padding-right');
    });

    function attachAdminHandlers() {
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                fetch(`/admin/${this.dataset.id}`)
                    .then(res => res.json())
                    .then(user => {
                        document.getElementById('view-name').textContent = user.name || '—';
                        document.getElementById('view-email').textContent = user.email || '—';
                        document.getElementById('view-phone').textContent = user.phone || '—';
                        document.getElementById('view-address').textContent = user.address || '—';
                        document.getElementById('view-branch').textContent = user.branch ? user
                            .branch.name : '—';
                        document.getElementById('view-status').textContent = user.active ?
                            'Active' : 'Inactive';
                        getModal('viewAdminModal').show();
                    });
            });
        });

        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                fetch(`/admin/${this.dataset.id}`)
                    .then(res => res.json())
                    .then(user => {
                        document.getElementById('edit-name').value = user.name || '';
                        document.getElementById('edit-email').value = user.email || '';
                        document.getElementById('edit-phone').value = user.phone || '';
                        document.getElementById('edit-address').value = user.address || '';
                        document.getElementById('edit-active').value = user.active;
                        // Pre-select branch
                        const branchSelect = document.getElementById('edit-branch');
                        branchSelect.value = user.branch_id || '';
                        document.getElementById('editAdminForm').action = `/admin/${user.id}`;
                        getModal('editAdminModal').show();
                    });
            });
        });
    }

    attachAdminHandlers();
    document.addEventListener('htmx:afterSettle', attachAdminHandlers);
</script>
