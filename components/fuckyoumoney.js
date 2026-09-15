"use strict";

// Expose window.Apex defaults for the FU page charts
window.Apex = {
    chart: {
        background: 'transparent',
        animations: { enabled: false },
        toolbar: { show: true }
    },
    theme: {
        mode: localStorage.getItem('theme')
    },
    foreColor: '#535A6C',
    fontFamily: 'Inter, sans-serif'
};

// Global Variables
let prices = [];
let sma200 = [];
let latestSpotPrice = 0;
let latest200WMA = 0;
let priceChartInstance = null;
let coinsChartInstance = null;
let isLogarithmic = true;
let chartPeriodDays = null;

// Genesis date: Jan 3, 2009
const GENESIS_MS = 1230940800000;
const MS_IN_DAY = 24 * 60 * 60 * 1000;
const MS_IN_YEAR = 365.25 * MS_IN_DAY;

// 1. Calculate Simple Moving Average (SMA) — O(N) sliding window
function calculateSMA(data, period) {
    let sma = [];
    let windowSum = 0;
    for (let i = 0; i < data.length; i++) {
        windowSum += data[i][1];
        if (i >= period) {
            windowSum -= data[i - period][1];
            sma.push([data[i][0], windowSum / period]);
        } else {
            sma.push([data[i][0], windowSum / (i + 1)]);
        }
    }
    return sma;
}

// 2. Bearish Cycle Model Step Gain
function getBearishGain(date) {
    // A smoothed, conservative derivative of the JJG model
    return getJJGGain(date) * 0.70;
}

// 3. Stable Model — More Bearish (0.5x JJG)
function getStableGain(date) {
    return getJJGGain(date) * 0.20;
}

// 4. JJG Cycle Model Step Gain
function getJJGGain(date) {
    let year = date.getFullYear();
    let month = date.getMonth(); // 0-indexed, May is 4, Nov is 10

    // Calculate 6-month periods since May 2024 (Cycle 4 start)
    let periods = (year - 2024) * 2;
    if (month > 5) periods += 1;

    if (periods < 0) return 0;

    // Manually curated JJG gains for Cycles 4–7 (periods 0–31)
    const tableGains = [
        // 2024-2027 (Cycle 4)
        21.23, 17.97, 15.42, 44.00, 20.00, 15.00, 12.00, 11.40,
        // 2028-2031 (Cycle 5)
        15.00, 15.30, 15.61, 15.92, 9.00, 8.55, 8.12, 7.72,
        // 2032-2035 (Cycle 6)
        12.00, 12.24, 12.48, 12.73, 7.00, 6.65, 6.32, 6.00,
        // 2036-2039 (Cycle 7)
        10.00, 10.20, 10.40, 10.61, 6.00, 5.70, 5.42, 5.14
    ];

    if (periods < tableGains.length) {
        return tableGains[periods];
    }

    // ----- Auto-adjusting extrapolation for Cycle 8+ -----
    // Each halving cycle = 8 semi-annual periods (4 bull + 4 bear).
    // Bull-phase base: decreases by 1% per cycle, flooring at 4%
    // Bear-phase base: decreases by 1% per cycle, flooring at 3%
    // Within each phase, bull gains escalate +2% per step, bear gains decay −5% per step.
    // At the floor, the repeating cycle is: 4.00, 4.08, 4.16, 4.24, 3.00, 2.85, 2.71, 2.57

    let cycleIdx = Math.floor(periods / 8); // 0-based cycle index (Cycle 4 = 0)
    let stepInCycle = periods % 8;          // 0-7 position within the cycle
    let n = cycleIdx - 1;                   // offset from Cycle 5 (Cycle 5 = n=0)

    let bullBase = Math.max(4, 11 - n);
    let bearBase = Math.max(3, 8 - n);

    if (stepInCycle < 4) {
        // Bull phase (first 4 periods): base × 1.02^step
        return bullBase * Math.pow(1.02, stepInCycle);
    } else {
        // Bear phase (last 4 periods): base × 0.95^(step offset)
        return bearBase * Math.pow(0.95, stepInCycle - 4);
    }
}

