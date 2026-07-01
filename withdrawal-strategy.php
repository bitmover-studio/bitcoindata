<!doctype html>
<html lang="en">

<head>
   <?php 
   $title = "JJG Withdrawal Strategy - bitcoin data.science";
   $description = "Ideas of sustainable withdrawal that attempts to measure monthly budget limits based spot price relative to the 200-week moving average";
   $keywords = "Withdrawal, profit, Strategy, bitcoin, moving average, 200 weeks";
   $canonical = "https://bitcoindata.science/withdrawal-strategy";
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
   ?>
   <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Withdrawal Strategy ",
        "description": "Ideas of sustainable withdrawal that calculates monthly budget limits based BTC spot price relative to the 200-Week Moving Average (200-WMA).",
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
     <script>
    if (window.location.search.length > 0) {
      const meta = document.createElement("meta");
      meta.name = "robots";
      meta.content = "noindex, follow";
      document.head.appendChild(meta);
    }
  </script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js"
      integrity="sha512-a+SUDuwNzXDvz4XrIcXHuCf089/iJAoN4lmrXJg18XnduKK6YlDHNRalv4yd1N40OKI80tFidF+rqTFKGPoWFQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
   <script src="components/strategy.js" async></script>
   <script src="components/jjg-chart-options.js" async></script>
   <script src="components/jjg-stash-chart.js" async></script>
   <script src="components/jjg-share.js" async></script>
</head>

