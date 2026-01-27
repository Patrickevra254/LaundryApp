<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Messages</h2>
        <button class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> New Message
        </button>
    </div>

    {{-- Main Content Area --}}
    <div class="row g-4">

        {{-- Left Sidebar (Dummy) --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Conversations</h5>
                </div>
                <div class="card-body p-0">

                    {{-- Dummy Conversation Items --}}
                    <ul class="list-group list-group-flush">

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>John Doe</strong>
                                <p class="text-muted small mb-0">Hey, are we still meeting?</p>
                            </div>
                            <span class="badge bg-primary rounded-pill">2</span>
                        </li>

                        <li class="list-group-item">
                            <strong>Mary Adams</strong>
                            <p class="text-muted small mb-0">Thanks for the update.</p>
                        </li>

                        <li class="list-group-item">
                            <strong>Support</strong>
                            <p class="text-muted small mb-0">Your ticket has been received.</p>
                        </li>

                    </ul>

                </div>
            </div>
        </div>

        {{-- Right Chat Window --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Chat Window</h5>
                </div>

                <div class="card-body" style="height: 350px; overflow-y: auto;">

                    {{-- Dummy Chat Messages --}}
                    <div class="mb-3">
                        <p><strong>John Doe:</strong></p>
                        <div class="p-3 bg-light rounded mb-2">
                            Hey! Just checking in about the meeting tomorrow.
                        </div>
                    </div>

                    <div class="mb-3 text-end">
                        <p><strong>You:</strong></p>
                        <div class="p-3 bg-primary text-white rounded mb-2 d-inline-block">
                            Yes, it’s still on. See you at 10am.
                        </div>
                    </div>

                    <div>
                        <p><strong>John Doe:</strong></p>
                        <div class="p-3 bg-light rounded mb-2">
                            Great, thanks!
                        </div>
                    </div>

                </div>

                <div class="card-footer bg-white">
                    <form class="d-flex">
                        <input type="text" class="form-control me-2" placeholder="Type a message...">
                        <button class="btn btn-primary">
                            <i class="bi bi-send"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>


{{-- second option --}}
{{--

<div class="mb-4 d-flex justify-content-between align-items-center flex-wrap">
    <h2 class="fw-bold mb-2 mb-md-0">Messages</h2>

    <button class="btn btn-primary">
        <i class="fa fa-paper-plane me-1"></i> Compose
    </button>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">

        <!-- Search Bar -->
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Search messages...">
            </div>

            <div class="col-md-6">
                <select class="form-select">
                    <option>Filter by Status</option>
                    <option>Read</option>
                    <option>Unread</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mobile-friendly">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th>Message</th>
                        <th>Sent At</th>
                        <th>Status</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td data-label="ID">1</td>
                        <td data-label="Sender">
                            <i class="fa fa-user-circle text-primary me-1"></i>
                            John Doe
                        </td>

                        <td data-label="Receiver">
                            <i class="fa fa-user-shield text-success me-1"></i>
                            Admin
                        </td>

                        <td data-label="Message" class="text-muted fst-italic">
                            "Hello, my ride was delayed..."
                        </td>

                        <td data-label="Sent At">2 hrs ago</td>

                        <td data-label="Status">
                            <span class="badge bg-warning text-dark">
                                <i class="fa fa-envelope-open me-1"></i>
                                Unread
                            </span>
                        </td>

                        <td data-label="Action">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td data-label="ID">2</td>
                        <td data-label="Sender">
                            <i class="fa fa-user-circle text-primary me-1"></i>
                            Sarah K
                        </td>

                        <td data-label="Receiver">
                            <i class="fa fa-user-shield text-success me-1"></i>
                            Admin
                        </td>

                        <td data-label="Message" class="text-muted fst-italic">
                            "Payment did not process..."
                        </td>

                        <td data-label="Sent At">1 day ago</td>

                        <td data-label="Status">
                            <span class="badge bg-success">
                                <i class="fa fa-check-circle me-1"></i>
                                Read
                            </span>
                        </td>

                        <td data-label="Action">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-eye"></i>
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
</div> --}}
