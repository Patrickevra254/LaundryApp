<div class="table-responsive">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="fw-bold mb-0">Bikes</h2>
        <button class="btn btn-primary">
            <i class="fa fa-plus"></i> Add New Bike
        </button>
    </div>

    <table class="table table-striped align-middle mobile-friendly">
        <thead>
            <tr>
                <th>ID</th>
                <th>Bike Model</th>
                <th>Plate Number</th>
                <th>Assigned Driver</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach([1, 2, 3, 4] as $i)
                <tr>
                    <td>{{ $i }}</td>

                    <td>
                        @if($i % 2 == 0)
                            Honda Ace {{ 100 + $i }}
                        @else
                            TVS Star {{ 200 + $i }}
                        @endif
                    </td>

                    <td>AGL-{{ 3450 + $i }}</td>

                    <td>
                        Driver {{ $i }}
                    </td>

                    <td>
                        @if($i == 1)
                            <span class="badge bg-success">Available</span>
                        @elseif($i == 2)
                            <span class="badge bg-info">In Use</span>
                        @else
                            <span class="badge bg-warning text-dark">Maintenance</span>
                        @endif
                    </td>

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
