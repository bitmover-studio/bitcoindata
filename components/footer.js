"use strict";
class Footer extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    this.innerHTML = `
          <footer class="text-center container-fluid  justify-content-evenly py-4 py-md-5 mt-5 bg-body-tertiary border-top">
            <div class="container">
              <div class="row grid gap-3">
                  <div class="col-md">
                        <a href="donate.html" class="btn btn-danger btn-lg mt-3 px-5 text-decoration-none">
                          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-currency-bitcoin mb-1" viewBox="0 0 16 16">
                            <path d="M5.5 13v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.5v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.084c1.992 0 3.416-1.033 3.416-2.82 0-1.502-1.007-2.323-2.186-2.44v-.088c.97-.242 1.683-.974 1.683-2.19C11.997 3.93 10.847 3 9.092 3H9V1.75a.25.25 0 0 0-.25-.25h-1a.25.25 0 0 0-.25.25V3h-.573V1.75a.25.25 0 0 0-.25-.25H5.75a.25.25 0 0 0-.25.25V3l-1.998.011a.25.25 0 0 0-.25.25v.989c0 .137.11.25.248.25l.755-.005a.75.75 0 0 1 .745.75v5.505a.75.75 0 0 1-.75.75l-.748.011a.25.25 0 0 0-.25.25v1c0 .138.112.25.25.25L5.5 13zm1.427-8.513h1.719c.906 0 1.438.498 1.438 1.312 0 .871-.575 1.362-1.877 1.362h-1.28V4.487zm0 4.051h1.84c1.137 0 1.756.58 1.756 1.524 0 .953-.626 1.45-2.158 1.45H6.927V8.539z"/>
                          </svg>
                          Donate
                        </a>
                  </div>
                  <div class="col-md my-auto">
                      <a href="https://bitcointalk.org/index.php?topic=5445282.0" title="bitcointalk ANN" target="_blank" rel="noreferrer">
                          <img src="./giveaway-manager/BitcoinTalk-logo.webp" width="40" alt="bitcointalk" title="bitcointalk"
                                  height="40" />
                          <p class="font-monospace">BitcoinTalk ANN</p>
                        </a>
                  </div>
                  <div class="col-md">
                      <a href="https://github.com/bitmover-studio/bitcoindata" target="_blank" rel="noreferrer" alt="Github Source Code">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                            <path
                              d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                        </svg>
                        <p class="font-monospace">Source Code</p>
                      </a>
                  </div>
                  <div class="col-md">
                      <a href="https://www.l0tt0.com/?utm_source=bitcoindata.science" target="_blank" alt="Retro Crypto Casino">
                       <img src="https://bitcoindata.science/img/lotto-logo.svg" title="l0tt0.com - Bitcoin Games Like You've Never Seen!" alt="l0tt0.com" height="35" width="99" class="p-2 bg-l0tt0 rounded" />
                        <p class="font-monospace">Retro Crypto Casino</p>
                      </a>
                  </div>
              </div>
            </div>
          </footer>
      `;
  }
}

customElements.define('footer-component', Footer);