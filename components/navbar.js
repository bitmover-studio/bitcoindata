"use strict";

const menuItems = [
  {
    Name: "Bitcoin Tools",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="CurrentColor"><path d="M440-183v-274L200-596v274l240 139Zm80 0 240-139v-274L520-457v274Zm-40-343 237-137-237-137-237 137 237 137ZM160-252q-19-11-29.5-29T120-321v-318q0-22 10.5-40t29.5-29l280-161q19-11 40-11t40 11l280 161q19 11 29.5 29t10.5 40v318q0 22-10.5 40T800-252L520-91q-19 11-40 11t-40-11L160-252Zm320-228Z"/></svg>
`,
    isDropdown: true,
    items: [
      {
        Name: "Balance Checker",
        link: "/bitcoin-balance-check",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wallet preview-icon"><path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"/><path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"/></svg>`,
      },
      {
        Name: "Unit Converter",
        link: "/bitcoin-units-converter",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-right preview-icon"><path d="M8 3 4 7l4 4"/><path d="M4 7h16"/><path d="m16 21 4-4-4-4"/><path d="M20 17H4"/></svg>`,
      },
      {
        Name: "Verify Message",
        link: "/verify-message",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="currentColor"><path d="M638-80 468-250l56-56 114 114 226-226 56 56L638-80ZM480-520l320-200H160l320 200Zm0 80L160-640v400h206l80 80H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v174l-80 80v-174L480-440Zm0 0Zm0-80Zm0 80Z"/></svg>`,
      },
      {
        Name: "DCA Calculator",
        link: "/dca-calculator",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="48 -912 864 864" width="18px" fill="currentColor"><path d="M226.75-186.77Q210-203.54 210-227.5v-105q0-23.96 16.78-40.73Q243.56-390 267.53-390t40.72 16.77Q325-356.46 325-332.5v105q0 23.96-16.78 40.73Q291.44-170 267.47-170t-40.72-16.77Zm232.5.07q-16.75-16.7-16.75-40.56v-305.38q0-23.86 16.78-40.61T500.03-590q23.97 0 40.72 16.7t16.75 40.56v305.38q0 23.86-16.78 40.61T499.97-170q-23.97 0-40.72-16.7Zm232.5-.07Q675-203.54 675-227.5v-505q0-23.96 16.78-40.73Q708.56-790 732.53-790t40.72 16.77Q790-756.46 790-732.5v505q0 23.96-16.78 40.73Q756.44-170 732.47-170t-40.72-16.77Z"/></svg>`,
      }
    ]
  },
  {
    Name: "Forum Tools",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=20 viewBox="0 -960 960 960" fill="currentColor">
      <path d="M880-80 720-240H320q-33 0-56.5-23.5T240-320v-40h440q33 0 56.5-23.5T760-440v-280h40q33 0 56.5 23.5T880-640v560ZM160-473l47-47h393v-280H160v327ZM80-280v-520q0-33 23.5-56.5T160-880h440q33 0 56.5 23.5T680-800v280q0 33-23.5 56.5T600-440H240L80-280Zm80-240v-280 280Z"/>
    </svg>`,
    isDropdown: true,
    items: [
      {
        Name: "Price API",
        link: "/bitcointalk-api",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" height=18 fill="currentColor" viewBox="0 0 16 16">
          <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" /> <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
        </svg>`,
      },
      {
        Name: "Giveaway Manager",
        link: "/giveaway-manager",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" height=18 fill="currentColor" viewBox="0 0 16 16">
          <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z" />
        </svg>`,
      },
      {
        Name: "AltcoinsTalks Bot",
        link: "/altcoinstalk/notification",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" height=18 viewBox="0 0 24 24" fill="currentColor">
          <path d="M5.85 3.5a.75.75 0 0 0-1.117-1 9.719 9.719 0 0 0-2.348 4.876.75.75 0 0 0 1.479.248A8.219 8.219 0 0 1 5.85 3.5ZM19.267 2.5a.75.75 0 1 0-1.118 1 8.22 8.22 0 0 1 1.987 4.124.75.75 0 0 0 1.48-.248A9.72 9.72 0 0 0 19.266 2.5Z" />
          <path fillRule="evenodd" d="M12 2.25A6.75 6.75 0 0 0 5.25 9v.75a8.217 8.217 0 0 1-2.119 5.52.75.75 0 0 0 .298 1.206c1.544.57 3.16.99 4.831 1.243a3.75 3.75 0 1 0 7.48 0 24.583 24.583 0 0 0 4.83-1.244.75.75 0 0 0 .298-1.205 8.217 8.217 0 0 1-2.118-5.52V9A6.75 6.75 0 0 0 12 2.25ZM9.75 18c0-.034 0-.067.002-.1a25.05 25.05 0 0 0 4.496 0l.002.1a2.25 2.25 0 1 1-4.5 0Z" clipRule="evenodd" />
        </svg>`,
      }
    ]
  },
  {
    Name: "JJG Models",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-line preview-icon"><path d="M3 3v16a2 2 0 0 0 2 2h16"/><path d="m19 9-5 5-4-4-3 3"/></svg>`,
    isDropdown: true,
    items: [
      {
        Name: "Withdrawal Strategy",
        link: "/withdrawal-strategy",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-no-axes-combined preview-icon"><path d="M12 16v5"/><path d="M16 14.639V21"/><path d="M20 10.656V21"/><path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15"/><path d="M4 18.463V21"/><path d="M8 14.656V21"/></svg>`,
      },
      {
        Name: "Fuck You Status",
        link: "/fuckyoustatus",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16" fill="currentColor">
      <path d="M4.968 9.75a.5.5 0 1 0-.866.5A4.5 4.5 0 0 0 8 12.5a4.5 4.5 0 0 0 3.898-2.25.5.5 0 1 0-.866-.5A3.5 3.5 0 0 1 8 11.5a3.5 3.5 0 0 1-3.032-1.75M7 5.116V5a1 1 0 0 0-1-1H3.28a1 1 0 0 0-.97 1.243l.311 1.242A2 2 0 0 0 4.561 8H5a2 2 0 0 0 1.994-1.839A3 3 0 0 1 8 6c.393 0 .74.064 1.006.161A2 2 0 0 0 11 8h.438a2 2 0 0 0 1.94-1.515l.311-1.242A1 1 0 0 0 12.72 4H10a1 1 0 0 0-1 1v.116A4.2 4.2 0 0 0 8 5c-.35 0-.69.04-1 .116"/>
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-1 0A7 7 0 1 0 1 8a7 7 0 0 0 14 0"/>
    </svg>`,
      }
    ]
  },
  {
    Name: "Other Tools",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=20 fill="currentColor" viewBox="0 0 16 16">
      <path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56"/>
      <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415"/>
    </svg>`,
    isDropdown: true,
    items: [
      {
        Name: "Verify PGP",
        link: "/verify-pgp",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield preview-icon"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/></svg>`,
      },
      {
        Name: "Raw Tx Hex",
        link: "/bitcoin-raw-transaction-hex",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-code-corner preview-icon"><path d="M4 12.15V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.706.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2h-3.35"/><path d="M14 2v5a1 1 0 0 0 1 1h5"/><path d="m5 16-3 3 3 3"/><path d="m9 22 3-3-3-3"/></svg>`,
      }
    ]
  }
];

