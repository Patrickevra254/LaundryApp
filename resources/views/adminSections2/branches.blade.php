

{{-- <div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
        <div>
            <div class="notifs-label">Management</div>
            <h4 class="notifs-title mb-0">Branches</h4>
            <p class="notifs-sub mb-0">Manage all laundry service branches</p>
        </div>
        <button class="n-btn n-btn-primary" data-bs-toggle="modal" data-bs-target="#addBranchModal">
            <i class="fa fa-plus me-1"></i> Add Branch
        </button>
    </div>



    <!-- Branches Table -->
    <div class="h-table-card">
        <table class="table table-hover align-middle mb-0 mobile-friendly">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Branch Name</th>
                    <th>Manager</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($branches as $branch)
                    <tr>
                        <td data-label="#">{{ $loop->iteration }}</td>
                        <td data-label="Branch Name">
                            <span style="font-weight:600; color:#111827;">{{ $branch->name }}</span>
                        </td>
                        <td data-label="Manager" style="font-size:.83rem; color:#6b7280;">
                            {{ $branch->manager ?? '—' }}
                        </td>
                        <td data-label="Status">
                            @if ($branch->is_active)
                                <span class="branch-badge branch-badge-active">Active</span>
                            @else
                                <span class="branch-badge branch-badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td data-label="Actions">
                            <div style="display:flex; gap:.4rem;">
                                <!-- View details -->
                                <button class="n-icon-btn" title="View Details" data-bs-toggle="modal"
                                    data-bs-target="#viewBranchModal-{{ $branch->id }}">
                                    <i class="fa fa-eye" style="color:#4f46e5;"></i>
                                </button>
                                <!-- Edit -->
                                <button class="n-icon-btn" title="Edit Branch" data-bs-toggle="modal"
                                    data-bs-target="#editBranchModal-{{ $branch->id }}">
                                    <i class="fa fa-pen" style="color:#10b981;"></i>
                                </button>
                                <!-- Delete -->
                                <form method="POST" action="{{ route('branches.destroy', $branch->id) }}"
                                    class="swal-delete-form" data-name="{{ $branch->name }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="n-icon-btn" title="Delete Branch">
                                        <i class="fa fa-trash" style="color:#dc2626;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div style="color:#9ca3af; font-size:.85rem;">
                                <i class="fa fa-building mb-2"
                                    style="font-size:1.8rem; display:block; color:#d1d5db;"></i>
                                No branches yet. Click <strong>Add Branch</strong> to create one.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div> --}}

