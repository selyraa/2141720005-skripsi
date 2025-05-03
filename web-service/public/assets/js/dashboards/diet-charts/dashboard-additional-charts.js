document.addEventListener("DOMContentLoaded", function () {
    // Initialize all new visualization charts
    initBMIDistributionChart();
    initProgramStatusChart();
    initBodyCompositionChart();
});

// BMI Distribution Chart
function initBMIDistributionChart() {
    const chartElement = document.getElementById('bmi-distribution-chart');
    if (!chartElement) return;
    
    const underweight = parseInt(chartElement.getAttribute('data-underweight')) || 0;
    const normal = parseInt(chartElement.getAttribute('data-normal')) || 0;
    const overweight = parseInt(chartElement.getAttribute('data-overweight')) || 0;
    const obese = parseInt(chartElement.getAttribute('data-obese')) || 0;
    
    const options = {
        series: [underweight, normal, overweight, obese],
        chart: {
            type: 'donut',
            height: 350,
            fontFamily: "inherit",
        },
        labels: ['Kekurangan Berat Badan', 'Normal', 'Kelebihan Berat Badan', 'Obesitas'],
        colors: ['var(--color-info)', 'var(--color-success)', 'var(--color-warning)', 'var(--color-error)'],
        plotOptions: {
            pie: {
                donut: {
                    size: '65%',
                    background: 'transparent',
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontSize: '16px',
                            offsetY: -10,
                        },
                        value: {
                            show: true,
                            fontSize: '20px',
                            color: undefined,
                            offsetY: 16,
                            formatter: function (val) {
                                return val;
                            }
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            color: '#7C8FAC',
                            fontSize: '16px',
                            formatter: function (w) {
                                return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                            }
                        }
                    }
                }
            }
        },
        legend: {
            show: false
        },
        tooltip: {
            theme: "dark",
            fillSeriesColor: false,
            y: {
                formatter: function(value) {
                    return value;
                }
            }
        }
    };
    
    new ApexCharts(chartElement, options).render();
}

// Program Status Distribution Chart
function initProgramStatusChart() {
    const chartElement = document.getElementById('program-status-chart');
    if (!chartElement) return;
    
    const statusLabels = JSON.parse(chartElement.getAttribute('data-labels') || '[]');
    const statusValues = JSON.parse(chartElement.getAttribute('data-values') || '[]');
    
    const options = {
        series: statusValues,
        chart: {
            type: 'pie',
            height: 350,
            fontFamily: "inherit",
        },
        labels: statusLabels,
        colors: ['var(--color-info)', 'var(--color-success)', 'var(--color-error)', 'var(--color-warning)'],
        legend: {
            position: 'bottom'
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 300
                },
                legend: {
                    position: 'bottom'
                }
            }
        }],
        tooltip: {
            theme: "dark",
            y: {
                formatter: function(value) {
                    return value;
                }
            }
        }
    };
    
    new ApexCharts(chartElement, options).render();
}

// Body Composition Changes Chart
function initBodyCompositionChart() {
    const chartElement = document.getElementById('body-composition-chart');
    if (!chartElement) return;
    
    // Sample data for demonstration - in a real app, this would come from your backend
    const options = {
        series: [{
            name: 'Before Program',
            data: [30, 40, 45, 50, 49],
            color: "var(--color-secondary)",
        }, {
            name: 'After Program',
            data: [25, 45, 50, 60, 55],
            color: "var(--color-primary)",
        }],
        chart: {
            type: 'bar',
            height: 350,
            fontFamily: "inherit",
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                borderRadius: 4,
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Body Fat (%)', 'Muscle Mass (%)', 'Water Content (%)', 'Bone Density', 'Cell Age'],
            labels: {
                style: {
                    colors: Array(5).fill('var(--color-bodytext)'),
                    fontSize: '12px'
                }
            }
        },
        yaxis: {
            title: {
                text: 'Value',
                style: {
                    fontWeight: 500
                }
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            theme: "dark",
            y: {
                formatter: function (val) {
                    return val;
                }
            }
        }
    };
    
    new ApexCharts(chartElement, options).render();
}