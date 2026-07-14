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
      }, {
        "@type": "FAQPage",
        "mainEntity": [{
          "@type": "Question",
          "name": "How to run a Provably Fair Giveaway using Bitcoin Blockhash?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "To run a provably fair giveaway, enter the list of competitors, specify the target Bitcoin block number, and the number of winners. The tool will use the blockhash of the specified block to randomly select winners from the list of competitors."
          }
        }]
      }]
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
  <style>
    .code-container {
      border: 1px solid var(--bs-border-color);
      border-radius: 12px;
      overflow: hidden;
      margin-top: 1rem;
      margin-bottom: 1.5rem;
    }

    .code-header {
      background-color: #1e1e1e !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      font-size: 0.75rem;
      color: #8b949e;
      padding: 0.5rem 1rem;
    }

    .code-body {
      background-color: #0f141c !important;
      color: #e6edf3;
      padding: 1rem;
      margin: 0;
      font-family: var(--bs-font-monospace);
      font-size: 0.85rem;
      overflow-x: auto;
    }

    .code-body code {
      color: inherit !important;
    }

    .code-keyword {
      color: #ff7b72;
      font-weight: bold;
    }

    .code-function {
      color: #d2a8ff;
    }

    .code-number {
      color: #79c0ff;
    }

    .code-comment {
      color: #8b949e;
      font-style: italic;
    }

    .hover-white:hover {
      color: #fff !important;
    }
  </style>
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

  <div class="py-3">

    <div class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm">

      <!-- How it works -->
      <p class="section-label mb-5">Instructions</p>
      <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-5">
          <div class="d-flex align-items-start gap-3">
            <span class="d-flex align-items-center justify-content-center rounded-circle bg-body-secondary flex-shrink-0" style="width:36px;height:36px;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
              </svg>
            </span>
            <div>
              <p class="fw-semibold mb-0">One competitor per line</p>
              <p class="text-body-secondary mb-0 small">Paste your list of participants, one name or identifier per line.</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-5">
          <div class="d-flex align-items-start gap-3">
            <span class="d-flex align-items-center justify-content-center rounded-circle bg-body-secondary flex-shrink-0" style="width:36px;height:36px;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
              </svg>
            </span>
            <div>
              <p class="fw-semibold mb-0">Set a target block</p>
              <p class="text-body-secondary mb-0 small">Enter the Bitcoin block number whose hash will seed the random draw.</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-5">
          <div class="d-flex align-items-start gap-3">
            <span class="d-flex align-items-center justify-content-center rounded-circle bg-body-secondary flex-shrink-0" style="width:36px;height:36px;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.048.991V8.504l0 .034z" />
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
              </svg>
            </span>
            <div>
              <p class="fw-semibold mb-0">Provably fair</p>
              <p class="text-body-secondary mb-0 small">Winners are derived from the blockhash — verifiable by anyone on the blockchain.</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-5">
          <div class="d-flex align-items-start gap-3">
            <span class="d-flex align-items-center justify-content-center rounded-circle bg-body-secondary flex-shrink-0" style="width:36px;height:36px;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z" />
              </svg>
            </span>
            <div>
              <p class="fw-semibold mb-0">Shareable link</p>
              <p class="text-body-secondary mb-0 small">Generate a link to share your giveaway setup — data is encrypted client-side.</p>
            </div>
          </div>
        </div>
      </div>

      <hr class="border-secondary opacity-25 mb-4">

      <!-- Giveaway Form -->
      <form action="javascript:go()">

        <div class="form-floating mb-3 border-0 font-monospace">
          <textarea class="form-control text-body-emphasis border-0 bg-body-secondary rounded-4 lh-base fw-medium"
            placeholder="Competitors" id="manually" rows="6" style="height: 180px">satoshi&#10;Finney</textarea>
          <label for="manually" class="fw-medium lh-base fs-6">Participants</label>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-sm-6">
            <div class="form-floating border-0">
              <input type="number" min="1" step="1"
                onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                class="form-control border-0 bg-body-secondary rounded-4 text-body-emphasis fw-medium" id="n_winners"
                value="1">
              <label for="n_winners" class="fw-medium lh-base fs-6">How many winners?</label>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-floating border-0">
              <input type="number" min="0" step="1"
                onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                class="form-control border-0 bg-body-secondary rounded-4 lh-base fw-medium text-body-emphasis" id="block"
                value="0">
              <label for="block" class="fw-medium lh-base fs-6">Target Block</label>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-start gap-2 gap-md-3 mb-3">
          <button type="submit" class="btn btn-primary btn-lg d-inline-flex align-items-center justify-content-center px-4 rounded fs-6" id="submitbutton" style="position: relative; overflow: hidden; transition: background-color 0.3s ease;">
            <span id="submit-label" style="transition: opacity 0.2s, transform 0.2s;">Pick Winners</span>
            <div id="submit-spinner" class="spinner-border spinner-border-sm position-absolute" role="status" style="opacity: 0; transition: opacity 0.2s, transform 0.2s; pointer-events: none;">
              <span class="visually-hidden">Loading...</span>
            </div>
            <div id="submit-success" style="opacity: 0; transform: scale(0.5); position: absolute; transition: opacity 0.2s, transform 0.2s; pointer-events: none;">
              <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 6L9 17l-5-5" />
              </svg>
            </div>
          </button>
          <button type="button" class="btn btn-secondary border-2 btn-lg d-inline-flex align-items-center gap-2 px-4 rounded fs-6"
            onclick="save_share()">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
              <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z" />
            </svg>
            Share
          </button>
        </div>

        <!-- Share URL field -->
        <div style="position: relative;" class="mb-3">
          <label for="url" class="visually-hidden">Share URL</label>
          <input type="url"
            class="form-control-lg border-0 bg-body-secondary rounded-4 lh-base fw-normal fs-6 font-monospace w-100 text-body"
            id="url" readonly=""
            style="padding-right: 3rem;"
            title="Shareable link">
          <button type="button" id="copy-url-btn" onclick="copyUrlBtn()"
            title="Copy link"
            style="position:absolute; right:10px; top:50%; transform:translateY(-50%); background:none; border:none; padding:4px; cursor:pointer; color: var(--bs-secondary-color); line-height:1; transition: color 0.15s ease, transform 0.15s ease;"
            onmouseenter="this.style.color='var(--bs-primary)'; this.style.transform='translateY(-50%) scale(1.15)'"
            onmouseleave="this.style.color='var(--bs-secondary-color)'; this.style.transform='translateY(-50%) scale(1)'">
            <svg id="copy-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 -960 960 960">
              <path d="M360-240q-33 0-56.5-23.5T280-320v-480q0-33 23.5-56.5T360-880h360q33 0 56.5 23.5T800-800v480q0 33-23.5 56.5T720-240H360Zm0-80h360v-480H360v480ZM200-80q-33 0-56.5-23.5T120-160v-560h80v560h440v80H200Zm160-240v-480 480Z" />
            </svg>
            <svg id="check-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" style="display:none; color:var(--bs-success)">
              <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
            </svg>
          </button>
        </div>

      </form>

    </div>

    <!-- Results -->
    <div class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm mt-4" id="results-section">
      <p class="section-label mb-4">Results</p>
      <p class="mb-2">Block hash: <output id="block-output" class="text-break font-monospace"></output></p>
      <div id="verify"></div>
      <p class="mb-2">Decimal number: <code class="text-primary text-break" id="rolled-number"></code></p>
      <p class="mb-0 pb-0"><strong>Winner: </strong><span class="h4"><span id="winner" class="badge bg-success-subtle text-success"></span></span></p>
      <output id="n_winner_div"></output>
    </div>

    <!-- Explanation -->
    <article class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm mt-4">
      <p class="section-label mb-4">How the draw works</p>
      <h3 class="fw-bold mb-3">Provably Fair Selection Algorithm</h3>
      <p class="text-body-secondary mb-4">
        A draw is <strong>provably fair</strong> when the winner is selected deterministically from an unpredictable, publicly verifiable seed. This tool uses the hash of a Bitcoin block as its source of entropy. Because Bitcoin block hashes are generated by decentralized miners solving complex cryptographic puzzles, they cannot be manipulated or predicted beforehand.
      </p>

      <div class="border-top py-5 row">
        <div class="col-6">
          <h5 class="fw-bold mb-3">1. Hexadecimal to Decimal</h5>

          <p class="text-body-secondary small">
            The target block hash is a 64-character hexadecimal string. To perform arithmetic, we extract the last 6 characters (which range from <code>000000</code> to <code>ffffff</code>) and convert them into a base-10 integer:
          </p>
          <p class="text-body-secondary small mb-0">
            This gives us a deterministic number between <code>0</code> and <code>16,777,215</code>.
          </p>
        </div>
        <div class="col-6">
          <div class="code-container">
            <div class="code-header d-flex justify-content-between align-items-center">
              <span>JavaScript</span>
              <button class="btn btn-sm btn-link p-0 text-white-50 hover-white" onclick="copyCode(this)" title="Copy Code">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V2Zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6Z" />
                  <path d="M2 5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2h-1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1V5H2Z" />
                </svg>
              </button>
            </div>
            <pre class="code-body"><code><span class="code-keyword">let</span> decimal = <span class="code-function">parseInt</span>(blockhash.<span class="code-function">slice</span>(-<span class="code-number">6</span>), <span class="code-number">16</span>);</code></pre>
          </div>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="border-top py-5 row">
        <div class="col-6">
          <h5 class="fw-bold mb-3">2. Selecting the Index</h5>
          <p class="text-body-secondary small">
            We divide the decimal value by the total number of participants and find the division remainder using the <strong>modulo operator (%)</strong>. The remainder acts as the index pointer:
          </p>
          <p class="text-body-secondary small mb-0">
            The index is guaranteed to fall between <code>0</code> and <code>competitors.length - 1</code>.
          </p>
        </div>
        <div class="col-6">
          <div class="code-container">
            <div class="code-header d-flex justify-content-between align-items-center">
              <span>JavaScript</span>
              <button class="btn btn-sm btn-link p-0 text-white-50 hover-white" onclick="copyCode(this)" title="Copy Code">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V2Zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6Z" />
                  <path d="M2 5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2h-1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1V5H2Z" />
                </svg>
              </button>
            </div>
            <pre class="code-body"><code><span class="code-keyword">let</span> index = decimal % competitors.length;
