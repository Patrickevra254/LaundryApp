  {{-- <!-- SuperAdmins Table -->
  <div class="card shadow-sm">
      <div class="card-body p-0">
          <div class="table-responsive">


              <table class="table table-striped table-hover align-middle mobile-friendly">
                  <thead class="table-light">
                      <tr>
                          <th>#</th>
                          <th>SuperAdmin</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th class="text-end">Actions</th>
                      </tr>
                  </thead>

                  <tbody>
                      @forelse ($users as $user)
                          <tr>
                              <td>{{ $user->id }}</td>

                              <td>
                                  <div class="d-flex align-items-center">
                                      <div class="avatar bg-danger text-white rounded-circle me-2">
                                          {{ strtoupper(substr($user->name, 0, 1)) }}
                                      </div>
                                      <div>
                                          <div class="fw-semibold">{{ $user->name }}</div>
                                          <small class="text-muted">SuperAdmin</small>
                                      </div>
                                  </div>
                              </td>

                              <td>{{ $user->email }}</td>

                              <td>
                                  @if ($user->active)
                                      <span class="badge bg-success-subtle text-success">● Active</span>
                                  @else
                                      <span class="badge bg-secondary-subtle text-secondary">● Inactive</span>
                                  @endif
                              </td>

                              <td class="text-end">
                                  <div class="dropdown">
                                      <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                          <i class="fa fa-ellipsis-v"></i>
                                      </button>

                                      <ul class="dropdown-menu dropdown-menu-end">

                                          <!-- VIEW -->
                                          <li>
                                              <a href="#" class="dropdown-item view-btn"
                                                  data-id="{{ $user->id }}">
                                                  <i class="fa fa-eye me-2"></i> View
                                              </a>
                                          </li>

                                          <!-- EDIT -->
                                          <li>
                                              <a href="#" class="dropdown-item edit-btn"
                                                  data-id="{{ $user->id }}">
                                                  <i class="fa fa-edit me-2"></i> Edit
                                              </a>
                                          </li>

                                          <li>
                                              <hr class="dropdown-divider">
                                          </li>

                                          <!-- DELETE -->
                                          <li>
                                              <form method="POST"
                                                  action="{{ route('superAdmin.destroy', $user->id) }}">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button class="dropdown-item text-danger"
                                                      onclick="return confirm('Delete this SuperAdmin?')">
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
                              <td colspan="5" class="text-center text-muted py-4">
                                  No SuperAdmins found
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
      {{ $users->links('pagination::bootstrap-5') }}
  </div> --}}

  <!-- SuperAdmins Table -->
  <div class="card shadow-sm">
      <div class="card-body p-0">
          <div class="table-responsive">
              <table class="table table-striped table-hover align-middle mobile-friendly">
                  <thead class="table-light">
                      <tr>
                          <th>#</th>
                          <th>SuperAdmin</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th class="text-end">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @forelse ($users as $user)
                          <tr>
                              <td>{{ $user->id }}</td>
                              <td>
                                  <div class="d-flex align-items-center">
                                      <div class="avatar bg-danger text-white rounded-circle me-2">
                                          {{ strtoupper(substr($user->name, 0, 1)) }}
                                      </div>
                                      <div>
                                          <div class="fw-semibold">{{ $user->name }}</div>
                                          <small class="text-muted">SuperAdmin</small>
                                      </div>
                                  </div>
                              </td>
                              <td>{{ $user->email }}</td>
                              <td>
                                  @if ($user->active)
                                      <span class="badge bg-success-subtle text-success">● Active</span>
                                  @else
                                      <span class="badge bg-secondary-subtle text-secondary">● Inactive</span>
                                  @endif
                              </td>
                              <td class="text-end">
                                  <div class="dropdown">
                                      <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                          <i class="fa fa-ellipsis-v"></i>
                                      </button>
                                      <ul class="dropdown-menu dropdown-menu-end">
                                          <li>
                                              <a href="#" class="dropdown-item view-btn"
                                                  data-id="{{ $user->id }}">
                                                  <i class="fa fa-eye me-2"></i> View
                                              </a>
                                          </li>
                                          <li>
                                              <a href="#" class="dropdown-item edit-btn"
                                                  data-id="{{ $user->id }}">
                                                  <i class="fa fa-edit me-2"></i> Edit
                                              </a>
                                          </li>
                                          <li>
                                              <hr class="dropdown-divider">
                                          </li>
                                          <li>
                                              <form method="POST" action="{{ route('superAdmin.destroy', $user->id) }}"
                                                  class="swal-delete-form" data-name="{{ $user->name }}"
                                                  data-type="SuperAdmin">
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
                              <td colspan="5" class="text-center text-muted py-4">No SuperAdmins found</td>
                          </tr>
                      @endforelse
                  </tbody>
              </table>
          </div>
      </div>
  </div>

  <div class="mt-5 d-flex justify-content-center">
      {{ $users->links('pagination::bootstrap-5') }}
  </div>

  <script>
      document.addEventListener('submit', function(e) {
          const form = e.target.closest('.swal-delete-form');
          if (!form) return;
          e.preventDefault();
          const name = form.dataset.name || 'this user';
          const type = form.dataset.type || 'User';
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
