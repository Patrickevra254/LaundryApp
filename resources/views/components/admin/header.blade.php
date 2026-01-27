{{-- <!-- Header / Topbar -->
<header class="header d-flex justify-content-between align-items-center px-4 py-3 shadow-sm">

    <!-- LEFT: Sidebar Toggle + Title -->
    <div class="d-flex align-items-center gap-3">

        <!-- Mobile sidebar toggle -->
        <button class="btn btn-outline-secondary d-md-none" id="sidebarToggle">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Dashboard Title (hidden on small screens) -->
        <h1 class="h5 mb-0 fw-semibold text-truncate d-none d-md-block text-dark">
            Admin Dashboard
        </h1>
    </div>

    <!-- CENTER: Search Bar -->
    <form class="d-none d-md-flex flex-grow-1 mx-4" role="search">
        <div class="input-group">
            <input type="search" class="form-control rounded-start" placeholder="Search...">
            <button class="btn btn-primary rounded-end" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </form>

    <!-- RIGHT ACTIONS -->
    <div class="d-flex align-items-center gap-3">

        <!-- Theme Toggle -->
        <a href="{{ route('preferences') }}" hx-get="{{ route('preferences') }}" hx-target="#content-area"
            hx-push-url="true" hx-indicator=".htmx-indicator">

            <button class="btn btn-outline-secondary" id="themeToggle">
                <i class="fa fa-moon"></i>
            </button>
        </a>

        <!-- Notifications -->
        <div class="dropdown">
            <button class="btn btn-outline-secondary position-relative" data-bs-toggle="dropdown">
                <i class="fa fa-bell"></i>
                <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle">3</span>
            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li><a class="dropdown-item" href="#">New user registered</a></li>
                <li><a class="dropdown-item" href="#">Server CPU high</a></li>
                <li><a class="dropdown-item" href="#">New comment received</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <a class="dropdown-item text-center" href="{{ route('notifications') }}"
                        hx-get="{{ route('notifications') }}" hx-target="#content-area" hx-push-url="true"
                        hx-indicator=".htmx-indicator">
                        View all
                    </a>
                </li>
            </ul>
        </div>

        <!-- Profile Dropdown -->
        <div class="dropdown">
            <button class="btn btn-outline-secondary d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}" class="rounded-circle"
                    width="35" height="35">

                <span class="d-none d-md-inline">
                    {{ auth()->user()->name ?? 'Admin' }}
                </span>
            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li>
                    <a class="dropdown-item" href="{{ route('profile') }}" hx-get="{{ route('profile') }}"
                        hx-target="#content-area" hx-push-url="true" hx-indicator=".htmx-indicator">
                        Profile
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header> --}}

