<!-- Sidebar -->
<aside class="sidebar d-flex flex-column p-3">

    <div class="sidebar-header text-center">
        <a href="{{ route('admin-dashboard') }}"
            class="d-flex align-items-center justify-content-center text-decoration-none">
            <i class="fa fa-home fa-lg me-2"></i>
            <span class="fs-5 fw-bold d-md-inline">Dashboard</span>
        </a>
    </div>

    <ul class="nav nav-pills flex-column mb-auto">
        @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
            <!-- User Management Dropdown -->
            <li>
                <a href="#userManagementMenu" class="nav-link d-flex align-items-center" data-bs-toggle="collapse">
                    <i class="fa fa-users-cog me-2"></i>
                    <span class="d-md-inline">Users</span>
                    <i class="fa fa-chevron-down ms-auto"></i>
                </a>

                <ul class="collapse nav flex-column ms-2" id="userManagementMenu">
                    <li>
                        <a href="{{ route('superAdmin') }}" class="nav-link" hx-get="{{ route('superAdmin') }}"
                            hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true"
                            hx-indicator=".htmx-indicator">
                            <i class="fa fa-user-shield me-2"></i> <span class="d-md-inline">SuperAdmins</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin') }}" class="nav-link" hx-get="{{ route('admin') }}"
                            hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true"
                            hx-indicator=".htmx-indicator">
                            <i class="fa fa-user-cog me-2"></i> <span class="d-md-inline">Admins</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customer') }}" class="nav-link" hx-get="{{ route('customer') }}"
                            hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true"
                            hx-indicator=".htmx-indicator">
                            <i class="fa fa-users me-2"></i> <span class="d-md-inline">Customers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('staff') }}" class="nav-link" hx-get="{{ route('staff') }}"
                            hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true"
                            hx-indicator=".htmx-indicator">
                            <i class="fa fa-users me-2"></i> <span class="d-md-inline">Staffs</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif


        {{-- Laundry Items --}}
        <li>
            <a href="{{ route('items') }}" class="nav-link" hx-get="{{ route('items') }}" hx-target="#content-area"
                hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                <i class="fa fa-book me-2"></i>
                <span class="d-md-inline">Laundry Items</span>
            </a>
        </li>

        <!-- Other sidebar items -->
        <li>
            <a href="{{ route('bookLaundry') }}" class="nav-link" hx-get="{{ route('bookLaundry') }}"
                hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                <i class="fa fa-tshirt me-2"></i>
                <span class="d-md-inline">Book Laundry</span>
            </a>
        </li>

        <li>
            <a href="{{ route('orderTrack') }}" class="nav-link" hx-get="{{ route('orderTrack') }}"
                hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                <i class="fa fa-route me-2"></i>
                <span class="d-md-inline">Orders & Tracking</span>
            </a>
        </li>

        <!--  History, Payments, Notifications -->


        <li>
            <a href="{{ route('history') }}" class="nav-link" hx-get="{{ route('history') }}"
                hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                <i class="fa fa-chart-line me-2"></i>
                <span class="d-md-inline">History</span>
            </a>
        </li>

        <li>
            <a href="{{ route('payments') }}" class="nav-link" hx-get="{{ route('payments') }}"
                hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                <i class="fa fa-credit-card me-2"></i>
                <span class="d-md-inline">Payments</span>
            </a>
        </li>

        <li>
            <a href="{{ route('notifications') }}" class="nav-link" hx-get="{{ route('notifications') }}"
                hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                <i class="fa fa-bell me-2"></i>
                <span class="d-md-inline">Notifications</span>
            </a>
        </li>

        <!-- Settings Dropdown (same as before) -->
        <li>
            <a href="#settingsMenu" class="nav-link d-flex align-items-center" data-bs-toggle="collapse">
                <i class="fa fa-cog me-2"></i>
                <span class="d-md-inline">Settings</span>
                <i class="fa fa-chevron-down ms-auto"></i>
            </a>

            <ul class="collapse nav flex-column ms-2" id="settingsMenu">
                <li>
                    <a href="{{ route('profile') }}" class="nav-link" hx-get="{{ route('profile') }}"
                        hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true"
                        hx-indicator=".htmx-indicator">
                        <i class="fa fa-user me-2"></i> <span class="d-md-inline">Profile</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('preferences') }}" class="nav-link" hx-get="{{ route('preferences') }}"
                        hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true"
                        hx-indicator=".htmx-indicator">
                        <i class="fa fa-sliders-h me-2"></i> <span class="d-md-inline">Preferences</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Logout -->
        <li class="mt-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="nav-link text-danger w-100 text-start">
                    <i class="fa fa-sign-out-alt me-2"></i>
                    <span class="d-md-inline">Logout</span>
                </button>
            </form>
        </li>

    </ul>
</aside>


<style>
    /* ===============================
   Sidebar – Subtle Upgrade
================================ */

    .sidebar {
        /* min-height: 100vh; */
    }

    /* Header */
    .sidebar-header a {
        color: #212529;
    }

    .sidebar-header i {
        color: #0d6efd;
    }

    /* Main nav links */
    .sidebar .nav-link {
        color: #495057;
        border-radius: 8px;
        padding: 0.6rem 0.85rem;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    /* Hover (clean, sharp) */
    .sidebar .nav-link:hover {
        background-color: rgba(13, 110, 253, 0.08);
        color: #0d6efd;
    }

    /* Active link */
    .sidebar .nav-link.active {
        background-color: rgba(13, 110, 253, 0.15);
        color: #0d6efd;
        font-weight: 600;
    }

    /* Icons */
    .sidebar .nav-link i {
        width: 18px;
        text-align: center;
        font-size: 0.9rem;
        opacity: 0.85;
    }

    /* Dropdown chevron */
    .sidebar .fa-chevron-down {
        font-size: 0.65rem;
        transition: transform 0.25s ease;
    }

    /* Rotate chevron when open */
    .sidebar a[aria-expanded="true"] .fa-chevron-down {
        transform: rotate(180deg);
    }

    /* Submenu */
    .sidebar ul.collapse .nav-link {
        padding-left: 2.4rem;
        font-size: 0.9rem;
        opacity: 0.9;
    }

    /* Submenu hover */
    .sidebar ul.collapse .nav-link:hover {
        opacity: 1;
    }

    /* Logout */
    .sidebar .text-danger {
        transition: background-color 0.2s ease;
    }

    .sidebar .text-danger:hover {
        background-color: rgba(220, 53, 69, 0.08);
    }
</style>
