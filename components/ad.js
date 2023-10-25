"use strict";

class Ad extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    this.innerHTML = `
      <div class="dropdown float-end">
          <a class="btn btn-info dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Sponsored Content
          </a>
          <div class="dropdown-menu p-4 text-muted" style="max-width: 30  0px;">
              <p>Be seen by active bitcoin and cryptocurrency users</p>
              <a class="btn btn-primary" href="./advertise.html" role="button">More Info</a>
          </div>
      </div>
      `;
  }
}

customElements.define('ad-component', Ad);