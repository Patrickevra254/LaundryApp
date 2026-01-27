<div class="row g-4">

    <!-- Widget 1 -->
    <div class="col-lg-3 col-md-6">
        <div class="widget-card">
            <div class="widget-icon bg-primary bg-opacity-25 text-primary">
                <i class="fa fa-users"></i>
            </div>
            <div>
                <h5 class="widget-title">Total Users</h5>
                <h2 class="widget-value">12,450</h2>
                <div class="widget-meta text-success">
                    <i class="fa fa-arrow-up"></i>
                    +8.4% this month
                </div>
            </div>
        </div>
    </div>

    <!-- Widget 2 -->
    <div class="col-lg-3 col-md-6">
        <div class="widget-card">
            <div class="widget-icon bg-warning bg-opacity-25 text-warning">
                <i class="fa fa-chart-line"></i>
            </div>
            <div>
                <h5 class="widget-title">Revenue</h5>
                <h2 class="widget-value">$39,200</h2>
                <div class="widget-meta text-success">
                    <i class="fa fa-arrow-up"></i>
                    +12.1% this month
                </div>
            </div>
        </div>
    </div>

    <!-- Widget 3 -->
    <div class="col-lg-3 col-md-6">
        <div class="widget-card">
            <div class="widget-icon bg-danger bg-opacity-25 text-danger">
                <i class="fa fa-server"></i>
            </div>
            <div>
                <h5 class="widget-title">System Load</h5>
                <h2 class="widget-value">64%</h2>
                <div class="widget-meta text-danger">
                    <i class="fa fa-arrow-down"></i>
                    -3.5% today
                </div>
            </div>
        </div>
    </div>

    <!-- Widget 4 -->
    <div class="col-lg-3 col-md-6">
        <div class="widget-card">
            <div class="widget-icon bg-info bg-opacity-25 text-info">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div>
                <h5 class="widget-title">New Orders</h5>
                <h2 class="widget-value">532</h2>
                <div class="widget-meta text-success">
                    <i class="fa fa-arrow-up"></i>
                    +5.9% this week
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    /* Widget Card (Glass Depth) */
    .widget-card {
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(12px);
        border-radius: 16px;
        padding: 1.6rem;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);

        display: flex;
        align-items: center;
        gap: 1.2rem;

        min-height: 180px;
        /* 👈 ensures consistent height */

        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }


    .widget-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.18);
    }

    /* Icon container */
    .widget-icon {
        width: 55px;
        height: 55px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    /* Text */
    .widget-title {
        font-size: 0.95rem;
        opacity: 0.85;
    }

    .widget-value {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
    }

    .widget-meta {
        font-size: 0.85rem;
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
</style>
