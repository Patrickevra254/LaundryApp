<!-- Sidebar -->
<aside class="sidebar d-flex flex-column p-3">

    <div class="sidebar-header text-center">
        <a href="{{ route('admin') }}" class="d-flex align-items-center justify-content-center text-decoration-none">
            <i class="fa fa-home fa-lg me-2"></i>
            <span class="fs-5 fw-bold d-md-inline">Dashboard</span>
        </a>
    </div>

    <ul class="nav nav-pills flex-column mb-auto">
        {{-- Users: superAdmin + admin --}}
        @role('superAdmin|admin')
            <li>
                <a href="{{ route('users') }}" class="nav-link" hx-get="{{ route('users') }}" hx-target="#content-area"
                    hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                    <i class="fa fa-users me-2"></i>
                    <span class="d-md-inline">Customers</span>
                </a>
            </li>
        @endrole

        {{-- Reports: superAdmin + admin + driver --}}
        @role('superAdmin|admin|driver')
            <li>
                <a href="{{ route('report') }}" class="nav-link" hx-get="{{ route('report') }}" hx-target="#content-area"
                    hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                    <i class="fa fa-book me-2"></i>
                    <span class="d-md-inline">Reports</span>
                </a>
            </li>
        @endrole

        {{-- Roles: superAdmin only --}}
        @role('superAdmin')
            <li>
                <a href="{{ route('roles') }}" class="nav-link" hx-get="{{ route('roles') }}" hx-target="#content-area"
                    hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                    <i class="fa fa-chart-line me-2"></i>
                    <span class="d-md-inline">Roles</span>
                </a>
            </li>
        @endrole

        {{-- Notifications: everyone --}}
        <li>
            <a href="{{ route('notifications') }}" class="nav-link" hx-get="{{ route('notifications') }}"
                hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                <i class="fa fa-bell me-2"></i>
                <span class="d-md-inline">Notifications</span>
            </a>
        </li>

        {{-- Assignments: superAdmin + admin + driver --}}
        @role('superAdmin|admin|driver')
            <li>
                <a href="{{ route('assignments') }}" class="nav-link" hx-get="{{ route('assignments') }}"
                    hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                    <i class="fa fa-tasks me-2"></i>
                    <span class="d-md-inline">Assignments</span>
                </a>
            </li>
        @endrole


        {{-- Drivers: superAdmin + admin + driver --}}
        @role('superAdmin|admin|driver')
            <li>
                <a href="{{ route('drivers') }}" class="nav-link" hx-get="{{ route('drivers') }}"
                    hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                    <i class="fa fa-motorcycle me-2"></i>
                    {{-- <i class="fa fa-truck me-2"></i> --}}
                    <span class="d-md-inline">Drivers</span>
                </a>
            </li>
        @endrole


        {{-- Bikes: superAdmin + admin + driver --}}
        @role('superAdmin|admin|driver')
            <li>
                <a href="{{ route('bikes') }}" class="nav-link" hx-get="{{ route('bikes') }}" hx-target="#content-area"
                    hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                    <i class="fa fa-motorcycle me-2"></i>
                    <span class="d-md-inline">Bikes</span>
                </a>
            </li>
        @endrole


        {{-- Orders: everyone except driver? --}}
        @role('superAdmin|admin|driver|customer')
            <li>
                <a href="{{ route('orders') }}" class="nav-link" hx-get="{{ route('orders') }}" hx-target="#content-area"
                    hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                    <i class="fa fa-shopping-cart me-2"></i>
                    <span class="d-md-inline">Orders</span>
                </a>
            </li>
        @endrole


        {{-- Support Tickets: superAdmin + admin + customer --}}
        @role('superAdmin|admin|customer')
            <li>
                <a href="{{ route('support-tickets') }}" class="nav-link" hx-get="{{ route('support-tickets') }}"
                    hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                    <i class="fa fa-life-ring me-2"></i>
                    <span class="d-md-inline">Support Tickets</span>
                </a>
            </li>
        @endrole


        {{-- Payments: superAdmin + admin + customer --}}
        @role('superAdmin|admin|customer')
            <li>
                <a href="{{ route('payments') }}" class="nav-link" hx-get="{{ route('payments') }}"
                    hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                    <i class="fa fa-credit-card me-2"></i>
                    <span class="d-md-inline">Payments</span>
                </a>
            </li>
        @endrole


        {{-- Messages: everyone except maybe customer only sees some? for now all --}}
        @role('superAdmin|admin|driver|customer')
            <li>
                <a href="{{ route('messages') }}" class="nav-link" hx-get="{{ route('messages') }}"
                    hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                    <i class="fa fa-envelope me-2"></i> <span class="d-md-inline">Messages</span>
                </a>
            </li>
        @endrole

        {{-- Analytics: superAdmin + admin --}}
        @role('superAdmin|admin')
            <li>
                <a href="{{ route('analytics') }}" class="nav-link" hx-get="{{ route('analytics') }}"
                    hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                    <i class="fa fa-bar-chart me-2"></i> <span class="d-md-inline">Analytics</span>
                </a>
            </li>
        @endrole

        {{-- Certificates: superAdmin + customer --}}
        @role('superAdmin|customer')
            <li>
                <a href="{{ route('certificate') }}" class="nav-link" hx-get="{{ route('certificate') }}"
                    hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                    <i class="fa fa-certificate me-2"></i> <span class="d-md-inline">Certificates</span>
                </a>
            </li>
            {{-- <li>
                <a href="#" class="nav-link">
                    <i class="fa fa-certificate me-2"></i>
                    <span class="d-md-inline">Certificates</span>
                </a>
            </li> --}}
        @endrole

        <!-- Settings with submenu (everyone) -->
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

                {{-- <li><a href="{{ route('profile') }}" class="nav-link">Profile</a></li>
                <li><a href="{{ route('preferences') }}" class="nav-link">Preferences</a></li> --}}
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



