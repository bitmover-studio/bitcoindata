"use strict";

var usdPrice = 0;
var rates = {};
var symbols = [];
var fselect = document.getElementById("selEbank").options[selEbank.selectedIndex].text;
var inputUSD = document.getElementById("inputUSD");
var select = document.getElementById('selEbank');

function unitConverter(source, valNum) {
	valNum = parseFloat(valNum);
	fselect = document.getElementById("selEbank").options[selEbank.selectedIndex].text;
	var inputBTC = document.getElementById("inputBTC");
	var inputcBTC = document.getElementById("inputcBTC");
	var inputmBTC = document.getElementById("inputmBTC");
	var inputuBTC = document.getElementById("inputuBTC");
	var inputFinney = document.getElementById("inputFinney");
	var inputsat = document.getElementById("inputsat");
	var inputmsat = document.getElementById("inputmsat");
	var inputUSD = document.getElementById("inputUSD");
	var inputEbank = document.getElementById("inputEbank");

	if (source == "inputBTC") {
		inputcBTC.value = parseFloat(valNum * 100);
		inputmBTC.value = parseFloat(valNum * 1000);
		inputuBTC.value = parseFloat(valNum * 1000000);
		inputFinney.value = parseFloat(valNum * 10000000);
		inputsat.value = parseFloat(valNum * 100000000);
		inputmsat.value = parseFloat(valNum * 100000000000).toFixed(0);
		inputUSD.value = parseFloat(valNum * usdPrice).toFixed(2);
		inputEbank.value = parseFloat(valNum * usdPrice * rates[fselect]).toFixed(2);
	}
	if (source == "inputcBTC") {
		inputBTC.value = parseFloat(valNum / 100).toFixed(8).replace(/(\.\d+?)0+\b/gm, "$1");
		inputmBTC.value = parseFloat(valNum * 10);
		inputuBTC.value = parseFloat(valNum * 10000);
		inputFinney.value = parseFloat(valNum * 100000);
		inputsat.value = parseFloat(valNum * 1000000);
		inputmsat.value = parseFloat(valNum * 1000000000).toFixed(0);
		inputUSD.value = parseFloat((valNum * usdPrice / 100).toFixed(2));
		inputEbank.value = parseFloat(valNum * usdPrice * rates[fselect] / 100).toFixed(2);
	}
	if (source == "inputmBTC") {
		inputBTC.value = parseFloat(valNum / 1000);
		inputcBTC.value = parseFloat(valNum / 10);
		inputuBTC.value = parseFloat(valNum * 1000);
		inputFinney.value = parseFloat(valNum * 10000);
		inputsat.value = parseFloat(valNum * 100000);
		inputmsat.value = parseFloat(valNum * 10000000).toFixed(0);
		inputUSD.value = parseFloat((valNum * usdPrice / 1000).toFixed(2));
		inputEbank.value = parseFloat(valNum * usdPrice * rates[fselect] / 1000).toFixed(2);
	}
	if (source == "inputuBTC") {
		inputBTC.value = parseFloat(valNum / 1000000);
		inputcBTC.value = parseFloat(valNum / 10000);
		inputmBTC.value = parseFloat(valNum / 1000);
		inputFinney.value = parseFloat(valNum * 10);
		inputsat.value = parseFloat(valNum * 100);
		inputmsat.value = parseFloat(valNum * 100000).toFixed(0);
		inputUSD.value = parseFloat((valNum * usdPrice / 1000000).toFixed(2));
		inputEbank.value = parseFloat(valNum * usdPrice * rates[fselect] / 1000000).toFixed(2);
	}
	if (source == "inputFinney") {
		inputBTC.value = parseFloat(valNum / 10000000).toFixed(8).replace(/(\.\d+?)0+\b/gm, "$1");
		inputcBTC.value = parseFloat(valNum / 100000);
		inputmBTC.value = parseFloat(valNum / 10000);
		inputuBTC.value = parseFloat(valNum / 10);
		inputsat.value = parseFloat(valNum * 10);
		inputmsat.value = parseFloat(valNum * 10000).toFixed(0);
		inputUSD.value = parseFloat((valNum * usdPrice / 10000000).toFixed(3));
		inputEbank.value = parseFloat(valNum * usdPrice * rates[fselect] / 10000000).toFixed(3);
	}
	if (source == "inputsat") {
		inputBTC.value = parseFloat(valNum / 100000000).toFixed(8).replace(/(\.\d+?)0+\b/gm, "$1");
		inputcBTC.value = parseFloat(valNum / 1000000);
		inputmBTC.value = parseFloat(valNum / 100000);
		inputuBTC.value = parseFloat(valNum / 100);
		inputFinney.value = parseFloat(valNum / 10);
		inputmsat.value = parseFloat(valNum * 1000).toFixed(0);
		inputUSD.value = parseFloat((valNum * usdPrice / 100000000).toFixed(4));
		inputEbank.value = parseFloat(valNum * usdPrice * rates[fselect] / 100000000).toFixed(4);

	}
	if (source == "inputmsat") {
		inputBTC.value = parseFloat(valNum / 100000000000).toFixed(9).replace(/(\.\d+?)0+\b/gm, "$1");
		inputcBTC.value = parseFloat(valNum / 1000000000).toFixed(7).replace(/(\.\d+?)0+\b/gm, "$1");
		inputmBTC.value = parseFloat(valNum / 100000000);
		inputuBTC.value = parseFloat(valNum / 100000);
		inputFinney.value = parseFloat(valNum / 10000);
		inputsat.value = parseFloat(valNum / 1000);
		inputUSD.value = parseFloat((valNum * usdPrice / 1000000000).toFixed(5));
		inputEbank.value = parseFloat(valNum * usdPrice * rates[fselect] / 1000000000).toFixed(5);
	}
	if (source == "inputUSD") {
		inputBTC.value = parseFloat(valNum / usdPrice).toFixed(6);
		inputcBTC.value = parseFloat(valNum / usdPrice * 100).toFixed(6);
		inputmBTC.value = parseFloat(valNum / usdPrice * 1000).toFixed(5);
		inputuBTC.value = parseFloat(valNum / usdPrice * 1000000).toFixed(2);
		inputFinney.value = parseFloat(valNum / usdPrice * 10000000).toFixed(1);
		inputsat.value = parseFloat(valNum / usdPrice * 100000000).toFixed(0);
		inputmsat.value = parseFloat(valNum / usdPrice * 100000000000).toFixed(0);
		inputEbank.value = parseFloat(valNum * rates[fselect]).toFixed(2);
	}

	if (source == "inputEbank") {
		inputBTC.value = parseFloat(valNum / usdPrice / rates[fselect]).toFixed(8);
		inputcBTC.value = parseFloat(valNum / usdPrice / rates[fselect] * 100).toFixed(6);
		inputmBTC.value = parseFloat(valNum / usdPrice / rates[fselect] * 1000).toFixed(5);
		inputuBTC.value = parseFloat(valNum / usdPrice / rates[fselect] * 1000000).toFixed(2);
		inputFinney.value = parseFloat(valNum / usdPrice / rates[fselect] * 10000000).toFixed(1);
		inputsat.value = parseFloat(valNum / usdPrice / rates[fselect] * 100000000).toFixed(0);
		inputmsat.value = parseFloat(valNum / usdPrice / rates[fselect] * 100000000000).toFixed(0);
		inputUSD.value = parseFloat(valNum / rates[fselect]).toFixed(3);
	}
	document.getElementById('fcurrency').innerHTML = "<img alt="+document.getElementById("selEbank").options[selEbank.selectedIndex].text.slice(0, -1).toLowerCase()+" class='mr-2 ml-1' src='https://flagcdn.com/h20/" + document.getElementById("selEbank").options[selEbank.selectedIndex].text.slice(0, -1).toLowerCase() + ".png' width='26' height='20'>" + "<strong class='m-2 text-primary-emphasis'>" + document.getElementById("selEbank").options[selEbank.selectedIndex].text + "</strong>";
}

