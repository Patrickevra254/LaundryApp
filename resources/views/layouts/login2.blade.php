<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/auth-combined.css') }}">
</head>

<body class="auth-body">

    <div class="auth-wrapper">

        <div class="auth-card">

            <!-- HEADER -->
            <h3 class="text-center fw-bold mb-4" id="formTitle">Welcome Back</h3>
            <p class="text-center text-muted mb-4" id="formSubtitle">Sign in to continue</p>

            <!-- LOGIN FORM -->
            <form id="loginForm" method="POST" action="">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control auth-input" name="email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" class="form-control auth-input" name="password" required>
                </div>

                <button class="btn btn-primary w-100 auth-btn mt-3">Login</button>
            </form>

            <!-- REGISTER FORM -->
            <form id="registerForm" method="POST" action="" class="d-none">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Full Name</label>
                    <input type="text" class="form-control auth-input" name="name">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email Address</label>
                    <input type="email" class="form-control auth-input" name="email">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" class="form-control auth-input" name="password">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Confirm Password</label>
                    <input type="password" class="form-control auth-input" name="password_confirmation">
                </div>

                <button class="btn btn-primary w-100 auth-btn mt-3">Create Account</button>
            </form>

            <!-- TOGGLE LINKS -->
            <p class="text-center mt-4">
                <span id="toggleText">
                    Don't have an account?
                    <a href="#" id="showRegister">Create one</a>
                </span>
            </p>

        </div>

    </div>

    <script>
        const loginForm = document.getElementById("loginForm");
        const registerForm = document.getElementById("registerForm");

        const formTitle = document.getElementById("formTitle");
        const formSubtitle = document.getElementById("formSubtitle");
        const toggleText = document.getElementById("toggleText");

        /** Switch to Register */
        document.getElementById("showRegister").addEventListener("click", (e) => {
            e.preventDefault();

            loginForm.classList.add("fade-out");
            setTimeout(() => {
                loginForm.classList.add("d-none");
                registerForm.classList.remove("d-none");
                registerForm.classList.add("fade-in");

                formTitle.innerHTML = "Create Account ✨";
                formSubtitle.innerHTML = "Register to continue";
                toggleText.innerHTML = `
                    Already have an account?
                    <a href="#" id="showLogin">Login here</a>
                `;

                bindShowLogin();
            }, 200);
        });

        function bindShowLogin() {
            document.getElementById("showLogin").addEventListener("click", (e) => {
                e.preventDefault();

                registerForm.classList.add("fade-out");
                setTimeout(() => {
                    registerForm.classList.add("d-none");
                    loginForm.classList.remove("d-none");
                    loginForm.classList.add("fade-in");

                    formTitle.innerHTML = "Welcome Back 👋";
                    formSubtitle.innerHTML = "Sign in to continue";
                    toggleText.innerHTML = `
                        Don't have an account?
                        <a href="#" id="showRegister">Create one</a>
                    `;

                    bindShowRegister();
                }, 200);
            });
        }

        function bindShowRegister() {
            document.getElementById("showRegister").addEventListener("click", (e) => {
                e.preventDefault();
            });
        }
    </script>

</body>

</html>

<style>
    body.auth-body {
        background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: "Inter", sans-serif;
    }

    .auth-wrapper {
        width: 100%;
        max-width: 420px;
        padding: 20px;
    }

    .auth-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 18px;
        padding: 40px;
        color: white;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
    }

    .auth-input {
        background: rgba(255, 255, 255, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.5);
        color: white;
    }

    .auth-input:focus {
        background: rgba(255, 255, 255, 0.35);
        box-shadow: none;
        border-color: #fff;
    }

    .auth-btn {
        background: white !important;
        color: #0d6efd !important;
        font-weight: 600;
        border-radius: 10px;
    }

    .auth-btn:hover {
        background: #f3f3f3 !important;
    }

    /* Animation */
    .fade-in {
        animation: fadeIn 0.4s ease forwards;
    }

    .fade-out {
        animation: fadeOut 0.2s ease forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }

        to {
            opacity: 0;
            transform: translateY(10px);
        }
    }

    a {
        color: #fff;
        font-weight: 600;
        text-decoration: underline;
    }

    a:hover {
        color: #f1f1f1;
    }
</style>
