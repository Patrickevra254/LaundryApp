{{--
<section class="preferences-section my-4 ">

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
</style> --}}

<section class="preferences-section mb-4">

    <form action="" method="POST" hx-post="{{ route('preferences') }}" hx-get="{{ route('preferences') }}"
        hx-target="#content-area" hx-swap="innerHTML" hx-indicator=".htmx-indicator">
        @csrf

        <div class="row g-4">

            <!-- Theme -->
            <div class="col-12 col-lg-6">
                <div class="p-card">
                    <div class="p-card-header">
                        <div class="p-card-icon"><i class="fa fa-moon"></i></div>
                        <div>
                            <div class="p-card-title">Appearance</div>
                            <div class="p-card-sub">Choose your preferred theme</div>
                        </div>
                    </div>

                    <label class="p-label">Theme</label>
                    <select class="p-input" name="theme">
                        <option value="light">Light</option>
                        <option value="dark"> Dark</option>
                        <option value="system"> System default</option>
                    </select>
                </div>
            </div>

            <!-- Notifications -->
            <div class="col-12 col-lg-6">
                <div class="p-card">
                    <div class="p-card-header">
                        <div class="p-card-icon"><i class="fa fa-bell"></i></div>
                        <div>
                            <div class="p-card-title">Notifications</div>
                            <div class="p-card-sub">Control how you receive alerts</div>
                        </div>
                    </div>

                    <div class="pref-toggle-row">
                        <div>
                            <div class="pref-toggle-label">Email Notifications</div>
                            <div class="pref-toggle-sub">Receive updates via email</div>
                        </div>
                        <label class="pref-switch">
                            <input type="checkbox" name="email_notifications" checked>
                            <span class="pref-slider"></span>
                        </label>
                    </div>

                    <div class="pref-toggle-row mb-0">
                        <div>
                            <div class="pref-toggle-label">SMS Notifications</div>
                            <div class="pref-toggle-sub">Receive updates via text message</div>
                        </div>
                        <label class="pref-switch">
                            <input type="checkbox" name="sms_notifications">
                            <span class="pref-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-3 d-flex justify-content-end">
            <button type="submit" class="p-save-btn">
                <i class="fa fa-floppy-disk me-2"></i>Save Preferences
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

    /* Toggle rows */
    .pref-toggle-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: .75rem 0;
        border-bottom: 1px solid #f5f5fb;
        margin-bottom: .1rem;
    }

    .pref-toggle-label {
        font-size: .85rem;
        font-weight: 600;
        color: #111827;
    }

    .pref-toggle-sub {
        font-size: .75rem;
        color: #9ca3af;
        margin-top: 1px;
    }

    /* Toggle switch */
    .pref-switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 22px;
        flex-shrink: 0;
    }

    .pref-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .pref-slider {
        position: absolute;
        inset: 0;
        background: #e5e7eb;
        border-radius: 999px;
        cursor: pointer;
        transition: .2s;
    }

    .pref-slider:before {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        left: 3px;
        top: 3px;
        background: #fff;
        border-radius: 50%;
        transition: .2s;
    }

    .pref-switch input:checked+.pref-slider {
        background: #4f46e5;
    }

    .pref-switch input:checked+.pref-slider:before {
        transform: translateX(18px);
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
</style>
