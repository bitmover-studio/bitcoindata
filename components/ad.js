"use strict";

class Ad extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    this.innerHTML = `
      <div class="container text-center my-3" id="Banner">
        <a href="https://exch.cx/?ref=Da5ff516" title="eXch - instant exchange BTC / LN / XMR / LTC / ETH / ERC20" target="_blank" rel="noreferrer">
          <img class="border-1 border-dark border img-fluid d-none d-md-inline-block" alt='eXch - instant exchange BTC / LN / XMR / LTC / ETH / ERC20' src="https://bitcoindata.science/img/exchcx.gif"  height='88'/>
          <img class="border-1 border-dark border img-fluid d-md-none" alt="eXch - instant exchange BTC / LN / XMR / LTC / ETH / ERC20" src="https://bitcoindata.science/img/exchcx.gif" height='46'/>
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