const HomeMenuItem = {
  Name: "Home",
  link: "/",
  icon: `<svg xmlns="http://www.w3.org/2000/svg" height=20 viewBox="0 0 24 24" fill="currentColor" >
    <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
    <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
  </svg>
  `,
};

// ─── Theme Toggle Buttons HTML (reusable) ──────────────────────────────────
const themeToggleHTML = `
<div id="nav-theme-toggler" class="d-flex gap-1 align-items-center">
  <button class="btn btn-sm rounded-3 px-2 py-1 border-0 bg-transparent text-body" type="button" title="Light Mode" data-bs-theme-value="light">
    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="theme-icon theme-icon-active" viewBox="0 0 16 16">
      <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
    </svg>
  </button>
  <button class="btn btn-sm rounded-3 px-2 py-1 border-0 bg-transparent text-body" type="button" title="Dark Mode" data-bs-theme-value="dark">
    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-moon-fill theme-icon" viewBox="0 0 16 16">
      <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
    </svg>
  </button>
</div>`;

// ─── Build sidebar nav items ───────────────────────────────────────────────
function buildSidebarItems() {
  const homeItem = `
    <li class="sidebar-nav-item mb-1">
      <a class="sidebar-nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 text-decoration-none" href="${HomeMenuItem.link}">
        <span class="sidebar-icon flex-shrink-0">${HomeMenuItem.icon}</span>
        <span class="sidebar-label">${HomeMenuItem.Name}</span>
      </a>
    </li>`;

  const items = menuItems.map(item => {
    if (item.isDropdown) {
      const subItems = item.items.map(sub => `
        <li>
          <a class="sidebar-nav-link sidebar-sub-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 text-decoration-none" href="${sub.link}">
            <span class="sidebar-icon flex-shrink-0 opacity-75">${sub.icon}</span>
            <span class="sidebar-label">${sub.Name}</span>
          </a>
        </li>`).join("");

      return `
        <li class="sidebar-nav-item mb-1">
          <button class="sidebar-nav-link sidebar-group-toggle d-flex align-items-center gap-3 px-3 py-2 rounded-3 w-100 text-start border-0 bg-transparent" aria-expanded="false">
            <span class="sidebar-icon flex-shrink-0">${item.icon}</span>
            <span class="sidebar-label flex-grow-1">${item.Name}</span>
            <svg class="sidebar-chevron flex-shrink-0" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
            </svg>
          </button>
          <ul class="sidebar-sub-list list-unstyled ps-2 overflow-hidden" style="max-height:0; transition: max-height 0.32s cubic-bezier(0.16,1,0.3,1);">
            ${subItems}
          </ul>
        </li>`;
    } else {
      return `
        <li class="sidebar-nav-item mb-1">
          <a class="sidebar-nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 text-decoration-none" href="${item.link}">
            <span class="sidebar-icon flex-shrink-0">${item.icon}</span>
            <span class="sidebar-label">${item.Name}</span>
          </a>
        </li>`;
    }
  }).join("");

  return items;
}

