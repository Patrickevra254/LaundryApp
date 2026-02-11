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
                                           {{-- <li>
                                               <a href="#" class="dropdown-item  edit-category"
                                                   data-id="{{ $category->id }}">
                                                   <i class="fa fa-edit me-2"></i> Edit
                                               </a>
                                           </li> --}}

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
   </div>

   <!-- Pagination -->
   {{-- <div class="mt-5 d-flex justify-content-center">
       {{ $categories->links('pagination::bootstrap-5') }}
   </div> --}}
