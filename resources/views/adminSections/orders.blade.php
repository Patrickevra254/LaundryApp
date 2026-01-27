{{-- <div class="table-responsive">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="fw-bold mb-0">Orders</h2>
        <button class="btn btn-primary">
            <i class="fa fa-plus"></i> Add New Order
        </button>
    </div>

    <table class="table table-striped align-middle mobile-friendly">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Driver</th>
                <th>Pickup Location</th>
                <th>Drop-off Location</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach (range(1, 5) as $i)
                <tr>
                    <td>{{ $i }}</td>
                    <td>Customer {{ $i }}</td>
                    <td>Driver {{ $i }}</td>
                    <td>Location A{{ $i }}</td>
                    <td>Location B{{ $i }}</td>

                    <td>
                        @switch($i % 5)
                            @case(0)
                                <span class="badge bg-warning text-dark">Pending</span>
                            @break

                            @case(1)
                                <span class="badge bg-info">Accepted</span>
                            @break

                            @case(2)
                                <span class="badge bg-primary">On The Way</span>
                            @break

                            @case(3)
                                <span class="badge bg-success">Delivered</span>
                            @break

                            @case(4)
                                <span class="badge bg-danger">Cancelled</span>
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


<div class="mb-4 d-flex justify-content-between align-items-center flex-wrap">
    <h2 class="fw-bold mb-2 mb-md-0">Ride Orders</h2>

    <button class="btn btn-primary">
        <i class="fa fa-plus me-1"></i> Create Manual Order
    </button>
</div>


<!-- ===================== -->
<!--     Top Stats Cards   -->
<!-- ===================== -->
<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="card p-3 shadow-sm border-0">
            <h6 class="text-muted fw-bold">Total Orders</h6>
            <div class="d-flex justify-content-between align-items-center">
                <p class="fs-2 fw-bold">3,210</p>
                <i class="fa fa-list text-primary fs-3"></i>
            </div>
            <span class="text-success small">
                <i class="fa fa-arrow-up"></i> +10% this month
            </span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow-sm border-0">
            <h6 class="text-muted fw-bold">Completed</h6>
            <div class="d-flex justify-content-between align-items-center">
                <p class="fs-2 fw-bold">2,740</p>
                <i class="fa fa-check-circle text-success fs-3"></i>
            </div>
            <span class="text-success small">
                <i class="fa fa-arrow-up"></i> +6%
            </span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow-sm border-0">
            <h6 class="text-muted fw-bold">Cancelled</h6>
            <div class="d-flex justify-content-between align-items-center">
                <p class="fs-2 fw-bold">260</p>
                <i class="fa fa-times-circle text-danger fs-3"></i>
            </div>
            <span class="text-danger small">
                <i class="fa fa-arrow-down"></i> -3%
            </span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow-sm border-0">
            <h6 class="text-muted fw-bold">Ongoing</h6>
            <div class="d-flex justify-content-between align-items-center">
                <p class="fs-2 fw-bold">210</p>
                <i class="fa fa-motorcycle text-warning fs-3"></i>
            </div>
            <span class="text-warning small">
                <i class="fa fa-clock"></i> Real-time tracking
            </span>
        </div>
    </div>

</div>


<!-- ===================== -->
<!--   Search + Filters    -->
<!-- ===================== -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">

        <div class="row g-3">

            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Search order, customer or driver...">
            </div>

            <div class="col-md-3">
                <select class="form-select">
                    <option selected>Status (All)</option>
                    <option>Completed</option>
                    <option>Ongoing</option>
                    <option>Cancelled</option>
                    <option>Pending</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-select">
                    <option selected>Sort by</option>
                    <option>Newest First</option>
                    <option>Oldest First</option>
                    <option>Highest Amount</option>
                    <option>Lowest Amount</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    <i class="fa fa-filter me-1"></i> Filter
                </button>
            </div>

        </div>

    </div>
</div>


<!-- ===================== -->
<!--    Orders Table       -->
<!-- ===================== -->
<div class="card shadow-sm border-0">
    <div class="card-body">

        <h5 class="fw-bold mb-3">Recent Orders</h5>

        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mobile-friendly">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Driver</th>
                        <th>Pickup</th>
                        <th>Drop-off</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Requested</th>
                        <th width="140">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    <!-- Completed -->
                    <tr>
                        <td>#ORD-4521</td>
                        <td><i class="fa fa-user text-success me-1"></i> Sarah Doe</td>
                        <td><i class="fa fa-user text-primary me-1"></i> James Rider</td>
                        <td>Ring Road</td>
                        <td>Bodija Market</td>
                        <td>$14.00</td>
                        <td>
                            <span class="badge bg-success px-3 py-2">
                                <i class="fa fa-check-circle me-1"></i> Completed
                            </span>
                        </td>
                        <td>Today, 10:21 AM</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>

                    <!-- Ongoing -->
                    <tr>
                        <td>#ORD-4518</td>
                        <td><i class="fa fa-user text-success me-1"></i> Andrew Paul</td>
                        <td><i class="fa fa-user text-primary me-1"></i> Musa Danladi</td>
                        <td>Challenge</td>
                        <td>Dugbe</td>
                        <td>$10.50</td>
                        <td>
                            <span class="badge bg-warning text-dark px-3 py-2">
                                <i class="fa fa-motorcycle me-1"></i> Ongoing
                            </span>
                        </td>
                        <td>Today, 9:50 AM</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></button>
                        </td>
                    </tr>

                    <!-- Cancelled -->
                    <tr>
                        <td>#ORD-4509</td>
                        <td><i class="fa fa-user text-success me-1"></i> Emily West</td>
                        <td><i class="fa fa-user text-primary me-1"></i> —</td>
                        <td>Sango</td>
                        <td>UI Gate</td>
                        <td>$6.80</td>
                        <td>
                            <span class="badge bg-danger px-3 py-2">
                                <i class="fa fa-times-circle me-1"></i> Cancelled
                            </span>
                        </td>
                        <td>Yesterday, 6:30 PM</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>
</div>
