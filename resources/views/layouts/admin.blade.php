{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- coreUi -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.3/dist/css/coreui.min.css" rel="stylesheet"
        integrity="sha384-oMIIhJL1T5s+PxJr6+Qb0pO1IRFB6OGMM+J57UBT3UQKxSVsb++MkXpu9cLqaJxu" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <!-- apex.js -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</head>

<body class="" id="body">

    <!-- Header / Topbar (full width) -->
    @include('components.admin.header')

    <div class="d-flex" style="min-height: calc(100vh - 70px);">

        <!-- Sidebar (starts under header) -->
        @include('components.admin.sidebar2')




        <main id="main-content" class="flex-grow-1 px-4 pt-2 pb-4 position-relative">

            @if (session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Loader -->
            <div class="htmx-indicator text-center py-5" style="z-index: 1050;">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 fw-semibold mb-0">Loading, please wait...</p>
            </div>

            <!-- Content Area -->
            <div id="content-area" class="{{ empty($content) ? 'd-none' : '' }}">
                {!! $content ?? '' !!}
            </div>

        </main>


    </div>

    <!-- Footer -->
    @include('components.admin.footer')

    <!-- coreUI -->
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.3/dist/js/coreui.bundle.min.js"
        integrity="sha384-SWhFOmxmv1pfTLKVBW7q8uossvuaWNeQFdmaWi6xdldiUjyqG9F6V2R2BOC8gkxx" crossorigin="anonymous">
    </script>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Optional: Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- HTMX integration -->
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            const contentArea = document.getElementById('content-area');
            const loader = document.querySelector('.htmx-indicator');

            // --- Ensure sidebar is visible on tablet (768–991px)
            if (window.innerWidth >= 768 && window.innerWidth < 992) {
                sidebar.classList.add('show');
            }

            // Sidebar toggle
            toggleBtn?.addEventListener('click', () => {
                if (window.innerWidth >= 767) {
                    sidebar.classList.toggle('collapsed');
                } else {
                    sidebar.classList.toggle('show');
                }
            });

            // ===== INITIAL LOADER HANDLING =====
            // If content exists on initial load, hide loader
            if (contentArea && contentArea.innerHTML.trim() !== '') {
                loader.style.display = 'none';
                contentArea.classList.remove('d-none');
            } else {
                loader.style.display = 'block';
                contentArea.classList.add('d-none');
            }

            // ===== AUTHENTICATION REDIRECT HANDLERS =====

            // Detect login page in response URL before swap
            document.body.addEventListener('htmx:beforeSwap', function(event) {
                const responseURL = event.detail.xhr.responseURL;

                if (responseURL && responseURL.includes('/login')) {
                    console.log('Login page detected in URL, doing full redirect');
                    event.detail.shouldSwap = false;
                    event.preventDefault();
                    window.location.href = '/login';
                    return false;
                }
            });

            // Handle 401 Unauthorized responses
            document.body.addEventListener('htmx:responseError', function(event) {
                const xhr = event.detail.xhr;

                if (xhr.status === 401) {
                    console.log('401 Unauthorized - redirecting to login');
                    const redirectUrl = xhr.getResponseHeader('HX-Redirect');
                    window.location.href = redirectUrl || '/';
                    return false;
                }

                // Show error for other errors
                if (event.detail.target.id === 'content-area') {
                    console.log('Error occurred');
                    if (loader) loader.style.display = 'none';
                    contentArea.classList.remove('d-none');
                    contentArea.innerHTML =
                        '<div class="alert alert-danger">Failed to load content. Please try again.</div>';
                }
            });

            // Catch login page content after swap (last resort)
            document.body.addEventListener('htmx:afterSwap', function(event) {
                if (event.detail.target.id === 'content-area') {
                    const content = event.detail.target.innerHTML.toLowerCase();

                    // Check if login form was loaded
                    if (content.includes('login') &&
                        (content.includes('password') || content.includes('email'))) {
                        console.log('Login form detected in content, doing full redirect');
                        window.location.href = '/';
                        return false;
                    }

                    console.log('Content loaded - hiding spinner');
                    if (loader) loader.style.display = 'none';
                    contentArea.classList.remove('d-none');
                }
            });

            // ===== LOADING INDICATOR HANDLERS =====

            // Clear content and show spinner BEFORE request starts
            document.body.addEventListener('htmx:beforeRequest', function(event) {
                if (event.detail.target.id === 'content-area') {
                    console.log('Request starting - clearing content');
                    contentArea.innerHTML = '';
                    contentArea.classList.add('d-none');
                    if (loader) loader.style.display = 'block';
                }
            });
        });
    </script>


    <!-- Charts for report -->
    <script>
        function loadReportCharts() {
            const salesChartElement = document.querySelector("#reportSalesChart");
            const userChartElement = document.querySelector("#reportUserChart");

            if (!salesChartElement || !userChartElement) {
                console.log('Chart elements not found - not on reports page');
                return;
            }

            console.log('Initializing charts...');

            // Clear any existing charts
            salesChartElement.innerHTML = '';
            userChartElement.innerHTML = '';

            // Sales Chart
            var salesChart = new ApexCharts(salesChartElement, {
                chart: {
                    type: "area",
                    height: 250
                },
                series: [{
                    name: "Sales",
                    data: [44, 55, 57, 56, 61]
                }],
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May"]
                }
            });
            salesChart.render();

            // Users Chart
            var userChart = new ApexCharts(userChartElement, {
                chart: {
                    type: "line",
                    height: 250
                },
                series: [{
                    name: "Registrations",
                    data: [10, 25, 15, 40, 22]
                }],
                xaxis: {
                    categories: ["Mon", "Tue", "Wed", "Thu", "Fri"]
                }
            });
            userChart.render();

            console.log('Charts loaded successfully!');
        }

        // Initialize charts on initial page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded - checking for charts...');
            loadReportCharts();
        });

        // Initialize charts after HTMX swap
        document.body.addEventListener("htmx:afterSwap", function(event) {
            if (event.detail.target.id === "content-area") {
                setTimeout(() => {
                    loadReportCharts();
                }, 100);
            }
        });
    </script>

    <!-- message timeout -->
    <script>
        // Auto-hide alert after 7 seconds
        setTimeout(function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);
    </script>

