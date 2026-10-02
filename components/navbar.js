"use strict";

const menuItems = [
  {
    Name: "Bitcoin Tools",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
    <path strokeLinecap="round" strokeLinejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
    <path strokeLinecap="round" strokeLinejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z" />
  </svg>
`,
    isDropdown: true,
    items: [
      {
        Name: "Balance Checker",
        link: "/bitcoin-balance-check",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor" viewBox="0 0 16 16">
          <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
        </svg>`,
      },
      {
        Name: "Unit Converter",
        link: "/bitcoin-units-converter",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />
        </svg>`,
      },
      {
        Name: "Verify Message",
        link: "/verify-message",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z"/> <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686"/></svg>`,
      },
      {
        Name: "DCA Calculator",
        link: "/dca-calculator",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 21v-6"/><path d="M12 21V9"/><path d="M19 21V3"/></svg>`,
      }
    ]
  },
  {
    Name: "Forum Tools",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 viewBox="0 -960 960 960" fill="currentColor">
      <path d="M880-80 720-240H320q-33 0-56.5-23.5T240-320v-40h440q33 0 56.5-23.5T760-440v-280h40q33 0 56.5 23.5T880-640v560ZM160-473l47-47h393v-280H160v327ZM80-280v-520q0-33 23.5-56.5T160-880h440q33 0 56.5 23.5T680-800v280q0 33-23.5 56.5T600-440H240L80-280Zm80-240v-280 280Z"/>
    </svg>`,
    isDropdown: true,
    items: [
      {
        Name: "Price API",
        link: "/bitcointalk-api",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor" viewBox="0 0 16 16">
          <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" /> <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
        </svg>`,
      },
      {
        Name: "Giveaway Manager",
        link: "/giveaway-manager",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor" viewBox="0 0 16 16">
          <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z" />
        </svg>`,
      },
      {
        Name: "AltcoinsTalks Bot",
        link: "/altcoinstalk/notification",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 viewBox="0 0 24 24" fill="currentColor">
          <path d="M5.85 3.5a.75.75 0 0 0-1.117-1 9.719 9.719 0 0 0-2.348 4.876.75.75 0 0 0 1.479.248A8.219 8.219 0 0 1 5.85 3.5ZM19.267 2.5a.75.75 0 1 0-1.118 1 8.22 8.22 0 0 1 1.987 4.124.75.75 0 0 0 1.48-.248A9.72 9.72 0 0 0 19.266 2.5Z" />
          <path fillRule="evenodd" d="M12 2.25A6.75 6.75 0 0 0 5.25 9v.75a8.217 8.217 0 0 1-2.119 5.52.75.75 0 0 0 .298 1.206c1.544.57 3.16.99 4.831 1.243a3.75 3.75 0 1 0 7.48 0 24.583 24.583 0 0 0 4.83-1.244.75.75 0 0 0 .298-1.205 8.217 8.217 0 0 1-2.118-5.52V9A6.75 6.75 0 0 0 12 2.25ZM9.75 18c0-.034 0-.067.002-.1a25.05 25.05 0 0 0 4.496 0l.002.1a2.25 2.25 0 1 1-4.5 0Z" clipRule="evenodd" />
        </svg>`,
      }
    ]
  },
  {
    Name: "JJG Tools",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 viewBox="0 0 16 16" fill="currentColor">
      <path fill-rule="evenodd" d="M0 0h1v15h15v1H0zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07"/>
    </svg>`,
    isDropdown: true,
    items: [
      {
        Name: "Withdrawal Strategy",
        link: "/withdrawal-strategy",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor" viewBox="0 -960 960 960">
          <path d="M668.5-531.5Q680-543 680-560t-11.5-28.5Q657-600 640-600t-28.5 11.5Q600-577 600-560t11.5 28.5Q623-520 640-520t28.5-11.5ZM320-600h200v-80H320v80ZM180-120q-34-114-67-227.5T80-580q0-92 64-156t156-64h200q29-38 70.5-59t89.5-21q25 0 42.5 17.5T720-820q0 6-1.5 12t-3.5 11q-4 11-7.5 22.5T702-751l91 91h87v279l-113 37-67 224H480v-80h-80v80H180Zm60-80h80v-80h240v80h80l62-206 98-33v-141h-40L620-720q0-20 2.5-38.5T630-796q-29 8-51 27.5T547-720H300q-58 0-99 41t-41 99q0 98 27 191.5T240-200Zm240-298Z"/>
        </svg>`,
      },
      {
        Name: "Fuck You Status",
        link: "/fuckyoustatus",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor" viewBox="0 -960 960 960">
          <path d="M784-120 530-374l56-56 254 254-56 56Zm-546-28q-60-60-89-135t-29-153q0-78 29-152t89-134q60-60 134.5-89.5T525-841q78 0 152.5 29.5T812-722L238-148Zm8-122 54-54q-16-21-30.5-43T243-411q-12-22-21-44t-16-43q-11 59-1.5 118T246-270Zm112-110 222-224q-43-33-86.5-53.5t-81.5-28q-38-7.5-68.5-2.5T296-666q-17 18-22 48.5t2.5 69q7.5 38.5 28 81.5t53.5 87Zm278-280 56-54q-53-32-112-42t-118 2q22 7 44 16t44 20.5q22 11.5 43.5 26T636-660Z"/>
        </svg>`,
      }
    ]
  },
  {
    Name: "Other Tools",
    icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor" viewBox="0 0 16 16">
      <path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56"/>
      <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415"/>
    </svg>`,
    isDropdown: true,
    items: [
      {
        Name: "Verify PGP",
        link: "/verify-pgp",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56"/><path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415"/></svg>`,
      },
      {
        Name: "Raw Tx Hex",
        link: "/bitcoin-raw-transaction-hex",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" height=23 fill="currentColor" viewBox="0 0 16 16">
          <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
          <path d="M4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4z"/>
        </svg>`,
      }
    ]
  }
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
            <a title="bitcoin data.science" class="navbar-brand text-decoration-none mx-0" href="/">
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
                        <ul class="dropdown-menu border-0 rounded-4 shadow mt-2 p-2 bg-body-tertiary">
                            ${item.items.map(subItem => `
                                <li class="nav-item rounded-4 p-1 mt-1">
                                    <a class="nav-link px-3 d-flex align-items-center" href="${subItem.link}" title="${subItem.Name}">
                                        <span class="me-2 d-flex align-items-center">${subItem.icon}</span>
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
    <div class="modal-content mt-4 border-0 rounded-5 bg-body-tertiary">
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

    let paths = window.location.pathname.split("/").filter(Boolean);
    let pathname = paths[paths.length - 1];
    if (pathname) {
      this.querySelectorAll(`a[href*='${pathname}']`)
        .forEach((el) => {
          el.classList.add("active");
          const dropdownParent = el.closest(".dropdown");
          if (dropdownParent) {
            const toggle = dropdownParent.querySelector(".dropdown-toggle");
            if (toggle) toggle.classList.add("active");
          }
        });
    }

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
