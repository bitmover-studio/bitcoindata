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
                          Bitcointalk ANN
                        </a>
                  </div>
              </div>
            </div>
          </footer>
      `;
  }
}

customElements.define('footer-component', Footer);