<span class="code-keyword">let</span> winner = competitors[index];</code></pre>
          </div>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="border-top py-5 row">
        <div class="col-6">
          <h5 class="fw-bold mb-3">3. Drawing Multiple Winners</h5>
          <p class="text-body-secondary small mb-0">
            To choose multiple winners without duplicates, the selected winner is removed from the array, shrinking the pool. The script shifts the blockhash slice window one index to the left to extract a new, independent entropy chunk, and recalculates:
          </p>
        </div>
        <div class="col-6">
          <div class="code-container">
            <div class="code-header d-flex justify-content-between align-items-center">
              <span>JavaScript</span>
              <button class="btn btn-sm btn-link p-0 text-white-50 hover-white" onclick="copyCode(this)" title="Copy Code">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V2Zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6Z" />
                  <path d="M2 5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2h-1a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1V5H2Z" />
                </svg>
              </button>
            </div>
            <pre class="code-body"><code><span class="code-comment">// Slice slide loop logic for Winner (N)</span>
<span class="code-keyword">let</span> n_decimal = <span class="code-function">parseInt</span>(blockhash.<span class="code-function">slice</span>(-(6 + step), blockhash.length - step), <span class="code-number">16</span>);
<span class="code-keyword">let</span> n_index = n_decimal % competitors.length;</code></pre>
          </div>
        </div>
      </div>
    </article>

  </div>

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
          <button type="button" class="btn btn-primary px-5 rounded" data-bs-dismiss="modal">Awesome!</button>
        </div>
      </div>
    </div>
  </div>

  </main>
  <footer-component></footer-component>
  <script src="../modules/crypto-js.min.js"></script>
  <script>
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

        let modalWinnersHtml = `<p><strong>Winner: </strong><br><span class="h4"><span class="badge bg-success-subtle text-success mt-2">${winner}</span></span></p>`;

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
            <span class="h4"><span class="badge bg-success-subtle text-success">${n_winner}</span></span></p>`;
              modalWinnersHtml += `<p><strong>Winner ${step + 1}: </strong><br><span class="h4"><span class="badge bg-success-subtle text-success mt-2">${n_winner}</span></span></p>`;
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
            origin: {
              y: 0.6
            }
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

    function copyUrlBtn() {
      const val = document.getElementById('url').value;
      if (!val) return;
      navigator.clipboard.writeText(val).then(() => {
        const copyIcon = document.getElementById('copy-icon');
        const checkIcon = document.getElementById('check-icon');
        copyIcon.style.display = 'none';
        checkIcon.style.display = 'inline';
        setTimeout(() => {
          copyIcon.style.display = 'inline';
          checkIcon.style.display = 'none';
        }, 2000);
      });
    }

    function copyCode(btn) {
      const codeEl = btn.closest('.code-container').querySelector('code');
      const text = codeEl.innerText;
      navigator.clipboard.writeText(text).then(() => {
        const originalHTML = btn.innerHTML;
        btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#00c951" viewBox="0 0 16 16">
          <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
        </svg>`;
        setTimeout(() => {
          btn.innerHTML = originalHTML;
        }, 1500);
      });
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
    } else {
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