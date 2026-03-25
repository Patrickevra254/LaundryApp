{{-- <section class="notifs-page mb-4">

    <!-- Header -->
    <div class="notifs-header mb-3">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
            <div>
                <div class="notifs-label">Activity Feed</div>
                <h4 class="notifs-title mb-0">Notifications</h4>
                <p class="notifs-sub mb-0">Stay on top of your laundry operations</p>
            </div>

            @if ($notifications->count() > 0)
                <div class="d-flex gap-2 align-items-center">
                    @if (auth()->user()->unreadNotifications->count() > 0)
                        <form method="POST" action="{{ route('notifications.readAll') }}">
                            @csrf
                            <button class="n-btn n-btn-secondary">
                                <i class="fa fa-check-double"></i> Mark all read
                            </button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('notifications.destroyAll') }}"
                        onsubmit="return confirm('Delete all notifications?')">
                        @csrf @method('DELETE')
                        <button class="n-btn n-btn-danger">
                            <i class="fa fa-trash"></i> Clear all
                        </button>
                    </form>
                </div>
            @endif
        </div>

        @if ($notifications->count() > 0)
            <div class="notifs-stats mt-3">
                <span class="stat-item"><strong>{{ $notifications->total() }}</strong> Total</span>
                <span class="stat-sep"></span>
                <span class="stat-item accent"><strong>{{ auth()->user()->unreadNotifications->count() }}</strong>
                    Unread</span>
                <span class="stat-sep"></span>
                <span
                    class="stat-item"><strong>{{ $notifications->total() - auth()->user()->unreadNotifications->count() }}</strong>
                    Read</span>
            </div>
        @endif
    </div>

    <!-- List -->
    <div class="notifs-list">
        @forelse($notifications as $index => $notification)
            @php
                $isUnread = is_null($notification->read_at);
                $title = strtolower($notification->data['title'] ?? '');
                $icon = 'fa-bell';
                $iconColor = 'default';
                if (str_contains($title, 'order')) {
                    $icon = 'fa-bag-shopping';
                    $iconColor = 'green';
                } elseif (str_contains($title, 'payment') || str_contains($title, 'paid')) {
                    $icon = 'fa-credit-card';
                    $iconColor = 'teal';
                } elseif (str_contains($title, 'user') || str_contains($title, 'customer')) {
                    $icon = 'fa-user';
                    $iconColor = 'purple';
                } elseif (str_contains($title, 'alert') || str_contains($title, 'warning')) {
                    $icon = 'fa-triangle-exclamation';
                    $iconColor = 'amber';
                } elseif (str_contains($title, 'complete') || str_contains($title, 'done')) {
                    $icon = 'fa-circle-check';
                    $iconColor = 'green';
                } elseif (str_contains($title, 'cancel')) {
                    $icon = 'fa-circle-xmark';
                    $iconColor = 'red';
                }
            @endphp

            <div class="notif-row {{ $isUnread ? 'is-unread' : '' }}" style="animation-delay:{{ $index * 0.04 }}s">
                <div class="notif-icon ic-{{ $iconColor }}"><i class="fa {{ $icon }}"></i></div>

                <div class="notif-body">
                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                        <div class="d-flex align-items-center gap-2">
                            @if ($isUnread)
                                <span class="u-dot"></span>
                            @endif
                            <span class="notif-title">{{ $notification->data['title'] }}</span>
                        </div>
                        <span class="notif-time"><i class="fa fa-clock"></i>
                            {{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="notif-msg mt-1 mb-0">{{ $notification->data['message'] }}</p>
                </div>

                <div class="notif-actions">
                    @if ($isUnread)
                        <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                            @csrf
                            <button class="n-icon-btn" title="Mark as read"><i
                                    class="fa fa-check text-success"></i></button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}"
                        onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="n-icon-btn" title="Delete"><i class="fa fa-trash text-danger"></i></button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center py-5 text-muted">
                <i class="fa fa-bell-slash mb-2" style="font-size:2rem;opacity:.4;"></i>
                <p class="mb-0 small">You're all caught up!</p>
            </div>
        @endforelse
    </div>

    @if ($notifications->hasPages())
        <div class="mt-4 d-flex justify-content-center notifs-pagination">
            {{ $notifications->links('pagination::bootstrap-5') }}
        </div>
    @endif

</section>

<style>
    .notifs-label {
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: #a5b4fc;
    }

    .notifs-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0f0f1a;
        letter-spacing: -.02em;
    }

    .notifs-sub {
        font-size: .82rem;
        color: #9ca3af;
        margin-top: 2px;
    }

    .notifs-header {
        padding-bottom: 1rem;
        border-bottom: 1px solid #f0f0f8;
    }

    .notifs-stats {
        display: inline-flex;
        align-items: center;
        background: #fafafc;
        border: 1px solid #ebebf5;
        border-radius: 10px;
        padding: .35rem .6rem;
        font-size: .78rem;
        color: #6b7280;
    }

    .stat-item {
        padding: 0 .6rem;
    }

    .stat-item.accent strong {
        color: #4f46e5;
    }

    .stat-sep {
        width: 1px;
        height: 14px;
        background: #e5e7eb;
    }

    .n-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: .38rem .85rem;
        border-radius: 8px;
        font-size: .8rem;
        font-weight: 600;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all .15s;
    }

    .n-btn-secondary {
        background: #f3f4f6;
        border-color: #e5e7eb;
        color: #374151;
    }

    .n-btn-secondary:hover {
        background: #e9eaec;
    }

    .n-btn-danger {
        background: #fff5f5;
        border-color: #ffd5d5;
        color: #dc2626;
    }

    .n-btn-danger:hover {
        background: #fee2e2;
    }

    .notifs-list {
        display: flex;
        flex-direction: column;
    }

    .notif-row {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: .9rem .4rem;
        border-bottom: 1px solid #f3f4f8;
        border-radius: 10px;
        transition: background .15s;
        animation: rowIn .3s ease both;
    }

    .notif-row:last-child {
        border-bottom: none;
    }

    .notif-row:hover {
        background: #f9fafb;
    }

    .notif-row.is-unread {
        background: linear-gradient(to right, rgba(79, 70, 229, .04), transparent);
    }

    .notif-row.is-unread:hover {
        background: linear-gradient(to right, rgba(79, 70, 229, .07), #f9fafb);
    }

    @keyframes rowIn {
        from {
            opacity: 0;
            transform: translateY(5px)
        }

        to {
            opacity: 1;
            transform: none
        }
    }

    .notif-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .85rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .ic-default {
        background: #eef2ff;
        color: #4f46e5;
    }

    .ic-green {
        background: #ecfdf5;
        color: #059669;
    }

    .ic-teal {
        background: #f0fdfa;
        color: #0d9488;
    }

    .ic-purple {
        background: #f5f3ff;
        color: #7c3aed;
    }

    .ic-amber {
        background: #fffbeb;
        color: #d97706;
    }

    .ic-red {
        background: #fff1f2;
        color: #e11d48;
    }

    .notif-body {
        flex: 1;
        min-width: 0;
    }

    .notif-title {
        font-size: .85rem;
        font-weight: 600;
        color: #111827;
    }

    .notif-msg {
        font-size: .8rem;
        color: #6b7280;
        line-height: 1.5;
        word-break: break-word;
    }

    .notif-time {
        font-size: .72rem;
        color: #b0b7c3;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 3px;
        flex-shrink: 0;
    }

    .u-dot {
        width: 7px;
        height: 7px;
        min-width: 7px;
        border-radius: 50%;
        background: #4f46e5;
        display: inline-block;
    }

    .notif-actions {
        display: flex;
        gap: 3px;
        flex-shrink: 0;
        opacity: 0;
        transition: opacity .15s;
        padding-top: 2px;
    }

    .notif-row:hover .notif-actions {
        opacity: 1;
    }

    .n-icon-btn {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        border: none;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .75rem;
        cursor: pointer;
        transition: background .15s;
    }

    .n-icon-btn:hover {
        background: #e9eaec;
    }

    .notifs-pagination .page-link {
        border-radius: 8px !important;
        border-color: #ebebf5;
        color: #4f46e5;
        font-size: .82rem;
    }

    .notifs-pagination .page-item.active .page-link {
        background: #4f46e5;
        border-color: #4f46e5;
        color: #fff;
    }

    .notifs-pagination .page-link:hover {
        background: #eef2ff;
        color: #3730a3;
    }

    @media(max-width:576px) {
        .notif-title {
            white-space: normal;
        }

        .notif-actions {
            opacity: 1;
        }
    }
</style> --}}

