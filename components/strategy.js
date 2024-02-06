"use strict";
// global variables
let percentAboveMovingAverage;
let btcSpotPrice;
let sma200;
let prices;
let movingAverage;
let defaultSpotPrice; // price that will never change

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
    document.getElementById("currentDate").innerText = new Date().toLocaleDateString()

    // Header Data
    percentAboveMovingAverage = (btcSpotPrice - movingAverage) / movingAverage;

    document.getElementById("pricesma").innerHTML = percentAboveMovingAverage.toLocaleString("en-US", { style: "percent", minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById("sma").innerHTML = movingAverage.toLocaleString("en-US", { style: "currency", currency: "USD" });
    document.getElementById("BTCPrice").innerHTML = btcSpotPrice.toLocaleString("en-US", { style: "currency", currency: "USD" });
   (percentAboveMovingAverage > 0) ? document.getElementById("pricesma").className = 'text-success-emphasis card-title display-6 fw-semibold' : document.getElementById("pricesma").className = 'text-danger card-title display-6 fw-semibold';
    
    //Withdrawal Rate Description
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
    document.getElementById("stashValue").innerHTML = (document.getElementById("stash").value * btcSpotPrice).toLocaleString("en-US", { style: "currency", currency: "USD" });
    document.getElementById("stashWMAValue").innerHTML = (document.getElementById("stash").value * movingAverage).toLocaleString("en-US", { style: "currency", currency: "USD" });

    //Set Withdrawal Limit
    let withdrawalLimit;
    let monthFormula = document.getElementById("monthFormula");
    if (percentAboveMovingAverage >= 0.25) {
        withdrawalLimit = btcStashSize * annualWithdrawalRate / 12;
        monthFormula.innerText = '(100%)';
    } else if (percentAboveMovingAverage >= 0.1) {
        withdrawalLimit = btcStashSize * annualWithdrawalRate / 12 * 0.9;
        monthFormula.innerText = '(90%)';
    } else if (percentAboveMovingAverage >= 0) {
        withdrawalLimit = btcStashSize * annualWithdrawalRate / 12 * 0.85;
        monthFormula.innerText = '(85%)';
    } else if (percentAboveMovingAverage >= -0.2) {
        withdrawalLimit = btcStashSize * annualWithdrawalRate / 12 * 0.7;
        monthFormula.innerText = '(70%)';
    } else if (percentAboveMovingAverage >= -0.3) {
        withdrawalLimit = btcStashSize * annualWithdrawalRate / 12 * 0.5;
        monthFormula.innerText = '(50%)';
    } else if (percentAboveMovingAverage >= -0.35) {
        withdrawalLimit = btcStashSize * annualWithdrawalRate / 12 * 0.4;
        monthFormula.innerText = '(40%)';
    } else {
        withdrawalLimit = 0;
        monthFormula.innerText = '(0%)';
    }

    wRateRange.innerHTML = wrate.value + '%';
    document.getElementById("allowed").value = withdrawalLimit.toFixed(8);
    document.getElementById("allowedvalue").value = (withdrawalLimit * btcSpotPrice).toFixed(2);
    document.getElementById("monthAdvance").value = calculateAdvancedWithdraw();
    document.getElementById("allowedAdv").value = (calculateAdvancedWithdraw() * withdrawalLimit).toFixed(8);
    document.getElementById("allowedAdvVal").value = (calculateAdvancedWithdraw() * withdrawalLimit * btcSpotPrice).toFixed(2);
}

// Advanced Withdrawal
function calculateAdvancedWithdraw() {
    let advMonthFormula = document.getElementById("advMonthFormula");
    if (percentAboveMovingAverage >= 0.33 && percentAboveMovingAverage < 0.66) {
        advMonthFormula.innerText = '(33% - 66%)';
        return 1;
    } else if (percentAboveMovingAverage >= 0.66 && percentAboveMovingAverage < 1) {
        advMonthFormula.innerText = '(66%-100%)';
        return 3;
    } else if (percentAboveMovingAverage >= 1 && percentAboveMovingAverage < 2) {
        advMonthFormula.innerText = '(100%-200%)';
        return 5;
    } else if (percentAboveMovingAverage >= 2 && percentAboveMovingAverage < 4) {
        advMonthFormula.innerText = '(200%-400%)';
        return 11;
    } else if (percentAboveMovingAverage >= 4 && percentAboveMovingAverage < 6.5) {
        advMonthFormula.innerText = '(400%-650%)';
        return 23;
    } else if (percentAboveMovingAverage >= 6.5 && percentAboveMovingAverage < 9) {
        advMonthFormula.innerText = '(650%-900%)';
        return 35;
    } else if (percentAboveMovingAverage >= 9 && percentAboveMovingAverage < 14) {
        advMonthFormula.innerText = '(900%-1400%)';
        return 47;
    } else if (percentAboveMovingAverage >= 14) {
        advMonthFormula.innerText = '(1400+%)';
        return 59;
    } else {
        advMonthFormula.innerText = 'none';
        return 0;
    }
}

// Save and Load Input area data from past sessions
//load
if (window.localStorage["annualWithdrawalRate"] && window.localStorage["btcStashSize"]) {
    document.getElementById("wrate").value = window.localStorage["annualWithdrawalRate"];
    document.getElementById("stash").value = window.localStorage["btcStashSize"];
}
//save
function saveToLocalStorage() {
    window.localStorage['annualWithdrawalRate'] = document.getElementById("wrate").value;
    window.localStorage['btcStashSize'] = document.getElementById("stash").value;
}
function restoreDefaults() {
    document.getElementById("wrate").value = 6;
    document.getElementById("stash").value = 1;
    calculateWithdrawalLimit()
}
// Toast
const toastTrigger = document.getElementById('saveInputs')
const saveInputsToast = document.getElementById('saveInputsToast')

if (toastTrigger) {
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(saveInputsToast)
    toastTrigger.addEventListener('click', () => {
        toastBootstrap.show()
    })
}

// Work on data
fetchUrls(urls).then(([res1, res2, res3]) => {
    btcSpotPrice = res1.price;
    defaultSpotPrice = btcSpotPrice;
    let oldprice = res2;
    let newprices = res3.prices;
    prices = oldprice.concat(newprices);
    prices.push([Date.now(),defaultSpotPrice])
    sma200 = calculateSMA(prices, 1400);
    movingAverage = sma200[sma200.length - 1][1];

    // Load data into Chart
    chart.updateSeries([{
        name: 'BTC Price',
        data: prices,
        type: "area",
    }, {
        name: '200-Week MA',
        data: sma200,
        type: "line"
    }]);

    // Load Dynamic Data
    calculateWithdrawalLimit();
});
