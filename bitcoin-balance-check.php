<!doctype html>
<html lang="en">

<head>
   <?php
   $title = "Bitcoin Balance Checker - bitcoin data.science";
   $description = "Check the balance of multiple bitcoin addresses and wallets. Scan bitcoin address QR Code for balance.";
   $keywords = "Bitcoin Address Balance Checker, bitcoin, balance, checker, address, addresses, multiple addresses, QRCode, QR Code";
   $canonical = "https://bitcoindata.science/bitcoin-balance-check";
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
   ?>
   <script type="application/ld+json">
      {
         "@context": "https://schema.org",
         "@graph": [{
            "@type": "WebPage",
            "name": "Check the balance of your bitcoin addresses. Scan Bitcoin QR Code.",
            "description": "Check the balance of multiple bitcoin addresses and wallets. Scan bitcoin address for balance.",
            "alternateName": [
               "bitcoindata.science",
               "Bitcoin Data Science",
               "bitcoin datascience"
            ],
            "url": "https://bitcoindata.science",
            "sameAs": [
               "https://bitcoindata.science"
            ]
         }, {
            "@type": "FAQPage",
            "mainEntity": [{
               "@type": "Question",
               "name": "How to check the balance of Multiple Addresses from Different Bitcoin Wallets?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "The bitcoindata.science balance checker allows you to check up to 465 addresses simultaneously. It supports scanning QR codes. Simply enter your addresses or scan them."
               }
            }]
         }]
      }
   </script>
   <script src="components/balance-check.js" type="text/javascript" defer></script>
   <script src="modules/html5-qrcode.min.js" type="text/javascript"></script>
   <script src="components/qrcodes.js" type="text/javascript" defer></script>
</head>

<body>
   <!-- Navbar -->
   <header>
      <navbar-component></navbar-component>
   </header>
   <!-- Page Content -->
   <?php
   $h1 = '<span class="d-none d-md-inline">Bitcoin</span> Address Balance Checker';
   $h2 = 'See the balance of multiple bitcoin addresses at the same time.';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>
   <div class="py-3">
      <ul>
         <li>One address per line.</li>
         <li>Scanning QRCodes supported.</li>
         <li>This tool can search up to 465 addresses.</li>
         <li>Your last search is stored locally in your browser's cache.</li>
         <li>If you keep this page open, the address balance will be updated every 20 minutes.</li>
         <li>If you are searching for more than 20 addresses, there will be no balance updates.</li>
      </ul>

      <div class="bg-body-tertiary rounded-4 p-md-5 p-4 mt-5 shadow-sm">
         <div class="form-floating mb-3 border-0 font-monospace">
            <textarea class="form-control border-0 bg-body-secondary rounded-4 lh-base fw-medium" placeholder="Bitcoin Addresses" id="BalanceChecker"
               style="height: 180px" maxlength="16350" spellcheck="false"></textarea>
            <label for="BalanceChecker" class="fw-medium lh-base fs-6">Your Bitcoin Addresses</label>
         </div>

         <div class="d-flex justify-content-start gap-2 gap-md-3">
            <button type="submit" class="btn btn-primary btn-lg rounded-pill d-inline-flex align-items-center justify-content-center px-4" id="submitbutton" style="position: relative; overflow: hidden; transition: background-color 0.3s ease;">
              <span id="submit-label" style="transition: opacity 0.2s, transform 0.2s;">Get Balance</span>
              <div id="submit-spinner" class="spinner-border spinner-border-sm position-absolute" role="status" style="opacity:0; transition: opacity 0.2s, transform 0.2s; pointer-events: none;">
                <span class="visually-hidden">Loading...</span>
              </div>
              <div id="submit-success" style="opacity: 0; transform: scale(0.5); position: absolute; transition: opacity 0.2s, transform 0.2s; pointer-events: none;">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 6L9 17l-5-5" />
                </svg>
              </div>
            </button>
            <button type="button" class="btn btn-primary btn-lg d-inline-block rounded-pill" title="Scan Address" id="startButton" data-bs-toggle="modal" data-bs-target="#readerModal">
               <span class="d-none d-md-inline">Scan</span>
               <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-qr-code my-1" viewBox="0 0 16 16">
                  <path d="M2 2h2v2H2z" />
                  <path d="M6 0v6H0V0zM5 1H1v4h4zM4 12H2v2h2z" />
                  <path d="M6 10v6H0v-6zm-5 1v4h4v-4zm11-9h2v2h-2z" />
                  <path d="M10 0v6h6V0zm5 1v4h-4V1zM8 1V0h1v2H8v2H7V1zm0 5V4h1v2zM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8zm0 0v1H2V8H1v1H0V7h3v1zm10 1h-1V7h1zm-1 0h-1v2h2v-1h-1zm-4 0h2v1h-1v1h-1zm2 3v-1h-1v1h-1v1H9v1h3v-2zm0 0h3v1h-2v1h-1zm-4-1v1h1v-2H7v1z" />
                  <path d="M7 12h1v3h4v1H7zm9 2v2h-3v-1h2v-1z" />
               </svg>
            </button>

         </div>

         <!-- Scanner Modal -->
         <div class="modal fade" id="readerModal" tabindex="-1" aria-labelledby="readerLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h4 class="modal-title fs-5" id="readerLabel">QRCode Scanner</h4>
                  </div>
                  <div class="modal-body">
                     <div id="reader" class="border-0 mb-3" width="400px"></div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" title="Stop Camera" class="btn btn-secondary btn-lg" id="stopButton"
                        data-bs-dismiss="modal">Stop Scanning</button>
                  </div>
               </div>
            </div>
         </div>

      </div>
      <p id="source" class="small text-muted text-end">Data from mempool.space and Coindesk.</p>

      <div id="balances" class="mt-4">
      </div>
      <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true"
         onBlur="javascript:document.title = 'Bitcoin Balance Checker - bitcoin data.science';">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <p>Address: <code class="modal-address text-primary"></code></p>
                  <p id="modal-body-text" class="text-warning-emphasis font-monospace"><span
                        class="modal-balance"></span> (<span class="modal-value"></span>)</p>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary shadow-sm btn-lg px-5" data-bs-dismiss="modal"
                     onclick="handleClick()">Close</button>
                  <button type="button" class="btn btn-primary shadow-sm btn-lg px-5" onclick="handleClick()"
                     data-bs-dismiss="modal">Reload Data</button>
               </div>
            </div>
         </div>
      </div>
   </div>
   </main>
   <footer-component></footer-component>
</body>

</html>