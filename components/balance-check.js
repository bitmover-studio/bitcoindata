"use strict";

//Get addresses from textarea
let textArea = document.getElementById('BalanceChecker');

if (window.localStorage["TextEditorData"]) {
  textArea.value = window.localStorage["TextEditorData"];
}
textArea.addEventListener("keyup", function () {
  window.localStorage["TextEditorData"] = textArea.value;
});
let addressesList = textArea.value.split("\n");

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

// Get Address Balance
let balance = [];
const outputArea = document.getElementById("balances")
async function getMultipleAddressBalance(price, balancearray) {
  var list = balancearray.join("|")
  console.log(list)
  try {
    const response = await fetch('https://blockchain.info/balance?active=' + balancearray);
    const data = await response.json();
    balance = Object.keys(data).map(address => {
      return {
        address: address,
        balance: data[address].final_balance / 100000000,
        value: parseFloat((data[address].final_balance / 100000000 * price).toFixed(2)),
        unconfirmed: 0,
        unconfirmed_value: 0
      };
    });
  }
  catch (error) {
    console.log('Try lass than 20 addresses: ' + error)
  }
}

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


// Declare a function that returns a promise that resolves after a given time
function delay(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

// Declare an async function that waits for a delay and then calls another async function
async function getBalances(price) {
  balance = [];
  modalText = {}
  if (addressesList.length <= 20) {
    for (const i of addressesList) {
      // Use await with the delay function
      await delay(500);
      // Call the async function
      await getAddressBalance(i, price, balance);
    }
  } else {
    await getMultipleAddressBalance(price, addressesList)
  }
  document.getElementById("submit").innerHTML = 'Get Balance!'
  document.getElementById("submit").disabled = false;

  outputArea.innerHTML = `
<div class="bg-body-tertiary rounded-4 p-md-5 p-4 mt-5 shadow-sm">
  <div class="row p-3 mb-3 fw-semibold">
    <div class="col-md-6 text-primary-emphasis">Total number of addresses: ${balance.length}</div>
    <div class="col-md-3 text-start text-md-end pe-0">${balance.reduce((a, e) => a + e.balance, 0).toLocaleString(undefined, { minimumFractionDigits: 8, maximumFractionDigits: 8 })} BTC</div>
    <div class="col-md-3 text-start text-md-end pe-0">${balance.reduce((a, e) => a + e.value, 0).toLocaleString("en-US", { style: "currency", currency: "USD" })}</div>
  </div>

  <div class="row align-items-center mb-3">
    <div class="col-md-6">
      <span class="p-3 h4 fw-bold">Detailed Results</span>
    </div>
    <div class="col-md-3">
      <div class="form-check float-end fw-semibold">
        <input class="form-check-input" type="checkbox" value="" id="hideZero" onclick="toggleFilter()">
        <label class="form-check-label" class="text-end" for="hideZero">Hide zero balance</label>
      </div>
    </div>
    <div class="col-md-3 text-end">
        <button type="button" id='json' class="btn btn-primary" title="Download JSON file" onclick="download(JSON.stringify({addresses:balance}, null, 4), 'addresses'+new Date().toISOString().slice(0, 10)+'.json', 'text/plain')">
            <span class="small"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 1280" width="16" height="16"><path d="M463.6 94c-.3 1.7-.6 110-.6 240.5l-.2 237.6c-.2.2-38.2.5-84.4.8l-84 .5 163.2 216 164.3 216c1 0 327.2-430.8 327.2-432 0-.2-37.5-.4-83.3-.4-63.5 0-83.6-.3-84.5-1.2s-1.2-55.8-1.2-241V91H622 464.3l-.7 3zm-248 937.7c-.4.3-.7 28-.7 61.5v60.8h430 430v-61l-1.6-61.5c-2.2-.8-857-.8-857.7.1z"></path></svg> .json</span>
        </button>
        <button type="button" class="btn btn-secondary" title="Download CSV file" onclick="download(jsonToCsv(balance), 'addresses'+new Date().toISOString().slice(0, 10)+'.csv', 'text/csv')">
            <span class="small"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 1280" width="16" height="16"><path d="M463.6 94c-.3 1.7-.6 110-.6 240.5l-.2 237.6c-.2.2-38.2.5-84.4.8l-84 .5 163.2 216 164.3 216c1 0 327.2-430.8 327.2-432 0-.2-37.5-.4-83.3-.4-63.5 0-83.6-.3-84.5-1.2s-1.2-55.8-1.2-241V91H622 464.3l-.7 3zm-248 937.7c-.4.3-.7 28-.7 61.5v60.8h430 430v-61l-1.6-61.5c-2.2-.8-857-.8-857.7.1z"></path></svg> .csv</span>
        </button>
    </div>
  </div>

  ${balance.map(i => `
    <div class="p-3 my-3 fw-semibold border-0 rounded" id=${i.address}>
      <div class="row">
        <div class="col-md-6"><code><a target="_blank" rel="noreferrer" title="${i.address}" href="https://mempool.space/address/${i.address}">${i.address}</a></code></div>
        <div class="col-md-3 text-start text-md-end pe-0">${i.balance.toLocaleString(undefined, { minimumFractionDigits: 8, maximumFractionDigits: 8 })} BTC</div>
        <div class="col-md-3 text-start text-md-end pe-0">${i.value.toLocaleString('en-US', { style: 'currency', currency: 'USD' })}</div>
      </div>
      ${i.unconfirmed !== 0 ? `
        <div class="row text-warning-emphasis">
          <div class="col-md-6"><code>unconfirmed</code></div>
          <div class="col-md-3 text-start text-md-end pe-0">${i.unconfirmed.toLocaleString(undefined, { minimumFractionDigits: 8, maximumFractionDigits: 8 })} BTC</div>
          <div class="col-md-3 text-start text-md-end pe-0">${i.unconfirmed_value.toLocaleString('en-US', { style: 'currency', currency: 'USD' })}</div>
        </div>` : ''}
    </div>
  `).join('')}

</div>`
  }


function download(content, fileName, contentType) {
  const a = document.createElement("a");
  const file = new Blob([content], { type: contentType });
  a.href = URL.createObjectURL(file);
  a.download = fileName;
  a.click();
}

function jsonToCsv(jsonarray) {
  const headers = Object.keys(jsonarray[0]).join(',');
  let csvrecord = 'sep=,\r\n' + headers + '\r\n';
  jsonarray.forEach(function (jsonrecord) {
    const values = Object.values(jsonrecord).join(',');
    csvrecord += values + '\r\n';
  });
  return csvrecord;
}

function handleClick() {
  clearInterval(timerCompareBalance);
  document.getElementById("submit").innerHTML = '<span class="spinner-border spinner-border-sm me-3" role="status" aria-hidden="true"></span>Loading...'
  document.getElementById("submit").disabled = true;
  balance = [];
  addressesList = [];
  textArea = document.getElementById('BalanceChecker');
  addressesList = textArea.value.split("\n");
  addressesList = addressesList.filter(n => n);
  getBtcPrice().then(price => getBalances(price))

  var timerCompareBalance = setInterval(() => {
    getBtcPrice().then(price => compareBalance(price));
  }, 300000)
}

// Update Address Balance
let newBalance = [];
let modalText = {};
const modal = new bootstrap.Modal(document.getElementById("modal"), {});

async function compareBalance(price) {
  newBalance = [];
  for (const i of addressesList) {
    await delay(500);
    await getAddressBalance(i, price, newBalance)
  };
  for (let i in balance) {
    if (balance[i].balance !== newBalance[i].balance) {
      modalText = {
        address: newBalance[i].address,
        balance: newBalance[i].balance,
        value: newBalance[i].value,
        color: "",
        title: "New transaction",
        body: "confirmed"
      };
    }
    else if (balance[i].unconfirmed !== newBalance[i].unconfirmed) {
      modalText = {
        address: newBalance[i].address,
        balance: newBalance[i].unconfirmed,
        value: newBalance[i].unconfirmed_value,
        color: "text-warning-emphasis",
        title: "Incoming transaction",
        body: "unconfirmed"
      };
    }
  }

  if (Object.keys(modalText).length > 0 && newBalance.length === balance.length) {
    document.querySelector('.modal-title').innerHTML = modalText.title;
    document.querySelector('.modal-address').innerHTML = modalText.address;
    document.querySelector('.modal-balance').innerHTML = modalText.balance;
    document.querySelector('.modal-value').innerHTML = modalText.value.toLocaleString("en-US", { style: "currency", currency: "USD" });
    document.title = '(1) Bitcoin Balance Checker - bitcoin data.science';
    modal.show()
  }

  // create a notification
  let permission = await Notification.requestPermission();
  if (permission === 'granted' && Object.keys(modalText).length > 0 && newBalance.length === balance.length) {
    const notification = new Notification(modalText.title, {
      body: modalText.address + " " + modalText.balance + " " + modalText.body,
      icon: './img/bitcoin-data-science-logo-web.svg'
    });
  }
  modalText = {};
};

// Hide zero balance
function toggleFilter() {
  const isChecked = document.getElementById("hideZero").checked

  const filteredList = balance.filter(obj => obj.value === 0 && obj.unconfirmed === 0);
  var filteredAddresses = filteredList.map(obj => obj.address)

  if (isChecked) {
    filteredAddresses.forEach(id => {
      const element = document.getElementById(id);
      if (element) {
        element.hidden = true;
      }
    });
  } else {
    filteredAddresses.forEach(id => {
      const element = document.getElementById(id);
      if (element) {
        element.hidden = false;
      }
    });
  }
}