<header class="header d-flex justify-content-between align-items-center px-3 px-md-4 py-3 shadow-sm">

    <!-- Left Section -->
    <div class="d-flex align-items-center gap-3">

        <!-- Sidebar Toggle (Mobile & Tablet) -->
        <button class="btn btn-outline-secondary d-md-none" id="sidebarToggle">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Page Title -->
        <h1 class="h5 mb-0 fw-semibold text-truncate d-none d-md-block text-dark">
            Admin Dashboard
        </h1>
    </div>

    <!-- Search Bar (Desktop only) -->
    <form class="d-none d-lg-flex flex-grow-1 mx-4" role="search">
        <div class="input-group">
            <input type="search" class="form-control rounded-start" placeholder="Search...">
            <button class="btn btn-primary rounded-end" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </form>

    <!-- Right Section -->
    <div class="d-flex align-items-center gap-3">

        <!-- Theme Toggle -->
        <a href="{{ route('preferences') }}" hx-get="{{ route('preferences') }}" hx-target="#content-area"
            hx-push-url="true" hx-indicator=".htmx-indicator">

            <button class="btn btn-outline-secondary">
                <i class="fa fa-moon"></i>
            </button>
        </a>

        <!-- Notifications -->
        <div class="dropdown">
            <button class="btn btn-outline-secondary position-relative" data-bs-toggle="dropdown">
                <i class="fa fa-bell"></i>
                {{-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span> --}}
                @php
                    $unreadCount = auth()->user()->unreadNotifications()->count();
                @endphp

                @if ($unreadCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $unreadCount }}
                    </span>
                @endif

            </button>

            {{-- <ul class="dropdown-menu dropdown-menu-end shadow">
                <li><a class="dropdown-item" href="#">New user registered</a></li>
                <li><a class="dropdown-item" href="#">Server CPU high</a></li>
                <li><a class="dropdown-item" href="#">New comment received</a></li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <a class="dropdown-item text-center" href="{{ route('notifications') }}"
                        hx-get="{{ route('notifications') }}" hx-target="#content-area" hx-push-url="true"
                        hx-indicator=".htmx-indicator">
                        View all
                    </a>
                </li>
            </ul> --}}
            <ul class="dropdown-menu dropdown-menu-end shadow" style="width: 320px">

                @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                    <li>
                        <a class="dropdown-item small" href="#">
                            <strong>{{ $notification->data['title'] }}</strong><br>
                            <span class="text-muted">
                                {{ $notification->data['message'] }}
                            </span>
                        </a>
                    </li>
                @empty
                    <li class="dropdown-item text-muted small text-center">
                        No new notifications
                    </li>
                @endforelse

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <a class="dropdown-item text-center" href="{{ route('notifications') }}"
                        hx-get="{{ route('notifications') }}" hx-target="#content-area" hx-push-url="true"
                        hx-indicator=".htmx-indicator">
                        View all
                    </a>
                </li>
            </ul>

        </div>

        <!-- Profile Menu -->
        <div class="dropdown">
            <button class="btn btn-outline-secondary d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}" class="rounded-circle"
                    width="40" height="40">

                <span class="d-none d-md-inline">
                    {{ auth()->user()->name ?? 'Admin' }}
                </span>
            </button>

            {{-- <ul class="dropdown-menu dropdown-menu-end shadow"> --}}
            <ul class="dropdown-menu dropdown-menu-end shadow notification-dropdown">


                <li>
                    <a class="dropdown-item" href="{{ route('profile') }}" hx-get="{{ route('profile') }}"
                        hx-target="#content-area" hx-push-url="true" hx-indicator=".htmx-indicator">
                        Profile
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</header>


<style>
    /* ================= HEADER ================= */
    /* Buttons */
    .header .btn {
        border-radius: 12px;
        transition: all 0.2s ease;
    }

    .header .btn-outline-secondary:hover {
        background: rgba(13, 110, 253, 0.08);
        border-color: #0d6efd;
        color: #0d6efd;
    }

    /* Search */
    .header .input-group .form-control {
        border-radius: 12px 0 0 12px;
    }

    .header .input-group .btn {
        border-radius: 0 12px 12px 0;
    }

    /* Profile image */
    .header img {
        object-fit: cover;
    }

    /* Dropdowns */
    .dropdown-menu {
        border-radius: 14px;
        border: none;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
        padding: 0.5rem 0;
    }

    /* Dropdown items */
    .dropdown-item {
        padding: 0.65rem 1rem;
        transition: background 0.15s ease;
    }

    .dropdown-item:hover {
        background: rgba(13, 110, 253, 0.08);
    }

    /* Notification badge */
    .header .badge {
        font-size: 0.65rem;
        padding: 0.35em 0.45em;
    }

    /* Mobile tweaks */
    @media (max-width: 768px) {
        .header {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
    }
</style>

<style>
    /* ================= NOTIFICATIONS ================= */
    .notification-dropdown {
        width: 340px;
        max-height: 420px;
        overflow-y: auto;
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
    }

    /* Scrollbar (nice & subtle) */
    .notification-dropdown::-webkit-scrollbar {
        width: 6px;
    }

    .notification-dropdown::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.15);
        border-radius: 10px;
    }

    /* Notification item */
    .notification-item {
        white-space: normal;
        line-height: 1.3;
    }

    /* Clamp text to 2 lines */
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
