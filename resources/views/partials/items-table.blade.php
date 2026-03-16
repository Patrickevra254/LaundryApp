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
                           {{-- <th>Price</th> --}}
                           <th>Washing Price</th>
                           <th>Ironing Price</th>
                           <th>Wash & Iron Price</th>
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

                               <td data-label="Category">
                                   {{ $item->category?->type ?? '-' }}
                               </td>

                               {{-- <td data-label="Price">
                                    ₦{{ number_format($item->price, 2) }}
                                </td> --}}

                               <td data-label="Washing">
                                   ₦{{ number_format($item->washing_price, 2) }}
                               </td>
                               <td data-label="Ironing">
                                   ₦{{ number_format($item->ironing_price, 2) }}
                               </td>
                               <td data-label="Wash & Iron">
                                   ₦{{ number_format($item->wash_and_iron_price, 2) }}
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
                                                   action="{{ route('laundry-items.destroy', $item->id) }}">
                                                   @csrf
                                                   @method('DELETE')
                                                   <button class="dropdown-item text-danger"
                                                       onclick="return confirm('Delete this item?')">
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
   <div class="mt-5 d-flex justify-content-center">
       {{ $items->links('pagination::bootstrap-5') }}
   </div>
