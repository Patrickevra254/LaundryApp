{{-- {{ dd(Route::has('items')) }} --}}

<!-- Sidebar -->
{{-- <aside class="sidebar d-flex flex-column p-3">

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


        <!-- Laundry Items  -->
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
</aside> --}}


{{-- <style>
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
</style> --}}

<!-- Sidebar -->
<aside class="sidebar d-flex flex-column p-3">

    <!-- Brand -->
    <div class="sidebar-brand mb-3 d-flex d-lg-none align-items-center gap-2 text-decoration-none ">
        <div class="brand-icon"><i class="fa fa-tshirt"></i></div>
        <span class="brand-name">LaundryPro</span>

    </div>

    <ul class="nav flex-column mb-auto gap-1 mt-2">

        <li><a href="{{ route('admin-dashboard') }}" class="s-link" hx-target="#content-area" hx-swap="innerHTML"
                hx-push-url="true" hx-indicator=".htmx-indicator"><i class="fa fa-home"></i><span>Dashboard</span></a>
        </li>


        @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
            <li>
                <a href="#userManagementMenu" class="s-link" data-bs-toggle="collapse">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                    <i class="fa fa-chevron-down ms-auto chev"></i>
                </a>
                <ul class="collapse nav flex-column ms-1 mt-1 gap-1" id="userManagementMenu">
                    @if (auth()->user()->hasAnyRole(['superAdmin']))
                        <li><a href="{{ route('superAdmin') }}" class="s-link s-sub" hx-get="{{ route('superAdmin') }}"
                                hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true"
                                hx-indicator=".htmx-indicator"><i class="fa fa-user-shield"></i> SuperAdmins</a></li>
                    @endif
                    @if (auth()->user()->hasAnyRole(['admin', 'superAdmin']))
                        <li><a href="{{ route('admin') }}" class="s-link s-sub" hx-get="{{ route('admin') }}"
                                hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true"
                                hx-indicator=".htmx-indicator"><i class="fa fa-user-cog"></i> Admins</a></li>
                    @endif

                    @if (auth()->user()->hasAnyRole(['admin', 'superAdmin', 'staff']))
                        <li><a href="{{ route('customer') }}" class="s-link s-sub" hx-get="{{ route('customer') }}"
                                hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true"
                                hx-indicator=".htmx-indicator"><i class="fa fa-users"></i> Customers</a></li>
                        <li><a href="{{ route('staff') }}" class="s-link s-sub" hx-get="{{ route('staff') }}"
                                hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true"
                                hx-indicator=".htmx-indicator"><i class="fa fa-id-badge"></i> Staff</a></li>
                    @endif
                </ul>
            </li>
        @endif

        <li><a href="{{ route('items') }}" class="s-link" hx-get="{{ route('items') }}" hx-target="#content-area"
                hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator"><i
                    class="fa fa-shirt"></i><span>Laundry Items</span></a></li>
        <li><a href="{{ route('bookLaundry') }}" class="s-link" hx-get="{{ route('bookLaundry') }}"
                hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator"><i
                    class="fa fa-calendar-plus"></i><span>Book Laundry</span></a></li>
        <li><a href="{{ route('orderTrack') }}" class="s-link" hx-get="{{ route('orderTrack') }}"
                hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator"><i
                    class="fa fa-route"></i><span>Orders & Tracking</span></a></li>
        <li><a href="{{ route('history') }}" class="s-link" hx-get="{{ route('history') }}" hx-target="#content-area"
                hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator"><i
                    class="fa fa-clock-rotate-left"></i><span>History</span></a></li>
        @if (auth()->user()->hasAnyRole(['admin', 'superAdmin']))
            <li><a href="{{ route('payments') }}" class="s-link" hx-get="{{ route('payments') }}"
                    hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator"><i
                        class="fa fa-credit-card"></i><span>Payments</span></a></li>
        @endif
        <li><a href="{{ route('notifications') }}" class="s-link" hx-get="{{ route('notifications') }}"
                hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator"><i
                    class="fa fa-bell"></i><span>Notifications</span></a></li>

        <li class="s-divider"></li>

        <li>
            <a href="#settingsMenu" class="s-link" data-bs-toggle="collapse">
                <i class="fa fa-gear"></i>
                <span>Settings</span>
                <i class="fa fa-chevron-down ms-auto chev"></i>
            </a>
            <ul class="collapse nav flex-column ms-1 mt-1 gap-1" id="settingsMenu">
                <li><a href="{{ route('profile') }}" class="s-link s-sub" hx-get="{{ route('profile') }}"
                        hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true"
                        hx-indicator=".htmx-indicator"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="{{ route('preferences') }}" class="s-link s-sub" hx-get="{{ route('preferences') }}"
                        hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true"
                        hx-indicator=".htmx-indicator"><i class="fa fa-sliders"></i> Preferences</a></li>
            </ul>
        </li>

        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="s-link s-logout w-100">
                    <i class="fa fa-arrow-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>

    </ul>
</aside>

<style>
    /* Brand */
    .sidebar-brand {
        padding: .4rem .3rem .8rem;
        border-bottom: 1px solid #f0f0f8;
    }

    .brand-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .8rem;
        flex-shrink: 0;
    }

    .brand-name {
        font-size: .95rem;
        font-weight: 700;
        color: #0f0f1a;
        letter-spacing: -.01em;
    }

    /* Links */
    .s-link {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: .55rem .75rem;
        border-radius: 9px;
        color: #4b5563;
        font-size: .85rem;
        font-weight: 500;
        text-decoration: none;
        border: none;
        background: none;
        cursor: pointer;
        transition: all .15s;
        width: 100%;
    }

    .s-link i {
        width: 16px;
        text-align: center;
        font-size: .85rem;
        flex-shrink: 0;
    }

    .s-link:hover {
        background: #ced2dd !important;
        color: #4f46e5 !important;
    }

    .s-link.active {
        background: #4f46e5;
        color: #eef2ff;
        font-weight: 600;
    }

    .s-link.active:hover {
        color: #4f46e5;
        background: #acb6d6;
        font-weight: 600;
    }

    /* Submenu */
    .s-sub {
        font-size: .82rem;
        padding: .45rem .75rem;
        color: #6b7280;
    }

    .s-sub:hover {
        color: #4f46e5;
    }

    /* Chevron */
    .chev {
        font-size: .6rem;
        opacity: .5;
        transition: transform .2s;
    }

    .s-link[aria-expanded="true"] .chev {
        transform: rotate(180deg);
    }

    /* Divider */
    .s-divider {
        height: 1px;
        background: #f0f0f8;
        margin: .4rem 0;
    }

    /* Logout */
    .s-logout {
        color: #dc2626 !important;
    }

    .s-logout:hover {
        background: #fff5f5 !important;
        color: #b91c1c !important;
    }
</style>


<script>
    function setActiveLink() {
        let current = window.location.pathname;

        document.querySelectorAll('.s-link').forEach(link => {
            link.classList.remove('active');

            let href = link.getAttribute('href');
            if (href && current === new URL(href, window.location.origin).pathname) {
                link.classList.add('active');
            }
        });
    }

    // Run on first load
    document.addEventListener("DOMContentLoaded", setActiveLink);

    // Run after HTMX loads new content
    document.body.addEventListener("htmx:afterSwap", setActiveLink);
</script>