{{-- ═══ Add Branch Modal ═══ --}}
{{-- <div class="modal fade" id="addBranchModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:520px;">
        <div class="modal-content od-modal">
            <div class="od-modal-header">
                <div>
                    <div class="od-order-num"><i class="fa fa-building me-2"></i>Add New Branch</div>
                    <div class="od-order-sub">Fill in the branch details below</div>
                </div>
                <button class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
            </div>
            <form method="POST" action="{{ route('branches.store') }}">
                @csrf
                <div class="od-modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="p-label">Branch Name <span class="req">*</span></label>
                            <input type="text" name="name" class="p-input @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="e.g. Lekki Phase 1 Branch" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="p-label">Address <span class="req">*</span></label>
                            <input type="text" name="address" class="p-input @error('address') is-invalid @enderror"
                                value="{{ old('address') }}" placeholder="e.g. 14 Admiralty Way, Lekki" required>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="p-label">Phone Number</label>
                            <input type="tel" name="phone" class="p-input" value="{{ old('phone') }}"
                                placeholder="e.g. 08012345678">
                        </div>
                        <div class="col-md-6">
                            <label class="p-label">Email Address</label>
                            <input type="email" name="email" class="p-input @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="e.g. lekki@laundrypro.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="p-label">Branch Manager</label>
                            <select name="manager" class="p-input">
                                <option value="">— Select Manager —</option>
                                @foreach ($admins as $admin)
                                    <option value="{{ $admin->name }}"
                                        {{ old('manager') === $admin->name ? 'selected' : '' }}>
                                        {{ $admin->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="od-modal-footer">
                    <button type="button" class="n-btn n-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="n-btn n-btn-primary">
                        <i class="fa fa-plus me-1"></i> Create Branch
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

{{-- ═══ Per-Branch Modals ═══ --}}
{{-- @foreach ($branches as $branch)
    <!-- ── View Details Modal ──────────────────────────────────── -->
    <div class="modal fade" id="viewBranchModal-{{ $branch->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width:520px;">
            <div class="modal-content od-modal">

                <div class="od-modal-header">
                    <div>
                        <div class="od-order-num">
                            <i class="fa fa-building me-2"></i>{{ $branch->name }}
                        </div>
                        <div class="od-order-sub">
                            Branch details &amp; information
                        </div>
                    </div>
                    <button class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
                </div>

                <div class="od-modal-body">

                    <!-- Status banner -->
                    <div
                        class="branch-status-banner {{ $branch->is_active ? 'banner-active' : 'banner-inactive' }} mb-4">
                        <i class="fa {{ $branch->is_active ? 'fa-circle-check' : 'fa-circle-xmark' }} me-2"></i>
                        This branch is currently <strong>{{ $branch->is_active ? 'Active' : 'Inactive' }}</strong>
                    </div>

                    <!-- Info grid -->
                    <div class="od-info-grid mb-4">
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-building me-1"></i> Branch Name</div>
                            <div class="od-info-value">{{ $branch->name }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-user-tie me-1"></i> Branch Manager</div>
                            <div class="od-info-value">{{ $branch->manager ?? '—' }}</div>
                        </div>
                        <div class="od-info-card od-info-card-full">
                            <div class="od-info-label"><i class="fa fa-location-dot me-1"></i> Address</div>
                            <div class="od-info-value">{{ $branch->address }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-phone me-1"></i> Phone</div>
                            <div class="od-info-value">{{ $branch->phone ?? '—' }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-envelope me-1"></i> Email</div>
                            <div class="od-info-value">{{ $branch->email ?? '—' }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-calendar me-1"></i> Date Created</div>
                            <div class="od-info-value">{{ $branch->created_at->format('D, M d Y') }}</div>
                            <div style="font-size:.7rem; color:#9ca3af; margin-top:2px;">
                                {{ $branch->created_at->format('h:i A') }} &middot;
                                {{ $branch->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-clock-rotate-left me-1"></i> Last Updated</div>
                            <div class="od-info-value">{{ $branch->updated_at->format('D, M d Y') }}</div>
                            <div style="font-size:.7rem; color:#9ca3af; margin-top:2px;">
                                {{ $branch->updated_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                </div>

                <div class="od-modal-footer">
                    <button class="n-btn n-btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="n-btn n-btn-primary" data-bs-toggle="modal"
                        data-bs-target="#editBranchModal-{{ $branch->id }}" data-bs-dismiss="modal">
                        <i class="fa fa-pen me-1"></i> Edit Branch
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- ── Edit Branch Modal ───────────────────────────────────── -->
    <div class="modal fade" id="editBranchModal-{{ $branch->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width:520px;">
            <div class="modal-content od-modal">
                <div class="od-modal-header">
                    <div>
                        <div class="od-order-num"><i class="fa fa-pen me-2"></i>Edit Branch</div>
                        <div class="od-order-sub">{{ $branch->name }}</div>
                    </div>
                    <button class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
                </div>
                <form method="POST" action="{{ route('branches.update', $branch->id) }}">
                    @csrf @method('PUT')
                    <div class="od-modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="p-label">Branch Name <span class="req">*</span></label>
                                <input type="text" name="name" class="p-input" value="{{ $branch->name }}"
                                    required>
                            </div>
                            <div class="col-12">
                                <label class="p-label">Address <span class="req">*</span></label>
                                <input type="text" name="address" class="p-input" value="{{ $branch->address }}"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Phone Number</label>
                                <input type="tel" name="phone" class="p-input" value="{{ $branch->phone }}">
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Email Address</label>
                                <input type="email" name="email" class="p-input" value="{{ $branch->email }}">
                            </div>
                            <div class="col-12">
                                <label class="p-label">Branch Manager</label>
                                <select name="manager" class="p-input">
                                    <option value="">— Select Manager —</option>
                                    @foreach ($admins as $admin)
                                        <option value="{{ $admin->name }}"
                                            {{ $branch->manager === $admin->name ? 'selected' : '' }}>
                                            {{ $admin->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="p-label">Status</label>
                                <div class="d-flex gap-3 mt-1">
                                    <label class="branch-toggle-opt">
                                        <input type="radio" name="is_active" value="1"
                                            {{ $branch->is_active ? 'checked' : '' }}>
                                        <span class="branch-toggle-label active-label">
                                            <i class="fa fa-circle-check me-1"></i> Active
                                        </span>
                                    </label>
                                    <label class="branch-toggle-opt">
                                        <input type="radio" name="is_active" value="0"
                                            {{ !$branch->is_active ? 'checked' : '' }}>
                                        <span class="branch-toggle-label inactive-label">
                                            <i class="fa fa-circle-xmark me-1"></i> Inactive
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="od-modal-footer">
                        <button type="button" class="n-btn n-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="n-btn n-btn-primary">
                            <i class="fa fa-check me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach --}}

{{-- <style>
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

    .alert-flash {
        display: flex;
        align-items: center;
        gap: .5rem;
        padding: .65rem 1rem;
        border-radius: 10px;
        font-size: .84rem;
        font-weight: 500;
    }

    .alert-flash-success {
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .alert-flash-error {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
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

    .branch-badge {
        font-size: .72rem;
        font-weight: 700;
        padding: .28em .75em;
        border-radius: 6px;
    }

    .branch-badge-active {
        background: #ecfdf5;
        color: #065f46;
    }

    .branch-badge-inactive {
        background: #f3f4f6;
        color: #6b7280;
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
    }

    .n-btn-primary {
        background: #4f46e5;
        color: #fff;
    }

    .n-btn-primary:hover {
        background: #4338ca;
    }

    .n-icon-btn {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        border: none;
        background: #f3f4f6;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: .75rem;
        cursor: pointer;
        transition: background .15s;
    }

    .n-icon-btn:hover {
        background: #eef2ff;
    }

    .p-label {
        font-size: .78rem;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 5px;
        display: block;
    }

    .req {
        color: #ef4444;
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

    .p-input.is-invalid {
        border-color: #ef4444;
    }

    .invalid-feedback {
        font-size: .75rem;
        color: #ef4444;
        margin-top: 3px;
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

    .od-info-card-full {
        grid-column: span 2;
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

    .branch-status-banner {
        display: flex;
        align-items: center;
        padding: .65rem 1rem;
        border-radius: 10px;
        font-size: .83rem;
    }

    .banner-active {
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .banner-inactive {
        background: #f3f4f6;
        color: #6b7280;
        border: 1px solid #e5e7eb;
    }

    .branch-toggle-opt {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .branch-toggle-opt input[type="radio"] {
        display: none;
    }

    .branch-toggle-label {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        padding: .4rem .9rem;
        border-radius: 8px;
        border: 1.5px solid #e5e7eb;
        font-size: .82rem;
        font-weight: 500;
        color: #6b7280;
        cursor: pointer;
        transition: all .15s;
        background: #fafafa;
    }

    .branch-toggle-opt input:checked+.active-label {
        border-color: #10b981;
        background: #ecfdf5;
        color: #065f46;
        font-weight: 700;
    }

    .branch-toggle-opt input:checked+.inactive-label {
        border-color: #9ca3af;
        background: #f3f4f6;
        color: #374151;
        font-weight: 700;
    }

    @media (max-width: 768px) {
        .mobile-friendly thead {
            display: none;
        }

        .mobile-friendly tr {
            display: block;
            border: 1px solid #f0f0f8;
            border-radius: 12px;
            margin-bottom: .75rem;
            padding: .5rem .75rem;
            background: #fff;
        }

        .mobile-friendly td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: .4rem 0;
            border: none;
            border-bottom: 1px solid #f5f5fb;
            font-size: .83rem;
        }

        .mobile-friendly td:last-child {
            border-bottom: none;
        }

        .mobile-friendly td::before {
            content: attr(data-label);
            font-size: .72rem;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .04em;
            flex-shrink: 0;
            margin-right: .75rem;
        }

        .od-info-grid {
            grid-template-columns: 1fr;
        }

        .od-info-card-full {
            grid-column: span 1;
        }
    }
</style> --}}

{{-- <script>
    document.addEventListener('hidden.bs.modal', () => {
        document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
        document.body.classList.remove('modal-open');
        document.body.style.removeProperty('overflow');
        document.body.style.removeProperty('padding-right');
    });

    // SweetAlert2 delete confirmations
    document.addEventListener('submit', function(e) {
        const form = e.target.closest('.swal-delete-form');
        if (!form) return;
        e.preventDefault();
        const name = form.dataset.name || 'this item';
        Swal.fire({
            icon: 'warning',
            title: 'Delete Branch?',
            html: `Are you sure you want to delete <strong>${name}</strong>?<br><span style="font-size:.82rem;color:#9ca3af;">This cannot be undone.</span>`,
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#f3f4f6',
            confirmButtonText: '<i class="fa fa-trash me-1"></i> Yes, delete',
            cancelButtonText: 'Cancel',
            customClass: {
                cancelButton: 'swal-cancel-dark'
            },
        }).then(result => {
            if (result.isConfirmed) form.submit();
        });
    });
</script> --}}

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
        <div>
            <div class="notifs-label">Management</div>
            <h4 class="notifs-title mb-0">Branches</h4>
            <p class="notifs-sub mb-0">Manage all laundry service branches</p>
        </div>
        <button class="n-btn n-btn-primary" data-bs-toggle="modal" data-bs-target="#addBranchModal">
            <i class="fa fa-plus me-1"></i> Add Branch
        </button>
    </div>

    @if(session('success'))
        <div class="alert-flash alert-flash-success mb-3">
            <i class="fa fa-circle-check me-2"></i>{{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert-flash alert-flash-error mb-3">
            <i class="fa fa-circle-xmark me-2"></i>{{ session('error') }}
        </div>
    @endif

    <!-- Branches Table -->
    <div class="h-table-card">
        <table class="table table-hover align-middle mb-0 mobile-friendly">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Branch Name</th>
                    <th>Manager</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($branches as $branch)
                    <tr>
                        <td data-label="#">{{ $loop->iteration }}</td>
                        <td data-label="Branch Name">
                            <span style="font-weight:600; color:#111827;">{{ $branch->name }}</span>
                        </td>
                        <td data-label="Manager" style="font-size:.83rem; color:#6b7280;">
                            {{ $branch->manager?->name ?? '—' }}
                        </td>
                        <td data-label="Status">
                            @if($branch->is_active)
                                <span class="branch-badge branch-badge-active">Active</span>
                            @else
                                <span class="branch-badge branch-badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td data-label="Actions">
                            <div style="display:flex; gap:.4rem;">
                                {{-- View details --}}
                                <button class="n-icon-btn" title="View Details"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewBranchModal-{{ $branch->id }}">
                                    <i class="fa fa-eye" style="color:#4f46e5;"></i>
                                </button>
                                {{-- Edit --}}
                                <button class="n-icon-btn" title="Edit Branch"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editBranchModal-{{ $branch->id }}">
                                    <i class="fa fa-pen" style="color:#10b981;"></i>
                                </button>
                                {{-- Delete --}}
                                <form method="POST" action="{{ route('branches.destroy', $branch->id) }}"
                                    class="swal-delete-form"
                                    data-name="{{ $branch->name }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="n-icon-btn" title="Delete Branch">
                                        <i class="fa fa-trash" style="color:#dc2626;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div style="color:#9ca3af; font-size:.85rem;">
                                <i class="fa fa-building mb-2" style="font-size:1.8rem; display:block; color:#d1d5db;"></i>
                                No branches yet. Click <strong>Add Branch</strong> to create one.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

{{-- ═══ Add Branch Modal ═══ --}}
<div class="modal fade" id="addBranchModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:520px;">
        <div class="modal-content od-modal">
            <div class="od-modal-header">
                <div>
                    <div class="od-order-num"><i class="fa fa-building me-2"></i>Add New Branch</div>
                    <div class="od-order-sub">Fill in the branch details below</div>
                </div>
                <button class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
            </div>
            <form method="POST" action="{{ route('branches.store') }}">
                @csrf
                <div class="od-modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="p-label">Branch Name <span class="req">*</span></label>
                            <input type="text" name="name" class="p-input @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="e.g. Lekki Phase 1 Branch" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="p-label">Address <span class="req">*</span></label>
                            <input type="text" name="address" class="p-input @error('address') is-invalid @enderror"
                                value="{{ old('address') }}" placeholder="e.g. 14 Admiralty Way, Lekki" required>
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="p-label">Phone Number</label>
                            <input type="tel" name="phone" class="p-input"
                                value="{{ old('phone') }}" placeholder="e.g. 08012345678">
                        </div>
                        <div class="col-md-6">
                            <label class="p-label">Email Address</label>
                            <input type="email" name="email" class="p-input @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="e.g. lekki@laundrypro.com">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="p-label">Branch Manager</label>
                            <select name="manager" class="p-input">
                                <option value="">— Select Manager —</option>
                                <option value="" disabled style="color:#9ca3af;font-style:italic;">
                                    Save branch first, then assign an admin to it
                                </option>
                            </select>
                            <div style="font-size:.73rem;color:#9ca3af;margin-top:4px;">
                                <i class="fa fa-circle-info me-1"></i>
                                Create the branch first, assign an admin to this branch from the Admins page, then edit the branch to set the manager.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="od-modal-footer">
                    <button type="button" class="n-btn n-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="n-btn n-btn-primary">
                        <i class="fa fa-plus me-1"></i> Create Branch
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ═══ Per-Branch Modals ═══ --}}
@foreach($branches as $branch)

    {{-- ── View Details Modal ──────────────────────────────────── --}}
    <div class="modal fade" id="viewBranchModal-{{ $branch->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width:520px;">
            <div class="modal-content od-modal">

                <div class="od-modal-header">
                    <div>
                        <div class="od-order-num">
                            <i class="fa fa-building me-2"></i>{{ $branch->name }}
                        </div>
                        <div class="od-order-sub">
                            Branch details &amp; information
                        </div>
                    </div>
                    <button class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
                </div>

                <div class="od-modal-body">

                    {{-- Status banner --}}
                    <div class="branch-status-banner {{ $branch->is_active ? 'banner-active' : 'banner-inactive' }} mb-4">
                        <i class="fa {{ $branch->is_active ? 'fa-circle-check' : 'fa-circle-xmark' }} me-2"></i>
                        This branch is currently <strong>{{ $branch->is_active ? 'Active' : 'Inactive' }}</strong>
                    </div>

                    {{-- Info grid --}}
                    <div class="od-info-grid mb-4">
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-building me-1"></i> Branch Name</div>
                            <div class="od-info-value">{{ $branch->name }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-user-tie me-1"></i> Branch Manager</div>
                            <div class="od-info-value">{{ $branch->manager?->name ?? '—' }}</div>
                        </div>
                        <div class="od-info-card od-info-card-full">
                            <div class="od-info-label"><i class="fa fa-location-dot me-1"></i> Address</div>
                            <div class="od-info-value">{{ $branch->address }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-phone me-1"></i> Phone</div>
                            <div class="od-info-value">{{ $branch->phone ?? '—' }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-envelope me-1"></i> Email</div>
                            <div class="od-info-value">{{ $branch->email ?? '—' }}</div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-calendar me-1"></i> Date Created</div>
                            <div class="od-info-value">{{ $branch->created_at->format('D, M d Y') }}</div>
                            <div style="font-size:.7rem; color:#9ca3af; margin-top:2px;">
                                {{ $branch->created_at->format('h:i A') }} &middot;
                                {{ $branch->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="od-info-card">
                            <div class="od-info-label"><i class="fa fa-clock-rotate-left me-1"></i> Last Updated</div>
                            <div class="od-info-value">{{ $branch->updated_at->format('D, M d Y') }}</div>
                            <div style="font-size:.7rem; color:#9ca3af; margin-top:2px;">
                                {{ $branch->updated_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                </div>

                <div class="od-modal-footer">
                    <button class="n-btn n-btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="n-btn n-btn-primary" data-bs-toggle="modal"
                        data-bs-target="#editBranchModal-{{ $branch->id }}" data-bs-dismiss="modal">
                        <i class="fa fa-pen me-1"></i> Edit Branch
                    </button>
                </div>

            </div>
        </div>
    </div>

    {{-- ── Edit Branch Modal ───────────────────────────────────── --}}
    <div class="modal fade" id="editBranchModal-{{ $branch->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width:520px;">
            <div class="modal-content od-modal">
                <div class="od-modal-header">
                    <div>
                        <div class="od-order-num"><i class="fa fa-pen me-2"></i>Edit Branch</div>
                        <div class="od-order-sub">{{ $branch->name }}</div>
                    </div>
                    <button class="od-close" data-bs-dismiss="modal"><i class="fa fa-xmark"></i></button>
                </div>
                <form method="POST" action="{{ route('branches.update', $branch->id) }}">
                    @csrf @method('PUT')
                    <div class="od-modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="p-label">Branch Name <span class="req">*</span></label>
                                <input type="text" name="name" class="p-input"
                                    value="{{ $branch->name }}" required>
                            </div>
                            <div class="col-12">
                                <label class="p-label">Address <span class="req">*</span></label>
                                <input type="text" name="address" class="p-input"
                                    value="{{ $branch->address }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Phone Number</label>
                                <input type="tel" name="phone" class="p-input"
                                    value="{{ $branch->phone }}">
                            </div>
                            <div class="col-md-6">
                                <label class="p-label">Email Address</label>
                                <input type="email" name="email" class="p-input"
                                    value="{{ $branch->email }}">
                            </div>
                            <div class="col-12">
                                <label class="p-label">Branch Manager</label>
                                @php $branchAdmins = $adminsByBranch[$branch->id] ?? collect(); @endphp
                                @if($branchAdmins->isEmpty())
                                    <div class="branch-no-admins">
                                        <i class="fa fa-triangle-exclamation me-1"></i>
                                        No admins assigned to this branch yet. Go to the
                                        <strong>Admins page</strong> and assign an admin to
                                        <strong>{{ $branch->name }}</strong> first.
                                    </div>
                                    <input type="hidden" name="manager_id" value="{{ $branch->manager_id }}">
                                @else
                                    <select name="manager_id" class="p-input">
                                        <option value="">— Select Manager —</option>
                                        @foreach($branchAdmins as $admin)
                                            <option value="{{ $admin->id }}"
                                                {{ $branch->manager_id == $admin->id ? 'selected' : '' }}>
                                                {{ $admin->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="col-12">
                                <label class="p-label">Status</label>
                                <div class="d-flex gap-3 mt-1">
                                    <label class="branch-toggle-opt">
                                        <input type="radio" name="is_active" value="1"
                                            {{ $branch->is_active ? 'checked' : '' }}>
                                        <span class="branch-toggle-label active-label">
                                            <i class="fa fa-circle-check me-1"></i> Active
                                        </span>
                                    </label>
                                    <label class="branch-toggle-opt">
                                        <input type="radio" name="is_active" value="0"
                                            {{ !$branch->is_active ? 'checked' : '' }}>
                                        <span class="branch-toggle-label inactive-label">
                                            <i class="fa fa-circle-xmark me-1"></i> Inactive
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="od-modal-footer">
                        <button type="button" class="n-btn n-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="n-btn n-btn-primary">
                            <i class="fa fa-check me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endforeach

<style>
    .notifs-label { font-size:.7rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#a5b4fc; }
    .notifs-title { font-size:1.4rem; font-weight:700; color:#0f0f1a; letter-spacing:-.02em; }
    .notifs-sub   { font-size:.82rem; color:#9ca3af; margin-top:2px; }

    .alert-flash { display:flex; align-items:center; gap:.5rem; padding:.65rem 1rem; border-radius:10px; font-size:.84rem; font-weight:500; }
    .alert-flash-success { background:#ecfdf5; color:#065f46; border:1px solid #a7f3d0; }
    .alert-flash-error   { background:#fef2f2; color:#991b1b; border:1px solid #fecaca; }

    .h-table-card { background:#fff; border:1px solid #f0f0f8; border-radius:14px; overflow:hidden; }
    .h-table-card .table { margin:0; font-size:.84rem; }
    .h-table-card .table thead th { font-size:.72rem; text-transform:uppercase; letter-spacing:.06em; color:#9ca3af; font-weight:600; background:#fafafc; border-bottom:1px solid #f0f0f8; padding:.75rem 1rem; }
    .h-table-card .table tbody td { padding:.75rem 1rem; color:#374151; border-color:#f5f5fb; vertical-align:middle; }
    .h-table-card .table-hover tbody tr:hover { background:#f8f8fd; }

    .branch-badge { font-size:.72rem; font-weight:700; padding:.28em .75em; border-radius:6px; }
    .branch-badge-active   { background:#ecfdf5; color:#065f46; }
    .branch-badge-inactive { background:#f3f4f6; color:#6b7280; }

    .n-btn { display:inline-flex; align-items:center; gap:5px; padding:.45rem .85rem; border-radius:8px; font-size:.8rem; font-weight:600; border:1px solid transparent; cursor:pointer; transition:all .15s; white-space:nowrap; }
    .n-btn-secondary { background:#f3f4f6; border-color:#e5e7eb; color:#374151; }
    .n-btn-secondary:hover { background:#e9eaec; }
    .n-btn-primary { background:#4f46e5; color:#fff; }
    .n-btn-primary:hover { background:#4338ca; }
    .n-icon-btn { width:28px; height:28px; border-radius:7px; border:none; background:#f3f4f6; display:inline-flex; align-items:center; justify-content:center; font-size:.75rem; cursor:pointer; transition:background .15s; }
    .n-icon-btn:hover { background:#eef2ff; }

    .p-label { font-size:.78rem; font-weight:600; color:#6b7280; margin-bottom:5px; display:block; }
    .req { color:#ef4444; }
    .p-input { width:100%; border-radius:9px; border:1px solid #e5e7eb; padding:.52rem .75rem; font-size:.85rem; color:#111827; background:#fafafa; transition:all .15s; outline:none; appearance:auto; }
    .p-input:focus { border-color:#a5b4fc; background:#fff; box-shadow:0 0 0 3px rgba(79,70,229,.08); }
    .p-input.is-invalid { border-color:#ef4444; }
    .invalid-feedback { font-size:.75rem; color:#ef4444; margin-top:3px; }

    .od-modal { border-radius:16px; border:1px solid #f0f0f8; overflow:hidden; }
    .od-modal-header { display:flex; justify-content:space-between; align-items:flex-start; padding:1.2rem 1.4rem; border-bottom:1px solid #f5f5fb; }
    .od-order-num { font-size:1rem; font-weight:700; color:#111827; }
    .od-order-sub { font-size:.75rem; color:#9ca3af; margin-top:2px; }
    .od-close { width:30px; height:30px; border-radius:8px; border:none; background:#f3f4f6; color:#6b7280; display:flex; align-items:center; justify-content:center; cursor:pointer; transition:background .15s; }
    .od-close:hover { background:#e9eaec; }
    .od-modal-body { padding:1.2rem 1.4rem; }
    .od-modal-footer { display:flex; justify-content:flex-end; gap:.6rem; padding:1rem 1.4rem; border-top:1px solid #f5f5fb; }

    .od-info-grid { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; }
    .od-info-card { background:#fafafc; border:1px solid #f0f0f8; border-radius:10px; padding:.7rem .9rem; }
    .od-info-card-full { grid-column: span 2; }
    .od-info-label { font-size:.72rem; color:#9ca3af; font-weight:600; margin-bottom:3px; }
    .od-info-value { font-size:.83rem; color:#111827; font-weight:500; }

    .branch-status-banner { display:flex; align-items:center; padding:.65rem 1rem; border-radius:10px; font-size:.83rem; }
    .banner-active   { background:#ecfdf5; color:#065f46; border:1px solid #a7f3d0; }
    .banner-inactive { background:#f3f4f6; color:#6b7280; border:1px solid #e5e7eb; }
    .branch-no-admins {
        background:#fffbeb; border:1px solid #fde68a; border-radius:9px;
        padding:.6rem .85rem; font-size:.78rem; color:#92400e;
        margin-bottom:.4rem;
    }

    .branch-toggle-opt { display:flex; align-items:center; cursor:pointer; }
    .branch-toggle-opt input[type="radio"] { display:none; }
    .branch-toggle-label { display:inline-flex; align-items:center; gap:.3rem; padding:.4rem .9rem; border-radius:8px; border:1.5px solid #e5e7eb; font-size:.82rem; font-weight:500; color:#6b7280; cursor:pointer; transition:all .15s; background:#fafafa; }
    .branch-toggle-opt input:checked + .active-label   { border-color:#10b981; background:#ecfdf5; color:#065f46; font-weight:700; }
    .branch-toggle-opt input:checked + .inactive-label { border-color:#9ca3af; background:#f3f4f6; color:#374151; font-weight:700; }

    @media (max-width: 768px) {
        .mobile-friendly thead { display:none; }
        .mobile-friendly tr { display:block; border:1px solid #f0f0f8; border-radius:12px; margin-bottom:.75rem; padding:.5rem .75rem; background:#fff; }
        .mobile-friendly td { display:flex; justify-content:space-between; align-items:center; padding:.4rem 0; border:none; border-bottom:1px solid #f5f5fb; font-size:.83rem; }
        .mobile-friendly td:last-child { border-bottom:none; }
        .mobile-friendly td::before { content:attr(data-label); font-size:.72rem; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:.04em; flex-shrink:0; margin-right:.75rem; }
        .od-info-grid { grid-template-columns:1fr; }
        .od-info-card-full { grid-column:span 1; }
    }
</style>

<script>
    document.addEventListener('hidden.bs.modal', () => {
        document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
        document.body.classList.remove('modal-open');
        document.body.style.removeProperty('overflow');
        document.body.style.removeProperty('padding-right');
    });

    // SweetAlert2 delete confirmations
    document.addEventListener('submit', function(e) {
        const form = e.target.closest('.swal-delete-form');
        if (!form) return;
        e.preventDefault();
        const name = form.dataset.name || 'this item';
        Swal.fire({
            icon: 'warning',
            title: 'Delete Branch?',
            html: `Are you sure you want to delete <strong>${name}</strong>?<br><span style="font-size:.82rem;color:#9ca3af;">This cannot be undone.</span>`,
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#f3f4f6',
            confirmButtonText: '<i class="fa fa-trash me-1"></i> Yes, delete',
            cancelButtonText: 'Cancel',
            customClass: { cancelButton: 'swal-cancel-dark' },
        }).then(result => {
            if (result.isConfirmed) form.submit();
        });
    });
</script>
