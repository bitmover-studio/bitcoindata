"use strict";
// global variables
let percentAboveMovingAverage;
let btcSpotPrice;
let sma200;

// Calculate SMA
function calculateSMA(data, period) {
    let sma = [];
    let sumRunAvg = 0;
    for (let i = 0; i < data.length; i++) {
        if (i >= period) {
            let sum = 0;
            for (let j = i; j > i - period; j--) {
                sum += data[j][1];
            }
            sma.push([data[i][0], sum / period]);
        } else {
            sumRunAvg += data[i][1];
            sma.push([data[i][0], sumRunAvg / (i + 1)]);
        }
    }
    return sma;
}

// Fetch All Data
const urls = [
    'https://bitcoindata.science/api/priceusd.json',
    'https://bitcoindata.science/components/historical201013.json',
    "https://api.coingecko.com/api/v3/coins/bitcoin/market_chart?vs_currency=usd&days=max&interval=daily&precision=2"
];

async function fetchUrls(urls) {
    try {
        let responses = await Promise.all(urls.map(url => fetch(url)));
        let data = await Promise.all(responses.map(response => response.json()));
        return data;
    } catch (error) {
        console.error(error);
    }
}


// Withdrawal Calculations
function calculateWithdrawalLimit() {
    let annualWithdrawalRate = (document.getElementById("wrate").value) / 100;
    let btcStashSize = document.getElementById("stash").value;
    let wRateRange = document.getElementById('wRateRange');
    let withdrawalDescription = document.getElementById('withdrawalDescription');
    let wrate = document.getElementById("wrate");

    if (wrate.value > 17) {
        wRateRange.classList.remove("text-warning");
        wRateRange.classList.add("text-danger");
        withdrawalDescription.classList.add("text-danger");
        withdrawalDescription.classList.remove("text-warning");
        withdrawalDescription.innerText = 'Extremely Agressive';
    } else if (wrate.value > 10) {
        wRateRange.classList.remove("text-warning");
        wRateRange.classList.add("text-danger");
        withdrawalDescription.classList.add("text-danger");
        withdrawalDescription.classList.remove("text-warning");
        withdrawalDescription.innerText = 'Aggressive';
    } else if (wrate.value > 6) {
        wRateRange.classList.remove("text-danger");
        wRateRange.classList.add("text-warning");
        withdrawalDescription.classList.remove("text-danger");
        withdrawalDescription.classList.add("text-warning");
        withdrawalDescription.innerText = 'Moderate';
    } else {
        wRateRange.classList.remove("text-danger");
        wRateRange.classList.remove("text-warning");
        withdrawalDescription.classList.remove("text-danger");
        withdrawalDescription.classList.remove("text-warning");
        withdrawalDescription.innerText = 'Conservative';

    }

    let withdrawalLimit;

    if (percentAboveMovingAverage >= 0.25) {
        withdrawalLimit = btcStashSize * annualWithdrawalRate / 12;
    } else if (percentAboveMovingAverage >= 10) {
        withdrawalLimit = btcStashSize * annualWithdrawalRate / 12 * 0.9;
    } else if (percentAboveMovingAverage >= 0) {
        withdrawalLimit = btcStashSize * annualWithdrawalRate / 12 * 0.85;
    } else if (percentAboveMovingAverage >= -10) {
        withdrawalLimit = btcStashSize * annualWithdrawalRate / 12 * 0.7;
    } else if (percentAboveMovingAverage >= -20) {
        withdrawalLimit = btcStashSize * annualWithdrawalRate / 12 * 0.5;
    } else if (percentAboveMovingAverage >= -35) {
        withdrawalLimit = btcStashSize * annualWithdrawalRate / 12 * 0.4;
    }

    wRateRange.innerHTML = wrate.value + '%';
    document.getElementById("allowed").value = withdrawalLimit.toFixed(8);
    document.getElementById("allowedvalue").value = (withdrawalLimit * btcSpotPrice).toFixed(2);
    document.getElementById("monthAdvance").value = calculateAdvancedWithdraw();
    document.getElementById("allowedAdv").value = (calculateAdvancedWithdraw() *  withdrawalLimit).toFixed(8);
    document.getElementById("allowedAdvVal").value = (calculateAdvancedWithdraw() *  withdrawalLimit * btcSpotPrice).toFixed(8);

}

// Advanced Withdrawal
function calculateAdvancedWithdraw() {
    if (percentAboveMovingAverage >= 0.33 && percentAboveMovingAverage < 0.66) {
        return 1;
    } else if (percentAboveMovingAverage >= 0.66 && percentAboveMovingAverage < 1) {
        return 3;
    } else if (percentAboveMovingAverage >= 1 && percentAboveMovingAverage < 2) {
        return 5;
    } else if (percentAboveMovingAverage >= 2 && percentAboveMovingAverage < 4) {
        return 11;
    } else if (percentAboveMovingAverage >= 4 && percentAboveMovingAverage < 6.5) {
        return 23;
    } else if (percentAboveMovingAverage >= 6.5 && percentAboveMovingAverage < 9) {
        return 35;
    } else if (percentAboveMovingAverage >= 9 && percentAboveMovingAverage < 14) {
        return 47;
    } else if (percentAboveMovingAverage >= 14) {
        return 59;
    } else {
        return 0;
    }
}


// Work on data
fetchUrls(urls).then(([res1, res2, res3]) => {
    btcSpotPrice = res1.price;
    let oldprice = res2;
    let newprices = res3.prices;
    let prices = oldprice.concat(newprices);
    let yesterdayPrice = prices[prices.length - 1][1];
    let priceVar = ((btcSpotPrice - yesterdayPrice) / yesterdayPrice);
    sma200 = calculateSMA(prices, 1400);
    let movingAverage = sma200[sma200.length - 1][1];

    // Load data into Chart
    chart.updateSeries([{
        name: 'BTC Price',
        data: prices,
        type: "area",
    }, {
        name: '200-Week SMA',
        data: sma200,
        type: "line"
    }]);
    chartLine.updateSeries([{
        name: 'BTC Spot Price',
        data: prices,
        type: "area"
    }]);

    // Load Fixed Data
    percentAboveMovingAverage = (btcSpotPrice - movingAverage) / movingAverage;

    document.getElementById("pricesma").innerText = percentAboveMovingAverage.toLocaleString("en-US", { style: "percent", minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById("sma").innerText = movingAverage.toLocaleString("en-US", { style: "currency", currency: "USD" });
    document.getElementById("BTCPrice").innerText = btcSpotPrice.toLocaleString("en-US", { style: "currency", currency: "USD" });
    document.getElementById("priceVar").innerText = (((priceVar > 0) ? '+' : '') + priceVar.toLocaleString("en-US", { style: "percent", minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    (priceVar > 0) ? document.getElementById("priceVar").classList.add('text-success-emphasis') : document.getElementById("priceVar").classList.add('text-danger');

    // Load Dynamic Data
    calculateWithdrawalLimit();
});

let options = {
    chart: {
        background: 'transparent',
        zoom: {
            autoScaleYaxis: true,
        },
        height: 380,
        id: 'main',
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
        width: 2,
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
        borderColor: "#535A6C33",
        xaxis: {
            lines: {
                show: true
            }
        }
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
};
const chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();

let optionsLine = {
    series: [],
    chart: {
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
                min: new Date('19 Jun 2019').getTime(),
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
        tickAmount: 2,
        labels: {
            formatter: function (val, index) {
                return val.toLocaleString("en-US", { style: "currency", currency: "USD" });
            }
        },
    }
};

const chartLine = new ApexCharts(document.querySelector("#chart-line"), optionsLine);
chartLine.render();