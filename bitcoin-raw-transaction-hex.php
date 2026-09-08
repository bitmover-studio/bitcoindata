<!doctype html>
<html lang="en">

<head>
   <?php
   $title = "Get Transaction Hex - bitcoin data.science";
   $description = "Easily retrieve raw Bitcoin transaction hex format by transaction ID (txid). Inspect and copy raw transaction bytecode directly powered by mempool.space data.";
   $keywords = "Bitcoin Transaction Hex,Transaction Hex, Tx Hex, Get Bitcoin Transaction Hex";
   $canonical = "https://bitcoindata.science/bitcoin-raw-transaction-hex";
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
   ?>
   <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Get Bitcoin Raw Transaction Hex",
        "description": "Easily retrieve raw Bitcoin transaction hex format by transaction ID (txid). Inspect and copy raw transaction bytecode directly powered by mempool.space data.",
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
   $h1 = 'Get <span class="d-none d-md-inline">Bitcoin</span> Raw Transaction Hex';
   $mainClass = 'container-fluid col-lg-10 col-xl-8';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>

   <div class="bg-body-tertiary rounded p-5 border shadow-sm">
      <div class="mb-3">
         <label for="TransactionId" class="form-label">Enter bitcoin Transaction id:</label>
         <input type="text" class="form-control font-monospace bg-body" id="TransactionId" rows="6">
      </div>
      <button type="button" id="submit" class="btn btn-warning shadow-sm btn-lg px-5" onclick="handleClick()">Get
         Transaction Hex</button>
   </div>
   <p id="source" class="small text-muted text-end">Data from mempool.space.</p>

   <div id="hex" class="mt-4 px-3 text-break">
   </div>

   </main>
   <footer-component></footer-component>
   <script>

      const outputArea = document.getElementById("hex")
      var hex = "";
      async function handleClick() {
         document.getElementById("submit").innerHTML = '<span class="spinner-border spinner-border-sm me-3" role="status" aria-hidden="true"></span>Loading...'
         document.getElementById("submit").disabled = true;
         txId = document.getElementById('TransactionId').value;
         outputArea.innerHTML = await getTxHex(txId)
         document.getElementById("submit").innerHTML = 'Get Transaction Hex',
            document.getElementById("submit").disabled = false
      }

      async function getTxHex(id) {
         try {
            const response = await fetch('https://mempool.space/api/tx/' + id + '/hex');
            const data = await response.text();
            let txHex = data;
            return "<p>Transaction Hex:</p> <code class='text-break text-warning-emphasis'> " + txHex + "</code>"
         }
         catch (error) {
            console.warn(error)
         }
      };

   </script>
</body>

</html>
