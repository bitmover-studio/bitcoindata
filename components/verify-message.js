// verify-message.js
// Bitcoin Message Signature Verifier — uses browserified bitcoinjs-message bundle
// Requires: bitcoinjs-lib.js (for address validation) and bitcoinjs-message.js (for verify)

(function () {
   'use strict';

   // ─── DOM References ───────────────────────────────────────────────
   const inputAddress = document.getElementById("bitcoinaddress");
   const inputMessage = document.getElementById("message");
   const inputSignature = document.getElementById("signature");
   const clearsignedBlock = document.getElementById("clearsignedBlock");
   const addressFeedback = document.getElementById("addressFeedback");
   const addressValidFeedback = document.getElementById("addressValidFeedback");
   const addressBadge = document.getElementById("addressBadge");
   const charCount = document.getElementById("charCount");

   const verifyBtn = document.getElementById("verifyBtn");
   const verifyLabel = document.getElementById("verify-label");
   const verifySpinner = document.getElementById("verify-spinner");
   const verifySuccess = document.getElementById("verify-success");

   const resultCard = document.getElementById("resultCard");
   const resultSuccess = document.getElementById("resultSuccess");
   const resultFailure = document.getElementById("resultFailure");
   const resAddress = document.getElementById("resAddress");
   const resKeyType = document.getElementById("resKeyType");
   const resHash = document.getElementById("resHash");
   const resMessage = document.getElementById("resMessage");
   const resErrorMsg = document.getElementById("resErrorMsg");
   const successDesc = document.getElementById("successDesc");
   const failureDetails = document.getElementById("failureDetails");
   const failDiagnosis = document.getElementById("failDiagnosis");
   const recoveredAddrBox = document.getElementById("recoveredAddrBox");
   const recoveredAddr = document.getElementById("recoveredAddr");

   // ─── Address Validation ───────────────────────────────────────────
   // Uses bitcoinjs-lib.address.toOutputScript() for accurate validation
   window.validateAddress = function () {
      const addr = inputAddress.value.trim();
      if (!addr) {
         inputAddress.classList.remove("is-valid", "is-invalid");
         addressBadge.classList.add("d-none");
         return undefined;
      }

      try {
         if (typeof bitcoinjs !== 'undefined' && bitcoinjs.address && bitcoinjs.address.toOutputScript) {
            bitcoinjs.address.toOutputScript(addr);
            inputAddress.classList.remove("is-invalid");
            inputAddress.classList.add("is-valid");

            // Identify address type
            var type = "Bitcoin Address";
            if (addr.startsWith("1")) {
               type = "Legacy (P2PKH)";
            } else if (addr.startsWith("3")) {
               type = "Nested SegWit (P2SH)";
            } else if (addr.toLowerCase().startsWith("bc1q")) {
               type = "Native SegWit (Bech32)";
            } else if (addr.toLowerCase().startsWith("bc1p")) {
               type = "Taproot (P2TR - BIP-322)";
            }

            addressBadge.textContent = type;
            addressBadge.className = "badge bg-body-secondary text-primary ms-2";
            addressBadge.classList.remove("d-none");
            return true;
         } else {
            // Fallback regex validation if bitcoinjs-lib is not loaded
            var isLegacy = /^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$/.test(addr);
            var isBech32 = /^bc1[a-z0-9]{38,90}$/i.test(addr);
            if (isLegacy || isBech32) {
               inputAddress.classList.remove("is-invalid");
               inputAddress.classList.add("is-valid");
               var fallbackType = "Bitcoin Address";
               if (addr.toLowerCase().startsWith("bc1p")) {
                  fallbackType = "Taproot (P2TR - BIP-322)";
               } else if (addr.startsWith("1")) {
                  fallbackType = "Legacy (P2PKH)";
               } else if (addr.startsWith("3")) {
                  fallbackType = "Nested SegWit (P2SH)";
               } else if (addr.toLowerCase().startsWith("bc1q")) {
                  fallbackType = "Native SegWit (Bech32)";
               }
               addressBadge.textContent = fallbackType;
               addressBadge.className = "badge bg-body-secondary text-primary ms-2";
               addressBadge.classList.remove("d-none");
               return true;
            } else {
               throw new Error("Invalid address pattern");
            }
         }
      } catch (error) {
         inputAddress.classList.remove("is-valid");
         inputAddress.classList.add("is-invalid");
         addressBadge.classList.add("d-none");
         if (addressFeedback) {
            addressFeedback.textContent = "Please enter a valid Bitcoin address (P2PKH, P2SH, Bech32, or Taproot).";
         }
         return undefined;
      }
   };

   // ─── Tolerant Message Verification ────────────────────────────────
   // Handles wallets that set segwit flag on legacy addresses (Trezor, Electrum, etc.)
   function verifyMessageTolerant(message, address, signature) {
      // 1) Standard verify
      try {
         if (bitcoinMessage.verify(message, address, signature)) return true;
      } catch (e) { }

      // 2) Try with checkSegwitAlways = true (needed for P2SH-P2WPKH 3... addresses)
      try {
         if (bitcoinMessage.verify(message, address, signature, null, true)) return true;
      } catch (e) { }

      // 3) Strip segwit bits from flag byte and retry as pure legacy/compressed
      try {
         var sigBuf = Uint8Array.from(atob(signature), function (c) { return c.charCodeAt(0); });
         var flag = sigBuf[0] - 27;
         var recovery = flag & 3;
         var compressed = !!(flag & 4);
         // Rebuild flag without segwit bits (clear bits 3-4)
         sigBuf[0] = 27 + recovery + (compressed ? 4 : 0);
         var newSig = btoa(String.fromCharCode.apply(null, sigBuf));
         return bitcoinMessage.verify(message, address, newSig);
      } catch (e) { }

      return false;
   }

   // ─── Core Verify with Message Variants ────────────────────────────
   // Tries BIP-322 verification (for Taproot or BIP-322 signatures) and legacy tolerant verification
   function verifyMessageCore(message, address, signatureBase64) {
      if (!address) throw new Error("Please enter a Bitcoin address.");
      if (!signatureBase64) throw new Error("Please enter a signature.");

      // Clean Sparrow Wallet / BIP-322 simple prefix (e.g. "smp:" or "smp")
      var cleanSig = signatureBase64.trim().replace(/^smp:?/i, '').trim().replace(/\s+/g, '');

      // Validate base64
      try {
         atob(cleanSig);
      } catch (e) {
         throw new Error("Signature is not a valid Base64 string.");
      }

      var binaryStr = atob(cleanSig);
      var isTaproot = address.toLowerCase().startsWith("bc1p");

      // Try message variants to handle line ending differences
      var variants = [
         message,
         message.replace(/\r\n/g, "\n"),
         message.replace(/(?<!\r)\n/g, "\r\n"),
         message.trim(),
         message.trim() + "\n",
         message.trim() + "\r\n"
      ];

      // Deduplicate variants
      var seen = {};
      var uniqueVariants = [];
      for (var i = 0; i < variants.length; i++) {
         if (!seen[variants[i]]) {
            seen[variants[i]] = true;
            uniqueVariants.push(variants[i]);
         }
      }

      // 1) For Taproot (bc1p) addresses, verify using BIP-322 exclusively
      if (isTaproot) {
         if (typeof BIP322 === 'undefined' || !BIP322.Verifier || !BIP322.Verifier.verifySignature) {
            throw new Error("BIP-322 library is not loaded. Cannot verify Taproot address.");
         }
         for (var j = 0; j < uniqueVariants.length; j++) {
            try {
               var bip322Result = BIP322.Verifier.verifySignature(address, uniqueVariants[j], cleanSig);
               if (bip322Result === true) {
                  return { valid: true, messageUsed: uniqueVariants[j], isBip322: true };
               }
            } catch (bip322Err) {
               // Continue trying variants
            }
         }
         return { valid: false };
      }

      // 2) Standard Legacy / SegWit check (P2PKH 1..., P2SH 3..., Bech32 bc1q...)
      if (binaryStr.length !== 65) {
         throw new Error("Invalid signature length: " + binaryStr.length + " bytes (expected 65 bytes).");
      }

      for (var k = 0; k < uniqueVariants.length; k++) {
         var result = verifyMessageTolerant(uniqueVariants[k], address, cleanSig);
         if (result === true) {
            return { valid: true, messageUsed: uniqueVariants[k], isBip322: false };
         }
      }

      return { valid: false };
   }

   // ─── UI Helpers ───────────────────────────────────────────────────
   window.updateCounts = function () {
      var len = inputMessage.value.length;
      charCount.textContent = len + (len === 1 ? ' char' : ' chars');
   };

   window.pasteTo = function (targetId) {
      if (navigator.clipboard && navigator.clipboard.readText) {
         navigator.clipboard.readText().then(function (text) {
            var el = document.getElementById(targetId);
            if (el) {
               el.value = text.trim();
               if (targetId === "bitcoinaddress") validateAddress();
               if (targetId === "message") updateCounts();
               if (targetId === "clearsignedBlock") parseClearsignedBlock(true);
            }
         }).catch(function (err) {
            console.warn("Clipboard access not granted:", err);
         });
      }
   };

   window.copyText = function (elementId) {
      var el = document.getElementById(elementId);
      if (el) {
         var text = el.innerText || el.textContent;
         navigator.clipboard.writeText(text).then(function () {
            var originalBadge = event.target;
            if (originalBadge) {
               var originalText = originalBadge.textContent;
               originalBadge.textContent = "Copied!";
               originalBadge.classList.remove("bg-secondary-subtle", "text-secondary");
               originalBadge.classList.add("bg-success-subtle", "text-success");
               setTimeout(function () {
                  originalBadge.textContent = originalText;
                  originalBadge.classList.remove("bg-success-subtle", "text-success");
                  originalBadge.classList.add("bg-secondary-subtle", "text-secondary");
               }, 1500);
            }
         });
      }
   };

   // ─── Clearsigned Block Parser ─────────────────────────────────────
   function parseClearsignedText(raw) {
      if (!raw || !raw.trim()) return null;

      var beginMsgIdx = raw.indexOf("-----BEGIN BITCOIN SIGNED MESSAGE-----");
      var beginSigMatch = raw.match(/-----BEGIN (?:BITCOIN )?SIGNATURE-----/i);

      if (beginMsgIdx === -1 || !beginSigMatch) {
         return null;
      }

      var msgStart = beginMsgIdx + "-----BEGIN BITCOIN SIGNED MESSAGE-----".length;
      var msgEnd = beginSigMatch.index;
      var message = raw.substring(msgStart, msgEnd);

      // Trim leading/trailing newlines cleanly
      if (message.startsWith("\r\n")) message = message.substring(2);
      else if (message.startsWith("\n")) message = message.substring(1);
      if (message.endsWith("\r\n")) message = message.slice(0, -2);
      else if (message.endsWith("\n")) message = message.slice(0, -1);

      // Extract signature content
      var sigBlockStart = beginSigMatch.index + beginSigMatch[0].length;
      var sigBlock = raw.substring(sigBlockStart);

      // Remove END tag
      sigBlock = sigBlock.replace(/-----END (?:BITCOIN )?(?:SIGNATURE|SIGNED MESSAGE)-*[\s\S]*$/i, "");

      var lines = sigBlock.split(/\r?\n/).map(function (l) { return l.trim(); }).filter(Boolean);

      var address = "";
      var signature = "";

      for (var i = 0; i < lines.length; i++) {
         var line = lines[i];
         if (/^Address:\s*(.+)$/i.test(line)) {
            address = line.replace(/^Address:\s*/i, "").trim();
         } else if (/^Version:\s*/i.test(line) || /^Hash:\s*/i.test(line)) {
            continue;
         } else if (/^([13][a-km-zA-HJ-NP-Z1-9]{25,34}|bc1[a-z0-9]{6,87})$/.test(line) && !address) {
            address = line;
         } else if (/^[A-Za-z0-9+/=]{64,120}$/.test(line)) {
            signature = line;
         }
      }

      return { message: message, address: address, signature: signature };
   }

   window.parseClearsignedBlock = function (silent) {
      var parsed = parseClearsignedText(clearsignedBlock.value);
      if (parsed) {
         inputMessage.value = parsed.message;
         if (parsed.address) inputAddress.value = parsed.address;
         if (parsed.signature) inputSignature.value = parsed.signature;

         validateAddress();
         updateCounts();

         if (!silent) {
            var fieldsTabTrigger = document.getElementById('fields-tab');
            var tab = new bootstrap.Tab(fieldsTabTrigger);
            tab.show();
         }
         return true;
      } else if (!silent) {
         launchModal("alertModal", "Could not recognize standard Bitcoin Clearsigned Message format. Please ensure it has '-----BEGIN BITCOIN SIGNED MESSAGE-----' and '-----BEGIN BITCOIN SIGNATURE-----'.");
         return false;
      }
      return false;
   };

   window.extractFieldsToClearsigned = function (silent) {
      var addr = inputAddress ? inputAddress.value.trim() : "";
      var msg = inputMessage ? inputMessage.value : "";
      var sig = inputSignature ? inputSignature.value.trim() : "";

      if (!addr && !msg && !sig) {
         if (!silent) {
            launchModal("alertModal", "Please enter a message, Bitcoin address, or signature to extract to a clearsigned block.");
         }
         return false;
      }

      var sigLines = [];
      if (addr) sigLines.push(addr);
      if (sig) sigLines.push(sig);
      var sigPart = sigLines.length > 0 ? sigLines.join("\n") + "\n" : "";

      var msgContent = msg;
      if (msgContent) {
         if (!msgContent.endsWith("\n")) {
            msgContent += "\n";
         }
      } else {
         msgContent = "\n";
      }

      var block = "-----BEGIN BITCOIN SIGNED MESSAGE-----\n" +
         msgContent +
         "-----BEGIN SIGNATURE-----\n" +
         sigPart +
         "-----END BITCOIN SIGNED MESSAGE-----";

      if (clearsignedBlock) {
         clearsignedBlock.value = block;
      }

      if (!silent) {
         var clearsignTabTrigger = document.getElementById('clearsign-tab');
         if (clearsignTabTrigger && typeof bootstrap !== 'undefined' && bootstrap.Tab) {
            var tab = bootstrap.Tab.getOrCreateInstance ? bootstrap.Tab.getOrCreateInstance(clearsignTabTrigger) : new bootstrap.Tab(clearsignTabTrigger);
            tab.show();
         }
      }
      return true;
   };

   // Alias for convenience
   window.extractFieldToClearsign = window.extractFieldsToClearsigned;

   // ─── Sample Data ──────────────────────────────────────────────────
   window.loadSample = function () {
      inputAddress.value = "1PMycacnJaSqwwJqjawXBErnLsZ7RkXUAs";
      inputMessage.value = "vires is numeris";
      inputSignature.value = "H8JawPtQOrybrSP1WHQnQPr67B9S3qrxBrl1mlzoTJOSHEpmnF7D3+t+LX0Xei9J20B5AIdPbeL3AaTBZ4N3bY0=";

      clearsignedBlock.value = "-----BEGIN BITCOIN SIGNED MESSAGE-----\nvires is numeris\n-----BEGIN SIGNATURE-----\n1PMycacnJaSqwwJqjawXBErnLsZ7RkXUAs\nH8JawPtQOrybrSP1WHQnQPr67B9S3qrxBrl1mlzoTJOSHEpmnF7D3+t+LX0Xei9J20B5AIdPbeL3AaTBZ4N3bY0=\n-----END BITCOIN SIGNED MESSAGE-----";

      validateAddress();
      updateCounts();

      // Automatically verify the sample
      handleVerify();
   };

   window.clearAll = function () {
      inputAddress.value = "";
      inputMessage.value = "";
      inputSignature.value = "";
      clearsignedBlock.value = "";
      inputAddress.classList.remove("is-valid", "is-invalid");
      addressBadge.classList.add("d-none");
      updateCounts();
      resultCard.classList.add("d-none");
      resultSuccess.classList.add("d-none");
      resultFailure.classList.add("d-none");
      var shareContainer = document.getElementById("shareContainer");
      if (shareContainer) shareContainer.classList.add("d-none");
      var shareUrlInput = document.getElementById("shareUrl");
      var shareBbcodeInput = document.getElementById("shareBbcode");
      if (shareUrlInput) shareUrlInput.value = "";
      if (shareBbcodeInput) shareBbcodeInput.value = "";
   };

   // ─── Verify Button Handler ────────────────────────────────────────
   function resetButton() {
      verifySpinner.style.opacity = "0";
      verifyLabel.style.opacity = "1";
      verifyLabel.style.transform = "translateY(0)";
      verifyBtn.style.pointerEvents = "auto";
   }

   window.launchModal = function (modalId, message) {
      const modalElement = document.getElementById(modalId);
      const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
      if (message) {
         const modalMessage = document.getElementById("alertModalMessage");
         modalMessage.textContent = message;
      }
      modal.show();
   }

   window.handleVerify = function () {
      // If on Clearsigned Block tab, parse first
      var clearsignTab = document.getElementById('clearsign-tab');
      if (clearsignTab && clearsignTab.classList.contains('active') && clearsignedBlock.value.trim()) {
         parseClearsignedBlock(true);
      }

      var addr = inputAddress.value.trim();
      var msg = inputMessage.value;
      var sig = inputSignature.value.trim();

      validateAddress();

      if (!addr) {
         launchModal("alertModal", "Please enter a Bitcoin address.");
         inputAddress.focus();
         return;
      }
      if (!sig) {
         launchModal("alertModal", "Please enter the cryptographic signature.");
         inputSignature.focus();
         return;
      }

      // Button loading animation
      verifyBtn.style.pointerEvents = "none";
      verifyLabel.style.opacity = "0";
      verifyLabel.style.transform = "translateY(-10px)";
      verifySpinner.style.opacity = "1";

      resultCard.classList.remove("d-none");

      setTimeout(function () {
         try {
            var result = verifyMessageCore(msg, addr, sig);

            if (result.valid) {
               // SUCCESS
               resultSuccess.classList.remove("d-none");
               resultFailure.classList.add("d-none");

               resAddress.textContent = addr;

               // Determine address/key type
               var keyType = "Compressed ECDSA Key";
               if (addr.toLowerCase().startsWith("bc1p")) {
                  keyType = "Schnorr Key (Taproot P2TR - BIP-322)";
               } else if (addr.startsWith("1")) {
                  keyType += " (Legacy P2PKH)";
               } else if (addr.startsWith("3")) {
                  keyType += " (Nested SegWit P2SH)";
               } else if (addr.toLowerCase().startsWith("bc1q")) {
                  keyType += " (Native SegWit Bech32)";
               }
               resKeyType.textContent = keyType;

               // Hide hash row (not computed with simplified approach)
               if (resHash && resHash.closest('.col-12')) {
                  resHash.closest('.col-12').style.display = 'none';
               }

               resMessage.textContent = result.messageUsed || "(empty message)";
               successDesc.textContent = "The cryptographic signature is valid and authentic. It confirms that the message was signed by the private key corresponding to this Bitcoin address and the message was not modified.";

               // Animate button success
               verifySpinner.style.opacity = "0";
               verifySuccess.style.opacity = "1";
               verifySuccess.style.transform = "scale(1)";
               verifyBtn.classList.remove("btn-primary");
               verifyBtn.classList.add("btn-success");

               setTimeout(function () {
                  verifySuccess.style.opacity = "0";
                  verifySuccess.style.transform = "scale(0.5)";
                  verifyLabel.style.opacity = "1";
                  verifyLabel.style.transform = "translateY(0)";
                  verifyBtn.classList.remove("btn-success");
                  verifyBtn.classList.add("btn-primary");
                  verifyBtn.style.pointerEvents = "auto";
               }, 2000);

            } else {
               // VERIFICATION FAILED
               resultSuccess.classList.add("d-none");
               resultFailure.classList.remove("d-none");

               resErrorMsg.textContent = "The signature does not match the provided address or the message has been modified.";
               failureDetails.classList.remove("d-none");
               failDiagnosis.textContent = "Ensure the address, message, and signature are exactly as provided by the signer. Even a single extra space or line break will cause verification to fail.";
               recoveredAddrBox.classList.add("d-none");

               resetButton();
            }

         } catch (err) {
            // INVALID FORMAT / EXCEPTION
            resultSuccess.classList.add("d-none");
            resultFailure.classList.remove("d-none");

            resErrorMsg.textContent = err.message || "Failed to verify signature.";
            failureDetails.classList.remove("d-none");
            failDiagnosis.textContent = "Please ensure the signature is a valid 65-byte Base64 string and the address is a valid Bitcoin mainnet address.";
            recoveredAddrBox.classList.add("d-none");

            resetButton();
         }

         // Scroll result into view
         resultCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

      }, 150);
   };

   // ─── Share (CryptoJS AES encrypted URL) ────────────────────────────
   var SHARE_KEY = "btc-verify";
   var SHARE_DELIMITER = "\n---\n";

   window.saveAndShare = function () {
      var addr = inputAddress.value.trim();
      var msg = inputMessage.value;
      var sig = inputSignature.value.trim();

      if (!addr || !sig) {
         launchModal("alertModal", "Please fill in at least the address and signature before sharing.");
         return;
      }

      // Encrypt: address + delimiter + message + delimiter + signature
      var payload = addr + SHARE_DELIMITER + msg + SHARE_DELIMITER + sig;
      var encrypted = CryptoJS.AES.encrypt(payload, SHARE_KEY).toString();

      var origin = window.location.origin;
      var pathname = window.location.pathname;
      var shareUrl = (origin && origin !== "null" ? origin + pathname : "https://bitcoindata.science/verify-message") + "#" + encrypted;
      var bbcode = "[url=" + shareUrl + "]" + (resultSuccess.classList.contains("d-none") ? "Verification failed ❌" : "Verified ✅") + "[/url]";

      var shareContainer = document.getElementById("shareContainer");
      var shareUrlInput = document.getElementById("shareUrl");
      var shareBbcodeInput = document.getElementById("shareBbcode");

      if (shareUrlInput) shareUrlInput.value = shareUrl;
      if (shareBbcodeInput) shareBbcodeInput.value = bbcode;
      if (shareContainer) shareContainer.classList.remove("d-none");

      copyShareUrl("shareUrl", "copyShareBtn");
   };

   window.copyShareUrl = function (inputId, btnId) {
      inputId = inputId || "shareUrl";
      btnId = btnId || "copyShareBtn";
      var input = document.getElementById(inputId);
      var btn = document.getElementById(btnId);
      if (!input) return;

      navigator.clipboard.writeText(input.value).then(function () {
         if (btn) {
            var origText = btn.textContent;
            btn.textContent = "Copied!";
            var wasPrimary = btn.classList.contains("btn-primary");
            btn.classList.remove("btn-primary", "btn-secondary");
            btn.classList.add("btn-success");
            setTimeout(function () {
               btn.textContent = origText;
               btn.classList.remove("btn-success");
               btn.classList.add(wasPrimary ? "btn-primary" : "btn-secondary");
            }, 1800);
         }
      }).catch(function (err) {
         console.warn("Clipboard copy error:", err);
      });
   };

   // ─── Load from URL Hash/Search Params ─────────────────────────────
   // Supports: encrypted hash (new), plain key=value params (legacy)
   function tryLoadEncrypted(hash) {
      if (!hash || typeof CryptoJS === 'undefined') return false;
      try {
         var decrypted = CryptoJS.AES.decrypt(hash, SHARE_KEY);
         var plaintext = decrypted.toString(CryptoJS.enc.Utf8);
         if (!plaintext || plaintext.indexOf(SHARE_DELIMITER) === -1) return false;

         var parts = plaintext.split(SHARE_DELIMITER);
         if (parts.length >= 2) {
            inputAddress.value = parts[0] || "";
            inputMessage.value = parts[1] || "";
            if (parts[2]) inputSignature.value = parts[2];
            // Extract to clearsign
            extractFieldsToClearsigned(false)
            return true;
         }
      } catch (e) { }
      return false;
   }

   function tryLoadPlainParams(hash) {
      if (!hash) return false;
      try {
         var params = new URLSearchParams(hash);
         var addr = params.get("addr") || params.get("address");
         var msg = params.get("msg") || params.get("message");
         var sig = params.get("sig") || params.get("signature");
         if (addr || msg || sig) {
            if (addr) inputAddress.value = decodeURIComponent(addr);
            if (msg) inputMessage.value = decodeURIComponent(msg);
            if (sig) inputSignature.value = decodeURIComponent(sig);
            return true;
         }
      } catch (e) { }
      return false;
   }

   window.addEventListener('DOMContentLoaded', function () {
      var hash = window.location.hash ? window.location.hash.substring(1) : "";
      if (!hash && window.location.search) {
         hash = window.location.search.substring(1);
      }

      if (hash) {
         // Try encrypted first, fall back to plain params (backward compat)
         var loaded = tryLoadEncrypted(hash) || tryLoadPlainParams(hash);

         if (loaded) {
            validateAddress();
            updateCounts();

            if (inputAddress.value.trim() && inputSignature.value.trim()) {
               handleVerify();
            }
         }
      }
   });

})();
