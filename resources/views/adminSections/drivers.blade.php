<div class="page-header mb-4">
    <h2 class="page-title">Riders</h2>
    <p class="text-muted">Manage all registered delivery riders in the system</p>
</div>

<!-- Rider Summary Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <h3 class="stat-title">Total Riders</h3>
                <h2 class="stat-value">152</h2>
                <p class="stat-desc">Active and verified delivery riders</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <h3 class="stat-title">Online Now</h3>
                <h2 class="stat-value">27</h2>
                <p class="stat-desc">Currently available for deliveries</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body">
                <h3 class="stat-title">New Riders</h3>
                <h2 class="stat-value">9</h2>
                <p class="stat-desc">Registered in the last 24 hours</p>
            </div>
        </div>
    </div>
</div>

<!-- Riders Table -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Rider List</h3>

        <button class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add Rider
        </button>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Rider</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Bike Type</th>
                    <th>Deliveries</th>
                    <th>Last Active</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>
                        <strong>John Davis</strong> <br>
                        <small class="text-muted">john.davis@example.com</small>
                    </td>
                    <td>+234 802 345 6789</td>
                    <td>
                        <span class="badge bg-success">Active</span>
                    </td>
                    <td>Motorcycle – Bajaj Boxer</td>
                    <td>540</td>
                    <td>5 mins ago</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary">View</button>
                    </td>
                </tr>

                <tr>
                    <td>
                        <strong>Sarah Michael</strong> <br>
                        <small class="text-muted">sarah.michael@example.com</small>
                    </td>
                    <td>+234 704 444 1234</td>
                    <td>
                        <span class="badge bg-warning">Pending</span>
                    </td>
                    <td>Motorcycle – TVS HLX</td>
                    <td>187</td>
                    <td>45 mins ago</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary">View</button>
                    </td>
                </tr>

                <tr>
                    <td>
                        <strong>Emmanuel Okoro</strong> <br>
                        <small class="text-muted">emmanuel.okoro@example.com</small>
                    </td>
                    <td>+234 806 987 5522</td>
                    <td>
                        <span class="badge bg-danger">Suspended</span>
                    </td>
                    <td>Motorcycle – Haojue HJ110</td>
                    <td>320</td>
                    <td>Yesterday</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary">View</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