// 5. Generate Semi-Annual Dates
function generateSemiAnnualDates(startYear, endYear) {
    let dates = [];
    for (let year = startYear; year <= endYear; year++) {
        dates.push(new Date(year, 5, 1));  // June 1st
        dates.push(new Date(year, 11, 1)); // December 1st
    }
    return dates.filter(d => d >= new Date(2010, 11, 1));
}

// Helper to find closest index in historical data
function findClosestIndex(data, target) {
    let closest = Math.abs(data[0][0] - target);
    let index = 0;
    for (let i = 1; i < data.length; i++) {
        let diff = Math.abs(data[i][0] - target);
        if (diff < closest) {
            closest = diff;
            index = i;
        }
    }
    return index;
}

// 6. Recalculate Logic
function recalculate() {
    if (prices.length === 0 || sma200.length === 0) return;

    // Inputs
    const rawBudget = parseFloat(document.getElementById("annualBudget").value);
    const annualBudget = isNaN(rawBudget) || rawBudget <= 0 ? 80000 : rawBudget;

    const rawInflation = parseFloat(document.getElementById("inflationRate").value);
    const inflationRate = isNaN(rawInflation) ? 3.0 : rawInflation;

    const rawHorizon = parseInt(document.getElementById("horizonYears").value, 10);
    const defaultHorizon = Math.max(10, 2090 - new Date().getFullYear());
    const horizonYears = isNaN(rawHorizon) || rawHorizon < 1 ? defaultHorizon : rawHorizon;
    const selectedModel = document.getElementById("modelSelect").value;
    const spotPremiumSelect = document.getElementById("spotPremiumSelect").value;

    // FU Target Purchasing Power Values
    const target10 = annualBudget / 0.10;
    const target4 = annualBudget / 0.04;
    const targetFR = 100_000_000; // Fixed $100M — independent of annual budget

    // Populate header cards using live prices
    if (latest200WMA > 0) {
        if (document.getElementById("todayFU10")) {
            document.getElementById("todayFU10").innerText = (target10 / latest200WMA).toFixed(2) + " BTC";
        }
        if (document.getElementById("todayFU4")) {
            document.getElementById("todayFU4").innerText = (target4 / latest200WMA).toFixed(2) + " BTC";
        }
        if (document.getElementById("todayFR")) {
            document.getElementById("todayFR").innerText = (targetFR / latest200WMA).toFixed(2) + " BTC";
        }

        // Update target USD portfolio subtexts (only FU10 and FU4 change with budget)
        if (document.getElementById("todayFU10Desc")) {
            document.getElementById("todayFU10Desc").innerText = "Target Portfolio: " + target10.toLocaleString("en-US", { style: "currency", currency: "USD", maximumFractionDigits: 0 });
        }
        if (document.getElementById("todayFU4Desc")) {
            document.getElementById("todayFU4Desc").innerText = "Target Portfolio: " + target4.toLocaleString("en-US", { style: "currency", currency: "USD", maximumFractionDigits: 0 });
        }
        // todayFRDesc stays fixed at $100M — no dynamic update needed
    }

    // Build timeline of dates
    const anchorDate = new Date();
    const endYear = anchorDate.getFullYear() + horizonYears;
    const allDates = generateSemiAnnualDates(2010, endYear);

    // Latest historical data point timestamp
    const latestHistTimestamp = prices[prices.length - 1][0];

    // Timeline calculations
    let tableRowsHTML = "";
    let csvData = [];

    // Arrays for charts
    let chartSpot = [];
    let chart200 = [];

    let chartFU10 = [];
    let chartFU4 = [];
    let chartFR = [];

    // Push historical prices/sma to chart data
    for (let i = 0; i < prices.length; i += 7) { // sample weekly for performance
        chartSpot.push([prices[i][0], prices[i][1]]);
        chart200.push([sma200[i][0], sma200[i][1]]);
    }

    // Anchor point for dynamic cyclical projection
    let lastActualDateIndex = -1;

    // Identify which semi-annual dates are historical vs future
    for (let i = 0; i < allDates.length; i++) {
        let d = allDates[i];
        if (d.getTime() <= latestHistTimestamp) {
            lastActualDateIndex = i;
        }
    }

    // Compute prices for all dates
    let computedData = [];
    let jjgRun200WMA = 0;
    let bearishRun200WMA = 0;
    let stableRun200WMA = 0;

    for (let i = 0; i < allDates.length; i++) {
        let d = allDates[i];
        let t = d.getTime();
        let isHist = (i <= lastActualDateIndex);

        let spot = 0;
        let wma = 0;

        if (isHist) {
            // Find closest index in history
            let histIdx = findClosestIndex(prices, t);
            spot = prices[histIdx][1];
            wma = sma200[histIdx][1];

            // Sync cyclical projection state
            jjgRun200WMA = wma;
            bearishRun200WMA = wma;
            stableRun200WMA = wma;
        } else {
            // Predict future WMA based on model selection
            if (selectedModel === "jjg_cycle") {
                // Apply semi-annual gain sequentially
                let jjgGain = getJJGGain(d);
                jjgRun200WMA = jjgRun200WMA * (1 + jjgGain / 100);
                wma = jjgRun200WMA;
            } else if (selectedModel === "bearish_cycle") {
                // Apply semi-annual gain sequentially with bearish decay
                let bearishGain = getBearishGain(d);
                bearishRun200WMA = bearishRun200WMA * (1 + bearishGain / 100);
                wma = bearishRun200WMA;
            } else if (selectedModel === "stable_ratio") {
                // Apply semi-annual gain sequentially with more bearish decay
                let stableGain = getStableGain(d);
                stableRun200WMA = stableRun200WMA * (1 + stableGain / 100);
                wma = stableRun200WMA;
            }

            // Predict spot price based on premium select
            if (spotPremiumSelect === "fixed") {
                spot = wma * 1.30; // 30% premium
            } else {
                // Cyclical premium (sine wave approximation of halving cycle)
                let yearsFromToday = (t - latestHistTimestamp) / MS_IN_YEAR;
                let cyclePhase = (yearsFromToday % 4.0) / 4.0;
                let multiplier = 1.36 + Math.sin(cyclePhase * 2.0 * Math.PI) * 0.66;
                spot = wma * multiplier;
            }
        }

        // Compounded inflation years
        let yearsElapsed = (t - latestHistTimestamp) / MS_IN_YEAR;
        if (yearsElapsed < 0) yearsElapsed = 0;

        let inflatedFU10 = target10 * Math.pow(1 + inflationRate / 100, yearsElapsed);
        let inflatedFU4 = target4 * Math.pow(1 + inflationRate / 100, yearsElapsed);
        let inflatedFR = targetFR * Math.pow(1 + inflationRate / 100, yearsElapsed);

        let coins10 = inflatedFU10 / wma;
        let coins4 = inflatedFU4 / wma;
        let coinsFR = inflatedFR / wma;

        computedData.push({
            date: d,
            spot,
            wma,
            coins10,
            coins4,
            coinsFR,
            inflatedFU10,
            inflatedFU4,
            inflatedFR
        });

        // Add to projections charts if future
        if (!isHist) {
            chartSpot.push([t, spot]);
            chart200.push([t, wma]);
        }

        // Add to FU Coins needed chart (entire timeline)
        chartFU10.push([t, coins10]);
        chartFU4.push([t, coins4]);
        chartFR.push([t, coinsFR]);
    }

    // Build Table Rows
    computedData.forEach((row, index) => {
        let dateStr = row.date.toLocaleDateString("en-US", { year: 'numeric', month: 'numeric', day: 'numeric' });
        let isFuture = (index > lastActualDateIndex);
        let rowClass = isFuture ? "text-body-secondary" : "";

        let gainPercent = "—";
        if (isFuture && selectedModel === "jjg_cycle") {
            gainPercent = "+" + getJJGGain(row.date).toFixed(2) + "%";
        } else if (isFuture && selectedModel === "bearish_cycle") {
            gainPercent = "+" + getBearishGain(row.date).toFixed(2) + "%";
        } else if (isFuture) {
            gainPercent = "Fit Curve";
        }

        let spotVs200Str = ((row.spot - row.wma) / row.wma * 100).toFixed(1) + "%";
        if (row.spot >= row.wma) {
            spotVs200Str = "+" + spotVs200Str;
        }

        tableRowsHTML += `
            <tr class="${rowClass}">
               <td class="text-nowrap">${dateStr} ${isFuture ? '<span class="badge text-bg-primary bg-opacity-75 ms-1" style="font-size:.65em">Proj</span>' : ''}</td>
               <td>${(row.spot).toLocaleString("en-US", { style: "currency", currency: "USD", maximumFractionDigits: 0 })}</td>
               <td>${(row.wma).toLocaleString("en-US", { style: "currency", currency: "USD", maximumFractionDigits: 0 })}</td>
               <td>${gainPercent}</td>
               <td>${spotVs200Str}</td>
               <td class="fw-semibold text-success">${row.coins10.toLocaleString("en-US", { maximumFractionDigits: 2 })} BTC</td>
               <td class="fw-semibold text-info">${row.coins4.toLocaleString("en-US", { maximumFractionDigits: 2 })} BTC</td>
               <td class="fw-semibold" style="color: #6f42c1;">${row.coinsFR.toLocaleString("en-US", { maximumFractionDigits: 2 })} BTC</td>
            </tr>
        `;

        csvData.push([
            dateStr,
            Math.round(row.spot),
            Math.round(row.wma),
            gainPercent,
            spotVs200Str,
            row.coins10.toFixed(2),
            row.coins4.toFixed(2),
            row.coinsFR.toFixed(2)
        ]);
    });

    document.getElementById("tableBody").innerHTML = tableRowsHTML;
    window.currentCSVData = csvData; // Store globally for export

    // Filter price chart data if timeline period is selected
    let displayedSpot = chartSpot;
    let displayed200 = chart200;
    if (chartPeriodDays !== null) {
        let threshold = Date.now() + (chartPeriodDays * 24 * 60 * 60 * 1000);
        displayedSpot = chartSpot.filter(pt => pt[0] >= threshold);
        displayed200 = chart200.filter(pt => pt[0] >= threshold);
    }

    // Update charts
    updatePriceChart(displayedSpot, displayed200, latestHistTimestamp);
    updateCoinsChart(chartFU10, chartFU4, chartFR);
}