{{-- <!-- Sidebar -->
<aside class="sidebar d-flex flex-column p-3">
    <div class="sidebar-header  text-center me-5">
        <a href="{{ route('admin') }}" class="d-flex align-items-center justify-content-center text-decoration-none">
            <i class="fa fa-home fa-lg me-2"></i>
            <span class="fs-5 fw-bold  d-lg-inline">Dashboard</span>
        </a>
    </div>

    <ul class="nav nav-pills flex-column mb-auto">

        <li>
            <a href="{{ route('users') }}" class="nav-link" hx-get="{{ route('users') }}" hx-target="#content-area"
                hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                <i class="fa fa-users me-2"></i>
                <span class="d-lg-inline">Users</span>
            </a>
        </li>

        <li>
            <a href="{{ route('report') }}" class="nav-link" hx-get="{{ route('report') }}" hx-target="#content-area"
                hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                <i class="fa fa-book me-2"></i>
                <span class="d-lg-inline">Reports</span>
            </a>
        </li>

        <li>
            <a href="{{ route('roles') }}" class="nav-link" hx-get="{{ route('roles') }}" hx-target="#content-area"
                hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                <i class="fa fa-chart-line me-2"></i>
                <span class="d-lg-inline">Roles</span>
            </a>
        </li>

        <li>
            <a href="{{ route('notifications') }}" class="nav-link" hx-get="{{ route('notifications') }}"
                hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                <i class="fa fa-bell me-2"></i>
                <span class="d-lg-inline">Notifications</span>
            </a>
        </li>

        <li>
            <a href="#settingsSubmenu" class="nav-link" data-bs-toggle="collapse">
                <i class="fa fa-cog me-2"></i>
                <span class="d-lg-inline">Settings</span>
                <i class="fa fa-chevron-down ms-auto d-lg-inline"></i>
            </a>

            <ul class="collapse nav flex-column ms-2" id="settingsSubmenu">

                <li>
                    <a href="{{ route('profile') }}" class="nav-link" hx-get="{{ route('profile') }}"
                        hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                        Profile
                    </a>
                </li>

                <li>
                    <a href="{{ route('preferences') }}" class="nav-link" hx-get="{{ route('preferences') }}"
                        hx-target="#content-area" hx-swap="innerHTML" hx-push-url="true" hx-indicator=".htmx-indicator">
                        Preferences
                    </a>
                </li>

            </ul>
        </li>


        <li>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button class="nav-link text-danger">
                    <i class="fa fa-sign-out-alt me-2"></i>
                    <span class="d-lg-inline">Logout</span>
                </button>

            </form>
        </li>


    </ul>
</aside>

<style>
    .nav li {
        margin: 5px !important;
    }
</style> --}}

