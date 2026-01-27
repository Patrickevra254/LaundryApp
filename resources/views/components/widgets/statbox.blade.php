<div class="row g-4">
    <div class="col-xl-4 col-md-6">
        <div class="stat-box">
            <div class="stat-icon-container stat-icon-primary">
                <i class="fa fa-users stat-icon"></i>
            </div>

            <div class="stat-content">
                <div class="stat-header">
                    <span class="stat-title">Total Users</span>
                    <span class="stat-change text-success">
                        <i class="fa fa-arrow-up fa-xs"></i>
                        +12.5%
                    </span>
                </div>

                <div class="stat-value">12,543</div>
                <div class="stat-subtitle">Active this month</div>
            </div>

            <div class="stat-gradient-overlay stat-gradient-primary"></div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="stat-box">
            <div class="stat-icon-container stat-icon-success">
                <i class="fa fa-dollar-sign stat-icon"></i>
            </div>

            <div class="stat-content">
                <div class="stat-header">
                    <span class="stat-title">Revenue</span>
                    <span class="stat-change text-success">
                        <i class="fa fa-arrow-up fa-xs"></i>
                        +8.2%
                    </span>
                </div>

                <div class="stat-value">$45,890</div>
                <div class="stat-subtitle">Compared to last month</div>
            </div>

            <div class="stat-gradient-overlay stat-gradient-success"></div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="stat-box">
            <div class="stat-icon-container stat-icon-warning">
                <i class="fa fa-shopping-cart stat-icon"></i>
            </div>

            <div class="stat-content">
                <div class="stat-header">
                    <span class="stat-title">Orders</span>
                    <span class="stat-change text-danger">
                        <i class="fa fa-arrow-down fa-xs"></i>
                        -3.1%
                    </span>
                </div>

                <div class="stat-value">2,456</div>
                <div class="stat-subtitle">Pending processing</div>
            </div>

            <div class="stat-gradient-overlay stat-gradient-warning"></div>
        </div>
    </div>
</div>

<style>
.stat-box {
    position: relative;
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 1.5rem;
    box-shadow: 0 8px 32px var(--shadow-color), inset 0 1px 0 rgba(255, 255, 255, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.18);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    display: flex;
    gap: 1rem;
    align-items: flex-start;
}

.stat-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--accent-color) 0%, #00f2fe 50%, var(--accent-color) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.stat-box:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 16px 48px var(--shadow-color), inset 0 1px 0 rgba(255, 255, 255, 0.4);
}

.stat-box:hover::before {
    opacity: 1;
}

.stat-icon-container {
    width: 64px;
    height: 64px;
    min-width: 64px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15), inset 0 -2px 8px rgba(0, 0, 0, 0.2);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 2;
}

.stat-icon-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.stat-icon-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.stat-icon-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.stat-box:hover .stat-icon-container {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.2), inset 0 -2px 8px rgba(0, 0, 0, 0.3);
}

.stat-icon {
    font-size: 1.75rem;
    color: #ffffff;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
}

.stat-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    z-index: 2;
    position: relative;
}

.stat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 0.5rem;
}

.stat-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-color);
    opacity: 0.8;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-change {
    font-size: 0.8rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}

.stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-color);
    line-height: 1.2;
    letter-spacing: -0.5px;
}

.stat-subtitle {
    font-size: 0.8rem;
    color: var(--text-color);
    opacity: 0.6;
    font-weight: 500;
}

.stat-gradient-overlay {
    position: absolute;
    bottom: -50%;
    right: -20%;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    opacity: 0.08;
    filter: blur(40px);
    transition: all 0.6s ease;
    pointer-events: none;
    z-index: 1;
}

.stat-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.stat-gradient-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.stat-gradient-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.stat-box:hover .stat-gradient-overlay {
    opacity: 0.15;
    bottom: -40%;
    right: -15%;
    transform: scale(1.2);
}

@media (max-width: 768px) {
    .stat-box {
        padding: 1.25rem;
    }

    .stat-icon-container {
        width: 56px;
        height: 56px;
        min-width: 56px;
    }

    .stat-icon {
        font-size: 1.5rem;
    }

    .stat-value {
        font-size: 1.75rem;
    }
}

[data-theme="dark"] .stat-box {
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

[data-theme="dark"] .stat-box:hover {
    box-shadow: 0 16px 48px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.15);
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stat-box {
    animation: slideInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.col-xl-4:nth-child(1) .stat-box { animation-delay: 0.1s; }
.col-xl-4:nth-child(2) .stat-box { animation-delay: 0.2s; }
.col-xl-4:nth-child(3) .stat-box { animation-delay: 0.3s; }
</style>
