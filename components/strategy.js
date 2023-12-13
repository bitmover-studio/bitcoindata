"use strict";

// Calculate SMA
function calculateSMA(data, period) {
    let sma = [];
    for (let i = 0; i < data.length; i++) {
        if (i >= period) {
            let sum = 0;
            for (let j = i; j > i - period; j--) {
                sum += data[j][1];
            }
            sma.push([data[i][0], sum / period]);
        } else {
            sma.push([data[i][0], null]);
        }
    }
    return sma;
}

// Get Bitcoin Chart Price
const url = "https://api.coingecko.com/api/v3/coins/bitcoin/market_chart?vs_currency=usd&days=max&interval=daily&precision=2"
let price;
let sma;
const btcChart = async () => {
    try {
        const response = await fetch(url)
        const data = await response.json()
        let prices = data.prices;
        price = prices[prices.length - 1][1];
        let yesterdayPrice = prices[prices.length - 2][1];
        let priceVar = ((price - yesterdayPrice) / yesterdayPrice);
        let sma200 = calculateSMA(prices, 1400);
        sma = sma200[sma200.length - 1][1];

        // equalize both array lengths
        prices = prices.slice(1400, -1);
        sma200 = sma200.slice(1400, -1);

        // Load data into Chart
        chart.updateSeries([{
            name: 'BTC Price',
            data: prices,
            type: "area"
        }, {
            name: '200-Week SMA',
            data: sma200,
            type: "line"
        }]);
        // Load Fixed Data
        let priceAboveSma = (((price - sma) / sma));
        document.getElementById("pricesma").innerText = priceAboveSma.toLocaleString("en-US", { style: "percent", minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById("sma").innerText = sma.toLocaleString("en-US", { style: "currency", currency: "USD" });
        document.getElementById("BTCPrice").innerText = price.toLocaleString("en-US", { style: "currency", currency: "USD" });
        document.getElementById("priceVar").innerText = ( ((priceVar >0) ?'+':'') + priceVar.toLocaleString("en-US", { style: "percent", minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        (priceVar > 0) ? document.getElementById("priceVar").classList.add('text-success-emphasis') : document.getElementById("priceVar").classList.add('text-danger-emphasis');

        loadData(priceAboveSma);
    }
    catch (error) {
        console.warn(error)
    }
}

function loadData(priceAboveSma) {
    // load data into text-areas
    let allowedWithdrawal;
    let wrate = document.getElementById("wrate").value;
    let stash = document.getElementById("stash").value;

    (priceAboveSma > 0.25) ? allowedWithdrawal = (wrate / 100 / 12 * stash) : allowedWithdrawal = (wrate / 100 / 12 * stash) * 0.4;
    document.getElementById("wRateRange").innerHTML = wrate;
    document.getElementById("allowed").value = (allowedWithdrawal).toFixed(8);
    document.getElementById("allowedvalue").value = (allowedWithdrawal * price).toFixed(2);
}

let options = {
    chart: {
        background: 'transparent',
        height: 380,
        toolbar: {
            show: true
        },
    },
    theme: {
        mode: localStorage.getItem('theme'),
    },
    stroke: {
        width: 2
    },
    dataLabels: {
        enabled: false
    },
    tooltip: {
        theme: 'dark',
        shared: true,
        intersect: false,
        x: {
            show: true,
            format: 'yyyy/MM/dd',
        },
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
        labels: {
            formatter: function (val, index) {
                return val.toLocaleString("en-US", { style: "currency", currency: "USD" });
            }
        }
    }
};

const chart = new ApexCharts(
    document.querySelector("#chart"),
    options
);

chart.render();
btcChart();