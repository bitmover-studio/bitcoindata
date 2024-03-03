"use strict";
// withdrawal chart

function isEighthOrTwentySecond(date) {
    const day = new Date(date).getDate();
    return day === 8 || day === 22;
}

function simulateStrategy(date) {
    // get Stash size and Withdrawal Rate
    const stash = parseFloat(document.getElementById("stash").value)
    let currentStash = parseFloat(document.getElementById("stash").value);
    let annualWithdrawalRate = (document.getElementById("wrate").value) / 100;
    let totalWithdrawnUSD = 0;

    let slicedPrices = sliceChart(prices,date)

    stashEvolutionChart=[];
    slicedPrices.forEach((price, index) => {
        const timestamp = price[0];
        const percentAboveMA = (price[1] - sma200[index][1]) / sma200[index][1]

        const monthlyWithdrawalLimit =
            percentAboveMA >= 0.25
                ? currentStash * annualWithdrawalRate / 12
                : percentAboveMA >= 0.1
                    ? currentStash * annualWithdrawalRate / 12 * 0.9
                    : percentAboveMA >= 0
                        ? currentStash * annualWithdrawalRate / 12 * 0.85
                        : percentAboveMA >= -0.2
                            ? currentStash * annualWithdrawalRate / 12 * 0.7
                            : percentAboveMA >= -0.3
                                ? currentStash * annualWithdrawalRate / 12 * 0.5
                                : percentAboveMA >= -0.35
                                    ? currentStash * annualWithdrawalRate / 12 * 0.4
                                    : 0;

        // Withdrawal from stash if 8 or 22 day of month
        if (isEighthOrTwentySecond(timestamp)) {
            currentStash -= monthlyWithdrawalLimit / 2;
            totalWithdrawnUSD += monthlyWithdrawalLimit / 2 * price[1]
        }

        // Amount Withdrawn so far
        let amountWithdrawn = stash - currentStash;
        stashEvolutionChart.push([timestamp, currentStash, totalWithdrawnUSD, amountWithdrawn]);
    });

    // Load data into Chart
    stashChart.updateSeries([{
        name: 'Stash Evolution',
        data: stashEvolutionChart,
        type: "line",
    }],true);

    document.getElementById('currentStash').value = (stashEvolutionChart[stashEvolutionChart.length - 1][1]).toFixed(8) + " BTC";
    document.getElementById('totalWithdrawnUSD').value = (stashEvolutionChart[stashEvolutionChart.length - 1][2]).toLocaleString("en-US", { style: "currency", currency: "USD" });
    document.getElementById('amountWithdrawn').value = (stashEvolutionChart[stashEvolutionChart.length - 1][3]).toFixed(8) + " BTC";
   
    const finalStashPercent = (stashEvolutionChart[stashEvolutionChart.length - 1][1] * 100) / stashEvolutionChart[0][1];
    radialBarChart.updateSeries([Math.round(finalStashPercent * 100) / 100]);
}

// Simulation Date
const simulationDateInput = document.getElementById('simulationDate');
let FiveYearsAgo =  new Date().setFullYear(new Date().getFullYear() - 5);
simulationDateInput.value = new Date(FiveYearsAgo).toISOString().substring(0, 10)

function sliceChart(chart,date){
    const simulationStartedAt = findClosestIndex(chart, new Date(date).getTime())
    const stashChartLen = (prices.length -1)
    return chart.slice(simulationStartedAt - stashChartLen);
}

let stashOptions = {
    chart: {
        height: 250,
        id: 'stash',
    },
    stroke: {
        width: 2,
    },
    grid: {
        yaxis: {
            lines: {
                show: false
            }
        },
    },
    series: [],
    noData: {
        text: 'Loading...'
    },
    yaxis: {
        show: true,
        labels: {
            formatter: function (val, index) {
                return val.toLocaleString("en-US", { style: "currency", currency: "BTC" });
            },
        },
    },
};

const stashChart = new ApexCharts(document.querySelector("#stashChart"), stashOptions);
stashChart.render();

let radialBarOptions = {
    chart: {
        height: 250,
        type: "radialBar",
        id: 'radialStash',
    },
    legend: {
        show: false
    },
    series: [100],
    plotOptions: {
        radialBar: {
            hollow: {
                margin: 15,
                size: "70%"
            },
            dataLabels: {
                showOn: "always",
                name: {
                    offsetY: -10,
                    show: true,
                    color: "#888",
                    fontSize: "13px"
                },
                value: {
                    fontSize: "30px",
                    show: true
                }
            }
        }
    },

    stroke: {
        lineCap: "round",
    },
    labels: ["Remaining Stash"]
};

const radialBarChart = new ApexCharts(document.querySelector("#radialBar"), radialBarOptions);
radialBarChart.render();
