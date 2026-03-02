<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaundryPro – Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap"
        rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

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

        html,
        body {
            height: 100%;
            overflow: hidden;
            font-family: 'DM Sans', sans-serif;
            background: #f5f5f9;
        }

        .auth-wrap {
            height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
        }

        /* ── Brand panel (same as login) ── */
        .brand-panel {
            background: var(--purple);
            background-image:
                radial-gradient(ellipse at 20% 20%, rgba(99, 91, 255, .6) 0%, transparent 55%),
                radial-gradient(ellipse at 80% 80%, rgba(49, 41, 180, .7) 0%, transparent 55%);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2rem 2.5rem;
        }

        .brand-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            opacity: .35;
            pointer-events: none;
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .1);
        }

        .bubble-1 {
            width: 320px;
            height: 320px;
            top: -80px;
            right: -80px;
        }

        .bubble-2 {
            width: 180px;
            height: 180px;
            bottom: 100px;
            left: -40px;
        }

        .bubble-3 {
            width: 90px;
            height: 90px;
            bottom: 260px;
            right: 40px;
        }

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
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, .18);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
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
            color: rgba(255, 255, 255, .75);
            font-size: .82rem;
            line-height: 1.55;
            max-width: 320px;
        }

        /* security checklist inside brand panel */
        .security-list {
            margin-top: 1.4rem;
            position: relative;
            z-index: 1;
        }

        .security-item {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .6rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            font-size: .8rem;
            color: rgba(255, 255, 255, .8);
        }

        .security-item:last-child {
            border: none;
        }

        .security-item .s-icon {
            width: 28px;
            height: 28px;
            background: rgba(255, 255, 255, .12);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            flex-shrink: 0;
        }

        .brand-stats {
            display: flex;
            gap: 1rem;
            position: relative;
            z-index: 1;
        }

        .stat-pill {
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .15);
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
            color: rgba(255, 255, 255, .6);
            margin-top: 3px;
        }

        /* ── Form panel ── */
        .form-panel {
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0 3rem;
            position: relative;
            height: 100vh;
            overflow-y: auto;
            scrollbar-width: none;
        }

        .form-panel::-webkit-scrollbar {
            display: none;
        }

        .form-panel::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: var(--purple-soft);
            opacity: .6;
            pointer-events: none;
        }

        .form-inner {
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            padding: 2.5rem 0;
            animation: fadeUp .4s ease both;
        }

        /* lock icon header */
        .lock-icon {
            width: 52px;
            height: 52px;
            background: var(--purple-soft);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: var(--purple);
            margin-bottom: 1.2rem;
        }

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
            margin-bottom: 1.4rem;
        }

        /* password strength bar */
        .strength-wrap {
            margin-top: 6px;
        }

        .strength-bar {
            height: 3px;
            border-radius: 999px;
            background: var(--border);
            overflow: hidden;
            margin-bottom: 4px;
        }

        .strength-fill {
            height: 100%;
            border-radius: 999px;
            width: 0%;
            transition: width .3s, background .3s;
        }

        .strength-label {
            font-size: .7rem;
            color: var(--muted);
        }

        /* alerts */
        .alert {
            border-radius: 10px;
            font-size: .83rem;
            border: none;
            padding: .75rem 1rem;
        }

        .alert-success {
            background: #ecfdf5;
            color: #065f46;
        }

        .alert-danger {
            background: #fff1f2;
            color: #9f1239;
        }

        /* fields */
        .field-group {
            margin-bottom: .75rem;
        }

        .field-label {
            font-size: .74rem;
            font-weight: 700;
            color: var(--purple-deep);
            margin-bottom: 5px;
            display: block;
            letter-spacing: .01em;
        }

        .field-wrap {
            position: relative;
        }

        .field-icon {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--purple-light);
            font-size: .78rem;
            pointer-events: none;
            transition: color .15s;
        }

        .field-wrap:focus-within .field-icon {
            color: var(--purple);
        }

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
            box-shadow: 0 0 0 3px rgba(79, 70, 229, .12);
        }

        .field-input::placeholder {
            color: #c4b5fd;
        }

        .pw-eye {
            position: absolute;
            right: 11px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            color: var(--purple-light);
            cursor: pointer;
            font-size: .82rem;
            padding: 0;
            transition: color .15s;
        }

        .pw-eye:hover {
            color: var(--purple);
        }

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
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .12) 0%, transparent 60%);
        }

        .btn-auth:hover {
            background: var(--purple-deep);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, .35);
        }

        .btn-auth:active {
            transform: translateY(0);
        }

        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 1rem;
            font-size: .82rem;
            font-weight: 600;
            color: var(--muted);
            text-decoration: none;
            transition: color .15s;
        }

        .back-link:hover {
            color: var(--purple);
        }

        .auth-footer {
            text-align: center;
            font-size: .73rem;
            color: var(--muted);
            margin-top: 1.5rem;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 900px) {
            .auth-wrap {
                grid-template-columns: 1fr;
            }

            .brand-panel {
                display: none;
            }

            .form-panel {
                padding: 2rem 1.5rem;
            }
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
                <h2>Secure your<br>account.</h2>
                <p>Create a strong password to keep your LaundryPro account protected.</p>

                <div class="security-list">
                    <div class="security-item">
                        <div class="s-icon"><i class="fa fa-lock"></i></div>
                        <span>At least 8 characters long</span>
                    </div>
                    <div class="security-item">
                        <div class="s-icon"><i class="fa fa-font"></i></div>
                        <span>Mix of uppercase and lowercase letters</span>
                    </div>
                    <div class="security-item">
                        <div class="s-icon"><i class="fa fa-hashtag"></i></div>
                        <span>Include numbers or special characters</span>
                    </div>
                    <div class="security-item">
                        <div class="s-icon"><i class="fa fa-ban"></i></div>
                        <span>Avoid using obvious personal info</span>
                    </div>
                </div>
            </div>

            <div class="brand-stats">
                <div class="stat-pill">
                    <div class="val">256-bit</div>
                    <div class="lbl">Encryption</div>
                </div>
                <div class="stat-pill">
                    <div class="val">100%</div>
                    <div class="lbl">Secure</div>
                </div>
                <div class="stat-pill">
                    <div class="val">24/7</div>
                    <div class="lbl">Monitored</div>
                </div>
            </div>
        </div>

        <!-- ── Form Panel ── -->
        <div class="form-panel">
            <div class="form-inner">

                @if (session('status'))
                    <div class="alert alert-success mb-3">{{ session('status') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="lock-icon">
                    <i class="fa fa-key"></i>
                </div>

                <div class="form-eyebrow">Password reset</div>
                <h1 class="form-heading">Create a new<br>password</h1>
                <p class="form-sub">Make it strong — you won't need to change it again soon.</p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                    <div class="field-group">
                        <label class="field-label">New Password</label>
                        <div class="field-wrap">
                            <i class="fa fa-lock field-icon"></i>
                            <input type="password" name="password" id="newPassword" class="field-input"
                                placeholder="Create a strong password" required oninput="checkStrength(this.value)">
                            <button type="button" class="pw-eye" onclick="togglePw('newPassword', this)">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                        <div class="strength-wrap">
                            <div class="strength-bar">
                                <div class="strength-fill" id="strengthFill"></div>
                            </div>
                            <span class="strength-label" id="strengthLabel">Enter a password</span>
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Confirm New Password</label>
                        <div class="field-wrap">
                            <i class="fa fa-lock field-icon"></i>
                            <input type="password" name="password_confirmation" id="confirmNewPassword"
                                class="field-input" placeholder="Repeat your new password" required>
                            <button type="button" class="pw-eye" onclick="togglePw('confirmNewPassword', this)">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-auth mt-2">
                        <i class="fa fa-shield-halved me-2"></i> Reset Password
                    </button>
                </form>

                <a href="{{ route('login') }}" class="back-link">
                    <i class="fa fa-arrow-left"></i> Back to sign in
                </a>

                <div class="auth-footer">© {{ date('Y') }} LaundryPro. All rights reserved.</div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePw(id, btn) {
            const input = document.getElementById(id);
            const icon = btn.querySelector('i');
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            icon.classList.toggle('fa-eye', !isHidden);
            icon.classList.toggle('fa-eye-slash', isHidden);
        }

        function checkStrength(val) {
            const fill = document.getElementById('strengthFill');
            const label = document.getElementById('strengthLabel');

            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const levels = [{
                    pct: '0%',
                    color: '#e5e7eb',
                    text: 'Enter a password'
                },
                {
                    pct: '25%',
                    color: '#f87171',
                    text: 'Weak'
                },
                {
                    pct: '50%',
                    color: '#fb923c',
                    text: 'Fair'
                },
                {
                    pct: '75%',
                    color: '#facc15',
                    text: 'Good'
                },
                {
                    pct: '100%',
                    color: '#22c55e',
                    text: 'Strong ✓'
                },
            ];

            const lvl = val.length === 0 ? levels[0] : levels[score];
            fill.style.width = lvl.pct;
            fill.style.background = lvl.color;
            label.textContent = lvl.text;
            label.style.color = val.length === 0 ? 'var(--muted)' : lvl.color;
        }
    </script>

</body>

</html>
