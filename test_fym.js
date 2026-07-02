const fs = require('fs');
let code = fs.readFileSync('components/fuckyoustatus.js', 'utf-8');
// Mock the DOM and global variables
const mockDOM = `
let window = { currentCSVData: [] };
let document = {
    getElementById: function(id) {
        return {
            value: (id === "annualBudget") ? "80000" :
                   (id === "inflationRate") ? "3.0" :
                   (id === "horizonYears") ? "15" :
                   (id === "modelSelect") ? "jjg_cycle" :
                   (id === "spotPremiumSelect") ? "cyclical" : "0",
            innerText: "",
            innerHTML: "",
            addEventListener: function() {},
            checked: false,
            classList: { add: function(){}, remove: function(){} },
            setAttribute: function(){},
            getAttribute: function(){},
        };
    },
    documentElement: { getAttribute: function() { return "light"; } }
};
let localStorage = { getItem: function() { return "light"; } };
let priceChartInstance = { updateOptions: function(){}, updateSeries: function(){} };
let coinsChartInstance = { updateOptions: function(){}, updateSeries: function(){} };
let chartPeriodDays = null;
let updatePriceChart = function(){};
let updateCoinsChart = function(){};
`;
code = mockDOM + code;
// Remove any fetch calls or apexcharts calls
code = code.replace(/fetch\(/g, '//fetch(').replace(/new ApexCharts/g, '//new ApexCharts').replace(/window\.addEventListener/g, '//window.addEventListener');

try {
    eval(code);
    prices = [];
    for (let i = 0; i < 1500; i++) {
        prices.push([new Date(2010 + Math.floor(i / 365), i % 365, 1).getTime(), 100 + i]);
    }
    sma200 = calculateSMA(prices, 1400);
    latest200WMA = 40000;
    recalculate();
    console.log("Recalculate ran successfully");
} catch (e) {
    console.error("Error:", e);
}