async function getBtcPrice() {
	try {
		try {
			const response = await fetch('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd');
			const data = await response.json();
			usdPrice = data.bitcoin.usd;
			document.title = usdPrice.toLocaleString('en-US', { style: 'currency', currency: 'USD', currencyDisplay: 'code' }) + " - Bitcoin Units Converter";
			unitConverter(inputBTC.id, inputBTC.value);
			return usdPrice
		}
		catch (error) {
			console.warn('Coingecko API failed - ' + error)
			const response = await fetch("https://api.binance.com/api/v3/ticker/24hr?symbol=BTCUSDT");
			const data = await response.json();
			document.title = usdPrice.toLocaleString('en-US', { style: 'currency', currency: 'USD', currencyDisplay: 'code' }) + " - Bitcoin Units Converter";
			usdPrice = data.lastPrice;
			unitConverter(inputBTC.id, inputBTC.value);
			return usdPrice;
		}
	}
	catch (error) {
		console.warn(error)
	}
};

if (window.location.search) { document.getElementById('selEbank').value = window.location.search.substring(3).toUpperCase(); }
else { document.getElementById('selEbank').value = "EUR" }

async function getRates() {
	try {
		const response = await fetch('https://bitcoindata.science/api/rates.json');
		let rawrates = await response.json();
		for (var key in rawrates) {
			rates[key.slice(3)] = rawrates[key];
		}
		delete rates.BTC

		// Feeding data to accordion //
		let nFiat = document.getElementById("nfiat");
		let listSymbols = document.getElementById("listSymbols");
		nFiat.innerText = Object.keys(rates).length;
		listSymbols.innerHTML = Object.keys(rates).join(", ");
		symbols =  Object.keys(rates);

		// Feeding data to select //
		let selectOptions = document.getElementById("selEbank");
		selectOptions.innerHTML = `
			<option disabled>Choose one..</option>
			${symbols.map(i => `
			<option>${i}</option>`).join('')}
	 	`
		if (window.location.search) { document.getElementById('selEbank').value = window.location.search.substring(3).toUpperCase(); }
		else { document.getElementById('selEbank').value = "EUR" }
		
		unitConverter(inputBTC.id, inputBTC.value);
		return rates;
	}
	catch (error) {
		console.warn(error)
	};
}

function handleClick(event) {
	let fselect = document.getElementById("selEbank").options[selEbank.selectedIndex].text;
	if (select.selectedIndex > 0) {
		fselect = document.getElementById("selEbank").options[selEbank.selectedIndex].text;
	}
	document.getElementById('inputEbank').value = (parseFloat(document.getElementById("inputUSD").value) * parseFloat(rates[fselect])).toFixed(2);
}
select.addEventListener('click', handleClick);


getBtcPrice();
getRates()
handleClick();
setInterval(async () => {
	try {
		await getBtcPrice();
	} catch (error) {
		console.error(error);
	}
}, 30000);

document.title = usdPrice.toLocaleString('en-US', { style: 'currency', currency: 'USD', currencyDisplay: 'code' }) + " - Bitcoin Units Converter"

// Tooltips
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))