<section class="notifs-page mb-4">

    <!-- Header -->
    <div class="notifs-header mb-3">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
            <div>
                <div class="notifs-label">Activity Feed</div>
                <h4 class="notifs-title mb-0">Notifications</h4>
                <p class="notifs-sub mb-0">Stay on top of your laundry operations</p>
            </div>

            @if ($notifications->count() > 0)
                <div class="d-flex gap-2 align-items-center">
                    @if (auth()->user()->unreadNotifications->count() > 0)
                        <form method="POST" action="{{ route('notifications.readAll') }}">
                            @csrf
                            <button class="n-btn n-btn-secondary">
                                <i class="fa fa-check-double"></i> Mark all read
                            </button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('notifications.destroyAll') }}" class="swal-delete-form"
                        data-name="all notifications" data-type="clear" data-title="Clear All Notifications?"
                        data-message="This will permanently delete all your notifications. This cannot be undone.">
                        @csrf @method('DELETE')
                        <button class="n-btn n-btn-danger">
                            <i class="fa fa-trash"></i> Clear all
                        </button>
                    </form>
                </div>
            @endif
        </div>

        @if ($notifications->count() > 0)
            <div class="notifs-stats mt-3">
                <span class="stat-item"><strong>{{ $notifications->total() }}</strong> Total</span>
                <span class="stat-sep"></span>
                <span class="stat-item accent"><strong>{{ auth()->user()->unreadNotifications->count() }}</strong>
                    Unread</span>
                <span class="stat-sep"></span>
                <span
                    class="stat-item"><strong>{{ $notifications->total() - auth()->user()->unreadNotifications->count() }}</strong>
                    Read</span>
            </div>
        @endif
    </div>

    <!-- List -->
    <div class="notifs-list">
        @forelse($notifications as $index => $notification)
            @php
                $isUnread = is_null($notification->read_at);
                $title = strtolower($notification->data['title'] ?? '');
                $icon = 'fa-bell';
                $iconColor = 'default';
                if (str_contains($title, 'order')) {
                    $icon = 'fa-bag-shopping';
                    $iconColor = 'green';
                } elseif (str_contains($title, 'payment') || str_contains($title, 'paid')) {
                    $icon = 'fa-credit-card';
                    $iconColor = 'teal';
                } elseif (str_contains($title, 'user') || str_contains($title, 'customer')) {
                    $icon = 'fa-user';
                    $iconColor = 'purple';
                } elseif (str_contains($title, 'alert') || str_contains($title, 'warning')) {
                    $icon = 'fa-triangle-exclamation';
                    $iconColor = 'amber';
                } elseif (str_contains($title, 'complete') || str_contains($title, 'done')) {
                    $icon = 'fa-circle-check';
                    $iconColor = 'green';
                } elseif (str_contains($title, 'cancel')) {
                    $icon = 'fa-circle-xmark';
                    $iconColor = 'red';
                }
            @endphp

            <div class="notif-row {{ $isUnread ? 'is-unread' : '' }}" style="animation-delay:{{ $index * 0.04 }}s">
                <div class="notif-icon ic-{{ $iconColor }}"><i class="fa {{ $icon }}"></i></div>

                <div class="notif-body">
                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                        <div class="d-flex align-items-center gap-2">
                            @if ($isUnread)
                                <span class="u-dot"></span>
                            @endif
                            <span class="notif-title">{{ $notification->data['title'] }}</span>
                        </div>
                        <span class="notif-time">
                            <i class="fa fa-clock"></i> {{ $notification->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <p class="notif-msg mt-1 mb-0">{{ $notification->data['message'] }}</p>
                </div>

                <div class="notif-actions">
                    @if ($isUnread)
                        <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                            @csrf
                            <button class="n-icon-btn" title="Mark as read">
                                <i class="fa fa-check text-success"></i>
                            </button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}"
                        class="swal-delete-form" data-name="{{ $notification->data['title'] ?? 'this notification' }}"
                        data-type="single" data-title="Delete Notification?"
                        data-message="This notification will be permanently removed.">
                        @csrf @method('DELETE')
                        <button type="submit" class="n-icon-btn" title="Delete">
                            <i class="fa fa-trash text-danger"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center py-5 text-muted">
                <i class="fa fa-bell-slash mb-2" style="font-size:2rem;opacity:.4;"></i>
                <p class="mb-0 small">You're all caught up!</p>
            </div>
        @endforelse
    </div>

    @if ($notifications->hasPages())
        <div class="mt-4 d-flex justify-content-center notifs-pagination">
            {{ $notifications->links('pagination::bootstrap-5') }}
        </div>
    @endif

</section>

<style>
    .notifs-label {
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: #a5b4fc;
    }

    .notifs-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0f0f1a;
        letter-spacing: -.02em;
    }

    .notifs-sub {
        font-size: .82rem;
        color: #9ca3af;
        margin-top: 2px;
    }

    .notifs-header {
        padding-bottom: 1rem;
        border-bottom: 1px solid #f0f0f8;
    }

    .notifs-stats {
        display: inline-flex;
        align-items: center;
        background: #fafafc;
        border: 1px solid #ebebf5;
        border-radius: 10px;
        padding: .35rem .6rem;
        font-size: .78rem;
        color: #6b7280;
    }

    .stat-item {
        padding: 0 .6rem;
    }

    .stat-item.accent strong {
        color: #4f46e5;
    }

    .stat-sep {
        width: 1px;
        height: 14px;
        background: #e5e7eb;
    }

    .n-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: .38rem .85rem;
        border-radius: 8px;
        font-size: .8rem;
        font-weight: 600;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all .15s;
    }

    .n-btn-secondary {
        background: #f3f4f6;
        border-color: #e5e7eb;
        color: #374151;
    }

    .n-btn-secondary:hover {
        background: #e9eaec;
    }

    .n-btn-danger {
        background: #fff5f5;
        border-color: #ffd5d5;
        color: #dc2626;
    }

    .n-btn-danger:hover {
        background: #fee2e2;
    }

    .notifs-list {
        display: flex;
        flex-direction: column;
    }

    .notif-row {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: .9rem .4rem;
        border-bottom: 1px solid #f3f4f8;
        border-radius: 10px;
        transition: background .15s;
        animation: rowIn .3s ease both;
    }

    .notif-row:last-child {
        border-bottom: none;
    }

    .notif-row:hover {
        background: #f9fafb;
    }

    .notif-row.is-unread {
        background: linear-gradient(to right, rgba(79, 70, 229, .04), transparent);
    }

    .notif-row.is-unread:hover {
        background: linear-gradient(to right, rgba(79, 70, 229, .07), #f9fafb);
    }

    @keyframes rowIn {
        from {
            opacity: 0;
            transform: translateY(5px)
        }

        to {
            opacity: 1;
            transform: none
        }
    }

    .notif-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .85rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .ic-default {
        background: #eef2ff;
        color: #4f46e5;
    }

    .ic-green {
        background: #ecfdf5;
        color: #059669;
    }

    .ic-teal {
        background: #f0fdfa;
        color: #0d9488;
    }

    .ic-purple {
        background: #f5f3ff;
        color: #7c3aed;
    }

    .ic-amber {
        background: #fffbeb;
        color: #d97706;
    }

    .ic-red {
        background: #fff1f2;
        color: #e11d48;
    }

    .notif-body {
        flex: 1;
        min-width: 0;
    }

    .notif-title {
        font-size: .85rem;
        font-weight: 600;
        color: #111827;
    }

    .notif-msg {
        font-size: .8rem;
        color: #6b7280;
        line-height: 1.5;
        word-break: break-word;
    }

    .notif-time {
        font-size: .72rem;
        color: #b0b7c3;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 3px;
        flex-shrink: 0;
    }

    .u-dot {
        width: 7px;
        height: 7px;
        min-width: 7px;
        border-radius: 50%;
        background: #4f46e5;
        display: inline-block;
    }

    .notif-actions {
        display: flex;
        gap: 3px;
        flex-shrink: 0;
        opacity: 0;
        transition: opacity .15s;
        padding-top: 2px;
    }

    .notif-row:hover .notif-actions {
        opacity: 1;
    }

    .n-icon-btn {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        border: none;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .75rem;
        cursor: pointer;
        transition: background .15s;
    }

    .n-icon-btn:hover {
        background: #e9eaec;
    }

    .notifs-pagination .page-link {
        border-radius: 8px !important;
        border-color: #ebebf5;
        color: #4f46e5;
        font-size: .82rem;
    }

    .notifs-pagination .page-item.active .page-link {
        background: #4f46e5;
        border-color: #4f46e5;
        color: #fff;
    }

    .notifs-pagination .page-link:hover {
        background: #eef2ff;
        color: #3730a3;
    }

    @media(max-width:576px) {
        .notif-title {
            white-space: normal;
        }

        .notif-actions {
            opacity: 1;
        }
    }
</style>

<script>
    document.addEventListener('submit', function(e) {
        const form = e.target.closest('.swal-delete-form');
        if (!form) return;
        e.preventDefault();

        const type = form.dataset.type;
        const title = form.dataset.title || 'Delete?';
        const message = form.dataset.message || 'This cannot be undone.';
        const name = form.dataset.name || '';

        // "Clear all" uses a different style — no item name, red warning icon
        if (type === 'clear') {
            Swal.fire({
                icon: 'warning',
                title: title,
                text: message,
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#f3f4f6',
                confirmButtonText: '<i class="fa fa-trash me-1"></i> Yes, clear all',
                cancelButtonText: 'Cancel',
            }).then(result => {
                if (result.isConfirmed) form.submit();
            });
        } else {
            // Single notification delete — subtle, no icon overkill
            Swal.fire({
                icon: 'question',
                title: title,
                html: `<span style="font-size:.85rem;color:#6b7280;">${message}</span>`,
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#f3f4f6',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
            }).then(result => {
                if (result.isConfirmed) form.submit();
            });
        }
    });
</script>
