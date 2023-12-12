"use strict";
// timestamp to human readable date
function timestampToDate(timestamp) {
    let date = new Date(timestamp)
    let year = date.getFullYear();
    let month = String(date.getMonth() + 1).padStart(2, '0');
    let day = String(date.getDate()).padStart(2, '0');
    let dateString = year + "-" + month + "-" + day;
    return dateString
}

// Calculate SMA
function calculateSMA(data, period) {
    let sma = [];
    for(let i = 0; i < data.length; i++) {
        if(i >= period) {
            let sum = 0;
            for(let j = i; j > i - period; j--) {
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
        let sma200 = calculateSMA(prices, 1400);
        sma = sma200[sma200.length - 1][1];

        // equalize both array lengths
        sma200 = sma200.slice(-3000, -1);
        prices = prices.slice(-3000, -1);

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
        loadData()
    }
    catch (error) {
        console.warn(error)
    }
}

function loadData(){
    // load data into text-areas
    document.getElementById("sma").value = sma.toFixed(2);
    document.getElementById("BTCPrice").value = price.toFixed(2);

    let priceAboveSma = (((price - sma) / sma) * 100).toFixed(2)
    document.getElementById("pricesma").value = priceAboveSma;

    let allowedWithdrawal;
    let wrate = document.getElementById("wrate").value;
    let stash = document.getElementById("stash").value;

    (priceAboveSma > 0.25) ? allowedWithdrawal = (wrate/100/12*stash) : allowedWithdrawal = (wrate/100/12*stash)*0.4;

    document.getElementById("allowed").value = (allowedWithdrawal).toFixed(8);
    document.getElementById("allowedvalue").value = (allowedWithdrawal*price).toFixed(2);
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
    },
    grid: {
        borderColor: "#535A6C",
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
            /**
            * Allows users to apply a custom formatter function to yaxis labels.
            *
            * @param { String } value - The generated value of the y-axis tick
            * @param { index } index of the tick / currently executing iteration in yaxis labels array
            */
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