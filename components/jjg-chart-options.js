"use strict";

// Main Chart
let options = {
    chart: {
        background: 'transparent',
        zoom: {
            autoScaleYaxis: true,
        },
        height: 380,
        id: 'main',
        animations: {
            enabled: false
        },
        toolbar: {
            autoSelected: "pan",
            show: false
        },
    },
    legend: {
        show: true,
        position: 'top',
    },
    theme: {
        mode: localStorage.getItem('theme'),
    },
    stroke: {
        width: 3,
        curve: 'smooth',
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
        y: [{
            formatter: function (value, { series, seriesIndex, dataPointIndex, w }) {
                let priceAboveMA = (series[0][dataPointIndex] - series[1][dataPointIndex]) / series[1][dataPointIndex]
                return value.toLocaleString("en-US", { style: "currency", currency: "USD" }) + '<div class="small m-2 position-absolute top-0 end-0 text-center">Above MA: <br/>' + ((priceAboveMA > 0) ? '<span class="text-success-emphasis">' : '<span class="text-danger">') + priceAboveMA.toLocaleString("en-US", { style: "percent", minimumFractionDigits: 2, maximumFractionDigits: 2 })
                    + "</span></div>"
            }
        }]
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
    series: [],
    xaxis: {
        type: 'datetime',
    },
    noData: {
        text: 'Loading...'
    },
    yaxis: {
        show: false,
        forceNiceScale: true,
        seriesName: 'BTC Price',
        labels: {
            formatter: function (val, index) {
                return val.toLocaleString("en-US", { style: "currency", currency: "USD" });
            },
        },
        logarithmic: true,
    },
    markers: {
        size: 0
    }
};
const chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();

// Brush Chart

let optionsLine = {
    series: [],
    chart: {
        animations: {
            enabled: false
        },
        id: 'brush',
        background: 'transparent',
        height: 130,
        brush: {
            target: 'main',
            enabled: true,
        },
        selection: {
            enabled: true,
            xaxis: {
                min: new Date('22 Jul 2010').getTime(),
                max: new Date().getTime()
            },
            fill: {
                color: '#535A6C',
                opacity: 0.3
            }
        },
    },
    theme: {
        mode: localStorage.getItem('theme'),
    },
    grid: {
        borderColor: "#535A6C33",
        xaxis: {
            lines: {
                show: true
            }
        }
    },
    xaxis: {
        type: 'datetime',
        tooltip: {
            enabled: false
        }
    },
    yaxis: {
        tickAmount: 3,
        labels: {
            formatter: function (val, index) {
                return val.toLocaleString("en-US", { style: "currency", currency: "USD" });
            }
        },
        show: false,
    },
    markers: {
        size: 0
    }
};

const chartLine = new ApexCharts(document.querySelector("#chart-line"), optionsLine);
chartLine.render();

// Date and Annotations
let dateInput = document.getElementById('date');
dateInput.max = new Date().toISOString().split("T")[0];
dateInput.min = '2010-07-22';
dateInput.value = new Date().toISOString().substring(0, 10);

function drawAnnotation(date) {
    let index=findClosestIndex(prices,  new Date(dateInput.value).getTime())
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
        let index=findClosestIndex(prices,  new Date(dateInput.value).getTime());
        btcSpotPrice = prices[index][1];
        movingAverage = sma200[index][1];
        percentAboveMovingAverage = (btcSpotPrice - movingAverage) / movingAverage;

        document.getElementById("headerDate").innerText = "As of " + (dateInput.value);
        document.getElementById("headerAboveMA").innerHTML = percentAboveMovingAverage.toLocaleString("en-US", { style: "percent", minimumFractionDigits: 2, maximumFractionDigits: 2 });
        calculateWithdrawalLimit();

        //toast
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(document.getElementById('checkToast'))
        toastBootstrap.show()
    } else {
        document.getElementById("headerDate").innerHTML = '&nbsp; ';
        document.getElementById("headerAboveMA").innerHTML = '&nbsp; ';

        btcSpotPrice = defaultSpotPrice;
        movingAverage = sma200[sma200.length - 1][1];
        percentAboveMovingAverage = (btcSpotPrice - movingAverage) / movingAverage;
        calculateWithdrawalLimit();
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