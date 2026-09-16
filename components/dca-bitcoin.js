"use strict";

// ---- Constants ----
const SHARE_KEY = "btc-dca";
const SHARE_DELIMITER = "\n---\n";
const API_URLS = [
    "https://bitcoindata.science/api/priceusd.json",
    "https://bitcoindata.science/api/marketchart.php"
];

// ---- Global state ----
let priceHistory = [];      // [[timestamp, price], ...]
let spotPrice = 0;
let dcaMainChart = null;

// Simulation results (kept for CSV export)
let simResults = [];

// ---- Formatting helpers ----
const fmtUSD = (v) => (v == null || isNaN(v)) ? "$0" : Number(v).toLocaleString("en-US", { style: "currency", currency: "USD", maximumFractionDigits: 0 });
const fmtUSD2 = (v) => (v == null || isNaN(v)) ? "$0.00" : Number(v).toLocaleString("en-US", { style: "currency", currency: "USD", minimumFractionDigits: 2, maximumFractionDigits: 2 });
const fmtBTC = (v) => (v == null || isNaN(v)) ? "0.00000000" : Number(v).toLocaleString("en-US", { minimumFractionDigits: 8, maximumFractionDigits: 8 });
const fmtPct = (v) => (v == null || isNaN(v)) ? "0.00%" : Number(v).toLocaleString("en-US", { style: "percent", minimumFractionDigits: 2, maximumFractionDigits: 2 });

function niceCeil(val) {
    if (val <= 0) return 100;
    const pow = Math.pow(10, Math.floor(Math.log10(val)));
    const leading = val / pow;
    let niceLeading;
    if (leading <= 1) niceLeading = 1;
    else if (leading <= 1.25) niceLeading = 1.25;
    else if (leading <= 1.5) niceLeading = 1.5;
    else if (leading <= 2) niceLeading = 2;
    else if (leading <= 2.5) niceLeading = 2.5;
    else if (leading <= 3) niceLeading = 3;
    else if (leading <= 4) niceLeading = 4;
    else if (leading <= 5) niceLeading = 5;
    else if (leading <= 6) niceLeading = 6;
    else if (leading <= 7.5) niceLeading = 7.5;
    else niceLeading = 10;
    return niceLeading * pow;
}

// ---- Data fetching ----
async function fetchPriceData() {
    try {
        const responses = await Promise.all(API_URLS.map(u => fetch(u)));
        const data = await Promise.all(responses.map(r => r.json()));
        return data;
    } catch (err) {
        console.error("Failed to fetch price data:", err);
    }
}

// ---- Find closest price by timestamp ----
function findClosestIndex(data, target) {
    let closest = Math.abs(data[0][0] - target);
    let idx = 0;
    for (let i = 1; i < data.length; i++) {
        const diff = Math.abs(data[i][0] - target);
        if (diff < closest) { closest = diff; idx = i; }
    }
    return idx;
}

// ---- Calendar-based buy day check ----
function isBuyDay(timestamp, freq, startDate) {
    freq = parseInt(freq);
    const d = new Date(timestamp);
    if (freq === 1) {
        return true;
    } else if (freq === 7) {
        return d.getUTCDay() === 1; // Monday
    } else if (freq === 15) {
        const day = d.getUTCDate();
        return day === 1 || day === 15;
    } else if (freq === 30) {
        return d.getUTCDate() === 1;
    }
    return false;
}

// ---- Slice priceHistory from start date onward ----
function sliceChart(data, date) {
    const startIdx = findClosestIndex(data, new Date(date).getTime());
    return data.slice(startIdx);
}

