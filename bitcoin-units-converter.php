<!doctype html>
<html lang="en">

<head>
   <?php 
   $title = "Bitcoin Units Converter - bitcoin data.science";
   $description = "Easily convert Bitcoin units — BTC, mBTC, μBTC, satoshi, and finney — to USD, EUR, RUB, BRL, TRY and other 168 fiat currencies with our fast and accurate Bitcoin Units Converter. Perfect for traders & crypto enthusiasts.";
   $keywords = "Bitcoin,Units,Converter,BTC,mBTC,satoshi,EUR,USD,RUB,TRY,BRL,finney,μBTC,uBTC,cBTC";
   $canonical = "https://bitcoindata.science/bitcoin-unit-converter";
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
   ?>
   <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Bitcoin Units Converter",
        "description": "Convert bitcoin units BTC,mBTC, uBTC, satoshi, finney to USD, EUR and 170 other fiat currencies.",
        "alternateName": [
          "bitcoindata.science",
          "Bitcoin Data Science",
          "bitcoin datascience"
        ],
        "url": "https://bitcoindata.science",
        "logo": "https://bitcoindata.science/img/logo.svg",
        "sameAs": [
          "https://bitcoindata.science"
        ]
      }
   </script>
   <script src="components/unit-converter.js" type="text/javascript" defer></script>

</head>


