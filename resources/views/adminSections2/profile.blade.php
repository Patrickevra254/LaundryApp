<section class="profile-section my-4 mt-2">

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
</style>



{{-- <section>

    <h2 class="fw-bold mb-4">My Profile</h2>


    @if (isset($success))
        <div id="success-alert" class="alert alert-success">{{ $success }}</div>
    @endif


    <div class="card shadow-sm p-4">

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

</section> --}}

{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        const alert = document.getElementById("success-alert");
        if (alert) {
            setTimeout(() => {
                alert.style.transition = "opacity 0.6s ease";
                alert.style.opacity = "0";

                // fully remove after fade
                setTimeout(() => alert.remove(), 600);
            }, 3000); //  show for 3 seconds
        }
    });
</script> --}}
