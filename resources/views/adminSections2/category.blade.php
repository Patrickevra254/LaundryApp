<div class="container-fluid items-page">

    <!-- Header -->
    <div class="page-header mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h4 class="fw-bold mb-1">Laundry Categories</h4>
            <small class="text-muted">Manage categories of clothes the shop can wash</small>
        </div>

        {{-- ADMIN ONLY ACTIONS --}}
        @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
            <div class="d-flex gap-2">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="fa fa-plus me-1"></i> Add Category
                </button>
            </div>
        @endif
    </div>

    {{-- ADMIN SEARCH ONLY --}}
    @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
        <form hx-get="{{ route('categories') }}" hx-target="#categories-table" hx-push-url="true"
            hx-trigger="keyup changed delay:400ms" class="d-flex gap-2 mb-3">

            <input type="text" name="search" class="form-control" placeholder="Search by category name"
                value="{{ request('search') }}">

            <a href="{{ route('categories') }}" class="btn btn-outline-secondary" hx-get="{{ route('categories') }}"
                hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                Clear
            </a>
        </form>
    @endif

    <!-- CATEGORIES TABLE -->
    <div class="glass-card">
        <div id="categories-table">

            @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
                @include('partials.category-table')
            @endif

        </div>
    </div>

    {{-- ================= ADMIN MODALS ONLY ================= --}}
    @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
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

        {{-- EDIT CATEGORY MODAL --}}
        <div class="modal fade" id="editCategoryModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content glass-modal">
                    <form method="POST" id="editCategoryForm">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">
                                <i class="fa fa-edit me-2 text-primary"></i> Edit Category
                            </h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Category Title</label>
                                <input type="text" name="type" id="edit-category-type" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary w-100">
                                Update Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- STYLES --}}
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
</style>

{{-- ADMIN JS ONLY --}}
@if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
    <script>
        // ========================================
        // EVENT DELEGATION APPROACH (More Robust)
        // ========================================

        document.body.addEventListener('click', function(e) {

            // ==================== CATEGORY EDIT ====================
            if (e.target.closest('.edit-category')) {
                e.preventDefault();
                const btn = e.target.closest('.edit-category');
                const categoryId = btn.dataset.id;

                fetch(`/laundry-categories/${categoryId}`)
                    .then(res => res.json())
                    .then(category => {
                        document.getElementById('edit-category-type').value = category.type;
                        document.getElementById('editCategoryForm').action =
                            `/laundry-categories/${category.id}`;

                        new bootstrap.Modal(document.getElementById('editCategoryModal')).show();
                    })
                    .catch(err => console.error('Category fetch failed:', err));
            }
        });

        // Optional: Log when HTMX swaps content (for debugging)
        document.body.addEventListener('htmx:afterSwap', (e) => {
            if (e.target.id === 'categories-table') {
                console.log('Categories table refreshed via HTMX');
            }
        });
    </script>
@endif
