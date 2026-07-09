"use strict";

const footerTemplate = document.createElement('template');
footerTemplate.innerHTML = `
<footer class="justify-content-evenly py-4 py-md-5 mt-6 border-top">
    <div class="container-fluid col-lg-12 col-xl-9 ">
        <div class="row grid gap-3">
            <div class="col-md">
                <p class="text-muted">Are these tools useful to you? Consider supporting.</p>
                <a href="donate" class="btn btn-blue btn-lg mt-3 px-5 text-decoration-none fs-6 border-0">
                    Support
                </a>
            <div class="text-muted small my-4">
                bitcoindata.science © ${new Date().getFullYear()}
            </div>
            </div>
            <div class="col-md-3">
                <p class="text-muted">Social</p>
                <p class="fw-semibold"><a href="https://bitcointalk.org/index.php?topic=5445282.0" class='footer-link text-decoration-none' title="bitcointalk ANN" target="_blank" rel="noreferrer">bitcointalk.org</a></p>
                <p class="fw-semibold"><a href="https://github.com/bitmover-studio/bitcoindata" class='footer-link text-decoration-none' title="GitHub Repository" target="_blank" rel="noreferrer">GitHub</a></p>
                <p class="fw-semibold"><a href="https://www.altcoinstalks.com/index.php?topic=322524.0" class='footer-link text-decoration-none' title="altcoinstalks ANN" target="_blank" rel="noreferrer">Altcoinstalks</a></p>
            </div>
            <div class="col-md-3">
                <p class="text-muted">Sponsor</p>
                <a href="https://www.l0tt0.com/?utm_source=bitcoindata.science" class="footer-link text-decoration-none" target="_blank" referrer=noopener noreferrer title="Retro Crypto Casino" alt="Retro Crypto Casino">
                    <p class="footer-link fw-semibold mb-2">Retro Crypto Casino</p>
                    <img src="/img/lotto-logo.svg" title="Retro Crypto Casino" alt="l0tt0.com" height="35" class="p-2 bg-l0tt0 rounded-2 px-4" style="background-color: #FBE24B;" />
                </a>
            </div>
        </div>
    </div>
</footer>
`;


class Footer extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        this.appendChild(footerTemplate.content.cloneNode(true));
    }
}

customElements.define('footer-component', Footer);