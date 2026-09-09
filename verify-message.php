<!doctype html>
<html lang="en">

<head>
   <?php
   $title = "Verify Bitcoin Signed Message - bitcoin data.science";
   $description = "Verify the authenticity and integrity of Bitcoin signed messages in your browser. Supports P2PKH, SegWit, and Bech32 Bitcoin addresses.";
   $keywords = "Verify Bitcoin Message, Bitcoin signature verifier, Bitcoin signed message, verify address signature, bitcoinjs-message, bitcoinjs-lib, SegWit, Bech32, P2PKH";
   $canonical = "https://bitcoindata.science/verify-message";
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
   ?>
   <script type="application/ld+json">
      {
         "@context": "https://schema.org",
         "@graph": [{
            "@type": "WebPage",
            "name": "Verify Bitcoin Signed Message - bitcoin data.science",
            "description": "Verify the authenticity of Bitcoin signed messages in your browser. Check signatures for Legacy P2PKH, Nested SegWit P2SH-P2WPKH, and Native SegWit Bech32 P2WPKH addresses.",
            "alternateName": [
               "bitcoindata.science",
               "Bitcoin Data Science",
               "bitcoin datascience"
            ],
            "url": "https://bitcoindata.science/verify-message",
            "sameAs": [
               "https://bitcoindata.science/verify-message.php"
            ]
         }, {
            "@type": "FAQPage",
            "mainEntity": [{
               "@type": "Question",
               "name": "What is a Bitcoin signed message?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "A Bitcoin signed message is a cryptographic proof produced using the private key of a Bitcoin address. It proves ownership of the address and confirms the message content has not been altered, without spending any funds or revealing private keys."
               }
            }, {
               "@type": "Question",
               "name": "Does verifying a message send my data to a server?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "No. Verification is performed 100% client-side in your browser using cryptographic libraries. Your address, message, and signature are never transmitted over the internet."
               }
            }, {
               "@type": "Question",
               "name": "Which Bitcoin address types are supported for message verification?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Standard Legacy addresses (P2PKH, starting with 1), Nested SegWit addresses (P2SH-P2WPKH, starting with 3), and Native SegWit addresses (Bech32 P2WPKH, starting with bc1q) are fully supported."
               }
            }, {
               "@type": "Question",
               "name": "Can I verify a bitcoin signed message in the browser?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Yes. Verification is performed 100% client-side in your browser using cryptographic libraries. Your address, message, and signature are never transmitted over the internet."
               }
            }]
         }]
      }
   </script>
   <!-- BitcoinJS Libraries -->
   <script src="modules/bitcoinjs-lib.js"></script>
   <script src="modules/bitcoinjs-message.js"></script>
   <style>
      .form-control:focus,
      .form-select:focus {
         box-shadow: 0 0 0 0.25rem var(--theme-blue-alpha) !important;
         border-color: var(--bs-primary) !important;
      }

      .font-monospace-sm {
         font-family: var(--bs-font-monospace);
         font-size: 0.875rem;
      }

      .paste-btn {
         background: transparent;
         border: none;
         color: var(--bs-secondary-color);
         transition: color 0.15s ease, transform 0.15s ease;
         padding: 0.25rem 0.5rem;
      }

      .paste-btn:hover {
         color: var(--bs-primary);
         transform: scale(1.1);
      }

      .result-card {
         transition: all 0.3s ease;
      }

      .copy-badge {
         cursor: pointer;
         transition: opacity 0.15s ease;
      }

      .copy-badge:hover {
         opacity: 0.8;
      }

      .nav-pills .nav-link {
         color: var(--bs-body-color);
         border-radius: 12px;
         font-weight: 500;
         padding: 0.5rem 1.25rem;
         transition: all 0.2s ease;
      }

      .nav-pills .nav-link.active {
         background-color: var(--bs-primary);
         color: #fff;
         font-weight: 600;
      }
   </style>
</head>

