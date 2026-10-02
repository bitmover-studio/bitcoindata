<!doctype html>
<html lang="en">

<head>
   <?php
   $title = "bitcoin data.science - Data Analysis and bitcoin";
   $description = "Explore free Bitcoin tools and analytics on bitcoindata.science: balance checker, unit converter, signature verifier, provably fair giveaways, and live APIs.";
   $canonical = "https://bitcoindata.science/";
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
   ?>
   <script type="application/ld+json">
      {
         "@context": "https://schema.org",
         "@type": "Organization",
         "name": "bitcoindata.science",
         "description": "Explore free Bitcoin tools and analytics on bitcoindata.science: balance checker, unit converter, signature verifier, provably fair giveaways, and live APIs.",
         "alternateName": [
            "bitcoindata.science",
            "Bitcoin Data Science",
            "bitcoindata science"
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
   <header>
      <navbar-component></navbar-component>
   </header>
   <!-- Page Content -->
   <?php
   // Create a gradient effect for bitcoindata on h1
   $h1 = 'Explore what <tt class="text-primary fw-bold">bitcoindata</tt> can do for you';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>

   <!-- Top 3 Featured Cards -->
   <p class="section-label mb-3">Popular Tools</p>
   <div class="row row-cols-1 row-cols-md-4 g-4 mb-5" id="topCards"></div>

   <!-- Category / Suite Cards (One for each breadcrumb) -->
   <p class="section-label mb-3">Tool Suites &amp; Categories</p>
   <div class="row row-cols-1 row-cols-lg-2 g-4 mb-5" id="categoryCards"></div>

   <script>
      // 1. Top 3 Featured Cards
      const topCardsData = [
         {
            title: "Bitcoin Balance Check",
            description: "Check the balance of multiple bitcoin addresses simultaneously. Scanning QRCode supported.",
            link: "/bitcoin-balance-check",
            action: "Check your balance",
            viewBox: "0 0 16 16",
            icon: '<path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />',
         },
         {
            title: "Verify Signed Messages",
            description: "Verify that a message was signed with a bitcoin address. Check ownership of any Bitcoin address with cryptographic proof.",
            link: "/verify-message",
            action: "Go to message verify",
            viewBox: "0 0 16 16",
            icon: '<path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z"/> <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686"/>',
         },
         {
            title: "DCA Calculator",
            description: "Calculate the returns of dollar cost averaging into Bitcoin. See how a weekly or monthly BTC purchase would have performed over any historical timeframe.",
            link: "dca-calculator",
            action: "Calculate DCA",
            icon: '<path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1z"/>',
         },
         {
            title: "Giveaway Manager",
            description: "<em>Provably fair</em> giveaway manager. Results easily verified and shareable.",
            link: "https://bitcoindata.science/giveaway-manager",
            action: "Go to giveaway",
            icon: ' <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A3 3 0 0 1 3 2.506zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43zM9 3h2.932l.023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0zM1 4v2h6V4zm8 0v2h6V4zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5z"/>',
         },
      ];

      const topCardsContainer = document.getElementById('topCards');
      topCardsData.forEach(card => {
         const cardCol = document.createElement('div');
         cardCol.className = 'col';
         cardCol.innerHTML = `
         <div class="card h-100 card-home bg-body-tertiary">
            <div class="card-body p-0">
               <div class="card-home-icon-wrapper">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="${card.viewBox || '0 0 16 16'}">${card.icon}</svg>
               </div>
               <div class="text-content">
                  <a href="${card.link}" class="text-decoration-none stretched-link" title="${card.action}">
                     <h3 class="card-title-home">${card.title}</h3>
                     <p class="card-desc-home">${card.description}</p>
                  </a>
               </div>
            </div>
         </div>
         `;
         topCardsContainer.appendChild(cardCol);
      });

      // 2. Category / Breadcrumb Hub Cards
      const categoryCardsData = [
         {
            id: "bitcoin-tools",
            title: "Bitcoin Tools",
            badge: "Core Suite",
            description: "Essential Bitcoin utilities for checking address balances, verifying message ownership signatures, converting denominations, and simulating long-term DCA returns.",
            viewBox: "0 0 16 16",
            icon: '<path d="M5.5 13v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.5v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.084c1.992 0 3.416-1.033 3.416-2.82 0-1.502-1.007-2.323-2.186-2.44v-.088c.97-.242 1.683-.974 1.683-2.19C11.997 3.93 10.847 3 9.092 3H9V1.75a.25.25 0 0 0-.25-.25h-1a.25.25 0 0 0-.25.25V3h-.573V1.75a.25.25 0 0 0-.25-.25H5.75a.25.25 0 0 0-.25.25V3l-1.998.011a.25.25 0 0 0-.25.25v.989c0 .137.11.25.248.25l.755-.005a.75.75 0 0 1 .745.75v5.505a.75.75 0 0 1-.75.75l-.748.011a.25.25 0 0 0-.25.25v1c0 .138.112.25.25.25zm1.427-8.513h1.719c.906 0 1.438.498 1.438 1.312 0 .871-.575 1.362-1.877 1.362h-1.28zm0 4.051h1.84c1.137 0 1.756.58 1.756 1.524 0 .953-.626 1.45-2.158 1.45H6.927z" />',
            tools: [
               { name: "Balance Checker", link: "/bitcoin-balance-check", title: "Bitcoin Address Balance Checker" },
               { name: "Unit Converter", link: "/bitcoin-units-converter", title: "Bitcoin Units Converter" },
               { name: "Verify Message", link: "/verify-message", title: "Verify Bitcoin Message" },
               { name: "DCA Calculator", link: "/dca-calculator", title: "Dollar Cost Averaging Calculator" },
            ]
         },
         {
            id: "forum-tools",
            title: "Forum Tools",
            badge: "Bitcointalk & Community",
            description: "Custom-built tools for Bitcointalk and cryptocurrency forums: generate dynamic address/price images for forum posts, track mentions via bot, and run provably fair raffles.",
            viewBox: "0 -960 960 960",
            icon: '<path d="M880-80 720-240H320q-33 0-56.5-23.5T240-320v-40h440q33 0 56.5-23.5T760-440v-280h40q33 0 56.5 23.5T880-640v560ZM160-473l47-47h393v-280H160v327ZM80-280v-520q0-33 23.5-56.5T160-880h440q33 0 56.5 23.5T680-800v280q0 33-23.5 56.5T600-440H240L80-280Zm80-240v-280 280Z"/>',
            tools: [
               { name: "Image API", link: "/bitcointalk-api", title: "Price and Balance Forum Image API" },
               { name: "Notification Bot", link: "/altcoinstalk/notification.php", title: "Altcoinstalks Mention & Quote Bot" },
               { name: "Giveaway Manager", link: "/giveaway-manager", title: "Provably Fair Giveaway Manager" },
            ]
         },
         {
            id: "jjg",
            title: "JayJuanGee (JJG) Models",
            badge: "Retirement & Valuation",
            description: "Financial planning models by Bitcointalk member JayJuanGee (JJG) anchoring Bitcoin valuation to the 200-week moving average (200-WMA) for sustainable living and independence.",
            viewBox: "0 0 16 16",
            icon: '<path fill-rule="evenodd" d="M0 0h1v15h15v1H0zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07"/>',
            tools: [
               { name: "Withdrawal Strategy", link: "/withdrawal-strategy", title: "JJG Sustainable Withdrawal Strategy" },
               { name: "Fuck You Status", link: "/fuckyoustatus", title: "Fuck You Status Calculator" },
            ]
         },
         {
            id: "other-tools",
            title: "Other Tools",
            badge: "Security & Cryptography",
            description: "Client-side cryptographic security tools to verify PGP/GPG detached and clearsigned documents with zero server transmission using OpenPGP.js.",
            viewBox: "0 0 16 16",
            icon: '<path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56"/> <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415"/>',
            tools: [
               { name: "PGP Signature Checker", link: "/verify-pgp", title: "Verify PGP Signatures and Clearsigned Messages" },
            ]
         },
      ];

      const categoryCardsContainer = document.getElementById('categoryCards');
      categoryCardsData.forEach(cat => {
         const catCol = document.createElement('div');
         catCol.className = 'col';
         catCol.id = cat.id;

         catCol.innerHTML = `
         <div class="card h-100 card-home bg-body-tertiary">
            <div class="card-body p-0">
               <div class="d-flex align-items-center justify-content-between mb-3">
                  <div class="card-home-icon-wrapper mb-0">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="${cat.viewBox || '0 0 16 16'}">${cat.icon}</svg>
                  </div>
                  <span class="badge bg-body text-body border border-secondary border-opacity-25 rounded-pill px-3 py-1 small fw-semibold">${cat.badge}</span>
               </div>
               <h3 class="card-title-home h4 mb-2">${cat.title}</h3>
               <p class="card-desc-home mb-3">${cat.description}</p>
            </div>
            <div class="pt-3 border-top d-flex flex-wrap gap-2">
               ${cat.tools.map(tool => `
                  <a href="${tool.link}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 fw-semibold d-inline-flex align-items-center gap-1 shadow-sm" title="${tool.title}">
                     <span>${tool.name}</span>
                     <svg height="14" width="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                  </a>
               `).join('')}
            </div>
         </div>
         `;
         categoryCardsContainer.appendChild(catCol);
      });
   </script>
   </main>
   <footer-component></footer-component>
</body>

</html>