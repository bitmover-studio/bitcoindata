<!doctype html>
<html lang="en">

<head>
   <?php
   $title = "Bitcoin DCA Calculator — Dollar Cost Averaging BTC";
   $description = "Calculate the returns of dollar cost averaging into Bitcoin. See how a recurring weekly or monthly BTC purchase would have performed over any historical timeframe.";
   $keywords = "Bitcoin DCA, dollar cost averaging Bitcoin, DCA calculator, DCA BTC, Bitcoin investment calculator, recurring Bitcoin buy, Bitcoin savings plan, stack sats, Bitcoin recurring purchase";
   $canonical = "https://bitcoindata.science/dca-calculator";
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
   ?>
   <script type="application/ld+json">
      {
         "@context": "https://schema.org",
         "@graph": [{
            "@type": "WebApplication",
            "applicationCategory": "FinanceApplication",
            "name": "Bitcoin DCA Calculator — Dollar Cost Averaging BTC",
            "description": "Calculate the historical returns of dollar cost averaging into Bitcoin. Simulate weekly or monthly recurring purchases over any timeframe and see how your BTC investment would have grown.",
            "alternateName": [
               "bitcoindata.science",
               "Bitcoin Data Science",
               "Bitcoin DCA"
            ],
            "url": "https://bitcoindata.science/dca-calculator",
            "sameAs": [
               "https://bitcoindata.science/dca-calculator.php"
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
               "name": "Bitcoin DCA Calculator",
               "item": "https://bitcoindata.science/dca-calculator"
            }]
         }, {
            "@type": "FAQPage",
            "mainEntity": [{
               "@type": "Question",
               "name": "What is Dollar Cost Averaging (DCA) in Bitcoin?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Dollar Cost Averaging (DCA) is an investment strategy where you buy a fixed dollar amount of Bitcoin at regular intervals (e.g., $100 every week), regardless of the current price. This smooths out volatility and removes the stress of trying to time the market. Over time, you accumulate Bitcoin at the average price rather than risking a poorly timed lump sum purchase."
               }
            }, {
               "@type": "Question",
               "name": "Is DCA a good strategy for investing in Bitcoin?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "DCA is widely regarded as one of the most disciplined and low-stress strategies for accumulating Bitcoin. Historically, anyone who consistently DCA'd into Bitcoin for 3+ years has been profitable regardless of when they started. It eliminates emotional decision-making and benefits from Bitcoin's long-term upward trend while reducing the impact of short-term volatility."
               }
            }, {
               "@type": "Question",
               "name": "How much should I invest in Bitcoin using DCA?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Only invest what you can comfortably afford to lose. A common approach is to allocate a small, fixed percentage of your income — such as $10, $50, or $100 per week — to Bitcoin purchases. The key principle of DCA is consistency over time, not the size of each individual purchase. Even small amounts can grow significantly over multi-year periods."
               }
            }, {
               "@type": "Question",
               "name": "What is the best frequency for DCA into Bitcoin — weekly or monthly?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Both weekly and monthly DCA produce similar long-term results. Weekly DCA provides slightly better price averaging due to more frequent sampling of prices, while monthly DCA is simpler to manage. The most important factor is consistency — choose a frequency that fits your budget and stick to it for the long term."
               }
            }, {
               "@type": "Question",
               "name": "How does Bitcoin DCA compare to lump sum investing?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Lump sum investing outperforms DCA in strong uptrends because all capital is deployed at the lowest possible price. However, DCA significantly reduces the risk of buying at a market top. For most people without a crystal ball, DCA provides better risk-adjusted returns and psychological comfort, especially in Bitcoin's volatile market."
               }
            }, {
               "@type": "Question",
               "name": "Can I lose money with Bitcoin DCA?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Yes, it is possible to have a temporary paper loss with DCA, especially if you start during a market top and stop during a bear market. However, historical data shows that anyone who DCA'd into Bitcoin for at least 3 years has never had a negative return. The longer your DCA timeframe, the lower your risk and the higher your probability of substantial gains."
               }
            }]
         }]
      }
   </script>
   <script src="modules/crypto-js.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
   <script src="components/dca-bitcoin.js?v=0.2" defer></script>
</head>

