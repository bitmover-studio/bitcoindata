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
   $h1 = 'Show your support';
   $h2 = 'If this website is useful to you, consider donating to support its development.';
   $showAd = false;
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>

   <p class="my-4">Donate some bitcoin or other cryptocurrencies to the addresses below:</p>
   <div class="row row-cols-1 row-cols-md-2 g-2 text-center" id="addresses"></div>

   <p class="mt-4 h4">Bitcoindata in other websites</p>
   <div class="py-2 px-4">
      <a href="https://livecoins.com.br/verificador-de-saldo-de-enderecos-bitcoin/"
         title="Livecoins - Notícias sobre Bitcoin, criptomoedas e Blockchain - Livecoins" target="_blank"
         rel="noopener">
         <img src="https://livecoins.com.br/wp-content/uploads/2020/06/Livecoins-Logo.jpg"
            title="Livecoins - Notícias sobre Bitcoin, criptomoedas e Blockchain - Livecoins"
            alt="livecoins.com.br" height="38" width="160" class="p-2 bg-white rounded" />
      </a>
   </div>
   <div class="py-2 px-4">
      <a href="https://landofcrypto.com/bitcoindata-science-review/" title="Land of Crypto" target="_blank" rel="noopener">
         <img src="img/landofcrypto.png" title="Land of Crypto" alt="Land of Crypto" width="160" class="p-2 bg-black rounded" />
      </a>
   </div>
   <div class="py-2 px-4">
      <a href="https://bitlist.co/service/bitcoin-data" title="BitList" target="_blank" rel="noopener">
         <img src="img/bitlist.png" title="BitList" alt="bitlist.co" width="160" class="p-2 bg-black rounded" />
      </a>
   </div>
   <div class="py-2 px-4">
      <a href="https://kycnot.me/service/bitcoindata" title="KYCnot.me" target="_blank" rel="noopener">
         <svg xmlns="http://www.w3.org/2000/svg" width="160" viewBox="0 0 204 28" fill="#00c951">
            <path d=" M1 0a1 1 0 0 0-1 1v26a1 1 0 0 0 1 1h74a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1Zm4 4h2a1 1 0 0 1 1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 1 1 1v3h3a1 1 0 0 1 1 1v3h3a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3h-3a1 1 0 0 1-1-1v-3H9a1 1 0 0 0-1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1Zm12 0h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1zm12.82 0h2.37a1 1 0 0 1 .85.46L38 12.27l4.97-7.8A1 1 0 0 1 43.8 4h2.37a1 1 0 0 1 .85 1.54l-6.87 10.8a1 1 0 0 0-.16.53V23a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-6.13a1 1 0 0 0-.15-.53l-6.87-10.8A1 1 0 0 1 29.82 4ZM57 4h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H56v12h15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H57a1 1 0 0 1-1-1v-3h-3a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h3V5a1 1 0 0 1 1-1zm24 0a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V7.6l9.18 15.9c.18.3.5.5.86.5H99a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v15.4L86.83 4.5a1 1 0 0 0-.87-.5Zm29 0a1 1 0 0 0-1 1v3h12V5a1 1 0 0 0-1-1zm11 4v12h3a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1zm0 12h-12v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1zm-12 0V8h-3a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1zm21-16a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V8h4v15a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V8h4v3a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm27 0a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V11.4l5.53 12.02a1 1 0 0 0 .91.58h3.12a1 1 0 0 0 .91-.58L176 11.4V23a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-3.36a1 1 0 0 0-.9.58L168 19.21l-6.73-14.63a1 1 0 0 0-.9-.58Zm32 0a1 1 0 0 0-1 1v3h15a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm-1 4h-3a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1h-14a1 1 0 0 1-1-1v-3h7a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1h-7zm-38 12a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1z"></path>
         </svg>
      </a>
   </div>

   <p class="mt-4 h4">Top donators</p>
   <div class="py-2 px-4">
      <a href="https://bitcointalk.org/index.php?action=profile;u=252510" title="JayJuanGee">JayJuanGee</a>:
      Designed and funded the development and maintenance of some tools.
   </div>
   <div class="py-2 px-4">
      <a href="https://bitcointalk.org/index.php?action=profile;u=131361" title="Timelord2067">Timelord2067</a>:
      Donated the domain registrar's 5-year renewal.
   </div>
   <div class="py-2 px-4"><a href="https://bitcointalk.org/index.php?action=profile;u=314792"
         title="examplens">examplens</a>:
      Added this website to his server.</div>

   <p class="my-4 h4">Overview Stats and Traffic</p>
   <p>Website had an average traffic of over 20,000 unique visitors last month.</p>
   <img src="img/traffic-stats.png" class="img-fluid rounded mt-3" width="768" height="212"
      title="Website Traffic" alt="Cloudflare Website Traffic">

   <p class="my-4 pt-4 h4">Are you interested in advertising your brand here?</p>
   If you want to see your brand in our pages, just make an offer and tell us about your product.<br>
   <a href="mailto:bitmover@protonmail.ch" class="btn btn-primary mt-3 text-decoration-none rounded-pill btn-lg">Make an offer</a>
   </div>
   <!-- /main page -->
   </main>

   <footer-component></footer-component>
   <script type="text/javascript">
      // Tooltips
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

      // address list
      const addresses = [{
            blockchain: 'Bitcoin',
            ticker: 'BTC',
            address: 'bc1qnrqfg9p2huh6y5ggsrkz5w8es25yw498n42f5m'
         },
         {
            blockchain: 'Litecoin',
            ticker: 'LTC',
            address: 'ltc1qwl4f9xupajtzwcusftsqgu5u7fclzgvjar9pt5'
         },
         {
            blockchain: 'Ethereum',
            ticker: 'ETH',
            address: '0x6ff37c932d81924190e4bec36d1052dc78126a2d'
         },
         {
            blockchain: 'Liquid',
            ticker: 'L-BTC',
            address: 'VJL5eExSHNCPuKBncgUcSoa1vmB4ajKWY5MBEajZz2aRQUXx5WqwsdKNDu8KgKGHAnn8iK51o3ncmunk'
         },
      ];
      const addressesArea = document.getElementById("addresses");
      addressesArea.innerHTML =
         addresses.map(i => `
         <div class="col">
            <div class="card h-100 border-0 bg-transparent">
               <figure class="figure ms-3">
                  <img src="img/${i.address}.webp" class="figure-img img-fluid rounded"
                     alt="${i.blockchain} - buy me a coffee" title="${i.address}" width="130" height="130" />
                  <figcaption class="figure-caption text-break" data-bs-toggle="tooltip" data-bs-title="Copied!"
                     data-bs-delay="{'show':0,'hide':150}" data-bs-placement="right" data-bs-animation="true"
                     data-bs-trigger="click"
                     onclick="navigator.clipboard.writeText(document.getElementById('${i.blockchain + 1}').innerText);window.getSelection().selectAllChildren(document.getElementById('${i.blockchain + 1}'));">
                     <div class="small">${i.blockchain} (${i.ticker})</div>
                     <code class="text-break" id="${i.blockchain + 1}">${i.address}</code>
                     <svg xmlns="http://www.w3.org/2000/svg" fill="currentcolor" class="material-svg" height="48"
                        width="48" style="cursor: pointer;">
                        <path
                           d="M15 37.95q-1.25 0-2.125-.875T12 34.95v-28q0-1.25.875-2.125T15 3.95h22q1.25 0 2.125.875T40 6.95v28q0 1.25-.875 2.125T37 37.95Zm0-3h22v-28H15v28Zm-6 9q-1.25 0-2.125-.875T6 40.95V12.3q0-.65.425-1.075Q6.85 10.8 7.5 10.8q.65 0 1.075.425Q9 11.65 9 12.3v28.65h22.2q.65 0 1.075.425.425.425.425 1.075 0 .65-.425 1.075-.425.425-1.075.425Zm6-37v28-28Z" />
                     </svg>
                  </figcaption>
               </figure>
            </div>
         </div>`).join('')
   </script>
</body>

</html>