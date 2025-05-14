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
    
    const totalBMIs = underweight + normal + overweight + obese;
    
    const options = {
        series: [underweight, normal, overweight, obese],
        chart: {
            type: 'donut',
            height: 350,
            fontFamily: "inherit",
            foreColor: "#adb0bb",
        },
        labels: ['Kekurangan BB', 'Normal', 'Kelebihan BB', 'Obesitas'],
        colors: ["#4F46E5", "#10B981", "#F59E0B", "#EF4444"],
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
                            color: undefined,
                            offsetY: -10,
                        },
                        value: {
                            show: true,
                            fontSize: '20px',
                            fontWeight: 600,
                            color: undefined,
                            offsetY: 16,
                            formatter: function (val) {
                                return val;
                            }
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            fontSize: '16px',
                            fontWeight: 600,
                            color: "#7C8FAC",
                            formatter: function (w) {
                                return totalBMIs;
                            }
                        }
                    }
                }
            }
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: false,
        },
        legend: {
            show: true,
            position: 'bottom',
            horizontalAlign: 'center',
            fontSize: '14px',
            markers: {
                width: 12,
                height: 12,
                radius: 6,
            },
            itemMargin: {
                horizontal: 8,
                vertical: 8
            },
        },
        tooltip: {
            theme: "dark",
            fillSeriesColor: false,
            y: {
                formatter: function(value, { seriesIndex, dataPointIndex, w }) {
                    const percent = Math.round((value / totalBMIs) * 100);
                    return `${value} (${percent}%)`;
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