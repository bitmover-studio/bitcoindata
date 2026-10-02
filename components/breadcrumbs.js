"use strict";

/**
 * Programmatically renders Bootstrap 5.3 Breadcrumb navigation
 * using Schema.org BreadcrumbList from <script type="application/ld+json">.
 */
function initBreadcrumbsFromSchema() {
  // Avoid duplicate injection
  if (document.querySelector('nav[aria-label="breadcrumb"]')) {
    return;
  }

  const scripts = document.querySelectorAll('script[type="application/ld+json"]');
  let breadcrumbList = null;

  function extractBreadcrumbList(text) {
    try {
      const data = JSON.parse(text);
      if (data["@type"] === "BreadcrumbList") return data;
      if (Array.isArray(data["@graph"])) {
        const found = data["@graph"].find(
          (item) => item && item["@type"] === "BreadcrumbList"
        );
        if (found) return found;
      }
      if (Array.isArray(data)) {
        const found = data.find(
          (item) => item && item["@type"] === "BreadcrumbList"
        );
        if (found) return found;
      }
    } catch (e) {
      // Fallback: regex search for BreadcrumbList block in case of surrounding syntax errors
      const match = text.match(
        /\{[^{}]*"@type"\s*:\s*"BreadcrumbList"[\s\S]*?"itemListElement"\s*:\s*\[[\s\S]*?\]\s*\}/
      );
      if (match) {
        try {
          return JSON.parse(match[0]);
        } catch (e2) { }
      }
    }
    return null;
  }

  for (const script of scripts) {
    breadcrumbList = extractBreadcrumbList(script.textContent);
    if (breadcrumbList) break;
  }

  // Only render if we have at least 2 hierarchy levels (e.g. Home > Current Tool)
  if (
    !breadcrumbList ||
    !Array.isArray(breadcrumbList.itemListElement) ||
    breadcrumbList.itemListElement.length <= 1
  ) {
    return;
  }

  // Sort items by position
  const items = [...breadcrumbList.itemListElement].sort(
    (a, b) => (Number(a.position) || 0) - (Number(b.position) || 0)
  );

  // Build Bootstrap 5.3 breadcrumb structure
  const nav = document.createElement("nav");
  nav.setAttribute("style", "--bs-breadcrumb-divider: '>';");
  nav.setAttribute("aria-label", "breadcrumb");
  nav.className = "breadcrumb-nav pt-2 pb-1";

  const ol = document.createElement("ol");
  ol.className = "breadcrumb mb-0 small";

  items.forEach((item, index) => {
    const isLast = index === items.length - 1;
    const li = document.createElement("li");
    li.className = `breadcrumb-item${isLast ? " active text-body fw-medium" : ""}`;

    if (isLast) {
      li.setAttribute("aria-current", "page");
      li.textContent = item.name;
    } else {
      const a = document.createElement("a");
      a.href = item.item || "#";
      a.textContent = item.name;
      a.className = "text-decoration-none text-body-secondary";
      li.appendChild(a);
    }

    ol.appendChild(li);
  });

  nav.appendChild(ol);

  // Determine injection target:
  // 1. Explicit #breadcrumb-container (e.g. from page-header.php)
  // 2. Preceding the main <h1>
  // 3. Prepending to <main>
  const container = document.getElementById("breadcrumb-container");
  if (container) {
    container.appendChild(nav);
    return;
  }

  const h1 = document.querySelector("main h1") || document.querySelector("h1");
  if (h1 && h1.parentNode) {
    h1.parentNode.insertBefore(nav, h1);
    return;
  }

  const main = document.querySelector("main");
  if (main) {
    main.prepend(nav);
  }
}

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initBreadcrumbsFromSchema);
} else {
  initBreadcrumbsFromSchema();
}
