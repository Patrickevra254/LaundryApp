<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/login3.css') }}">

</head>

<body>

    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-lg-10 col-xl-9">

                <div class="card auth-card">
                    <div class="row g-0">

                        <!-- Brand Section -->
                        <div class="col-lg-5 d-none d-lg-flex brand-section">
                            <div class="brand-content p-5 d-flex flex-column justify-content-center">
                                <div class="text-center">
                                    <div class="mb-4">
                                        <i class="fas fa-shield-alt fa-4x opacity-75"></i>
                                    </div>
                                    <h3 class="fw-bold mb-3">Admin Dashboard</h3>
                                    <p class="mb-4 opacity-90">Powerful tools to manage your business operations
                                        efficiently and scale with confidence.</p>

                                    <div class="row g-3 mt-4">
                                        <div class="col-6">
                                            <div class="stats-badge">
                                                <h4 class="fw-bold mb-1">500+</h4>
                                                <small class="opacity-75">Active Users</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="stats-badge">
                                                <h4 class="fw-bold mb-1">99.9%</h4>
                                                <small class="opacity-75">Uptime</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-5 pt-4">
                                        <div class="d-flex justify-content-center gap-3 text-white-50">
                                            <i class="fas fa-lock"></i>
                                            <small>Secure & Encrypted</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Form Section -->
                        <div class="col-lg-7">
                            <div class="p-4 p-lg-5">

                                {{-- Alerts --}}
                                @if (session('success'))
                                    <div id="alert" class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if ($errors->any())
                                    <div id="alert" class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div id="alert" class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <!-- LOGIN FORM -->
                                <div id="loginForm">
                                    <h4 class="fw-bold mb-1">Welcome Back</h4>
                                    <p class="text-muted mb-4">Sign in to your dashboard</p>

                                    <form method="POST" action="{{ route('login.store') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label">Email Address</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0">
                                                    <i class="fas fa-envelope text-muted"></i>
                                                </span>
                                                <input type="email" name="email"
                                                    class="form-control border-start-0 ps-0"
                                                    placeholder="name@company.com" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0">
                                                    <i class="fas fa-lock text-muted"></i>
                                                </span>
                                                <input type="password" name="password" id="loginPassword"
                                                    class="form-control border-start-0 border-end-0 ps-0"
                                                    placeholder="Enter password" required>
                                                <span class="input-group-text border-start-0"
                                                    onclick="togglePassword('loginPassword', this)">
                                                    <i class="fas fa-eye text-muted"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between mb-4">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                                <label class="form-check-label">Remember me</label>
                                            </div>
                                            <a href="#" class="small fw-semibold text-decoration-none">
                                                Forgot Password?
                                            </a>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100">
                                            Sign In
                                        </button>

                                        <p class="text-center mt-4 small text-muted">
                                            Don’t have an account?
                                            <a href="#" onclick="switchForm('register')" class="fw-semibold">
                                                Create Account
                                            </a>
                                        </p>
                                    </form>
                                </div>

                                <!-- REGISTER FORM -->
                                <div id="registerForm" class="d-none">
                                    <h4 class="fw-bold mb-1">Create Account</h4>
                                    <p class="text-muted mb-4">Create your new account</p>

                                    <form method="POST" action="{{ route('register.store') }}">
                                        @csrf

                                        <div class="row g-3">
                                            <!-- Full Name -->
                                            <div class="col-md-6">
                                                <label class="form-label">Full Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-end-0">
                                                        <i class="fas fa-user text-muted"></i>
                                                    </span>
                                                    <input type="text" name="name"
                                                        class="form-control border-start-0 ps-0" placeholder="John Doe"
                                                        required>
                                                </div>
                                            </div>

                                            <!-- Email Address -->
                                            <div class="col-md-6">
                                                <label class="form-label">Email Address</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-end-0">
                                                        <i class="fas fa-envelope text-muted"></i>
                                                    </span>
                                                    <input type="email" name="email"
                                                        class="form-control border-start-0 ps-0"
                                                        placeholder="name@company.com" required>
                                                </div>
                                            </div>

                                            <!-- Phone Number -->
                                            <div class="col-md-6">
                                                <label class="form-label">Phone Number</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-end-0">
                                                        <i class="fas fa-phone text-muted"></i>
                                                    </span>
                                                    <input type="tel" name="phone"
                                                        class="form-control border-start-0 ps-0"
                                                        placeholder="+1 234 567 8900" required>
                                                </div>
                                            </div>

                                            <!-- Address -->
                                            <div class="col-md-6">
                                                <label class="form-label">Address</label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-end-0">
                                                        <i class="fas fa-location-dot text-muted"></i>
                                                    </span>
                                                    <input type="text" name="address"
                                                        class="form-control border-start-0 ps-0"
                                                        placeholder="123 Main Street, City, Country" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Password -->
                                        <div class="mb-3 mt-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0">
                                                    <i class="fas fa-lock text-muted"></i>
                                                </span>
                                                <input type="password" name="password" id="registerPassword"
                                                    class="form-control border-start-0 border-end-0 ps-0" required>
                                                <span class="input-group-text border-start-0"
                                                    onclick="togglePassword('registerPassword', this)">
                                                    <i class="fas fa-eye text-muted"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="mb-3">
                                            <label class="form-label">Confirm Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text border-end-0">
                                                    <i class="fas fa-lock text-muted"></i>
                                                </span>
                                                <input type="password" name="password_confirmation"
                                                    id="confirmPassword"
                                                    class="form-control border-start-0 border-end-0 ps-0" required>
                                                <span class="input-group-text border-start-0"
                                                    onclick="togglePassword('confirmPassword', this)">
                                                    <i class="fas fa-eye text-muted"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Terms Checkbox -->
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" required>
                                            <label class="form-check-label small">
                                                I agree to the Terms & Privacy Policy
                                            </label>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100">
                                            Create Account
                                        </button>

                                        <p class="text-center mt-4 small text-muted">
                                            Already have an account?
                                            <a href="#" onclick="switchForm('login')" class="fw-semibold">
                                                Sign In
                                            </a>
                                        </p>
                                    </form>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>

                <p class="text-center text-muted small mt-3">
                    © 2024 Dashboard Admin. All rights reserved.
                </p>

            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function switchForm(formType) {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');

            if (formType === 'register') {
                loginForm.classList.add('d-none');
                registerForm.classList.remove('d-none');
            } else {
                registerForm.classList.add('d-none');
                loginForm.classList.remove('d-none');
            }
        }

        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            const iconElement = icon.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                iconElement.classList.remove('fa-eye');
                iconElement.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                iconElement.classList.remove('fa-eye-slash');
                iconElement.classList.add('fa-eye');
            }
        }

        function handleLogin() {
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            const btn = event.target;
            const btnText = btn.querySelector('.btn-text');
            const spinner = btn.querySelector('.spinner-border');

            if (!email || !password) {
                alert('Please fill in all fields');
                return;
            }

            btn.disabled = true;
            btnText.classList.add('d-none');
            spinner.classList.remove('d-none');

            setTimeout(() => {
                btn.disabled = false;
                btnText.classList.remove('d-none');
                spinner.classList.add('d-none');
                alert('Login successful! (Dummy action)');
                window.location.href = '/';
            }, 1500);
        }

        function handleRegister() {
            const name = document.getElementById('registerName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const agreeTerms = document.getElementById('agreeTerms').checked;
            const btn = event.target;
            const btnText = btn.querySelector('.btn-text');
            const spinner = btn.querySelector('.spinner-border');

            if (!name || !email || !password || !confirmPassword) {
                alert('Please fill in all fields');
                return;
            }

            if (password !== confirmPassword) {
                alert('Passwords do not match');
                return;
            }

            if (!agreeTerms) {
                alert('Please agree to the Terms of Service');
                return;
            }

            btn.disabled = true;
            btnText.classList.add('d-none');
            spinner.classList.remove('d-none');

            setTimeout(() => {
                btn.disabled = false;
                btnText.classList.remove('d-none');
                spinner.classList.add('d-none');
                alert('Registration successful! (Dummy action)');
                window.location.href = '/';
            }, 1500);
        }
    </script>

    {{-- message timeout --}}
    <script>
        // Auto-hide alert after 7 seconds
        setTimeout(function() {
            const alert = document.getElementById('alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);
    </script>

</body>

</html>
