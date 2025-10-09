"use strict";
window.Apex = {
    chart: {
        background: 'transparent',
        zoom: {
            autoScaleYaxis: true,
        },
        animations: {
            enabled: false
        },
        toolbar: {
            autoSelected: "pan",
            show: true,
            tools: {
                download: true,
                zoom: false,
                zoomin: false,
                zoomout: false,
                pan: false,
                reset: false,
            },
            export: {
                csv: {
                    columnDelimiter: ';',
                    headerCategory: 'Date',
                    headerValue: 'Price',
                    categoryFormatter(x) {
                        return new Date(x).toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                        });
                    }
                },
            },
        },
    },
    legend: {
        show: true,
        horizontalAlign: 'left',
        position: 'top',
    },
    theme: {
        mode: localStorage.getItem('theme'),
    },
    dataLabels: {
        enabled: false
    },
    tooltip: {
        theme: 'dark',
        shared: true,
        x: {
            show: true,
            format: 'yyyy/MM/dd',
        },
    },
    grid: {
        show: true,
        borderColor: "#535A6C33",
        xaxis: {
            lines: {
                show: true
            }
        },
        yaxis: {
            lines: {
                show: false
            }
        },
    },
    xaxis: {
        type: 'datetime',
    },
    noData: {
        text: 'Loading...'
    },
    markers: {
        size: 0
    }
}

// Main Chart
let options = {
    chart: {
        height: 280,
        id: 'main',
    },
    stroke: {
        width: [2, 3],
        curve: 'smooth',
    },
    yaxis: {
        show: false,
        forceNiceScale: true,
        labels: {
            formatter: function (val, index) {
                return val.toLocaleString("en-US", { style: "currency", currency: "USD" });
            },
        },
        logarithmic: true,
    },
    series: [],
    fill: {
        opacity: [0.45, 1],
    },
    tooltip: {
        y: [{
            formatter: function (value, { series, seriesIndex, dataPointIndex, w }) {
                let priceAboveMA = (series[0][dataPointIndex] - series[1][dataPointIndex]) / series[1][dataPointIndex]
                return value.toLocaleString("en-US", { style: "currency", currency: "USD" }) + '<div class="small m-2 position-absolute top-0 end-0 text-center">Above MA: ' + ((priceAboveMA > 0) ? '<span class="text-success-emphasis">' : '<span class="text-danger">') + priceAboveMA.toLocaleString("en-US", { style: "percent", minimumFractionDigits: 2, maximumFractionDigits: 2 })
                    + "</span></div>"
            }
        }]
    },
};
const chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();

var brushChartOptions = {
    series: [],
    chart: {
        height: 130,
        type: 'area',
        id: 'brushChart',
        brush: {
            target: 'main',
            enabled: true
        },
        selection: {
            enabled: true,
            xaxis: {
                min: new Date('20 Jul 2010').getTime(),
                max: new Date().getTime()
            },
            fill: {
                color: '#535A6C',
                opacity: 0.3
            }
        },
        toolbar: {
            autoSelected: 'selection'
        },
        events: {
            // Corrected event listener
            selection: async function (chartContext, { xaxis, yaxis }) {
                // 1. Restore the full series and wait for it to finish
                await chart.updateSeries([{
                    name: 'BTC Price',
                    data: prices
                }, {
                    name: '200-Week MA',
                    data: sma200
                }]);

                // 2. Then, manually apply the zoom from the brush selection
                chart.zoomX(xaxis.min, xaxis.max);
            }
        }
    },
    yaxis: {
        show: false,
        logarithmic: true,
        forceNiceScale: true,
    }
};

const brushChart = new ApexCharts(document.querySelector("#brushChart"), brushChartOptions);
brushChart.render();

// Date and Annotations
let dateInput = document.getElementById('date');
dateInput.max = new Date().toISOString().split("T")[0];
dateInput.min = '2010-07-22';
dateInput.value = new Date().toISOString().substring(0, 10);

