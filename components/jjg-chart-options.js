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
            }
        })
    } else {
        chart.updateOptions({
            yaxis: {
                logarithmic: false, forceNiceScale: true, labels: {
                    formatter: function (val, index) {
                        return val.toLocaleString("en-US", { style: "currency", currency: "USD" });
                    },
                }
            }
        });
    }
}

function chartPeriod(period) {
    chart.updateSeries([{
        name: 'BTC Price',
        data: prices.slice(period),
        type: "area",
    }, {
        name: '200-Week MA',
        data: sma200.slice(period),
        type: "line"
    }])
}
let chartButtons = document.querySelectorAll(".pointer");
function selectButton(event) {
    for (let button of chartButtons) {
        button.classList.remove("link-secondary","border-bottom","border-3");
    }
    // Adiciona a classe selected ao objeto clicado
    event.target.classList.add("link-secondary","border-bottom","border-3");
  }
  
  // Adiciona um evento de click a cada objeto
  for (let button of chartButtons) {
    button.addEventListener("click", selectButton);
  }