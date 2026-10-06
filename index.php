<!doctype html>
<html lang="en">

<head>
   <?php
   $title = "bitcoindata.science - Collection of Free Bitcoin Tools";
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
   $showBG = false;
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>

   <!-- Hero Section: Lucide-inspired Hero (Left Text + Action Buttons, Right Isometric Vector Illustration) -->
   <section class="row align-items-center justify-content-between g-4 g-xl-5 pt-2 pt-md-4 pb-4 mb-5 bg-diamond-grid">
      <!-- Left Content Column -->
      <div class="col-12 col-lg-7 col-xl-6">
         <div class="pe-lg-3">

            <!-- Headline -->
            <p class="section-label">Built for the Bitcoin community</p>
            <h1 class="display-4 fw-bold mb-3 lh-sm tracking-tight hero-heading">
               <span class="hero-title-accent">Useful &amp;</span><br>
               <span class="text-body-emphasis">Free Bitcoin tools</span>
            </h1>

            <!-- Tagline -->
            <p class="lead text-body-secondary mb-4 fw-normal fs-5">
               Open-source collection of Bitcoin analytics, financial calculators, cryptographic tools,
               valuation models, and market utilities — built to help the Bitcoin community better understand, analyze,
               and navigate the crypto ecosystem.
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

      <!-- Right Column: Minimalist Graphic -->
      <div class="col-12 col-lg-5 col-xl-6 d-none d-lg-flex align-items-center justify-content-center">
         <div class="hero-vector-wrapper position-relative w-100" style="max-width: 520px;">
            <svg class="hero-vector-svg w-100 h-auto" viewBox="0 0 520 400" fill="none"
               xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
               <image href="/img/bitcoin-data-science-logo-web.svg" xlink:href="/img/bitcoin-data-science-logo-web.svg"
                  x="150" y="90" width="220" height="220" class="opacity-75" />
            </svg>
         </div>
      </div>
   </section>

   <!-- Category / Suite Cards (One for each breadcrumb) -->
   <p class="section-label mb-3">Tool Suites &amp; Categories</p>
   <div class="row row-cols-1 row-cols-lg-2 g-4 mb-5" id="categoryCards"></div>

   <script>
      // 2. Category / Breadcrumb Hub Cards (using shared menuData from components/menu-data.php)
      const categoryCardsData = menuData;

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