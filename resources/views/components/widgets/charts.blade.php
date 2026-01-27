<div class="container-fluid mt-5">
    <div class="row g-4">
        <!-- Line Chart -->
        <div class="col-lg-6">
            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <h3 class="chart-title">Revenue Growth</h3>
                        <p class="chart-subtitle">Last 12 months performance</p>
                    </div>
                    <span class="chart-badge">+18.2%</span>
                </div>
                <div class="chart-container">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Bar Chart -->
        <div class="col-lg-6">
            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <h3 class="chart-title">Monthly Sales</h3>
                        <p class="chart-subtitle">Comparison by month</p>
                    </div>
                    <span class="chart-badge">Q4 2024</span>
                </div>
                <div class="chart-container">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Doughnut Chart -->
        <div class="col-lg-6">
            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <h3 class="chart-title">Traffic Sources</h3>
                        <p class="chart-subtitle">User acquisition channels</p>
                    </div>
                    <span class="chart-badge">Live</span>
                </div>
                <div class="chart-container">
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Area Chart -->
        <div class="col-lg-6">
            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <h3 class="chart-title">User Activity</h3>
                        <p class="chart-subtitle">Daily active users trend</p>
                    </div>
                    <span class="chart-badge">7 Days</span>
                </div>
                <div class="chart-container">
                    <canvas id="areaChart"></canvas>
                </div>
            </div>
        </div>


        {{-- sales and expenses --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 chart-card">
                <div class="card-header bg-white fw-bold">
                    Sales & Expenses Overview
                </div>
                <div class="card-body">
                    <canvas id="salesExpensesChart" height="130"></canvas>
                </div>
            </div>
        </div>

        {{-- tables --}}

        <div class="col-lg-6 mb-4">
            <div class="beautiful-table-card shadow-sm border-0">
                <div class="table-header">
                    <h4 class="mb-0 chart-title">Recent Sales & Expenses</h4>
                </div>

                <div class="table-responsive beautiful-table-wrapper">
                    <table class="table beautiful-table mb-0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th><i class="bi bi-graph-up-arrow me-1"></i> Sales</th>
                                <th><i class="bi bi-cash-coin me-1"></i> Expenses</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Jan 1</td>
                                <td>$1,200</td>
                                <td>$450</td>
                            </tr>
                            <tr>
                                <td>Jan 2</td>
                                <td>$980</td>
                                <td>$300</td>
                            </tr>
                            <tr>
                                <td>Jan 3</td>
                                <td>$1,430</td>
                                <td>$600</td>
                            </tr>
                            <tr>
                                <td>Jan 4</td>
                                <td>$1,050</td>
                                <td>$350</td>
                            </tr>
                            <tr>
                                <td>Jan 5</td>
                                <td>$1,650</td>
                                <td>$500</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>



<style>
    .chart-card {
        position: relative;
        background: var(--card-bg);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 8px 32px var(--shadow-color), inset 0 1px 0 rgba(255, 255, 255, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.18);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        height: 100%;
    }

    .chart-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px var(--shadow-color), inset 0 1px 0 rgba(255, 255, 255, 0.4);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .chart-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-color);
        margin: 0;
    }

    .chart-subtitle {
        font-size: 0.85rem;
        color: var(--text-color);
        opacity: 0.6;
        margin-top: 0.25rem;
    }

    .chart-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.35rem 0.75rem;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .chart-container {
        position: relative;
        height: 300px;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .chart-card {
        animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .row>div:nth-child(1) .chart-card {
        animation-delay: 0.1s;
    }

    .row>div:nth-child(2) .chart-card {
        animation-delay: 0.2s;
    }

    .row>div:nth-child(3) .chart-card {
        animation-delay: 0.3s;
    }

    .row>div:nth-child(4) .chart-card {
        animation-delay: 0.4s;
    }

    /******************************
     BEAUTIFUL TABLE STYLING
    *******************************/
    .beautiful-table-card {
        background: var(--card-bg);
        border-radius: 18px;
        overflow: hidden;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .table-header {
        padding: 1rem 1.4rem;
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(0, 0, 0, 0.07);
        font-weight: 600;
    }

    .beautiful-table-wrapper {
        max-height: 330px;
        overflow-y: auto;
    }

    .beautiful-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.95rem;
    }

    .beautiful-table thead th {
        background: #f8f9fc;
        position: sticky;
        top: 0;
        z-index: 5;
        padding: 14px;
        font-weight: 600;
        border-bottom: 2px solid rgba(0, 0, 0, 0.05);
    }

    .beautiful-table tbody tr {
        transition: all 0.25s ease;
    }

    .beautiful-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.08);
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    }

    .beautiful-table td {
        padding: 14px;
        vertical-align: middle;
        font-weight: 500;
    }

    .beautiful-table td:nth-child(2) {
        color: #0d6efd;
        /* blue for sales */
        font-weight: 600;
    }

    .beautiful-table td:nth-child(3) {
        color: #dc3545;
        /* red for expenses */
        font-weight: 600;
    }
</style>


<script>
    // Chart defaults
    Chart.defaults.font.family = 'Inter';
    Chart.defaults.color = '#666';

    // Line Chart
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Revenue',
                data: [12000, 19000, 15000, 25000, 22000, 30000, 28000, 35000, 32000, 40000, 38000,
                    45000
                ],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderWidth: 3,
                fill: false,
                tension: 0.4,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: '#667eea',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    borderRadius: 8,
                    titleFont: {
                        size: 14,
                        weight: '600'
                    },
                    bodyFont: {
                        size: 13
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Bar Chart
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Sales',
                data: [450, 520, 480, 590, 610, 680, 720, 780, 820, 900, 880, 950],
                backgroundColor: [
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(17, 153, 142, 0.8)',
                    'rgba(17, 153, 142, 0.8)'
                ],
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    borderRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Doughnut Chart
    const doughnutCtx = document.getElementById('doughnutChart').getContext('2d');
    new Chart(doughnutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Organic Search', 'Direct', 'Social Media', 'Referral', 'Email'],
            datasets: [{
                data: [35, 25, 20, 15, 5],
                backgroundColor: [
                    '#667eea',
                    '#11998e',
                    '#f093fb',
                    '#4facfe',
                    '#764ba2'
                ],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        padding: 15,
                        usePointStyle: true,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    borderRadius: 8,
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed + '%';
                        }
                    }
                }
            },
            cutout: '70%'
        }
    });

    // Area Chart
    const areaCtx = document.getElementById('areaChart').getContext('2d');
    new Chart(areaCtx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Active Users',
                data: [2400, 2800, 3200, 2900, 3500, 4200, 3800],
                borderColor: '#11998e',
                backgroundColor: 'rgba(17, 153, 142, 0.2)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: '#11998e',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    borderRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>

{{-- sales and expenses --}}

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const ctx = document.getElementById("salesExpensesChart").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May"],
                datasets: [{
                        label: "Sales",
                        data: [1200, 1450, 1600, 1800, 2000],
                        backgroundColor: "rgba(13,110,253,0.7)", // Bootstrap primary
                        borderRadius: 6
                    },
                    {
                        label: "Expenses",
                        data: [450, 500, 550, 600, 650],
                        type: "line",
                        borderColor: "#dc3545", // red
                        borderWidth: 3,
                        tension: 0.4,
                        fill: false,
                        pointBackgroundColor: "#dc3545",
                        pointRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    });
</script>
