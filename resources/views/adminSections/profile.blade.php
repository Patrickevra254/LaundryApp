{{-- <section>

    <h2 class="fw-bold mb-4">My Profile</h2>

    <div class="card shadow-sm p-4" style="">

        <form>
            <div class="mb-3">
                <label class="form-label fw-semibold">Full Name</label>
                <input type="text" class="form-control" value="Patrick Evra">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" value="patrick@example.com">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Phone</label>
                <input type="text" class="form-control" placeholder="+234 808 000 0000">
            </div>

            <button class="btn btn-primary">Save Changes</button>
        </form>

    </div>

</section> --}}

<section>

    <h2 class="fw-bold mb-4">My Profile</h2>

    {{-- @if (session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif --}}

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

</section>

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
