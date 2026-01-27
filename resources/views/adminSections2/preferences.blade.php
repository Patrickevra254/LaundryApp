{{-- <section>

    <h2 class="fw-bold mb-4">Preferences</h2>

    <div class="card shadow-sm p-4" style="">

        <form>

            <h5 class="fw-bold">Theme</h5>
            <select class="form-select mb-4">
                <option>Light</option>
                <option>Dark</option>
            </select>

            <h5 class="fw-bold mb-4">Notification Settings</h5>
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" checked>
                <label class="form-check-label">Email Notifications</label>
            </div>

            <div class="form-check mt-2 mb-4">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label">SMS Notifications</label>
            </div>

            <button class="btn btn-primary">Save Preferences</button>

        </form>

    </div>

</section> --}}

<section class="preferences-section my-4 mt-2">

    <h2 class="fw-bold mb-4">Preferences</h2>

    <div class="card shadow-sm p-4 rounded">

        <form>

            <h5 class="fw-bold mb-3">Theme</h5>
            <select class="form-select mb-4">
                <option>Light</option>
                <option>Dark</option>
            </select>

            <h5 class="fw-bold mb-3">Notification Settings</h5>
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" checked>
                <label class="form-check-label">Email Notifications</label>
            </div>

            <div class="form-check mt-2 mb-4">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label">SMS Notifications</label>
            </div>

            <button class="btn btn-primary w-100">Save Preferences</button>

        </form>

    </div>

</section>

<style>
    .preferences-section h2 {
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
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }

    .form-label, .form-check-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #555;
    }

    .form-select {
        border-radius: 10px;
        padding: 0.65rem 0.75rem;
        border: 1px solid #ddd;
        transition: all 0.2s ease-in-out;
    }

    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
    }

    .form-check-input {
        margin-top: 0.25rem;
    }

    .btn-primary {
        border-radius: 10px;
        padding: 0.6rem;
        font-weight: 600;
        transition: all 0.2s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
    }

    @media (max-width: 576px) {
        .card {
            padding: 2rem 1.5rem;
        }
    }
</style>

