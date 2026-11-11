<!doctype html>
<html lang="en">

<head>
   <?php
   $title = "Bitcointalk Browser Extension | Live BTC Hover Cards & Address Monitor";
   $description = "Official bitcoindata.science browser extension for Bitcointalk and AltcoinsTalks. Hover over Bitcoin addresses and transactions for live data, insert BBCode price images, and monitor your BTC address in the sidebar.";
   $keywords = "Bitcointalk browser extension, Bitcoin browser extension, Bitcointalk hover balance, Bitcointalk BBCode toolbar, Bitcoin address monitor extension, AltcoinsTalks extension, bitcoindata extension";
   $canonical = "https://bitcoindata.science/browser-extension";
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
   ?>
   <script type="application/ld+json">
      {
         "@context": "https://schema.org",
         "@graph": [{
            "@type": "SoftwareApplication",
            "name": "bitcoindata Browser Extension",
            "description": "Browser extension for Bitcointalk.org and AltcoinsTalks.com featuring live address and transaction hover cards, a BBCode post editor toolbar, right-click context menu lookup, and a sidebar Bitcoin address monitor.",
            "url": "https://bitcoindata.science/browser-extension",
            "applicationCategory": "BrowserApplication",
            "operatingSystem": "Windows, macOS, Linux",
            "softwareVersion": "0.3",
            "license": "https://opensource.org/licenses/MIT",
            "offers": {
               "@type": "Offer",
               "price": "0",
               "priceCurrency": "USD"
            },
            "author": {
               "@type": "Organization",
               "name": "bitcoin data.science",
               "url": "https://bitcoindata.science"
            },
            "sameAs": [
               "https://addons.mozilla.org/en-US/firefox/addon/bitcointalk-data-extension/",
               "https://microsoftedge.microsoft.com/addons/detail/bitcointalk-data-extensio/gcndngnnhncdblgfcbgefmhginmmjfde",
               "https://github.com/bitmover-studio/bitcoindata-extension"
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
               "name": "Forum Tools",
               "item": "https://bitcoindata.science/#forum-tools"
            }, {
               "@type": "ListItem",
               "position": 3,
               "name": "Browser Extension",
               "item": "https://bitcoindata.science/browser-extension"
            }]
         }, {
            "@type": "FAQPage",
            "mainEntity": [{
               "@type": "Question",
               "name": "What does the bitcoindata browser extension do?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "The bitcoindata extension enhances Bitcointalk.org and AltcoinsTalks.com in four ways: (1) hovering over any Bitcoin address or transaction ID in posts or profiles displays a native forum card with live balance or transaction details, (2) a BBCode toolbar above the forum post editor lets you insert dynamic price, balance, transaction, and fee images in one click, (3) a popup and browser sidebar let you monitor a Bitcoin address with 20-minute background alerts, and (4) a right-click context menu lets you inspect or monitor any highlighted Bitcoin address on any website."
               }
            }, {
               "@type": "Question",
               "name": "How does the forum hover feature work on Bitcointalk and AltcoinsTalks?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "When browsing threads, user profile pages, personal messages, or signatures on Bitcointalk.org or AltcoinsTalks.com, the extension automatically detects Bitcoin addresses (P2PKH, P2SH, bech32, and Taproot bech32m) and 64-character transaction IDs. Hovering your cursor over an address or TXID opens a classic SMF-styled card showing live confirmed and unconfirmed balances, USD values, fee rates, and transaction inputs and outputs."
               }
            }, {
               "@type": "Question",
               "name": "Can I open the extension in my browser's side panel?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Yes. Just like MetaMask or Phantom, you can open bitcoindata either as a compact toolbar popup or docked inside your browser's side panel (supported in Chrome, Brave, Edge, and Firefox). Click the sidebar icon in the extension header or choose 'Check balance in bitcoindata sidebar' from the right-click context menu."
               }
            }, {
               "@type": "Question",
               "name": "Why does the extension monitor a single address while the website checks up to 465?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "The extension is designed as a lightweight background companion to watch your primary address and send desktop notifications every 20 minutes without hitting API rate limits. When you need to check multiple wallets (up to 465 addresses at once), scan QR codes, or export CSV and JSON reports, you can jump straight to the full web Balance Checker on bitcoindata.science."
               }
            }, {
               "@type": "Question",
               "name": "How do I install on Chrome or Brave using Greasy Fork?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Greasy Fork is a popular open-source repository for browser userscripts. To use bitcoindata on Chrome, Brave, Vivaldi, or Opera, first install a userscript manager extension such as Tampermonkey or Violentmonkey, then open our Greasy Fork script page and click 'Install this script'. It adds the live Bitcoin address and transaction hover cards and BBCode post toolbar directly to Bitcointalk.org and AltcoinsTalks.com."
               }
            }, {
               "@type": "Question",
               "name": "Is the extension open-source and private?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Yes. The extension is 100% open-source under the MIT License. Your monitored address and preferences are saved exclusively in your local browser storage and are never sent to any central database. Blockchain lookups query mempool.space directly from your browser."
               }
            }]
         }]
      }
   </script>
   <style>
      /* Bootstrap carousel: bottom padding for indicators, dark controls on the light mockup */
      .smf-carousel .carousel-item {
         padding-bottom: 2.5rem;
      }

      .smf-carousel .carousel-indicators {
         margin-bottom: 0;
      }

      .smf-carousel .carousel-indicators [data-bs-target] {
         background-color: #476C8E;
      }

      .smf-carousel .carousel-control-prev,
      .smf-carousel .carousel-control-next {
         width: 8%;
      }

      .smf-carousel .carousel-control-prev-icon,
      .smf-carousel .carousel-control-next-icon {
         filter: invert(1) grayscale(1) brightness(0.3);
      }

      /* Mockup of the Bitcointalk SMF .catbg3 hover card for live demonstration */
      .smf-demo-post {
         background-color: #ECEDF3;
         color: #000000;
         border: 1px solid #696969;
         font-family: Verdana, Arial, Helvetica, sans-serif;
         font-size: 12px;
         line-height: 1.5;
      }

      .smf-demo-addr {
         border-bottom: 1px dotted #476C8E;
         color: #476C8E;
         font-family: Consolas, "Courier New", monospace;
         font-weight: 700;
      }

      .smf-hover-preview {
         background: #ECEDF3;
         color: #1A1A1A;
         border: 1px solid #696969;
         box-shadow: inset 0 0 0 1px #FFFFFF, 0 8px 24px rgba(0, 0, 0, 0.22);
         font-family: Verdana, Arial, Helvetica, sans-serif;
         font-size: 11.5px;
         width: 100%;
         max-width: 360px;
         flex: 1;
         display: flex;
         flex-direction: column;
      }

      .smf-hover-body {
         padding: 10px 12px 12px;
         flex: 1;
         display: flex;
         flex-direction: column;
      }

      .smf-unconfirmed-row {
         padding: 4px 8px;
         border-radius: 2px;
         border: 1px solid #B45309;
         background: #FEF3C7;
         color: #B45309;
         font-family: Consolas, "Courier New", monospace;
         font-size: 10.5px;
         display: flex;
         justify-content: space-between;
      }

      .smf-hover-header {
         background: linear-gradient(180deg, #9BB6CF 0%, #7193B2 100%);
         color: #FFFFFF;
         border-bottom: 1px solid #375576;
         padding: 5px 10px;
         font-size: 11px;
         font-weight: bold;
         display: flex;
         align-items: center;
         justify-content: space-between;
      }

      .smf-hover-pill {
         padding: 1px 6px;
         border: 1px solid rgba(255, 255, 255, 0.45);
         border-radius: 2px;
         font-size: 10px;
         background: rgba(255, 255, 255, 0.18);
         color: #FFFFFF;
         text-transform: uppercase;
      }

      .smf-hover-surface {
         background: #F6F6F6;
         border: 1px solid #C8CCD8;
         border-radius: 2px;
      }

      .smf-hover-btn {
         background: #476C8E;
         color: #FFFFFF;
         border: 1px solid #476C8E;
         border-radius: 2px;
         font-weight: bold;
         font-size: 11px;
         padding: 5px 10px;
         width: 100%;
         text-align: center;
         margin-top: auto;
      }

      .smf-icon-btn {
         background: #F6F6F6;
         border: 1px solid #B0B7C6;
         color: #476C8E;
         border-radius: 2px;
         padding: 1px 6px;
         font-family: Verdana, Arial, sans-serif;
         font-size: 10px;
         font-weight: 700;
         white-space: nowrap;
      }

      .smf-io-title {
         font-size: 10px;
         font-weight: 700;
         text-transform: uppercase;
         color: #476C8E;
         margin-bottom: 3px;
      }

      .smf-io-row {
         display: flex;
         justify-content: space-between;
         align-items: baseline;
         gap: 8px;
         font-family: Consolas, "Courier New", monospace;
         font-size: 10.5px;
         color: #333333;
      }

      .smf-carousel-nav .btn {
         font-size: 0.8rem;
         font-weight: 600;
      }

      .gf-browser-pill {
         display: inline-flex;
         align-items: center;
         gap: 4px;
         padding: 2px 6px;
         margin-left: 2px;
         border-radius: 999px;
         background: rgba(128, 128, 128, 0.12);
         border: 1px solid rgba(128, 128, 128, 0.22);
      }

      .gf-browser-pill img {
         display: block;
         transition: transform 0.2s ease;
      }

      .btn:hover .gf-browser-pill img {
         transform: scale(1.1);
      }
   </style>
</head>

<body>
   <!-- Navbar -->
   <header>
      <navbar-component></navbar-component>
   </header>

   <!-- Page Content -->
   <?php
   $h1 = 'Bitcointalk <span class="hero-title-accent">Browser Extension</span>';
   $h2 = 'Hover over addresses and transactions on Bitcointalk &amp; AltcoinsTalks for live blockchain data, insert dynamic BBCode images, and monitor your Bitcoin address from your browser sidebar.';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>

   <!-- Store Download Bar -->
   <section class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm mb-5">
      <div class="row align-items-center justify-content-between g-4">
         <div class="col-12 col-xl-5">
            <p class="section-label mb-2">Free &amp; Open Source</p>
            <h3 class="h4 fw-bold mb-2">Install for your browser</h3>
            <p class="text-body-secondary small mb-0">
               Full extension for <strong>Firefox, Tor Browser, and Edge</strong>, or install our <strong>Greasy
                  Fork</strong>
               userscript for <strong>Chrome, Brave</strong>, and other browsers.
            </p>
         </div>
         <div class="col-12 col-xl-7">
            <div class="d-flex flex-wrap gap-2 justify-content-xl-end">
               <a href="https://addons.mozilla.org/en-US/firefox/addon/bitcointalk-data-extension/"
                  class="btn btn-outline-secondary px-3 py-2 d-inline-flex align-items-center gap-2 text-decoration-none"
                  target="_blank" rel="noopener" title="Install on Mozilla Firefox and Tor Browser">
                  <img src="/img/firefox.svg" alt="Firefox" width="24" height="24">
                  <img src="/img/tor.svg" alt="Tor Browser" width="24" height="24">
                  <span>Firefox / Tor</span>
               </a>
               <a href="https://microsoftedge.microsoft.com/addons/detail/bitcointalk-data-extensio/gcndngnnhncdblgfcbgefmhginmmjfde"
                  class="btn btn-outline-secondary px-3 py-2 d-inline-flex align-items-center gap-2 text-decoration-none"
                  target="_blank" rel="noopener" title="Install on Microsoft Edge">
                  <img src="/img/edge.svg" alt="Edge Add-ons" width="24" height="24">
                  <span>Edge</span>
               </a>
               <a href="https://greasyfork.org/en/scripts/604804-bitcoindata-extension"
                  class="btn btn-outline-secondary px-3 py-2 d-inline-flex align-items-center gap-2 text-decoration-none"
                  target="_blank" rel="noopener"
                  title="Install Userscript via Greasy Fork for Chrome, Brave &amp; more">
                  <img src="/img/greasy-fork.png" alt="Greasy Fork" width="24" height="24">
                  <span>Greasy Fork</span>
                  <span class="gf-browser-pill" aria-hidden="true">
                     <img src="/img/chrome.svg" alt="Chrome" width="24" height="24">
                     <img src="/img/brave.svg" alt="Brave" width="24" height="24">
                  </span>
               </a>
               <a href="https://github.com/bitmover-studio/bitcoindata-extension"
                  class="btn btn-outline-secondary px-3 py-2 d-inline-flex align-items-center gap-2 text-decoration-none"
                  target="_blank" rel="noopener" title="View source code on GitHub">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                     viewBox="0 0 16 16">
                     <path
                        d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                  </svg>
                  <span>GitHub</span>
               </a>
            </div>
         </div>
      </div>

      <!-- Greasy Fork Explanation for Chrome / Brave -->
      <div
         class="border-top border-secondary border-opacity-25 mt-4 pt-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 small text-body-secondary">
         <div class="d-flex align-items-start align-items-md-center gap-2">
            <span class="d-inline-flex align-items-center gap-1 flex-shrink-0 mt-1 mt-md-0">
               <img src="/img/chrome.svg" alt="Chrome" width="24" height="24">
               <img src="/img/brave.svg" alt="Brave" width="24" height="24">
            </span>
            <span>
               <strong>Using Chrome or Brave?</strong> <a
                  href="https://greasyfork.org/en/scripts/604804-bitcoindata-extension" target="_blank" rel="noopener"
                  class="fw-semibold">Greasy Fork</a> is an open-source userscript repository. Install a script manager
               like <a href="https://www.tampermonkey.net/" target="_blank" rel="noopener">Tampermonkey</a> or <a
                  href="https://violentmonkey.github.io/" target="_blank" rel="noopener">Violentmonkey</a>, then click
               <strong>Greasy Fork</strong> above to add the Bitcointalk hover cards and BBCode toolbar in one click.
            </span>
         </div>
      </div>
   </section>

   <!-- Feature 1: Native Forum Hover Cards + Interactive Preview -->
   <section class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm mb-5">
      <div class="row align-items-center g-4 g-lg-5">
         <div class="col-12 col-lg-6">
            <p class="section-label mb-2">Bitcointalk &amp; AltcoinsTalks</p>
            <h2 class="h3 fw-bold mb-3">Instant Hover Cards on Forum Pages</h2>
            <p class="text-body-secondary mb-3">
               No more copying addresses or transaction IDs into a block explorer tab. While reading threads, user
               profiles, personal messages, or signatures on <strong>bitcointalk.org</strong> and
               <strong>altcoinstalks.com</strong>, simply hover over any Bitcoin address or <code>TXID</code>.
            </p>
            <ul class="list-unstyled d-grid gap-2 small text-body-secondary mb-0">
               <li class="d-flex align-items-start gap-2">
                  <span class="text-primary fw-bold">✓</span>
                  <span><strong>Address Hover:</strong> Confirmed &amp; unconfirmed BTC balance, USD equivalent, total
                     received, transaction count, and 1-click tracking.</span>
               </li>
               <li class="d-flex align-items-start gap-2">
                  <span class="text-primary fw-bold">✓</span>
                  <span><strong>Transaction Hover:</strong> Confirmation status &amp; block height, total output value,
                     fee &amp; fee rate (<code>sat/vB</code>), and scrollable inputs/outputs (including Coinbase &amp;
                     decoded <code>OP_RETURN</code>).</span>
               </li>
               <li class="d-flex align-items-start gap-2">
                  <span class="text-primary fw-bold">✓</span>
                  <span><strong>Native Forum Aesthetics:</strong> Styled with Bitcointalk's
                     header and colors surfaces so it blends in like a built-in forum feature.</span>
               </li>
            </ul>
         </div>

         <!-- Interactive Carousel of the SMF Address & Transaction Hover Cards -->
         <div class="col-12 col-lg-6">
            <!-- Bootstrap 5.3 carousel: indicators + slides + controls -->
            <div id="hoverFeatureCarousel" class="carousel slide smf-carousel" data-bs-ride="carousel"
               data-bs-interval="6000">
               <div class="carousel-indicators">
                  <button type="button" data-bs-target="#hoverFeatureCarousel" data-bs-slide-to="0" class="active"
                     aria-current="true" aria-label="Address hover"></button>
                  <button type="button" data-bs-target="#hoverFeatureCarousel" data-bs-slide-to="1"
                     aria-label="Transaction hover"></button>
               </div>
               <div class="carousel-inner">
                  <!-- Slide 1: Address Hover Preview -->
                  <div class="carousel-item active">
                     <div class="smf-demo-post p-3 rounded-1">
                        <div class="mb-2 small" style="color:#476C8E; font-weight:bold;">
                           Re: Escrow address &amp; payout verification
                        </div>
                        <p class="mb-3 text-truncate">
                           Funds held at <span class="smf-demo-addr">1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa</span>
                        </p>

                        <div class="smf-hover-preview mx-auto">
                           <div class="smf-hover-header">
                              <span>bitcoindata.science</span>
                              <span class="smf-hover-pill">Address</span>
                           </div>
                           <div class="smf-hover-body">
                              <div
                                 class="smf-hover-surface d-flex justify-content-between align-items-center px-2 py-1 mb-2"
                                 style="font-family: Consolas, monospace; font-size: 11px;">
                                 <span class="text-truncate me-2">1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa</span>
                                 <span class="d-inline-flex gap-1">
                                    <span class="smf-icon-btn">Copy</span>
                                    <span class="smf-icon-btn">mempool ↗</span>
                                 </span>
                              </div>
                              <div class="smf-hover-surface p-2 mb-2">
                                 <div style="font-family: Consolas, monospace; font-size: 15px; font-weight: 700;">
                                    104.42195108 <span style="font-size: 11px; color: #5A6270;">BTC</span>
                                 </div>
                                 <div style="color: #476C8E; font-weight: 700; font-size: 12px;">$9,815,663.40</div>
                              </div>
                              <div class="smf-unconfirmed-row mb-2">
                                 <span>Unconfirmed</span>
                                 <span>+0.02500000 BTC ($2,350.00)</span>
                              </div>
                              <div class="row g-2 mb-2">
                                 <div class="col-6">
                                    <div class="smf-hover-surface p-2">
                                       <div style="font-size: 10px; color: #5A6270;">Total received</div>
                                       <div
                                          style="font-family: Consolas, monospace; font-size: 11px; font-weight: 700;">
                                          104.42195108 BTC</div>
                                    </div>
                                 </div>
                                 <div class="col-6">
                                    <div class="smf-hover-surface p-2">
                                       <div style="font-size: 10px; color: #5A6270;">Transactions</div>
                                       <div
                                          style="font-family: Consolas, monospace; font-size: 11px; font-weight: 700;">
                                          53,842</div>
                                    </div>
                                 </div>
                              </div>
                              <div class="smf-hover-btn">Monitor this address in extension</div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- Slide 2: Transaction Hover Preview -->
                  <div class="carousel-item">
                     <div class="smf-demo-post p-3 rounded-1">
                        <div class="mb-2 small" style="color:#476C8E; font-weight:bold;">
                           Re: Escrow address &amp; payout verification
                        </div>
                        <p class="mb-3 text-truncate">
                           Payout broadcast in tx <span class="smf-demo-addr">f4184fc596403b9d638783cf57adfe4c…</span>
                        </p>

                        <div class="smf-hover-preview mx-auto">
                           <div class="smf-hover-header">
                              <span>bitcoindata.science</span>
                              <span class="smf-hover-pill">Confirmed #882,410</span>
                           </div>
                           <div class="smf-hover-body">
                              <div
                                 class="smf-hover-surface d-flex justify-content-between align-items-center px-2 py-1 mb-2"
                                 style="font-family: Consolas, monospace; font-size: 11px;">
                                 <span class="text-truncate me-2">f4184fc5964…bbb28c507</span>
                                 <span class="d-inline-flex gap-1">
                                    <span class="smf-icon-btn">Copy</span>
                                    <span class="smf-icon-btn">mempool ↗</span>
                                 </span>
                              </div>
                              <div class="smf-hover-surface p-2 mb-2">
                                 <div style="font-family: Consolas, monospace; font-size: 15px; font-weight: 700;">
                                    50.00000000 <span style="font-size: 11px; color: #5A6270;">BTC</span>
                                 </div>
                                 <div style="color: #476C8E; font-weight: 700; font-size: 12px;">$4,700,000.00</div>
                              </div>
                              <div class="row g-2 mb-2">
                                 <div class="col-6">
                                    <div class="smf-hover-surface p-2">
                                       <div style="font-size: 10px; color: #5A6270;">Fee</div>
                                       <div
                                          style="font-family: Consolas, monospace; font-size: 10.5px; font-weight: 700;">
                                          0.00014200 BTC ($13.35)</div>
                                    </div>
                                 </div>
                                 <div class="col-6">
                                    <div class="smf-hover-surface p-2">
                                       <div style="font-size: 10px; color: #5A6270;">Fee rate · 2026-02-14</div>
                                       <div
                                          style="font-family: Consolas, monospace; font-size: 10.5px; font-weight: 700;">
                                          6.8 sat/vB (209 vB)</div>
                                    </div>
                                 </div>
                              </div>
                              <div class="smf-hover-surface p-2 mb-2">
                                 <div class="smf-io-title">Inputs (1)</div>
                                 <div class="smf-io-row">
                                    <span style="color:#5A6270;">bc1qxy2k…497p08f</span>
                                    <span class="fw-bold">50.00014200 BTC <span
                                          style="color:#737B8C; font-weight:400; font-size:9.5px;">$4,700,013.35</span></span>
                                 </div>
                              </div>
                              <div class="smf-hover-surface p-2">
                                 <div class="smf-io-title">Outputs (2)</div>
                                 <div class="smf-io-row mb-1">
                                    <span style="color:#5A6270;">bc1qar0s…w5722de</span>
                                    <span class="fw-bold">10.00000000 BTC <span
                                          style="color:#737B8C; font-weight:400; font-size:9.5px;">$940,000.00</span></span>
                                 </div>
                                 <div class="smf-io-row">
                                    <span style="color:#5A6270;">bc1qxy2k…497p08f</span>
                                    <span class="fw-bold">40.00000000 BTC <span
                                          style="color:#737B8C; font-weight:400; font-size:9.5px;">$3,760,000.00</span></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <button class="carousel-control-prev" type="button" data-bs-target="#hoverFeatureCarousel"
                  data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
               </button>
               <button class="carousel-control-next" type="button" data-bs-target="#hoverFeatureCarousel"
                  data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
               </button>
            </div>
         </div>
      </div>
   </section>

   <!-- 3-Column Feature Grid: Sidebar Monitor, Post Toolbar, Context Menu -->
   <p class="section-label mb-3">More Extension Capabilities</p>
   <div class="row row-cols-1 row-cols-lg-3 g-4 mb-5">
      <!-- Card 1: Sidebar & Popup Monitor -->
      <div class="col">
         <div class="card h-100 card-home bg-body-tertiary">
            <div class="card-home-icon-wrapper">
               <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  style="fill:none">
                  <rect width="18" height="18" x="3" y="3" rx="2" />
                  <path d="M15 3v18" />
               </svg>
            </div>
            <h3 class="card-title-home">Sidebar &amp; Background Monitor</h3>
            <p class="card-desc-home">
               Open the extension as a toolbar popup or dock it in your browser's side panel. Monitor your primary
               Bitcoin address with automatic 20-minute background checks and native desktop notifications when a new
               transaction arrives.
            </p>
            <div class="card-footer-home mt-auto pt-3">
               <a href="/bitcoin-balance-check" class="btn-home-action">
                  <span>Need batch lookup (465 addresses)?</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                     <path d="M5 12h14" />
                     <path d="m12 5 7 7-7 7" />
                  </svg>
               </a>
            </div>
         </div>
      </div>

      <!-- Card 2: Post Editor BBCode Toolbar -->
      <div class="col">
         <div class="card h-100 card-home bg-body-tertiary">
            <div class="card-home-icon-wrapper">
               <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  style="fill:none">
                  <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
                  <path d="M8 12h.01" />
                  <path d="M12 12h.01" />
                  <path d="M16 12h.01" />
               </svg>
            </div>
            <h3 class="card-title-home">Forum Post BBCode Buttons</h3>
            <p class="card-desc-home">
               Adds one-click buttons (<code>₿ Price</code>, <code>Fiat Price</code>, <code>Address Balance</code>,
               <code>Transaction</code>, and <code>Fees</code>) directly above the Bitcointalk and AltcoinsTalks post
               editor, complete with a 160+ currency selector, hex color picker, and bold toggle.
            </p>
            <div class="card-footer-home mt-auto pt-3">
               <a href="/bitcointalk-api" class="btn-home-action">
                  <span>Explore the Image API</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                     <path d="M5 12h14" />
                     <path d="m12 5 7 7-7 7" />
                  </svg>
               </a>
            </div>
         </div>
      </div>

      <!-- Card 3: Right-Click Context Menu -->
      <div class="col">
         <div class="card h-100 card-home bg-body-tertiary">
            <div class="card-home-icon-wrapper">
               <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  style="fill:none">
                  <path d="m3 3 7.07 16.97 2.51-7.39 7.39-2.51L3 3z" />
                  <path d="m13 13 6 6" />
               </svg>
            </div>
            <h3 class="card-title-home">Right-Click Context Menu</h3>
            <p class="card-desc-home">
               Highlight a Bitcoin address or right-click an explorer link on any website and choose
               <strong>"Check balance in bitcoindata sidebar"</strong> or <strong>"Monitor address in
                  bitcoindata"</strong> for an instant desktop balance notification.
            </p>
            <div class="card-footer-home mt-auto pt-3">
               <a href="https://bitcointalk.org/index.php?topic=5485996.msg63701109#msg63701109" target="_blank"
                  rel="noopener" class="btn-home-action">
                  <span>Bitcointalk ANN Thread</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                     <path d="M7 7h10v10" />
                     <path d="M7 17 17 7" />
                  </svg>
               </a>
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
      // Bootstrap sizes a carousel to the active slide; lock every slide to the tallest one.
      (() => {
         const carouselEl = document.getElementById('hoverFeatureCarousel');
         if (!carouselEl) return;
         const items = carouselEl.querySelectorAll('.carousel-item');
         const equalize = () => {
            items.forEach(i => {
               i.style.minHeight = '';
            });
            let max = 0;
            items.forEach(i => {
               const active = i.classList.contains('active');
               if (!active) i.style.display = 'block';
               max = Math.max(max, i.offsetHeight);
               if (!active) i.style.display = '';
            });
            items.forEach(i => {
               i.style.minHeight = max + 'px';
            });
         };
         window.addEventListener('load', equalize);
         window.addEventListener('resize', equalize);
         equalize();
      })();
   </script>
</body>

</html>