// ---- DCA Simulation ----
function simulateDCA() {
    const amount = parseFloat(document.getElementById("investAmount").value) || 100;
    const freq = parseInt(document.getElementById("frequency").value) || 7;
    const startStr = document.getElementById("startDate").value;
    const endStr = document.getElementById("endDate") ? document.getElementById("endDate").value : "";

    if (!priceHistory.length || !startStr) return;

    if (endStr && startStr) {
        const startTs = new Date(startStr).getTime();
        const endTs = new Date(endStr).getTime();
        if (startTs > endTs) return;
    }

    const endBuyTs = endStr ? new Date(endStr + "T23:59:59Z").getTime() : Infinity;

    const slicedData = sliceChart(priceHistory, startStr);
    if (!slicedData.length) return;

    let totalInvested = 0;
    let totalBTC = 0;
    const seriesInvested = [];
    const seriesValue = [];
    const seriesBTC = [];
    simResults = [];

    for (let i = 0; i < slicedData.length; i++) {
        const [ts, price] = slicedData[i];

        if (ts <= endBuyTs && isBuyDay(ts, freq, startStr)) {
            const btcBought = amount / price;
            totalInvested += parseFloat(amount.toFixed(2));
            totalBTC += parseFloat(btcBought.toFixed(8));

            simResults.push({
                date: new Date(ts).toISOString().split("T")[0],
                price: price,
                btcBought: btcBought,
                cumulativeBTC: totalBTC,
                cumulativeInvested: totalInvested,
                portfolioValue: totalBTC * price
            });
        }

        if (totalBTC > 0) {
            seriesInvested.push([ts, totalInvested]);
            seriesBTC.push([ts, totalBTC]);
            seriesValue.push([ts, totalBTC * price]);
        }
    }

    if (simResults.length === 0) return;

    // Update charts
    updateDCAChart(seriesInvested, seriesValue, seriesBTC);

    // Update summary cards
    const latestPrice = spotPrice || priceHistory[priceHistory.length - 1][1];
    const portfolioNow = totalBTC * latestPrice;
    const profit = portfolioNow - totalInvested;
    const roi = totalInvested > 0 ? (portfolioNow - totalInvested) / totalInvested : 0;

    document.getElementById("totalInvested").textContent = fmtUSD(totalInvested);
    document.getElementById("portfolioValue").textContent = fmtUSD(portfolioNow);
    document.getElementById("btcAccumulated").textContent = fmtBTC(totalBTC) + " BTC";
    document.getElementById("numPurchases").textContent = simResults.length;
    document.getElementById("avgPrice").textContent = fmtUSD2(totalInvested / totalBTC);
    document.getElementById("currentBtcPrice").textContent = fmtUSD2(latestPrice);

    const profitEl = document.getElementById("profitLoss");
    profitEl.textContent = (profit >= 0 ? "+" : "") + fmtUSD(profit);
    profitEl.className = "h5 fw-bold " + (profit >= 0 ? "text-success" : "text-danger");

    const roiEl = document.getElementById("roiPercent");
    roiEl.textContent = (roi >= 0 ? "+" : "") + fmtPct(roi);
    roiEl.className = "card-title display-6 fw-semibold " + (roi >= 0 ? "text-success" : "text-danger");
}

// ---- Chart Rendering ----
function initCharts() {
    const theme = localStorage.getItem("theme") || "dark";

    // Main DCA Chart
    const mainOpts = {
        chart: {
            id: "dca-main-chart",
            type: "line",
            height: 450,
            background: "transparent",
            zoom: { autoScaleYaxis: true },
            animations: { enabled: false },
            toolbar: { zoom: false, show: false }
        },
        theme: { mode: theme },
        series: [],
        stroke: { width: [2, 2, 2], curve: "straight" },
        colors: ["#6c757d", "#20c997", "#f7931a"],
        fill: {
            type: ["gradient", "gradient", "gradient"],
            opacity: [0.25, 0.35, 0.2],
            gradient: {
                shadeIntensity: 0.3,
                opacityFrom: 0.5,
                opacityTo: 0.1,
                stops: [0, 100]
            }
        },
        xaxis: {
            type: "datetime",
            crosshairs: {
                show: true,
                width: 1,
                position: "back",
                opacity: 0.9,
                stroke: {
                    color: "#535A6C",
                    width: 1,
                    dashArray: 3
                }
            }
        },
        yaxis: [
            {
                seriesName: "Total Invested (USD)",
                show: true,
                forceNiceScale: true,
                labels: {
                    formatter: (val) => fmtUSD(val)
                }
            },
            {
                seriesName: "Portfolio Value (USD)",
                show: false,
                forceNiceScale: true,
                labels: {
                    formatter: (val) => fmtUSD(val)
                }
            },
            {
                seriesName: "BTC Accumulated",
                opposite: true,
                show: false,
                forceNiceScale: true,
                labels: {
                    formatter: (val) => val.toFixed(4) + " BTC"
                }
            }
        ],
        legend: {
            show: true,
            horizontalAlign: "left",
            position: "top",
            markers: { strokeWidth: 0, offsetX: -2 }
        },
        dataLabels: { enabled: false },
        tooltip: {
            theme: "dark",
            shared: true,
            intersect: false,
            x: { show: true, format: "yyyy/MM/dd" },
            y: {
                formatter: function (val, opts) {
                    if (val == null) return "";
                    const sIdx = opts && opts.seriesIndex !== undefined ? opts.seriesIndex : -1;
                    if (sIdx === 2) {
                        return fmtBTC(val) + " BTC";
                    }
                    return fmtUSD(val);
                }
            }
        },
        grid: {
            show: true,
            borderColor: "#535A6C33",
            xaxis: { lines: { show: true } },
            yaxis: { lines: { show: false } }
        },
        noData: { text: "Loading..." },
        markers: {
            size: 0,
            hover: {
                size: 5,
                sizeOffset: 2
            }
        }
    };

    dcaMainChart = new ApexCharts(document.querySelector("#dcaChart"), mainOpts);
    dcaMainChart.render();

}

