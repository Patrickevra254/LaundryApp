{{--

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
                @php
                    $unreadCount = auth()->user()->unreadNotifications()->count();
                @endphp

                @if ($unreadCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $unreadCount }}
                    </span>
                @endif

            </button>

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
</header> --}}


{{-- <style>
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
</style> --}}

<header class="header d-flex justify-content-between align-items-center px-3 px-md-4 py-3">

    <!-- Left Section -->
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-icon d-md-none" id="sidebarToggle">
            <i class="fa fa-bars"></i>
        </button>
        <div class="d-none d-md-flex align-items-center gap-2">
            <div class="header-brand-icon">
                <i class="fa fa-tshirt"></i>
            </div>
            <h1 class="h6 mb-0 fw-bold text-dark header-title">Tolbeel</h1>
        </div>
    </div>

    <!-- Search Bar (Desktop) -->
    <form class="d-none d-lg-flex flex-grow-1 mx-4" role="search">
        <div class="header-search w-100">
            <i class="fa fa-search search-icon"></i>
            <input type="search" class="form-control search-input" placeholder="Search orders, customers...">
        </div>
    </form>

    <!-- Right Section -->
    <div class="d-flex align-items-center gap-2">

        <!-- Theme Toggle -->
        <a href="{{ route('preferences') }}" hx-get="{{ route('preferences') }}" hx-target="#content-area"
            hx-push-url="true" hx-indicator=".htmx-indicator">
            <button class="btn btn-icon" title="Preferences">
                <i class="fa fa-moon"></i>
            </button>
        </a>

        <!-- Notifications -->
        <div class="dropdown">
            @php $unreadCount = auth()->user()->unreadNotifications()->count(); @endphp

            <button class="btn btn-icon position-relative" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell"></i>
                @if ($unreadCount > 0)
                    <span class="notif-badge">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                @endif
            </button>

            <div class="dropdown-menu dropdown-menu-end notif-dropdown shadow-lg">
                <!-- Dropdown Header -->
                <div class="notif-header d-flex justify-content-between align-items-center px-3 py-2">
                    <span class="fw-semibold text-dark" style="font-size: 0.85rem;">Notifications</span>
                    @if ($unreadCount > 0)
                        <span class="badge-pill-blue">{{ $unreadCount }} new</span>
                    @endif
                </div>

                <div class="notif-scroll-area">
                    @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                        <a class="notif-item d-flex align-items-start gap-2 px-3 py-2 text-decoration-none"
                            href="#">
                            <div class="notif-dot mt-1"></div>
                            <div class="notif-content overflow-hidden">
                                <div class="notif-title">{{ $notification->data['title'] }}</div>
                                <div class="notif-message">{{ $notification->data['message'] }}</div>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-4 px-3">
                            <i class="fa fa-bell-slash text-muted mb-2" style="font-size: 1.4rem;"></i>
                            <p class="text-muted mb-0" style="font-size: 0.8rem;">You're all caught up!</p>
                        </div>
                    @endforelse
                </div>

                <div class="notif-footer">
                    <a class="notif-view-all" href="{{ route('notifications') }}" hx-get="{{ route('notifications') }}"
                        hx-target="#content-area" hx-push-url="true" hx-indicator=".htmx-indicator">
                        View all notifications <i class="fa fa-arrow-right ms-1" style="font-size: 0.7rem;"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Profile Menu -->
        <div class="dropdown">
            <button class="btn btn-profile d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}&background=4f46e5&color=fff"
                    class="rounded-circle profile-avatar" width="34" height="34">
                <span class="d-none d-md-inline profile-name">{{ auth()->user()->name ?? 'Admin' }}</span>
                <i class="fa fa-chevron-down d-none d-md-inline" style="font-size: 0.65rem; opacity: 0.5;"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow-lg profile-dropdown">
                <li class="profile-menu-header px-3 py-2">
                    <div class="fw-semibold text-dark" style="font-size: 0.85rem;">
                        {{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="text-muted" style="font-size: 0.75rem;">{{ auth()->user()->email ?? '' }}</div>
                </li>
                <li>
                    <hr class="dropdown-divider my-1">
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('profile') }}"
                        hx-get="{{ route('profile') }}" hx-target="#content-area" hx-push-url="true"
                        hx-indicator=".htmx-indicator">
                        <i class="fa fa-user-circle text-muted" style="width:16px;"></i> Profile
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider my-1">
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item d-flex align-items-center gap-2 text-danger">
                            <i class="fa fa-sign-out" style="width:16px;"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</header>


