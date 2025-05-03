document.addEventListener("DOMContentLoaded", function () {
    // Diet Program Distribution Pie Chart
    if (document.getElementById("diet-program-chart")) {
        const weightGainCount = parseInt(document.getElementById("diet-program-chart").getAttribute("data-weight-gain")) || 0;
        const weightLossCount = parseInt(document.getElementById("diet-program-chart").getAttribute("data-weight-loss")) || 0;
        const fatLossCount = parseInt(document.getElementById("diet-program-chart").getAttribute("data-fat-loss")) || 0;
        const totalEnrollments = weightGainCount + weightLossCount + fatLossCount;
        
        const dietProgramOptions = {
            series: [weightGainCount, weightLossCount, fatLossCount],
            chart: {
                type: "donut",
                fontFamily: "inherit",
                foreColor: "#adb0bb",
                height: 350, 
            },
            colors: ["var(--color-info)", "var(--color-success)", "var(--color-warning)"],
            labels: [
                "Program Naik BB",
                "Program Turun BB",
                "Program Turun Lemak"
            ],
            plotOptions: {
                pie: {
                    donut: {
                        size: "65%", 
                        background: "transparent",
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: "16px", 
                                color: undefined,
                                offsetY: -10,
                            },
                            value: {
                                show: true,
                                fontSize: "20px", 
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
                                fontSize: "16px", 
                                fontWeight: 600,
                                color: "#7C8FAC", 
                                formatter: function (w) {
                                    return totalEnrollments;
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
                show: false,
            },
            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };

        const dietProgramChart = new ApexCharts(document.querySelector("#diet-program-chart"), dietProgramOptions);
        dietProgramChart.render();
    }

    // Weight Trend Chart
    if (document.getElementById("weight-trend-chart")) {

        const weightTrendDates = JSON.parse(document.getElementById("weight-trend-chart").getAttribute("data-dates") || '[]');
        const weightGainData = JSON.parse(document.getElementById("weight-trend-chart").getAttribute("data-weight-gain") || '[]');
        const weightLossData = JSON.parse(document.getElementById("weight-trend-chart").getAttribute("data-weight-loss") || '[]');
        const fatLossData = JSON.parse(document.getElementById("weight-trend-chart").getAttribute("data-fat-loss") || '[]');
        
        const series = [
            {
                name: 'Program Naik BB',
                data: weightGainData,
                color: "var(--color-info)",
            },
            {
                name: 'Program Turun BB',
                data: weightLossData,
                color: "var(--color-success)",
            },
            {
                name: 'Program Turun Lemak',
                data: fatLossData,
                color: "var(--color-warning)",
            }
        ];
        
        const weightTrendOptions = {
            series: series,
            chart: {
                height: 350,
                type: "line",
                fontFamily: "inherit",
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val.toFixed(1) + " kg";
                },
                textAnchor: 'middle',
                style: {
                    fontSize: '12px',
                    fontWeight: 600,
                    colors: ['#333']
                },
                background: {
                    enabled: true,
                    foreColor: '#fff',
                    padding: 4,
                    borderRadius: 2,
                    borderWidth: 1,
                    borderColor: '#fff',
                    opacity: 0.7
                },
                offsetY: -10
            },
            stroke: {
                width: 4,
                curve: "smooth",
                colors: ['transparent']
            },
            xaxis: {
                categories: weightTrendDates,
                labels: {
                    style: {
                        colors: Array(weightTrendDates.length).fill('var(--color-bodytext)'),
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                title: {
                    text: 'Berat (kg)',
                    style: {
                        fontWeight: 500
                    }
                },
                min: function(min) {
                    return min - 10 > 0 ? min - 10 : 0;
                }
            },
            fill: {
                opacity: 0.8
            },
            markers: {
                size: 6,
                hover: {
                    size: 8
                }
            },
            grid: {
                borderColor: "rgba(0,0,0,0.1)",
                strokeDashArray: 3,
                row: {
                    colors: ["transparent", "transparent"],
                    opacity: 0.5
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                floating: false,
                offsetY: -5,
                offsetX: -5
            },
            tooltip: {
                theme: "dark",
                y: {
                    formatter: function (val) {
                        return val + " kg";
                    }
                }
            }
        };

        const weightTrendChart = new ApexCharts(document.querySelector("#weight-trend-chart"), weightTrendOptions);
        weightTrendChart.render();
        
        document.getElementById('weightTrendFilter').addEventListener('change', function() {
            const filter = this.value;
            
            if (filter === 'all') {
                weightTrendChart.updateOptions({
                    series: series
                });
            } else {
                const programIndex = filter === 'weightGain' ? 0 : (filter === 'weightLoss' ? 1 : 2);
                weightTrendChart.updateOptions({
                    series: [series[programIndex]]
                });
            }
        });
    }
});