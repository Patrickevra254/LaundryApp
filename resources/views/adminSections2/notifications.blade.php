<section class="notifications-section my-4 mt-2">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h4 class="fw-bold mb-0">Notifications</h4>
            <small class="text-muted">Recent updates and system alerts</small>
        </div>

        @if ($notifications->count() > 0)
            <div class="d-flex gap-2">
                @if (auth()->user()->unreadNotifications->count() > 0)
                    <form method="POST" action="{{ route('notifications.readAll') }}">
                        @csrf
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                            Mark all as read
                        </button>
                    </form>
                @endif

                <form method="POST" action="{{ route('notifications.destroyAll') }}"
                    onsubmit="return confirm('Delete all notifications?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3">
                        Delete all
                    </button>
                </form>
            </div>
        @endif
    </div>

    <!-- Notifications list -->
    <div class="notifications-list">

        @forelse($notifications as $notification)
            <div class="notification-card {{ is_null($notification->read_at) ? 'unread' : '' }}">

                <div class="notification-icon">
                    <i class="fa fa-bell"></i>
                </div>

                <div class="notification-body">

                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <h6 class="notification-title">
                            {{ $notification->data['title'] }}
                        </h6>

                        <div class="d-flex gap-1">
                            @if (is_null($notification->read_at))
                                <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                                    @csrf
                                    <button class="icon-btn" title="Mark as read">
                                        <i class="fa fa-check text-success"></i>
                                    </button>
                                </form>
                            @endif

                            <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}"
                                onsubmit="return confirm('Delete this notification?')">
                                @csrf
                                @method('DELETE')
                                <button class="icon-btn" title="Delete">
                                    <i class="fa fa-trash text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <p class="notification-text">
                        {{ $notification->data['message'] }}
                    </p>

                    <small class="notification-time">
                        {{ $notification->created_at->diffForHumans() }}
                    </small>

                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fa fa-bell-slash mb-3"></i>
                <h6>No notifications</h6>
                <p class="small text-muted">You’re all caught up</p>
            </div>
        @endforelse

    </div>

    <!-- Pagination -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $notifications->links('pagination::bootstrap-5') }}
    </div>

</section>

<style>
    /* Notifications Layout */
    .notifications-list {
        display: flex;
        flex-direction: column;
        gap: 0.9rem;
    }

    /* Notification Card */
    .notification-card {
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(12px);
        border-radius: 16px;
        padding: 1.4rem 1.6rem;

        display: flex;
        gap: 1.2rem;
        align-items: flex-start;

        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .notification-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.18);
    }

    /* Unread Highlight */
    .notification-card.unread {
        border-left: 4px solid #0d6efd;
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.08), rgba(255, 255, 255, 0.22));
    }

    /* Icon */
    .notification-icon {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        background: rgba(13, 110, 253, 0.15);
        color: #0d6efd;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 1.1rem;
        flex-shrink: 0;
    }

    /* Body */
    .notification-body {
        flex: 1;
    }

    .notification-title {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .notification-text {
        font-size: 0.85rem;
        line-height: 1.45;
        color: #6c757d;
        margin-bottom: 6px;
    }

    .notification-time {
        font-size: 0.75rem;
        color: #8b8f94;
    }

    /* Icon buttons */
    .icon-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: none;
        background: rgba(0, 0, 0, 0.04);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s ease;
    }

    .icon-btn:hover {
        background: rgba(0, 0, 0, 0.08);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3.5rem 1rem;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 2.2rem;
        opacity: 0.6;
    }

    /* Mobile */
    @media (max-width: 576px) {
        .notification-card {
            flex-direction: column;
        }

        .notification-icon {
            align-self: flex-start;
        }
    }
</style>
