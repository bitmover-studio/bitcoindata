<!doctype html>
<html lang="en">

<head>
   <?php
   $title = "bitcoin data.science - Data Analysis and bitcoin";
   $description = "Data analysis and tools for anything related to bitcoin.";
   $canonical = "https://bitcoindata.science/";
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
   ?>
   <script type="application/ld+json">
      {
         "@context": "https://schema.org",
         "@type": "Organization",
         "name": "bitcoindata.science",
         "description": "Data analysis and tools for anything related to bitcoin.",
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
   $h1 = 'Welcome to <tt class="text-primary fw-bold">bitcoindata</tt>';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>
   <div class="my-4 row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xxl-3 g-4" id="cards">
   </div>

   <!-- /main page -->
   <script>
      const cardsData = [{
            title: "Balance Check",
            description: "See the balance of multiple bitcoin addresses at the same time. Scanning QRCode supported.",
            link: "bitcoin-balance-check",
            action: "Check your balance",
            icon: '<path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />',
         },
         {
            title: "Unit Converter",
            description: "Convert bitcoin units <code>BTC</code>, <code>mBTC</code>, <code>uBTC</code>, <code>bitcent</code>, <code>satoshi</code>, <code>finney</code> to USD, EUR or any other fiat currency.",
            link: "bitcoin-units-converter",
            action: "Convert units",
            icon: '<path fill-rule="evenodd"d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />',
         },
         {
            title: "JJG Withdrawal Strategy",
            description: "Ideas of sustainable withdrawal that calculates monthly budget limits.",
            link: "withdrawal-strategy",
            action: "Calculate limits",
            icon: '<path d="M5.5 13v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.5v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.084c1.992 0 3.416-1.033 3.416-2.82 0-1.502-1.007-2.323-2.186-2.44v-.088c.97-.242 1.683-.974 1.683-2.19C11.997 3.93 10.847 3 9.092 3H9V1.75a.25.25 0 0 0-.25-.25h-1a.25.25 0 0 0-.25.25V3h-.573V1.75a.25.25 0 0 0-.25-.25H5.75a.25.25 0 0 0-.25.25V3l-1.998.011a.25.25 0 0 0-.25.25v.989c0 .137.11.25.248.25l.755-.005a.75.75 0 0 1 .745.75v5.505a.75.75 0 0 1-.75.75l-.748.011a.25.25 0 0 0-.25.25v1c0 .138.112.25.25.25zm1.427-8.513h1.719c.906 0 1.438.498 1.438 1.312 0 .871-.575 1.362-1.877 1.362h-1.28zm0 4.051h1.84c1.137 0 1.756.58 1.756 1.524 0 .953-.626 1.45-2.158 1.45H6.927z" />',
         },
         {
            title: "Giveaway Manager",
            description: "<em>Provably fair</em> giveaway manager. Results easily verified and shareable.",
            link: "https://bitcoindata.science/giveaway-manager",
            action: "Go to giveaway",
            icon: ' <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A3 3 0 0 1 3 2.506zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43zM9 3h2.932l.023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0zM1 4v2h6V4zm8 0v2h6V4zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5z"/>',
         },
         {
            title: "Altcoinstalks Notification",
            description: "See when you are quoted or mentioned in the forum.",
            link: "altcoinstalk/notification.php",
            action: "Go to notifications",
            icon: '<path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>',
         },
         {
            title: "Image API",
            description: "Share bitcoin data such as address balances and transactions as an image in bitcointalk.org or any other forum.",
            link: "bitcointalk-api",
            action: "Go to image API",
            icon: '<path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" /> <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />',
         }
      ];

      // Generate the cards dynamically
      const cardsContainer = document.getElementById('cards');

      cardsData.forEach(card => {
         const cardCol = document.createElement('div');
         cardCol.className = 'col';

         cardCol.innerHTML = `
         <div class="card h-100 card-home bg-body-tertiary">
            <div class="card-body p-0">
               <div class="card-home-icon-wrapper">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">${card.icon}</svg>
               </div>

               <div class="text-content">
                  <h3 class="card-title-home">
                        ${card.title}
                  </h3>
                  <p class="card-desc-home">${card.description}</p>
               </div>
           </div>
           <div class="card-footer-home">
               <a href="${card.link}" class="btn-home-action stretched-link" title="${card.action}">
                  <span>${card.action}</span>
                  <svg height="20" width="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
               </a>
            </div>
         </div>
    `;

         cardsContainer.appendChild(cardCol);
      });
   </script>
   </main>
   </div>
   <footer-component></footer-component>
</body>

</html>