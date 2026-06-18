<!doctype html>
<html lang="en">

<head>
   <?php 
   $title = "Giveaway Manager - Provably Fair Raffle Tool - bitcoin data.science";
   $description = "Manage your giveaways easily. Pick winners using provably fair method based on bitcoin blockhash.";
   $keywords = "Giveaway Manager,bitcointalk giveaway, giveaways, Raffle, Raffle Manager, blockhash giveaway, blockhash raffle";
   $canonical = "https://bitcoindata.science/giveaway-manager";
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
   ?>
  <script type="application/ld+json">
      {
         "@context": "https://schema.org",
         "@graph": [{
            "@type": "WebPage",
            "name": "Giveaway Manager - Provably Fair Raffle Tool",
            "description": "Manage your giveaways easily. Pick winners using provably fair method based on bitcoin blockhash.",
            "alternateName": [
              "bitcoindata.science",
              "Bitcoin Data Science",
              "bitcoin datascience"
            ],
            "url": "https://bitcoindata.science",
            "sameAs": [
              "https://bitcoindata.science"
            ]
            } , {
               "@type": "FAQPage",
               "mainEntity": [
                 {
                   "@type": "Question",
                   "name": "How to run a Provably Fair Giveaway using Bitcoin Blockhash?",
                   "acceptedAnswer": {
                     "@type": "Answer",
                     "text": "To run a provably fair giveaway, enter the list of competitors, specify the target Bitcoin block number, and the number of winners. The tool will use the blockhash of the specified block to randomly select winners from the list of competitors."
                   }
                 }
               ]
             }
             ]
       }
   </script>
  <script>
    if (window.location.search.length > 0) {
      const meta = document.createElement("meta");
      meta.name = "robots";
      meta.content = "noindex, follow";
      document.head.appendChild(meta);
    }
  </script>
  <link href="../css/style.css" rel="stylesheet">
  <script src="../components/navbar.js" defer></script>
  <script src="../components/footer.js" defer></script>
  <script src="../components/ad.js" defer></script>
</head>

