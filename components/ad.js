"use strict";

class Ad extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    this.innerHTML = `
      <div class="container text-center my-3" id="l0tt0">
        <a href="https://www.l0tt0.com/?utm_source=bitcoindata.science" title="l0tt0.com - Bitcoin Games Like You've Never Seen!" target="_blank" rel="noreferrer">
          <img class="border-1 border-dark border img-fluid d-none d-md-inline-block" alt='l0tt0.com' src="https://bitcoindata.science/img/l0tt0_banner_3.gif" width='700' height='87'/>
          <img class="border-1 border-dark border img-fluid d-md-none" alt="l0tt0.com" src="https://bitcoindata.science/img/l0tt0_banner_3.gif" width='312' height='40'/>
        </a>
        <div class="d-flex justify-content-center align-items-center">
          <p class="small mb-0">Hide Content</p>
          <button type="button" class="btn-close ms-2" aria-label="Close" title="Click to dimiss"></button>
        </div>
      </div>
      `;
    document.querySelector('.btn-close').addEventListener('click', function () {
      document.querySelector('#l0tt0').style.display = 'none';
    });
  }
}

customElements.define('ad-component', Ad);