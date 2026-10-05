<!doctype html>
<html lang="en">

<head>
   <?php
   $title = "Bitcoin Fuck You Status Calculator - bitcoin data.science";
   $description = "Calculate the amount of bitcoin needed to reach financial independence and 'Fuck You Status' under different regression models and inflation rates.";
   $keywords = "Bitcoin, Fuck You Status, Fuck you money, Regression, Power Law, Moving Average, 200 Weeks, Inflation, Financial Independence";
   $canonical = "https://bitcoindata.science/fuckyoumoney";
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
   ?>
   <script type="application/ld+json">
      {
         "@context": "https://schema.org",
         "@graph": [{
            "@type": "Organization",
            "name": "Fuck You Status Calculator",
            "description": "Calculate the amount of bitcoin needed to reach 'Fuck You Status' with inflation adjustments and regression models.",
            "alternateName": [
               "bitcoindata.science",
               "Bitcoin Data Science"
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
               "name": "JayJuanGee (JJG)",
               "item": "https://bitcoindata.science/#jjg"
            }, {
               "@type": "ListItem",
               "position": 3,
               "name": "Fuck You Status",
               "item": "https://bitcoindata.science/fuckyoustatus"
            }]
         }, {
            "@type": "FAQPage",
            "mainEntity": [{
               "@type": "Question",
               "name": "How many bitcoins are needed to achieve financial independence?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "The amount of bitcoin needed to achieve financial independence depends on your desired annual income and the withdrawal rate you choose. You can use the calculator to determine the exact amount needed based on your specific circumstances."
               }
            }]
         }]
      }
   </script>
   <script src="modules/crypto-js.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
   <script src="components/fuckyoumoney.js?v=2" defer></script>
</head>

