"use strict";

// select address format
const addressDescription = document.querySelector('#address-description');
const addressFormat = document.getElementById('address-format');
const radioButtons = document.querySelectorAll('input[name="btnradio"]');

const descriptions = {
    'btnradio1': {format:'p2pkh', description:'Pay-to-Public-Key-Hash (P2PKH) is the Legacy format. Addresses starting with 1.'},
    'btnradio2': {format:'p2sh', description:'Pay-to-Script-Hash (P2SH) is the Compatible Segwit format. Addresses starting with 3.'},
    'btnradio3': {format:'bech32', description:'Bech32 is the native Segwit format, the most efficient. Addresses starting with bc1q.'}
};

window.addEventListener('load', () => {
    const defaultChecked = document.querySelector('input[name="btnradio"]:checked');
    if (defaultChecked) {
        const selectedId = defaultChecked.id;
        addressFormat.textContent = descriptions[selectedId].format;
        addressDescription.textContent = descriptions[selectedId].description;
    }
});

radioButtons.forEach(radio => {
    radio.addEventListener('change', event => {
        const selectedId = event.target.id;
        addressFormat.textContent = descriptions[selectedId].format;
        addressDescription.textContent = descriptions[selectedId].description;
    });
});

// Get Bitcoin Price
async function getBtcPrice() {
    try {
        try {
            const response = await fetch('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd,brl');
            const data = await response.json();
            let btcPrice = data.bitcoin.usd;
            return btcPrice
        }
        catch (error) {
            console.warn('Coingecko API failed - ' + error)
            const response = await fetch("https://api.coindesk.com/v1/bpi/currentprice/BRL.json");
            const data = await response.json();
            let btcPrice = data.bpi.USD.rate_float;
            return btcPrice;
        }
    }
    catch (error) {
        console.warn(error)
    }
};

var priceusd = getBtcPrice()


// calculate transaction size

calculate = function () {
    var satpbyte = document.getElementById('satpbyte').value;
    var inputs = document.getElementById('ninputs').value;
    var outputs = document.getElementById('noutputs').value;

    var bytes = (parseInt(inputs) * 148 + parseInt(outputs) * 34 + 10);
    var pricebtc = parseFloat(satpbyte * bytes / 100000000).toFixed(8)
    document.getElementById('fees').innerHTML = (bytes + " bytes");
    document.getElementById("pricebtc").innerHTML = pricebtc + " btc";

    var sbytes = parseInt(((42 + parseInt(inputs) * 272 + parseInt(outputs) * 128) / 4));

    var spricebtc = parseFloat(satpbyte * sbytes / 100000000).toFixed(8)
    document.getElementById('sfees').innerHTML = (bytes + " bytes" + " / " + sbytes + " vbytes");
    document.getElementById("spricebtc").innerHTML = spricebtc + " btc";

    var pbase = parseInt(inputs) * 64 + parseInt(outputs) * 32 + 10
    var ptotal = pbase + 2 + 107 * parseInt(inputs)
    var pvsize = parseInt((pbase * 3 + ptotal) / 4)
    
    var ppricebtc = parseFloat(satpbyte * pvsize / 100000000).toFixed(8)
    document.getElementById('3fees').innerHTML = (ptotal + " bytes" + " / " + pvsize + " vbytes");
    document.getElementById("3pricebtc").innerHTML = ppricebtc + " btc";

    document.getElementById("1reduction").innerHTML = parseInt((1 - (sbytes / bytes)) * 100) + "%";
    document.getElementById("1reduction2").innerHTML = parseInt((1 - (sbytes / bytes)) * 100) + "%";
    document.getElementById("3reduction").innerHTML = parseInt((1 - (pvsize / bytes)) * 100) + "%";

    if (!isNaN(priceusd)) {
        document.getElementById("priceusd").innerHTML = "&#36; " + parseFloat(priceusd * pricebtc).toFixed(2);
        document.getElementById("spriceusd").innerHTML = "&#36; " + parseFloat(priceusd * spricebtc).toFixed(2);
        document.getElementById("3priceusd").innerHTML = "&#36; " + parseFloat(priceusd * ppricebtc).toFixed(2);
    } else {
        document.getElementById("priceusd").innerHTML = "<span class='spinner-border spinner-border-sm pl-2' role='status' aria-hidden='true'></span> loading..";
        document.getElementById("spriceusd").innerHTML = "<span class='spinner-border spinner-border-sm pl-2' role='status' aria-hidden='true'></span> loading..";
        document.getElementById("3priceusd").innerHTML = "<span class='spinner-border spinner-border-sm pl-2' role='status' aria-hidden='true'></span> loading..";
    }
}
window.onload = calculate();