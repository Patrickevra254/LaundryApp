{{-- <div class="container-fluid py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Analytics</h2>
            <small class="text-muted">Detailed insights and performance breakdown</small>
        </div>

        <div class="d-flex gap-2">
            <select class="form-select form-select-sm" style="width:150px;">
                <option>Last 7 Days</option>
                <option>Last 30 Days</option>
                <option>Last 90 Days</option>
                <option>This Year</option>
            </select>

            <button class="btn btn-primary btn-sm">
                <i class="bi bi-download"></i> Export Report
            </button>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="p-3 border rounded bg-white shadow-sm">
                <small class="text-muted">Total Users</small>
                <h3 class="fw-bold">12,430</h3>
                <span class="text-success small">▲ +12.5% this month</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="p-3 border rounded bg-white shadow-sm">
                <small class="text-muted">New Signups</small>
                <h3 class="fw-bold">840</h3>
                <span class="text-danger small">▼ -5.3% this week</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="p-3 border rounded bg-white shadow-sm">
                <small class="text-muted">Active Sessions</small>
                <h3 class="fw-bold">2,915</h3>
                <span class="text-success small">▲ +8.1% today</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="p-3 border rounded bg-white shadow-sm">
                <small class="text-muted">Revenue</small>
                <h3 class="fw-bold">$34,890</h3>
                <span class="text-success small">▲ +18.4% this month</span>
            </div>
        </div>
    </div>

    <!-- Main Charts Section -->
    <div class="row g-4">

        <!-- Traffic Overview -->
        <div class="col-lg-7">
            <div class="p-4 rounded bg-white shadow-sm h-100">
                <h5 class="fw-bold mb-3">Traffic Overview</h5>
                <div class="chart-placeholder text-center">
                    <div class="py-5 text-muted">[Traffic Line Chart Placeholder]</div>
                </div>
            </div>
        </div>

        <!-- Device Breakdown -->
        <div class="col-lg-5">
            <div class="p-4 rounded bg-white shadow-sm h-100">
                <h5 class="fw-bold mb-3">Device Breakdown</h5>
                <div class="chart-placeholder text-center">
                    <div class="py-5 text-muted">[Pie Chart Placeholder]</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="mt-4 p-4 rounded bg-white shadow-sm">
        <h5 class="fw-bold mb-3">Top Performing Pages</h5>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Page</th>
                    <th>Visits</th>
                    <th>Avg. Time</th>
                    <th>Bounce Rate</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>/home</td>
                    <td>12,500</td>
                    <td>3m 20s</td>
                    <td>34%</td>
                </tr>

                <tr>
                    <td>/products</td>
                    <td>9,210</td>
                    <td>2m 47s</td>
                    <td>41%</td>
                </tr>

                <tr>
                    <td>/contact</td>
                    <td>3,800</td>
                    <td>1m 10s</td>
                    <td>58%</td>
                </tr>

                <tr>
                    <td>/faq</td>
                    <td>2,990</td>
                    <td>2m 12s</td>
                    <td>43%</td>
                </tr>
            </tbody>
        </table>
    </div>

</div> --}}

<div class="mb-4 d-flex justify-content-between align-items-center flex-wrap">
    <h2 class="fw-bold mb-2 mb-md-0">Analytics Dashboard</h2>

    <button class="btn btn-primary">
        <i class="fa fa-download me-1"></i> Export Report
    </button>
</div>

<!-- ===================== -->
<!--   Top Statistic Cards -->
<!-- ===================== -->
<div class="row g-4 mb-4">

    <!-- Total Rides -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0 p-3">
            <div class="d-flex justify-content-between">
                <h6 class="fw-bold text-muted">Total Rides</h6>
                <i class="fa fa-motorcycle text-primary fs-3"></i>
            </div>
            <p class="fs-2 fw-bold mt-2">1,204</p>
            <span class="text-success"><i class="fa fa-arrow-up"></i> +12% this month</span>
        </div>
    </div>

    <!-- Revenue -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0 p-3">
            <div class="d-flex justify-content-between">
                <h6 class="fw-bold text-muted">Total Revenue</h6>
                <i class="fa fa-wallet text-warning fs-3"></i>
            </div>
            <p class="fs-2 fw-bold mt-2">$24,560</p>
            <span class="text-success"><i class="fa fa-arrow-up"></i> +8% growth</span>
        </div>
    </div>

    <!-- Active Drivers -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0 p-3">
            <div class="d-flex justify-content-between">
                <h6 class="fw-bold text-muted">Active Drivers</h6>
                <i class="fa fa-id-badge text-success fs-3"></i>
            </div>
            <p class="fs-2 fw-bold mt-2">87</p>
            <span class="text-muted"><i class="fa fa-minus"></i> Stable</span>
        </div>
    </div>

    <!-- Customer Registrations -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0 p-3">
            <div class="d-flex justify-content-between">
                <h6 class="fw-bold text-muted">New Customers</h6>
                <i class="fa fa-users text-info fs-3"></i>
            </div>
            <p class="fs-2 fw-bold mt-2">312</p>
            <span class="text-info"><i class="fa fa-arrow-up"></i> +5% growth</span>
        </div>
    </div>