<body>
   <!-- Navbar -->
   <header>
      <navbar-component></navbar-component>
   </header>

   <!-- Page Content -->
   <?php
   $h1 = 'JJG Fuck You Status';
   $h2 = 'Calculate how much Bitcoin you need to reach financial independence. 
      <span class="small"><a href="https://bitcointalk.org/index.php?topic=5376945.msg58719591#msg58719591"
            class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover small fw-semibold"
            title="Reference">by JayJuanGee (JJG)</a> </span>';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>

   <p class="mb-4">
      This tool shows you historical quantities of bitcoin needed to attain certain example wealth target levels, which
      we use $800k, $2 million and $100 million as three example wealth target levels. The $800k (at 10%) and the $2
      million (at 4%) targets presume an $80k per year income level, yet they can be custom-tailored to your own annual
      budget target level.
      <button
         class="btn btn-link p-0 ms-1 align-baseline text-decoration-none fw-semibold link-offset-2 text-primary small"
         type="button" data-bs-toggle="collapse" data-bs-target="#firstPReadMore" aria-expanded="false"
         aria-controls="firstPReadMore" id="readMoreBtn">Read more &darr;</button>
   </p>
   <div class="collapse" id="firstPReadMore">
      <div class="pt-2 d-flex flex-column gap-2">
         <p class="m-0">
            Accordingly, the tool allows you to see how many bitcoin you would have needed to have historically for each
            of those wealth levels (or for your own inputted target levels), and then it also shows you how many bitcoin
            you need to reach financial independence at each of those levels within the coming years or for you to
            customize your own target annual budget level and you can project out up to 60 years.
         </p>
         <p class="m-0">
            The tool also helps you to determine the Bitcoin stash required to fund your life, taking into account
            inflation, withdrawal rates, and to change the variables for the 4% and 10% projections with 3 options of
            long-term price prediction models and two options on presumptions of how the BTC spot price compares with
            the 200-WMA - with a cycling premium or a flat line 30% premium.
         </p>
         <p class="m-0">
            If you want to dive specifically into time-based sustainable withdrawal projections, you can go to the
            <a href="withdrawal-strategy" title="JJG Sustainable Withdrawal Strategy" class="fw-semibold">JJG
               Sustainable Withdrawal Strategy</a> tool to look at historical projected withdrawal outcomes and to
            also look at current recommended withdrawal rates based on both BTC stash size and how conservative,
            moderate or aggressive you want to be with your withdrawal projections.
         </p>
      </div>
   </div>

   <!-- Summary Cards for Today (rendered by JS) -->
   <p class="section-label mt-5 mb-3">Today's Overview</p>
   <div id="summary-cards" class="row row-cols-1 row-cols-lg-4 row-cols-md-2 g-4 pt-lg-3 pb-lg-2"></div>

   <script>
      const SUMMARY_CARDS = [{
         label: 'Bitcoin Price',
         valueId: 'liveSpotPrice',
         color: 'text-body',
         footer: {
            label: 'Current 200-WMA',
            labelId: 'live200WMA',
            sub: 'Current 200-WMA',
         },
      },
      {
         label: '10% Withdrawal Rate',
         valueId: 'todayFU10',
         color: 'text-success',
         tooltip: 'JJG proposes as bitcoin sustainable',
         footer: {
            label: 'Target Portfolio: $800,000',
            labelId: 'todayFU10Desc',
            sub: 'Valued at 200-WMA',
         },
      },
      {
         label: '4% Withdrawal Rate',
         valueId: 'todayFU4',
         color: 'text-info',
         tooltip: 'Recommended level for traditional assets',
         footer: {
            label: 'Target Portfolio: $2,000,000',
            labelId: 'todayFU4Desc',
            sub: 'Valued at 200-WMA',
         },
      },
      {
         label: 'Filthy-Rich Status',
         valueId: 'todayFR',
         color: 'text-purple',
         footer: {
            label: 'Fixed Target: $100,000,000',
            labelId: 'todayFRDesc',
            sub: 'Valued at 200-WMA',
         },
      },
      ];

      document.getElementById('summary-cards').innerHTML = SUMMARY_CARDS.map(card => {
         const spinner = `<span class="spinner-border spinner-border-sm" role="status"></span>`;

         const tooltipHtml = card.tooltip ? `
            <span role="button" class="text-secondary text-lowercase fw-normal ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${card.tooltip}">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
               class="lucide lucide-info preview-icon">
               <circle cx="12" cy="12" r="10" />
               <path d="M12 16v-4" />
               <path d="M12 8h.01" />
            </svg>
            </span>` : '';

         const footerInner = `<div class="card-text text-muted mb-1 small" id="${card.footer.labelId}">${card.footer.label}</div>
               <span class="small text-secondary">${card.footer.sub}</span>`;

         return `
            <div class="col">
               <div class="card bg-body-tertiary shadow-sm h-100 rounded-4">
                  <div class="card-body d-flex flex-column justify-content-between">
                     <div>
                        <div class="card-text text-muted mb-2 section-label">${card.label}${tooltipHtml}</div>
                        <h5 class="card-title display-6 fw-semibold" id="${card.valueId}">${spinner}</h5>
                     </div>
                     <div class="mt-3 pt-3 border-top">${footerInner}</div>
                  </div>
               </div>
            </div>`;
      }).join('');

      const initTooltips = () => {
         if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            [...tooltipTriggerList].forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
         }
      };
      if (document.readyState === 'loading') {
         document.addEventListener('DOMContentLoaded', initTooltips);
      } else {
         initTooltips();
      }
   </script>

   <!-- Controls and Output Area -->
   <div class="row mx-0 mt-4 mb-5 g-4">
      <!-- Input Sidebar -->
      <div class="col-lg-3 pe-lg-4 px-0 col-md-12">
         <div class="bg-body-tertiary rounded-4 p-4 shadow-sm">
            <h4 class="h5 mb-4 section-label">Calculation Controls</h4>

            <!-- Budget Input -->
            <div class="mb-4">
               <label for="annualBudget" class="form-label fw-semibold">Target Annual Budget (USD)</label>
               <div class="input-group mb-2">
                  <span class="input-group-text bg-body-secondary border-0">$</span>
                  <input type="number" class="form-control font-monospace border-0 bg-body-secondary" id="annualBudget"
                     value="80000" min="1000" step="5000">
               </div>
               <input type="range" class="form-range" id="annualBudgetRange" min="1000" max="1001000" step="5000"
                  value="80000">
               <div class="form-text small">Desired annual nominal purchasing power target (today's dollars).</div>
            </div>

            <!-- Inflation Input -->
            <div class="mb-4">
               <label for="inflationRate" class="form-label fw-semibold">Predicted Inflation Rate (%)</label>
               <div class="input-group mb-2">
                  <input type="number" class="form-control font-monospace border-0 bg-body-secondary" id="inflationRate"
                     value="3.0" min="0" max="25" step="0.1">
                  <span class="input-group-text bg-body-secondary border-0">%</span>
               </div>
               <input type="range" class="form-range" id="inflationRateRange" min="0" max="25" step="0.1" value="3.0">
               <div class="form-text small">Inflation will increase your required USD target over time.</div>
            </div>

            <!-- Horizon Input -->
            <div class="mb-4">
               <label for="horizonYears" class="form-label fw-semibold">Projection Horizon</label>
               <div class="input-group mb-2">
                  <input type="number" class="form-control font-monospace border-0 bg-body-secondary" id="horizonYears"
                     value="10" min="10" max="70" step="1">
                  <span class="input-group-text bg-body-secondary border-0">Years</span>
               </div>
               <input type="range" class="form-range" id="horizonYearsRange" min="10" max="70" step="1" value="64">
               <div class="form-text small">Extend predictions up to 2090 (between 10 and 70 years).</div>
            </div>

            <!-- Model Selector -->
            <div class="mb-4">
               <label for="modelSelect" class="form-label fw-semibold">Prediction Model</label>
               <select class="form-select border-0 bg-body-secondary rounded-3" id="modelSelect">
                  <option value="jjg_cycle" selected>JJG Cycle Model (Self-Adjusting)</option>
                  <!-- <option value="bearish_cycle">Bearish Cycle Model (Diminishing Gains)</option>
                  <option value="stable_ratio">Stable Cycle Model</option> -->
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
      </div>

      <!-- Main Content: Tabbed Charts + Table -->
      <div class="col-lg-9 col-md-12">
         <!-- Tabbed Navigation: Charts / Table -->
         <ul class="nav nav-tabs mb-0" id="mainViewTabs" role="tablist">
            <li class="nav-item" role="presentation">
               <button class="nav-link text-body active rounded-top-4" id="table-view-tab" data-bs-toggle="tab"
                  data-bs-target="#tableViewPane" type="button" role="tab" aria-controls="tableViewPane"
                  aria-selected="true">
                  DATA TABLE
               </button>
            </li>
            <li class="nav-item" role="presentation">
               <button class="nav-link text-body rounded-top-4" id="charts-view-tab" data-bs-toggle="tab"
                  data-bs-target="#chartsViewPane" type="button" role="tab" aria-controls="chartsViewPane"
                  aria-selected="false">
                  CHARTS
               </button>
            </li>
         </ul>

         <div class="tab-content bg-body-tertiary rounded-bottom-4 shadow-sm p-4 border-top-0" id="mainViewTabsContent">
            <!-- Charts Tab Pane -->
            <div class="tab-pane fade " id="chartsViewPane" role="tabpanel" aria-labelledby="charts-view-tab">
               <!-- Sub-tabs for chart types -->
               <ul class="nav nav-pills mb-3 justify-content-end" id="chartTabs" role="tablist">
                  <li class="nav-item" role="presentation">
                     <button class="nav-link active me-2" id="price-tab" data-bs-toggle="pill"
                        data-bs-target="#priceChartContainer" type="button" role="tab"
                        aria-controls="priceChartContainer" aria-selected="true">
                        Price Projection
                     </button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="coins-tab" data-bs-toggle="pill" data-bs-target="#coinsChartContainer"
                        type="button" role="tab" aria-controls="coinsChartContainer" aria-selected="false">
                        Coins Needed
                     </button>
                  </li>
               </ul>

               <div class="tab-content" id="chartTabsContent">
                  <!-- Price Chart Tab -->
                  <div class="tab-pane fade show active" id="priceChartContainer" role="tabpanel"
                     aria-labelledby="price-tab">
                     <h5 class="text-center mb-2">Bitcoin Price & 200WMA Predictions</h5>
                     <div class="row justify-content-between mb-2">
                        <div class="col-auto">
                           <span class="small border-1 px-2 border-end" onClick="priceChartPeriod(-30)"><a
                                 href="javascript:void(0);" class="pointer">1M</a></span>
                           <span class="small border-1 px-2 border-end" onClick="priceChartPeriod(-180)"><a
                                 href="javascript:void(0);" class="pointer">6M</a></span>
                           <span class="small border-1 px-2 border-end" onClick="priceChartPeriod(-365)"><a
                                 href="javascript:void(0);" class="pointer">1Y</a></span>
                           <span class="small border-1 px-2 border-end" onClick="priceChartPeriod(-1825)"><a
                                 href="javascript:void(0);" class="pointer">5Y</a></span>
                           <span class="small border-1 px-2 border-end" onClick="priceChartPeriod(-3650)"><a
                                 href="javascript:void(0);" class="pointer">10Y</a></span>
                           <span class="small border-1 px-2" onClick="priceChartPeriod()"><a href="javascript:void(0);"
                                 class="pointer link-secondary border-bottom border-3">ALL</a></span>
                        </div>
                        <div class="col-auto form-check gx-1">
                           <input class="form-check-input" type="checkbox" checked id="linLog"
                              onchange="togglePriceLogScale();">
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

            <!-- Data Table Tab Pane -->
            <div class="tab-pane show active" id="tableViewPane" role="tabpanel" aria-labelledby="table-view-tab">
               <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                  <div>
                     <h4 class="section-label mb-1">Semi-Annual Projection Data</h4>
                     <p class="text-muted small mb-0" id="tableSubtitle">Adjusted starting from today's actual price</p>
                  </div>
               </div>

               <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                  <table class="table table-sm table-borderless table-hover align-middle small" id="projectionsTable">
                     <thead class="sticky-top bg-body-tertiary border-0">
                        <tr class="text-nowrap text-center">
                           <th class="fw-semibold text-body-secondary">Date</th>
                           <th class="fw-semibold text-body-secondary">Spot</th>
                           <th class="fw-semibold text-body-secondary">200 WMA</th>
                           <th class="fw-semibold text-body-secondary">% Gain / Time</th>
                           <th class="fw-semibold text-body-secondary">200 WMA Premium</th>
                           <th class="fw-semibold text-body-secondary">Coins (10% FU)</th>
                           <th class="fw-semibold text-body-secondary">Coins (4% FU)</th>
                           <th class="fw-semibold text-body-secondary">Coins (Filthy-Rich)</th>
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
         </div>
         <div class="mt-2">
            <button type="button" class="btn btn-outline-secondary mb-1" id="shareBtn" onclick="saveAndShare()"
               title="Share this calculation">
               <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="48 -912 864 864" width="18px"
                  fill="currentColor" class="me-2">
                  <path
                     d="M648-96q-50 0-85-35t-35-85q0-9 4-29L295-390q-16 14-36.05 22-20.04 8-42.95 8-50 0-85-35t-35-85q0-50 35-85t85-35q23 0 43 8t36 22l237-145q-2-7-3-13.81-1-6.81-1-15.19 0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35q-23 0-43-8t-36-22L332-509q2 7 3 13.81 1 6.81 1 15.19 0 8.38-1 15.19-1 6.81-3 13.81l237 145q16-14 36.05-22 20.04-8 42.95-8 50 0 85 35t35 85q0 50-35 85t-85 35q-23 0-43-8t-36-22L332-509q2 7 3 13.81 1 6.81 1 15.19 0 8.38-1 15.19-1 6.81-3 13.81l237 145q16-14 36.05-22 20.04-8 42.95-8 50 0 85 35t35 85q0 50-35 85t-85 35q-23 0-43-8t-36-22L332-509q2 7 3 13.81 1 6.81 1 15.19 0 8.38-1 15.19-1 6.81-3 13.81l237 145q16-14 36.05-22 20.04-8 42.95-8 50 0 85 35t35 85q0 50-35 85t-85 35Zm0-72q20.4 0 34.2-13.8Q696-195.6 696-216q0-20.4-13.8-34.2Q668.4-264 648-264q-20.4 0-34.2 13.8Q600-236.4 600-216q0 20.4 13.8 34.2Q627.6-168 648-168ZM216-432q20.4 0 34.2-14 13.8-14 13.8-34t-13.8-34q-13.8-14-34.2-14-20.4 0-34.2 14-13.8 14-13.8 34t13.8 34q13.8 14 34.2 14Zm466-277.8q14-13.8 14-34.2 0-20.4-13.8-34.2Q668.4-792 648-792q-20.4 0-34.2 13.8Q600-764.4 600-744q0 20.4 14 34.2 14 13.8 34 13.8t34-13.8ZM648-216ZM216-480Zm432-264Z" />
               </svg>Share
            </button>
            <button class="btn btn-outline-secondary mb-1" onclick="exportTableToCSV()"
               title="Export projections to CSV">
               <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="48 -912 864 864" width="18px"
                  fill="currentColor" class="me-2">
                  <path
                     d="M480-336 288-528l51-51 105 105v-342h72v342l105-105 51 51-192 192ZM263.72-192Q234-192 213-213.15T192-264v-72h72v72h432v-72h72v72q0 29.7-21.16 50.85Q725.68-192 695.96-192H263.72Z" />
               </svg>CSV
            </button>
         </div>
         <!-- Share options container -->
         <div id="shareContainer" class="w-100 my-2 d-none">
            <div class="p-3 rounded-4 bg-body-tertiary border border-opacity-10 shadow-sm">
               <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="section-label text-body-secondary">Share Calculation</span>
                  <button type="button" class="btn-close btn-close-sm"
                     onclick="document.getElementById('shareContainer').classList.add('d-none')"
                     aria-label="Close"></button>
               </div>

               <!-- Option 1: Permalink -->
               <div class="mb-3">
                  <label for="shareUrl" class="text-body-secondary small fw-medium mb-1 d-block">Permalink</label>
                  <div class="input-group">
                     <input type="text" id="shareUrl"
                        class="form-control form-control-sm font-monospace-sm bg-body border-0" readonly
                        onclick="this.select()">
                     <button class="btn btn-primary btn-sm px-3" type="button" id="copyShareBtn"
                        onclick="copyShareUrl('shareUrl', 'copyShareBtn')">Copy Link</button>
                  </div>
               </div>

               <!-- Option 2: BBCode for Forums -->
               <div>
                  <label for="shareBbcode" class="text-body-secondary small fw-medium mb-1 d-block">BBCode
                     (Forums)</label>
                  <div class="input-group">
                     <input type="text" id="shareBbcode"
                        class="form-control form-control-sm font-monospace-sm bg-body border-0" readonly
                        onclick="this.select()">
                     <button class="btn btn-secondary btn-sm px-3" type="button" id="copyBbcodeBtn"
                        onclick="copyShareUrl('shareBbcode', 'copyBbcodeBtn')">Copy BBCode</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/components/jjg-disclaimer.php'; ?>

   <article class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm mt-5 mb-5">

      <p class="section-label mb-4">Understanding the Calculations</p>

      <div class="row g-4 g-lg-5 mb-4">
         <div class="col-lg-6">
            <h2 class="h5 fw-bold mb-3">What is <span class="text-muted">"Fuck You Status"?</span></h2>
            <p class="mb-3">
               In personal finance, "Fuck You Status" is reaching a wealth status in which you are able to live
               comfortably at your targeted income level without being dependent on employment or external funding.
            </p>
            <p class="mb-3">
               In bitcoin, we can attempt to calculate what we believe to be our fuck you status level in a way that we
               are able to either completely discontinue working or alternatively we could calculate a level of income
               that we would like to get from our bitcoin in order to supplement any other income that we might have.
            </p>
            <p class="mb-3">
               The amount could be replacing some portion of your current income level, or it could be replacing your
               actual income level or multiples of your current income level or it could be some other self-chosen
               income level that you would like to reach so that you don't have to work any more or rely on external
               funding and perhaps you would like to live a certain standard of living that is higher than your current
               one.
            </p>
            <p class="mb-3">
               By incorporating the <strong>200-week moving average (200WMA)</strong> as a valuation anchor, we attempt
               to take our valuation out of the noice of Bitcoin's seemingly inevitable high volatility. Because the
               200WMA has historically acted as a relatively reliable macro-cycle bottom, drawing withdrawals (and
               valuating BTC holdings) against the 200WMA seems to provide greater potential for sustainable long-term
               budgeting and planning.
            </p>
         </div>

         <div class="col-lg-6">
            <h5 class="h5 fw-bold mb-3">Inflation and Purchasing Power</h5>
            <p>
               Since we use $80k per year as a default reference income point, we like to consider how many BTC a
               bitcoiner might need in order to support such income level at any time, and of course, you can adjust the
               annual dollar amount that you feel that you might want/need.
            </p>
            <p>
               For example, if you require a <strong>$80,000 annual budget</strong> in today's dollars, a constant 3.0%
               annual inflation rate means that in 10 years, you will need <strong>$107,513</strong> in nominal dollars
               for that year, and in 20 years, you will need $144,489 nominal dollars in that year to purchase the same
               goods/services in that year.
            </p>
            <p>
               In accordance with the example, if we are presuming an ability to continue to live at the same standard
               of living and we are desiring to not deplete our bitcoin holdings, then our bitcoin would need to
               appreciate on average at least at the same rate that we are withdrawing value from it in order to
               continue to be able to sustain an adequate amount of income in subsequent years. Accordingly, when we are
               going through sustainable withdrawal, our goal is to not deplete our bitcoin faster than it is
               appreciating, even though at any time, we could decide to take ourselves out of sustainable withdrawal
               and to deplete our bitcoin holdings at a rate that is no longer sustainable.
            </p>
            <p>
               This tool adjusts your required nominal portfolios dynamically. Consequently, if Bitcoin's price
               appreciation outpaces inflation, the absolute number of Bitcoins you need to hold decreases dramatically
               over time.
            </p>
         </div>
      </div>
   </article>

   <!-- JJG Model Description -->
   <article class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm mb-5">

      <p class="section-label mb-4">The Prediction Models</p>

      <div class="row g-4 g-lg-5 mb-4">
         <div class="col-lg-6">
            <h2 class="h5 fw-bold mb-3">200WMA <span class="text-secondary">Semi-Annual Compounding</span></h2>
            <p>
               The 200-week moving average (200WMA) <strong>and the BTC Spot price</strong> is projected forward using a
               semi-annual compounding model. Starting from the last known historical 200WMA value, each 6-month period
               applies a percentage gain:
            </p>
            <div class="bg-body-secondary rounded-3 p-3 font-monospace small mb-3">
               WMA<sub>n+1</sub> = WMA<sub>n</sub> &times; (1 + g<sub>n</sub> / 100)
            </div>
            <p>
               where gn is the gain for the n-th semi-annual period. These gains are derived from a lookup table
               (<strong>from the %Gain/Time values in the table</strong>) that reflects <strong>JJG projections</strong>
               of Bitcoin's halving-cycle dynamics — the pattern of accelerating growth in the first half of each
               ~4-year cycle followed by decelerating growth in the second half.
            </p>
         </div>

         <div class="col-lg-6">
            <h2 class="h5 fw-bold mb-3">Halving <span class="text-secondary">Cycle Structure</span></h2>
            <p>
               Each halving cycle spans 8 semi-annual periods (~4 years). The gain table encodes this pattern: the first
               4 periods carry higher growth (bullish phase), while the last 4 carry lower growth (consolidation phase).
               Across successive cycles, peak gains diminish — reflecting the empirical observation that each cycle's
               returns moderate as Bitcoin's market capitalization grows.
            </p>
            <p>
               Beyond the explicitly defined cycles (past 2039), gains are self-adjusting: each cycle's base gain
               decreases by 1% until reaching a permanent floor. The formulas are:
            </p>
            <div class="bg-body-secondary rounded-3 p-3 font-monospace small mb-3">
               g<sub>bull</sub> = max(4, 11 &minus; n) &nbsp;&nbsp; g<sub>bear</sub> = max(3, 8 &minus; n)
            </div>
            <p class="text-muted small">
               where <span class="font-monospace">n</span> is the cycle offset from Cycle 5. Within each phase, bull
               gains escalate +2% per step and bear gains decay &minus;5% per step. The gains decrease by ~1% per cycle
               until reaching a repeating floor of 4%/3% (bull/bear) — representing Bitcoin's mature, steady-state
               growth.
            </p>
         </div>
      </div>

      <div class="row g-4 g-lg-5 mb-4">
         <div class="col-lg-6">
            <h2 class="h5 fw-bold mb-3">Three <span class="text-secondary">Model Variants</span></h2>
            <p>The tool offers three prediction models, each applying a different scaling factor to the base JJG gain
               table:</p>
            <table class="table table-sm table-borderless small mb-3">
               <thead>
                  <tr class="border-bottom">
                     <th class="fw-semibold text-body-secondary">Model</th>
                     <th class="fw-semibold text-body-secondary">Multiplier</th>
                     <th class="fw-semibold text-body-secondary">Rationale</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td class="fw-semibold">JJG Cycle</td>
                     <td class="font-monospace">1.0&times;</td>
                     <td>Full self-adjusting gains as proposed by JayJuanGee</td>
                  </tr>
                  <tr>
                     <td class="fw-semibold">Bearish Cycle</td>
                     <td class="font-monospace">0.7&times;</td>
                     <td>30% haircut — models diminishing returns more aggressively</td>
                  </tr>
                  <tr>
                     <td class="fw-semibold">Stable Cycle</td>
                     <td class="font-monospace">0.2&times;</td>
                     <td>80% reduction — conservative floor-case scenario</td>
                  </tr>
               </tbody>
            </table>
            <p class="text-muted small mb-0">
               In all cases: <span class="font-monospace">g<sub>model</sub> = g<sub>JJG</sub> &times; multiplier</span>
            </p>
         </div>

         <div class="col-lg-6">
            <h2 class="h5 fw-bold mb-3">Spot Price <span class="text-secondary">Premium</span></h2>
            <p>
               Bitcoin's spot price typically oscillates around the 200WMA. Two assumptions are available:
            </p>
            <p>
               <strong>Fixed Premium</strong> — a constant 30% premium above the projected 200WMA:
            </p>
            <div class="bg-body-secondary rounded-3 p-3 font-monospace small mb-3">
               Spot = WMA &times; 1.30
            </div>
            <p>
               <strong>Cyclical Premium</strong> — a sine-wave oscillation synchronized to the ~4-year halving cycle,
               ranging from approximately &minus;30% (cycle bottom) to +102% (cycle top):
            </p>
            <div class="bg-body-secondary rounded-3 p-3 font-monospace small mb-3">
               Spot = WMA &times; [1.36 + 0.66 &times; sin(2&pi; &times; &phi;)]
            </div>
            <p class="text-muted small">
               where <span class="font-monospace">&phi; = (years mod 4) / 4</span> is the normalized cycle phase. At
               &phi;&nbsp;=&nbsp;0.25 (cycle peak), the multiplier reaches ≈2.02; at &phi;&nbsp;=&nbsp;0.75 (cycle
               bottom), it drops to ≈0.70.
            </p>
         </div>
      </div>

      <div class="row g-4 g-lg-5">
         <div class="col-lg-12">
            <h2 class="h5 fw-bold mb-3">Coins Needed <span class="text-secondary">Formula</span></h2>
            <p>
               Given a target annual budget <strong>B</strong>, a withdrawal rate <strong>r</strong>, an inflation rate
               <strong>i</strong>, and the projected 200WMA at year <strong>t</strong>:
            </p>
            <div class="bg-body-secondary rounded-3 p-3 font-monospace small mb-3">
               BTC needed = (B / r) &times; (1 + i)<sup>t</sup> &frasl; WMA<sub>t</sub>
            </div>
            <p>
               The numerator <span class="font-monospace">(B / r) &times; (1 + i)<sup>t</sup></span> is the
               inflation-adjusted portfolio target in nominal USD. Dividing by the projected 200WMA converts this to the
               number of Bitcoins required. As the 200WMA grows faster than inflation, the BTC needed decreases over
               time — this is the core insight of the model.
            </p>
            <p class="text-muted small mb-0">
               <strong>Filthy-Rich status</strong> uses a $100,000,000 baseline target adjusted for inflation over time,
               representing an ultra-high-net-worth purchasing power benchmark.
            </p>
         </div>
      </div>

   </article>

   </main>
   <footer-component></footer-component>

   <script>
      // Listen for theme mutations to update ApexCharts colors
      var callback = function (mutationsList, observer) {
         // Look through all mutations that just occured
         for (let mutation of mutationsList) {
            // If the `data-bs-theme` attribute was modified
            if (mutation.attributeName === 'data-bs-theme') {
               recalculate();
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