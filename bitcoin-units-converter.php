<!doctype html>
<html lang="en">

<head>
   <?php
   $title = "Bitcoin Units Converter - BTC, mBTC, uBTC";
   $description = "Easily convert Bitcoin units — BTC, mBTC, μBTC, satoshi, and finney — to USD, EUR, RUB, BRL, TRY and other 168 fiat currencies with our fast and accurate Bitcoin Units Converter. Perfect for traders & crypto enthusiasts.";
   $keywords = "Bitcoin,Units,Converter,BTC,mBTC,satoshi,EUR,USD,RUB,TRY,BRL,finney,μBTC,uBTC,cBTC";
   $canonical = "https://bitcoindata.science/bitcoin-unit-converter";
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
   ?>
   <script type="application/ld+json">
      {
         "@context": "https://schema.org",
         "@graph": [{
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
      }, {
         "@type": "BreadcrumbList",
         "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "https://bitcoindata.science"
         }, {
            "@type": "ListItem",
            "position": 2,
            "name": "Bitcoin Tools",
            "item": "https://bitcoindata.science/#bitcoin-tools"
         }, {
            "@type": "ListItem",
            "position": 3,
            "name": "Bitcoin Units Converter",
            "item": "https://bitcoindata.science/bitcoin-units-converter"
         }]
      }, {
         "@type": "FAQPage",
         "mainEntity": [{
               "@type": "Question",
               "name": "What is Bitcoin Units Converter?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Bitcoin Units Converter is a free online tool that allows you to convert bitcoin units (BTC, mBTC, μBTC, satoshi, finney) to USD, EUR, RUB, BRL, TRY and 170 other fiat currencies. It provides real-time price updates and supports instant conversions with high accuracy."
               }
            },
            {
               "@type": "Question",
               "name": "How many fiat currencies does the converter support?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Our Bitcoin Units Converter supports 170 fiat currencies from around the world, including USD, EUR, RUB, BRL, TRY and many more. All currencies are updated in real-time to ensure accurate conversions."
               }
            },
            {
               "@type": "Question",
               "name": "What are the supported Bitcoin units?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "The tool supports all major bitcoin units: BTC (bitcoin), mBTC (millibit), μBTC (bit), sat (satoshi), cBTC (bitcent), finney, and msat (millisatoshi - available only in the Lightning Network). You can convert between any of these units effortlessly."
               }
            },
            {
               "@type": "Question",
               "name": "Is the price data real-time?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Yes, all fiat currency prices are updated in real-time to provide you with the most accurate conversion rates possible. The prices are sourced from reliable market data feeds to ensure accuracy."
               }
            },
            {
               "@type": "Question",
               "name": "How much is 1 satoshi (sat) worth in bitcoin units?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "1 satoshi is equal to 0.00000001 BTC"
               }
            },
            {
               "@type": "Question",
               "name": "How much is 1 millibit(mBTC) worth?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "1 millibit is equal to 0.001 BTC"
               }
            },
            {
               "@type": "Question",
               "name": "How much is 1 bit(uBTC) worth?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "1 bit is equal to 0.000001 BTC"
               }
            }
         ]
      }]
   }
</script>
   <script src="components/unit-converter.js" defer></script>

</head>


<body>
   <!-- Navbar -->
   <header>
      <navbar-component></navbar-component>
   </header>
   <!-- Page Content -->
   <?php
   $h1 = 'Bitcoin Units Converter';
   $h2 = 'Use any of the fields below to convert bitcoin units BTC,mBTC, uBTC, satoshi, finney to
      USD, EUR or any other fiat currency.';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>

   <div class="bg-body-tertiary rounded-4 p-4 shadow-sm">
      <div class="row">
         <div id="unit-container" class="col-md-6"></div>
         <script>
            const unitList = [{
               id: 'inputBTC',
               label: 'bitcoin',
               title: 'BTC',
               value: 1
            },
            {
               id: 'inputcBTC',
               label: 'bitcent',
               title: 'cBTC'
            },
            {
               id: 'inputmBTC',
               label: 'millibit',
               title: 'mBTC'
            },
            {
               id: 'inputuBTC',
               label: 'bit',
               title: 'μBTC'
            },
            {
               id: 'inputFinney',
               label: 'finney',
               title: 'finney'
            },
            {
               id: 'inputsat',
               label: `satoshi`,
               title: 'sat'
            },
            {
               id: 'inputmsat',
               label: `millisatoshi (<a class="conversor small" href="https://en.bitcoin.it/wiki/Lightning_Network" data-bs-toggle="tooltip" data-bs-title="Available only in the Lightning Network">Lightning Network</a>)`,
               title: 'msat'
            }
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
               <span class="input-group-text font-monospace rounded-start-4 me-1 border-0 bg-body-secondary"
                  style="width: 25% !important;">USD</span>
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
                     <select class="form-select rounded-start-4 rounded-end-0 border-0 bg-body-secondary" id="selEbank"
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

   <!-- FAQ Section (Populated dynamically via Schema.org FAQPage in components/breadcrumbs.js) -->
   <article class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm mt-5 mb-4" id="accordion-faq" data-items="4">
   </article>

   <!-- /main page -->
   </main>
   <footer-component></footer-component>
</body>

</html>