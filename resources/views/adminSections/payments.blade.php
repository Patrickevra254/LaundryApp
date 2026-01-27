<div class="container-fluid mt-4">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="fw-bold mb-0">Payments</h2>
            <p class="text-muted mb-0">Overview of all transactions and records.</p>
        </div>

        <button class="btn btn-primary px-4">
            <i class="bi bi-plus-circle me-1"></i>
            Add Payment
        </button>
    </div>

    <!-- SUMMARY CARDS -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-4">
            <div class="card shadow-sm p-3 h-100">
                <h6 class="text-muted fw-semibold">Total Payments</h6>
                <h3 class="fw-bold mt-2">₦245,000</h3>
                <p class="small text-success">↑ +12% this month</p>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card shadow-sm p-3 h-100">
                <h6 class="text-muted fw-semibold">Pending</h6>
                <h3 class="fw-bold mt-2">₦38,000</h3>
                <p class="small text-warning">• 3 pending</p>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card shadow-sm p-3 h-100">
                <h6 class="text-muted fw-semibold">Failed Payments</h6>
                <h3 class="fw-bold mt-2">₦12,500</h3>
                <p class="small text-danger">• 1 failed</p>
            </div>
        </div>
    </div>

    <!-- PAYMENTS TABLE -->
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between flex-wrap align-items-center gap-3">
            <h5 class="mb-0 fw-bold">Recent Payments</h5>

            <div class="input-group" style="max-width: 260px;">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" placeholder="Search payments...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped align-middle mobile-friendly mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#Ref</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                    <!-- SUCCESS -->
                    <tr>
                        <td data-label="Ref">PAY-00123</td>
                        <td data-label="User">John Doe</td>
                        <td data-label="Amount">₦25,000</td>
                        <td data-label="Method">Card</td>
                        <td data-label="Status">
                            <span class="badge bg-success px-3 py-2">Successful</span>
                        </td>
                        <td data-label="Date">2025-01-08</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- PENDING -->
                    <tr>
                        <td data-label="Ref">PAY-00124</td>
                        <td data-label="User">Jane Smith</td>
                        <td data-label="Amount">₦10,000</td>
                        <td data-label="Method">Bank Transfer</td>
                        <td data-label="Status">
                            <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                        </td>
                        <td data-label="Date">2025-01-07</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- FAILED -->
                    <tr>
                        <td data-label="Ref">PAY-00125</td>
                        <td data-label="User">Michael Peter</td>
                        <td data-label="Amount">₦12,500</td>
                        <td data-label="Method">Card</td>
                        <td data-label="Status">
                            <span class="badge bg-danger px-3 py-2">Failed</span>
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
    /* Mobile-friendly table styles (same pattern as user page) */
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