<body>
   <!-- Navbar -->
   <header>
      <navbar-component></navbar-component>
   </header>
   <!-- Page Content -->
   <?php
   $h1 = 'JJG Sustainable Withdrawal Strategy';
   $h2 = 'Ideas of a sustainable withdrawal strategy considering 200-week moving averages.';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>

      <p class="">Ideas of sustainable withdrawal that calculates monthly budget limits based BTC spot
         price relative to the 200-Week Moving Average (200-WMA). <span class="small"><a
               href="https://bitcointalk.org/index.php?topic=5475347.msg63213914#msg63213914"
               class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover small fw-semibold"
               title="Reference">by JayJuanGee (JJG)</a> </span></p>

   <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 g-4 mt-2">
      <!-- Card 1: Price Above 200-WMA (%) -->
      <div class="col px-2">
         <div class="card bg-body-tertiary border-0 shadow-sm h-100 rounded-4">
            <div class="card-body d-flex flex-column justify-content-between">
               <div>
                  <div class="card-text text-muted mb-2 small text-uppercase fw-bold">Price Above 200-WMA (%)</div>
                  <h5 class="card-title display-6 fw-semibold" id="pricesma">
                     <span class="spinner-border spinner-border-sm" role="status"></span>
                  </h5>
               </div>
               <div class="mt-3 pt-3 border-top">
                  <div class="card-text text-muted mb-1 small">Date</div>
                  <span class="h5 fw-bold text-body-emphasis" id="currentDate">&nbsp;</span>
               </div>
            </div>
         </div>
      </div>

      <!-- Card 2: BTC Spot Price -->
      <div class="col px-2">
         <div class="card bg-body-tertiary border-0 shadow-sm h-100 rounded-4">
            <div class="card-body d-flex flex-column justify-content-between">
               <div>
                  <div class="card-text text-muted mb-2 small text-uppercase fw-bold">BTC Spot Price</div>
                  <h5 class="card-title display-6 fw-semibold text-body" id="BTCPrice">
                     <span class="spinner-border spinner-border-sm" role="status"></span>
                  </h5>
               </div>
               <div class="mt-3 pt-3 border-top">
                  <div class="card-text text-muted mb-1 small">BTC Stash Value (Spot)</div>
                  <span class="h5 fw-bold text-body-emphasis" id="stashValue">&nbsp;</span>
               </div>
            </div>
         </div>
      </div>

      <!-- Card 3: 200-Week MA -->
      <div class="col px-2">
         <div class="card bg-body-tertiary border-0 shadow-sm h-100 rounded-4">
            <div class="card-body d-flex flex-column justify-content-between">
               <div>
                  <div class="card-text text-muted mb-2 small text-uppercase fw-bold">200-Week MA</div>
                  <h5 class="card-title display-6 fw-semibold text-body" id="sma">
                     <span class="spinner-border spinner-border-sm" role="status"></span>
                  </h5>
               </div>
               <div class="mt-3 pt-3 border-top">
                  <div class="card-text text-muted mb-1 small">BTC Stash Value (200-WMA)</div>
                  <span class="h5 fw-bold text-body-emphasis" id="stashWMAValue">&nbsp;</span>
               </div>
            </div>
         </div>
      </div>

      <!-- Card 4: Ranges -->
      <div class="col px-2">
         <div class="card bg-body-tertiary border-0 shadow-sm h-100 rounded-4">
            <div class="card-body d-flex flex-column justify-content-between">
               <div>
                  <div class="card-text text-muted mb-2 small text-uppercase fw-bold">Day's Range</div>
                  <div class="d-flex justify-content-between align-items-center mb-1">
                     <span id="minDayPrice" class="small text-secondary">&nbsp;</span>
                     <span id="maxDayPrice" class="small text-secondary">&nbsp;</span>
                  </div>
                  <div class="progress mb-2" role="progressbar" aria-label="Day's Range" id="priceRange" style="height: 0.3rem;">
                     <div class="progress-bar bg-secondary" id="priceRangeLength" style="width: 0%;"></div>
                  </div>
               </div>
               <div class="mt-3 pt-3 border-top">
                  <div class="card-text text-muted mb-2 small text-uppercase fw-bold">200-Week's Range</div>
                  <div class="d-flex justify-content-between align-items-center mb-1">
                     <span id="min200WPrice" class="small text-secondary">&nbsp;</span>
                     <span id="max200WPrice" class="small text-secondary">&nbsp;</span>
                  </div>
                  <div class="progress" role="progressbar" aria-label="200-Week's Range" id="price200WRange" style="height: 0.3rem;">
                     <div class="progress-bar bg-secondary" id="price200WRangeLength" style="width: 0%;"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

      <div class="row mt-4 mb-1 g-3 bg-body-tertiary rounded-top-4 p-4 shadow-sm">
         <div class="col-md-3 text-end">
            <p class="h5 mt-3 pt-3">Input Area</p>
            <div class="row g-3 mb-4 pt-3">
               <label for="wrate" class="form-label h6">Annual Withdrawal Rate</label>
               <input value="6" type="range" min="0" max="30" step="0.25" class="form-range float-start" id="wrate"
                  oninput="calculateWithdrawalLimit()">
               <div class="form-floating gx-1 col-6 col-sm-12 ">
                  <input type="text" class="form-control  font-monospace border-0 bg-body-secondary rounded-4"
                     id="withdrawalRateInput" value="4%"
                     onChange="updateRangeInput(this.value);calculateWithdrawalLimit()">
                  <label for="withdrawalRateInput" id="withdrawalDescription">Conservative</label>
               </div>
            </div>
            <div class="row g-3">
               <div class="form-floating gx-1 mb-3 col-6 col-sm-12">
                  <input type="number" class="form-control font-monospace border-0 bg-body-secondary rounded-4"
                     id="stash" placeholder="BTC Stash" step="0.01" min="0" value="1"
                     onChange="calculateWithdrawalLimit()">
                  <label for="stash">BTC stash size</label>
               </div>
               <div class="form-floating gx-1 col-6 col-sm-12">
                  <input type="date" title="choose a date"
                     class="form-control  font-monospace border-0 bg-body-secondary rounded-4" id="date"
                     min="2010-08-02" onChange="drawAnnotation(this.value)">
                  <label for="date">Choose a date</label>
               </div>
               <div class="col-6 col-sm-12">
                  <div class="form-check gx-1 float-end">
                     <input class="form-check-input" type="checkbox" value="" id="useDate" onchange="checkDate();">
                     <label class="form-check-label small" for="useDate">
                        Use this date
                     </label>
                  </div>
                  <div class="toast-container position-absolute p-3 mt-5">
                     <div class="toast align-items-center text-bg-warning border-0" role="alert" id="checkToast"
                        aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                           <div class="toast-body">
                              Warning. Page will recalculate all fields according to this date.
                           </div>
                           <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                              aria-label="Close"></button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-6 col-sm-12">
                  <div class="d-flex justify-content-end align-items-center">
                     <span class="me-1 text-primary-emphasis fw-semibold">Spot price</span>
                     <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="togglePrice"
                           onchange="calculateWithdrawalLimit();">
                        <label class="form-check-label  text-primary-emphasis fw-semibold" for="togglePrice">200 WMA
                           Price</label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="card border-0 bg-transparent text-center">
               <h4 class="card-header bg-transparent h3">
                  Bitcoin Price / 200 WMA Chart
               </h4>
               <div class="card-body">
                  <div class="row justify-content-between">
                     <div class="col-auto">
                        <span class="small border-1 px-2 border-end" onClick="chartPeriod(-30)"><a
                              href="javascript:void(0);" class="pointer">1M</a></span>
                        <span class="small border-1 px-2 border-end" onClick="chartPeriod(-180)"><a
                              href="javascript:void(0);" class="pointer">6M</a></span>
                        <span class="small border-1 px-2 border-end" onClick="chartPeriod(-365)"><a
                              href="javascript:void(0);" class="pointer">1Y</a></span>
                        <span class="small border-1 px-2 border-end" onClick="chartPeriod(-1825)"><a
                              href="javascript:void(0);" class="pointer">5Y</a></span>
                        <span class="small border-1 px-2 border-end" onClick="chartPeriod(-3650)"><a
                              href="javascript:void(0);" class="pointer">10Y</a></span>
                        <span class="small border-1 px-2" onClick="chartPeriod()"><a href="javascript:void(0);"
                              class="pointer link-secondary border-bottom border-3">ALL</a></span>
                     </div>
                     <div class="col-auto form-check gx-1">
                        <input class="form-check-input" type="checkbox" checked id="linLog"
                           onchange="linearLogarithimic();">
                        <label class="form-check-label small" for="linLog">
                           Logarithimic scale
                        </label>
                     </div>
                  </div>
                  <div id="chart" class="px-0 mx-0"></div>
                  <div id="brushChart" class="px-0 mx-0"></div>
                  <div class="card-text text-body-secondary text-end small">
                     <div class="float-start">
                        <button type="button" id="saveInputs" title="Save inputs" class="btn btn-primary shadow-sm px-3"
                           onclick="saveToLocalStorage()">Save
                           inputs
                        </button>
                        <button type="button" title="refresh" class="btn btn-secondary shadow-sm"
                           onclick="restoreDefaults()">
                           <svg xmlns="http://www.w3.org/2000/svg" height="24" fill="currentColor"
                              viewBox="0 -960 960 960" width="24">
                              <path
                                 d="M480-160q-134 0-227-93t-93-227q0-134 93-227t227-93q69 0 132 28.5T720-690v-110h80v280H520v-80h168q-32-56-87.5-88T480-720q-100 0-170 70t-70 170q0 100 70 170t170 70q77 0 139-44t87-116h84q-28 106-114 173t-196 67Z" />
                           </svg>
                        </button>
                        <button type="button" id="shareInputs" title="Share" class="btn btn-secondary shadow-sm px-3"
                           onclick="save_share();copyurl('shareURL')">
                           Share
                        </button>
                        <div class="toast-container position-absolute mt-3">
                           <div class="toast align-items-center text-bg-primary " role="alert" id="saveInputsToast"
                              aria-live="assertive" aria-atomic="true">
                              <div class="d-flex">
                                 <div class="toast-body">
                                    Inputs stored in your browser for future visits.
                                 </div>
                                 <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                                    aria-label="Close"></button>
                              </div>
                           </div>
                           <div class="toast text-bg-secondary w-100" role="alert" id="shareInputsToast"
                              aria-live="assertive" aria-atomic="true">
                              <div class="d-flex">
                                 <small class="toast-body text-start" id="shareURL">
                                    &nbsp;
                                 </small>
                                 <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                                    aria-label="Close"></button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <p class="float-end">Price data by <a href="https://www.coingecko.com?utm_source=bitcoindata.science&utm_medium=referral" title="">coingecko</a></p>
                  </div>
               </div>

            </div>
         </div>
         <div class="col-md-3">
            <p class="h5 mt-3 pt-3">Output Area</p>
            <h3 class="h6 mt-3 pt-3">Monthly Authorized Withdrawal <a id="monthFormula"
                  class="fw-semibold align-top text-decoration-none">&nbsp;</a>
            </h3>
            <div class="form-floating mb-3">
               <input type="text" class="form-control font-monospace border-0 bg-body-secondary rounded-4" id="allowed"
                  placeholder="Authorized BTC Withdrawal" onChange="calculateWithdrawalLimit()" value="0" disabled>
               <label for="allowed">Authorized BTC Withdrawal</label>
            </div>
            <div class="form-floating mb-3">
               <input type="text" class="form-control font-monospace border-0 bg-body-secondary rounded-4"
                  id="allowedvalue" placeholder="Authorized Withdrawal USD" onChange="calculateWithdrawalLimit()"
                  value="0" disabled>
               <label for="allowedvalue">Authorized Withdrawal USD</label>
            </div>

            <h4 class="mt-4 h6 pb-0 mb-0">Advanced Withdrawal <a id="advMonthFormula"
                  class="fw-semibold align-top text-decoration-none">&nbsp;</a></h4>
            <small class="form-label small fw-normal">(optional - yet recommend)</small>
            <a href="#how"
               class="link-offset-1 link-underline link-underline-opacity-0 link-underline-opacity-75-hover small fw-normal">
               Details below</a>
            <div class="form-floating mb-3">
               <input type="number" class="form-control font-monospace border-0 bg-body-secondary rounded-4"
                  id="monthAdvance" placeholder="No. Months in Advance" onChange="calculateWithdrawalLimit()" value="0"
                  min="0" disabled>
               <label for="monthAdvance">No. Months in Advance</label>
            </div>
            <div class="form-floating mb-3">
               <input type="text" class="form-control font-monospace border-0 bg-body-secondary rounded-4"
                  id="allowedAdv" placeholder="Advanced Withdrawal" onChange="calculateWithdrawalLimit()" value="0"
                  disabled>
               <label for="allowedAdv">Advanced BTC Withdrawal</label>
            </div>
            <div class="form-floating mb-3">
               <input type="text" class="form-control font-monospace border-0 bg-body-secondary rounded-4"
                  id="allowedAdvVal" placeholder="Advanced Withdrawal USD" onChange="calculateWithdrawalLimit()"
                  value="0" disabled>
               <label for="allowedAdvVal">Advanced Withdrawal USD</label>
            </div>
         </div>
      </div>
      <div class="row g-3 bg-body-tertiary rounded-bottom-4 p-4 shadow-sm mt-2">
         <h4 class="fw-semibold my-3">Simulation</h4>
         <div class="col-md-6 col-lg-3">
            <p>You can simulate what your portfolio would be like if you had already started this strategy.</p>
            <small>Considering you withdrawal at fixed dates 8th and 22nd each month.</small>
            <div class="form-floating mt-3">
               <input type="date" title="choose a date"
                  class="form-control font-monospace border-0 bg-body-secondary rounded-4" id="simulationDate"
                  min="2010-08-02" onchange="simulateStrategy(this.value)">
               <label for="simulationDate">Start using strategy</label>
            </div>
         </div>
         <div class="col-md-6 col-lg-2">
            <div class="form-floating mb-3">
               <input type="text" class="form-control font-monospace border-0 bg-body-secondary rounded-4"
                  id="currentStash" placeholder="Current Stash" onChange="calculateWithdrawalLimit()" value="0"
                  disabled>
               <label for="allowed">Current Stash</label>
            </div>
            <div class="form-floating mb-3">
               <input type="text" class="form-control font-monospace border-0 bg-body-secondary rounded-4"
                  id="amountWithdrawn" placeholder="Total Amount Withdrawn" onChange="calculateWithdrawalLimit()"
                  value="0" disabled>
               <label for="allowed">Amount Withdrawn (BTC)</label>
            </div>
            <div class="form-floating mb-3">
               <input type="text" class="form-control font-monospace border-0 bg-body-secondary rounded-4"
                  id="totalWithdrawnUSD" placeholder="Total Amount Withdrawn" onChange="calculateWithdrawalLimit()"
                  value="0" disabled>
               <label for="allowed">Amount Withdrawn (USD)</label>
            </div>
         </div>
         <div class="col-md-6 col-lg-4 mt-0">
            <div id="stashChart" class="px-0 mx-0 mt-0"></div>
         </div>
         <div class="col-md-6 col-lg-3  mt-0">
            <div id="radialBar" class="px-0 mx-0 mt-0"></div>
         </div>
      </div>
      </div>


      <article id="how" class="my-6">
         <h3 class="display-5 fw-bold text-center mb-5">How to use the information provided through this tool:
