"use strict";

const menuItems = [
  {
    Name: "Home",
    link: "index.html",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 viewBox="0 0 24 24" fill="currentColor" >
    <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
    <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
  </svg>
  `,
  },
  {
    Name: "Address Balance",
    link: "bitcoin-balance-check.html",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23  fill="currentColor"   viewBox="0 0 16 16">
      <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
    </svg>`,
  },
  {
    Name: "Unit Converter",
    link: "bitcoin-units-converter.html",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor"   viewBox="0 0 16 16" >
      <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />
    </svg>`,
  },
  {
    Name: "Price API",
    link: "bitcointalk-api.html",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor"  viewBox="0 0 16 16">
    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" /> <path    d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
 </svg>`,
  },
  {
    Name: "Withdrawal Strategy",
    link: "withdrawal-strategy.html",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor"  viewBox="0 0 16 16">
    <path d="M5.5 13v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.5v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.084c1.992 0 3.416-1.033 3.416-2.82 0-1.502-1.007-2.323-2.186-2.44v-.088c.97-.242 1.683-.974 1.683-2.19C11.997 3.93 10.847 3 9.092 3H9V1.75a.25.25 0 0 0-.25-.25h-1a.25.25 0 0 0-.25.25V3h-.573V1.75a.25.25 0 0 0-.25-.25H5.75a.25.25 0 0 0-.25.25V3l-1.998.011a.25.25 0 0 0-.25.25v.989c0 .137.11.25.248.25l.755-.005a.75.75 0 0 1 .745.75v5.505a.75.75 0 0 1-.75.75l-.748.011a.25.25 0 0 0-.25.25v1c0 .138.112.25.25.25zm1.427-8.513h1.719c.906 0 1.438.498 1.438 1.312 0 .871-.575 1.362-1.877 1.362h-1.28zm0 4.051h1.84c1.137 0 1.756.58 1.756 1.524 0 .953-.626 1.45-2.158 1.45H6.927z" />
 </svg>`,
  },
  {
    Name: "Giveaway Manager",
    link: "giveaway-manager/",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor"  class="mb-2 align-self-middle mb-0" viewBox="0 0 16 16">
      <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z" />
    </svg>`,
  }, {
    Name: "AltcoinsTalk Bot",
    link: "altcoinstalk/notification.php",
    icon: `<svg xmlns="http://www.w3.org/2000/svg"  height=23 viewBox="0 0 24 24" fill="currentColor" className="size-6">
    <path d="M5.85 3.5a.75.75 0 0 0-1.117-1 9.719 9.719 0 0 0-2.348 4.876.75.75 0 0 0 1.479.248A8.219 8.219 0 0 1 5.85 3.5ZM19.267 2.5a.75.75 0 1 0-1.118 1 8.22 8.22 0 0 1 1.987 4.124.75.75 0 0 0 1.48-.248A9.72 9.72 0 0 0 19.266 2.5Z" />
    <path fillRule="evenodd" d="M12 2.25A6.75 6.75 0 0 0 5.25 9v.75a8.217 8.217 0 0 1-2.119 5.52.75.75 0 0 0 .298 1.206c1.544.57 3.16.99 4.831 1.243a3.75 3.75 0 1 0 7.48 0 24.583 24.583 0 0 0 4.83-1.244.75.75 0 0 0 .298-1.205 8.217 8.217 0 0 1-2.118-5.52V9A6.75 6.75 0 0 0 12 2.25ZM9.75 18c0-.034 0-.067.002-.1a25.05 25.05 0 0 0 4.496 0l.002.1a2.25 2.25 0 1 1-4.5 0Z" clipRule="evenodd" />
  </svg>
  `,
  },
];

class Navbar extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    this.innerHTML = `
<nav id="topnav" class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <div class="m-3 text-nowrap">
            <a title="bitcoin data.science" class="navbar-brand text-decoration-none mx-0" href="./">
                <img src="img/bitcoin-data-science-logo-web.svg" class="float-start mt-2 me-1"
                    alt="bitcoin data.science" title="bitcoin data.science" height="50" width="50"/>
                <h1 class="navbar-text h5">bitcoindata<br /><span class="text-warning">.science</span></h1>
            </a>
        </div>

        <span class="d-none d-lg-flex ">
            <ul class="navbar-nav me-auto mb-2" id="nav-lg-menu">
            ${menuItems
              .map(
                (item) => `
                    <li class="nav-item small fw-semibold">
                        <a class="nav-link" href="${item.link}" title="${item.Name}">
                            ${item.Name}
                        </a>
                    </li>`
              )
              .join("")}
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
        <ul class="navbar-nav me-auto mb-2 d-flex">
        ${menuItems
          .map(
            (item) => `
                    <li class="nav-item pt-2 pb-3 mt-3">
                        <a class="nav-link" href="${item.link}" title="${item.Name}">
                        <span class="align-self-middle mb-1 me-3">${item.icon}</span>
                        ${item.Name}
                        </a>
                    </li>`
          )
          .join("")}
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

    /* Google Tag */
    // const script = document.createElement("script");
    // script.setAttribute("src", "components/googletag.js");
    // document.head.appendChild(script);

    /* Google tag (gtag.js) --> */
    (function (w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        "gtm.start": new Date().getTime(),
        event: "gtm.js",
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != "dataLayer" ? "&l=" + l : "";
      j.async = true;
      j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, "script", "dataLayer", "GTM-MSMJ4VCD");

    function toggler() {
      const storedTheme = localStorage.getItem("theme");

      const getPreferredTheme = () => {
        if (storedTheme) {
          return storedTheme;
        }

        return window.matchMedia("(prefers-color-scheme: dark)").matches
          ? "dark"
          : "light";
      };

      const setTheme = function (theme) {
        if (
          theme === "auto" &&
          window.matchMedia("(prefers-color-scheme: dark)").matches
        ) {
          document.documentElement.setAttribute("data-bs-theme", "dark");
        } else {
          document.documentElement.setAttribute("data-bs-theme", theme);
        }
      };

      setTheme(getPreferredTheme());

      const showActiveTheme = (theme) => {
        const activeThemeIcon = document.querySelector(
          ".theme-icon-active use"
        );
        const btnToActive = document.querySelectorAll(
          `[data-bs-theme-value="${theme}"]`
        );

        document
          .querySelectorAll("[data-bs-theme-value]")
          .forEach((element) => {
            element.classList.remove("d-none");
          });

        btnToActive.forEach((element) => {
          element.classList.add("d-none");
        });
      };

      window
        .matchMedia("(prefers-color-scheme: dark)")
        .addEventListener("change", () => {
          if (storedTheme !== "light" || storedTheme !== "dark") {
            setTheme(getPreferredTheme());
          }
        });

      window.addEventListener("DOMContentLoaded", () => {
        showActiveTheme(getPreferredTheme());

        document.querySelectorAll("[data-bs-theme-value]").forEach((toggle) => {
          toggle.addEventListener("click", () => {
            const theme = toggle.getAttribute("data-bs-theme-value");
            localStorage.setItem("theme", theme);
            setTheme(theme);
            showActiveTheme(theme);
          });
        });
      });
    }

    toggler();

    let pathname = window.location.pathname.split("/").slice(-1)[0];
    document
      .querySelectorAll(`a[href*='${pathname}']`)
      .forEach((el) => el.classList.add("active"));
  }
}

customElements.define("navbar-component", Navbar);
