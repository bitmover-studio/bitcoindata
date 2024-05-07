"use strict";

class Ad extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    this.innerHTML = `
      <div class="container text-center my-3" id="Banner">
        <a href="https://www.l0tt0.com/" title="l0tt0.com - Bitcoin Games Like You've Never Seen!" target="_blank" rel="noreferrer">
          <img class="border-1 border-dark border img-fluid d-none d-md-inline-block" alt='l0tt0.com' src="https://bitcoindata.science/img/l0tt0_banner.gif" width='728' height='90'/>
          <img class="border-1 border-dark border img-fluid d-md-none" alt="l0tt0.com" src="https://bitcoindata.science/img/l0tt0_banner.gif" width='320' height='50'/>
        </a>
        <div class="d-flex justify-content-center align-items-center">
          <p class="small mb-0">Sponsored Content</p>
          <button type="button" class="btn-close ms-2" aria-label="Close" title="Click to dimiss"></button>
        </div>
      </div>
      `;
    document.querySelector('.btn-close').addEventListener('click', function () {
      document.querySelector('#Banner').style.display = 'none';
    });
  }
}

customElements.define('ad-component', Ad);