function drawAnnotation(date) {
    let index = findClosestIndex(prices, new Date(dateInput.value).getTime())
    chart.clearAnnotations();
    chart.addXaxisAnnotation({
        x: new Date(date).getTime(),
        borderColor: '#0d6efd',
        label: {
            borderColor: '#0d6efd',
            style: {
                color: '#fff',
                background: "#0d6efdcc"
            },
            text: 'BTC spot Price - ' + prices[index][1].toLocaleString("en-US", { style: "currency", currency: "USD" })
        }
    }, true
    )
    checkDate()
}

// Checkbox
function checkDate() {
    if (document.getElementById("useDate").checked === true) {
        let index = findClosestIndex(prices, new Date(dateInput.value).getTime());
        btcSpotPrice = prices[index][1];
        movingAverage = sma200[index][1];
        percentAboveMovingAverage = (btcSpotPrice - movingAverage) / movingAverage;
        calculateWithdrawalLimit();
        const dateParts = dateInput.value.split('-');
        const outputDate = `${dateParts[1]}/${dateParts[2]}/${dateParts[0]}`;
        document.getElementById("currentDate").innerText = outputDate;
        //toast
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(document.getElementById('checkToast'))
        toastBootstrap.show()
    } else {
        btcSpotPrice = defaultSpotPrice;
        movingAverage = sma200[sma200.length - 1][1];
        percentAboveMovingAverage = (btcSpotPrice - movingAverage) / movingAverage;
        calculateWithdrawalLimit();
        document.getElementById("currentDate").innerText = new Date().toLocaleDateString();
    }
}

// find date in data series
function findClosestIndex(data, target) {
    var closest = Math.abs(data[0][0] - target);
    var index = 0;
    for (var i = 1; i < data.length; i++) {
        var diff = Math.abs(data[i][0] - target);
        if (diff < closest) {
            closest = diff;
            index = i;
        }
    }
    return index;
}


// chart buttons area
function linearLogarithimic() {
    if (document.getElementById("linLog").checked === true) {
        chart.updateOptions({
            yaxis: {
                logarithmic: true, forceNiceScale: true, show: false, labels: {
                    formatter: function (val, index) {
                        return val.toLocaleString("en-US", { style: "currency", currency: "USD" });
                    },
                }
            },
            grid: {
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
        })
    } else {
        chart.updateOptions({
            yaxis: {
                show: false,
                logarithmic: false, forceNiceScale: true, labels: {
                    formatter: function (val, index) {
                        return val.toLocaleString("en-US", { style: "currency", currency: "USD" });
                    },
                }
            },
            grid: {
                yaxis: {
                    lines: {
                        show: true
                    }
                },
            },
        });
    }
}

function chartPeriod(period) {
    // This part updates the main chart's visible data
    chart.updateSeries([{
        name: 'BTC Price',
        data: prices.slice(period),
        type: "area",
    }, {
        name: '200-Week MA',
        data: sma200.slice(period),
        type: "line"
    }]);

    // Logic to sync the brush chart selection ---
    const maxDate = prices[prices.length - 1][0];
    let minDate;

    if (period !== undefined) {
        //  handles the 1M, 6M, 1Y, 5Y, 10Y buttons
        const slicedPrices = prices.slice(period);
        minDate = slicedPrices.length > 0 ? slicedPrices[0][0] : maxDate;
    } else {
        //  handles the "ALL" button
        minDate = prices[0][0];
    }

    //  updates the brush chart's highlighted selection area
    brushChart.updateOptions({
        chart: {
            selection: {
                xaxis: {
                    min: minDate,
                    max: maxDate
                }
            }
        }
    });
}

let chartButtons = document.querySelectorAll(".pointer");
function selectButton(event) {
    for (let button of chartButtons) {
        button.classList.remove("link-secondary", "border-bottom", "border-3");
    }
    event.target.classList.add("link-secondary", "border-bottom", "border-3");
}
for (let button of chartButtons) {
    button.addEventListener("click", selectButton);
}
