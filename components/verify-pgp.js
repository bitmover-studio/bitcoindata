// verify-pgp.js
// PGP Message Signature Verifier — uses OpenPGP.js (loaded as global `openpgp`)
// Supports clearsigned messages and detached signatures

(function () {
   'use strict';

   // Allow 1024-bit RSA keys (common in legacy PGP keys)
   if (typeof openpgp !== 'undefined' && openpgp.config) {
      openpgp.config.minRSABits = 1024;
   }

   // ─── DOM References ───────────────────────────────────────────────
   var pgpPublicKey = document.getElementById("pgpPublicKey");
   var pgpClearsignedBlock = document.getElementById("pgpClearsignedBlock");

   var pgpPublicKeyDetached = document.getElementById("pgpPublicKeyDetached");
   var pgpDetachedMessage = document.getElementById("pgpDetachedMessage");
   var pgpDetachedSignature = document.getElementById("pgpDetachedSignature");

   var pgpVerifyBtn = document.getElementById("pgpVerifyBtn");
   var pgpVerifyLabel = document.getElementById("pgp-verify-label");
   var pgpVerifySpinner = document.getElementById("pgp-verify-spinner");
   var pgpVerifySuccess = document.getElementById("pgp-verify-success");

   var pgpResultCard = document.getElementById("pgpResultCard");
   var pgpResultSuccess = document.getElementById("pgpResultSuccess");
   var pgpResultFailure = document.getElementById("pgpResultFailure");
   var pgpResKeyId = document.getElementById("pgpResKeyId");
   var pgpResUserId = document.getElementById("pgpResUserId");
   var pgpResAlgorithm = document.getElementById("pgpResAlgorithm");
   var pgpResSignDate = document.getElementById("pgpResSignDate");
   var pgpResFingerprint = document.getElementById("pgpResFingerprint");
   var pgpResMessage = document.getElementById("pgpResMessage");
   var pgpResErrorMsg = document.getElementById("pgpResErrorMsg");
   var pgpFailureDetails = document.getElementById("pgpFailureDetails");
   var pgpFailDiagnosis = document.getElementById("pgpFailDiagnosis");

   // ─── UI Helpers ───────────────────────────────────────────────────
   window.pgpPasteTo = function (targetId) {
      if (navigator.clipboard && navigator.clipboard.readText) {
         navigator.clipboard.readText().then(function (text) {
            var el = document.getElementById(targetId);
            if (el) {
               el.value = text.trim();
            }
         }).catch(function (err) {
            console.warn("Clipboard access not granted:", err);
         });
      }
   };

   window.pgpCopyText = function (elementId) {
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

   // ─── Algorithm name mapping ──────────────────────────────────────
   function getAlgorithmName(algo) {
      var algoNames = {
         'rsaEncryptSign': 'RSA (Encrypt & Sign)',
         'rsaEncrypt': 'RSA (Encrypt Only)',
         'rsaSign': 'RSA (Sign Only)',
         'elgamal': 'ElGamal',
         'dsa': 'DSA',
         'ecdh': 'ECDH',
         'ecdsa': 'ECDSA',
         'eddsaLegacy': 'EdDSA (Legacy)',
         'aedh': 'AEDH',
         'aedsa': 'AEdDSA',
         'ed25519': 'Ed25519',
         'x25519': 'X25519',
         'ed448': 'Ed448',
         'x448': 'X448'
      };
      return algoNames[algo] || algo || 'Unknown';
   }

   // ─── Format key fingerprint for display ──────────────────────────
   function formatFingerprint(fp) {
      if (!fp) return '-';
      fp = fp.toUpperCase();
      // Group in blocks of 4
      return fp.match(/.{1,4}/g).join(' ');
   }

   // ─── Clear all fields ────────────────────────────────────────────
   window.pgpClearAll = function () {
      pgpPublicKey.value = "-----BEGIN PGP PUBLIC KEY BLOCK-----";
      pgpClearsignedBlock.value = "-----BEGIN PGP SIGNED MESSAGE-----";
      pgpPublicKeyDetached.value = "-----BEGIN PGP PUBLIC KEY BLOCK-----";
      pgpDetachedMessage.value = "";
      pgpDetachedSignature.value = "-----BEGIN PGP SIGNATURE-----";

      pgpResultCard.classList.add("d-none");
      pgpResultSuccess.classList.add("d-none");
      pgpResultFailure.classList.add("d-none");

      var shareContainer = document.getElementById("pgpShareContainer");
      if (shareContainer) shareContainer.classList.add("d-none");
   };

   // ─── Load Sample Data ────────────────────────────────────────────
   window.pgpLoadSample = function () {
      var samplePublicKey = [
         "-----BEGIN PGP PUBLIC KEY BLOCK-----",
         "",
         "mI0EapYImwEEAMW5SvXJC2Ar17+oqiAI/kyMJf/9HEvyUgBVwrjCK6Jj42neyex+",
         "x5dSWoCl5M+xAHmdjpZMQR8OiSAuLqQ6AWNnnArxTPJhzXW6j3GJLXY54qrwiYjz",
         "LaEytmFSfIGf8/tvnKFBw2a85TGRtRR2JwUArHL7W9dvsC3yP8bT4BU9ABEBAAG0",
         "IWJpdG1vdmVyIDxiaXRtb3ZlckBwcm90b25tYWlsLmNoPojUBBMBCgA+FiEEFmL+",
         "VqLAWsuVD397/lwLUwyJyc8FAmqWCJsCGwMFCQlmAYAFCwkIBwIGFQoJCAsCBBYC",
         "AwECHgECF4AACgkQ/lwLUwyJyc9sbgP/fg9M/koeJCcP2GLV+UWKL42KYeLxescG",
         "+3mFpjRSgF8ZE+eW+x9cVLWQ/UmqpbNVay4Q/HYb6SLclY2kZPwztkfCaQeJBk0/",
         "zYP7FV6BWn7HIuHxZAy63eyrR2K2Q//9DP2h8mt062bPYG/BWfgcocSc0b1tPKwD",
         "W/Smw6eTbaW4jQRqlgibAQQAwQI4S+VStmiZaAXD0PdfiaXhKzmneHZ946gJnHSC",
         "SUuK+A4CgJD65QDasAEVuvzHpNmd7uGBHR46bWfsG9QqDOd/O2Ij0+Z5kRYxCDVQ",
         "HJkrtQ43FsLLf3RJz9+KWkc1HLBL6ADCW4V4hxyYgW35cLpkPeL5wRzc2Vhe9JLY",
         "PEcAEQEAAYi8BBgBCgAmFiEEFmL+VqLAWsuVD397/lwLUwyJyc8FAmqWCJsCGwwF",
         "CQlmAYAACgkQ/lwLUwyJyc+yNgP6AzvYY/P33JIWQnfHyxRSITMZx0C/K9rUilQX",
         "u85U7MAha0NeRswbcopBtHDkW2csY5CtVICANX726jXyNk/p2vStMNf29A9EM3N4",
         "yN1tgTksR00o0FBzEOa6EqPsNhnx0djQmiTg6q9Xica0qeBISXZC503k3pEPCTWj",
         "G+krhr4=",
         "=KF2n",
         "-----END PGP PUBLIC KEY BLOCK-----"
      ].join("\n");

      var sampleMessageText = "Hello, this is a test PGP signed message from bitcoindata.science. It verifies the authenticity of the signer using OpenPGP.";

      var sampleSignature = [
         "-----BEGIN PGP SIGNATURE-----",
         "",
         "iMsEAAEKADUWIQQWYv5WosBay5UPf3v+XAtTDInJzwUCapYLexccYml0bW92ZXJA",
         "cHJvdG9ubWFpbC5jaAAKCRD+XAtTDInJz8mxA/907w79yLH9O/8ZL2Po8VGZGbEH",
         "hg4HevHCxtyaLTopfPb8p3zJvIYrbJKgxkxLH6ZvFH9lJGryFQLerKwIuXb4ooU1",
         "GitUI0mGtILCw/Ui5TyV4BfySA3n1tyqrIo/ILpNQ/zLLh1vFIyMVlU5tCNJju+p",
         "FYejyocEtUKMiCQp5w==",
         "=9Gym",
         "-----END PGP SIGNATURE-----"
      ].join("\n");

      var sampleClearsigned = [
         "-----BEGIN PGP SIGNED MESSAGE-----",
         "Hash: SHA512",
         "",
         sampleMessageText,
         sampleSignature
      ].join("\n");

      // Populate the detached tab (this sample is a detached signature)
      pgpPublicKeyDetached.value = samplePublicKey;
      pgpDetachedMessage.value = sampleMessageText;
      pgpDetachedSignature.value = sampleSignature;

      // Switch to detached tab and verify
      var detachedTab = document.getElementById('pgp-detached-tab');
      if (detachedTab && !detachedTab.classList.contains('active')) {
         var tab = new bootstrap.Tab(detachedTab);
         tab.show();
      }

      pgpHandleVerify();
   };

   // ─── Button State Helpers ────────────────────────────────────────
   function resetButton() {
      pgpVerifySpinner.style.opacity = "0";
      pgpVerifyLabel.style.opacity = "1";
      pgpVerifyLabel.style.transform = "translateY(0)";
      pgpVerifyBtn.style.pointerEvents = "auto";
   }

   function showLoading() {
      pgpVerifyBtn.style.pointerEvents = "none";
      pgpVerifyLabel.style.opacity = "0";
      pgpVerifyLabel.style.transform = "translateY(-10px)";
      pgpVerifySpinner.style.opacity = "1";
   }

   function showSuccess() {
      pgpVerifySpinner.style.opacity = "0";
      pgpVerifySuccess.style.opacity = "1";
      pgpVerifySuccess.style.transform = "scale(1)";
      pgpVerifyBtn.classList.remove("btn-primary");
      pgpVerifyBtn.classList.add("btn-success");

      setTimeout(function () {
         pgpVerifySuccess.style.opacity = "0";
         pgpVerifySuccess.style.transform = "scale(0.5)";
         pgpVerifyLabel.style.opacity = "1";
         pgpVerifyLabel.style.transform = "translateY(0)";
         pgpVerifyBtn.classList.remove("btn-success");
         pgpVerifyBtn.classList.add("btn-primary");
         pgpVerifyBtn.style.pointerEvents = "auto";
      }, 2000);
   }

   // ─── Show Result ─────────────────────────────────────────────────
   function showVerificationResult(valid, info) {
      pgpResultCard.classList.remove("d-none");

      if (valid) {
         pgpResultSuccess.classList.remove("d-none");
         pgpResultFailure.classList.add("d-none");

         pgpResKeyId.textContent = info.keyId || '-';
         pgpResUserId.textContent = info.userId || '-';
         pgpResAlgorithm.textContent = info.algorithm || '-';
         pgpResSignDate.textContent = info.signDate || '-';
         pgpResFingerprint.textContent = info.fingerprint || '-';
         pgpResMessage.textContent = info.message || '(empty message)';
      } else {
         pgpResultSuccess.classList.add("d-none");
         pgpResultFailure.classList.remove("d-none");

         pgpResErrorMsg.textContent = info.errorMsg || "The PGP signature could not be verified against the provided public key.";
         if (info.diagnosis) {
            pgpFailureDetails.classList.remove("d-none");
            pgpFailDiagnosis.textContent = info.diagnosis;
         } else {
            pgpFailureDetails.classList.add("d-none");
         }
      }

      pgpResultCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
   }

   // ─── Determine which mode is active ──────────────────────────────
   function getActiveMode() {
      var clearsignTab = document.getElementById('pgp-clearsign-tab');
      if (clearsignTab && clearsignTab.classList.contains('active')) {
         return 'clearsign';
      }
      return 'detached';
   }

   // ─── Core Verify Handler ─────────────────────────────────────────

   window.launchModal = function (modalId, message) {
      const modalElement = document.getElementById(modalId);
      const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
      if (message) {
         const modalMessage = document.getElementById("alertModalMessage");
         modalMessage.textContent = message;
      }
      modal.show();
   }

   window.pgpHandleVerify = async function () {
      var mode = getActiveMode();
      var publicKeyArmored, signedMessageText, detachedSigArmored, messageText;

      if (mode === 'clearsign') {
         publicKeyArmored = pgpPublicKey.value.trim();
         signedMessageText = pgpClearsignedBlock.value.trim();

         if (!publicKeyArmored || publicKeyArmored === "-----BEGIN PGP PUBLIC KEY BLOCK-----") {
            launchModal("alertModal", "Please paste the signer's PGP public key.");
            pgpPublicKey.focus();
            return;
         }
         if (!signedMessageText || signedMessageText === "-----BEGIN PGP SIGNED MESSAGE-----") {
            launchModal("alertModal", "Please paste the PGP clearsigned message.");
            pgpClearsignedBlock.focus();
            return;
         }
      } else {
         publicKeyArmored = pgpPublicKeyDetached.value.trim();
         messageText = pgpDetachedMessage.value;
         detachedSigArmored = pgpDetachedSignature.value.trim();

         if (!publicKeyArmored || publicKeyArmored === "-----BEGIN PGP PUBLIC KEY BLOCK-----") {
            launchModal("alertModal", "Please paste the signer's PGP public key.");
            pgpPublicKeyDetached.focus();
            return;
         }
         if (!messageText) {
            launchModal("alertModal", "Please enter the original message.");
            pgpDetachedMessage.focus();
            return;
         }
         if (!detachedSigArmored || detachedSigArmored === "-----BEGIN PGP SIGNATURE-----") {
            launchModal("alertModal", "Please paste the detached PGP signature.");
            pgpDetachedSignature.focus();
            return;
         }
      }

      showLoading();
      pgpResultCard.classList.remove("d-none");

      try {
         // Ensure 1024-bit RSA keys are permitted
         if (typeof openpgp !== 'undefined' && openpgp.config) {
            openpgp.config.minRSABits = 1024;
         }

         // Parse public key
         var publicKey = await openpgp.readKey({ armoredKey: publicKeyArmored });

         // Extract key info
         var keyId = publicKey.getKeyID().toHex().toUpperCase();
         var userIds = publicKey.getUserIDs();
         var userId = userIds.length > 0 ? userIds[0] : '-';
         var fingerprint = formatFingerprint(publicKey.getFingerprint());

         // Get algorithm info from primary key
         var primaryKey = publicKey.keyPacket;
         var algorithmName = getAlgorithmName(primaryKey.algorithm);

         var verified = false;
         var signedText = '';
         var signDate = '-';

         if (mode === 'clearsign') {
            // Clearsigned verification
            var clearsignedMessage = await openpgp.readCleartextMessage({
               cleartextMessage: signedMessageText
            });

            var verificationResult = await openpgp.verify({
               message: clearsignedMessage,
               verificationKeys: publicKey
            });

            // Get verification status
            var signatures = verificationResult.signatures;
            if (signatures && signatures.length > 0) {
               try {
                  await signatures[0].verified;
                  verified = true;
               } catch (e) {
                  verified = false;
               }

               // Extract signature creation date
               var sigPackets = signatures[0].signature;
               try {
                  var resolvedSig = await sigPackets;
                  if (resolvedSig && resolvedSig.packets && resolvedSig.packets.length > 0) {
                     var created = resolvedSig.packets[0].created;
                     if (created) {
                        signDate = created.toISOString().replace('T', ' ').replace(/\.\d{3}Z$/, ' UTC');
                     }
                  }
               } catch (e) { }
            }

            signedText = verificationResult.data || '';

         } else {
            // Detached signature verification
            var signature = await openpgp.readSignature({ armoredSignature: detachedSigArmored });

            // Handle trailing newline variations common in CLI GPG signing
            var variations = [messageText];
            if (!messageText.endsWith("\n")) {
               variations.push(messageText + "\n");
               variations.push(messageText + "\r\n");
            } else if (messageText.endsWith("\r\n")) {
               variations.push(messageText.slice(0, -2));
               variations.push(messageText.slice(0, -2) + "\n");
            } else if (messageText.endsWith("\n")) {
               variations.push(messageText.slice(0, -1));
               variations.push(messageText.slice(0, -1) + "\r\n");
            }

            var verificationResult = null;
            for (var vIdx = 0; vIdx < variations.length; vIdx++) {
               var candMsg = await openpgp.createMessage({ text: variations[vIdx] });
               var candResult = await openpgp.verify({
                  message: candMsg,
                  signature: signature,
                  verificationKeys: publicKey
               });
               if (candResult.signatures && candResult.signatures.length > 0) {
                  try {
                     await candResult.signatures[0].verified;
                     verified = true;
                     verificationResult = candResult;
                     signedText = variations[vIdx];
                     break;
                  } catch (e) {
                     if (!verificationResult) verificationResult = candResult;
                  }
               }
            }

            if (!verificationResult) {
               var fallbackMsg = await openpgp.createMessage({ text: messageText });
               verificationResult = await openpgp.verify({
                  message: fallbackMsg,
                  signature: signature,
                  verificationKeys: publicKey
               });
               signedText = messageText;
            }

            var signatures = verificationResult.signatures;
            if (signatures && signatures.length > 0) {
               if (!verified) {
                  try {
                     await signatures[0].verified;
                     verified = true;
                  } catch (e) {
                     verified = false;
                  }
               }

               // Extract signature creation date
               var sigPackets = signatures[0].signature;
               try {
                  var resolvedSig = await sigPackets;
                  if (resolvedSig && resolvedSig.packets && resolvedSig.packets.length > 0) {
                     var created = resolvedSig.packets[0].created;
                     if (created) {
                        signDate = created.toISOString().replace('T', ' ').replace(/\.\d{3}Z$/, ' UTC');
                     }
                  }
               } catch (e) { }
            }
         }

         if (verified) {
            showSuccess();
            showVerificationResult(true, {
               keyId: keyId,
               userId: userId,
               algorithm: algorithmName,
               signDate: signDate,
               fingerprint: fingerprint,
               message: signedText
            });
         } else {
            resetButton();
            showVerificationResult(false, {
               errorMsg: "The PGP signature does not match the provided public key, or the message has been altered.",
               diagnosis: "Ensure you are using the correct public key for the signer and that the message/signature have not been modified."
            });
         }

      } catch (err) {
         resetButton();
         var errorMsg = err.message || "Failed to verify PGP signature.";
         var diagnosis = "";

         if (errorMsg.indexOf("Misformed") !== -1 || errorMsg.indexOf("armor") !== -1) {
            diagnosis = "The input does not appear to be valid PGP armored text. Ensure you have copied the complete block including the BEGIN/END headers.";
         } else if (errorMsg.indexOf("key") !== -1) {
            diagnosis = "Could not parse the public key. Ensure it is a valid PGP public key block.";
         } else if (errorMsg.indexOf("signature") !== -1) {
            diagnosis = "Could not parse the signature. Ensure it is a valid PGP signature block.";
         } else {
            diagnosis = "Please verify all inputs are correctly formatted PGP armored blocks.";
         }

         showVerificationResult(false, {
            errorMsg: errorMsg,
            diagnosis: diagnosis
         });
      }
   };

   // ─── Share (CryptoJS AES encrypted URL) ────────────────────────────
   var SHARE_KEY = "pgp-verify";

   window.pgpSaveAndShare = function () {
      var mode = getActiveMode();
      var payloadObj = { m: mode === 'clearsign' ? 'c' : 'd' };

      if (mode === 'clearsign') {
         var pubKey = (pgpPublicKey.value || "").trim();
         var block = (pgpClearsignedBlock.value || "").trim();

         if (!pubKey || pubKey === "-----BEGIN PGP PUBLIC KEY BLOCK-----") {
            launchModal("alertModal", "Please paste the signer's public key before sharing.");
            pgpPublicKey.focus();
            return;
         }
         if (!block || block === "-----BEGIN PGP SIGNED MESSAGE-----") {
            launchModal("alertModal", "Please paste the PGP clearsigned message before sharing.");
            pgpClearsignedBlock.focus();
            return;
         }

         payloadObj.pk = pubKey;
         payloadObj.b = block;
      } else {
         var pubKey = (pgpPublicKeyDetached.value || "").trim();
         var msg = pgpDetachedMessage.value || "";
         var sig = (pgpDetachedSignature.value || "").trim();

         if (!pubKey || pubKey === "-----BEGIN PGP PUBLIC KEY BLOCK-----") {
            launchModal("alertModal", "Please paste the signer's public key before sharing.");
            pgpPublicKeyDetached.focus();
            return;
         }
         if (!msg) {
            launchModal("alertModal", "Please enter the original message before sharing.");
            pgpDetachedMessage.focus();
            return;
         }
         if (!sig || sig === "-----BEGIN PGP SIGNATURE-----") {
            launchModal("alertModal", "Please paste the detached PGP signature before sharing.");
            pgpDetachedSignature.focus();
            return;
         }

         payloadObj.pk = pubKey;
         payloadObj.msg = msg;
         payloadObj.sig = sig;
      }

      if (typeof CryptoJS === 'undefined') {
         launchModal("alertModal", "CryptoJS library is not ready yet. Please wait a moment and try again.");
         return;
      }

      var encrypted = CryptoJS.AES.encrypt(JSON.stringify(payloadObj), SHARE_KEY).toString();
      var origin = window.location.origin;
      var pathname = window.location.pathname;
      var shareUrl = (origin && origin !== "null" ? origin + pathname : "https://bitcoindata.science/verify-pgp") + "#" + encrypted;
      var bbcode = "[url=" + shareUrl + "]" + (pgpResultSuccess.classList.contains("d-none") ? "Verification failed ❌" : "Verified ✅") + "[/url]";

      var shareContainer = document.getElementById("pgpShareContainer");
      var shareUrlInput = document.getElementById("pgpShareUrl");
      var shareBbcodeInput = document.getElementById("pgpShareBbcode");

      if (shareUrlInput) shareUrlInput.value = shareUrl;
      if (shareBbcodeInput) shareBbcodeInput.value = bbcode;
      if (shareContainer) shareContainer.classList.remove("d-none");

      pgpCopyShareUrl("pgpShareUrl", "pgpCopyShareBtn");
   };

   window.pgpCopyShareUrl = function (inputId, btnId) {
      inputId = inputId || "pgpShareUrl";
      btnId = btnId || "pgpCopyShareBtn";
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

   // ─── Load from URL Hash / Encrypted Payload ────────────────────────
   function tryLoadEncryptedPgp(hash) {
      if (!hash || typeof CryptoJS === 'undefined') return false;
      try {
         var cleanHash = decodeURIComponent(hash);
         var decrypted = CryptoJS.AES.decrypt(cleanHash, SHARE_KEY);
         var plaintext = decrypted.toString(CryptoJS.enc.Utf8);
         if (!plaintext) {
            decrypted = CryptoJS.AES.decrypt(hash, SHARE_KEY);
            plaintext = decrypted.toString(CryptoJS.enc.Utf8);
         }
         if (!plaintext) return false;

         var data = JSON.parse(plaintext);
         if (!data || !data.m) return false;

         if (data.m === 'c' || data.m === 'clearsign') {
            if (data.pk) pgpPublicKey.value = data.pk;
            if (data.b) pgpClearsignedBlock.value = data.b;

            var clearsignTab = document.getElementById('pgp-clearsign-tab');
            if (clearsignTab && !clearsignTab.classList.contains('active')) {
               var tab = new bootstrap.Tab(clearsignTab);
               tab.show();
            }
            return true;
         } else if (data.m === 'd' || data.m === 'detached') {
            if (data.pk) pgpPublicKeyDetached.value = data.pk;
            if (data.msg) pgpDetachedMessage.value = data.msg;
            if (data.sig) pgpDetachedSignature.value = data.sig;

            var detachedTab = document.getElementById('pgp-detached-tab');
            if (detachedTab && !detachedTab.classList.contains('active')) {
               var tab = new bootstrap.Tab(detachedTab);
               tab.show();
            }
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
         var loaded = tryLoadEncryptedPgp(hash);
         if (loaded) {
            setTimeout(function () {
               var mode = getActiveMode();
               if (mode === 'clearsign') {
                  if (pgpPublicKey.value.trim() && pgpClearsignedBlock.value.trim()) {
                     pgpHandleVerify();
                  }
               } else {
                  if (pgpPublicKeyDetached.value.trim() && pgpDetachedSignature.value.trim()) {
                     pgpHandleVerify();
                  }
               }
            }, 150);
         }
      }
   });

})();