<body>
   <!-- Navbar -->
   <header>
      <navbar-component></navbar-component>
   </header>

   <!-- Page Content Header -->
   <?php
   $h1 = '<span class="d-none d-md-inline">Bitcoin </span>Message Verifier';
   $h2 = 'Verify the authenticity and cryptographic integrity of Bitcoin signed messages.';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>

   <div class="py-3">

      <div class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm">

         <!-- How it works (Inspiration from PGP Tool & bitcoin-balance-check) -->
         <p class="section-label mb-4">How it works</p>
         <div class="row g-3 mb-4">
            <div class="col-12 col-sm-6 col-lg-3">
               <div class="d-flex align-items-start gap-3">
                  <span
                     class="d-flex align-items-center justify-content-center rounded-circle bg-body-secondary flex-shrink-0"
                     style="width:38px;height:38px;">
                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                        class="text-primary" viewBox="0 0 16 16">
                        <path
                           d="M5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56" />
                     </svg>
                  </span>
                  <div>
                     <p class="fw-semibold mb-0">100% Client-Side</p>
                     <p class="text-body-secondary mb-0 small">All calculations run locally in your browser. Zero
                        data
                        sent to any server.</p>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
               <div class="d-flex align-items-start gap-3">
                  <span
                     class="d-flex align-items-center justify-content-center rounded-circle bg-body-secondary flex-shrink-0"
                     style="width:38px;height:38px;">
                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                        class="text-primary" viewBox="0 0 16 16">
                        <path
                           d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
                     </svg>
                  </span>
                  <div>
                     <p class="fw-semibold mb-0">Signer Address</p>
                     <p class="text-body-secondary mb-0 small">Enter the Bitcoin address (Legacy 1..., SegWit
                        3..., or
                        Bech32 bc1q...).</p>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
               <div class="d-flex align-items-start gap-3">
                  <span
                     class="d-flex align-items-center justify-content-center rounded-circle bg-body-secondary flex-shrink-0"
                     style="width:38px;height:38px;">
                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                        class="text-primary" viewBox="0 0 16 16">
                        <path
                           d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                        <path
                           d="M3 4.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 3a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                     </svg>
                  </span>
                  <div>
                     <p class="fw-semibold mb-0">Original Message</p>
                     <p class="text-body-secondary mb-0 small">The exact text that was signed. Even an extra space
                        changes the signature.</p>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
               <div class="d-flex align-items-start gap-3">
                  <span
                     class="d-flex align-items-center justify-content-center rounded-circle bg-body-secondary flex-shrink-0"
                     style="width:38px;height:38px;">
                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                        class="text-primary" viewBox="0 0 16 16">
                        <path
                           d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2" />
                     </svg>
                  </span>
                  <div>
                     <p class="fw-semibold mb-0">Base64 Signature</p>
                     <p class="text-body-secondary mb-0 small">The 65-byte ECDSA cryptographic signature generated
                        by
                        the signer's wallet.</p>
                  </div>
               </div>
            </div>
         </div>

         <hr class="border-secondary opacity-25 mb-4">

         <!-- Main Work Area: Input (Left) & Result (Right on LG+) -->
         <div class="row g-4">
            <div class="col-12 col-lg-6">

               <!-- Mode Selection Pills (Individual Fields vs Clearsigned Block) -->
               <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                  <ul class="nav nav-pills bg-body-secondary p-1 rounded-4" id="modeTabs" role="tablist">
                     <li class="nav-item" role="presentation">
                        <button class="nav-link active fs-6" id="fields-tab" data-bs-toggle="pill"
                           data-bs-target="#fields-pane" type="button" role="tab" aria-controls="fields-pane"
                           aria-selected="true">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                              class="bi bi-card-text me-1 mb-1" viewBox="0 0 16 16">
                              <path
                                 d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                              <path
                                 d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                           </svg>
                           Separate Fields
                        </button>
                     </li>
                     <li class="nav-item" role="presentation">
                        <button class="nav-link fs-6" id="clearsign-tab" data-bs-toggle="pill"
                           data-bs-target="#clearsign-pane" type="button" role="tab" aria-controls="clearsign-pane"
                           aria-selected="false">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                              class="bi bi-file-earmark-code me-1 mb-1" viewBox="0 0 16 16">
                              <path
                                 d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 1 1 1h8a1 1 0 0 0 1-1V4.5z" />
                              <path
                                 d="M8.646 6.646a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L10.293 9 8.646 7.354a.5.5 0 0 1 0-.708m-1.292 0a.5.5 0 0 0-.708 0l-2 2a.5.5 0 0 0 0 .708l2 2a.5.5 0 0 0 .708-.708L5.707 9l1.647-1.646a.5.5 0 0 0 0-.708" />
                           </svg>
                           Clearsigned Message Block
                        </button>
                     </li>
                  </ul>

                  <div class="d-flex gap-2">
                     <button type="button"
                        class="btn bg-body-secondary text-primary btn-sm rounded-3 d-inline-flex align-items-center gap-1"
                        id="sampleBtn" onclick="loadSample()" title="Load an example signed message">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                           stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                           class="lucide lucide-file-text-icon lucide-file-text">
                           <path
                              d="M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z" />
                           <path d="M14 2v5a1 1 0 0 0 1 1h5" />
                           <path d="M10 9H8" />
                           <path d="M16 13H8" />
                           <path d="M16 17H8" />
                        </svg>
                        Try Sample Data
                     </button>
                     <button type="button" class="paste-btn small" onclick="clearAll()" title="Clear all input fields">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                           stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                           class="lucide lucide-x-icon lucide-x">
                           <path d="M18 6 6 18" />
                           <path d="m6 6 12 12" />
                        </svg>
                        Clear
                     </button>
                  </div>
               </div>

               <!-- Tab Content -->
               <div class="tab-content" id="modeTabsContent">

                  <!-- TAB 1: Separate Fields -->
                  <div class="tab-pane fade show active" id="fields-pane" role="tabpanel" aria-labelledby="fields-tab"
                     tabindex="0">

                     <!-- 1. Bitcoin Address Input -->
                     <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                           <label for="bitcoinaddress"
                              class="fw-semibold small text-body-secondary d-flex align-items-center">
                              Bitcoin Address
                              <span id="addressBadge" class="badge ms-2 d-none"></span>
                           </label>
                           <button type="button" class="paste-btn small" onclick="pasteTo('bitcoinaddress')"
                              title="Paste from clipboard">
                              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                 class="bi bi-clipboard me-1" viewBox="0 0 16 16">
                                 <path
                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                 <path
                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                              </svg>
                              Paste
                           </button>
                        </div>
                        <div class="position-relative">
                           <input type="text"
                              class="form-control border-0 bg-body-secondary rounded-4 font-monospace-sm py-3 px-3 fw-medium"
                              id="bitcoinaddress" placeholder="1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa or bc1q..."
                              onfocus="validateAddress()" oninput="validateAddress()" onchange="validateAddress()"
                              spellcheck="false" autocomplete="off">
                           <div class="invalid-feedback ps-2" id="addressFeedback">Please enter a valid Bitcoin address
                              (P2PKH, P2SH, or Bech32).</div>
                           <div class="valid-feedback ps-2" id="addressValidFeedback">Valid Bitcoin address</div>
                        </div>
                     </div>

                     <!-- 2. Message Input -->
                     <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                           <label for="message" class="fw-semibold small text-body-secondary">
                              Message Content
                           </label>
                           <div class="d-flex align-items-center gap-2">
                              <span id="charCount" class="text-muted small">0 chars</span>
                              <button type="button" class="paste-btn small" onclick="pasteTo('message')"
                                 title="Paste from clipboard">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                    class="bi bi-clipboard me-1" viewBox="0 0 16 16">
                                    <path
                                       d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                    <path
                                       d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                                 </svg>
                                 Paste
                              </button>
                           </div>
                        </div>
                        <div class="form-floating border-0">
                           <textarea
                              class="form-control border-0 bg-body-secondary rounded-4 font-monospace-sm fw-medium"
                              id="message" placeholder="Message content" style="height: 140px;" oninput="updateCounts()"
                              spellcheck="false"></textarea>
                           <label for="message" class="text-body-secondary"></label>
                        </div>
                     </div>

                     <!-- 3. Signature Input -->
                     <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                           <label for="signature" class="fw-semibold small text-body-secondary">
                              Base64 Signature
                           </label>
                           <button type="button" class="paste-btn small" onclick="pasteTo('signature')"
                              title="Paste from clipboard">
                              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                 class="bi bi-clipboard me-1" viewBox="0 0 16 16">
                                 <path
                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                 <path
                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                              </svg>
                              Paste
                           </button>
                        </div>
                        <div class="form-floating border-0">
                           <textarea
                              class="form-control border-0 bg-body-secondary rounded-4 font-monospace-sm fw-medium"
                              id="signature" placeholder="Signature" style="height: 85px;"
                              spellcheck="false"></textarea>
                           <label for="signature" class="text-body-secondary"></label>
                        </div>
                     </div>
                     <div class="d-flex justify-content-between align-items-center mt-2">
                        <small class="text-muted">Convert separate fields into a clearsigned message block.</small>
                        <button type="button" class="btn btn-secondary btn-sm rounded-3" id="extractToClearsignBtn"
                           onclick="extractFieldsToClearsigned(false)">
                           Extract to Clearsign &rarr;
                        </button>
                     </div>

                  </div>

                  <!-- TAB 2: Clearsigned Block (PGP Tool Style) -->
                  <div class="tab-pane fade" id="clearsign-pane" role="tabpanel" aria-labelledby="clearsign-tab"
                     tabindex="0">
                     <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                           <label for="clearsignedBlock" class="fw-semibold small text-body-secondary">
                              Paste Clearsigned Bitcoin Message Block
                           </label>
                           <button type="button" class="paste-btn small" onclick="pasteTo('clearsignedBlock')"
                              title="Paste from clipboard">
                              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                 class="bi bi-clipboard me-1" viewBox="0 0 16 16">
                                 <path
                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                 <path
                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                              </svg>
                              Paste
                           </button>
                        </div>
                        <div class="form-floating border-0">
                           <textarea
                              class="form-control border-0 bg-body-secondary rounded-4 font-monospace-sm fw-medium"
                              id="clearsignedBlock" placeholder="Paste clearsigned message block..."
                              style="height: 220px;" oninput="parseClearsignedBlock(true)"
                              spellcheck="false">-----BEGIN BITCOIN SIGNED MESSAGE-----</textarea>
                           <label for="clearsignedBlock" class="text-body-secondary"></label>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                           <small class="text-muted">Accepts Bitcoin Core, Electrum, Sparrow, and other formats.</small>
                           <button type="button" class="btn btn-secondary btn-sm rounded-3" id="extractToFieldsBtn"
                              onclick="parseClearsignedBlock(false)">
                              Extract to Fields &rarr;
                           </button>
                        </div>
                     </div>
                  </div>

               </div>

               <!-- Actions Toolbar -->
               <div class="d-flex flex-wrap align-items-center gap-2 gap-md-3 pt-2">
                  <!-- Submit button with state animations -->
                  <button type="button"
                     class="btn btn-primary btn-lg d-inline-flex align-items-center justify-content-center px-4 fs-6 rounded-3"
                     id="verifyBtn" onclick="handleVerify()"
                     style="position: relative; overflow: hidden; transition: background-color 0.3s ease;">
                     <span id="verify-label" style="transition: opacity 0.2s, transform 0.2s;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                           class="bi bi-shield-check me-2 mb-1" viewBox="0 0 16 16">
                           <path
                              d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56" />
                           <path
                              d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                        </svg>
                        Verify Signature
                     </span>
                     <div id="verify-spinner" class="spinner-border spinner-border-sm position-absolute" role="status"
                        style="opacity: 0; transition: opacity 0.2s, transform 0.2s; pointer-events: none;">
                        <span class="visually-hidden">Verifying...</span>
                     </div>
                     <div id="verify-success"
                        style="opacity: 0; transform: scale(0.5); position: absolute; transition: opacity 0.2s, transform 0.2s; pointer-events: none;">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="3"
                           fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path d="M20 6L9 17l-5-5" />
                        </svg>
                     </div>
                  </button>

                  <!-- Share button -->
                  <button type="button"
                     class="btn btn-secondary btn-lg fs-6 px-4 rounded-3 d-inline-flex align-items-center gap-2"
                     id="shareBtn" onclick="saveAndShare()">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-share" viewBox="0 0 16 16">
                        <path
                           d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z" />
                     </svg>
                     Share
                  </button>

                  <!-- Share options container -->
                  <div id="shareContainer" class="w-100 mt-2 d-none">
                     <div class="p-3 rounded-4 bg-body-secondary border border-secondary border-opacity-10">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                           <span class="fw-semibold small text-body-secondary">Share Verification</span>
                           <button type="button" class="btn-close btn-close-sm"
                              onclick="document.getElementById('shareContainer').classList.add('d-none')"
                              aria-label="Close"></button>
                        </div>

                        <!-- Option 1: Permalink -->
                        <div class="mb-3">
                           <label for="shareUrl"
                              class="text-body-secondary small fw-medium mb-1 d-block">Permalink</label>
                           <div class="input-group">
                              <input type="text" id="shareUrl"
                                 class="form-control form-control-sm font-monospace-sm bg-body border-0" readonly
                                 onclick="this.select()">
                              <button class="btn btn-primary btn-sm px-3" type="button" id="copyShareBtn"
                                 onclick="copyShareUrl('shareUrl', 'copyShareBtn')">Copy Link</button>
                           </div>
                        </div>

                        <!-- Option 2: BBCode for Forums -->
                        <div>
                           <label for="shareBbcode" class="text-body-secondary small fw-medium mb-1 d-block">BBCode
                              (Forums)</label>
                           <div class="input-group">
                              <input type="text" id="shareBbcode"
                                 class="form-control form-control-sm font-monospace-sm bg-body border-0" readonly
                                 onclick="this.select()">
                              <button class="btn btn-secondary btn-sm px-3" type="button" id="copyBbcodeBtn"
                                 onclick="copyShareUrl('shareBbcode', 'copyBbcodeBtn')">Copy BBCode</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>

            <!-- Right Column: Verification Result Section -->
            <div class="col-12 col-lg-6">
               <!-- Verification Result Section -->
               <div id="resultCard" class="result-card rounded-4 p-md-4 p-3 d-none">
                  <p class="section-label mb-3" id="resultLabel">Verification Result</p>

                  <!-- Success Banner -->
                  <div id="resultSuccess" class="d-none">
                     <div
                        class="d-flex align-items-center gap-3 p-3 rounded-4 bg-success bg-opacity-10 border border-success border-opacity-25 mb-4">
                        <div
                           class="d-flex align-items-center justify-content-center rounded-circle bg-success text-white flex-shrink-0"
                           style="width: 44px; height: 44px;">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                              class="bi bi-check2" viewBox="0 0 16 16">
                              <path
                                 d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                           </svg>
                        </div>
                        <div>
                           <h4 class="h5 fw-bold text-success mb-1">Good Signature (Verified)</h4>
                           <p class="text-body-secondary mb-0 small" id="successDesc">The cryptographic signature is
                              valid
                              and
                              authentic. It confirms that the message was signed by the private key corresponding to
                              this
                              Bitcoin
                              address and the message was not modified.</p>
                        </div>
                     </div>

                     <!-- Details Grid -->
                     <div class="row g-3">
                        <div class="col-12 col-xl-6">
                           <div class="p-3 rounded-3 bg-body-secondary">
                              <p class="text-body-secondary small mb-1">Verified Address</p>
                              <div class="d-flex align-items-center justify-content-between">
                                 <code class="text-primary font-monospace-sm text-break" id="resAddress"></code>
                                 <span class="copy-badge badge bg-secondary-subtle text-secondary ms-2"
                                    onclick="copyText('resAddress')" title="Copy address">Copy</span>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 col-xl-6">
                           <div class="p-3 rounded-3 bg-body-secondary">
                              <p class="text-body-secondary small mb-1">Address Format & Key</p>
                              <p class="fw-semibold mb-0" id="resKeyType">-</p>
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="p-3 rounded-3 bg-body-secondary">
                              <p class="text-body-secondary small mb-1">Bitcoin Signed Message Hash (SHA-256d)</p>
                              <div class="d-flex align-items-center justify-content-between">
                                 <code class="text-body font-monospace-sm text-break" id="resHash"></code>
                                 <span class="copy-badge badge bg-secondary-subtle text-secondary ms-2"
                                    onclick="copyText('resHash')" title="Copy hash">Copy</span>
                              </div>
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="p-3 rounded-3 bg-body-secondary">
                              <p class="text-body-secondary small mb-1">Signed Message Preview</p>
                              <pre class="mb-0 text-body font-monospace-sm text-break" id="resMessage"
                                 style="white-space: pre-wrap; max-height: 160px; overflow-y: auto;"></pre>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- Failure Banner -->
                  <div id="resultFailure" class="d-none">
                     <div
                        class="d-flex align-items-center gap-3 p-3 rounded-4 bg-danger bg-opacity-10 border border-danger border-opacity-25 mb-4">
                        <div
                           class="d-flex align-items-center justify-content-center rounded-circle bg-danger text-white flex-shrink-0"
                           style="width: 44px; height: 44px;">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                              class="bi bi-x-lg" viewBox="0 0 16 16">
                              <path
                                 d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                           </svg>
                        </div>
                        <div>
                           <h4 class="h5 fw-bold text-danger mb-1">Verification Failed (Bad Signature)</h4>
                           <p class="text-body-secondary mb-0 small" id="resErrorMsg">The signature does not match the
                              provided
                              address or the message has been altered.</p>
                        </div>
                     </div>

                     <div id="failureDetails" class="p-3 rounded-3 bg-body-secondary d-none">
                        <p class="text-body-secondary small mb-1">Diagnostic Information</p>
                        <p class="small mb-1" id="failDiagnosis"></p>
                        <div id="recoveredAddrBox" class="d-none mt-2">
                           <p class="text-body-secondary small mb-0">Address recovered from signature:</p>
                           <code class="text-warning-emphasis font-monospace-sm text-break" id="recoveredAddr"></code>
                        </div>
                     </div>
                  </div>

               </div>
            </div>

         </div>

      </div>

      <!-- Educational FAQ & Technical Explanation -->
      <article class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm mt-4">
         <p class="section-label mb-4">Frequently Asked Questions & Technical Details</p>

         <div class="accordion accordion-flush" id="faqAccordion">

            <div class="accordion-item bg-transparent border-bottom border-secondary border-opacity-10 py-2">
               <h2 class="accordion-header" id="faq1">
                  <button class="accordion-button collapsed bg-transparent shadow-none fw-semibold fs-6" type="button"
                     data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false"
                     aria-controls="collapse1">
                     What does "Good Signature" prove?
                  </button>
               </h2>
               <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="faq1"
                  data-bs-parent="#faqAccordion">
                  <div class="accordion-body text-body-secondary small pt-1">
                     It proves mathematically that the message was signed by whoever controls the private key
                     corresponding to the specified Bitcoin address, and that the message content has not been altered
                     in transit by even a single character. It does not transfer any coins or expose the private key.
                  </div>
               </div>
            </div>

            <div class="accordion-item bg-transparent border-bottom border-secondary border-opacity-10 py-2">
               <h2 class="accordion-header" id="faq2">
                  <button class="accordion-button collapsed bg-transparent shadow-none fw-semibold fs-6" type="button"
                     data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false"
                     aria-controls="collapse2">
                     Why would signature verification fail?
                  </button>
               </h2>
               <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2"
                  data-bs-parent="#faqAccordion">
                  <div class="accordion-body text-body-secondary small pt-1">
                     Common reasons include:
                     <ul class="mb-0 mt-2">
                        <li><strong>Modified message:</strong> Changing a single letter, punctuation mark, or even
                           trailing whitespace changes the double SHA-256 hash completely.</li>
                        <li><strong>Wrong address:</strong> The signature was made by a different Bitcoin address than
                           the one supplied.</li>
                        <li><strong>Truncated signature:</strong> A standard Bitcoin ECDSA signature must be a 65-byte
                           base64 string (starts with <code>H</code>, <code>I</code>, <code>G</code>, <code>J</code>, or
                           <code>K</code>).
                        </li>
                     </ul>
                  </div>
               </div>
            </div>

            <div class="accordion-item bg-transparent border-bottom border-secondary border-opacity-10 py-2">
               <h2 class="accordion-header" id="faq3">
                  <button class="accordion-button collapsed bg-transparent shadow-none fw-semibold fs-6" type="button"
                     data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false"
                     aria-controls="collapse3">
                     How does the Bitcoin message signing algorithm work?
                  </button>
               </h2>
               <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3"
                  data-bs-parent="#faqAccordion">
                  <div class="accordion-body text-body-secondary small pt-1">
                     <ol class="mb-0">
                        <li><strong>Magic Prefix:</strong> To prevent a signed message from accidentally being
                           interpreted as a raw Bitcoin transaction, the standard prepends the byte length and string:
                           <code>\x18Bitcoin Signed Message:\n</code>.
                        </li>
                        <li><strong>VarInt Encoding:</strong> The message length is encoded as a compact VarInt,
                           followed by the UTF-8 bytes of the message.</li>
                        <li><strong>Double SHA-256:</strong> The combined payload is hashed twice with SHA-256
                           (<code>SHA256(SHA256(payload))</code>).</li>
                        <li><strong>Secp256k1 Recovery:</strong> The 65-byte signature encodes <code>r</code>,
                           <code>s</code>, and a recovery flag byte. Using elliptic curve point math, the public key is
                           recovered and hashed (<code>HASH160</code>) to regenerate the address and verify matching
                           equality.
                        </li>
                     </ol>
                  </div>
               </div>
            </div>

            <div class="accordion-item bg-transparent border-bottom border-secondary border-opacity-10 py-2">
               <h2 class="accordion-header" id="faq4">
                  <button class="accordion-button collapsed bg-transparent shadow-none fw-semibold fs-6" type="button"
                     data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false"
                     aria-controls="collapse4">
                     Which address formats are supported?
                  </button>
               </h2>
               <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4"
                  data-bs-parent="#faqAccordion">
                  <div class="accordion-body text-body-secondary small pt-1">
                     This tool supports all standard Bitcoin message signing formats:
                     <ul class="mb-0 mt-2">
                        <li><strong>P2PKH (Legacy):</strong> Addresses starting with <code>1</code> (compressed and
                           uncompressed public keys).</li>
                        <li><strong>P2SH-P2WPKH (Nested SegWit):</strong> Addresses starting with <code>3</code>.</li>
                        <li><strong>Bech32 (Native SegWit):</strong> Addresses starting with <code>bc1q</code>
                           (BIP-173).</li>
                     </ul>
                  </div>
               </div>
            </div>

            <div class="accordion-item bg-transparent py-2">
               <h2 class="accordion-header" id="faq5">
                  <button class="accordion-button collapsed bg-transparent shadow-none fw-semibold fs-6" type="button"
                     data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false"
                     aria-controls="collapse5">
                     Can I verify Taproot (bc1p...) addresses?
                  </button>
               </h2>
               <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="faq5"
                  data-bs-parent="#faqAccordion">
                  <div class="accordion-body text-body-secondary small pt-1">
                     Taproot addresses (starting with <code>bc1p</code>) use Schnorr signatures and a newer proposed
                     specification called <strong>BIP-322</strong>. Standard Bitcoin wallets (Bitcoin Core, Electrum,
                     Sparrow) use the established ECDSA format for addresses starting with 1, 3, and bc1q.
                     <strong>Not</strong> currently supported
                  </div>
               </div>
            </div>

         </div>
      </article>

   </div>
   </main>

   <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content p-3">
            <div class="modal-header">
               <h3 class="modal-title fs-5" id="alertModalLabel">Alert</h3>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div id="alertModalMessage"></div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>

   <footer-component></footer-component>

   <script src="modules/crypto-js.min.js"></script>
   <script src="components/verify-message.js?v=0.2"></script>
</body>

</html>