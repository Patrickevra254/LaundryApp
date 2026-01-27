<div class="table-responsive">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="fw-bold mb-0">Assignments</h2>
        <button class="btn btn-primary">
            <i class="fa fa-plus"></i> New Assignment
        </button>
    </div>

    <table class="table table-striped align-middle mobile-friendly">
        <thead>
            <tr>
                <th>ID</th>
                <th>Driver</th>
                <th>Task</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach([1,2,3,4] as $i)
                <tr>
                    <td>{{ $i }}</td>
                    <td>Driver {{ $i }}</td>
                    <td>
                        @if($i % 2 == 0)
                            Delivery
                        @else
                            Pickup
                        @endif
                    </td>

                    <td>
                        @if($i == 1)
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($i == 2)
                            <span class="badge bg-info">In Progress</span>
                        @else
                            <span class="badge bg-success">Completed</span>
                        @endif
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
</div>