// 7. Draw / Update Price Prediction Chart (Continuous Series with Annotation)
function updatePriceChart(spotData, wmaData, transitionTimestamp) {
    const isDark = localStorage.getItem('theme') === "dark";

    let options = {
        chart: {
            height: 380,
            id: 'price-proj-chart',
            toolbar: { show: true },
        },
        theme: {
            mode: isDark ? 'dark' : 'light'
        },
        stroke: {
            width: [2, 3],
            curve: 'smooth'
        },
        colors: ['#6c757d', '#f5a623'], // Spot Price (grey), 200WMA (orange)
        series: [
            { name: 'BTC Spot Price', data: spotData, type: 'area' },
            { name: '200-Week MA', data: wmaData, type: 'area' }
        ],
        fill: {
            type: ['solid', 'solid'],
            opacity: [0.15, 0]
        },
        xaxis: {
            type: 'datetime',
            labels: { style: { colors: isDark ? '#adb5bd' : '#495057' } }
        },
        yaxis: {
            logarithmic: isLogarithmic,
            forceNiceScale: true,
            labels: {
                style: { colors: isDark ? '#d7daddff' : '#495057' },
                formatter: function (val) {
                    return "$" + Math.round(val).toLocaleString();
                }
            }
        },
        annotations: {
            xaxis: [{
                x: transitionTimestamp,
                borderColor: '#20c997',
                borderWidth: 2,
                label: {
                    borderColor: '#20c997',
                    style: {
                        color: isDark ? '#000' : '#fff',
                        background: '#20c997'
                    },
                    text: 'Prediction Start'
                }
            }]
        },
        tooltip: {
            x: { format: 'dd MMM yyyy' }
        },
        grid: {
            borderColor: isDark ? '#343a40' : '#dee2e6',
            yaxis: {
                lines: {
                    show: !isLogarithmic
                }
            }
        },
        legend: {
            show: true,
            horizontalAlign: 'left',
            position: 'top',
            markers: {
                strokeWidth: 0,
                offsetX: -2
            }
        },
    };

    if (priceChartInstance) {
        priceChartInstance.updateOptions(options);
    } else {
        priceChartInstance = new ApexCharts(document.querySelector("#priceChart"), options);
        priceChartInstance.render();
    }
}