</h3>

         <!-- Presumptions Callout -->
         <div class="bg-body-tertiary p-4 rounded-4 shadow-sm mb-5">
            <h4 class="h5 fw-bold text-primary mb-3">Underlying Presumptions</h4>
            <p class="mb-2">This tool is designed to help individuals, institutions, or developer funds manage their Bitcoin holdings and employ sustainable, volatility-adjusted withdrawal methods.</p>
            <p class="mb-0 text-muted small">Note: This is not a short-term trading tool; it is a long-term capital preservation and budgeting strategy that dynamically adjusts your cash flow based on the 200-week moving average (200-WMA).</p>
         </div>

         <!-- Two Column Layout for Calculator Details -->
         <div class="row g-4">
            <!-- Left Column: BTC Stash Size -->
            <div class="col-lg-6">
               <div class="card bg-body-tertiary border-0 shadow-sm rounded-4 p-4 h-100">
                  <h4 class="h5 fw-bold mb-3"><span class="text-primary me-2">•</span>BTC Stash Size</h4>
                  <p class="text-muted">
                     This represents the total size of your Bitcoin portfolio allocated to this specific withdrawal budget (e.g., a starting amount of 21 BTC for developer grants or personal retirement). 
                     You can allocate all or just a segment of your holdings to this strategy to ensure capital longevity.
                  </p>
               </div>
            </div>

            <!-- Right Column: Annual Withdrawal Rate -->
            <div class="col-lg-6">
               <div class="card bg-body-tertiary border-0 shadow-sm rounded-4 p-4 h-100">
                  <h4 class="h5 fw-bold mb-3"><span class="text-primary me-2">•</span>Annual Withdrawal Rate</h4>
                  <p class="text-muted mb-3">
                     Because the strategy values your stash at the 200-WMA (which is historically close to Bitcoin's macro bottoms), the sustainable rate can be higher than the traditional 4% rule.
                  </p>
                  <ul class="list-group list-group-flush bg-transparent">
                     <li class="list-group-item bg-transparent border-0 px-0 py-2 d-flex align-items-start">
                        <span class="badge bg-success me-2 mt-1">0% - 5%</span>
                        <div class="text-muted"><strong>Growth-Oriented:</strong> Stash size will likely continue to grow rapidly in value.</div>
                     </li>
                     <li class="list-group-item bg-transparent border-0 px-0 py-2 d-flex align-items-start">
                        <span class="badge bg-info me-2 mt-1">6% - 10%</span>
                        <div class="text-muted"><strong>Sustainable:</strong> Standard target ranges. </div>
                     </li>
                     <li class="list-group-item bg-transparent border-0 px-0 py-2 d-flex align-items-start">
                        <span class="badge bg-warning me-2 mt-1">11% - 16%</span>
                        <div class="text-muted"><strong>Aggressive:</strong> Less likely to be sustainable over multi-decade cycles.</div>
                     </li>
                     <li class="list-group-item bg-transparent border-0 px-0 py-2 d-flex align-items-start">
                        <span class="badge bg-danger me-2 mt-1">17%+</span>
                        <div class="text-muted"><strong>Depletion Risk:</strong> High probability of exhausting the portfolio during bear markets.</div>
                     </li>
                  </ul>
               </div>
            </div>
         </div>

         <!-- Row 2: Outputs -->
         <div class="row g-4 mt-2">
            <!-- Left Column: Monthly Limits -->
            <div class="col-lg-6">
               <div class="card bg-body-tertiary border-0 shadow-sm rounded-4 p-4 h-100">
                  <h4 class="h5 fw-bold mb-3"><span class="text-primary me-2">•</span>Monthly Authorized Withdrawal Limits</h4>
                  
                  <div class="bg-body-secondary p-3 font-monospace rounded-3 mb-3 text-center border">
                     Monthly Limit = (Stash Size &times; Annual Rate) &divide; 12
                  </div>
                  
                  <p class="text-muted mb-3">
                     The system dynamically scales your maximum monthly withdrawal allowance based on the current premium or discount of the spot price relative to the 200-WMA:
                  </p>
                  
                  <ul class="list-group list-group-flush bg-transparent">
                     <li class="list-group-item bg-transparent border-0 px-0 py-1 d-flex justify-content-between text-muted">
                        <span>Spot &ge; 25% above 200-WMA</span>
                        <span class="fw-bold text-success">100% Authorized</span>
                     </li>
                     <li class="list-group-item bg-transparent border-0 px-0 py-1 d-flex justify-content-between text-muted">
                        <span>Spot 10% to 25% above 200-WMA</span>
                        <span class="fw-bold text-success-emphasis">90% Authorized</span>
                     </li>
                     <li class="list-group-item bg-transparent border-0 px-0 py-1 d-flex justify-content-between text-muted">
                        <span>Spot 0% to 10% above 200-WMA</span>
                        <span class="fw-bold text-warning-emphasis">85% Authorized</span>
                     </li>
                     <li class="list-group-item bg-transparent border-0 px-0 py-1 d-flex justify-content-between text-muted">
                        <span>Spot 0% to 20% below 200-WMA</span>
                        <span class="fw-bold text-warning">70% Authorized</span>
                     </li>
                     <li class="list-group-item bg-transparent border-0 px-0 py-1 d-flex justify-content-between text-muted">
                        <span>Spot 20% to 30% below 200-WMA</span>
                        <span class="fw-bold text-danger">50% Authorized</span>
                     </li>
                     <li class="list-group-item bg-transparent border-0 px-0 py-1 d-flex justify-content-between text-muted">
                        <span>Spot 30% to 35% below 200-WMA</span>
                        <span class="fw-bold text-danger">40% Authorized</span>
                     </li>
                     <li class="list-group-item bg-transparent border-0 px-0 py-1 d-flex justify-content-between text-muted">
                        <span>Spot &gt; 35% below 200-WMA</span>
                        <span class="fw-bold text-danger">0% (Withdrawals Paused)</span>
                     </li>
                  </ul>
               </div>
            </div>

            <!-- Right Column: Advanced Withdrawals -->
            <div class="col-lg-6">
               <div class="card bg-body-tertiary border-0 shadow-sm rounded-4 p-4 h-100">
                  <h4 class="h5 fw-bold mb-3"><span class="text-primary me-2">•</span>Advanced Withdrawal Option</h4>
                  <p class="text-muted mb-3">
                     When Bitcoin is in a bull market and trading significantly above its 200-WMA, the strategy authorizes you to take multiple months of budget in advance (cashing out during highs to fund future low-budget periods):
                  </p>
                  
                   <ul class="list-group list-group-flush bg-transparent">
                      <li class="list-group-item bg-transparent border-0 px-0 py-1 d-flex justify-content-between text-muted">
                         <span>33% to 66% premium</span>
                         <span class="fw-bold text-success">Current + 1 month</span>
                      </li>
                      <li class="list-group-item bg-transparent border-0 px-0 py-1 d-flex justify-content-between text-muted">
                         <span>66% to 100% premium</span>
                         <span class="fw-bold text-success">Current + 3 months</span>
                      </li>
                      <li class="list-group-item bg-transparent border-0 px-0 py-1 d-flex justify-content-between text-muted">
                         <span>100% to 200% premium</span>
                         <span class="fw-bold text-success">Current + 5 months</span>
                      </li>
                      <li class="list-group-item bg-transparent border-0 px-0 py-1 d-flex justify-content-between text-muted">
                         <span>200% to 400% premium</span>
                         <span class="fw-bold text-success">Current + 11 months</span>
                      </li>
                      <li class="list-group-item bg-transparent border-0 px-0 py-1 d-flex justify-content-between text-muted">
                         <span>400% to 650% premium</span>
                         <span class="fw-bold text-success">Current + 23 months</span>
                      </li>
                      <li class="list-group-item bg-transparent border-0 px-0 py-1 d-flex justify-content-between text-muted">
                         <span>650% to 900% premium</span>
                         <span class="fw-bold text-success">Current + 35 months</span>
                      </li>
                      <li class="list-group-item bg-transparent border-0 px-0 py-1 d-flex justify-content-between text-muted">
                         <span>900% to 1400% premium</span>
                         <span class="fw-bold text-success">Current + 47 months</span>
                      </li>
                      <li class="list-group-item bg-transparent border-0 px-0 py-1 d-flex justify-content-between text-muted">
                         <span>&gt; 1400% premium</span>
                         <span class="fw-bold text-success">Current + 59 months</span>
                      </li>
                   </ul>
               </div>
            </div>
         </div>
      </article>
   </main>
   <footer-component></footer-component>

   <script>
      var callback = function (mutationsList, observer) {
         // Look through all mutations that just occured
         for (let mutation of mutationsList) {
            // If the `data-bs-theme` attribute was modified
            if (mutation.attributeName === 'data-bs-theme') {
               chart.updateOptions({ theme: { mode: localStorage.getItem('theme') } });
               brushChart.updateOptions({ theme: { mode: localStorage.getItem('theme') } });
               stashChart.updateOptions({ theme: { mode: localStorage.getItem('theme') } });
               radialBarChart.updateOptions({ theme: { mode: localStorage.getItem('theme') } });
            }
         }
      };
      var observer = new MutationObserver(callback);
      observer.observe(document.documentElement, { attributes: true, attributeFilter: ['data-bs-theme'] });
   </script>
</body>

</html>