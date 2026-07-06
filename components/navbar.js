"use strict";

const menuItems = [
  {
    Name: "Address Balance",
    link: "bitcoin-balance-check",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23  fill="currentColor"   viewBox="0 0 16 16">
      <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
    </svg>`,
  },
  {
    Name: "Unit Converter",
    link: "bitcoin-units-converter",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor"   viewBox="0 0 16 16" >
      <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />
    </svg>`,
  },
  {
    Name: "Price API",
    link: "bitcointalk-api",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor"  viewBox="0 0 16 16">
    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" /> <path    d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
 </svg>`,
  },
  {
    Name: "JJG Tools",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor" viewBox="0 0 16 16">
      <path d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0zm6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0z"/>
    </svg>`,
    isDropdown: true,
    items: [
      //   {
      //     Name: "FU Status",
      //     link: "fuckyoustatus",
      //     icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor" viewBox="0 0 16 16">
      //     <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.84.581 1.956 1.281h1.013c-.12-1.255-1.078-2.023-2.969-2.185V1h-1v1.274c-2.19.167-3.464 1.34-3.464 3.197 0 1.658 1.054 2.502 3.1 3.026l.732.188v4.307c-1.353-.134-2.09-.79-2.196-1.482H4zm5.18-5.316c-.788-.124-1.3-.482-1.3-1.126 0-.671.554-1.12 1.3-1.196v2.322zm-.704 5.39c.813.123 1.385.5 1.385 1.186 0 .721-.606 1.196-1.385 1.25V10.855z"/>
      //  </svg>`,
      //   },
      {
        Name: "Withdrawal Strategy",
        link: "withdrawal-strategy",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor"  viewBox="0 0 16 16">
        <path d="M5.5 13v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.5v1.25c0 .138.112.25.25.25h1a.25.25 0 0 0 .25-.25V13h.084c1.992 0 3.416-1.033 3.416-2.82 0-1.502-1.007-2.323-2.186-2.44v-.088c.97-.242 1.683-.974 1.683-2.19C11.997 3.93 10.847 3 9.092 3H9V1.75a.25.25 0 0 0-.25-.25h-1a.25.25 0 0 0-.25.25V3h-.573V1.75a.25.25 0 0 0-.25-.25H5.75a.25.25 0 0 0-.25.25V3l-1.998.011a.25.25 0 0 0-.25.25v.989c0 .137.11.25.248.25l.755-.005a.75.75 0 0 1 .745.75v5.505a.75.75 0 0 1-.75.75l-.748.011a.25.25 0 0 0-.25.25v1c0 .138.112.25.25.25zm1.427-8.513h1.719c.906 0 1.438.498 1.438 1.312 0 .871-.575 1.362-1.877 1.362h-1.28zm0 4.051h1.84c1.137 0 1.756.58 1.756 1.524 0 .953-.626 1.45-2.158 1.45H6.927z" />
     </svg>`,
      }
    ]
  },
  {
    Name: "Giveaway Manager",
    link: "giveaway-manager/",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor"  class="mb-2 align-self-middle mb-0" viewBox="0 0 16 16">
      <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z" />
    </svg>`,
  }, {
    Name: "AltcoinsTalks Bot",
    link: "altcoinstalk/notification",
    icon: `<svg xmlns="http://www.w3.org/2000/svg"  height=23 viewBox="0 0 24 24" fill="currentColor" className="size-6">
    <path d="M5.85 3.5a.75.75 0 0 0-1.117-1 9.719 9.719 0 0 0-2.348 4.876.75.75 0 0 0 1.479.248A8.219 8.219 0 0 1 5.85 3.5ZM19.267 2.5a.75.75 0 1 0-1.118 1 8.22 8.22 0 0 1 1.987 4.124.75.75 0 0 0 1.48-.248A9.72 9.72 0 0 0 19.266 2.5Z" />
    <path fillRule="evenodd" d="M12 2.25A6.75 6.75 0 0 0 5.25 9v.75a8.217 8.217 0 0 1-2.119 5.52.75.75 0 0 0 .298 1.206c1.544.57 3.16.99 4.831 1.243a3.75 3.75 0 1 0 7.48 0 24.583 24.583 0 0 0 4.83-1.244.75.75 0 0 0 .298-1.205 8.217 8.217 0 0 1-2.118-5.52V9A6.75 6.75 0 0 0 12 2.25ZM9.75 18c0-.034 0-.067.002-.1a25.05 25.05 0 0 0 4.496 0l.002.1a2.25 2.25 0 1 1-4.5 0Z" clipRule="evenodd" />
  </svg>
  `,
  },
];

const HomeMenuItem = {
  Name: "Home",
  link: "/",
  icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 viewBox="0 0 24 24" fill="currentColor" >
    <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
    <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
  </svg>
  `,
};

const navbarTemplate = document.createElement('template');
navbarTemplate.innerHTML = `
<nav id="topnav" class="navbar navbar-expand-lg bg-body-tertiary border-bottom border-1 py-0">
    <div class="container-fluid col-xl-9 col-lg-12 px-2 my-0">
        <div class="text-nowrap">
            <a title="bitcoin data.science" class="navbar-brand text-decoration-none mx-0" href="./">
                <img src="/img/bitcoin-data-science-logo-web.svg" class="float-start mt-2 me-1"
                    alt="bitcoin data.science" title="bitcoin data.science" height="50" width="50"/>
                <p class="navbar-text h5  d-none d-xl-block" ><span class="text-primary">bitcoindata</span><br />.science</p>
            </a>
        </div>

        <span class="d-none d-xl-flex ">
            <ul class="navbar-nav me-auto mb-2 px-4 opacity-100 align-items-center" id="nav-lg-menu">
            ${menuItems
    .map(
      (item) => {
        if (item.isDropdown) {
          return `
                    <li class="nav-item dropdown small fw-semibold rounded-4 p-1 text-center">
                        <a class="nav-link dropdown-toggle me-1 d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ${item.Name}
                        </a>
                        <ul class="dropdown-menu border-0 rounded-4 shadow mt-2 p-2">
                            ${item.items.map(subItem => `
                                <li class="nav-item rounded-3 p-1 mt-1">
                                    <a class="nav-link px-3 d-flex align-items-center" href="${subItem.link}" title="${subItem.Name}">
                                        <span>${subItem.Name}</span>
                                    </a>
                                </li>
                            `).join("")}
                        </ul>
                    </li>`;
        } else {
          return `
                    <li class="nav-item small fw-semibold rounded-4 p-1 text-center">
                        <a class="nav-link me-1" href="${item.link}" title="${item.Name}">
                            ${item.Name}
                        </a>
                    </li>`;
        }
      }
    )
    .join("")}
            </ul>
        </span>
        <span class="d-flex align-items-center d-xl-flex mb-2">
            <div id="nav-theme-toggler" class="rounded-4 nav-icon-btn d-flex justify-content-center align-items-center" style="width: 60px; height: 60px; overflow: hidden;">
                <button class="w-100 h-100 text-decoration-none bg-transparent border-0 p-0 d-flex justify-content-center align-items-center" type="button" title="Light Mode" data-bs-theme-value="light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="link-light bi bi-sun theme-icon theme-icon-active"  viewBox="0 0 16 16">
                        <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                        <use href="#sun"></use>    
                    </svg>
                </button>
                <button class="w-100 h-100 text-decoration-none link-secondary bg-transparent border-0 p-0 d-flex justify-content-center align-items-center" type="button" title="Dark Mode" data-bs-theme-value="dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-moon-fill theme-icon"
                        viewBox="0 0 16 16">
                        <use href="#moon-fill"></use>
                        <path
                             d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
                    </svg>
                </button>
            </div>
              <button type="button" class="navbar-toggler d-xl-none d-block border-0 m-2 p-0 rounded-4 bg-transparent nav-icon-btn d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;" data-bs-toggle="modal" data-bs-target="#MenuMobile">
                <span class="navbar-toggler-icon"></span>
              </button>
        </span>
    </div>
</nav>

<div class="modal fade mt-5" id="MenuMobile" tabindex="-1" aria-labelledby="MenuMobileLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content mt-4 border-0 rounded-5">
      <div class="modal-body">
        <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
        <ul class="navbar-nav me-auto mb-2 d-flex">
        ${menuItems.map(
      (item) => {
        if (item.isDropdown) {
          return `
                    <li class="nav-item pt-2 mt-3 mobile-accordion-item">
                        <button class="nav-link px-3 d-flex align-items-center w-100 border-0 bg-transparent mobile-accordion-toggle" aria-expanded="false">
                            <span class="align-self-middle mb-1 me-3">${item.icon}</span>
                            <span class="flex-grow-1 text-start">${item.Name}</span>
                            <svg class="mobile-accordion-chevron ms-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
                        </button>
                        <ul class="mobile-accordion-body list-unstyled ps-4 pb-2" style="overflow:hidden; max-height:0; transition: max-height 0.35s cubic-bezier(0.16,1,0.3,1);">
                            ${item.items.map(subItem => `
                                <li class="nav-item rounded-3 p-1 mt-1">
                                    <a class="nav-link px-3 d-flex align-items-center" href="${subItem.link}" title="${subItem.Name}">
                                        <span class="me-3 d-flex align-items-center">${subItem.icon}</span>
                                        <span class="text-body">${subItem.Name}</span>
                                    </a>
                                </li>
                            `).join("")}
                        </ul>
                    </li>`;
        } else {
          return `
                    <li class="nav-item pt-2 pb-3 mt-3">
                        <a class="nav-link px-3" href="${item.link}" title="${item.Name}">
                        <span class="align-self-middle mb-1 me-3">${item.icon}</span>
                        ${item.Name}
                        </a>
                    </li>`;
        }
      }
    )
    .join("")}
        </ul>
      </div>
    </div>
  </div>
</div>
`;

class Navbar extends HTMLElement {
  constructor() {
    super();
    this.handleThemeChange = this.handleThemeChange.bind(this);
    this.handleThemeToggleClick = this.handleThemeToggleClick.bind(this);
    this.mediaQuery = window.matchMedia("(prefers-color-scheme: dark)");
  }

  connectedCallback() {
    this.appendChild(navbarTemplate.content.cloneNode(true));

    if (this.parentElement && this.parentElement.tagName === 'HEADER') {
      this.parentElement.classList.add("sticky-top");
    }

    // Move modal to the body to avoid z-index/stacking context issues with sticky-top
    const modal = this.querySelector('#MenuMobile');
    if (modal) {
      document.body.appendChild(modal);
    }

    let pathname = window.location.pathname.split("/").slice(-1)[0];
    this.querySelectorAll(`a[href*='${pathname}']`)
      .forEach((el) => el.classList.add("active"));

    const currentTheme = this.getPreferredTheme();
    this.setTheme(currentTheme);
    this.showActiveTheme(currentTheme);

    this.mediaQuery.addEventListener("change", this.handleThemeChange);

    this.themeToggles = this.querySelectorAll("[data-bs-theme-value]");
    this.themeToggles.forEach((toggle) => {
      toggle.addEventListener("click", this.handleThemeToggleClick);
    });

    // sliding indicator logic for main nav items
    const navMenu = this.querySelector('#nav-lg-menu');
    if (navMenu) {
      const highlight = document.createElement('div');
      highlight.className = 'nav-highlight';
      navMenu.appendChild(highlight);

      const items = navMenu.querySelectorAll(':scope > li');
      items.forEach(item => {
        item.addEventListener('mouseenter', () => {
          const rect = item.getBoundingClientRect();
          const menuRect = navMenu.getBoundingClientRect();
          highlight.style.width = `${rect.width}px`;
          highlight.style.height = `${rect.height}px`;
          highlight.style.left = `${rect.left - menuRect.left}px`;
          highlight.style.top = `${rect.top - menuRect.top}px`;
          highlight.style.opacity = '1';
          highlight.style.transform = 'scale(1)';
        });
      });

      navMenu.addEventListener('mouseleave', () => {
        highlight.style.opacity = '0';
        highlight.style.transform = 'scale(0.95)';
      });
    }

    // Desktop dropdown — JS open/close with WAAPI clip-path animation (Phantom-style)
    const SPRING = 'cubic-bezier(0.16, 1, 0.3, 1)';
    const dropdownItems = this.querySelectorAll('#nav-lg-menu .dropdown');
    dropdownItems.forEach(dropdownLi => {
      const menu = dropdownLi.querySelector('.dropdown-menu');
      if (!menu) return;

      let closeTimer = null;
      let currentAnim = null;
      let isOpen = false;

      const animateOpen = () => {
        if (currentAnim) currentAnim.cancel();
        menu.style.visibility = 'visible';
        menu.style.pointerEvents = 'auto';
        currentAnim = menu.animate([
          { opacity: 0, transform: 'scaleY(0.7) scaleX(0.95)', transformOrigin: 'top center' },
          { opacity: 1, transform: 'scaleY(1) scaleX(1)', transformOrigin: 'top center' }
        ], { duration: 220, easing: SPRING, fill: 'forwards' });
        isOpen = true;
      };

      const animateClose = () => {
        if (currentAnim) currentAnim.cancel();
        currentAnim = menu.animate([
          { opacity: 1, transform: 'scaleY(1) scaleX(1)', transformOrigin: 'top center' },
          { opacity: 0, transform: 'scaleY(0.7) scaleX(0.95)', transformOrigin: 'top center' }
        ], { duration: 180, easing: 'ease-in', fill: 'forwards' });
        currentAnim.onfinish = () => {
          menu.style.visibility = 'hidden';
          menu.style.pointerEvents = 'none';
        };
        isOpen = false;
      };

      const openMenu = () => {
        if (closeTimer) { clearTimeout(closeTimer); closeTimer = null; }
        if (!isOpen) animateOpen();
      };

      const scheduleClose = () => {
        closeTimer = setTimeout(() => { if (isOpen) animateClose(); }, 120);
      };

      dropdownLi.addEventListener('mouseenter', openMenu);
      dropdownLi.addEventListener('mouseleave', scheduleClose);
      menu.addEventListener('mouseenter', openMenu);
      menu.addEventListener('mouseleave', scheduleClose);

      // Sliding highlight pill inside dropdown submenu
      const dlHighlight = document.createElement('div');
      dlHighlight.className = 'nav-highlight dropdown-highlight';
      menu.appendChild(dlHighlight);

      menu.querySelectorAll(':scope > li').forEach(item => {
        item.addEventListener('mouseenter', () => {
          const rect = item.getBoundingClientRect();
          const menuRect = menu.getBoundingClientRect();
          dlHighlight.style.width = `${rect.width}px`;
          dlHighlight.style.height = `${rect.height}px`;
          dlHighlight.style.left = `${rect.left - menuRect.left}px`;
          dlHighlight.style.top = `${rect.top - menuRect.top}px`;
          dlHighlight.style.opacity = '1';
          dlHighlight.style.transform = 'scale(1)';
        });
      });

      menu.addEventListener('mouseleave', () => {
        dlHighlight.style.opacity = '0';
        dlHighlight.style.transform = 'scale(0.95)';
      });
    });

    // Prevent default navigation on desktop dropdown toggle anchor
    this.querySelectorAll('#nav-lg-menu .dropdown-toggle').forEach(toggle => {
      toggle.addEventListener('click', e => e.preventDefault());
    });

    // Mobile accordion — expand/collapse inline with max-height animation
    const mobileModal = document.getElementById('MenuMobile');
    if (mobileModal) {
      mobileModal.querySelectorAll('.mobile-accordion-toggle').forEach(btn => {
        btn.addEventListener('click', () => {
          const body = btn.nextElementSibling;
          const chevron = btn.querySelector('.mobile-accordion-chevron');
          const expanded = btn.getAttribute('aria-expanded') === 'true';
          if (expanded) {
            body.style.maxHeight = '0';
            chevron.style.transform = 'rotate(0deg)';
            btn.setAttribute('aria-expanded', 'false');
          } else {
            body.style.maxHeight = body.scrollHeight + 'px';
            chevron.style.transform = 'rotate(180deg)';
            btn.setAttribute('aria-expanded', 'true');
          }
        });
      });
    }
  }

  disconnectedCallback() {
    this.mediaQuery.removeEventListener("change", this.handleThemeChange);

    if (this.themeToggles) {
      this.themeToggles.forEach((toggle) => {
        toggle.removeEventListener("click", this.handleThemeToggleClick);
      });
    }
  }

  getPreferredTheme() {
    const storedTheme = localStorage.getItem("theme");
    if (storedTheme) {
      return storedTheme;
    }
    return this.mediaQuery.matches ? "dark" : "light";
  }

  setTheme(theme) {
    if (theme === "auto" && this.mediaQuery.matches) {
      document.documentElement.setAttribute("data-bs-theme", "dark");
    } else {
      document.documentElement.setAttribute("data-bs-theme", theme);
    }
  }

  showActiveTheme(theme) {
    const btnToActive = this.querySelectorAll(`[data-bs-theme-value="${theme}"]`);

    this.querySelectorAll("[data-bs-theme-value]").forEach((element) => {
      element.classList.remove("d-none");
    });

    btnToActive.forEach((element) => {
      element.classList.add("d-none");
    });
  }

  handleThemeChange() {
    const storedTheme = localStorage.getItem("theme");
    if (storedTheme !== "light" && storedTheme !== "dark") {
      this.setTheme(this.getPreferredTheme());
    }
  }

  handleThemeToggleClick(event) {
    const toggle = event.currentTarget;
    const theme = toggle.getAttribute("data-bs-theme-value");
    localStorage.setItem("theme", theme);
    this.setTheme(theme);
    this.showActiveTheme(theme);
  }
}

customElements.define("navbar-component", Navbar);
