<!doctype html>
<html lang="en">

<head>
   <?php
   $title = "Verify PGP Signed Message - bitcoin data.science";
   $description = "Verify the authenticity and integrity of PGP/GPG signed messages in your browser. Supports clearsigned and detached signatures with OpenPGP.js — 100% client-side.";
   $keywords = "Verify PGP Message, PGP signature verifier, GPG verify, OpenPGP verify, clearsigned message, PGP public key, digital signature";
   $canonical = "https://bitcoindata.science/verify-pgp";
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
   ?>
   <script type="application/ld+json">
      {
         "@context": "https://schema.org",
         "@graph": [{
            "@type": "WebPage",
            "name": "Verify PGP Signed Message - bitcoin data.science",
            "description": "Verify the authenticity of PGP/GPG signed messages in your browser. Verify the letters of guarantee, clearsigned messages, detached signatures, and inline-signed messages — 100% client-side using OpenPGP.js.",
            "alternateName": [
               "bitcoindata.science",
               "Bitcoin Data Science",
               "bitcoin datascience"
            ],
            "url": "https://bitcoindata.science/verify-pgp",
            "sameAs": [
               "https://bitcoindata.science/verify-pgp.php"
            ]
         }, {
            "@type": "FAQPage",
            "mainEntity": [{
               "@type": "Question",
               "name": "What is a PGP signed message?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "A PGP signed message is a cryptographic proof produced using the private key of a PGP key pair. It proves authorship and confirms the message content has not been altered, without revealing the private key."
               }
            }, {
               "@type": "Question",
               "name": "Does verifying a PGP message send my data to a server?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "No. Verification is performed 100% client-side in your browser using the OpenPGP.js library. Your public key, message, and signature are never transmitted over the internet."
               }
            }, {
               "@type": "Question",
               "name": "What PGP signature formats are supported?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "This tool supports PGP clearsigned messages (BEGIN PGP SIGNED MESSAGE), detached signatures (BEGIN PGP SIGNATURE), and inline-signed PGP messages (BEGIN PGP MESSAGE)."
               }
            }, {
               "@type": "Question",
               "name": "Can I verify a PGP signed message in the browser?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Yes. Verification is performed 100% client-side in your browser using the OpenPGP.js cryptographic library. No data is sent to any server."
               }
            }, {
               "@type": "Question",
               "name": "Can I verify a Letter of Guarantee from a crypto service, exchange or mixer in the browser?",
               "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "Yes. Verification is performed 100% client-side in your browser using the OpenPGP.js cryptographic library. No data is sent to any server."
               }
            }]
         }]
      }
   </script>
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
   $h1 = '<span class="d-none d-md-inline">PGP </span>Signature Verifier';
   $h2 = 'Verify the authenticity and cryptographic integrity of PGP/GPG signed messages and letters of guarantee.';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>

   <div class="py-3">

      <div class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm">

         <!-- How it works -->
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
                     <p class="text-body-secondary mb-0 small">All cryptographic operations run locally in your browser
                        using OpenPGP.js. Zero data sent to any server.</p>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
               <div class="d-flex align-items-start gap-3">
                  <span
                     class="d-flex align-items-center justify-content-center rounded-circle bg-body-secondary flex-shrink-0"
                     style="width:38px;height:38px;">
                     <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="currentColor" class="text-primary">
                        <path
                           d="M223.5-423.5Q200-447 200-480t23.5-56.5Q247-560 280-560t56.5 23.5Q360-513 360-480t-23.5 56.5Q313-400 280-400t-56.5-23.5ZM280-240q-100 0-170-70T40-480q0-100 70-170t170-70q67 0 121.5 33t86.5 87h352l120 120-180 180-80-60-80 60-85-60h-47q-32 54-86.5 87T280-240Zm0-80q56 0 98.5-34t56.5-86h125l58 41 82-61 71 55 75-75-40-40H435q-14-52-56.5-86T280-640q-66 0-113 47t-47 113q0 66 47 113t113 47Z" />
                     </svg>
                  </span>
                  <div>
                     <p class="fw-semibold mb-0">Public Key</p>
                     <p class="text-body-secondary mb-0 small">Paste the signer's PGP public key block to verify
                        against.</p>
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
                     <p class="fw-semibold mb-0">Signed Message</p>
                     <p class="text-body-secondary mb-0 small">Paste a PGP clearsigned message block or provide the
                        message and detached signature separately.</p>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
               <div class="d-flex align-items-start gap-3">
                  <span
                     class="d-flex align-items-center justify-content-center rounded-circle bg-body-secondary flex-shrink-0"
                     style="width:38px;height:38px;">
                     <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="currentColor" class="text-primary">
                        <path
                           d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v159h-80v-79L480-440 160-640v400h480v80H160Zm320-360 320-200H160l320 200ZM160-240v-480 480Zm600 80q-17 0-28.5-11.5T720-200v-120q0-17 11.5-28.5T760-360v-40q0-33 23.5-56.5T840-480q33 0 56.5 23.5T920-400v40q17 0 28.5 11.5T960-320v120q0 17-11.5 28.5T920-160H760Zm40-200h80v-40q0-17-11.5-28.5T840-440q-17 0-28.5 11.5T800-400v40Z" />
                     </svg>
                  </span>
                  <div>
                     <p class="fw-semibold mb-0">Verify Letter of Guarantee</p>
                     <p class="text-body-secondary mb-0 small">Verify letters of guarantee issued by crypto services,
                        e.g. as mixers and exchanges.</p>
                  </div>
               </div>
            </div>
         </div>

         <hr class="border-secondary opacity-25 mb-4">

         <!-- Main Work Area: Input (Left) & Result (Right on LG+) -->
         <div class="row g-4">
            <div class="col-12 col-lg-6">

               <!-- Mode Selection Pills (Clearsigned vs Detached) -->
               <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                  <ul class="nav nav-pills bg-body-secondary p-1 rounded-4" id="pgpModeTabs" role="tablist">
                     <li class="nav-item" role="presentation">
                        <button class="nav-link active fs-6" id="pgp-clearsign-tab" data-bs-toggle="pill"
                           data-bs-target="#pgp-clearsign-pane" type="button" role="tab"
                           aria-controls="pgp-clearsign-pane" aria-selected="true">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                              class="bi bi-file-earmark-code me-1 mb-1" viewBox="0 0 16 16">
                              <path
                                 d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 1 1 1h8a1 1 0 0 0 1-1V4.5z" />
                              <path
                                 d="M8.646 6.646a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L10.293 9 8.646 7.354a.5.5 0 0 1 0-.708m-1.292 0a.5.5 0 0 0-.708 0l-2 2a.5.5 0 0 0 0 .708l2 2a.5.5 0 0 0 .708-.708L5.707 9l1.647-1.646a.5.5 0 0 0 0-.708" />
                           </svg>
                           Clearsigned Message
                        </button>
                     </li>
                     <li class="nav-item" role="presentation">
                        <button class="nav-link fs-6" id="pgp-detached-tab" data-bs-toggle="pill"
                           data-bs-target="#pgp-detached-pane" type="button" role="tab"
                           aria-controls="pgp-detached-pane" aria-selected="false">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                              class="bi bi-card-text me-1 mb-1" viewBox="0 0 16 16">
                              <path
                                 d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                              <path
                                 d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                           </svg>
                           Detached Signature
                        </button>
                     </li>
                  </ul>

                  <div class="d-flex gap-2">
                     <button type="button"
                        class="btn bg-body-secondary text-primary btn-sm rounded-3 d-inline-flex align-items-center gap-1"
                        id="pgpSampleBtn" onclick="pgpLoadSample()" title="Load an example PGP signed message">
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
                     <button type="button" class="paste-btn small" onclick="pgpClearAll()"
                        title="Clear all input fields">
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
               <div class="tab-content" id="pgpModeTabsContent">

                  <!-- TAB 1: Clearsigned Message -->
                  <div class="tab-pane fade show active" id="pgp-clearsign-pane" role="tabpanel"
                     aria-labelledby="pgp-clearsign-tab" tabindex="0">

                     <!-- Public Key Input -->
                     <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                           <label for="pgpPublicKey" class="fw-semibold small text-body-secondary">
                              Signer's Public Key
                           </label>
                           <button type="button" class="paste-btn small" onclick="pgpPasteTo('pgpPublicKey')"
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
                              id="pgpPublicKey" placeholder="Public Key" style="height: 140px;"
                              spellcheck="false">-----BEGIN PGP PUBLIC KEY BLOCK-----</textarea>
                           <label for="pgpPublicKey" class="text-body-secondary"></label>
                        </div>
                     </div>

                     <!-- Clearsigned Message Input -->
                     <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                           <label for="pgpClearsignedBlock" class="fw-semibold small text-body-secondary">
                              PGP Clearsigned Message
                           </label>
                           <button type="button" class="paste-btn small" onclick="pgpPasteTo('pgpClearsignedBlock')"
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
                              id="pgpClearsignedBlock" placeholder="Paste PGP clearsigned message..."
                              style="height: 220px;" spellcheck="false">-----BEGIN PGP SIGNED MESSAGE-----</textarea>
                           <label for="pgpClearsignedBlock" class="text-body-secondary"></label>
                        </div>
                        <small class="text-muted mt-2 d-block">Paste the full clearsigned message block including
                           <code>-----BEGIN PGP SIGNED MESSAGE-----</code> header.</small>
                     </div>

                  </div>

                  <!-- TAB 2: Detached Signature -->
                  <div class="tab-pane fade" id="pgp-detached-pane" role="tabpanel" aria-labelledby="pgp-detached-tab"
                     tabindex="0">

                     <!-- Public Key Input (Detached) -->
                     <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                           <label for="pgpPublicKeyDetached" class="fw-semibold small text-body-secondary">
                              Signer's Public Key
                           </label>
                           <button type="button" class="paste-btn small" onclick="pgpPasteTo('pgpPublicKeyDetached')"
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
                              id="pgpPublicKeyDetached" placeholder="Public Key" style="height: 140px;"
                              spellcheck="false">-----BEGIN PGP PUBLIC KEY BLOCK-----</textarea>
                           <label for="pgpPublicKeyDetached" class="text-body-secondary"></label>
                        </div>
                     </div>

                     <!-- Original Message Input -->
                     <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                           <label for="pgpDetachedMessage" class="fw-semibold small text-body-secondary">
                              Original Message
                           </label>
                           <button type="button" class="paste-btn small" onclick="pgpPasteTo('pgpDetachedMessage')"
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
                              id="pgpDetachedMessage" placeholder="Original message content" style="height: 140px;"
                              spellcheck="false"></textarea>
                           <label for="pgpDetachedMessage" class="text-body-secondary"></label>
                        </div>
                     </div>

                     <!-- Detached Signature Input -->
                     <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                           <label for="pgpDetachedSignature" class="fw-semibold small text-body-secondary">
                              Detached PGP Signature
                           </label>
                           <button type="button" class="paste-btn small" onclick="pgpPasteTo('pgpDetachedSignature')"
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
                              id="pgpDetachedSignature" placeholder="Detached PGP signature" style="height: 140px;"
                              spellcheck="false">-----BEGIN PGP SIGNATURE-----</textarea>
                           <label for="pgpDetachedSignature" class="text-body-secondary"></label>
                        </div>
                     </div>

                  </div>

               </div>

               <!-- Actions Toolbar -->
               <div class="d-flex flex-wrap align-items-center gap-2 gap-md-3 pt-2">
                  <!-- Submit button with state animations -->
                  <button type="button"
                     class="btn btn-primary btn-lg d-inline-flex align-items-center justify-content-center px-4 fs-6 rounded-3"
                     id="pgpVerifyBtn" onclick="pgpHandleVerify()"
                     style="position: relative; overflow: hidden; transition: background-color 0.3s ease;">
                     <span id="pgp-verify-label" style="transition: opacity 0.2s, transform 0.2s;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                           class="bi bi-shield-check me-2 mb-1" viewBox="0 0 16 16">
                           <path
                              d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56" />
                           <path
                              d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                        </svg>
                        Verify Signature
                     </span>
                     <div id="pgp-verify-spinner" class="spinner-border spinner-border-sm position-absolute"
                        role="status"
                        style="opacity: 0; transition: opacity 0.2s, transform 0.2s; pointer-events: none;">
                        <span class="visually-hidden">Verifying...</span>
                     </div>
                     <div id="pgp-verify-success"
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
                     id="pgpShareBtn" onclick="pgpSaveAndShare()">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-share" viewBox="0 0 16 16">
                        <path
                           d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z" />
                     </svg>
                     Share
                  </button>

                  <!-- Share options container -->
                  <div id="pgpShareContainer" class="w-100 mt-2 d-none">
                     <div class="p-3 rounded-4 bg-body-secondary border border-secondary border-opacity-10">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                           <span class="fw-semibold small text-body-secondary">Share Verification</span>
                           <button type="button" class="btn-close btn-close-sm"
                              onclick="document.getElementById('pgpShareContainer').classList.add('d-none')"
                              aria-label="Close"></button>
                        </div>

                        <!-- Option 1: Permalink -->
                        <div class="mb-3">
                           <label for="pgpShareUrl"
                              class="text-body-secondary small fw-medium mb-1 d-block">Permalink</label>
                           <div class="input-group">
                              <input type="text" id="pgpShareUrl"
                                 class="form-control form-control-sm font-monospace-sm bg-body border-0" readonly
                                 onclick="this.select()">
                              <button class="btn btn-primary btn-sm px-3" type="button" id="pgpCopyShareBtn"
                                 onclick="pgpCopyShareUrl('pgpShareUrl', 'pgpCopyShareBtn')">Copy Link</button>
                           </div>
                        </div>

                        <!-- Option 2: BBCode for Forums -->
                        <div>
                           <label for="pgpShareBbcode" class="text-body-secondary small fw-medium mb-1 d-block">BBCode
                              (Forums)</label>
                           <div class="input-group">
                              <input type="text" id="pgpShareBbcode"
                                 class="form-control form-control-sm font-monospace-sm bg-body border-0" readonly
                                 onclick="this.select()">
                              <button class="btn btn-secondary btn-sm px-3" type="button" id="pgpCopyBbcodeBtn"
                                 onclick="pgpCopyShareUrl('pgpShareBbcode', 'pgpCopyBbcodeBtn')">Copy BBCode</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>

            <!-- Right Column: Verification Result Section -->
            <div class="col-12 col-lg-6">
               <!-- Verification Result Section -->
               <div id="pgpResultCard" class="result-card rounded-4 p-md-4 p-3 d-none">
                  <p class="section-label mb-3" id="pgpResultLabel">Verification Result</p>

                  <!-- Success Banner -->
                  <div id="pgpResultSuccess" class="d-none">
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
                           <p class="text-body-secondary mb-0 small" id="pgpSuccessDesc">The cryptographic PGP signature
                              is
                              valid and authentic. The message was signed by the holder of the corresponding private key
                              and
                              has not been modified.</p>
                        </div>
                     </div>

                     <!-- Details Grid -->
                     <div class="row g-3">
                        <div class="col-12 col-xl-6">
                           <div class="p-3 rounded-3 bg-body-secondary">
                              <p class="text-body-secondary small mb-1">Signer Key ID</p>
                              <div class="d-flex align-items-center justify-content-between">
                                 <code class="text-primary font-monospace-sm text-break" id="pgpResKeyId"></code>
                                 <span class="copy-badge badge bg-secondary-subtle text-secondary ms-2"
                                    onclick="pgpCopyText('pgpResKeyId')" title="Copy Key ID">Copy</span>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 col-xl-6">
                           <div class="p-3 rounded-3 bg-body-secondary">
                              <p class="text-body-secondary small mb-1">Signer User ID</p>
                              <p class="fw-semibold mb-0 text-break" id="pgpResUserId">-</p>
                           </div>
                        </div>
                        <div class="col-12 col-xl-6">
                           <div class="p-3 rounded-3 bg-body-secondary">
                              <p class="text-body-secondary small mb-1">Key Algorithm</p>
                              <p class="fw-semibold mb-0" id="pgpResAlgorithm">-</p>
                           </div>
                        </div>
                        <div class="col-12 col-xl-6">
                           <div class="p-3 rounded-3 bg-body-secondary">
                              <p class="text-body-secondary small mb-1">Signature Created</p>
                              <p class="fw-semibold mb-0" id="pgpResSignDate">-</p>
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="p-3 rounded-3 bg-body-secondary">
                              <p class="text-body-secondary small mb-1">Key Fingerprint</p>
                              <div class="d-flex align-items-center justify-content-between">
                                 <code class="text-body font-monospace-sm text-break" id="pgpResFingerprint"></code>
                                 <span class="copy-badge badge bg-secondary-subtle text-secondary ms-2"
                                    onclick="pgpCopyText('pgpResFingerprint')" title="Copy fingerprint">Copy</span>
                              </div>
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="p-3 rounded-3 bg-body-secondary">
                              <p class="text-body-secondary small mb-1">Signed Message Preview</p>
                              <pre class="mb-0 text-body font-monospace-sm text-break" id="pgpResMessage"
                                 style="white-space: pre-wrap; max-height: 160px; overflow-y: auto;"></pre>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- Failure Banner -->
                  <div id="pgpResultFailure" class="d-none">
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
                           <p class="text-body-secondary mb-0 small" id="pgpResErrorMsg">The PGP signature could not be
                              verified against the provided public key.</p>
                        </div>
                     </div>

                     <div id="pgpFailureDetails" class="p-3 rounded-3 bg-body-secondary d-none">
                        <p class="text-body-secondary small mb-1">Diagnostic Information</p>
                        <p class="small mb-0" id="pgpFailDiagnosis"></p>
                     </div>
                  </div>

               </div>
            </div>

         </div>

      </div>

      <!-- Educational FAQ & Technical Explanation -->
      <article class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm mt-4">
         <p class="section-label mb-4">Frequently Asked Questions & Technical Details</p>

         <div class="accordion accordion-flush" id="pgpFaqAccordion">

            <div class="accordion-item bg-transparent border-bottom border-secondary border-opacity-10 py-2">
               <h2 class="accordion-header" id="pgpFaq1">
                  <button class="accordion-button collapsed bg-transparent shadow-none fw-semibold fs-6" type="button"
                     data-bs-toggle="collapse" data-bs-target="#pgpCollapse1" aria-expanded="false"
                     aria-controls="pgpCollapse1">
                     What is PGP and how does message signing work?
                  </button>
               </h2>
               <div id="pgpCollapse1" class="accordion-collapse collapse" aria-labelledby="pgpFaq1"
                  data-bs-parent="#pgpFaqAccordion">
                  <div class="accordion-body text-body-secondary small pt-1">
                     PGP (Pretty Good Privacy) is a cryptographic protocol that provides end-to-end encryption and
                     digital signatures. When signing a message, the signer uses their <strong>private key</strong>
                     to create a mathematical proof (signature) that can only be verified using their corresponding
                     <strong>public key</strong>. This proves authorship and message integrity without exposing
                     the private key.
                  </div>
               </div>
            </div>

            <div class="accordion-item bg-transparent border-bottom border-secondary border-opacity-10 py-2">
               <h2 class="accordion-header" id="pgpFaq2">
                  <button class="accordion-button collapsed bg-transparent shadow-none fw-semibold fs-6" type="button"
                     data-bs-toggle="collapse" data-bs-target="#pgpCollapse2" aria-expanded="false"
                     aria-controls="pgpCollapse2">
                     What is the difference between clearsigned and detached signatures?
                  </button>
               </h2>
               <div id="pgpCollapse2" class="accordion-collapse collapse" aria-labelledby="pgpFaq2"
                  data-bs-parent="#pgpFaqAccordion">
                  <div class="accordion-body text-body-secondary small pt-1">
                     <ul class="mb-0 mt-2">
                        <li><strong>Clearsigned:</strong> The message and signature are bundled together in a single
                           block starting with <code>-----BEGIN PGP SIGNED MESSAGE-----</code>. The message is
                           human-readable.</li>
                        <li><strong>Detached:</strong> The signature is separate from the message. You need both the
                           original message and the <code>-----BEGIN PGP SIGNATURE-----</code> block to verify.</li>
                     </ul>
                  </div>
               </div>
            </div>

            <div class="accordion-item bg-transparent border-bottom border-secondary border-opacity-10 py-2">
               <h2 class="accordion-header" id="pgpFaq3">
                  <button class="accordion-button collapsed bg-transparent shadow-none fw-semibold fs-6" type="button"
                     data-bs-toggle="collapse" data-bs-target="#pgpCollapse3" aria-expanded="false"
                     aria-controls="pgpCollapse3">
                     Why would PGP signature verification fail?
                  </button>
               </h2>
               <div id="pgpCollapse3" class="accordion-collapse collapse" aria-labelledby="pgpFaq3"
                  data-bs-parent="#pgpFaqAccordion">
                  <div class="accordion-body text-body-secondary small pt-1">
                     Common reasons include:
                     <ul class="mb-0 mt-2">
                        <li><strong>Wrong public key:</strong> The signature was made by a different key than the one
                           provided.</li>
                        <li><strong>Modified message:</strong> Even a single character change invalidates the
                           signature.</li>
                        <li><strong>Corrupted signature:</strong> The signature block was truncated or modified during
                           copy/paste.</li>
                        <li><strong>Expired key:</strong> The signing key may have expired at the time of
                           verification.</li>
                     </ul>
                  </div>
               </div>
            </div>

            <div class="accordion-item bg-transparent border-bottom border-secondary border-opacity-10 py-2">
               <h2 class="accordion-header" id="pgpFaq4">
                  <button class="accordion-button collapsed bg-transparent shadow-none fw-semibold fs-6" type="button"
                     data-bs-toggle="collapse" data-bs-target="#pgpCollapse4" aria-expanded="false"
                     aria-controls="pgpCollapse4">
                     Which PGP key algorithms are supported?
                  </button>
               </h2>
               <div id="pgpCollapse4" class="accordion-collapse collapse" aria-labelledby="pgpFaq4"
                  data-bs-parent="#pgpFaqAccordion">
                  <div class="accordion-body text-body-secondary small pt-1">
                     This tool uses <strong>OpenPGP.js v6</strong> which supports:
                     <ul class="mb-0 mt-2">
                        <li><strong>RSA:</strong> RSA keys of 2048 bits and above (RSA-Sign, RSA-Encrypt-Sign).</li>
                        <li><strong>EdDSA:</strong> Ed25519 and Ed448 elliptic curve keys.</li>
                        <li><strong>ECDSA:</strong> NIST P-256, P-384, P-521, and Brainpool curves.</li>
                     </ul>
                  </div>
               </div>
            </div>

            <div class="accordion-item bg-transparent py-2">
               <h2 class="accordion-header" id="pgpFaq5">
                  <button class="accordion-button collapsed bg-transparent shadow-none fw-semibold fs-6" type="button"
                     data-bs-toggle="collapse" data-bs-target="#pgpCollapse5" aria-expanded="false"
                     aria-controls="pgpCollapse5">
                     Is my data safe when using this tool?
                  </button>
               </h2>
               <div id="pgpCollapse5" class="accordion-collapse collapse" aria-labelledby="pgpFaq5"
                  data-bs-parent="#pgpFaqAccordion">
                  <div class="accordion-body text-body-secondary small pt-1">
                     Yes. All cryptographic operations are performed entirely in your browser using the open-source
                     <a href="https://openpgpjs.org/" target="_blank" rel="noopener">OpenPGP.js</a> library.
                     No data — including your public keys, messages, or signatures — is ever sent to any server.
                     You can verify this by inspecting the network tab in your browser's developer tools.
                  </div>
               </div>
            </div>

            <div class="accordion-item bg-transparent py-2">
               <h2 class="accordion-header" id="pgpFaq5">
                  <button class="accordion-button collapsed bg-transparent shadow-none fw-semibold fs-6" type="button"
                     data-bs-toggle="collapse" data-bs-target="#pgpCollapse5" aria-expanded="false"
                     aria-controls="pgpCollapse5">
                     Can I use to verify Letters of Guarantee from crypto services?
                  </button>
               </h2>
               <div id="pgpCollapse5" class="accordion-collapse collapse" aria-labelledby="pgpFaq5"
                  data-bs-parent="#pgpFaqAccordion">
                  <div class="accordion-body text-body-secondary small pt-1">
                     Yes. To verify a letter of guarantee you simply need the public key of the issuer and the
                     letter of guarantee itself. Copy-paste them in the fields above and click on "Verify". The public
                     key
                     is usually found on the website of the issuer, under a section called "PGP key", "Public key"
                     or something similar.
                     </ul>
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

   <script src="modules/openpgp.min.js"></script>
   <script src="modules/crypto-js.min.js"></script>
   <script src="components/verify-pgp.js"></script>
</body>

</html>