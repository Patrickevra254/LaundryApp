   {{-- <!-- Category Table -->
   <div class="card shadow-sm mt-5">
       <div>
           <h4 class="fw-bold mb-1">Category Types</h4>
           <small class="text-muted">Manage categories of clothes the shop can wash</small>
       </div>
       <div class="card-body p-0 mt-4">
           <div class="table-responsive">
               <table class="table table-hover align-middle mobile-friendly">
                   <thead class="table-light">
                       <tr>
                           <th>#</th>
                           <th>Category</th>
                           <th>Status</th>
                           <th>Date Created</th>
                           <th>Date Updated</th>
                           <th>Actions</th>
                       </tr>
                   </thead>

                   <tbody>
                       @forelse ($categories as $category)
                           <tr>
                               <td data-label="#">{{ $category->id }}</td>

                               <td data-label="Item">
                                   <div class="d-flex align-items-center">
                                       <div class="fw-semibold">{{ $category->type }}</div>
                                   </div>
                               </td>

                               <td data-label="Status">
                                   <span class="badge bg-success-subtle text-success">
                                       ● Active
                                   </span>
                               </td>

                               <td data-label="Item">
                                   <div class="d-flex align-items-center">
                                       <div class="fw-semibold">{{ $category->created_at }}</div>
                                   </div>
                               </td>

                               <td data-label="Item">
                                   <div class="d-flex align-items-center">
                                       <div class="fw-semibold">{{ $category->updated_at }}</div>
                                   </div>
                               </td>

                               <td data-label="Actions" class="text-end">
                                   <div class="dropdown">
                                       <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                           <i class="fa fa-ellipsis-v"></i>
                                       </button>
                                       <ul class="dropdown-menu dropdown-menu-end">


                                           <li>
                                               <hr class="dropdown-divider">
                                           </li>

                                           <li>
                                               <form method="POST"
                                                   action="{{ route('laundry-categories.destroy', $category->id) }}">
                                                   @csrf
                                                   @method('DELETE')

                                                   <button type="submit" class="dropdown-item text-danger"
                                                       onclick="return confirm('Delete this Category?')">
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
                               <td colspan="5" class="text-center py-4 text-muted">
                                   No items found
                               </td>
                           </tr>
                       @endforelse
                   </tbody>

               </table>
           </div>
       </div>
   </div>
   </div> --}}

   <!-- Pagination -->
   {{-- <div class="mt-5 d-flex justify-content-center">
       {{ $categories->links('pagination::bootstrap-5') }}
   </div> --}}
   <!-- Category Table -->
   <div class="card shadow-sm mt-5">
       <div>
           <h4 class="fw-bold mb-1">Category Types</h4>
           <small class="text-muted">Manage categories of clothes the shop can wash</small>
       </div>
       <div class="card-body p-0 mt-4">
           <div class="table-responsive">
               <table class="table table-hover align-middle mobile-friendly">
                   <thead class="table-light">
                       <tr>
                           <th>#</th>
                           <th>Category</th>
                           <th>Status</th>
                           <th>Date Created</th>
                           <th>Date Updated</th>

                           @if (auth()->user()->hasAnyRole(['superAdmin']))
                               <th>Actions</th>
                           @endif
                       </tr>
                   </thead>
                   <tbody>
                       @forelse ($categories as $category)
                           <tr>
                               <td data-label="#">{{ $category->id }}</td>
                               <td data-label="Item">
                                   <div class="fw-semibold">{{ $category->type }}</div>
                               </td>
                               <td data-label="Status">
                                   <span class="badge bg-success-subtle text-success">● Active</span>
                               </td>
                               <td data-label="Date Created">
                                   <div class="fw-semibold">{{ $category->created_at }}</div>
                               </td>
                               <td data-label="Date Updated">
                                   <div class="fw-semibold">{{ $category->updated_at }}</div>
                               </td>

                               @if (auth()->user()->hasAnyRole(['superAdmin']))
                                   <td data-label="Actions" class="text-end">
                                       <div class="dropdown">
                                           <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                               <i class="fa fa-ellipsis-v"></i>
                                           </button>
                                           <ul class="dropdown-menu dropdown-menu-end">
                                               <li>
                                                   <hr class="dropdown-divider">
                                               </li>


                                               <li>
                                                   <form method="POST"
                                                       action="{{ route('laundry-categories.destroy', $category->id) }}"
                                                       class="swal-delete-form" data-name="{{ $category->type }}"
                                                       data-type="Category">
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
                               <td colspan="5" class="text-center py-4 text-muted">No items found</td>
                           </tr>
                       @endforelse
                   </tbody>
               </table>
           </div>
       </div>
   </div>

   <script>
       document.addEventListener('submit', function(e) {
           const form = e.target.closest('.swal-delete-form');
           if (!form) return;
           e.preventDefault();
           const name = form.dataset.name || 'this category';
           const type = form.dataset.type || 'Category';
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
