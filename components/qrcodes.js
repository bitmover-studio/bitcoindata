"use strict";

let scannedCodes = [];

// Get Bitcoin Price
async function getBtcPrice() {
   try {
      try {
         const response = await fetch('https://bitcoindata.science/api/priceusd.json');
         const data = await response.json();
         let btcPrice = data.price;
         return btcPrice
      }
      catch (error) {
         console.warn('bitcoindata API failed - ' + error)
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


async function getAddressBalance(address, price, balancearray) {
   try {
      try {
         const response = await fetch('https://mempool.space/api/address/' + address);
         const data = await response.json();
         balancearray.push({
            address: address,
            balance: (data.chain_stats.funded_txo_sum - data.chain_stats.spent_txo_sum) / 100000000,
            value: parseFloat(((data.chain_stats.funded_txo_sum - data.chain_stats.spent_txo_sum) / 100000000 * price).toFixed(2)),
            unconfirmed: (data.mempool_stats.funded_txo_sum - data.mempool_stats.spent_txo_sum) / 100000000,
            unconfirmed_value: parseFloat(((data.mempool_stats.funded_txo_sum - data.mempool_stats.spent_txo_sum) / 100000000 * price).toFixed(2)),
         })
      }
      catch (error) {
         console.warn('Mempool API failed - ' + error)
         const response = await fetch('https://api.blockcypher.com/v1/btc/main/addrs/' + address + '/balance');
         const data = await response.json();
         balancearray.push({
            address: address,
            balance: data.balance / 100000000,
            value: parseFloat((data.balance / 100000000 * price).toFixed(2)),
            unconfirmed: data.unconfirmed_balance,
            unconfirmed_value: parseFloat((data.unconfirmed_balance * price).toFixed(2)),
         }
         )
      }
   }
   catch (error) {
      console.warn(error)
   }
};

async function plotBalance(address) {
   try {
      const price = await getBtcPrice();
      const balances = await getAddressBalance(address, price, scannedCodes);

      document.getElementById('balances').innerHTML = `
         <div>
            ${scannedCodes.map(i => `
            <div class="bg-body-tertiary rounded border p-3 my-3 row">
               <div class="row">
               <div class="col-md-6"><code><a target="_blank" rel="noreferrer" title="${i.address}" href="https://mempool.space/address/${i.address}">${i.address}</a></code></div>
               <div class="w-100 d-none d-xs-block"></div>
               <div class="col col-md-3 pe-0">${i.balance.toLocaleString(undefined, { minimumFractionDigits: 8, maximumFractionDigits: 8 })} BTC</div>
               <div class="col col-md-3 pe-0">${i.value.toLocaleString('en-US', { style: 'currency', currency: 'USD' })}</div>
            </div>
            ${i.unconfirmed !== 0 ? `
            <div class="row">
               <div class="col-md-6"><code class="text-warning-emphasis">unconfirmed</code></div>
               <div class="w-100 d-none d-xs-block"></div>
               <div class="col col-md-3 pe-0 text-warning-emphasis">${i.unconfirmed.toLocaleString(undefined, { minimumFractionDigits: 8, maximumFractionDigits: 8 })} BTC</div>
               <div class="col col-md-3 pe-0 text-warning-emphasis">${i.unconfirmed_value.toLocaleString('en-US', { style: 'currency', currency: 'USD' })}</div>
            </div>` : ''}
         </div>
         `).join('')}`;
         readerModal.hide()
   } catch (error) {
      console.error('Error fetching data:', error);
   }
}

const html5QrCodeScanner = new Html5Qrcode(
   "reader", { formatsToSupport: [Html5QrcodeSupportedFormats.QR_CODE] }
);

const startScanning = () => {
   html5QrCodeScanner.start({ facingMode: "environment" }, config, qrCodeSuccessCallback);
};

const stopScanning = () => {
   html5QrCodeScanner.stop();
};

const qrCodeSuccessCallback = (decodedText, decodedResult) => {
   plotBalance(decodedResult.decodedText.replace('bitcoin:', ''));
   document.getElementById('BalanceChecker').value += '\r\n'+ decodedResult.decodedText.replace('bitcoin:', '');
   // Stop the entire scanner instance (including camera feed).
   stopScanning()
};
const config = { fps: 10, qrbox: { width: 250, height: 250 } };

document.getElementById('startButton').addEventListener('click', startScanning);
document.getElementById('stopButton').addEventListener('click', stopScanning);

// Modal
const readerModal = new bootstrap.Modal(document.getElementById("readerModal"), {});