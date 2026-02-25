{{-- <section class="profile-section my-4">

    <h2 class="fw-bold mb-4">My Profile</h2>

    @if (isset($success))
        <div id="success-alert" class="alert alert-success">{{ $success }}</div>
    @endif

    <div class="card shadow-sm p-4 rounded">

        <form action="{{ route('profile.update') }}" method="POST" hx-post="{{ route('profile.update') }}"
            hx-target="#content-area" hx-swap="innerHTML" hx-indicator=".htmx-indicator">

            @csrf

            <h5 class="fw-bold mb-3">Personal Information</h5>

            <div class="mb-3">
                <label class="form-label fw-semibold">Full Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Phone</label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}">
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Address</label>
                <input type="text" class="form-control" name="address" value="{{ old('address', $user->address) }}">
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <hr class="my-4">

            <h5 class="fw-bold mb-3">Update Password</h5>

            <div class="mb-3">
                <label class="form-label fw-semibold">Current Password</label>
                <input type="password" class="form-control" name="current_password">
                @error('current_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">New Password</label>
                <input type="password" class="form-control" name="new_password">
                @error('new_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Confirm New Password</label>
                <input type="password" class="form-control" name="new_password_confirmation">
                @error('new_password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-primary w-100 mt-3">Save Changes</button>
        </form>

    </div>

</section>

<style>
    .profile-section h2 {
        font-size: 1.75rem;
        color: #333;
    }

    .card {
        background-color: #fff;
        border-radius: 12px;
        border: none;
        transition: all 0.2s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .form-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #555;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.65rem 0.75rem;
        border: 1px solid #ddd;
        transition: all 0.2s ease-in-out;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, .25);
    }

    button.btn-primary {
        border-radius: 10px;
        padding: 0.6rem;
        font-weight: 600;
        transition: all 0.2s ease-in-out;
    }

    button.btn-primary:hover {
        background-color: #0b5ed7;
    }

    .alert {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
    }

    @media (max-width: 576px) {
        .card {
            padding: 2rem 1.5rem;
        }
    }
</style> --}}



<section class="profile-section mb-4">

    @if (isset($success))
        <div id="success-alert" class="alert alert-success alert-dismissible mb-3">
            <i class="fa fa-circle-check me-2"></i>{{ $success }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" hx-post="{{ route('profile.update') }}"
        hx-target="#content-area" hx-swap="innerHTML" hx-indicator=".htmx-indicator">
        @csrf

        <div class="row g-4">

            <!-- Personal Info -->
            <div class="col-12 col-lg-6">
                <div class="p-card">
                    <div class="p-card-header">
                        <div class="p-card-icon"><i class="fa fa-user"></i></div>
                        <div>
                            <div class="p-card-title">Personal Information</div>
                            <div class="p-card-sub">Your basic account details</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="p-label">Full Name</label>
                        <input type="text" class="p-input" name="name" value="{{ old('name', $user->name) }}"
                            placeholder="John Doe">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="p-label">Email</label>
                        <input type="email" class="p-input" name="email" value="{{ old('email', $user->email) }}"
                            placeholder="you@example.com">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="p-label">Phone</label>
                        <input type="text" class="p-input" name="phone" value="{{ old('phone', $user->phone) }}"
                            placeholder="+1 000 000 0000">
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-0">
                        <label class="p-label">Address</label>
                        <input type="text" class="p-input" name="address"
                            value="{{ old('address', $user->address) }}" placeholder="123 Main St">
                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Password -->
            <div class="col-12 col-lg-6">
                <div class="p-card">
                    <div class="p-card-header">
                        <div class="p-card-icon"><i class="fa fa-lock"></i></div>
                        <div>
                            <div class="p-card-title">Update Password</div>
                            <div class="p-card-sub">Leave blank to keep current password</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="p-label">Current Password</label>
                        <input type="password" class="p-input" name="current_password" placeholder="••••••••">
                        @error('current_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="p-label">New Password</label>
                        <input type="password" class="p-input" name="new_password" placeholder="••••••••">
                        @error('new_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-0">
                        <label class="p-label">Confirm New Password</label>
                        <input type="password" class="p-input" name="new_password_confirmation" placeholder="••••••••">
                        @error('new_password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-3 d-flex justify-content-end">
            <button type="submit" class="p-save-btn">
                <i class="fa fa-floppy-disk me-2"></i>Save Changes
            </button>
        </div>

    </form>

</section>

<style>
    .p-card {
        background: #fff;
        border: 1px solid #f0f0f8;
        border-radius: 14px;
        padding: 1.4rem;
        height: 100%;
    }

    .p-card-header {
        display: flex;
        align-items: center;
        gap: .85rem;
        margin-bottom: 1.4rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f5f5fb;
    }

    .p-card-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #eef2ff;
        color: #4f46e5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .9rem;
        flex-shrink: 0;
    }

    .p-card-title {
        font-size: .9rem;
        font-weight: 700;
        color: #111827;
    }

    .p-card-sub {
        font-size: .75rem;
        color: #9ca3af;
        margin-top: 1px;
    }

    .p-label {
        font-size: .78rem;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 5px;
        display: block;
    }

    .p-input {
        width: 100%;
        border-radius: 9px;
        border: 1px solid #e5e7eb;
        padding: .55rem .75rem;
        font-size: .85rem;
        color: #111827;
        background: #fafafa;
        transition: all .15s;
        outline: none;
    }

    .p-input:focus {
        border-color: #a5b4fc;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, .08);
    }

    .p-input::placeholder {
        color: #c4c9d4;
    }

    .p-save-btn {
        display: inline-flex;
        align-items: center;
        padding: .55rem 1.4rem;
        border-radius: 9px;
        background: #4f46e5;
        color: #fff;
        font-size: .85rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: background .15s;
    }

    .p-save-btn:hover {
        background: #4338ca;
    }

    .alert-success {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #15803d;
        border-radius: 10px;
        font-size: .85rem;
    }
</style>
