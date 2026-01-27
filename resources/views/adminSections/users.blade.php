<div class="table-responsive">
    {{-- <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4">
        <h2 class="fw-bold mb-2 text-center text-sm-start">Users</h2>
        <button class="btn btn-primary mb-2 mx-auto mx-sm-0">
            <i class="fa fa-plus"></i> Add New User
        </button>

    </div> --}}

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="fw-bold mb-0">Customers</h2>
        <button class="btn btn-primary">
            <i class="fa fa-plus"></i> Add New Customer
        </button>
    </div>

    <table class="table table-striped align-middle mobile-friendly">
        <thead>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td data-label="ID">{{ $user->id }}</td>
                    <td data-label="Name">{{ $user->name }}</td>
                    <td data-label="Email">{{ $user->email }}</td>
                    <td data-label="Role">Admin</td>
                    {{-- <td data-label="Status"><span class="badge bg-success">Active</span></td> --}}
                    <td>
                        @if ($user->active)
                            <span class="badge  bg-success px-3 py-2">
                                <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i> Active
                            </span>
                        @else
                            <span class="badge  bg-secondary px-3 py-2">
                                <i class="bi bi-circle me-1" style="font-size: 0.5rem;"></i> Inactive
                            </span>
                        @endif
                    </td>
                    <td data-label="Actions">
                        <button class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


{{-- <section>
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="fw-bold mb-2">Users</h2>

        <button class="btn btn-primary mb-2">
            <i class="fa fa-plus"></i> Add New User
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Search + Filter Row -->
            <div class="row g-3 mb-3">
                <div class="col-12 col-md-6">
                    <input type="text" class="form-control" placeholder="Search users...">
                </div>

                <div class="col-12 col-md-6">
                    <select class="form-select">
                        <option>Filter by Role</option>
                        <option>Admin</option>
                        <option>Manager</option>
                        <option>User</option>
                    </select>
                </div>
            </div>

            <!-- Responsive Table -->
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Patrick Evans</td>
                            <td>patrick@example.com</td>
                            <td>Admin</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>Jane Doe</td>
                            <td>jane@example.com</td>
                            <td>Manager</td>
                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section> --}}
