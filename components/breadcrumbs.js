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

// Extract & Render FAQ Accordion from Schema.org FAQPage
function initFAQFromSchema() {
  // Locate target container: #accordion-faq, #faq-container, or #faqAccordion
  const target =
    document.getElementById("accordion-faq") ||
    document.getElementById("faq-container") ||
    document.getElementById("faqAccordion");

  // If no target container exists on page, nothing to render
  if (!target) {
    return;
  }

  // Avoid duplicate injection if already rendered or if container already has items
  if (
    target.getAttribute("data-faq-rendered") === "true" ||
    target.querySelector(".accordion-item")
  ) {
    return;
  }

  const scripts = document.querySelectorAll('script[type="application/ld+json"]');
  // search for data-items atribute inside <article> tag and get the value
  const itemsCount = target.getAttribute("data-items") || 5;
  let faqList = null;

  function isFAQPage(type) {
    if (!type) return false;
    if (type === "FAQPage") return true;
    if (Array.isArray(type) && type.includes("FAQPage")) return true;
    return false;
  }

  function extractFAQ(text) {
    try {
      const data = JSON.parse(text);
      if (isFAQPage(data["@type"])) return data;
      if (Array.isArray(data["@graph"])) {
        const found = data["@graph"].find(
          (item) => item && isFAQPage(item["@type"])
        );
        if (found) return found;
      }
      if (Array.isArray(data)) {
        const found = data.find(
          (item) => item && isFAQPage(item["@type"])
        );
        if (found) return found;
      }
    } catch (e) {
      // Fallback: regex search for FAQPage block in case of surrounding syntax errors
      const match = text.match(
        /\{[^{}]*"@type"\s*:\s*"FAQPage"[\s\S]*?"mainEntity"\s*:\s*\[[\s\S]*?\]\s*\}/
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
    faqList = extractFAQ(script.textContent);
    if (faqList) break;
  }

  if (!faqList || !faqList.mainEntity) {
    return;
  }

  let questions = [];
  if (Array.isArray(faqList.mainEntity)) {
    questions = faqList.mainEntity;
  } else if (faqList.mainEntity && typeof faqList.mainEntity === "object") {
    questions = [faqList.mainEntity];
  }

  if (itemsCount) {
    questions = questions.slice(0, Number(itemsCount));
  }

  if (questions.length === 0) {
    return;
  }

  function escapeHtml(str) {
    if (!str) return "";
    return str
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  function formatAnswer(text) {
    if (!text) return "";
    const trimmed = text.trim();
    // If text already contains paragraph tags, return as-is
    if (/<p[\s>]/i.test(trimmed)) {
      return trimmed;
    }
    // Split on line breaks (double or single)
    const paragraphs = trimmed
      .split(/\r?\n\s*\r?\n|\r?\n/)
      .map((p) => p.trim())
      .filter(Boolean);

    if (paragraphs.length <= 1) {
      return `<p class="mb-0">${trimmed}</p>`;
    }
    return paragraphs
      .map((p, idx) => {
        const isLast = idx === paragraphs.length - 1;
        return `<p class="${isLast ? "mb-0" : "mb-2"}">${p}</p>`;
      })
      .join("");
  }

  const itemsHtml = questions
    .map((item, index) => {
      const id = index + 1;
      const question = item.name ? escapeHtml(item.name) : "";
      let answerRaw = "";
      if (item.acceptedAnswer) {
        if (typeof item.acceptedAnswer === "string") {
          answerRaw = item.acceptedAnswer;
        } else if (item.acceptedAnswer.text) {
          answerRaw = item.acceptedAnswer.text;
        }
      }
      const formattedAnswer = formatAnswer(answerRaw);
      const isLast = index === questions.length - 1;
      const borderClass = isLast
        ? ""
        : "border-bottom border-secondary border-opacity-10";

      return `
         <div class="accordion-item bg-transparent ${borderClass} py-2">
            <h2 class="accordion-header" id="faq${id}">
               <button class="accordion-button collapsed bg-transparent shadow-none fw-semibold fs-6" type="button"
                  data-bs-toggle="collapse" data-bs-target="#collapse${id}" aria-expanded="false" aria-controls="collapse${id}">
                  ${question}
               </button>
            </h2>
            <div id="collapse${id}" class="accordion-collapse collapse" aria-labelledby="faq${id}"
               data-bs-parent="#faqAccordion">
               <div class="accordion-body text-body-secondary small pt-1">
                  ${formattedAnswer}
               </div>
            </div>
         </div>`.trim();
    })
    .join("\n");

  if (target.id === "faqAccordion") {
    target.innerHTML = itemsHtml;
  } else {
    // If container doesn't already have background/padding styling, apply default modern card styling
    if (!target.classList.contains("bg-body-tertiary")) {
      target.classList.add("bg-body-tertiary", "rounded-4", "p-md-5", "p-4", "shadow-sm", "mt-5", "mb-4");
    }
    const sectionTitle = target.getAttribute("data-title") || "Frequently Asked Questions";
    target.innerHTML = `
      <p class="section-label mb-3">${escapeHtml(sectionTitle)}</p>
      <div class="accordion accordion-flush" id="faqAccordion">
         ${itemsHtml}
      </div>
    `.trim();
  }

  target.setAttribute("data-faq-rendered", "true");
}

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", () => {
    initBreadcrumbsFromSchema();
    initFAQFromSchema();
  });
} else {
  initBreadcrumbsFromSchema();
  initFAQFromSchema();
}

window.initBreadcrumbsFromSchema = initBreadcrumbsFromSchema;
window.initFAQFromSchema = initFAQFromSchema;
