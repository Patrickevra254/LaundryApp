<div class="container-fluid items-page mt-2">

    <!-- Header -->
    <div class="page-header mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h4 class="fw-bold mb-1">Laundry Items</h4>
            <small class="text-muted">Manage types of clothes the shop can wash</small>
        </div>

        {{-- ADMIN ONLY ACTIONS --}}
        @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
            <div class="d-flex gap-2">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItemModal">
                    <i class="fa fa-plus me-1"></i> Add Item
                </button>
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="fa fa-tags me-1"></i> Add Category
                </button>
            </div>
        @endif
    </div>

    {{-- ADMIN SEARCH ONLY --}}
    @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
        <form hx-get="{{ route('items') }}" hx-target="#items-table" hx-push-url="true"
            hx-trigger="keyup changed delay:400ms" class="d-flex gap-2 mb-3">

            <input type="text" name="search" class="form-control" placeholder="Search by name or category"
                value="{{ request('search') }}">

            <a href="{{ route('items') }}" class="btn btn-outline-secondary" hx-get="{{ route('items') }}"
                hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                Clear
            </a>
        </form>
    @endif

    <!-- ITEMS TABLE -->
    <div class="glass-card">
        <div id="items-table">

            @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
                @include('partials.items-table')
                @include('partials.category-table')
            @else
                @include('customer.items')
            @endif

        </div>
    </div>

    @include('customer.customerModal')

    {{-- ================= ADMIN MODALS ONLY ================= --}}
    @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))

        {{-- EDIT ITEM MODAL --}}
        <div class="modal fade" id="editItemModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content glass-modal">
                    <form method="POST" id="editItemForm">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">
                                <i class="fa fa-edit me-2 text-primary"></i> Edit Laundry Item
                            </h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Item Name</label>
                                <input type="text" name="name" id="edit-name" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Category</label>
                                <select name="category_id" id="edit-category" class="form-select" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Washing Price</label>
                                <input type="text" name="washing_price" id="edit-washing_price" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Ironing Price</label>
                                <input type="text" name="ironing_price" id="edit-ironing_price" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Wash & Iron Price</label>
                                <input type="text" name="wash_and_iron_price" id="edit-wash_and_iron_price"
                                    class="form-control" required>
                            </div>

                            {{-- ICON --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold">Icon</label>
                                <div class="d-flex gap-2 flex-wrap">
                                    @foreach (['fa fa-tshirt', 'fa fa-bed', 'fa fa-socks', 'fa fa-mitten', 'fa fa-shoe-prints'] as $icon)
                                        <label class="icon-option">
                                            <input type="radio" name="icon" value="{{ $icon }}"
                                                class="d-none" required>

                                            <span><i class="{{ $icon }}"></i></span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>


                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Status</label>
                                <select name="is_active" id="edit-status" class="form-select">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary w-100">Update Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ADD ITEM MODAL --}}
        {{-- <div class="modal fade" id="addItemModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content glass-modal">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">
                            <i class="fa fa-plus me-2 text-primary"></i> Add Laundry Item
                        </h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('laundry-items.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Item Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Category</label>
                                    <select name="category_id" class="form-select" required>
                                        <option selected disabled>Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Washing Price</label>
                                    <input type="text" name="washing_price" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Ironing Price</label>
                                    <input type="text" name="ironing_price" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Wash & Iron Price</label>
                                    <input type="text" name="wash_and_iron_price" class="form-control" required>
                                </div>
                            </div>

                            <div class="modal-footer mt-3">
                                <button type="submit" class="btn btn-primary w-100">Save Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- ADD ITEM MODAL --}}
        <div class="modal fade" id="addItemModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content glass-modal">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">
                            <i class="fa fa-plus me-2 text-primary"></i> Add Laundry Item
                        </h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('laundry-items.store') }}" method="POST">
                            @csrf

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Item Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Category</label>
                                    <select name="category_id" class="form-select" required>
                                        <option selected disabled>Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Washing Price</label>
                                    <input type="text" name="washing_price" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Ironing Price</label>
                                    <input type="text" name="ironing_price" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Wash & Iron Price</label>
                                    <input type="text" name="wash_and_iron_price" class="form-control" required>
                                </div>

                                {{-- ICON --}}
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Icon</label>
                                    <div class="d-flex gap-2 flex-wrap">
                                        @foreach (['fa fa-tshirt', 'fa fa-bed', 'fa fa-socks', 'fa fa-mitten', 'fa fa-shoe-prints'] as $icon)
                                            <label class="icon-option">
                                                <input type="radio" name="icon" value="{{ $icon }}"
                                                    class="d-none" required>

                                                <span><i class="{{ $icon }}"></i></span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- STATUS --}}
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Status</label>
                                    <select name="is_active" class="form-select">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                            </div>

                            <div class="modal-footer mt-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fa fa-save me-1"></i> Save Item
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


        {{-- ADD CATEGORY MODAL --}}
        <div class="modal fade" id="addCategoryModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content glass-modal">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">
                            <i class="fa fa-tags me-2 text-primary"></i> Add Category
                        </h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('laundry-categories.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Category Title</label>
                                <input type="text" name="type" class="form-control" required>
                            </div>
                            <button class="btn btn-primary w-100">Save Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endif
</div>

{{-- STYLES (UNCHANGED) --}}
<style>
    .items-page {
        background: radial-gradient(circle at top, #eef3ff, #f6f8fb);
        font-family: 'Segoe UI', sans-serif;
    }

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

    .icon-option {
        cursor: pointer;
    }

    /* icon box */
    .icon-option span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        border-radius: 12px;
        border: 2px solid #dee2e6;
        font-size: 20px;
        color: #6c757d;
        background: #fff;
        transition: all 0.2s ease;
    }

    /* hover feedback */
    .icon-option:hover span {
        border-color: #0d6efd;
        background: rgba(13, 110, 253, 0.05);
    }

    /* SELECTED STATE — THIS IS THE KEY */
    .icon-option input:checked+span {
        border-color: #0d6efd;
        background: #0d6efd;
        color: #fff;
        box-shadow: 0 6px 14px rgba(13, 110, 253, 0.35);
        transform: scale(1.05);
    }
</style>

{{-- ADMIN JS ONLY --}}
@if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
    <script>
        function attachEditHandlers() {
            document.querySelectorAll('.edit-item').forEach(btn => {
                btn.addEventListener('click', function() {
                    fetch(`/laundry-items/${this.dataset.id}`)
                        .then(res => res.json())
                        .then(item => {

                            document.getElementById('edit-name').value = item.name;
                            document.getElementById('edit-category').value = item.category_id;
                            document.getElementById('edit-washing_price').value = item.washing_price;
                            document.getElementById('edit-ironing_price').value = item.ironing_price;
                            document.getElementById('edit-wash_and_iron_price').value = item
                                .wash_and_iron_price;
                            document.getElementById('edit-status').value = item.is_active;

                            // ICON SELECTION
                            document.querySelectorAll('#editItemModal input[name="icon"]').forEach(
                                radio => {
                                    radio.checked = (radio.value === item.icon);
                                });

                            document.getElementById('editItemForm').action =
                                `/laundry-items/${item.id}`;

                            new bootstrap.Modal(
                                document.getElementById('editItemModal')
                            ).show();
                        });
                });
            });
        }

        attachEditHandlers();

        document.body.addEventListener('htmx:afterSwap', (e) => {
            if (e.target.id === 'items-table') attachEditHandlers();
        });
    </script>

    {{-- <script>
        function attachEditHandlers() {
            document.querySelectorAll('.edit-item').forEach(btn => {
                btn.addEventListener('click', function() {
                    fetch(`/laundry-items/${this.dataset.id}`)
                        .then(res => res.json())
                        .then(item => {
                            document.getElementById('edit-name').value = item.name;
                            document.getElementById('edit-category').value = item.category_id;
                            document.getElementById('edit-washing_price').value = item.washing_price;
                            document.getElementById('edit-ironing_price').value = item.ironing_price;
                            document.getElementById('edit-wash_and_iron_price').value = item
                                .wash_and_iron_price;
                            document.getElementById('edit-status').value = item.is_active;
                            document.getElementById('editItemForm').action =
                                `/laundry-items/${item.id}`;
                            new bootstrap.Modal(document.getElementById('editItemModal')).show();
                        });
                });
            });
        }

        attachEditHandlers();

        document.body.addEventListener('htmx:afterSwap', (e) => {
            if (e.target.id === 'items-table') attachEditHandlers();
        });
    </script> --}}
@endif
