{{-- <div class="table-responsive">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="fw-bold mb-0">Support Tickets</h2>
        <button class="btn btn-primary">
            <i class="fa fa-plus"></i> New Ticket
        </button>
    </div>

    <table class="table table-striped align-middle mobile-friendly">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Date Created</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach(range(1,5) as $i)
                <tr>
                    <td>{{ $i }}</td>
                    <td>Customer {{ $i }}</td>
                    <td>Issue {{ $i }}</td>

                    <td>
                        @switch($i % 3)
                            @case(0)
                                <span class="badge bg-warning text-dark">Open</span>
                                @break
                            @case(1)
                                <span class="badge bg-info">In Progress</span>
                                @break
                            @case(2)
                                <span class="badge bg-success">Closed</span>
                                @break
                        @endswitch
                    </td>

                    <td>
                        @switch($i % 3)
                            @case(0)
                                <span class="badge bg-secondary">Low</span>
                                @break
                            @case(1)
                                <span class="badge bg-primary">Medium</span>
                                @break
                            @case(2)
                                <span class="badge bg-danger">High</span>
                                @break
                        @endswitch
                    </td>

                    <td>{{ now()->subDays($i)->format('Y-m-d') }}</td>

                    <td>
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div> --}}

<div class="container-fluid mt-4">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="fw-bold mb-0">Support Tickets</h2>
            <p class="text-muted mb-0">Manage all user support requests and follow up statuses.</p>
        </div>

        <button class="btn btn-primary px-4">
            <i class="bi bi-plus-circle me-1"></i>
            Add Ticket
        </button>
    </div>

    <!-- SUMMARY CARDS -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-4">
            <div class="card shadow-sm p-3 h-100">
                <h6 class="text-muted fw-semibold">Open Tickets</h6>
                <h3 class="fw-bold mt-2">12</h3>
                <p class="small text-danger">• Needs attention</p>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card shadow-sm p-3 h-100">
                <h6 class="text-muted fw-semibold">In Progress</h6>
                <h3 class="fw-bold mt-2">5</h3>
                <p class="small text-warning">• Currently being handled</p>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card shadow-sm p-3 h-100">
                <h6 class="text-muted fw-semibold">Closed Tickets</h6>
                <h3 class="fw-bold mt-2">28</h3>
                <p class="small text-success">• Resolved</p>
            </div>
        </div>
    </div>

    <!-- TICKETS TABLE -->
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between flex-wrap align-items-center gap-3">
            <h5 class="mb-0 fw-bold">Recent Tickets</h5>

            <div class="input-group" style="max-width: 260px;">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" placeholder="Search tickets...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped align-middle mobile-friendly mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#Ticket</th>
                        <th>User</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <!-- Dummy Rows -->
                    <tr>
                        <td data-label="Ticket">TCK-00101</td>
                        <td data-label="User">John Doe</td>
                        <td data-label="Subject">Bike not starting</td>
                        <td data-label="Status">
                            <span class="badge bg-danger px-3 py-2">Open</span>
                        </td>
                        <td data-label="Priority">
                            <span class="badge bg-warning text-dark px-3 py-2">High</span>
                        </td>
                        <td data-label="Date">2025-01-08</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td data-label="Ticket">TCK-00102</td>
                        <td data-label="User">Jane Smith</td>
                        <td data-label="Subject">Payment not confirmed</td>
                        <td data-label="Status">
                            <span class="badge bg-warning text-dark px-3 py-2">In Progress</span>
                        </td>
                        <td data-label="Priority">
                            <span class="badge bg-info text-dark px-3 py-2">Medium</span>
                        </td>
                        <td data-label="Date">2025-01-07</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td data-label="Ticket">TCK-00103</td>
                        <td data-label="User">Michael Peter</td>
                        <td data-label="Subject">Broken chain</td>
                        <td data-label="Status">
                            <span class="badge bg-success px-3 py-2">Closed</span>
                        </td>
                        <td data-label="Priority">
                            <span class="badge bg-secondary px-3 py-2">Low</span>
                        </td>
                        <td data-label="Date">2025-01-06</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<style>
    /* Mobile-friendly table */
    @media (max-width: 768px) {
        .mobile-friendly thead {
            display: none;
        }

        .mobile-friendly tr {
            display: block;
            margin-bottom: 1rem;
            border-bottom: 2px solid #f1f1f1;
        }

        .mobile-friendly td {
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }

        .mobile-friendly td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #6c757d;
        }
    }
</style>
