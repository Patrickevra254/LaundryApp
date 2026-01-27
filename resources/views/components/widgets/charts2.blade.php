<div class="container-fluid mt-4">

    <div class="row g-4">

        <!-- Chart 1 -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-4 p-3">
                <h6 class="fw-semibold mb-3">Monthly Growth</h6>
                <div id="chart1"></div>
            </div>
        </div>

        <!-- Chart 2 -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-4 p-3">
                <h6 class="fw-semibold mb-3">Revenue Overview</h6>
                <div id="chart2"></div>
            </div>
        </div>

        <!-- Chart 3 -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-4 p-3">
                <h6 class="fw-semibold mb-3">User Distribution</h6>
                <div id="chart3"></div>
            </div>
        </div>

        <!-- Chart 4 -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-4 p-3">
                <h6 class="fw-semibold mb-3">System Health Score</h6>
                <div id="chart4"></div>
            </div>
        </div>

    </div>

    <div class="card shadow-sm mt-4 mb-4">
        <div class="card-header bg-white">
            <h5 class="mb-0 fw-semibold">Sales vs Expenses</h5>
        </div>
        <div class="card-body">
            <div id="salesExpensesChart" style="height: 320px;"></div>
        </div>
    </div>


</div>

<style>
    .card {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(8px);
        border-radius: 1.4rem;
        border: 1px solid rgba(255, 255, 255, 0.4);
    }

    .dark-mode .card {
        background: rgba(30, 30, 30, 0.55);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        /* ============================
            CHART 1 — LINE CHART
        ============================= */
        new ApexCharts(document.querySelector("#chart1"), {
            chart: {
                type: 'line',
                height: 300,
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: "Users",
                data: [120, 150, 180, 200, 250, 300, 270, 320, 350, 400, 450, 500]
            }],
            stroke: {
                curve: 'smooth',
                width: 3
            },
            colors: ['#4a6cf7'],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                    'Nov', 'Dec'
                ]
            },
            grid: {
                borderColor: '#eee',
                strokeDashArray: 4
            },
            dataLabels: {
                enabled: false
            }
        }).render();


        /* ============================
            CHART 2 — BAR CHART
        ============================= */
        new ApexCharts(document.querySelector("#chart2"), {
            chart: {
                type: 'bar',
                height: 300,
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: "Revenue",
                data: [20, 35, 40, 55, 60, 85, 90, 95, 100, 120, 130, 145]
            }],
            colors: ['#22c55e'],
            plotOptions: {
                bar: {
                    borderRadius: 6,
                    columnWidth: '45%'
                }
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                    'Nov', 'Dec'
                ]
            },
            grid: {
                borderColor: '#eee',
                strokeDashArray: 4
            }
        }).render();


        /* ============================
            CHART 3 — DONUT CHART
        ============================= */
        new ApexCharts(document.querySelector("#chart3"), {
            chart: {
                type: 'donut',
                height: 300
            },
            series: [55, 30, 15],
            labels: ['Admins', 'Staff', 'Students'],
            colors: ['#4a6cf7', '#22c55e', '#fbbf24'],
            legend: {
                position: 'bottom'
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%'
                    }
                }
            },
            dataLabels: {
                enabled: true
            }
        }).render();


        /* ============================
            CHART 4 — RADIAL PROGRESS
        ============================= */
        new ApexCharts(document.querySelector("#chart4"), {
            chart: {
                type: 'radialBar',
                height: 300
            },
            series: [78],
            labels: ['System Health'],
            colors: ['#8b5cf6'],
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '60%'
                    },
                    track: {
                        background: '#e9ecef'
                    },
                    dataLabels: {
                        value: {
                            fontSize: '24px',
                            fontWeight: 'bold'
                        },
                        name: {
                            fontSize: '15px'
                        }
                    }
                }
            }
        }).render();

    });
</script>


{{-- sales vs expenses --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {

        var options = {
            series: [{
                    name: "Sales",
                    data: [12000, 15000, 18000, 17000, 21000, 24000, 26000, 30000, 31000, 35000, 37000,
                        40000
                    ]
                },
                {
                    name: "Expenses",
                    data: [8000, 9000, 11000, 12000, 13000, 15000, 16000, 17000, 17500, 18000, 19000,
                        20000
                    ]
                }
            ],

            chart: {
                height: 320,
                type: "area",
                toolbar: {
                    show: false
                }
            },

            colors: ["#4e73df", "#e74a3b"],

            dataLabels: {
                enabled: false
            },

            stroke: {
                curve: "smooth",
                width: 3
            },

            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },

            xaxis: {
                categories: [
                    "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                ],
                labels: {
                    style: {
                        fontSize: "13px"
                    }
                }
            },

            yaxis: {
                labels: {
                    style: {
                        fontSize: "13px"
                    }
                }
            },

            tooltip: {
                theme: "light"
            },

            legend: {
                position: "top",
                horizontalAlign: "right"
            }
        };

        var chart = new ApexCharts(
            document.querySelector("#salesExpensesChart"),
            options
        );

        chart.render();
    });
</script>