</body>

</html>

<style>
    .htmx-indicator {
        display: none;
        position: fixed !important;
        top: 50% !important;
        left: 55% !important;
        transform: translate(-50%, -50%) !important;
    }
</style> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.3/dist/css/coreui.min.css" rel="stylesheet"
        integrity="sha384-oMIIhJL1T5s+PxJr6+Qb0pO1IRFB6OGMM+J57UBT3UQKxSVsb++MkXpu9cLqaJxu" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body class="" id="body">

    <!-- Toast stack — fixed top-center, above everything -->
    <div id="toastStack"
        style="
        position: fixed;
        top: 1.25rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 99999;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: .55rem;
        pointer-events: none;
    ">
    </div>

    @include('components.admin.header')

    <div class="d-flex" style="min-height: calc(100vh - 70px);">

        @include('components.admin.sidebar2')

        <main id="main-content" class="flex-grow-1 px-4 pt-2 pb-4 position-relative">

            <!-- Loader -->
            <div class="htmx-indicator text-center py-5" style="z-index: 1050;">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 fw-semibold mb-0">Loading, please wait...</p>
            </div>

            <!-- Content Area -->
            <div id="content-area" class="{{ empty($content) ? 'd-none' : '' }}">
                {!! $content ?? '' !!}
            </div>

        </main>

    </div>

    @include('components.admin.footer')

    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.3/dist/js/coreui.bundle.min.js"
        integrity="sha384-SWhFOmxmv1pfTLKVBW7q8uossvuaWNeQFdmaWi6xdldiUjyqG9F6V2R2BOC8gkxx" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    {{-- ── Toast system ──────────────────────────────────────────── --}}
    <style>
        .toast-item {
            display: flex;
            align-items: flex-start;
            gap: .65rem;
            background: #fff;
            border-radius: 12px;
            padding: .75rem 1rem;
            min-width: 280px;
            max-width: 380px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .12), 0 1px 4px rgba(0, 0, 0, .06);
            border-left: 4px solid transparent;
            pointer-events: all;
            animation: toastIn .35s cubic-bezier(.22, .68, 0, 1.2) both;
            position: relative;
            overflow: hidden;
        }

        .toast-item.toast-success {
            border-left-color: #10b981;
        }

        .toast-item.toast-error {
            border-left-color: #ef4444;
        }

        .toast-item.toast-info {
            border-left-color: #4f46e5;
        }

        .toast-item.toast-out {
            animation: toastOut .3s ease forwards;
        }

        /* progress bar */
        .toast-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            opacity: .25;
            animation: toastProgress 5s linear forwards;
            border-radius: 0 0 0 12px;
            width: 100%;
        }

        .toast-item.toast-success::after {
            background: #10b981;
        }

        .toast-item.toast-error::after {
            background: #ef4444;
        }

        .toast-item.toast-info::after {
            background: #4f46e5;
        }

        .toast-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .toast-success .toast-icon {
            background: #ecfdf5;
            color: #10b981;
        }

        .toast-error .toast-icon {
            background: #fff1f2;
            color: #ef4444;
        }

        .toast-info .toast-icon {
            background: #eef2ff;
            color: #4f46e5;
        }

        .toast-body {
            flex: 1;
            min-width: 0;
        }

        .toast-title {
            font-size: .8rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 2px;
        }

        .toast-msg {
            font-size: .76rem;
            color: #6b7280;
            line-height: 1.4;
        }

        .toast-close {
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            font-size: .75rem;
            padding: 0;
            flex-shrink: 0;
            margin-top: 2px;
            transition: color .15s;
        }

        .toast-close:hover {
            color: #374151;
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateY(-16px) scale(.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes toastOut {
            from {
                opacity: 1;
                transform: translateY(0) scale(1);
            }

            to {
                opacity: 0;
                transform: translateY(-16px) scale(.95);
            }
        }

        @keyframes toastProgress {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }
    </style>

    <script>
        function showToast(type, title, message) {
            const stack = document.getElementById('toastStack');
            if (!stack) return;
            const icons = {
                success: 'fa-circle-check',
                error: 'fa-circle-xmark',
                info: 'fa-circle-info'
            };
            const toast = document.createElement('div');
            toast.className = `toast-item toast-${type}`;
            toast.innerHTML = `
                <div class="toast-icon"><i class="fa ${icons[type] || 'fa-circle-info'}"></i></div>
                <div class="toast-body">
                    <div class="toast-title">${title}</div>
                    ${message ? `<div class="toast-msg">${message}</div>` : ''}
                </div>
                <button class="toast-close" onclick="dismissToast(this.parentElement)">
                    <i class="fa fa-xmark"></i>
                </button>`;
            stack.appendChild(toast);
            setTimeout(() => dismissToast(toast), 5000);
        }

        function dismissToast(toast) {
            if (!toast || toast.classList.contains('toast-out')) return;
            toast.classList.add('toast-out');
            setTimeout(() => toast.remove(), 300);
        }

        // Fire toasts from Laravel session data
        @if (session('success'))
            showToast('success', 'Success', @json(session('success')));
        @endif
        @if (session('error'))
            showToast('error', 'Error', @json(session('error')));
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                showToast('error', 'Error', @json($error));
            @endforeach
        @endif
    </script>

    {{-- ── HTMX + sidebar ──────────────────────────────────────────── --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            const contentArea = document.getElementById('content-area');
            const loader = document.querySelector('.htmx-indicator');

            // Ensure sidebar visible on tablet
            if (window.innerWidth >= 768 && window.innerWidth < 992) {
                sidebar?.classList.add('show');
            }

            // Sidebar toggle
            toggleBtn?.addEventListener('click', () => {
                if (window.innerWidth >= 767) {
                    sidebar?.classList.toggle('collapsed');
                } else {
                    sidebar?.classList.toggle('show');
                }
            });

            // Initial loader state
            if (contentArea && contentArea.innerHTML.trim() !== '') {
                loader.style.display = 'none';
                contentArea.classList.remove('d-none');
            } else {
                loader.style.display = 'block';
                contentArea.classList.add('d-none');
            }

            // Redirect to login if session expires
            document.body.addEventListener('htmx:beforeSwap', function(event) {
                if (event.detail.xhr.responseURL?.includes('/login')) {
                    event.detail.shouldSwap = false;
                    event.preventDefault();
                    window.location.href = '/login';
                }
            });

            // 401 handler
            document.body.addEventListener('htmx:responseError', function(event) {
                const xhr = event.detail.xhr;
                if (xhr.status === 401) {
                    window.location.href = xhr.getResponseHeader('HX-Redirect') || '/';
                    return;
                }
                if (event.detail.target.id === 'content-area') {
                    if (loader) loader.style.display = 'none';
                    contentArea.classList.remove('d-none');
                    showToast('error', 'Error', 'Failed to load content. Please try again.');
                }
            });

            // After swap — hide loader, check for login redirect
            document.body.addEventListener('htmx:afterSwap', function(event) {
                if (event.detail.target.id === 'content-area') {
                    const content = event.detail.target.innerHTML.toLowerCase();
                    if (content.includes('login') && (content.includes('password') || content.includes(
                            'email'))) {
                        window.location.href = '/';
                        return;
                    }
                    if (loader) loader.style.display = 'none';
                    contentArea.classList.remove('d-none');
                }
            });

            // Before request — show loader
            document.body.addEventListener('htmx:beforeRequest', function(event) {
                if (event.detail.target.id === 'content-area') {
                    contentArea.innerHTML = '';
                    contentArea.classList.add('d-none');
                    if (loader) loader.style.display = 'block';
                }
            });
        });
    </script>

    {{-- ── Report charts ────────────────────────────────────────────── --}}
    <script>
        function loadReportCharts() {
            const salesChartElement = document.querySelector("#reportSalesChart");
            const userChartElement = document.querySelector("#reportUserChart");
            if (!salesChartElement || !userChartElement) return;

            salesChartElement.innerHTML = '';
            userChartElement.innerHTML = '';

            new ApexCharts(salesChartElement, {
                chart: {
                    type: "area",
                    height: 250
                },
                series: [{
                    name: "Sales",
                    data: [44, 55, 57, 56, 61]
                }],
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May"]
                }
            }).render();

            new ApexCharts(userChartElement, {
                chart: {
                    type: "line",
                    height: 250
                },
                series: [{
                    name: "Registrations",
                    data: [10, 25, 15, 40, 22]
                }],
                xaxis: {
                    categories: ["Mon", "Tue", "Wed", "Thu", "Fri"]
                }
            }).render();
        }

        document.addEventListener('DOMContentLoaded', loadReportCharts);
        document.body.addEventListener('htmx:afterSwap', function(event) {
            if (event.detail.target.id === 'content-area') {
                setTimeout(loadReportCharts, 100);
            }
        });
    </script>

</body>

</html>

<style>
    .htmx-indicator {
        display: none;
        position: fixed !important;
        top: 50% !important;
        left: 55% !important;
        transform: translate(-50%, -50%) !important;
    }
</style>
