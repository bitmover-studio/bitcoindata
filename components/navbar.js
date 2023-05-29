"use strict";

class Navbar extends HTMLElement {
    constructor() {
        super();
    }


    connectedCallback() {

        /*!
         * Color mode toggler for Bootstrap's docs (https://getbootstrap.com/)
         * Copyright 2011-2022 The Bootstrap Authors
         * Licensed under the Creative Commons Attribution 3.0 Unported License.
         */

        this.innerHTML = `
<nav id="topnav" class="navbar navbar-expand-lg bg-body-tertiary fixed-top border-bottom">
    <div class="container-fluid">
        <div class="m-1 text-nowrap">
            <a title="bitcoin data.science" class="navbar-brand text-decoration-none mx-0" href="./">
                <img src="img/bitcoin-data-science-logo-web.svg" class="float-start mt-2 me-1"
                    alt="bitcoin data.science" title="bitcoin data.science" height="50" width="50"/>
                <h1 class="navbar-text h5">bitcoindata<br /><span class="logo">.science</span></h1>
            </a>
        </div>

        <span class="d-none d-lg-flex ">
            <ul class="navbar-nav me-auto mb-2" id="nav-lg-menu">
                <li class="nav-item">
                    <a class="nav-link" href="index.html" title="Home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bitcoin-balance-check.html" title="Address Balance">Address Balance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bitcoin-units-converter.html" title="Unit Converter">Unit Converter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="plot-your-transaction-in-mempool.html" title="Tx Size">Tx Size</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="giveaway-manager/" title="Giveaway Manager">Giveaway Manager</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bitcointalk-api.html" title="Price API">Bitcointalk API</a>
                </li>
            </ul>
        </span>
        <span class="row">
            <div class="col m-2 py-2 rounded-circle">
                <button class="text-decoration-none dropdown-item" type="button" title="Light Mode" data-bs-theme-value="light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mb-1 link-light bi bi-sun theme-icon theme-icon-active"  viewBox="0 0 16 16">
                        <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                        <use href="#sun"></use>    
                    </svg>
                </button>
                <button class="text-decoration-none link-secondary dropdown-item" type="button" title="Dark Mode" data-bs-theme-value="dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mb-1 bi bi-moon-fill theme-icon"
                        viewBox="0 0 16 16">
                        <use href="#moon-fill"></use>
                        <path
                            d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
                    </svg>
                </button>
            </div>
             <button class="navbar-toggler d-lg-none d-block border-0 col" type="button" data-bs-toggle="offcanvas"
                title="open-offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
        </span>
    </div>
</nav>


<div class="offcanvas offcanvas-end w-100" data-bs-scroll="false" data-bs-backdrop="false" tabindex="-1"
    id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-body">
        <ul class="navbar-nav me-auto mb-2">
            <li class="nav-item py-2 pb-4  mt-3 border-1 border-bottom">
                <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item py-2 pb-4   mt-3 border-1 border-bottom">
                <a class="nav-link" href="bitcoin-balance-check.html" title="Address Balance">Address Balance</a>
            </li>
            <li class="nav-item py-2 pb-4  mt-3 border-1 border-bottom">
                <a class="nav-link" href="bitcoin-units-converter.html" title="Unit Converter">Unit Converter</a>
            </li>
            <li class="nav-item py-2 pb-4  mt-3 border-1 border-bottom">
                <a class="nav-link" href="plot-your-transaction-in-mempool.html" title="Tx Size">Tx Size</a>
            </li>
            <li class="nav-item py-2 pb-4  mt-3 border-1 border-bottom">
                <a class="nav-link" href="giveaway-manager/"  title="Giveaway Manager">Giveaway Manager</a>
            </li>
            <li class="nav-item py-2 pb-4  mt-3 border-1 border-bottom">
                <a class="nav-link" href="bitcointalk-api.html" title="Price API">Bitcointalk API</a>
            </li>
        </ul>
        <div>
            <a href="donate.html" class="btn btn-danger btn-lg mt-3 px-5 fw-bold text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-currency-bitcoin mb-1" viewBox="0 0 16 16">
                    <path d="M5.5 13v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.5v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.084c1.992 0 3.416-1.033 3.416-2.82 0-1.502-1.007-2.323-2.186-2.44v-.088c.97-.242 1.683-.974 1.683-2.19C11.997 3.93 10.847 3 9.092 3H9V1.75a.25.25 0 0 0-.25-.25h-1a.25.25 0 0 0-.25.25V3h-.573V1.75a.25.25 0 0 0-.25-.25H5.75a.25.25 0 0 0-.25.25V3l-1.998.011a.25.25 0 0 0-.25.25v.989c0 .137.11.25.248.25l.755-.005a.75.75 0 0 1 .745.75v5.505a.75.75 0 0 1-.75.75l-.748.011a.25.25 0 0 0-.25.25v1c0 .138.112.25.25.25L5.5 13zm1.427-8.513h1.719c.906 0 1.438.498 1.438 1.312 0 .871-.575 1.362-1.877 1.362h-1.28V4.487zm0 4.051h1.84c1.137 0 1.756.58 1.756 1.524 0 .953-.626 1.45-2.158 1.45H6.927V8.539z"/>
                </svg>    
                Donate
            </a>
        </div>
    </div>

</div>
      `;

      
function toggler() {
    const storedTheme = localStorage.getItem('theme')

    const getPreferredTheme = () => {
        if (storedTheme) {
            return storedTheme
        }

        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
    }

    const setTheme = function (theme) {
        if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.setAttribute('data-bs-theme', 'dark')
        } else {
            document.documentElement.setAttribute('data-bs-theme', theme)
        }
    }

    setTheme(getPreferredTheme())

    const showActiveTheme = theme => {
        const activeThemeIcon = document.querySelector('.theme-icon-active use')
        const btnToActive = document.querySelectorAll(`[data-bs-theme-value="${theme}"]`)

        document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
            element.classList.remove('d-none')
        })

        btnToActive.forEach(element => {
            element.classList.add('d-none')
        })
    }

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
        if (storedTheme !== 'light' || storedTheme !== 'dark') {
            setTheme(getPreferredTheme())
        }
    })

    window.addEventListener('DOMContentLoaded', () => {
        showActiveTheme(getPreferredTheme())

        document.querySelectorAll('[data-bs-theme-value]')
            .forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const theme = toggle.getAttribute('data-bs-theme-value')
                    localStorage.setItem('theme', theme)
                    setTheme(theme)
                    showActiveTheme(theme)
                })
            })
    })
};

toggler();

        let pathname = window.location.pathname.split("/").slice(-1)[0]
        document.querySelectorAll(`a[href='${pathname}']`).forEach((el) => el.classList.add('active'))
    }
}

customElements.define('navbar-component', Navbar);