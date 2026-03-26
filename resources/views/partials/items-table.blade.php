<!-- Items Table -->
{{-- <div class="card shadow-sm">
       <div class="card-body p-0">
           <div class="table-responsive">
               <table class="table table-hover align-middle mobile-friendly">
                   <thead class="table-light">
                       <tr>
                           <th>#</th>
                           <th>Item Description</th>
                           <th>Category</th>
                           <th>Washing Price</th>
                           <th>Ironing Price</th>
                           <th>Wash & Iron Price</th>
                           <th>Status</th>

                           @if (auth()->user()->hasAnyRole(['superAdmin']))
                               <th class="text-end">Actions</th>
                           @endif
                       </tr>
                   </thead>
                   <tbody>
                       @forelse ($items as $item)
                           <tr>
                               <td data-label="#">{{ $item->id }}</td>
                               <td data-label="Item">
                                   <div class="d-flex align-items-center">
                                       <div class="item-icon bg-primary text-white rounded-circle me-2">
                                           <i class="{{ $item->icon }}"></i>
                                       </div>
                                       <div class="fw-semibold">{{ $item->name }}</div>
                                   </div>
                               </td>
                               <td data-label="Category">{{ $item->category?->type ?? '-' }}</td>
                               <td data-label="Washing">₦{{ number_format($item->washing_price, 2) }}</td>
                               <td data-label="Ironing">₦{{ number_format($item->ironing_price, 2) }}</td>
                               <td data-label="Wash & Iron">₦{{ number_format($item->wash_and_iron_price, 2) }}</td>
                               <td data-label="Status">
                                   <span
                                       class="badge {{ $item->is_active ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                                       ● {{ $item->is_active ? 'Active' : 'Inactive' }}
                                   </span>
                               </td>

                               @if (auth()->user()->hasAnyRole(['superAdmin']))
                                   <td data-label="Actions" class="text-end">
                                       <div class="dropdown">
                                           <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                               <i class="fa fa-ellipsis-v"></i>
                                           </button>
                                           <ul class="dropdown-menu dropdown-menu-end">
                                               <li>
                                                   <a href="#" class="dropdown-item edit-item"
                                                       data-id="{{ $item->id }}">
                                                       <i class="fa fa-edit me-2"></i> Edit
                                                   </a>
                                               </li>
                                               <li>
                                                   <hr class="dropdown-divider">
                                               </li>
                                               <li>
                                                   <form method="POST"
                                                       action="{{ route('laundry-items.destroy', $item->id) }}"
                                                       class="swal-delete-form" data-name="{{ $item->name }}"
                                                       data-type="Item">
                                                       @csrf @method('DELETE')
                                                       <button type="submit" class="dropdown-item text-danger">
                                                           <i class="fa fa-trash me-2"></i> Delete
                                                       </button>
                                                   </form>
                                               </li>
                                           </ul>
                                       </div>
                                   </td>
                               @endif
                           </tr>
                       @empty
                           <tr>
                               <td colspan="8" class="text-center py-4 text-muted">No items found</td>
                           </tr>
                       @endforelse
                   </tbody>
               </table>
           </div>
       </div>
   </div>

   <div class="mt-5 d-flex justify-content: center">
       {{ $items->links('pagination::bootstrap-5') }}
   </div>

   <script>
       document.addEventListener('submit', function(e) {
           const form = e.target.closest('.swal-delete-form');
           if (!form) return;
           e.preventDefault();
           const name = form.dataset.name || 'this item';
           const type = form.dataset.type || 'Item';
           Swal.fire({
               icon: 'warning',
               title: `Delete ${type}?`,
               html: `Are you sure you want to delete <strong>${name}</strong>?<br><span style="font-size:.82rem;color:#9ca3af;">This cannot be undone.</span>`,
               showCancelButton: true,
               confirmButtonColor: '#dc2626',
               cancelButtonColor: '#f3f4f6',
               confirmButtonText: '<i class="fa fa-trash me-1"></i> Yes, delete',
               cancelButtonText: 'Cancel',
           }).then(result => {
               if (result.isConfirmed) form.submit();
           });
       });
   </script> --}}
<!-- Items Table -->
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mobile-friendly">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Item Description</th>
                        <th>Category</th>
                        <th>Washing Price</th>
                        <th>Ironing Price</th>
                        <th>Wash & Iron Price</th>
                        <th>Due Days</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td data-label="#">{{ $item->id }}</td>
                            <td data-label="Item">
                                <div class="d-flex align-items-center">
                                    <div class="item-icon bg-primary text-white rounded-circle me-2">
                                        <i class="{{ $item->icon }}"></i>
                                    </div>
                                    <div class="fw-semibold">{{ $item->name }}</div>
                                </div>
                            </td>
                            <td data-label="Category">{{ $item->category?->type ?? '-' }}</td>
                            <td data-label="Washing">₦{{ number_format($item->washing_price, 2) }}</td>
                            <td data-label="Ironing">₦{{ number_format($item->ironing_price, 2) }}</td>
                            <td data-label="Wash & Iron">₦{{ number_format($item->wash_and_iron_price, 2) }}</td>
                            <td data-label="Due Days">
                                <span class="due-days-badge">
                                    {{ $item->due_days ?? 1 }} day{{ ($item->due_days ?? 1) != 1 ? 's' : '' }}
                                </span>
                            </td>
                            <td data-label="Status">
                                <span
                                    class="badge {{ $item->is_active ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                                    ● {{ $item->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td data-label="Actions" class="text-end">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="#" class="dropdown-item edit-item"
                                                data-id="{{ $item->id }}">
                                                <i class="fa fa-edit me-2"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <form method="POST"
                                                action="{{ route('laundry-items.destroy', $item->id) }}"
                                                class="swal-delete-form" data-name="{{ $item->name }}"
                                                data-type="Item">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fa fa-trash me-2"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">No items found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-5 d-flex justify-content: center">
    {{ $items->links('pagination::bootstrap-5') }}
</div>

<script>
    document.addEventListener('submit', function(e) {
        const form = e.target.closest('.swal-delete-form');
        if (!form) return;
        e.preventDefault();
        const name = form.dataset.name || 'this item';
        const type = form.dataset.type || 'Item';
        Swal.fire({
            icon: 'warning',
            title: `Delete ${type}?`,
            html: `Are you sure you want to delete <strong>${name}</strong>?<br><span style="font-size:.82rem;color:#9ca3af;">This cannot be undone.</span>`,
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