// 8. Draw / Update Coins Needed Chart (Logarithmic scale)
function updateCoinsChart(fu10, fu4, fr) {
    const isDark = document.documentElement.getAttribute("data-bs-theme") === "dark";

    let optionsFU = {
        chart: {
            type: 'line',
            height: 380,
            id: 'coins-needed-chart',
            toolbar: { show: true },
            zoom: { enabled: false },
        },
        theme: {
            mode: isDark ? 'dark' : 'light'
        },
        stroke: {
            width: 2.5
        },
        colors: ['#198754', '#0dcaf0', '#6f42c1'],
        series: [
            { name: 'Coins for 10% FU Status', data: fu10 },
            { name: 'Coins for 4% FU Status', data: fu4 },
            { name: 'Coins for Filthy-Rich', data: fr }
        ],
        xaxis: {
            type: 'datetime',
            labels: { style: { colors: isDark ? '#adb5bd' : '#495057' } }
        },
        yaxis: {
            logarithmic: true,
            forceNiceScale: true,
            min: 0.1,
            labels: {
                style: { colors: isDark ? '#adb5bd' : '#495057' },
                formatter: function (val) {
                    if (val >= 1000) {
                        return Math.round(val).toLocaleString() + " BTC";
                    }
                    return val.toFixed(2) + " BTC";
                }
            }
        },
        tooltip: {
            x: { format: 'dd MMM yyyy' },
            theme: localStorage.getItem('theme'),
        },
        grid: {
            borderColor: isDark ? '#343a40' : '#dee2e6'
        },
        legend: {
            labels: { colors: isDark ? '#f8f9fa' : '#212529' }
        }
    };

    if (coinsChartInstance) {
        coinsChartInstance.updateOptions(optionsFU);
    } else {
        coinsChartInstance = new ApexCharts(document.querySelector("#coinsChart"), optionsFU);
        coinsChartInstance.render();
    }
}

