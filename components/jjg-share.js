"use strict";

function save_share() {
    let btcStashSize = document.getElementById("stash").value;
    let annualWithdrawalRate = document.getElementById("wrate").value;
    let inputDate = document.getElementById("date").value;
    let checkedDate = document.getElementById("useDate").checked;
    let simulationDate = document.getElementById("simulationDate").value;
    let checkedPrice = document.getElementById("togglePrice").checked;
    let encrypted = CryptoJS.AES.encrypt(btcStashSize + '&' + annualWithdrawalRate + '&' + inputDate + '&' + checkedDate + '&' + simulationDate + '&' + checkedPrice, "bitcoin");
    document.getElementById("shareURL").innerText = 'https://bitcoindata.science/withdrawal-strategy?' + encrypted;
}

// Load saved data from shareable URL
if (window.location.search) {
    let decrypted = CryptoJS.AES.decrypt(window.location.search.substring(1), "bitcoin");
    let saved_data = decrypted.toString(CryptoJS.enc.Utf8);
    let saved_data_array = saved_data.split("&");

    document.getElementById("stash").value = saved_data_array[0];
    document.getElementById("wrate").value = saved_data_array[1];
    document.getElementById("date").value = saved_data_array[2];
    document.getElementById("useDate").checked = saved_data_array[3] === 'true'; 
    document.getElementById("simulationDate").value = saved_data_array[4];
    document.getElementById("togglePrice").checked = saved_data_array[5] === 'true'; 

// Load data from past local sessions
} else if (window.localStorage["annualWithdrawalRate"] && window.localStorage["btcStashSize"]) {
    document.getElementById("wrate").value = window.localStorage["annualWithdrawalRate"];
    document.getElementById("stash").value = window.localStorage["btcStashSize"];
    document.getElementById("togglePrice").checked = window.localStorage.getItem("togglePrice") === 'true'; 
}

function copyurl(target) {
    navigator.clipboard.writeText(document.getElementById(target).innerText);
}

// Save to local storage
function saveToLocalStorage() {
    window.localStorage['annualWithdrawalRate'] = document.getElementById("wrate").value;
    window.localStorage['btcStashSize'] = document.getElementById("stash").value;
    window.localStorage.setItem("togglePrice", document.getElementById("togglePrice").checked);
}

function restoreDefaults() {
    document.getElementById("wrate").value = 6;
    document.getElementById("stash").value = 1;
    document.getElementById("togglePrice").checked = false;
    calculateWithdrawalLimit();
}

// Toasts
const toastTrigger = document.getElementById('saveInputs');
const saveInputsToast = document.getElementById('saveInputsToast');
if (toastTrigger) {
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(saveInputsToast);
    toastTrigger.addEventListener('click', () => {
        toastBootstrap.show();
    });
}

const toastTriggerShare = document.getElementById('shareInputs');
const shareInputsToast = document.getElementById('shareInputsToast');
if (toastTriggerShare) {
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(shareInputsToast);
    toastTriggerShare.addEventListener('click', () => {
        toastBootstrap.show();
    });
}
