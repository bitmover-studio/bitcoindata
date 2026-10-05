"use strict";

// Menu structure comes from components/menu-data.php (exposed by head.php as `menuData`).
// Shared with index.php (category cards) and page-header.php (hero icon).
const menuItems = menuData.map(cat => ({
  Name: cat.navName || cat.title,
  icon: cat.navIcon || `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="${cat.viewBox}" fill="currentColor">${cat.icon}</svg>`,
  isDropdown: true,
  items: cat.tools.map(tool => ({
    Name: tool.navName || tool.name,
    link: tool.link,
    icon: tool.icon,
  })),
}));

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