<body>
   <!-- Navbar -->
   <header>
      <navbar-component></navbar-component>
   </header>
   <!-- Page Content -->
   <?php
   $h1 = 'Bitcoin Units Converter';
   $h2 = 'Convert between different Bitcoin units and fiat currencies.';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>

      <h3 class="lead">Use any of the fields below to convert bitcoin units BTC,mBTC, uBTC, satoshi, finney to
         USD, EUR or any other fiat currency.<br></h2>

      <div class="accordion my-3 shadow-sm rounded-top-4 " id="accordion">
         <div class="accordion-item border-0 shadow-sm">
            <h3 class="accordion-header" id="howMany">
               <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                  How many fiat currencies are supported?
               </button>
            </h3>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="howMany">
               <div class="accordion-body">
                  This service supports <em><strong id="nfiat" class="text-primary-emphasis"> </strong></em> fiat
                  currencies, and their prices are
                  updated
                  in real-time.
               </div>
            </div>
         </div>
         <div class="accordion-item rounded-bottom-4 border-0 border-top shadow-sm">
            <h3 class="accordion-header" id="whichCurrencies">
               <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Which currencies are supported?
               </button>
            </h3>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="whichCurrencies">
               <div class="accordion-body small" id="listSymbols">
               </div>
            </div>
         </div>
      </div>
      </div>

      <div class="bg-body-tertiary rounded-4 p-4 shadow-sm">
         <div class="row">
            <div id="unit-container" class="col-md-6"></div>
            <script>
               const unitList = [
                  { id: 'inputBTC', label: 'bitcoin', title: 'BTC', value: 1 },
                  { id: 'inputcBTC', label: 'bitcent', title: 'cBTC' },
                  { id: 'inputmBTC', label: 'millibit', title: 'mBTC' },
                  { id: 'inputuBTC', label: 'bit', title: 'μBTC' },
                  { id: 'inputFinney', label: 'finney', title: 'finney' },
                  { id: 'inputsat', label: `satoshi`, title: 'sat' },
                  { id: 'inputmsat', label: `millisatoshi (<a class="conversor small" href="https://en.bitcoin.it/wiki/Lightning_Network" data-bs-toggle="tooltip" data-bs-title="Available only in the Lightning Network">Lightning Network</a>)`, title: 'msat' }
               ];

               const container = document.getElementById('unit-container');
               unitList.forEach(unit => {
                  // Cria o HTML para a unidade atual.
                  // Usamos `innerHTML` na label para renderizar os links corretamente.

                  const unitHTML = `
                        <div class="input-group mb-3">
                           <div class="form-floating ">
                              <input type="number" class="form-control font-monospace border-0 bg-body-secondary rounded-start-4"
                                 id="${unit.id}" 
                                 min="0" 
                                 oninput="unitConverter(this.id, this.value)" 
                                 onchange="unitConverter(this.id, this.value)" 
                                 title="${unit.title}" 
                                 ${unit.value ? `value="${unit.value}"` : ''}>
                              <label for="${unit.id}" class="font-monospace">${unit.label}</label>
                           </div>
                           <span style="width: 18% !important;" class="text-end input-group-text font-monospace rounded-end-4 bg-body-secondary ms-1 border-0">${unit.title}</span>
                        </div>
                     `;
                  container.innerHTML += unitHTML;
               });

            </script>

            <div class="col-md-6">

               <div class="input-group mb-3">
                  <span class="input-group-text font-monospace rounded-start-4 me-1 border-0 bg-body-secondary" style="width: 25% !important;">USD</span>
                  <div class="form-floating">
                     <input id="inputUSD" class="form-control font-monospace border-0 bg-body-secondary rounded-end-4"
                        type="number" min="0" title="United States Dollar" oninput="unitConverter(this.id,this.value)"
                        onchange="unitConverter(this.id,this.value)">
                     <label for="inputUSD" class="font-monospace">United States Dollar</label>
                  </div>
               </div>

               <div class="row g-1">
                  <div class="col-3">
                     <div class="form-floating font-monospace">
                        <select class="form-select rounded-start-4 rounded-end-0 border-0 bg-body-secondary"
                           id="selEbank"
                           onchange="inputEbank.value = parseFloat(inputUSD.value * rates[this.value]).toFixed(2); unitConverter(inputEbank.id, inputEbank.value);">
                           <option disabled>Choose one..</option>
                           <option>EUR</option>
                           <option>BRL</option>
                           <option>ARS</option>
                        </select>
                        <label for="selEbank">Fiat:</label>
                     </div>
                  </div>
                  <div class="col col-md">
                     <div class="form-floating font-monospace">
                        <input class="form-control rounded-start-0 border-0 bg-body-secondary rounded-end-4"
                           id="inputEbank" type="number" min="0" title="Select a Currency"
                           oninput="unitConverter(this.id,this.value)" onchange="unitConverter(this.id,this.value)"
                           aria-describedby="basic-addon9" step="any">
                        <label for="inputEbank"><span id="fcurrency">
                           </span><span class="small ml-2" id="fdefault"> </span></label>
                     </div>
                  </div>
               </div>

               <div class="mt-4" id="quickactions" role="group">
                  <p class="fw-semibold mb-1">Quick action buttons:</p>
                  <div id="1_btc" class="btn bg-primary btn-lg border-0 font-monospace mt-1"
                     onclick="inputBTC.value=1;unitConverter(inputBTC.id,inputBTC.value)">1 BTC</div>
                  <div id="1_mbtc" class="btn bg-primary btn-lg border-0 font-monospace mt-1"
                     onclick="inputmBTC.value=1;unitConverter(inputmBTC.id,inputmBTC.value)">1 mBTC</div>
                  <div id="1+_mbtc" class="btn bg-primary btn-lg border-0 font-monospace mt-1"
                     onclick="inputmBTC.stepUp(1);unitConverter(inputmBTC.id,inputmBTC.value)">+1 mBTC</div>
                  <div id="10_usd" class="btn bg-primary btn-lg border-0 font-monospace mt-1"
                     onclick="inputUSD.value=10;unitConverter(inputUSD.id,inputUSD.value)">10 USD </div>
                  <div id="10+_usd" class="btn bg-primary btn-lg border-0 font-monospace mt-1"
                     onclick="inputUSD.stepUp(10);unitConverter(inputUSD.id,inputUSD.value)">+10 USD </div>
               </div>
            </div>
         </div>

      </div>
      <p id="source" class="text-end text-muted small">
         Exchange rates from European Central Bank using <a href="https://exchangerate.host/" target="_blank"
            rel="noreferrer noopener">exchangerate.host</a>, bitcoin price from <a href="https://www.coingecko.com/"
            target="_blank" rel="noreferrer noopener">coingecko</a> and flags from <a href="https://flagpedia.net"
            target="_blank" rel="noreferrer noopener">flagpedia</a>
      </p>

      <!-- /main page -->

   </main>
   <footer-component></footer-component>
</body>

</html>