</div>


<!-- ===================== -->
<!--     Chart Placeholder -->
<!-- ===================== -->
<div class="card shadow-sm border-0 p-4 mb-4">
    <h5 class="fw-bold mb-3">Rides Trend (Dummy Chart)</h5>
    <div class="text-center py-5 text-muted fst-italic">
        <i class="fa fa-chart-line fs-1 mb-3 d-block"></i>
        Line Chart Placeholder — Monthly Rides
    </div>
</div>


<!-- ===================== -->
<!--    Revenue Breakdown  -->
<!-- ===================== -->
<div class="card shadow-sm border-0 p-4 mb-4">
    <h5 class="fw-bold mb-3">Revenue Breakdown</h5>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="p-3 bg-light rounded">
                <h6 class="fw-bold">Ride Payments</h6>
                <p class="fs-4 fw-bold">$18,400</p>
                <span class="badge bg-success">+6%</span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 bg-light rounded">
                <h6 class="fw-bold">Tips</h6>
                <p class="fs-4 fw-bold">$3,200</p>
                <span class="badge bg-primary">+3%</span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 bg-light rounded">
                <h6 class="fw-bold">Penalties / Fees</h6>
                <p class="fs-4 fw-bold">$2,960</p>
                <span class="badge bg-danger">-2%</span>
            </div>
        </div>

    </div>
</div>


<!-- ===================== -->
<!--  Recent Rides Table   -->
<!-- ===================== -->
<div class="card shadow-sm border-0 p-4 mb-4">
    <h5 class="fw-bold mb-3">Recent Rides</h5>

    <div class="table-responsive">
        <table class="table table-hover align-middle mobile-friendly">
            <thead class="table-light">
                <tr>
                    <th>Ride ID</th>
                    <th>Driver</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Time</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>#RIDE-0021</td>
                    <td><i class="fa fa-user text-primary me-1"></i> Mike James</td>
                    <td><i class="fa fa-user text-success me-1"></i> Sarah Lane</td>
                    <td>$12.50</td>
                    <td><span class="badge bg-success">Completed</span></td>
                    <td>20 mins ago</td>
                </tr>

                <tr>
                    <td>#RIDE-0020</td>
                    <td><i class="fa fa-user text-primary me-1"></i> Abdul Malik</td>
                    <td><i class="fa fa-user text-success me-1"></i> Janet K</td>
                    <td>$15.00</td>
                    <td><span class="badge bg-warning text-dark">Ongoing</span></td>
                    <td>45 mins ago</td>
                </tr>

                <tr>
                    <td>#RIDE-0019</td>
                    <td><i class="fa fa-user text-primary me-1"></i> Samuel</td>
                    <td><i class="fa fa-user text-success me-1"></i> Peter John</td>
                    <td>$8.20</td>
                    <td><span class="badge bg-danger">Cancelled</span></td>
                    <td>1 hour ago</td>
                </tr>
            </tbody>

        </table>
    </div>
</div>


<!-- ===================== -->
<!--   Driver Performance   -->
<!-- ===================== -->
<div class="card shadow-sm border-0 p-4 mb-4">
    <h5 class="fw-bold mb-3">Top Performing Drivers</h5>

    <div class="table-responsive">
        <table class="table table-striped align-middle mobile-friendly">
            <thead class="table-light">
                <tr>
                    <th>Driver</th>
                    <th>Completed Rides</th>
                    <th>Rating</th>
                    <th>Earnings</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td><i class="fa fa-user-circle text-primary me-2"></i> Umar Bello</td>
                    <td>142</td>
                    <td>
                        <span class="text-warning">
                            ★★★★☆
                        </span>
                    </td>
                    <td>$1,280</td>
                </tr>

                <tr>
                    <td><i class="fa fa-user-circle text-primary me-2"></i> David Yang</td>
                    <td>120</td>
                    <td>
                        <span class="text-warning">
                            ★★★★★
                        </span>
                    </td>
                    <td>$1,540</td>
                </tr>

            </tbody>
        </table>
    </div>
</div>


<!-- ===================== -->
<!--   Heatmap Placeholder  -->
<!-- ===================== -->
<div class="card shadow-sm border-0 p-4 mb-4">
    <h5 class="fw-bold mb-3">Activity Heatmap (Dummy)</h5>
    <div class="text-center py-5 text-muted fst-italic">
        <i class="fa fa-map fs-1 mb-3 d-block"></i>
        Heatmap Placeholder — Driver Activity Across the City
    </div>
</div>