<!-- Sidebar -->
{{-- <aside class="sidebar d-flex flex-column p-3">

    <!-- Logo / Dashboard Header -->
    <div class="sidebar-header text-center mb-4">
        <a href="{{ route('admin') }}" class="d-flex align-items-center justify-content-center text-decoration-none">
            <i class="fa fa-home fa-lg me-2"></i>
            <span class="fs-5 fw-bold d-md-inline">Dashboard</span>
        </a>
    </div>

    <!-- Navigation -->
    <ul class="nav nav-pills flex-column mb-auto">

        <li>
            <a href="{{ route('users') }}"
               class="nav-link"
               hx-get="{{ route('users') }}"
               hx-target="#content-area"
               hx-swap="innerHTML"
               hx-push-url="true"
               hx-indicator=".htmx-indicator">
                <i class="fa fa-users me-2"></i>
                <span class="d-md-inline">Users</span>
            </a>
        </li>

        <li>
            <a href="{{ route('report') }}"
               class="nav-link"
               hx-get="{{ route('report') }}"
               hx-target="#content-area"
               hx-swap="innerHTML"
               hx-push-url="true"
               hx-indicator=".htmx-indicator">
                <i class="fa fa-book me-2"></i>
                <span class="d-md-inline">Reports</span>
            </a>
        </li>

        <li>
            <a href="{{ route('roles') }}"
               class="nav-link"
               hx-get="{{ route('roles') }}"
               hx-target="#content-area"
               hx-swap="innerHTML"
               hx-push-url="true"
               hx-indicator=".htmx-indicator">
                <i class="fa fa-chart-line me-2"></i>
                <span class="d-md-inline">Roles</span>
            </a>
        </li>

        <li>
            <a href="{{ route('notifications') }}"
               class="nav-link"
               hx-get="{{ route('notifications') }}"
               hx-target="#content-area"
               hx-swap="innerHTML"
               hx-push-url="true"
               hx-indicator=".htmx-indicator">
                <i class="fa fa-bell me-2"></i>
                <span class="d-md-inline">Notifications</span>
            </a>
        </li>

        <!-- Settings with submenu -->
        <li>
            <a href="#settingsMenu"
               class="nav-link d-flex align-items-center"
               data-bs-toggle="collapse">
                <i class="fa fa-cog me-2"></i>
                <span class="d-md-inline">Settings</span>
                <i class="fa fa-chevron-down ms-auto"></i>
            </a>

            <ul class="collapse nav flex-column ms-2" id="settingsMenu">

                <li>
                    <a href="{{ route('profile') }}"
                       class="nav-link"
                       hx-get="{{ route('profile') }}"
                       hx-target="#content-area"
                       hx-swap="innerHTML"
                       hx-push-url="true"
                       hx-indicator=".htmx-indicator">
                        Profile
                    </a>
                </li>

                <li>
                    <a href="{{ route('preferences') }}"
                       class="nav-link"
                       hx-get="{{ route('preferences') }}"
                       hx-target="#content-area"
                       hx-swap="innerHTML"
                       hx-push-url="true"
                       hx-indicator=".htmx-indicator">
                        Preferences
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
