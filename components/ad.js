"use strict";

class Ad extends HTMLElement {
  constructor() {
    super();
    this.banners = [
      {
        desktop: "https://bitcoindata.science/img/bitlist-desktop.gif",
        mobile: "https://bitcoindata.science/img/bitlist-mobile.gif",
        link: "https://bitlist.co/",
        title: "Bilist, list of bitcoin mixers and exchanges",
        alt: "Bilist"
      },
      {
        desktop: "https://bitcoindata.science/img/mixtum-desktop.gif",
        mobile: "https://bitcoindata.science/img/mixtum-mobile.gif",
        link: "https://mixtum.io/",
        title: "MixTum, your privacy matters, premium bitcoin mixer",
        alt: "MixTum"
      }
    ];
  }

  connectedCallback() {
    // Randomly select a banner
    const selectedBanner = this.banners[Math.floor(Math.random() * this.banners.length)];

    this.innerHTML = `
      <div class="container text-center my-3 mb-4" id="l0tt0">
        <a href="${selectedBanner.link}" 
           title="${selectedBanner.title}" 
           target="_blank" 
           rel="noreferrer">
          <img class="border-1 border-dark img-fluid d-none d-md-inline-block" 
               alt='${selectedBanner.alt}' 
               src="${selectedBanner.desktop}" 
               width='1000' 
               height='75'/>
          <img class="border-1 border-dark img-fluid d-md-none" 
               alt="${selectedBanner.alt}" 
               src="${selectedBanner.mobile}" 
               width='320' 
               height='100'/>
        </a>
        <div class="d-flex justify-content-center align-items-center">
          <p class="small mb-0">Sponsored Content</p>
          <button type="button" class="btn-close ms-2" aria-label="Close" title="Click to dimiss"></button>
        </div>
      </div>
    `;

    // Add event listener for close button
    this.querySelector('.btn-close').addEventListener('click', () => {
      this.querySelector('#l0tt0').style.display = 'none';
    });
  }
}

customElements.define('ad-component', Ad);
