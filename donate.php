<!doctype html>
<html lang="en">

<head>
   <?php
   $title = "bitcoin data.science - Donate";
   $description = "Data analysis and tools for anything related to bitcoin.";
   $canonical = "https://bitcoindata.science/donate";
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
   ?>
   <script type="application/ld+json">
      {
         "@context": "https://schema.org",
         "@type": "Organization",
         "name": "bitcoin data.science",
         "description": "Data analysis and tools for anything related to bitcoin.",
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
</head>

<body>
   <!-- Navbar -->
   <header>
      <navbar-component></navbar-component>
   </header>
   <!-- Page Content -->
   <?php
   $h1 = 'About the Project';
   $h2 = 'General information, partners, ads, contributions, and acknowledgments.';
   $showAd = false;
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>

   <style>
      .partner-logo-link {
         display: inline-block;
         transition: transform 0.2s ease, opacity 0.2s ease;
      }

      .partner-logo-link:hover {
         transform: scale(1.05);
      }

      .logo-img {
         max-height: 40px;
         max-width: 160px;
         object-fit: contain;
      }

      .hover-scale {
         transition: transform 0.15s ease;
      }

      .hover-scale:hover {
         transform: scale(1.15);
      }

      .transition-all {
         transition: all 0.3s ease;
      }
   </style>

   <!-- Impact & Advertising Dashboard Row -->
   <div class="row g-4 mb-4">
      <!-- Traffic & Stats -->
      <div class="col-12 col-lg-7">
         <div class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm h-100">
            <p class="section-label mb-4">Impact & Reach</p>
            <h3 class="fw-bold mb-3">Website Traffic & Stats</h3>
            <p class="text-body-secondary mb-4">
               Our platform provides analytics, unit conversion, and raffle tools to a highly engaged audience of cryptocurrency users, developers, and investors.
            </p>

            <div class="d-flex align-items-center gap-3 mb-4 bg-body-secondary p-3 rounded-4">
               <div class="d-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle" style="width: 50px; height: 50px; flex-shrink: 0;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="var(--theme-blue)" viewBox="0 0 16 16">
                     <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                  </svg>
               </div>
               <div>
                  <div class="fs-4 fw-bold text-primary">20,000+</div>
                  <div class="text-muted small">Unique visitors last month</div>
               </div>
            </div>

            <div class="border rounded-4 overflow-hidden shadow-sm">
               <img src="img/traffic-stats.png" class="img-fluid w-100" title="Website Traffic" alt="Cloudflare Website Traffic" style="display: block;">
            </div>
         </div>
      </div>

      <!-- Advertising Placement -->
      <div class="col-12 col-lg-5">
         <div class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm h-100 d-flex flex-column justify-content-between">
            <div>
               <p class="section-label mb-4">Partnerships</p>
               <h3 class="fw-bold mb-3">Advertise Your Brand</h3>
               <p class="text-body-secondary mb-4">
                  Interested in promoting your product, service, or exchange to our community? We offer premium placements for brands that align with our mission of open data and privacy.
               </p>
               <ul class="list-unstyled mb-4">
                  <li class="d-flex align-items-start gap-2 mb-3">
                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="var(--theme-blue)" class="mt-1 flex-shrink-0" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                     </svg>
                     <span>High-visibility banners & customized integrations</span>
                  </li>
                  <li class="d-flex align-items-start gap-2 mb-3">
                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="var(--theme-blue)" class="mt-1 flex-shrink-0" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                     </svg>
                     <span>Targeted cryptocurrency users & investors</span>
                  </li>
                  <li class="d-flex align-items-start gap-2">
                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="var(--theme-blue)" class="mt-1 flex-shrink-0" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                     </svg>
                     <span>Native banners by design, bypass adblockers</span>
                  </li>
               </ul>
            </div>
            <div class="mt-auto">
               <a href="mailto:bitmover@protonmail.ch" class="btn btn-primary w-100 text-decoration-none btn-lg py-3 fw-bold">
                  Make an offer
               </a>
            </div>
         </div>
      </div>
   </div>


   <!-- Partners Showcase Section -->
   <div class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm mb-4">
      <p class="section-label mb-4">As Seen On</p>
      <h3 class="fw-bold mb-4">Bitcoindata in Other Websites</h3>

      <div class="row row-cols-2 row-cols-md-5 g-4 align-items-center justify-content-center text-center">
         <!-- Livecoins -->
         <div class="col">
            <a href="https://livecoins.com.br/verificador-de-saldo-de-enderecos-bitcoin/"
               title="Livecoins" target="_blank" rel="noopener" class="partner-logo-link">
               <img src="img/livecoins.jpg" alt="livecoins.com.br" class="img-fluid p-2 bg-white rounded shadow-sm logo-img" />
            </a>
         </div>

         <!-- Land of Crypto -->
         <div class="col">
            <a href="https://landofcrypto.com/bitcoindata-science-review/" title="Land of Crypto" target="_blank" rel="noopener" class="partner-logo-link">
               <img src="img/landofcrypto.png" alt="Land of Crypto" class="img-fluid p-2 bg-black rounded shadow-sm logo-img" />
            </a>
         </div>

         <!-- BitList -->
         <div class="col">
            <a href="https://bitlist.co/service/bitcoin-data" title="BitList" target="_blank" rel="noopener" class="partner-logo-link">
               <img src="img/bitlist.png" alt="bitlist.co" class="img-fluid p-2 bg-black rounded shadow-sm logo-img" />
            </a>
         </div>

         <!-- KYCnot.me -->
         <div class="col">
            <a href="https://kycnot.me/service/bitcoindata" title="KYCnot.me" target="_blank" rel="noopener" class="partner-logo-link">
               <svg xmlns="http://www.w3.org/2000/svg" height='40' viewBox="0 0 204 28" fill="#00c951" class="bg-black rounded p-2 shadow-sm img-fluid logo-img">
                  <path d=" M1 0a1 1 0 0 0-1 1v26a1 1 0 0 0 1 1h74a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1Zm4 4h2a1 1 0 0 1 1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 1 1 1v3h3a1 1 0 0 1 1 1v3h3a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3h-3a1 1 0 0 1-1-1v-3H9a1 1 0 0 0-1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1zm12 0h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1zm12.82 0h2.37a1 1 0 0 1 .85.46L38 12.27l4.97-7.8A1 1 0 0 1 43.8 4h2.37a1 1 0 0 1 .85 1.54l-6.87 10.8a1 1 0 0 0-.16.53V23a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-6.13a1 1 0 0 0-.15-.53l-6.87-10.8A1 1 0 0 1 29.82 4ZM57 4h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H56v12h15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H57a1 1 0 0 1-1-1v-3h-3a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h3V5a1 1 0 0 1 1-1zm24 0a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V7.6l9.18 15.9c.18.3.5.5.86.5H99a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v15.4L86.83 4.5a1 1 0 0 0-.87-.5Zm29 0a1 1 0 0 0-1 1v3h12V5a1 1 0 0 0-1-1zm11 4v12h3a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1zm0 12h-12v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1zm-12 0V8h-3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1zm21-16a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V8h4v15a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V8h4v3a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm27 0a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V11.4l5.53 12.02a1 1 0 0 0 .91.58h3.12a1 1 0 0 0 .91-.58L176 11.4V23a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-3.36a1 1 0 0 0-.9.58L168 19.21l-6.73-14.63a1 1 0 0 0-.9-.58Zm32 0a1 1 0 0 0-1 1v3h15a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm-1 4h-3a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1h-14a1 1 0 1 1-1-1v-3h7a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1h-7zm-38 12a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1z"></path>
               </svg>
            </a>
         </div>

         <!-- Altcoinstalks -->
         <div class="col">
            <a href="https://www.altcoinstalks.com/index.php?topic=322524.0" title="Altcoinstalks" target="_blank" rel="noopener" class="partner-logo-link">
               <img src="img/altf.png" alt="Altcoinstalks" class="img-fluid p-2 bg-white rounded shadow-sm logo-img" />
            </a>
         </div>
      </div>
   </div>


   <!-- Direct Donations Section -->
   <div class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm mb-4">
      <p class="section-label mb-4">Direct Donations</p>
      <p class="text-body-secondary mb-5">
         If this website is useful to you, consider donating to support its development. We host data analysis and tools for anything related to Bitcoin, completely free and open-source. Donate some Bitcoin or other cryptocurrencies to the addresses below:
      </p>

      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3 text-center" id="addresses"></div>
   </div>

   <!-- Contributors Section (Hall of Fame) -->
   <div class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm mb-4">
      <p class="section-label mb-4">Hall of Fame</p>
      <h3 class="fw-bold mb-3">Top Contributors</h3>
      <p class="text-body-secondary mb-5">
         We are deeply grateful to the community members who have funded infrastructure, designed features, or supported our hosting resources.
      </p>

      <div class="row row-cols-1 row-cols-md-3 g-4">
         <!-- JayJuanGee -->
         <div class="col">
            <div class="card h-100 border-0 bg-body-secondary p-4 rounded-4 text-center">
               <div class="d-flex align-items-center justify-content-center mx-auto mb-3 bg-primary-subtle text-primary rounded-circle" style="width: 56px; height: 56px;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="var(--theme-blue)" viewBox="0 0 16 16">
                     <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                  </svg>
               </div>
               <h5 class="fw-bold mb-2">
                  <a href="https://bitcointalk.org/index.php?action=profile;u=252510" title="JayJuanGee" target="_blank" rel="noopener" class="text-primary text-decoration-none">
                     JayJuanGee
                  </a>
               </h5>
               <p class="text-body-secondary small mb-0">
                  Designed and funded the development and maintenance of some tools.
               </p>
            </div>
         </div>

         <!-- Timelord2067 -->
         <div class="col">
            <div class="card h-100 border-0 bg-body-secondary p-4 rounded-4 text-center">
               <div class="d-flex align-items-center justify-content-center mx-auto mb-3 bg-primary-subtle text-primary rounded-circle" style="width: 56px; height: 56px;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="var(--theme-blue)" viewBox="0 0 16 16">
                     <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                  </svg>
               </div>
               <h5 class="fw-bold mb-2">
                  <a href="https://bitcointalk.org/index.php?action=profile;u=131361" title="Timelord2067" target="_blank" rel="noopener" class="text-primary text-decoration-none">
                     Timelord2067
                  </a>
               </h5>
               <p class="text-body-secondary small mb-0">
                  Donated the domain registrar's 10-year renewal.
               </p>
            </div>
         </div>

         <!-- examplens -->
         <div class="col">
            <div class="card h-100 border-0 bg-body-secondary p-4 rounded-4 text-center">
               <div class="d-flex align-items-center justify-content-center mx-auto mb-3 bg-primary-subtle text-primary rounded-circle" style="width: 56px; height: 56px;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="var(--theme-blue)" viewBox="0 0 16 16">
                     <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v5h4v-5a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v5h1V9a.5.5 0 0 1 1 0v6.5a.5.5 0 0 1-.5.5H1.5a.5.5 0 0 1-.5-.5V9a.5.5 0 0 1 .5-.5z" />
                  </svg>
               </div>
               <h5 class="fw-bold mb-2">
                  <a href="https://bitcointalk.org/index.php?action=profile;u=314792" title="examplens" target="_blank" rel="noopener" class="text-primary text-decoration-none">
                     examplens
                  </a>
               </h5>
               <p class="text-body-secondary small mb-0">
                  Added this website to his server.
               </p>
            </div>
         </div>
      </div>
   </div>


   </main>

   <footer-component></footer-component>

   <script type="text/javascript">
      // Address selection and copy logic
      function selectText(id) {
         const el = document.getElementById(id);
         if (window.getSelection && document.createRange) {
            const sel = window.getSelection();
            sel.removeAllRanges();
            const range = document.createRange();
            range.selectNodeContents(el);
            sel.addRange(range);
         }
      }

      // Address list
      const addresses = [{
            blockchain: 'Bitcoin',
            ticker: 'BTC',
            address: 'bc1qnrqfg9p2huh6y5ggsrkz5w8es25yw498n42f5m',
         },
         {
            blockchain: 'Litecoin',
            ticker: 'LTC',
            address: 'ltc1qwl4f9xupajtzwcusftsqgu5u7fclzgvjar9pt5',
         },
         {
            blockchain: 'Ethereum',
            ticker: 'ETH',
            address: '0x6ff37c932d81924190e4bec36d1052dc78126a2d',
         },
         {
            blockchain: 'Liquid',
            ticker: 'L-BTC',
            address: 'VJL5eExSHNCPuKBncgUcSoa1vmB4ajKWY5MBEajZz2aRQUXx5WqwsdKNDu8KgKGHAnn8iK51o3ncmunk',
         },
      ];

      const addressesArea = document.getElementById("addresses");
      addressesArea.innerHTML =
         addresses.map(i => `
         <div class="col">
            <div class="card h-100 border-0 bg-body-secondary p-4 rounded-4 shadow-sm text-center card-home transition-all">
               <div class="mb-3">
                  <span class="text-body px-3 py-2 fw-semibold small">
                     ${i.blockchain} (${i.ticker})
                  </span>
               </div>
               <div class="bg-white p-3 rounded-4 d-inline-block mx-auto mb-3 shadow-sm" style="width: 140px; height: 140px;">
                  <img src="img/${i.address}.webp" class="img-fluid rounded" alt="${i.blockchain} address QR code" width="110" height="110" style="object-fit: contain;">
               </div>
               <div class="mt-2">
                  <div class="d-flex align-items-center justify-content-between bg-body-tertiary p-2 px-3 rounded-pill border">
                     <code class="text-break text-start me-2 small text-muted font-monospace" style="font-size: 0.75rem;" id="${i.blockchain}Addr">${i.address}</code>
                     <button class="btn btn-sm btn-link p-1 hover-scale copy-btn" 
                             style="color: var(--theme-blue) !important;" 
                             title="Copy Address"
                             data-bs-toggle="tooltip" 
                             data-bs-title="Copied!" 
                             data-bs-trigger="click" 
                             data-bs-delay='{"show":0,"hide":150}'
                             onclick="navigator.clipboard.writeText('${i.address}'); selectText('${i.blockchain}Addr');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                           <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                           <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                        </svg>
                     </button>
                  </div>
               </div>
            </div>
         </div>`).join('');

      // Tooltips - initialized after writing address list to the DOM
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
   </script>
</body>

</html>