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

   <!-- Hero Section: Lucide-inspired Hero (Left Text + Action Buttons, Right Isometric Vector Illustration) -->
   <section class="row align-items-center justify-content-between g-4 g-xl-5 pt-2 pt-md-4 pb-4 mb-5">
      <!-- Left Content Column -->
      <div class="col-12 col-lg-7 col-xl-6">
         <div class="pe-lg-3">

            <!-- Headline -->
            <p class="section-label">Developed for the Bitcoin community</p>
            <h1 class="display-4 fw-bold mb-3 lh-sm tracking-tight hero-heading">
               <span class="hero-title-accent">Useful &amp;</span><br>
               <span class="text-body-emphasis">free Bitcoin tools</span>
            </h1>

            <!-- Tagline -->
            <p class="lead text-body-secondary mb-4 fw-normal fs-5">
               Made for the Bitcoin community. Open-source suite of analytics, cryptographic tools, and valuation
               models.
            </p>

            <!-- Action Buttons -->
            <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
               <a href="#categoryCards"
                  class="btn btn-primary rounded-pill px-4 py-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm">
                  <span>Explore all tools</span>
               </a>
               <a href="https://bitcointalk.org/index.php?topic=5445282.0" target="_blank" rel="noopener"
                  class="btn btn-outline-secondary border-0 bg-body-secondary rounded-pill px-3 py-2 fw-semibold text-body d-inline-flex align-items-center gap-2">
                  <span>Bitcointalk ANN</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" class="opacity-50" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                     stroke-linejoin="round">
                     <path d="M7 7h10v10" />
                     <path d="M7 17 17 7" />
                  </svg>
               </a>
               <a href="https://github.com/bitmover-studio/bitcoindata" target="_blank" rel="noopener"
                  class="btn btn-outline-secondary border-0 bg-body-secondary rounded-pill px-3 py-2 fw-semibold text-body d-inline-flex align-items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     viewBox="0 0 16 16">
                     <path
                        d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                  </svg>
                  <span>GitHub</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" class="opacity-50" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                     stroke-linejoin="round">
                     <path d="M7 7h10v10" />
                     <path d="M7 17 17 7" />
                  </svg>
               </a>
            </div>

         </div>
      </div>

      <!-- Right Column: Minimalist Lucide-Inspired Graphic -->
      <div class="col-12 col-lg-5 col-xl-6 d-none d-lg-flex align-items-center justify-content-center">
         <div class="hero-vector-wrapper position-relative w-100" style="max-width: 520px;" aria-hidden="true">
            <svg class="hero-vector-svg w-100 h-auto" viewBox="0 0 520 400" fill="none"
               xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
               <defs>
                  <!-- Radial gradient mask for faded border -->
                  <radialGradient id="heroFadeMaskGrad" cx="50%" cy="50%" r="50%">
                     <stop offset="0%" stop-color="#fff" stop-opacity="1" />
                     <stop offset="60%" stop-color="#fff" stop-opacity="0.85" />
                     <stop offset="85%" stop-color="#fff" stop-opacity="0.25" />
                     <stop offset="100%" stop-color="#fff" stop-opacity="0" />
                  </radialGradient>
                  <mask id="heroFadeMask">
                     <ellipse cx="260" cy="200" rx="250" ry="180" fill="url(#heroFadeMaskGrad)" />
                  </mask>

               </defs>

               <!-- 1. Faint Isometric Diamond Grid -->
               <g stroke="currentColor" stroke-opacity="0.08" stroke-width="0.9" mask="url(#heroFadeMask)">
                  <!-- Slope +0.5 lines (dx=520, dy=260) -->
                  <line x1="0" y1="-180" x2="520" y2="80" />
                  <line x1="0" y1="-150" x2="520" y2="110" />
                  <line x1="0" y1="-120" x2="520" y2="140" />
                  <line x1="0" y1="-90" x2="520" y2="170" />
                  <line x1="0" y1="-60" x2="520" y2="200" />
                  <line x1="0" y1="-30" x2="520" y2="230" />
                  <line x1="0" y1="0" x2="520" y2="260" />
                  <line x1="0" y1="30" x2="520" y2="290" />
                  <line x1="0" y1="60" x2="520" y2="320" />
                  <line x1="0" y1="90" x2="520" y2="350" />
                  <line x1="0" y1="120" x2="520" y2="380" />
                  <line x1="0" y1="150" x2="520" y2="410" />
                  <line x1="0" y1="180" x2="520" y2="440" />
                  <line x1="0" y1="210" x2="520" y2="470" />
                  <line x1="0" y1="240" x2="520" y2="500" />

                  <!-- Slope -0.5 lines -->
                  <line x1="0" y1="160" x2="520" y2="-100" />
                  <line x1="0" y1="190" x2="520" y2="-70" />
                  <line x1="0" y1="220" x2="520" y2="-40" />
                  <line x1="0" y1="250" x2="520" y2="-10" />
                  <line x1="0" y1="280" x2="520" y2="20" />
                  <line x1="0" y1="310" x2="520" y2="50" />
                  <line x1="0" y1="340" x2="520" y2="80" />
                  <line x1="0" y1="370" x2="520" y2="110" />
                  <line x1="0" y1="400" x2="520" y2="140" />
                  <line x1="0" y1="430" x2="520" y2="170" />
                  <line x1="0" y1="460" x2="520" y2="200" />
                  <line x1="0" y1="490" x2="520" y2="230" />
                  <line x1="0" y1="520" x2="520" y2="260" />
                  <line x1="0" y1="550" x2="520" y2="290" />
                  <line x1="0" y1="580" x2="520" y2="320" />
               </g>

               <!-- 2. Logo loaded from file -->
               <image href="/img/bitcoin-data-science-logo-web.svg" xlink:href="/img/bitcoin-data-science-logo-web.svg"
                  x="140" y="80" width="220" height="220" class="opacity-75" />
            </svg>
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
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wallet preview-icon"><path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"/><path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"/></svg>`
               },
               {
                  name: "Unit Converter",
                  link: "/bitcoin-units-converter",
                  title: "Bitcoin Units Converter",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-right preview-icon"><path d="M8 3 4 7l4 4"/><path d="M4 7h16"/><path d="m16 21 4-4-4-4"/><path d="M20 17H4"/></svg>`
               },
               {
                  name: "Verify Message",
                  link: "/verify-message",
                  title: "Verify Bitcoin Signed Message",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 -960 960 960" fill="currentColor"><path d="M638-80 468-250l56-56 114 114 226-226 56 56L638-80ZM480-520l320-200H160l320 200Zm0 80L160-640v400h206l80 80H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v174l-80 80v-174L480-440Zm0 0Zm0-80Zm0 80Z"/></svg>`
               },
               {
                  name: "DCA Calculator",
                  link: "/dca-calculator",
                  title: "Dollar Cost Averaging Calculator",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="48 -912 864 864" width="18px" fill="currentColor"><path d="M226.75-186.77Q210-203.54 210-227.5v-105q0-23.96 16.78-40.73Q243.56-390 267.53-390t40.72 16.77Q325-356.46 325-332.5v105q0 23.96-16.78 40.73Q291.44-170 267.47-170t-40.72-16.77Zm232.5.07q-16.75-16.7-16.75-40.56v-305.38q0-23.86 16.78-40.61T500.03-590q23.97 0 40.72 16.7t16.75 40.56v305.38q0 23.86-16.78 40.61T499.97-170q-23.97 0-40.72-16.7Zm232.5-.07Q675-203.54 675-227.5v-505q0-23.96 16.78-40.73Q708.56-790 732.53-790t40.72 16.77Q790-756.46 790-732.5v505q0 23.96-16.78 40.73Q756.44-170 732.47-170t-40.72-16.77Z"/></svg>`,
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
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" /><path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" /></svg>`
               },
               {
                  name: "AltcoinsTalks Notifications",
                  link: "/altcoinstalk/notification.php",
                  title: "AltcoinsTalks Mention & Quote Notifications",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M5.85 3.5a.75.75 0 0 0-1.117-1 9.719 9.719 0 0 0-2.348 4.876.75.75 0 0 0 1.479.248A8.219 8.219 0 0 1 5.85 3.5ZM19.267 2.5a.75.75 0 1 0-1.118 1 8.22 8.22 0 0 1 1.987 4.124.75.75 0 0 0 1.48-.248A9.72 9.72 0 0 0 19.266 2.5Z" /><path fillRule="evenodd" d="M12 2.25A6.75 6.75 0 0 0 5.25 9v.75a8.217 8.217 0 0 1-2.119 5.52.75.75 0 0 0 .298 1.206c1.544.57 3.16.99 4.831 1.243a3.75 3.75 0 1 0 7.48 0 24.583 24.583 0 0 0 4.83-1.244.75.75 0 0 0 .298-1.205 8.217 8.217 0 0 1-2.118-5.52V9A6.75 6.75 0 0 0 12 2.25ZM9.75 18c0-.034 0-.067.002-.1a25.05 25.05 0 0 0 4.496 0l.002.1a2.25 2.25 0 1 1-4.5 0Z" clipRule="evenodd" /></svg>`
               },
               {
                  name: "Giveaway Manager",
                  link: "/giveaway-manager",
                  title: "Provably Fair Giveaway Manager",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z" /></svg>`
               },
            ]
         },
         {
            id: "jjg",
            title: "JayJuanGee (JJG) Models",
            badge: "Retirement & Valuation",
            description: "Financial planning models by Bitcointalk member JayJuanGee (JJG) anchoring Bitcoin valuation to the 200-week moving average (200-WMA) for sustainable living and independence.",
            viewBox: "0 0 24 24",
            icon: `<g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v16a2 2 0 0 0 2 2h16"/><path d="m19 9-5 5-4-4-3 3"/></g>`,
            tools: [
               {
                  name: "Withdrawal Strategy",
                  link: "/withdrawal-strategy",
                  title: "JJG Sustainable Withdrawal Strategy",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-no-axes-combined preview-icon"><path d="M12 16v5"/><path d="M16 14.639V21"/><path d="M20 10.656V21"/><path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15"/><path d="M4 18.463V21"/><path d="M8 14.656V21"/></svg>`
               },
               {
                  name: "Fuck You Status",
                  link: "/fuckyoustatus",
                  title: "Fuck You Status Calculator",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16" fill="currentColor">
  <path d="M4.968 9.75a.5.5 0 1 0-.866.5A4.5 4.5 0 0 0 8 12.5a4.5 4.5 0 0 0 3.898-2.25.5.5 0 1 0-.866-.5A3.5 3.5 0 0 1 8 11.5a3.5 3.5 0 0 1-3.032-1.75M7 5.116V5a1 1 0 0 0-1-1H3.28a1 1 0 0 0-.97 1.243l.311 1.242A2 2 0 0 0 4.561 8H5a2 2 0 0 0 1.994-1.839A3 3 0 0 1 8 6c.393 0 .74.064 1.006.161A2 2 0 0 0 11 8h.438a2 2 0 0 0 1.94-1.515l.311-1.242A1 1 0 0 0 12.72 4H10a1 1 0 0 0-1 1v.116A4.2 4.2 0 0 0 8 5c-.35 0-.69.04-1 .116"/>
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-1 0A7 7 0 1 0 1 8a7 7 0 0 0 14 0"/>
</svg>   `
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
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield preview-icon"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/></svg>`
               },
               {
                  name: "Raw Tx Hex",
                  link: "/bitcoin-raw-transaction-hex",
                  title: "Bitcoin Raw Transaction Hex Decoder",
                  icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-code-corner preview-icon"><path d="M4 12.15V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.706.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2h-3.35"/><path d="M14 2v5a1 1 0 0 0 1 1h5"/><path d="m5 16-3 3 3 3"/><path d="m9 22 3-3-3-3"/></svg>`
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