function updateDCAChart(seriesInvested, seriesValue, seriesBTC) {
    if (!dcaMainChart) return;

    let maxUSD = 0;
    let minUSD = Infinity;
    for (let i = 0; i < seriesInvested.length; i++) {
        const v = seriesInvested[i][1];
        if (v > maxUSD) maxUSD = v;
        if (v > 0 && v < minUSD) minUSD = v;
    }
    for (let i = 0; i < seriesValue.length; i++) {
        const v = seriesValue[i][1];
        if (v > maxUSD) maxUSD = v;
        if (v > 0 && v < minUSD) minUSD = v;
    }
    if (!isFinite(minUSD) || minUSD <= 0) minUSD = 1;
    if (maxUSD <= 0) maxUSD = 1000;

    const sharedMax = niceCeil(maxUSD);

    dcaMainChart.updateOptions({
        yaxis: [
            {
                seriesName: "Total Invested (USD)",
                show: true,
                forceNiceScale: true,
                min: 0,
                max: sharedMax,
                labels: {
                    formatter: (val) => fmtUSD(val)
                }
            },
            {
                seriesName: "Portfolio Value (USD)",
                show: false,
                forceNiceScale: true,
                min: 0,
                max: sharedMax,
                labels: {
                    formatter: (val) => fmtUSD(val)
                }
            },
            {
                seriesName: "BTC Accumulated",
                opposite: true,
                show: false,
                forceNiceScale: true,
                labels: {
                    formatter: (val) => val.toFixed(4) + " BTC"
                }
            }
        ],
        stroke: { width: [2, 2, 2], curve: ["stepline", "straight", "stepline"] },
        series: [
            { name: "Total Invested (USD)", type: "area", data: seriesInvested },
            { name: "Portfolio Value (USD)", type: "area", data: seriesValue },
            { name: "BTC Accumulated", type: "area", data: seriesBTC }
        ]
    });
}

// ---- Share Logic (AES encrypted) ----
window.saveAndShare = function () {
    const amount = document.getElementById("investAmount").value;
    const freq = document.getElementById("frequency").value;
    const start = document.getElementById("startDate").value;
    const end = document.getElementById("endDate") ? document.getElementById("endDate").value : "";

    const payload = amount + SHARE_DELIMITER + freq + SHARE_DELIMITER + start + SHARE_DELIMITER + end;
    let encrypted = "";
    if (typeof CryptoJS !== "undefined" && CryptoJS.AES) {
        encrypted = CryptoJS.AES.encrypt(payload, SHARE_KEY).toString();
    }

    const origin = window.location.origin;
    const pathname = window.location.pathname;
    const shareUrl = (origin && origin !== "null" ? origin + pathname : "https://bitcoindata.science/dca-calculator") + "#" + encrypted;

    const freqLabel = { "1": "Daily", "7": "Weekly", "15": "Biweekly", "30": "Monthly" }[freq] || freq + "d";
    const endText = end ? " to " + end : "";
    const bbcode = "[url=" + shareUrl + "]Bitcoin DCA Calculator ($" + amount + " " + freqLabel + ", " + start + endText + ")[/url]";

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
    if (!hash || typeof CryptoJS === "undefined" || !CryptoJS.AES) return false;
    try {
        const decrypted = CryptoJS.AES.decrypt(hash, SHARE_KEY);
        const plaintext = decrypted.toString(CryptoJS.enc.Utf8);
        if (!plaintext || plaintext.indexOf(SHARE_DELIMITER) === -1) return false;

        const parts = plaintext.split(SHARE_DELIMITER);
        if (parts.length >= 3) {
            applyLoadedParams(parts[0], parts[1], parts[2], parts[3] || "");
            return true;
        }
    } catch (e) { }
    return false;
}

