{{-- <div class="container-fluid items-page">

    <!-- Header -->
    <div class="page-header mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h4 class="fw-bold mb-1">Laundry Items</h4>
            <small class="text-muted">Manage types of clothes the shop can wash</small>
        </div>

         <!-- ADMIN ONLY ACTIONS -->
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


      <!-- ADMIN SEARCH ONLY -->
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


      <!--   ADMIN MODALS ONLY-->
    @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))


         <!-- EDIT ITEM MODAL -->
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


                             <!--  ICON -->
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



         <!-- ADD ITEM MODAL -->
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


                                 <!-- ICON-->
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


                                <!--  STATUS -->
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



        <!--  ADD CATEGORY MODAL -->
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
</div> --}}

{{-- STYLES (UNCHANGED) --}}
{{-- <style>
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
</style> --}}

{{-- ADMIN JS ONLY --}}
{{-- @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
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

@endif --}}


<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
        <div>
            <div class="notifs-label">Catalogue</div>
            <h4 class="notifs-title mb-0">Laundry Items</h4>
            <p class="notifs-sub mb-0">Manage types of clothes the shop can wash</p>
        </div>

        @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
            <div class="d-flex gap-2">
                <button class="n-btn n-btn-primary" data-bs-toggle="modal" data-bs-target="#addItemModal">
                    <i class="fa fa-plus"></i> Add Item
                </button>
                <button class="n-btn n-btn-secondary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="fa fa-tags"></i> Add Category
                </button>
            </div>
        @endif
    </div>

    <!-- Search -->
    @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
        <form hx-get="{{ route('items') }}" hx-target="#items-table" hx-push-url="true"
            hx-trigger="keyup changed delay:400ms" class="h-filter mb-3">
            <div class="h-search-wrap">
                <i class="fa fa-search"></i>
                <input type="text" name="search" class="h-search" placeholder="Search by name or category..."
                    value="{{ request('search') }}">
            </div>
            <a href="{{ route('items') }}" class="n-btn n-btn-secondary text-decoration-none"
                hx-get="{{ route('items') }}" hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true"
                hx-indicator=".htmx-indicator">
                <i class="fa fa-xmark"></i> Clear
            </a>
        </form>
    @endif

    <!-- Table -->
    <div class="h-table-card">
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

    @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))

        <!-- Edit Item Modal -->
        <div class="modal fade" id="editItemModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content od-modal">
                    <form method="POST" id="editItemForm">
                        @csrf @method('PUT')
                        <div class="od-modal-header">
                            <div>
                                <div class="od-order-num">Edit Laundry Item</div>
                                <div class="od-order-sub">Update item details below</div>
                            </div>
                            <button type="button" class="od-close" data-bs-dismiss="modal"><i
                                    class="fa fa-xmark"></i></button>
                        </div>
                        <div class="od-modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="p-label">Item Name</label>
                                    <input type="text" name="name" id="edit-name" class="p-input" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="p-label">Category</label>
                                    <select name="category_id" id="edit-category" class="p-input" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="p-label">Washing Price</label>
                                    <input type="text" name="washing_price" id="edit-washing_price" class="p-input"
                                        required>
                                </div>
                                <div class="col-md-4">
                                    <label class="p-label">Ironing Price</label>
                                    <input type="text" name="ironing_price" id="edit-ironing_price" class="p-input"
                                        required>
                                </div>
                                <div class="col-md-4">
                                    <label class="p-label">Wash & Iron Price</label>
                                    <input type="text" name="wash_and_iron_price" id="edit-wash_and_iron_price"
                                        class="p-input" required>
                                </div>
                                <div class="col-12">
                                    <label class="p-label">Icon</label>
                                    <div class="d-flex gap-2 flex-wrap">
                                        @foreach (['fa fa-tshirt', 'fa fa-bed', 'fa fa-socks', 'fa fa-mitten', 'fa fa-shoe-prints'] as $icon)
                                            <label class="icon-opt">
                                                <input type="radio" name="icon" value="{{ $icon }}"
                                                    class="d-none" required>
                                                <span><i class="{{ $icon }}"></i></span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="p-label">Status</label>
                                    <select name="is_active" id="edit-status" class="p-input">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="od-modal-footer">
                            <button type="button" class="n-btn n-btn-secondary"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="n-btn n-btn-primary"><i class="fa fa-floppy-disk me-1"></i>
                                Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Item Modal -->
        <div class="modal fade" id="addItemModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content od-modal">
                    <div class="od-modal-header">
                        <div>
                            <div class="od-order-num">Add Laundry Item</div>
                            <div class="od-order-sub">Fill in the details for the new item</div>
                        </div>
                        <button type="button" class="od-close" data-bs-dismiss="modal"><i
                                class="fa fa-xmark"></i></button>
                    </div>
                    <div class="od-modal-body">
                        <form action="{{ route('laundry-items.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="p-label">Item Description</label>
                                    <input type="text" name="name" class="p-input" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="p-label">Category</label>
                                    <select name="category_id" class="p-input" required>
                                        <option selected disabled>Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="p-label">Washing Price</label>
                                    <input type="text" name="washing_price" class="p-input" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="p-label">Ironing Price</label>
                                    <input type="text" name="ironing_price" class="p-input" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="p-label">Wash & Iron Price</label>
                                    <input type="text" name="wash_and_iron_price" class="p-input" required>
                                </div>
                                <div class="col-12">
                                    <label class="p-label">Icon</label>
                                    <div class="d-flex gap-2 flex-wrap">
                                        @foreach (['fa fa-tshirt', 'fa fa-bed', 'fa fa-socks', 'fa fa-mitten', 'fa fa-shoe-prints'] as $icon)
                                            <label class="icon-opt">
                                                <input type="radio" name="icon" value="{{ $icon }}"
                                                    class="d-none" required>
                                                <span><i class="{{ $icon }}"></i></span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="p-label">Status</label>
                                    <select name="is_active" class="p-input">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="od-modal-footer mt-3 px-0 pb-0">
                                <button type="button" class="n-btn n-btn-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="n-btn n-btn-primary"><i
                                        class="fa fa-floppy-disk me-1"></i> Save Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Category Modal -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content od-modal">
                    <div class="od-modal-header">
                        <div>
                            <div class="od-order-num">Add Category</div>
                            <div class="od-order-sub">Create a new laundry category</div>
                        </div>
                        <button type="button" class="od-close" data-bs-dismiss="modal"><i
                                class="fa fa-xmark"></i></button>
                    </div>
                    <div class="od-modal-body">
                        <form action="{{ route('laundry-categories.store') }}" method="POST">
                            @csrf
                            <label class="p-label">Category Title</label>
                            <input type="text" name="type" class="p-input mb-0" required>
                            <div class="od-modal-footer mt-3 px-0 pb-0">
                                <button type="button" class="n-btn n-btn-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="n-btn n-btn-primary"><i
                                        class="fa fa-floppy-disk me-1"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endif
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
        padding: .55rem .75rem;
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

    .icon-opt {
        cursor: pointer;
    }

    .icon-opt span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 10px;
        border: 1.5px solid #e5e7eb;
        font-size: 1.1rem;
        color: #6b7280;
        background: #fff;
        transition: all .15s;
    }

    .icon-opt:hover span {
        border-color: #a5b4fc;
        background: #eef2ff;
        color: #4f46e5;
    }

    .icon-opt input:checked+span {
        border-color: #4f46e5;
        background: #4f46e5;
        color: #fff;
        box-shadow: 0 4px 12px rgba(79, 70, 229, .3);
    }

    @media(max-width:576px) {
        .h-filter {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>

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
                            document.querySelectorAll('#editItemModal input[name="icon"]').forEach(r =>
                                r.checked = (r.value === item.icon));
                            document.getElementById('editItemForm').action =
                                `/laundry-items/${item.id}`;
                            new bootstrap.Modal(document.getElementById('editItemModal')).show();
                        });
                });
            });
        }
        attachEditHandlers();
        document.body.addEventListener('htmx:afterSwap', e => {
            if (e.target.id === 'items-table') attachEditHandlers();
        });
    </script>
@endif
