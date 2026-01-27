<div class="table-responsive">
    {{-- <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4">
        <h2 class="fw-bold mb-2 text-center text-sm-start">Roles</h2>
        <button class="btn btn-primary mb-2 mx-auto mx-sm-0">
            <i class="fa fa-plus"></i> Add New Role
        </button>

    </div> --}}

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="fw-bold mb-0">Roles</h2>
        <button class="btn btn-primary">
            <i class="fa fa-plus"></i> Add New Role
        </button>
    </div>
    <table class="table table-bordered table-striped align-middle mobile-friendly">
        <thead>
            <tr>
                <th>Role</th>
                <th>Users</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td data-label="Role">Admin</td>
                <td data-label="Users">3 Users</td>
                <td data-label="Permissions">All Access</td>
                <td data-label="Actions">
                    <button class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                </td>
            </tr>

            <tr>
                <td data-label="Role">Manager</td>
                <td data-label="Users">5 Users</td>
                <td data-label="Permissions">Limited Access</td>
                <td data-label="Actions">
                    <button class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>


{{--
<section>
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="fw-bold mb-2">Roles & Permissions</h2>

        <button class="btn btn-primary mb-2">
            <i class="fa fa-plus"></i> Add New Role
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Make table responsive -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Role</th>
                            <th>Users</th>
                            <th>Permissions</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Admin</td>
                            <td>3 Users</td>
                            <td>All Access</td>
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
                            <td>Manager</td>
                            <td>5 Users</td>
                            <td>Limited Access</td>
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
