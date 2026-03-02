<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaundryPro – Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --purple: #4f46e5;
            --purple-deep: #3730a3;
            --purple-light: #a5b4fc;
            --purple-soft: #eef2ff;
            --ink: #0f0e17;
            --muted: #9ca3af;
            --border: #e5e7eb;
            --surface: #fafafa;
        }

        html, body { height: 100%; overflow: hidden; font-family: 'DM Sans', sans-serif; background: #f5f5f9; }

        /* ── Layout ── */
        .auth-wrap {
            height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
        }

        /* ── Left: brand panel ── */
        .brand-panel {
            background: var(--purple);
            background-image:
                radial-gradient(ellipse at 20% 20%, rgba(99,91,255,.6) 0%, transparent 55%),
                radial-gradient(ellipse at 80% 80%, rgba(49,41,180,.7) 0%, transparent 55%);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2rem 2.5rem;
        }

        /* noise texture overlay */
        .brand-panel::before {
            content: '';
            position: absolute; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            opacity: .35;
            pointer-events: none;
        }

        /* floating bubble decorations */
        .bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.1);
        }
        .bubble-1 { width: 320px; height: 320px; top: -80px; right: -80px; }
        .bubble-2 { width: 180px; height: 180px; bottom: 100px; left: -40px; }
        .bubble-3 { width: 90px;  height: 90px;  bottom: 260px; right: 40px; }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: .6rem;
            color: #fff;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: 1.25rem;
            letter-spacing: -.02em;
            position: relative;
            z-index: 1;
        }

        .brand-logo .logo-mark {
            width: 36px; height: 36px;
            background: rgba(255,255,255,.18);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
        }

        .brand-hero {
            position: relative;
            z-index: 1;
        }

        .brand-hero h2 {
            font-family: 'Sora', sans-serif;
            font-size: 1.7rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            letter-spacing: -.04em;
            margin-bottom: .6rem;
        }

        .brand-hero p {
            color: rgba(255,255,255,.75);
            font-size: .82rem;
            line-height: 1.55;
            max-width: 320px;
        }

        /* mock UI card inside brand panel */
        .mock-card {
            background: rgba(255,255,255,.12);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 14px;
            padding: .9rem 1.1rem;
            margin-top: 1rem;
            position: relative;
            z-index: 1;
        }

        .mock-card-header {
            display: flex;
            align-items: center;
            gap: .6rem;
            margin-bottom: .6rem;
            padding-bottom: .5rem;
            border-bottom: 1px solid rgba(255,255,255,.12);
        }

        .mock-dot { width: 8px; height: 8px; border-radius: 50%; }

        .mock-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .3rem 0;
            border-bottom: 1px solid rgba(255,255,255,.07);
            font-size: .74rem;
            color: rgba(255,255,255,.8);
        }

        .mock-row:last-child { border: none; }

        .mock-badge {
            font-size: .68rem;
            padding: .18em .55em;
            border-radius: 999px;
            font-weight: 600;
        }

        .mock-badge.done   { background: rgba(16,185,129,.22); color: #6ee7b7; }
        .mock-badge.prog   { background: rgba(251,191,36,.2);  color: #fde68a; }
        .mock-badge.pend   { background: rgba(255,255,255,.12);color: rgba(255,255,255,.65); }

        .brand-stats {
            display: flex;
            gap: 1rem;
            position: relative;
            z-index: 1;
        }

        .stat-pill {
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 10px;
            padding: .5rem .75rem;
            flex: 1;
            text-align: center;
        }

        .stat-pill .val {
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: #fff;
            line-height: 1;
        }

        .stat-pill .lbl {
            font-size: .65rem;
            color: rgba(255,255,255,.6);
            margin-top: 3px;
        }

        /* ── Right: form panel ── */
        .form-panel {
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 0 3rem;
            position: relative;
            height: 100vh;
            overflow-y: auto;
            scrollbar-width: none;
        }
        .form-panel::-webkit-scrollbar { display: none; }

        .form-panel::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: var(--purple-soft);
            opacity: .6;
            pointer-events: none;
        }

        .form-inner { max-width: 400px; width: 100%; margin: 0 auto; position: relative; z-index: 1; padding: 2.5rem 0; }

        .form-eyebrow {
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--purple);
            margin-bottom: .3rem;
        }

        .form-heading {
            font-family: 'Sora', sans-serif;
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--ink);
            letter-spacing: -.04em;
            line-height: 1.15;
            margin-bottom: .3rem;
        }

        .form-sub {
            font-size: .82rem;
            color: var(--muted);
            margin-bottom: 1.1rem;
        }

        /* alerts */
        .alert { border-radius: 10px; font-size: .83rem; border: none; padding: .75rem 1rem; }
        .alert-success { background: #ecfdf5; color: #065f46; }
        .alert-danger  { background: #fff1f2; color: #9f1239; }

        /* field */
        .field-group { margin-bottom: .65rem; }
        .field-label {
            font-size: .74rem;
            font-weight: 700;
            color: var(--purple-deep);
            margin-bottom: 5px;
            display: block;
            letter-spacing: .01em;
        }

        .field-wrap { position: relative; }
        .field-icon {
            position: absolute;
            left: 11px; top: 50%;
            transform: translateY(-50%);
            color: var(--purple-light);
            font-size: .78rem;
            pointer-events: none;
            transition: color .15s;
        }
        .field-wrap:focus-within .field-icon { color: var(--purple); }

        .field-input {
            width: 100%;
            border-radius: 9px;
            border: 1.5px solid #ddd6fe;
            padding: .52rem .75rem .52rem 2.1rem;
            font-size: .84rem;
            color: var(--ink);
            background: #faf9ff;
            outline: none;
            transition: all .15s;
            font-family: 'DM Sans', sans-serif;
        }

        .field-input:focus {
            border-color: var(--purple);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(79,70,229,.12);
        }

        .field-input::placeholder { color: #c4b5fd; }

        /* compact variant for register */
        .field-input-sm { padding-top: .35rem; padding-bottom: .35rem; font-size: .8rem; }

        .pw-eye {
            position: absolute;
            right: 11px; top: 50%;
            transform: translateY(-50%);
            border: none; background: none;
            color: var(--purple-light); cursor: pointer;
            font-size: .82rem;
            padding: 0;
            transition: color .15s;
        }
        .pw-eye:hover { color: var(--purple); }

        /* remember / forgot */
        .form-row-split {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: .9rem;
        }

        .custom-check {
            display: flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            font-size: .82rem;
            color: #6b7280;
        }
        .custom-check input { width: 15px; height: 15px; accent-color: var(--purple); cursor: pointer; }

        .forgot-link {
            font-size: .82rem;
            font-weight: 600;
            color: var(--purple);
            text-decoration: none;
        }
        .forgot-link:hover { color: var(--purple-deep); }

        /* submit button */
        .btn-auth {
            width: 100%;
            background: var(--purple);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: .7rem;
            font-size: .9rem;
            font-weight: 600;
            font-family: 'Sora', sans-serif;
            cursor: pointer;
            transition: all .2s;
            letter-spacing: -.01em;
            position: relative;
            overflow: hidden;
        }

        .btn-auth::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,.12) 0%, transparent 60%);
        }

        .btn-auth:hover { background: var(--purple-deep); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(79,70,229,.35); }
        .btn-auth:active { transform: translateY(0); }

        .switch-text {
            text-align: center;
            margin-top: .75rem;
            font-size: .82rem;
            color: var(--muted);
        }

        .switch-text a {
            color: var(--purple);
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .switch-text a:hover { color: var(--purple-deep); }

        .divider {
            display: flex; align-items: center; gap: .75rem;
            margin: 1.3rem 0;
            font-size: .75rem;
            color: #d1d5db;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* section tabs */
        .form-tabs {
            display: flex;
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 4px;
            margin-bottom: 1rem;
            gap: 4px;
        }

        .form-tab {
            flex: 1;
            text-align: center;
            padding: .45rem;
            border-radius: 7px;
            font-size: .82rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            background: none;
            color: var(--muted);
            transition: all .2s;
            font-family: 'DM Sans', sans-serif;
        }

        .form-tab.active {
            background: #fff;
            color: var(--ink);
            box-shadow: 0 1px 4px rgba(0,0,0,.08);
        }

        /* row grid */
        .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; }

        /* footer copyright */
        .auth-footer {
            text-align: center;
            font-size: .73rem;
            color: var(--muted);
            margin-top: 1.5rem;
        }

        /* ── Animations ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(32px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideOutLeft {
            from { opacity: 1; transform: translateX(0); }
            to   { opacity: 0; transform: translateX(-32px); }
        }

        .form-inner { animation: fadeUp .4s ease both; }

        /* ── Screen transition wrapper ── */
        .auth-screen.slide-in {
            animation: slideInRight .32s cubic-bezier(.22,.68,0,1.2) both;
        }

        /* ── Forgot password specific ── */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: .8rem;
            font-weight: 600;
            color: var(--muted);
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            margin-bottom: 1.4rem;
            transition: color .15s;
        }
        .back-btn:hover { color: var(--purple); }

        .sent-icon {
            width: 52px; height: 52px;
            background: var(--purple-soft);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            color: var(--purple);
            margin-bottom: 1.2rem;
        }

        .sent-email-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--purple-soft);
            color: var(--purple-deep);
            border-radius: 999px;
            padding: .3em .85em;
            font-size: .8rem;
            font-weight: 600;
            margin: .6rem 0 1.2rem;
        }

        .resend-text {
            font-size: .8rem;
            color: var(--muted);
            margin-top: 1rem;
            text-align: center;
        }

        .resend-text button {
            background: none; border: none;
            color: var(--purple); font-weight: 600;
            cursor: pointer; font-size: .8rem;
            padding: 0; transition: color .15s;
        }
        .resend-text button:hover { color: var(--purple-deep); }

        /* ── Responsive ── */
        @media (max-width: 900px) {
            .auth-wrap { grid-template-columns: 1fr; }
            .brand-panel { display: none; }
            .form-panel { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>

<div class="auth-wrap">

    <!-- ── Brand Panel ── -->
    <div class="brand-panel">
        <div class="bubble bubble-1"></div>
        <div class="bubble bubble-2"></div>
        <div class="bubble bubble-3"></div>

        <div class="brand-logo">
            <div class="logo-mark"><i class="fa fa-shirt"></i></div>
            LaundryPro
        </div>

        <div class="brand-hero">
            <h2>Clean clothes,<br>seamless operations.</h2>
            <p>Manage orders, track payments, and delight your customers — all from one powerful dashboard.</p>

            <div class="mock-card">
                <div class="mock-card-header">
                    <div class="mock-dot" style="background:#6ee7b7"></div>
                    <div class="mock-dot" style="background:#fde68a"></div>
                    <div class="mock-dot" style="background:#fca5a5"></div>
                    <span style="font-size:.72rem; color:rgba(255,255,255,.5); margin-left:.4rem;">Recent Orders</span>
                </div>
                <div class="mock-row">
                    <span>Chinwe A. – 3 items</span>
                    <span class="mock-badge done">Delivered</span>
                </div>
                <div class="mock-row">
                    <span>Emeka B. – 7 items</span>
                    <span class="mock-badge prog">In Progress</span>
                </div>
                <div class="mock-row">
                    <span>Amara O. – 2 items</span>
                    <span class="mock-badge pend">Pending</span>
                </div>
            </div>
        </div>

        <div class="brand-stats">
            <div class="stat-pill">
                <div class="val">1.2k</div>
                <div class="lbl">Orders / mo</div>
            </div>
            <div class="stat-pill">
                <div class="val">99%</div>
                <div class="lbl">On-time rate</div>
            </div>
            <div class="stat-pill">
                <div class="val">4.9★</div>
                <div class="lbl">Customer score</div>
            </div>
        </div>
    </div>

    <!-- ── Form Panel ── -->
    <div class="form-panel">
        <div class="form-inner">

            {{-- Alerts --}}
            @if (session('success'))
                <div id="alert" class="alert alert-success mb-3">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div id="alert" class="alert alert-danger mb-3">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('error'))
                <div id="alert" class="alert alert-danger mb-3">{{ session('error') }}</div>
            @endif

            <!-- Tabs -->
            <div class="form-tabs">
                <button class="form-tab active" id="tab-login" onclick="switchForm('login')">Sign In</button>
                <button class="form-tab" id="tab-register" onclick="switchForm('register')">Create Account</button>
            </div>

            <!-- ── LOGIN ── -->
            <div id="loginForm">
                <div class="form-eyebrow">Welcome back</div>
                <h1 class="form-heading">Sign in to<br>LaundryPro</h1>
                <p class="form-sub">Enter your credentials to continue</p>

                <form method="POST" action="{{ route('login.store') }}">
                    @csrf

                    <div class="field-group">
                        <label class="field-label">Email Address</label>
                        <div class="field-wrap">
                            <i class="fa fa-envelope field-icon"></i>
                            <input type="email" name="email" class="field-input" placeholder="you@example.com" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Password</label>
                        <div class="field-wrap">
                            <i class="fa fa-lock field-icon"></i>
                            <input type="password" name="password" id="loginPassword" class="field-input" placeholder="Enter your password" required>
                            <button type="button" class="pw-eye" onclick="togglePw('loginPassword', this)">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-row-split">
                        <label class="custom-check">
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                        <button type="button" class="forgot-link" style="background:none;border:none;padding:0;cursor:pointer;" onclick="switchScreen('forgot')">Forgot password?</button>
                    </div>

                    <button type="submit" class="btn-auth">Sign In</button>

                    <p class="switch-text">
                        Don't have an account?
                        <a onclick="switchForm('register')">Create one</a>
                    </p>
                </form>
            </div>

            <!-- ── REGISTER ── -->
            <div id="registerForm" class="d-none">
                <div class="form-eyebrow">Get started</div>
                <h1 class="form-heading">Create your account</h1>
                <p class="form-sub">Fill in the details below to get started</p>

                <form method="POST" action="{{ route('register.store') }}">
                    @csrf

                    <div class="field-group">
                        <label class="field-label">Full Name</label>
                        <div class="field-wrap">
                            <i class="fa fa-user field-icon"></i>
                            <input type="text" name="name" class="field-input" placeholder="John Doe" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Email</label>
                        <div class="field-wrap">
                            <i class="fa fa-envelope field-icon"></i>
                            <input type="email" name="email" class="field-input" placeholder="you@example.com" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Phone</label>
                        <div class="field-wrap">
                            <i class="fa fa-phone field-icon"></i>
                            <input type="tel" name="phone" class="field-input" placeholder="+234 800 000 0000" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Address</label>
                        <div class="field-wrap">
                            <i class="fa fa-location-dot field-icon"></i>
                            <input type="text" name="address" class="field-input" placeholder="123 Main St" required>
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Password</label>
                        <div class="field-wrap">
                            <i class="fa fa-lock field-icon"></i>
                            <input type="password" name="password" id="registerPassword" class="field-input" placeholder="Create password" required>
                            <button type="button" class="pw-eye" onclick="togglePw('registerPassword', this)"><i class="fa fa-eye"></i></button>
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Confirm Password</label>
                        <div class="field-wrap">
                            <i class="fa fa-lock field-icon"></i>
                            <input type="password" name="password_confirmation" id="confirmPassword" class="field-input" placeholder="Repeat password" required>
                            <button type="button" class="pw-eye" onclick="togglePw('confirmPassword', this)"><i class="fa fa-eye"></i></button>
                        </div>
                    </div>

                    <label class="custom-check mb-3" style="font-size:.82rem;">
                        <input type="checkbox" name="terms" required>
                        I agree to the Terms &amp; Privacy Policy
                    </label>

                    <button type="submit" class="btn-auth">Create Account</button>

                    <p class="switch-text">
                        Already have an account?
                        <a onclick="switchForm('login')">Sign in</a>
                    </p>
                </form>
            </div>


                <!-- ── FORGOT PASSWORD: Request ── -->
                <div id="forgotForm" class="auth-screen d-none">
                    <button type="button" class="back-btn" onclick="switchScreen('login')">
                        <i class="fa fa-arrow-left"></i> Back to sign in
                    </button>
                    <div class="form-eyebrow">Account recovery</div>
                    <h1 class="form-heading">Forgot your<br>password?</h1>
                    <p class="form-sub">No worries — enter your email and we'll send you a reset link.</p>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="field-group">
                            <label class="field-label">Email Address</label>
                            <div class="field-wrap">
                                <i class="fa fa-envelope field-icon"></i>
                                <input type="email" name="email" id="forgotEmail" class="field-input"
                                    placeholder="you@example.com" required>
                            </div>
                        </div>
                        <button type="submit" class="btn-auth mt-2">
                            <i class="fa fa-paper-plane me-2"></i> Send Reset Link
                        </button>
                    </form>
                </div>

                <!-- ── FORGOT PASSWORD: Sent confirmation ── -->
                <div id="forgotSentForm" class="auth-screen d-none">
                    <button type="button" class="back-btn" onclick="switchScreen('login')">
                        <i class="fa fa-arrow-left"></i> Back to sign in
                    </button>
                    <div class="sent-icon">
                        <i class="fa fa-envelope-circle-check"></i>
                    </div>
                    <div class="form-eyebrow">Check your inbox</div>
                    <h1 class="form-heading">Reset link sent!</h1>
                    <p class="form-sub">We've sent a password reset link to</p>
                    <div class="sent-email-chip">
                        <i class="fa fa-envelope" style="font-size:.72rem;"></i>
                        <span id="sentEmailDisplay">{{ old('email', session('reset_email', 'your email')) }}</span>
                    </div>
                    <p style="font-size:.82rem; color:var(--muted); line-height:1.6;">
                        Click the link in the email to reset your password. If you don't see it, check your spam folder.
                    </p>
                    <button type="button" class="btn-auth mt-3" onclick="switchScreen('login')">
                        <i class="fa fa-arrow-left me-2"></i> Back to Sign In
                    </button>
                    <div class="resend-text">
                        Didn't receive it?
                        <button onclick="switchScreen('forgot')">Resend email</button>
                    </div>
                </div>

            <div class="auth-footer">© {{ date('Y') }} LaundryPro. All rights reserved.</div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // ── All screens: login | register | forgot | forgotSent ──
    const SCREENS = {
        login:      { el: 'loginForm',      tabs: true,  tabActive: 'login'    },
        register:   { el: 'registerForm',   tabs: true,  tabActive: 'register' },
        forgot:     { el: 'forgotForm',     tabs: false                        },
        forgotSent: { el: 'forgotSentForm', tabs: false                        },
    };

    const tabsEl   = () => document.querySelector('.form-tabs');
    const allScreenEls = () => Object.values(SCREENS).map(s => document.getElementById(s.el));

    function slideIn(el) {
        el.classList.remove('d-none');
        el.classList.add('slide-in');
        el.addEventListener('animationend', () => el.classList.remove('slide-in'), { once: true });
    }

    function switchScreen(name) {
        // Hide all
        allScreenEls().forEach(el => { if (el) el.classList.add('d-none'); });

        const screen = SCREENS[name];
        const target = document.getElementById(screen.el);

        // Toggle tabs visibility
        tabsEl().style.display = screen.tabs ? '' : 'none';

        // Update active tab if relevant
        if (screen.tabs) {
            document.getElementById('tab-login').classList.toggle('active', screen.tabActive === 'login');
            document.getElementById('tab-register').classList.toggle('active', screen.tabActive === 'register');
        }

        // Slide in new screen (no slide for login/register on first load)
        const shouldSlide = name === 'forgot' || name === 'forgotSent';
        if (shouldSlide) {
            slideIn(target);
        } else {
            target.classList.remove('d-none');
        }
    }

    // Keep old switchForm working (used by tab buttons)
    function switchForm(type) { switchScreen(type); }

    function togglePw(id, btn) {
        const input = document.getElementById(id);
        const icon  = btn.querySelector('i');
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        icon.classList.toggle('fa-eye',      !isHidden);
        icon.classList.toggle('fa-eye-slash', isHidden);
    }

    // Show sent confirmation screen (called after form submit via HTMX or JS)
    function showForgotSent() {
        const email = document.getElementById('forgotEmail').value;
        document.getElementById('sentEmailDisplay').textContent = email || 'your email';
        switchScreen('forgotSent');
    }

    // Auto-dismiss alerts
    setTimeout(() => {
        const alert = document.getElementById('alert');
        if (alert) {
            alert.style.transition = 'opacity .4s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 400);
        }
    }, 5000);

    // Show correct screen on page load based on Laravel session/errors
    @if (session('status'))
        switchScreen('forgotSent');
    @elseif ($errors->any() && old('name'))
        switchScreen('register');
    @elseif ($errors->any() && old('email') && !old('name'))
        // Could be forgot password error — stay on forgot
        switchScreen('forgot');
    @endif
</script>

</body>
</html>