// Export data to CSV helper
window.exportTableToCSV = function () {
    if (!window.currentCSVData) return;

    let csvContent = "data:text/csv;charset=utf-8,";
    csvContent += "Date,Spot Price,200WMA,Gain % / Time,Spot vs 200WMA,Coins Needed 10% FU,Coins Needed 4% FU,Coins Needed Filthy-Rich\n";

    window.currentCSVData.forEach(row => {
        csvContent += row.join(",") + "\n";
    });

    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "bitcoin_fuckyoumoney_projections.csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};

// ─── Share (CryptoJS AES encrypted URL) ────────────────────────────
const SHARE_KEY = "btc-fu-status";
const SHARE_DELIMITER = "\n---\n";

window.saveAndShare = function () {
    const budget = document.getElementById("annualBudget").value;
    const inflation = document.getElementById("inflationRate").value;
    const horizon = document.getElementById("horizonYears").value;
    const model = document.getElementById("modelSelect").value;
    const premium = document.getElementById("spotPremiumSelect").value;

    const payload = budget + SHARE_DELIMITER + inflation + SHARE_DELIMITER + horizon + SHARE_DELIMITER + model + SHARE_DELIMITER + premium;
    let encrypted = "";
    if (typeof CryptoJS !== 'undefined' && CryptoJS.AES) {
        encrypted = CryptoJS.AES.encrypt(payload, SHARE_KEY).toString();
    }

    const origin = window.location.origin;
    const pathname = window.location.pathname;
    const shareUrl = (origin && origin !== "null" ? origin + pathname : "https://bitcoindata.science/fuckyoumoney") + "#" + encrypted;
    const formattedBudget = Number(budget).toLocaleString("en-US", { style: "currency", currency: "USD", maximumFractionDigits: 0 });
    const bbcode = "[url=" + shareUrl + "]Bitcoin Fuck You Status (" + formattedBudget + "/yr budget, " + inflation + "% inflation)[/url]";

    const shareContainer = document.getElementById("shareContainer");
    const shareUrlInput = document.getElementById("shareUrl");
    const shareBbcodeInput = document.getElementById("shareBbcode");

    if (shareUrlInput) shareUrlInput.value = shareUrl;
    if (shareBbcodeInput) shareBbcodeInput.value = bbcode;
    if (shareContainer) shareContainer.classList.remove("d-none");

    copyShareUrl("shareUrl", "copyShareBtn");
};

window.copyShareUrl = function (inputId, btnId) {
    inputId = inputId || "shareUrl";
    btnId = btnId || "copyShareBtn";
    const input = document.getElementById(inputId);
    const btn = document.getElementById(btnId);
    if (!input) return;

    navigator.clipboard.writeText(input.value).then(function () {
        if (btn) {
            const origText = btn.textContent;
            btn.textContent = "Copied!";
            const wasPrimary = btn.classList.contains("btn-primary");
            btn.classList.remove("btn-primary", "btn-secondary");
            btn.classList.add("btn-success");
            setTimeout(function () {
                btn.textContent = origText;
                btn.classList.remove("btn-success");
                btn.classList.add(wasPrimary ? "btn-primary" : "btn-secondary");
            }, 1800);
        }
    }).catch(function (err) {
        console.warn("Clipboard copy error:", err);
    });
};

function tryLoadEncrypted(hash) {
    if (!hash || typeof CryptoJS === 'undefined' || !CryptoJS.AES) return false;
    try {
        const decrypted = CryptoJS.AES.decrypt(hash, SHARE_KEY);
        const plaintext = decrypted.toString(CryptoJS.enc.Utf8);
        if (!plaintext || plaintext.indexOf(SHARE_DELIMITER) === -1) return false;

        const parts = plaintext.split(SHARE_DELIMITER);
        if (parts.length >= 5) {
            applyLoadedParams(parts[0], parts[1], parts[2], parts[3], parts[4]);
            return true;
        }
    } catch (e) { }
    return false;
}

function tryLoadPlainParams(hash) {
    if (!hash) return false;
    try {
        const params = new URLSearchParams(hash);
        const budget = params.get("budget") || params.get("annualBudget");
        const inflation = params.get("inflation") || params.get("inflationRate");
        const horizon = params.get("horizon") || params.get("horizonYears");
        const model = params.get("model") || params.get("modelSelect");
        const premium = params.get("premium") || params.get("spotPremiumSelect");

        if (budget || inflation || horizon || model || premium) {
            applyLoadedParams(budget, inflation, horizon, model, premium);
            return true;
        }
    } catch (e) { }
    return false;
}

function applyLoadedParams(budget, inflation, horizon, model, premium) {
    if (budget) {
        const bInput = document.getElementById("annualBudget");
        const bRange = document.getElementById("annualBudgetRange");
        if (bInput) bInput.value = budget;
        if (bRange) bRange.value = budget;
    }
    if (inflation) {
        const iInput = document.getElementById("inflationRate");
        const iRange = document.getElementById("inflationRateRange");
        if (iInput) iInput.value = inflation;
        if (iRange) iRange.value = inflation;
    }
    if (horizon) {
        const hInput = document.getElementById("horizonYears");
        const hRange = document.getElementById("horizonYearsRange");
        if (hInput) hInput.value = horizon;
        if (hRange) hRange.value = horizon;
    }
    if (model) {
        const mSelect = document.getElementById("modelSelect");
        if (mSelect) mSelect.value = model;
    }
    if (premium) {
        const pSelect = document.getElementById("spotPremiumSelect");
        if (pSelect) pSelect.value = premium;
    }
}

// Global theme updater
window.updateChartThemes = function (theme) {
    let mode = (theme === 'dark') ? 'dark' : 'light';
    if (priceChartInstance) {
        priceChartInstance.updateOptions({ chart: { theme: { mode: mode } } });
    }
    if (coinsChartInstance) {
        coinsChartInstance.updateOptions({ chart: { theme: { mode: mode } } });
    }
};

// Sync controls: slider + number inputs
function setupSyncInputs(inputId, rangeId) {
    const input = document.getElementById(inputId);
    const range = document.getElementById(rangeId);

    if (input && range) {
        input.addEventListener("input", () => {
            range.value = input.value;
            recalculate();
        });
        range.addEventListener("input", () => {
            input.value = range.value;
            recalculate();
        });
    }
}

// Helper to fetch JSON with error catching
async function fetchJsonSafely(url) {
    try {
        let response = await fetch(url);
        if (!response.ok) {
            console.warn("HTTP error fetching " + url + ": " + response.status);
            return null;
        }
        return await response.json();
    } catch (error) {
        console.warn("Network error fetching " + url + ":", error);
        return null;
    }
}

// Initialization on load
document.addEventListener("DOMContentLoaded", () => {
    // Setup Sync Inputs
    setupSyncInputs("annualBudget", "annualBudgetRange");
    setupSyncInputs("inflationRate", "inflationRateRange");
    setupSyncInputs("horizonYears", "horizonYearsRange");

    // Initialize horizon to reach 2090 by default
    const currentYear = new Date().getFullYear();
    const defaultHorizon = Math.max(10, 2090 - currentYear);
    const horizonInput = document.getElementById("horizonYears");
    const horizonRange = document.getElementById("horizonYearsRange");
    if (horizonInput && horizonRange) {
        horizonInput.max = Math.max(70, defaultHorizon);
        horizonRange.max = Math.max(70, defaultHorizon);
        horizonInput.value = defaultHorizon;
        horizonRange.value = defaultHorizon;
    }

    // Recalculate on drop-down changes
    document.getElementById("modelSelect").addEventListener("change", recalculate);
    document.getElementById("spotPremiumSelect").addEventListener("change", recalculate);

    // Fetch Prices and MA data
    const priceUrl = 'https://bitcoindata.science/api/priceusd.json';
    const chartUrl = 'https://bitcoindata.science/api/marketchart.php';

    Promise.all([
        fetchJsonSafely(priceUrl),
        fetchJsonSafely(chartUrl)
    ]).then(([resPrice, resHistory]) => {
        if (!resHistory || !Array.isArray(resHistory)) {
            console.error("Failed to load bitcoin price history");
            document.getElementById("tableBody").innerHTML = `
                <tr>
                   <td colspan="8" class="text-center text-danger py-5">
                      Failed to load price history from local server. Please check file permissions or console logs.
                   </td>
                </tr>
            `;
            return;
        }

        prices = resHistory;

        if (resPrice && resPrice.price) {
            latestSpotPrice = resPrice.price;
        } else {
            // Fallback to the latest price in the history
            latestSpotPrice = prices[prices.length - 1][1];
            console.warn("Using historical price fallback for spot price:", latestSpotPrice);
        }

        // Push the absolute latest price point to prices array
        prices.push([Date.now(), latestSpotPrice]);

        // Calculate daily 200WMA
        sma200 = calculateSMA(prices, 1400);
        latest200WMA = sma200[sma200.length - 1][1];

        // Populate header cards
        document.getElementById("liveSpotPrice").innerHTML = latestSpotPrice.toLocaleString("en-US", { style: "currency", currency: "USD" });
        document.getElementById("live200WMA").innerHTML = latest200WMA.toLocaleString("en-US", { style: "currency", currency: "USD" });

        // Setup highlights for period select buttons
        setupPeriodButtons();

        // Check URL hash/search for shared parameters
        let hash = window.location.hash ? window.location.hash.substring(1) : "";
        if (!hash && window.location.search) {
            hash = window.location.search.substring(1);
        }
        if (hash) {
            tryLoadEncrypted(hash) || tryLoadPlainParams(hash);
        }

        // Trigger first calculations
        recalculate();

        // Trigger window resize event on tab switch so ApexCharts resizes correctly
        document.querySelectorAll('button[data-bs-toggle="tab"], button[data-bs-toggle="pill"]').forEach(tabEl => {
            tabEl.addEventListener('shown.bs.tab', () => {
                window.dispatchEvent(new Event('resize'));
            });
        });
    });
});

// Setup period select buttons active state toggling
function setupPeriodButtons() {
    let container = document.querySelector("#priceChartContainer .col-auto");
    if (container) {
        let buttons = container.querySelectorAll(".pointer");
        buttons.forEach(btn => {
            btn.addEventListener("click", (e) => {
                buttons.forEach(b => b.classList.remove("link-secondary", "border-bottom", "border-3"));
                e.target.classList.add("link-secondary", "border-bottom", "border-3");
            });
        });
    }
}

// Global scale toggle
window.togglePriceLogScale = function () {
    isLogarithmic = document.getElementById("linLog").checked;
    recalculate();
};

// Global period filter
window.priceChartPeriod = function (days) {
    chartPeriodDays = days === undefined ? null : days;
    recalculate();
};
