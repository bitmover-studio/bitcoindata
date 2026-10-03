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
   $h1 = '';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>

   <!-- Hero Section: Welcome Text (Left) + Floating Spotlight Card (Right) -->
   <section class="row align-items-center justify-content-between g-4 g-xl-5 pt-3 pb-4 mb-5">
      <!-- Welcome Text (Left) -->
      <div class="col-12 col-xxl-7">
         <div class="pe-lg-3">
            <h1 class="display-5 fw-bold mb-3 lh-sm">
               Explore <samp class="text-primary">bitcoindata</samp> utilities
            </h1>
            <p class="lead text-body-secondary mb-4">
               Open-source suite of free Bitcoin utilities: live multi-address balance checker, cryptographic signature
               verifier, DCA returns calculator, and long-term valuation models.
            </p>
         </div>
      </div>
   </section>

   <!-- Category / Suite Cards (One for each breadcrumb) -->
   <p class="section-label mb-3">Tool Suites &amp; Categories</p>
   <div class="row row-cols-1 row-cols-lg-2 g-4 mb-5" id="categoryCards"></div>

   <script>

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
               {
                  name: "Balance Checker",
                  link: "/bitcoin-balance-check",
                  title: "Bitcoin Address Balance Checker",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16"><path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" /></svg>`
               },
               {
                  name: "Unit Converter",
                  link: "/bitcoin-units-converter",
                  title: "Bitcoin Units Converter",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" /></svg>`
               },
               {
                  name: "Verify Message",
                  link: "/verify-message",
                  title: "Verify Bitcoin Message",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 -960 960 960" fill="currentColor"><path d="M638-80 468-250l56-56 114 114 226-226 56 56L638-80ZM480-520l320-200H160l320 200Zm0 80L160-640v400h206l80 80H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v174l-80 80v-174L480-440Zm0 0Zm0-80Zm0 80Z"/></svg>`
               },
               {
                  name: "DCA Calculator",
                  link: "/dca-calculator",
                  title: "Dollar Cost Averaging Calculator",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 21v-6"/><path d="M12 21V9"/><path d="M19 21V3"/></svg>`
               },
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
               {
                  name: "Image API",
                  link: "/bitcointalk-api",
                  title: "Price and Balance Forum Image API",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16"><path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" /><path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" /></svg>`
               },
               {
                  name: "Notification Bot",
                  link: "/altcoinstalk/notification.php",
                  title: "Altcoinstalks Mention & Quote Bot",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M5.85 3.5a.75.75 0 0 0-1.117-1 9.719 9.719 0 0 0-2.348 4.876.75.75 0 0 0 1.479.248A8.219 8.219 0 0 1 5.85 3.5ZM19.267 2.5a.75.75 0 1 0-1.118 1 8.22 8.22 0 0 1 1.987 4.124.75.75 0 0 0 1.48-.248A9.72 9.72 0 0 0 19.266 2.5Z" /><path fillRule="evenodd" d="M12 2.25A6.75 6.75 0 0 0 5.25 9v.75a8.217 8.217 0 0 1-2.119 5.52.75.75 0 0 0 .298 1.206c1.544.57 3.16.99 4.831 1.243a3.75 3.75 0 1 0 7.48 0 24.583 24.583 0 0 0 4.83-1.244.75.75 0 0 0 .298-1.205 8.217 8.217 0 0 1-2.118-5.52V9A6.75 6.75 0 0 0 12 2.25ZM9.75 18c0-.034 0-.067.002-.1a25.05 25.05 0 0 0 4.496 0l.002.1a2.25 2.25 0 1 1-4.5 0Z" clipRule="evenodd" /></svg>`
               },
               {
                  name: "Giveaway Manager",
                  link: "/giveaway-manager",
                  title: "Provably Fair Giveaway Manager",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16"><path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z" /></svg>`
               },
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
               {
                  name: "Withdrawal Strategy",
                  link: "/withdrawal-strategy",
                  title: "JJG Sustainable Withdrawal Strategy",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 -960 960 960"><path d="M668.5-531.5Q680-543 680-560t-11.5-28.5Q657-600 640-600t-28.5 11.5Q600-577 600-560t11.5 28.5Q623-520 640-520t28.5-11.5ZM320-600h200v-80H320v80ZM180-120q-34-114-67-227.5T80-580q0-92 64-156t156-64h200q29-38 70.5-59t89.5-21q25 0 42.5 17.5T720-820q0 6-1.5 12t-3.5 11q-4 11-7.5 22.5T702-751l91 91h87v279l-113 37-67 224H480v-80h-80v80H180Zm60-80h80v-80h240v80h80l62-206 98-33v-141h-40L620-720q0-20 2.5-38.5T630-796q-29 8-51 27.5T547-720H300q-58 0-99 41t-41 99q0 98 27 191.5T240-200Zm240-298Z"/></svg>`
               },
               {
                  name: "Fuck You Status",
                  link: "/fuckyoustatus",
                  title: "Fuck You Status Calculator",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-emoji-sunglasses-fill" viewBox="0 0 16 16"><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M2.31 5.243A1 1 0 0 1 3.28 4H6a1 1 0 0 1 1 1v.116A4.2 4.2 0 0 1 8 5c.35 0 .69.04 1 .116V5a1 1 0 0 1 1-1h2.72a1 1 0 0 1 .97 1.243l-.311 1.242A2 2 0 0 1 11.439 8H11a2 2 0 0 1-1.994-1.839A3 3 0 0 0 8 6c-.393 0-.74.064-1.006.161A2 2 0 0 1 5 8h-.438a2 2 0 0 1-1.94-1.515zM4.969 9.75A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .866-.5z"/></svg>`
               },
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
               {
                  name: "PGP Signature Checker",
                  link: "/verify-pgp",
                  title: "Verify PGP Signatures and Clearsigned Messages",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56"/><path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415"/></svg>`
               },
               {
                  name: "Raw Tx Hex",
                  link: "/bitcoin-raw-transaction-hex",
                  title: "Bitcoin Raw Transaction Hex Decoder",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16"><path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/><path d="M4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4z"/></svg>`
               },
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
                  <span class="badge bg-body-secondary text-body  rounded-pill px-3 py-1 small fw-semibold">${cat.badge}</span>
               </div>
               <h3 class="card-title-home h4 mb-2">${cat.title}</h3>
               <p class="card-desc-home mb-3">${cat.description}</p>
            </div>
            <div class="pt-3 border-top d-flex flex-wrap gap-2">
               ${cat.tools.map(tool => `
                  <a href="${tool.link}" class="btn btn-sm btn-outline-secondary rounded-3 px-3 py-1 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm" title="${tool.title}">
                     ${tool.icon ? `<span class="d-inline-flex align-items-center opacity-75">${tool.icon}</span>` : ''}
                     <span>${tool.name}</span>
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