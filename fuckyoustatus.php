<!doctype html>
<html lang="en">

<head>
   <?php 
   $title = "Bitcoin Fuck You Money Calculator - bitcoin data.science";
   $description = "Calculate the amount of bitcoin needed to reach financial independence and 'Fuck You Money' status under different regression models and inflation rates.";
   $keywords = "Bitcoin, Fuck You Money, Regression, Power Law, Moving Average, 200 Weeks, Inflation, Financial Independence";
   $canonical = "https://bitcoindata.science/fuckyoumoney";
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
   ?>
   <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Fuck You Money Calculator",
        "description": "Calculate the amount of bitcoin needed to reach 'Fuck You Money' status with inflation adjustments and regression models.",
        "alternateName": [
          "bitcoindata.science",
          "Bitcoin Data Science"
        ],
        "url": "https://bitcoindata.science",
        "logo": "https://bitcoindata.science/img/logo.svg",
        "sameAs": [
          "https://bitcoindata.science"
        ]
      }
   </script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="components/fuckyoumoney.js" defer></script>
</head>

<body>
   <!-- Navbar -->
   <header>
      <navbar-component></navbar-component>
   </header>
   
   <!-- Page Content -->
   <?php
   $h1 = 'Bitcoin "Fuck You Money" Status';
   $h2 = 'Calculate how much Bitcoin you need to reach financial independence over the next 10-20 years.';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>

   <p class="text-center mb-4">
      Determine the Bitcoin stash required to fund your life, taking into account inflation, withdrawal rates, and long-term price prediction models.
   </p>

   <!-- Summary Cards for Today -->
   <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 g-4 mt-2">
      <!-- Card 1: Today's Prices -->
      <div class="col px-2">
         <div class="card bg-body-tertiary border-0 shadow-sm h-100 rounded-4">
            <div class="card-body d-flex flex-column justify-content-between">
               <div>
                  <div class="card-text text-muted mb-2 small text-uppercase fw-bold">Bitcoin Price</div>
                  <h5 class="card-title display-6 fw-semibold text-body" id="liveSpotPrice">
                     <span class="spinner-border spinner-border-sm" role="status"></span>
                  </h5>
               </div>
               <div class="mt-3 pt-3 border-top">
                  <div class="card-text text-muted mb-1 small">Current 200-WMA</div>
                  <span class="h5 fw-bold text-body-emphasis" id="live200WMA">—</span>
               </div>
            </div>
         </div>
      </div>

      <!-- Card 2: 10% FU Status -->
      <div class="col px-2">
         <div class="card bg-body-tertiary border-0 shadow-sm h-100 rounded-4">
            <div class="card-body d-flex flex-column justify-content-between">
               <div>
                  <div class="card-text text-muted mb-2 small text-uppercase fw-bold">10% FU Status</div>
                  <h5 class="card-title display-6 fw-semibold text-success" id="todayFU10">
                     <span class="spinner-border spinner-border-sm" role="status"></span>
                  </h5>
               </div>
               <div class="mt-3 pt-3 border-top">
                  <div class="card-text text-muted mb-1 small" id="todayFU10Desc">Target Portfolio: $800,000</div>
                  <span class="small text-secondary">Valued at 200-WMA</span>
               </div>
            </div>
         </div>
      </div>

      <!-- Card 3: 4% FU Status -->
      <div class="col px-2">
         <div class="card bg-body-tertiary border-0 shadow-sm h-100 rounded-4">
            <div class="card-body d-flex flex-column justify-content-between">
               <div>
                  <div class="card-text text-muted mb-2 small text-uppercase fw-bold">4% FU Status</div>
                  <h5 class="card-title display-6 fw-semibold text-info" id="todayFU4">
                     <span class="spinner-border spinner-border-sm" role="status"></span>
                  </h5>
               </div>
               <div class="mt-3 pt-3 border-top">
                  <div class="card-text text-muted mb-1 small" id="todayFU4Desc">Target Portfolio: $2,000,000</div>
                  <span class="small text-secondary">Valued at 200-WMA</span>
               </div>
            </div>
         </div>
      </div>

      <!-- Card 4: Filthy-Rich -->
      <div class="col px-2">
         <div class="card bg-body-tertiary border-0 shadow-sm h-100 rounded-4">
            <div class="card-body d-flex flex-column justify-content-between">
               <div>
                  <div class="card-text text-muted mb-2 small text-uppercase fw-bold">Filthy-Rich Status</div>
                  <h5 class="card-title display-6 fw-semibold text-purple" id="todayFR">
                     <span class="spinner-border spinner-border-sm" role="status"></span>
                  </h5>
               </div>
               <div class="mt-3 pt-3 border-top">
                  <div class="card-text text-muted mb-1 small" id="todayFRDesc">Target Portfolio: $100,000,000</div>
                  <span class="small text-secondary">Valued at 200-WMA</span>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Controls and Charts Area -->
   <div class="row mt-4 mb-4 g-4 bg-body-tertiary rounded-4 p-4 shadow-sm">
      <!-- Input Sidebar -->
      <div class="col-lg-4 border-end-lg pe-lg-4">
         <h4 class="h5 mb-4 fw-bold text-primary">Calculation Controls</h4>
         
         <!-- Budget Input -->
         <div class="mb-4">
            <label for="annualBudget" class="form-label fw-semibold">Target Annual Budget (USD)</label>
            <div class="input-group mb-2">
               <span class="input-group-text bg-body-secondary border-0">$</span>
               <input type="number" class="form-control font-monospace border-0 bg-body-secondary" id="annualBudget" value="80000" min="1000" step="5000">
            </div>
            <input type="range" class="form-range" id="annualBudgetRange" min="20000" max="500000" step="5000" value="80000">
            <div class="form-text small">Desired annual nominal purchasing power target (today's dollars).</div>
         </div>

         <!-- Inflation Input -->
         <div class="mb-4">
            <label for="inflationRate" class="form-label fw-semibold">Predicted Inflation Rate (%)</label>
            <div class="input-group mb-2">
               <input type="number" class="form-control font-monospace border-0 bg-body-secondary" id="inflationRate" value="3.0" min="0" max="25" step="0.1">
               <span class="input-group-text bg-body-secondary border-0">%</span>
            </div>
            <input type="range" class="form-range" id="inflationRateRange" min="0" max="15" step="0.1" value="3.0">
            <div class="form-text small">Inflation will increase your required USD target over time.</div>
         </div>

         <!-- Horizon Input -->
         <div class="mb-4">
            <label for="horizonYears" class="form-label fw-semibold">Projection Horizon</label>
            <div class="input-group mb-2">
               <input type="number" class="form-control font-monospace border-0 bg-body-secondary" id="horizonYears" value="15" min="10" max="20" step="1">
               <span class="input-group-text bg-body-secondary border-0">Years</span>
            </div>
            <input type="range" class="form-range" id="horizonYearsRange" min="10" max="20" step="1" value="15">
            <div class="form-text small">Extend predictions between 10 and 20 years.</div>
         </div>

         <!-- Model Selector -->
         <div class="mb-4">
            <label for="modelSelect" class="form-label fw-semibold">Prediction Model</label>
            <select class="form-select border-0 bg-body-secondary rounded-3" id="modelSelect">
               <option value="jjg_cycle" selected>JJG Cycle Model (Self-Adjusting)</option>
               <option value="bearish_cycle">Bearish Cycle Model (Diminishing Gains)</option>
               <option value="power_law">Power Law Regression Model</option>
            </select>
            <div class="form-text small">Choose how the future 200WMA and Spot Prices are predicted.</div>
         </div>

         <!-- Spot Price Assumption -->
         <div class="mb-3">
            <label for="spotPremiumSelect" class="form-label fw-semibold">Future Spot Price Premium</label>
            <select class="form-select border-0 bg-body-secondary rounded-3" id="spotPremiumSelect">
               <option value="fixed" selected>Fixed 30% Premium above 200WMA</option>
               <option value="cyclical">Cyclical (-30% bottom / 102% top)</option>
            </select>
            <div class="form-text small">Assumed spot price relation to the predicted 200WMA.</div>
         </div>
      </div>

      <!-- Charts Viewport -->
      <div class="col-lg-8">
         <!-- Tabs for Charts -->
         <ul class="nav nav-pills mb-3 justify-content-end" id="chartTabs" role="tablist">
            <li class="nav-item" role="presentation">
               <button class="btn rounded-pill btn-outline-primary active me-2 border-2" id="price-tab" data-bs-toggle="pill" data-bs-target="#priceChartContainer" type="button" role="tab" aria-controls="priceChartContainer" aria-selected="true">
                  Price Projection
               </button>
            </li>
            <li class="nav-item" role="presentation">
               <button class="btn rounded-pill btn-outline-primary border-2" id="coins-tab" data-bs-toggle="pill" data-bs-target="#coinsChartContainer" type="button" role="tab" aria-controls="coinsChartContainer" aria-selected="false">
                  Coins Needed (Inflation Adj.)
               </button>
            </li>
         </ul>
         
         <div class="tab-content" id="chartTabsContent">
            <!-- Price Chart Tab -->
             <div class="tab-pane fade show active" id="priceChartContainer" role="tabpanel" aria-labelledby="price-tab">
                <h5 class="text-center mb-2">Bitcoin Price & 200WMA Predictions</h5>
                <div class="row justify-content-between mb-2">
                   <div class="col-auto">
                      <span class="small border-1 px-2 border-end" onClick="priceChartPeriod(-30)"><a href="javascript:void(0);" class="pointer">1M</a></span>
                      <span class="small border-1 px-2 border-end" onClick="priceChartPeriod(-180)"><a href="javascript:void(0);" class="pointer">6M</a></span>
                      <span class="small border-1 px-2 border-end" onClick="priceChartPeriod(-365)"><a href="javascript:void(0);" class="pointer">1Y</a></span>
                      <span class="small border-1 px-2 border-end" onClick="priceChartPeriod(-1825)"><a href="javascript:void(0);" class="pointer">5Y</a></span>
                      <span class="small border-1 px-2 border-end" onClick="priceChartPeriod(-3650)"><a href="javascript:void(0);" class="pointer">10Y</a></span>
                      <span class="small border-1 px-2" onClick="priceChartPeriod()"><a href="javascript:void(0);" class="pointer link-secondary border-bottom border-3">ALL</a></span>
                   </div>
                   <div class="col-auto form-check gx-1">
                      <input class="form-check-input" type="checkbox" checked id="linLog" onchange="togglePriceLogScale();">
                      <label class="form-check-label small text-body-emphasis" for="linLog">
                         Logarithmic scale
                      </label>
                   </div>
                </div>
                <div id="priceChart" style="min-height: 380px;"></div>
             </div>
            <!-- Coins Needed Chart Tab -->
            <div class="tab-pane fade" id="coinsChartContainer" role="tabpanel" aria-labelledby="coins-tab">
               <h5 class="text-center mb-2">Coins Needed to Achieve FU Status</h5>
               <div id="coinsChart" style="min-height: 380px;"></div>
            </div>
         </div>
      </div>
   </div>

   <!-- Projections Table -->
   <div class="bg-body-tertiary rounded-4 p-4 shadow-sm mb-5">
      <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
         <div>
            <h4 class="h5 fw-bold text-primary mb-1">Semi-Annual Projection Data Table</h4>
            <p class="text-muted small mb-0" id="tableSubtitle">Adjusted starting from today's actual price</p>
         </div>
         <button class="btn btn-sm btn-outline-secondary mt-2 mt-md-0" onclick="exportTableToCSV()">
            Export to CSV
         </button>
      </div>

      <div class="table-responsive">
         <table class="table table-hover align-middle" id="projectionsTable">
            <thead class="table-dark">
               <tr class="text-nowrap text-center">
                  <th>Date</th>
                  <th>Predicted Spot</th>
                  <th>Predicted 200 WMA</th>
                  <th>% Gain / Time</th>
                  <th>Spot vs 200 WMA</th>
                  <th>Coins Needed (10% FU)</th>
                  <th>Coins Needed (4% FU)</th>
                  <th>Coins Needed (Filthy-Rich)</th>
               </tr>
            </thead>
            <tbody class="font-monospace text-center" id="tableBody">
               <tr>
                  <td colspan="8" class="text-center py-5">
                     <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading data...</span>
                     </div>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>

   <article class="mt-5 mb-5">
      <h4 class="h2 fw-bold my-4">Understanding the Calculations</h4>
      
      <div class="row g-4">
         <div class="col-md-6">
            <h5 class="h5 fw-semibold text-warning">What is "Fuck You Money" Status?</h5>
            <p>
               In personal finance, "Fuck You Money" is the amount of capital required to survive and live comfortably without being dependent on employment or external funding.
            </p>
            <p>
               By incorporating the <strong>200-week moving average (200WMA)</strong> as a valuation anchor, we insulate our assets from Bitcoin's high volatility. Because the 200WMA has historically acted as a reliable macro-cycle bottom, drawing withdrawals against the 200WMA valuation provides a highly sustainable long-term budget.
            </p>
         </div>
         
         <div class="col-md-6">
            <h5 class="h5 fw-semibold text-warning">Inflation and Purchasing Power</h5>
            <p>
               If you require a $80,000 budget in today's dollars, a constant 3.0% annual inflation rate means that in 10 years, you will need <strong>$107,513</strong> nominal dollars, and in 20 years, you will need <strong>$144,489</strong> nominal dollars to purchase the same goods.
            </p>
            <p>
               This tool adjusts your required nominal portfolios dynamically. Consequently, if Bitcoin's price appreciation outpaces inflation, the absolute number of Bitcoins you need to hold decreases dramatically over time.
            </p>
         </div>
      </div>
   </article>

   </main>
   <footer-component></footer-component>

   <script>
      // Listen for theme mutations to update ApexCharts colors
      var callback = function (mutationsList, observer) {
         for (let mutation of mutationsList) {
            if (mutation.attributeName === 'data-bs-theme') {
               priceChartInstance.updateOptions({ theme: { mode: localStorage.getItem('theme') } });
               coinsChartInstance.updateOptions({ theme: { mode: localStorage.getItem('theme') } });
            }
         }
      };
      var observer = new MutationObserver(callback);
      observer.observe(document.documentElement, { attributes: true, attributeFilter: ['data-bs-theme'] });
   </script>
</body>

</html>