<body>
  <header>
    <base href="/" />
    <navbar-component></navbar-component>
  </header>
   <?php
   $h1 = 'Bitcoin Giveaway Manager';
   $h2 = 'Manage your giveaways easily. Pick winners using provably fair method based on bitcoin blockhash.';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>

    <form action="javascript:go()" class="bg-body-tertiary rounded-top-4 p-md-5 p-4 mt-5">
      <div class="mb-3">
        <h2 class="h4">Giveaway Details</h2>

        <div class="form-floating my-3 border-0">
          <textarea class="form-control text-body-emphasis border-0 bg-body-secondary rounded-2 lh-base fw-medium"
            placeholder="Competitors" id="manually" rows="6" style="height: 180px">satoshi&#10;Finney</textarea>

          <label for="manually" class="fw-medium lh-base fs-6">One competitor per line</label>

        </div>


        <div class="mb-3">
          <div class="form-floating border-0">
            <input type="number" min="1" step="1"
              onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
              class="form-control border-0 bg-body-secondary rounded-2 text-body-emphasis fw-medium" id="n_winners"
              value="1">
            <label for="n_winners" class="fw-medium lh-base fs-6">How many winners?</label>

          </div>
        </div>

        <div class="mb-3">
          <div class="form-floating border-0">

            <input type="number" min="0" step="1"
              onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
              class="form-control border-0 bg-body-secondary rounded-2 lh-base fw-medium text-body-emphasis" id="block"
              value="0">
            <label for="block" class="form-label">Target Block</label>
          </div>
        </div>

        <div class="form-group row mt-4">
          <div class="col-auto">
            <button type="submit" class="btn btn-primary btn-lg d-inline-flex align-items-center justify-content-center px-4" id="submitbutton" style="position: relative; overflow: hidden; transition: background-color 0.3s ease;">
              <span id="submit-label" style="transition: opacity 0.2s, transform 0.2s;">Submit</span>
              <div id="submit-spinner" class="spinner-border spinner-border-sm position-absolute" role="status" style="opacity: 0; transition: opacity 0.2s, transform 0.2s; pointer-events: none;">
                <span class="visually-hidden">Loading...</span>
              </div>
              <div id="submit-success" style="opacity: 0; transform: scale(0.5); position: absolute; transition: opacity 0.2s, transform 0.2s; pointer-events: none;">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 6L9 17l-5-5" />
                </svg>
              </div>
            </button>
          </div>
          <div class="col-auto">
            <button type="button" class="btn btn-secondary d-inline-block btn-lg px-4"
              onclick="save_share()">Share</button>
          </div>
          <div class="col-12 mt-4">
            <label for="url" class="visually-hidden">Share URL</label>
            <input type="url"
              class="form-control-lg border-0 bg-body-secondary rounded-2 lh-base fw-normal fs-6 h-100 font-monospace w-100 text-body"
              id="url" readonly="" onclick="copyurl()" data-toggle="tooltip" data-placement="top" title=""
              data-original-title="Click to copy to clipboard">
          </div>
        </div>
      </div>
    </form>

    <div class="bg-body-tertiary rounded-0 p-md-5 p-4 mt-2">
      <h3 class="mb-4">Results</h3>
      <p>Block hash: <output id="block-output" class="text-break"></output></p>
      <div id="verify"></div>
      <p>Decimal number: <code class="text-primary text-break" id="rolled-number"></code></p>
      <p class="mb-0 pb-0"><strong>Winner: </strong><span class="h4"><span id="winner"
            class="badge text-bg-success "></span></span></p>
      <output id="n_winner_div"></output>
    </div>

    <article class="bg-body-tertiary rounded-bottom-4 p-md-5 p-4 mt-2">
      <h3 class="h4 pb-2 mb-4">Provably fair giveaway manager</h3>
      <p>
        As the <code>blockhash</code> is just a number, its last 6 digits is converted to <code>decimal</code> using
        this function:</p>

      <code class="text-primary">var decimal =  parseInt(blockhash.slice(-6), 16);</code>
      <p></p>
      <p>Now we have an integer (0 to 16777215) from the <code>blockhash</code>.</p>

      <p>After dividing this <code>decimal</code> by the number of participants, we use the <i>modulo operator
          (<code>%</code>)</i>
        to get the division remainder becomes
        the <code>index_number</code>.</p>

      <p>This <code>index_number</code> is applied in the participants list, to get the position of the winner.</p>

      <code class="text-primary">
          var index_number = decimal % competitors.length;</code>
      <br />
      <code class="text-primary">
          var winner = competitors[index_number];
        </code>

      <p></p>

      <p>For additional winners, the past winners are removed from the list and one more digit is added from the
        blockhash.</p>

    </article>

    <!-- Winner Modal -->
    <div class="modal fade" id="winnerModal" tabindex="-1" aria-labelledby="winnerModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
          <div class="modal-header border-0">
            <h1 class="modal-title fs-5" id="winnerModalLabel">Giveaway Results</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center" id="modal-winners-list">
          </div>
          <div class="modal-footer justify-content-center border-0">
            <button type="button" class="btn btn-primary px-5" data-bs-dismiss="modal">Awesome!</button>
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer-component></footer-component>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"
    integrity="sha512-E8QSvWZ0eCLGk4km3hxSsNmGWbLtSCSUcewDQPQWZF6pEU8GlT8a5fF32wOl1i8ftdMhssTrF/OhyGWwonTcXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    async function go() {
      const submitBtn = document.getElementById('submitbutton');
      const submitLabel = document.getElementById('submit-label');
      const submitSpinner = document.getElementById('submit-spinner');
      const submitSuccess = document.getElementById('submit-success');

      const winnerDiv = document.getElementById("winner");
      const nWinnerDiv = document.getElementById("n_winner_div");
      const blockInput = document.getElementById("block").value;
      const nWinnersInput = parseInt(document.getElementById("n_winners").value);
      const competitorsInput = document.getElementById("manually").value;

      // Winners Reset
      if (submitLabel) {
        submitBtn.style.pointerEvents = 'none';
        submitLabel.style.opacity = '0';
        submitLabel.style.transform = 'translateY(-10px)';
        submitSpinner.style.opacity = '1';
      } else {
        submitBtn.innerHTML = '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>';
      }
      winnerDiv.innerHTML = "";
      nWinnerDiv.innerHTML = '';
      document.getElementById("rolled-number").innerHTML = '';

      const competitors = competitorsInput.split("\n").filter(n => n.trim());

      let isSuccess = false;

      try {
        // Fetch the block hash
        let response;
        try {
          response = await fetch(`https://mempool.space/api/block-height/${blockInput}`);
          if (!response.ok) throw new Error('Primary API error');
        } catch (e) {
          // Fallback to proxy
          response = await fetch(`/api/block-height.php?block=${blockInput}`);
        }

        if (!response || !response.ok) throw new Error('Block not found');

        const blockhash = await response.text();

        // Logic for the First Winner
        let decimal = parseInt(blockhash.slice(-6), 16);
        let index_number = decimal % competitors.length;
        let winner = competitors[index_number];

        document.getElementById("block-output").innerHTML = `<code class='text-primary'>${blockhash}</code> <a class='small text-muted' target='_blank' href='https://mempool.space/block/${blockInput}'>Verify</a>`;
        document.getElementById("rolled-number").innerHTML = decimal;
        winnerDiv.innerHTML = winner;

        let modalWinnersHtml = `<p><strong>Winner: </strong><br><span class="h4"><span class="badge text-bg-success mt-2">${winner}</span></span></p>`;

        // Remove the first winner from pool
        competitors.splice(index_number, 1);

        // Logic for Additional Winners
        if (nWinnersInput) {
          for (let step = 1; step < nWinnersInput; step++) {
            let n_winner_decimal = parseInt(blockhash.slice(-(6 + step), blockhash.length - step), 16);
            let n_winner_index_number = n_winner_decimal % competitors.length;
            let n_winner = competitors[n_winner_index_number];

            if (n_winner !== undefined) {
              nWinnerDiv.innerHTML += `
            <p><strong>Winner ${step + 1}: </strong>
            <span class="h4"><span class="badge text-bg-success">${n_winner}</span></span></p>`;
              modalWinnersHtml += `<p><strong>Winner ${step + 1}: </strong><br><span class="h4"><span class="badge text-bg-success mt-2">${n_winner}</span></span></p>`;
              competitors.splice(n_winner_index_number, 1);
            }
          }
        }

        document.getElementById('modal-winners-list').innerHTML = modalWinnersHtml;
        let winnerModalEl = document.getElementById('winnerModal');
        let winnerModal = bootstrap.Modal.getInstance(winnerModalEl) || new bootstrap.Modal(winnerModalEl);
        winnerModal.show();

        if (typeof confetti === 'function') {
          confetti({
            particleCount: 150,
            spread: 70,
            origin: { y: 0.6 }
          });
        }
        isSuccess = true;

      } catch (error) {
        // Error Handling (Block not mined yet)
        try {
          const tipResponse = await fetch('https://mempool.space/api/blocks/tip/height');
          const currentTip = await tipResponse.text();

          const blockdelta = blockInput - parseInt(currentTip);
          const fblocktime = new Date(new Date().getTime() + 10 * 60000 * blockdelta);

          document.getElementById("block-output").innerHTML = `
        Block <code>${blockInput}</code> not mined yet.<br/> 
        Will probably be mined at <time style='color:var(--bs-code-color);' class='font-monospace'>${fblocktime.toLocaleString()}</time>`;
        } catch (innerError) {
          document.getElementById("block-output").innerHTML = "Error fetching block data.";
        }
      } finally {
        if (submitLabel) {
          if (isSuccess) {
            submitSpinner.style.opacity = '0';
            submitSuccess.style.opacity = '1';
            submitSuccess.style.transform = 'scale(1)';
            submitBtn.classList.remove('btn-primary');
            submitBtn.classList.add('btn-success');
            
            setTimeout(() => {
              submitSuccess.style.opacity = '0';
              submitSuccess.style.transform = 'scale(0.5)';
              submitLabel.style.opacity = '1';
              submitLabel.style.transform = 'translateY(0)';
              submitBtn.classList.remove('btn-success');
              submitBtn.classList.add('btn-primary');
              submitBtn.style.pointerEvents = 'auto';
            }, 3000);
          } else {
            submitSpinner.style.opacity = '0';
            submitLabel.style.opacity = '1';
            submitLabel.style.transform = 'translateY(0)';
            submitBtn.style.pointerEvents = 'auto';
          }
        } else {
          submitBtn.innerText = "Submit";
        }
      }
    }

    // fix legacy url (with ?) for sharing
    if (window.location.search && !window.location.hash) {
      const payload = window.location.search.substring(1);
      window.location.replace(window.location.pathname + "#" + payload);
    }

    // saved and share
    function copyurl() {
      navigator.clipboard.writeText(document.getElementById('url').value)
    }

    function save_share() {
      let competitors_for_share = document.getElementById("manually").value
      let share_block = document.getElementById("block").value
      let share_n_winners = document.getElementById("n_winners").value
      let encrypted = CryptoJS.AES.encrypt(share_block + '&' + share_n_winners + '&' + competitors_for_share, "bitcoin");
      document.getElementById("url").value = 'https://bitcoindata.science/giveaway-manager/#' + encrypted;
    }

    //load saved data
    let payload = null;

    if (window.location.hash) {
      payload = window.location.hash.substring(1);
    } else if (window.location.search) {
      payload = window.location.search.substring(1);
    }

    if (payload) {
      var decrypted = CryptoJS.AES.decrypt(payload, "bitcoin");
      var saved_data = decrypted.toString(CryptoJS.enc.Utf8);
      var saved_data_array = saved_data.split("&");

      document.getElementById("block").value = saved_data_array[0]
      document.getElementById("n_winners").value = saved_data_array[1]
      document.getElementById("manually").value = saved_data_array[2]
      go();
    }
    else {
      // get last block height
      fetch('https://mempool.space/api/blocks/tip/height')
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.text();
        })
        .then(blockHeight => {
          document.getElementById("block").value = blockHeight;
        })
        .catch(error => {
          console.error('Fetch error: ', error);
        });
    }

  </script>
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js"></script>
</body>

</html>