"use strict";
// withdrawal chart

function isEighthOrTwentySecond(date) {
    const day = new Date(date).getDate();
    return day === 8 || day === 22;
}

function simulateStrategy(date) {
    // Get initial values
    const stash = parseFloat(document.getElementById("stash").value);
    let currentStash = stash;
    const annualWithdrawalRate = parseFloat(document.getElementById("wrate").value) / 100;
    let totalWithdrawnUSD = 0;

    // Find the correct starting index in the FULL arrays
    const simulationStartIndex = findClosestIndex(prices, new Date(date).getTime());

    const is200WMAPriceChecked = document.getElementById("togglePrice").checked;
    stashEvolutionChart = [];

    // Loop from the simulation start date to the end of the data
    for (let i = simulationStartIndex; i < prices.length; i++) {
        const timestamp = prices[i][0];
        const currentSpotPrice = prices[i][1];
        const currentSmaPrice = sma200[i][1]; // Use the same index 'i'

        // This comparison is now correct because the data is synced
        const percentAboveMA = (currentSpotPrice - currentSmaPrice) / currentSmaPrice;

        const monthlyWithdrawalLimit =
            percentAboveMA >= 0.25 ? annualWithdrawalRate / 12 :
            percentAboveMA >= 0.1  ? annualWithdrawalRate / 12 * 0.9 :
            percentAboveMA >= 0    ? annualWithdrawalRate / 12 * 0.85 :
            percentAboveMA >= -0.2 ? annualWithdrawalRate / 12 * 0.7 :
            percentAboveMA >= -0.3 ? annualWithdrawalRate / 12 * 0.5 :
            percentAboveMA >= -0.35? annualWithdrawalRate / 12 * 0.4 :
            0;

        // Withdrawal from stash if 8th or 22nd day of month
        if (isEighthOrTwentySecond(timestamp)) {
            let btcToWithdraw = 0;

            if (is200WMAPriceChecked) {
                const dollarValueToWithdraw = (currentStash * currentSmaPrice) * (monthlyWithdrawalLimit / 2);
                btcToWithdraw = dollarValueToWithdraw / currentSpotPrice;
            } else {
                btcToWithdraw = currentStash * (monthlyWithdrawalLimit / 2);
            }

            currentStash -= btcToWithdraw;
            totalWithdrawnUSD += btcToWithdraw * currentSpotPrice;
        }

        const amountWithdrawn = stash - currentStash;
        stashEvolutionChart.push([timestamp, currentStash, totalWithdrawnUSD, amountWithdrawn]);
    }

    // Load data into Chart
    stashChart.updateSeries([{
        name: 'Stash Evolution',
        data: stashEvolutionChart,
        type: "line",
    }], true);

    document.getElementById('currentStash').value = (stashEvolutionChart[stashEvolutionChart.length - 1][1]).toFixed(8) + " BTC";
    document.getElementById('totalWithdrawnUSD').value = (stashEvolutionChart[stashEvolutionChart.length - 1][2]).toLocaleString("en-US", { style: "currency", currency: "USD" });
    document.getElementById('amountWithdrawn').value = (stashEvolutionChart[stashEvolutionChart.length - 1][3]).toFixed(8) + " BTC";

    const finalStashPercent = (stashEvolutionChart[stashEvolutionChart.length - 1][1] * 100) / stashEvolutionChart[0][1];
    radialBarChart.updateSeries([Math.round(finalStashPercent * 100) / 100]);
}

// Simulation Date
const simulationDateInput = document.getElementById('simulationDate');
let FiveYearsAgo = new Date().setFullYear(new Date().getFullYear() - 5);
simulationDateInput.value = new Date(FiveYearsAgo).toISOString().substring(0, 10)

function sliceChart(chart, date) {
    const simulationStartedAt = findClosestIndex(chart, new Date(date).getTime())
    const stashChartLen = (prices.length - 1)
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
    tooltip: {
        custom: function ({ series, seriesIndex, dataPointIndex, w }) {
            // Get the full data array for the point being hovered
            const dataPoint = w.globals.initialSeries[seriesIndex].data[dataPointIndex];

            // Extract the values from your data structure
            const timestamp = dataPoint[0];
            const stashValueBTC = dataPoint[1];
            const totalWithdrawnUSD = dataPoint[2];

            // Format the values for display
            const formattedDate = new Date(timestamp).toLocaleDateString();
            const formattedStash = stashValueBTC.toFixed(8) + " BTC";
            const formattedWithdrawal = totalWithdrawnUSD.toLocaleString("en-US", {
                style: "currency",
                currency: "USD"
            });

            // Return the complete custom HTML for the tooltip.
            // Using default ApexCharts classes makes it look consistent.
            return `
                <div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                    ${formattedDate}
                </div>
                <div class="apexcharts-tooltip-series-group apexcharts-active" style="padding: 6px; display: block;">
                    <div style="display: flex; justify-content: space-between;"><span>Current Stash:</span> <strong style="margin-left: 8px;">${formattedStash}</strong></div>
                    <div style="display: flex; justify-content: space-between;"><span>Total Withdrawal:</span> <strong style="margin-left: 8px;">${formattedWithdrawal}</strong></div>
                </div>
            `;
        },
    }
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
