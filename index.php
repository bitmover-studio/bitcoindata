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
   <header>
      <navbar-component></navbar-component>
   </header>
   <!-- Page Content -->
   <?php
   $h1 = 'Welcome to bitcoin data';
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
            icon: '<path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" /> </svg>',
         },
         {
            title: "Unit Converter",
            description: "Convert bitcoin units BTC, mBTC, uBTC, bitcent, satoshi, finney to USD, EUR or any other fiat currency.",
            link: "bitcoin-units-converter",
            action: "Convert units",
            icon: '<path fill-rule="evenodd"d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />',
         },
         {
            title: "JJG Withdrawal Strategy",
            description: "Ideas of sustainable withdrawal that calculates monthly budget limits.",
            link: "withdrawal-strategy",
            action: "Calculate withdrawal limits",
            icon: '<path d="M5.5 13v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.5v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.084c1.992 0 3.416-1.033 3.416-2.82 0-1.502-1.007-2.323-2.186-2.44v-.088c.97-.242 1.683-.974 1.683-2.19C11.997 3.93 10.847 3 9.092 3H9V1.75a.25.25 0 0 0-.25-.25h-1a.25.25 0 0 0-.25.25V3h-.573V1.75a.25.25 0 0 0-.25-.25H5.75a.25.25 0 0 0-.25.25V3l-1.998.011a.25.25 0 0 0-.25.25v.989c0 .137.11.25.248.25l.755-.005a.75.75 0 0 1 .745.75v5.505a.75.75 0 0 1-.75.75l-.748.011a.25.25 0 0 0-.25.25v1c0 .138.112.25.25.25zm1.427-8.513h1.719c.906 0 1.438.498 1.438 1.312 0 .871-.575 1.362-1.877 1.362h-1.28zm0 4.051h1.84c1.137 0 1.756.58 1.756 1.524 0 .953-.626 1.45-2.158 1.45H6.927z" />',
         },
         {
            title: "Giveaway Manager",
            description: "<em>Provably fair</em> giveaway manager. Results easily verified and shareable.",
            link: "https://bitcoindata.science/giveaway-manager",
            action: "Go to giveaway manager",
            icon: ' <path d="M8 7.982C9.664 6.309 13.825 9.236 8 13 2.175 9.236 6.336 6.31 8 7.982"/><path d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4zm0 1H7.5v3h-6zM8.5 4V1h3.75l2.25 3zM15 5v10H1V5z"/>',
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
         <div class="card h-100 border-0 bg-body-tertiary p-3 rounded-4 card-home">
            <div class="card-body m-4">
               <div class="icon-content">
                  <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="text-primary text-bold" viewBox="0 0 16 16">${card.icon}
               </div>

               <div class="text-content">
                  <h3 class="h3 fw-bold card-title my-5">
                        ${card.title}
                  </h3>
                  <p class="card-text text-body-secondary">${card.description}</p>
               </div>
           </div>
           <div class="card-footer bg-transparent border-0 m-4 ">
               <a href="${card.link}" class="btn rounded-pill btn-primary btn-lg text-normal fs-6 stretched-link py-3 px-4" style="font-weight:500" title="${card.action}">${card.action}</a>
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