// ─── Template ─────────────────────────────────────────────────────────────
const navbarTemplate = document.createElement('template');
navbarTemplate.innerHTML = `
<!--  MOBILE TOP BAR (visible < lg) -->
<nav id="mobile-topbar" class="d-flex d-lg-none align-items-center justify-content-between px-3 py-2 border-bottom">
    <a href="/" class="d-flex align-items-center gap-2 text-decoration-none">
      <img src="/img/bitcoin-data-science-logo-web.svg" alt="bitcoindata.science" height="40" width="40" class="opacity-50">
      <div class="lh-sm">
        <div class="fw-bold sidebar-brand-text"><span class="text-primary">bitcoindata</span></div>
        <div class="sidebar-brand-sub text-muted small">.science</div>
      </div>
    </a>
  <div class="d-flex align-items-center gap-1">
    ${themeToggleHTML}
    <button class="btn btn-sm border-0 bg-transparent p-2 rounded-3 text-body" type="button"
        data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas"
        aria-label="Open menu">
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
      </svg>
    </button>
  </div>
</nav>

<!--   DESKTOP SIDEBAR (visible ≥ lg, fixed left -->

<aside id="sidebar-desktop" class="d-none d-lg-flex flex-column">
  <!-- Brand -->
  <div class="sidebar-brand d-flex align-items-center gap-2 px-3 py-4 mb-2">
    <a href="/" class="d-flex align-items-center gap-2 text-decoration-none">
      <img src="/img/bitcoin-data-science-logo-web.svg" alt="bitcoindata.science" height="40" width="40" class="opacity-75">
      <div class="lh-sm">
        <div class="fw-bold sidebar-brand-text"><span class="text-primary">bitcoindata</span></div>
        <div class="sidebar-brand-sub text-muted small">.science</div>
      </div>
    </a>
  </div>

  <!-- Nav -->
  <nav class="flex-grow-1 overflow-y-auto px-2">
    <ul class="list-unstyled mb-0" id="sidebar-nav-list">
      ${buildSidebarItems()}
    </ul>
  </nav>

  <!-- Footer: theme toggle -->
  <div class="sidebar-footer border-top px-3 py-3 d-flex align-items-center justify-content-between">
    <span class="text-muted small">Theme</span>
    ${themeToggleHTML}
  </div>
</aside>

<!--   OFFCANVAS MOBILE SIDEBAR  -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
  <div class="offcanvas-header border-bottom pb-3">
    <a href="/" class="d-flex align-items-center gap-2 text-decoration-none">
      <img src="/img/bitcoin-data-science-logo-web.svg" alt="bitcoindata.science" height="40" width="40">
      <div class="lh-sm">
        <div class="fw-bold sidebar-brand-text"><span class="text-primary">bitcoindata</span></div>
        <div class="sidebar-brand-sub text-muted small">.science</div>
      </div>
    </a>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body px-2 py-3">
    <ul class="list-unstyled mb-0" id="offcanvas-nav-list">
      ${buildSidebarItems()}
    </ul>
  </div>
  <div class="border-top px-3 py-3 d-flex align-items-center justify-content-between">
    <span class="text-muted small">Theme</span>
    ${themeToggleHTML}
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

    // Move offcanvas to body to avoid stacking context issues
    const offcanvas = this.querySelector('#sidebarOffcanvas');
    if (offcanvas) document.body.appendChild(offcanvas);

    // Active link highlighting
    const paths = window.location.pathname.split("/").filter(Boolean);
    const pathname = paths[paths.length - 1];
    if (pathname) {
      this.querySelectorAll(`a[href*='${pathname}']`).forEach(el => {
        el.classList.add("active");
        // Also expand the parent group
        const subList = el.closest('.sidebar-sub-list');
        if (subList) {
          subList.style.maxHeight = subList.scrollHeight + 500 + 'px';
          const toggle = subList.previousElementSibling;
          if (toggle) {
            toggle.setAttribute('aria-expanded', 'true');
            const chevron = toggle.querySelector('.sidebar-chevron');
            if (chevron) chevron.style.transform = 'rotate(180deg)';
          }
        }
      });
      // Do the same in offcanvas (it's moved to body)
      if (offcanvas) {
        offcanvas.querySelectorAll(`a[href*='${pathname}']`).forEach(el => {
          el.classList.add("active");
          const subList = el.closest('.sidebar-sub-list');
          if (subList) {
            subList.style.maxHeight = subList.scrollHeight + 500 + 'px';
            const toggle = subList.previousElementSibling;
            if (toggle) {
              toggle.setAttribute('aria-expanded', 'true');
              const chevron = toggle.querySelector('.sidebar-chevron');
              if (chevron) chevron.style.transform = 'rotate(180deg)';
            }
          }
        });
      }
    }

    // Theme setup
    const currentTheme = this.getPreferredTheme();
    this.setTheme(currentTheme);
    this.showActiveTheme(currentTheme);
    this.mediaQuery.addEventListener("change", this.handleThemeChange);

    // Bind theme toggles (in sidebar + offcanvas)
    this.themeToggles = document.querySelectorAll("[data-bs-theme-value]");
    this.themeToggles.forEach(toggle => {
      toggle.addEventListener("click", this.handleThemeToggleClick);
    });

    // Sidebar accordion expand/collapse (desktop sidebar)
    this._bindAccordion(this);
    // Offcanvas accordion
    if (offcanvas) this._bindAccordion(offcanvas);
  }

  _bindAccordion(root) {
    root.querySelectorAll('.sidebar-group-toggle').forEach(btn => {
      btn.addEventListener('click', () => {
        const subList = btn.nextElementSibling;
        const chevron = btn.querySelector('.sidebar-chevron');
        const isOpen = btn.getAttribute('aria-expanded') === 'true';
        if (isOpen) {
          subList.style.maxHeight = '0';
          chevron.style.transform = 'rotate(0deg)';
          btn.setAttribute('aria-expanded', 'false');
        } else {
          subList.style.maxHeight = subList.scrollHeight + 'px';
          chevron.style.transform = 'rotate(180deg)';
          btn.setAttribute('aria-expanded', 'true');
        }
      });
    });
  }

  disconnectedCallback() {
    this.mediaQuery.removeEventListener("change", this.handleThemeChange);
    if (this.themeToggles) {
      this.themeToggles.forEach(toggle => {
        toggle.removeEventListener("click", this.handleThemeToggleClick);
      });
    }
  }

  getPreferredTheme() {
    const storedTheme = localStorage.getItem("theme");
    if (storedTheme) return storedTheme;
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
    document.querySelectorAll("[data-bs-theme-value]").forEach(el => {
      el.classList.remove("d-none");
    });
    document.querySelectorAll(`[data-bs-theme-value="${theme}"]`).forEach(el => {
      el.classList.add("d-none");
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