function tryLoadPlainParams(hash) {
    if (!hash) return false;
    try {
        const params = new URLSearchParams(hash);
        const amount = params.get("amount") || params.get("investAmount");
        const freq = params.get("freq") || params.get("frequency");
        const start = params.get("start") || params.get("startDate");
        const end = params.get("end") || params.get("endDate");

        if (amount || freq || start || end) {
            applyLoadedParams(amount, freq, start, end);
            return true;
        }
    } catch (e) { }
    return false;
}

function applyLoadedParams(amount, freq, start, end) {
    if (amount) {
        const aInput = document.getElementById("investAmount");
        const aRange = document.getElementById("investAmountRange");
        if (aInput) aInput.value = amount;
        if (aRange) aRange.value = amount;
    }
    if (freq) {
        const fSelect = document.getElementById("frequency");
        if (fSelect) fSelect.value = freq;
    }
    if (start) {
        const sInput = document.getElementById("startDate");
        if (sInput) sInput.value = start;
    }
    if (end) {
        const eInput = document.getElementById("endDate");
        if (eInput) eInput.value = end;
    }
}

// ---- CSV Export ----
window.exportDCAToCSV = function () {
    if (!simResults.length) return;

    const header = "Date,BTC Price (USD),BTC Purchased,Cumulative BTC,Cumulative Invested (USD),Portfolio Value (USD)\n";
    const rows = simResults.map(r =>
        r.date + "," + r.price.toFixed(2) + "," + r.btcBought.toFixed(8) + "," +
        r.cumulativeBTC.toFixed(8) + "," + r.cumulativeInvested.toFixed(2) + "," +
        r.portfolioValue.toFixed(2)
    ).join("\n");

    const todayStr = new Date().toISOString().split("T")[0];
    const endVal = document.getElementById("endDate")?.value || todayStr;
    const blob = new Blob([header + rows], { type: "text/csv;charset=utf-8;" });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = "bitcoin-dca-" + document.getElementById("startDate").value + "-to-" + endVal + ".csv";
    link.click();
};

// ---- Theme Updater (called from PHP MutationObserver) ----
window.updateChartThemes = function (theme) {
    const mode = theme === "dark" ? "dark" : "light";
    if (dcaMainChart) dcaMainChart.updateOptions({ theme: { mode: mode } });
};

// ---- Input Sync ----
function setupSyncInputs(inputId, rangeId) {
    const input = document.getElementById(inputId);
    const range = document.getElementById(rangeId);
    if (input && range) {
        input.addEventListener("input", () => { range.value = input.value; simulateDCA(); });
        range.addEventListener("input", () => { input.value = range.value; simulateDCA(); });
    }
}

// ---- Default Date Helpers ----
function setDefaultDates() {
    const today = new Date();
    const threeYearsAgo = new Date();
    threeYearsAgo.setFullYear(threeYearsAgo.getFullYear() - 3);

    const startInput = document.getElementById("startDate");
    const endInput = document.getElementById("endDate");

    const minDate = "2010-07-22";
    const maxDate = today.toISOString().split("T")[0];
    const defaultStart = threeYearsAgo.toISOString().split("T")[0];

    if (startInput) {
        startInput.min = minDate;
        startInput.max = maxDate;
        if (!startInput.value) startInput.value = defaultStart;
    }

    if (endInput) {
        endInput.min = minDate;
        endInput.max = maxDate;
        if (!endInput.value) endInput.value = maxDate;
    }
}

// ---- Initialization ----
document.addEventListener("DOMContentLoaded", function () {
    // 1. Try loading shared state from URL
    const hash = window.location.hash ? window.location.hash.substring(1) : "";
    if (hash) {
        if (!tryLoadEncrypted(hash)) {
            tryLoadPlainParams(hash);
        }
    }

    // 2. Set default dates (won't overwrite URL-loaded values)
    setDefaultDates();

    // 3. Init charts
    initCharts();

    // 4. Sync input controls
    setupSyncInputs("investAmount", "investAmountRange");

    // 5. Attach change listeners to recalculate on input changes
    ["frequency", "startDate", "endDate"].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener("change", simulateDCA);
    });

    // 6. Fetch data and run first simulation
    fetchPriceData().then(([spotData, historyData]) => {
        spotPrice = spotData.price;
        priceHistory = historyData;
        // Push today's live price into the history
        priceHistory.push([Date.now(), spotPrice]);

        // Run simulation
        simulateDCA();
    });
});