<style>
    /* ============================================
       HEADER BASE
    ============================================ */
    .header {
        background: #ffffff;
        border-bottom: 1px solid #f0f0f5;
        position: sticky;
        top: 0;
        z-index: 1030;
    }

    .header-title {
        /* font-size: 0.95rem; */
        font-size: 1rem;
        letter-spacing: -0.01em;
    }

    .header-brand-icon {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 0.8rem;
    }

    /* ============================================
       ICON BUTTONS
    ============================================ */
    .btn-icon {
        width: 38px;
        height: 38px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        border: 1px solid #e8e8f0;
        background: #fafafc;
        color: #555;
        font-size: 0.9rem;
        transition: all 0.18s ease;
    }

    .btn-icon:hover {
        background: #eef0ff;
        border-color: #c7caff;
        color: #4f46e5;
    }

    /* ============================================
       SEARCH
    ============================================ */
    .header-search {
        position: relative;
    }

    .header-search .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
        font-size: 0.8rem;
        pointer-events: none;
        z-index: 5;
    }

    .header-search .search-input {
        border-radius: 10px;
        border: 1px solid #e8e8f0;
        background: #fafafc;
        padding-left: 36px;
        font-size: 0.85rem;
        height: 38px;
        transition: all 0.18s ease;
        box-shadow: none;
    }

    .header-search .search-input:focus {
        border-color: #a5b4fc;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.08);
    }

    /* ============================================
       NOTIFICATION BADGE
    ============================================ */
    .notif-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        background: #ef4444;
        color: #fff;
        font-size: 0.6rem;
        font-weight: 700;
        min-width: 17px;
        height: 17px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 4px;
        border: 2px solid #fff;
        line-height: 1;
    }

    /* ============================================
       NOTIFICATION DROPDOWN  — overflow fix
    ============================================ */
    .notif-dropdown {
        width: 340px;
        padding: 0;
        border-radius: 14px;
        border: 1px solid #f0f0f5;
        overflow: hidden;
        /* clips children to rounded corners */
    }

    .notif-header {
        border-bottom: 1px solid #f0f0f5;
        background: #fafafc;
    }

    .badge-pill-blue {
        background: #eef0ff;
        color: #4f46e5;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 999px;
    }

    /* Scrollable area — notifications stay inside the box */
    .notif-scroll-area {
        max-height: 280px;
        overflow-y: auto;
        overflow-x: hidden;
        /* prevents horizontal overflow */
    }

    .notif-scroll-area::-webkit-scrollbar {
        width: 4px;
    }

    .notif-scroll-area::-webkit-scrollbar-track {
        background: transparent;
    }

    .notif-scroll-area::-webkit-scrollbar-thumb {
        background: #ddd;
        border-radius: 10px;
    }

    /* Individual notification item */
    .notif-item {
        border-bottom: 1px solid #f5f5fa;
        transition: background 0.15s ease;
    }

    .notif-item:last-child {
        border-bottom: none;
    }

    .notif-item:hover {
        background: #f5f6ff;
    }

    .notif-dot {
        width: 7px;
        height: 7px;
        min-width: 7px;
        /* prevents flex shrinking */
        border-radius: 50%;
        background: #4f46e5;
        margin-top: 4px;
    }

    /* Text — fixes for overflow */
    .notif-content {
        flex: 1;
        min-width: 0;
        /* critical: allows flex child to shrink below content size */
    }

    .notif-title {
        font-size: 0.8rem;
        font-weight: 600;
        color: #1a1a2e;
        white-space: normal;
        word-break: break-word;
        overflow-wrap: break-word;
        line-height: 1.35;
    }

    .notif-message {
        font-size: 0.75rem;
        color: #6b7280;
        white-space: normal;
        word-break: break-word;
        overflow-wrap: break-word;
        line-height: 1.4;
        margin-top: 2px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Footer link */
    .notif-footer {
        border-top: 1px solid #f0f0f5;
        background: #fafafc;
    }

    .notif-view-all {
        display: block;
        text-align: center;
        padding: 0.55rem 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: #4f46e5;
        text-decoration: none;
        transition: background 0.15s ease;
    }

    .notif-view-all:hover {
        background: #eef0ff;
        color: #3730a3;
    }

    /* ============================================
       PROFILE BUTTON & DROPDOWN
    ============================================ */
    .btn-profile {
        border-radius: 10px;
        border: 1px solid #e8e8f0;
        background: #fafafc;
        padding: 4px 10px 4px 6px;
        transition: all 0.18s ease;
        color: #333;
    }

    .btn-profile:hover {
        background: #eef0ff;
        border-color: #c7caff;
    }

    .profile-avatar {
        object-fit: cover;
        border: 2px solid #e8e8f0;
    }

    .profile-name {
        font-size: 0.85rem;
        font-weight: 500;
    }

    .profile-dropdown {
        width: 220px;
        border-radius: 14px;
        border: 1px solid #f0f0f5;
        padding: 0;
        overflow: hidden;
    }

    .profile-menu-header {
        background: #fafafc;
        border-bottom: 1px solid #f0f0f5;
    }

    .profile-dropdown .dropdown-item {
        font-size: 0.84rem;
        padding: 0.6rem 1rem;
        color: #444;
        transition: background 0.15s ease;
    }

    .profile-dropdown .dropdown-item:hover {
        background: #f5f6ff;
        color: #4f46e5;
    }

    .profile-dropdown .dropdown-item.text-danger:hover {
        background: #fff5f5;
        color: #dc2626;
    }

    /* ============================================
       SHARED DROPDOWN ANIMATION
    ============================================ */
    .dropdown-menu {
        border: 1px solid #f0f0f5;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
        animation: dropIn 0.15s ease;
    }

    @keyframes dropIn {
        from {
            opacity: 0;
            transform: translateY(-6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ============================================
       MOBILE
    ============================================ */
    @media (max-width: 768px) {
        .notif-dropdown {
            width: 300px;
        }
    }
</style>
