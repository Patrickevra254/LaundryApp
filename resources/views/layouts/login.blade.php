<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Login' }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- coreUi --}}
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.3/dist/css/coreui.min.css" rel="stylesheet"
        integrity="sha384-oMIIhJL1T5s+PxJr6+Qb0pO1IRFB6OGMM+J57UBT3UQKxSVsb++MkXpu9cLqaJxu" crossorigin="anonymous">

</head>



<body>
    <!-- Animated background shapes -->
    <div class="bg-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="auth-container">
        <!-- Side Panel -->
        <div class="side-panel" id="sidePanel">
            <div class="side-panel-content">
                <i class="fas fa-chart-line"></i>
                <h2 id="sidePanelTitle">Welcome Back!</h2>
                <p id="sidePanelText">Enter your credentials to access your dashboard and manage your data efficiently.
                </p>
            </div>
        </div>

        <!-- Form Panel -->
        <div class="form-panel">
            <!-- Login Form -->
            <div class="form-container active" id="loginForm">
                <div class="form-header">
                    <h3>Sign In</h3>
                    <p>Access your account</p>
                </div>

                <form>
                    <div class="form-group">
                        <label for="loginEmail">Email Address</label>
                        <div class="input-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email" class="form-control" id="loginEmail" placeholder="Enter your email"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" class="form-control" id="loginPassword"
                                placeholder="Enter your password" required>
                            <i class="fas fa-eye password-toggle" onclick="togglePassword('loginPassword', this)"></i>
                        </div>
                    </div>

                    <div class="remember-forgot">
                        <label class="remember-me">
                            <input type="checkbox" id="rememberMe">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>

                    <button type="button" class="btn-primary" onclick="handleLogin()">
                        Sign In
                    </button>
                </form>

                <div class="divider">
                    <span>OR</span>
                </div>

                <div class="social-login">
                    <button class="social-btn">
                        <i class="fab fa-google" style="color: #DB4437;"></i>
                        Google
                    </button>
                    <button class="social-btn">
                        <i class="fab fa-github" style="color: #333;"></i>
                        GitHub
                    </button>
                </div>

                <div class="form-footer">
                    <p>Don't have an account? <a href="#" onclick="switchForm('register')">Sign Up</a></p>
                </div>
            </div>

            <!-- Register Form -->
            <div class="form-container" id="registerForm">
                <div class="form-header">
                    <h3>Create Account</h3>
                    <p>Join us today</p>
                </div>

                <form>
                    <div class="form-group">
                        <label for="registerName">Full Name</label>
                        <div class="input-group">
                            <i class="fas fa-user"></i>
                            <input type="text" class="form-control" id="registerName"
                                placeholder="Enter your full name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="registerEmail">Email Address</label>
                        <div class="input-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email" class="form-control" id="registerEmail" placeholder="Enter your email"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="registerPassword">Password</label>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" class="form-control" id="registerPassword"
                                placeholder="Create a password" required>
                            <i class="fas fa-eye password-toggle"
                                onclick="togglePassword('registerPassword', this)"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" class="form-control" id="confirmPassword"
                                placeholder="Confirm your password" required>
                            <i class="fas fa-eye password-toggle"
                                onclick="togglePassword('confirmPassword', this)"></i>
                        </div>
                    </div>

                    <button type="button" class="btn-primary" onclick="handleRegister()">
                        Create Account
                    </button>
                </form>

                <div class="divider">
                    <span>OR</span>
                </div>

                <div class="social-login">
                    <button class="social-btn">
                        <i class="fab fa-google" style="color: #DB4437;"></i>
                        Google
                    </button>
                    <button class="social-btn">
                        <i class="fab fa-github" style="color: #333;"></i>
                        GitHub
                    </button>
                </div>

                <div class="form-footer">
                    <p>Already have an account? <a href="#" onclick="switchForm('login')">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>



    {{-- coreUI --}}
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.3/dist/js/coreui.bundle.min.js"
        integrity="sha384-SWhFOmxmv1pfTLKVBW7q8uossvuaWNeQFdmaWi6xdldiUjyqG9F6V2R2BOC8gkxx" crossorigin="anonymous">
    </script>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function switchForm(formType) {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const sidePanelTitle = document.getElementById('sidePanelTitle');
            const sidePanelText = document.getElementById('sidePanelText');

            if (formType === 'register') {
                loginForm.classList.remove('active');
                registerForm.classList.add('active');
                sidePanelTitle.textContent = 'Hello, Friend!';
                sidePanelText.textContent =
                    'Create an account and start your journey with us. Manage your data like never before.';
            } else {
                registerForm.classList.remove('active');
                loginForm.classList.add('active');
                sidePanelTitle.textContent = 'Welcome Back!';
                sidePanelText.textContent =
                    'Enter your credentials to access your dashboard and manage your data efficiently.';
            }
        }

        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        function handleLogin() {
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            const btn = event.target;

            if (!email || !password) {
                alert('Please fill in all fields');
                return;
            }

            // Add loading state
            btn.classList.add('loading');
            btn.textContent = '';

            // Simulate login (remove this and add real logic)
            setTimeout(() => {
                btn.classList.remove('loading');
                btn.textContent = 'Sign In';
                alert('Login successful! (This is a dummy action)');
                // Redirect to dashboard
                window.location.href = '/';
            }, 2000);
        }

        function handleRegister() {
            const name = document.getElementById('registerName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const btn = event.target;

            if (!name || !email || !password || !confirmPassword) {
                alert('Please fill in all fields');
                return;
            }

            if (password !== confirmPassword) {
                alert('Passwords do not match');
                return;
            }

            // Add loading state
            btn.classList.add('loading');
            btn.textContent = '';

            // Simulate registration (remove this and add real logic)
            setTimeout(() => {
                btn.classList.remove('loading');
                btn.textContent = 'Create Account';
                alert('Registration successful! (This is a dummy action)');
                // Redirect to dashboard or login
                window.location.href = '/';
            }, 2000);
        }
    </script>

</body>

</html>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        overflow-x: hidden;
    }

    /* Animated background shapes */
    .bg-shapes {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
        pointer-events: none;
    }

    .shape {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 20s infinite ease-in-out;
    }

    .shape:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape:nth-child(2) {
        width: 120px;
        height: 120px;
        top: 70%;
        left: 80%;
        animation-delay: 2s;
    }

    .shape:nth-child(3) {
        width: 60px;
        height: 60px;
        top: 40%;
        left: 70%;
        animation-delay: 4s;
    }

    .shape:nth-child(4) {
        width: 100px;
        height: 100px;
        top: 80%;
        left: 20%;
        animation-delay: 6s;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0) rotate(0deg);
            opacity: 0.3;
        }

        50% {
            transform: translateY(-50px) rotate(180deg);
            opacity: 0.6;
        }
    }

    .auth-container {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 1000px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 600px;
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .auth-container {
            grid-template-columns: 1fr;
        }

        .side-panel {
            display: none !important;
        }
    }

    .side-panel {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        position: relative;
    }

    .side-panel::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: pulse 8s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 0.5;
        }

        50% {
            transform: scale(1.1);
            opacity: 0.8;
        }
    }

    .side-panel-content {
        position: relative;
        z-index: 1;
        text-align: center;
    }

    .side-panel h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .side-panel p {
        font-size: 1.1rem;
        opacity: 0.9;
        line-height: 1.6;
    }

    .side-panel i {
        font-size: 5rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    .form-panel {
        padding: 60px 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-container {
        display: none;
        animation: fadeIn 0.5s ease-in;
    }

    .form-container.active {
        display: block;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateX(20px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .form-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .form-header h3 {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }

    .form-header p {
        color: #666;
        font-size: 0.95rem;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #555;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .input-group {
        position: relative;
    }

    .input-group i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #667eea;
        font-size: 1.1rem;
    }

    .form-control {
        width: 100%;
        padding: 14px 15px 14px 45px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #999;
        transition: color 0.3s;
    }

    .password-toggle:hover {
        color: #667eea;
    }

    .btn-primary {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 10px;
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
        position: relative;
        overflow: hidden;
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-primary:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
    }

    .form-footer {
        text-align: center;
        margin-top: 25px;
    }

    .form-footer p {
        color: #666;
        font-size: 0.9rem;
    }

    .form-footer a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }

    .form-footer a:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    .divider {
        display: flex;
        align-items: center;
        margin: 25px 0;
        color: #999;
        font-size: 0.9rem;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e0e0e0;
    }

    .divider span {
        padding: 0 15px;
    }

    .social-login {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 20px;
    }

    .social-btn {
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-weight: 600;
        color: #555;
    }

    .social-btn:hover {
        border-color: #667eea;
        background: #f8f9ff;
        transform: translateY(-2px);
    }

    .social-btn i {
        font-size: 1.2rem;
    }

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        font-size: 0.9rem;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #666;
    }

    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #667eea;
    }

    .forgot-password {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .forgot-password:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    /* Loading animation */
    .btn-primary.loading {
        pointer-events: none;
        opacity: 0.7;
    }

    .btn-primary.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>