<body>
   <!-- Navbar -->
   <header>
      <navbar-component></navbar-component>
   </header>

   <!-- Page Content -->
   <?php
   $h1 = 'Bitcoin DCA Calculator';
   $h2 = 'See how dollar cost averaging into Bitcoin would have performed. Simulate weekly or monthly recurring purchases over any historical timeframe.';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>

   <!-- Summary Cards -->
   <p class="section-label mt-5 mb-3">DCA Results</p>
   <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 g-4">
      <!-- Card 1: Total Invested -->
      <div class="col px-2">
         <div class="card bg-body-tertiary shadow-sm h-100 rounded-4">
            <div class="card-body d-flex flex-column justify-content-between">
               <div>
                  <div class="card-text text-muted mb-2 small text-uppercase fw-bold">Total Invested</div>
                  <h5 class="card-title display-6 fw-semibold text-body" id="totalInvested">
                     <span class="spinner-border spinner-border-sm" role="status"></span>
                  </h5>
               </div>
               <div class="mt-3 pt-3 border-top">
                  <div class="card-text text-muted mb-1 small">Number of Purchases</div>
                  <span class="h5 fw-bold text-body-emphasis" id="numPurchases">&nbsp;</span>
               </div>
            </div>
         </div>
      </div>

      <!-- Card 2: Portfolio Value -->
      <div class="col px-2">
         <div class="card bg-body-tertiary shadow-sm h-100 rounded-4">
            <div class="card-body d-flex flex-column justify-content-between">
               <div>
                  <div class="card-text text-muted mb-2 small text-uppercase fw-bold">Portfolio Value</div>
                  <h5 class="card-title display-6 fw-semibold" id="portfolioValue">
                     <span class="spinner-border spinner-border-sm" role="status"></span>
                  </h5>
               </div>
               <div class="mt-3 pt-3 border-top">
                  <div class="card-text text-muted mb-1 small">Profit / Loss</div>
                  <span class="h5 fw-bold" id="profitLoss">&nbsp;</span>
               </div>
            </div>
         </div>
      </div>

      <!-- Card 3: BTC Accumulated -->
      <div class="col px-2">
         <div class="card bg-body-tertiary shadow-sm h-100 rounded-4">
            <div class="card-body d-flex flex-column justify-content-between">
               <div>
                  <div class="card-text text-muted mb-2 small text-uppercase fw-bold">BTC Accumulated</div>
                  <h5 class="card-title display-6 fw-semibold" id="btcAccumulated">
                     <span class="spinner-border spinner-border-sm" role="status"></span>
                  </h5>
               </div>
               <div class="mt-3 pt-3 border-top">
                  <div class="card-text text-muted mb-1 small">Avg. Purchase Price</div>
                  <span class="h5 fw-bold text-body-emphasis" id="avgPrice">&nbsp;</span>
               </div>
            </div>
         </div>
      </div>

      <!-- Card 4: ROI -->
      <div class="col px-2">
         <div class="card bg-body-tertiary shadow-sm h-100 rounded-4">
            <div class="card-body d-flex flex-column justify-content-between">
               <div>
                  <div class="card-text text-muted mb-2 small text-uppercase fw-bold">Return on Investment</div>
                  <h5 class="card-title display-6 fw-semibold" id="roiPercent">
                     <span class="spinner-border spinner-border-sm" role="status"></span>
                  </h5>
               </div>
               <div class="mt-3 pt-3 border-top">
                  <div class="card-text text-muted mb-1 small">Current BTC Price</div>
                  <span class="h5 fw-bold text-body-emphasis" id="currentBtcPrice">&nbsp;</span>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Controls and Chart Area -->
   <div class="mt-4 mb-1 bg-body-tertiary rounded-4 p-4 shadow-sm">
      <div class="row g-3">
         <div class="col-md-3">
            <p class="h5 mt-3 pt-3 section-label border-bottom pb-1 text-primary">DCA Calculator Settings</p>

            <!-- Investment Amount -->
            <div class="row g-3 mb-4 pt-3">
               <div class="col-12 text-start">
                  <label for="investAmount" class="form-label fw-semibold">Investment Amount (USD)</label>
                  <div class="input-group mb-2">
                     <span class="input-group-text bg-body-secondary border-0">$</span>
                     <input type="number" class="form-control font-monospace border-0 bg-body-secondary"
                        id="investAmount" value="100" min="1" max="100000" step="10">
                  </div>
                  <input type="range" class="form-range" id="investAmountRange" min="1" max="10000" step="10"
                     value="100">
               </div>
            </div>

            <!-- Frequency -->
            <div class="row g-3 mb-4">
               <div class="col-12 text-start">
                  <label for="frequency" class="form-label fw-semibold">Purchase Frequency</label>
                  <select class="form-select border-0 bg-body-secondary rounded-3" id="frequency">
                     <option value="1">Daily</option>
                     <option value="7" selected>Weekly</option>
                     <option value="15">Biweekly</option>
                     <option value="30">Monthly</option>
                  </select>
               </div>
            </div>

            <!-- Start Date -->
            <div class="row g-3 mb-4">
               <div class="col-12 text-start">
                  <label for="startDate" class="form-label fw-semibold">Start Date</label>
                  <input type="date" class="form-control border-0 bg-body-secondary font-monospace" id="startDate">
               </div>
            </div>

            <!-- End Date -->
            <div class="row g-3 mb-4">
               <div class="col-12 text-start">
                  <label for="endDate" class="form-label fw-semibold">End Date</label>
                  <input type="date" class="form-control border-0 bg-body-secondary font-monospace" id="endDate">
               </div>
            </div>


            <!-- Action Buttons -->
            <div class="d-flex gap-2 flex-wrap">
               <button type="button" class="btn btn-outline-secondary shadow-sm" id="shareBtn" onclick="saveAndShare()"
                  title="Share this calculation">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                     class="bi bi-share me-1" viewBox="0 0 16 16">
                     <path
                        d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z" />
                  </svg>Share
               </button>
               <button type="button" class="btn btn-outline-secondary shadow-sm" onclick="exportDCAToCSV()"
                  title="Export to CSV">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                     class="bi bi-download me-1" viewBox="0 0 16 16">
                     <path
                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                     <path
                        d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                  </svg>CSV
               </button>
            </div>

         </div>

         <div class="col-md-9">
            <div class="card border-0 bg-transparent text-center">
               <h4 class="card-header bg-transparent h3">
                  Bitcoin DCA Performance Chart
               </h4>
               <div class="card-body">
                  <div id="dcaChart" class="px-0 mx-0"></div>
               </div>
            </div>
         </div>
      </div>
      <!-- Share options container -->
      <div id="shareContainer" class="w-100 mt-3 d-none text-start">
         <div class="p-3 rounded-4 bg-body-secondary border border-secondary border-opacity-10">
            <div class="d-flex justify-content-between align-items-center mb-2">
               <span class="fw-semibold small text-body-secondary">Share Calculation</span>
               <button type="button" class="btn-close btn-close-sm"
                  onclick="document.getElementById('shareContainer').classList.add('d-none')"
                  aria-label="Close"></button>
            </div>
            <div class="mb-3">
               <label for="shareUrl" class="text-body-secondary small fw-medium mb-1 d-block">Permalink</label>
               <div class="input-group">
                  <input type="text" id="shareUrl" class="form-control form-control-sm font-monospace bg-body border-0"
                     readonly onclick="this.select()">
                  <button class="btn btn-primary btn-sm px-3" type="button" id="copyShareBtn"
                     onclick="copyShareUrl('shareUrl', 'copyShareBtn')">Copy Link</button>
               </div>
            </div>
            <div>
               <label for="shareBbcode" class="text-body-secondary small fw-medium mb-1 d-block">BBCode
                  (Forums)</label>
               <div class="input-group">
                  <input type="text" id="shareBbcode"
                     class="form-control form-control-sm font-monospace bg-body border-0" readonly
                     onclick="this.select()">
                  <button class="btn btn-secondary btn-sm px-3" type="button" id="copyBbcodeBtn"
                     onclick="copyShareUrl('shareBbcode', 'copyBbcodeBtn')">Copy BBCode</button>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- FAQ Section -->
   <article class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm mt-5 mb-4" id="accordion-faq" data-items="6">
   </article>

   </main>
   <footer-component></footer-component>

   <script>
      // Listen for theme mutations to update ApexCharts colors
      var callback = function (mutationsList, observer) {
         for (let mutation of mutationsList) {
            if (mutation.attributeName === 'data-bs-theme') {
               if (typeof updateChartThemes === 'function') {
                  updateChartThemes(localStorage.getItem('theme'));
               }
            }
         }
      };
      var observer = new MutationObserver(callback);
      observer.observe(document.documentElement, {
         attributes: true,
         attributeFilter: ['data-bs-theme']
      });
   </script>
</body>

</html>