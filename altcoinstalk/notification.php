<?php
require_once 'login_search.php';
if (isset($_GET['user'])) {
  $user = urldecode($_GET['user']);
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>
    <?php if (isset($_GET['user'])) {
      echo $user . '-';
    } ?> Altcoinstalks Notification Bot - bitcoin data.science
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Altcoinstalks Notification Bot">
  <meta name="robots" content="index, follow" />
  <meta name="keywords" content="Altcoinstalks Notification Bot" />
  <link rel="shortcut icon" href="https://bitcoindata.science/img/favicon.svg">
  <link rel="canonical" href="https://bitcoindata.science/bot/altcoinstalk/notification">
  <link rel="alternate" hreflang="x-default" href="https://bitcoindata.science" />
  <link rel="apple-touch-icon" sizes="180x180" href="https://bitcoindata.science/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="https://bitcoindata.science/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="https://bitcoindata.science/img/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <link rel="mask-icon" href="https://bitcoindata.science/img/safari-pinned-tab.svg" color="#111316">
  <meta name="apple-mobile-web-app-title" content="bitcoin data.science">
  <meta name="application-name" content="bitcoin data.science">
  <meta name="msapplication-TileColor" content="#2b5797">
  <meta name="theme-color" content="#111316">
  <meta property="og:title" content="Altcoinstalks Notification Bot - bitcoin data.science" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://bitcoindata.science/" />
  <meta property="og:image" content="https://bitcoindata.science/img/logo.png" />
  <meta property="og:description"
    content="Altcoinstalks, Notification, forum notification, notification bot, bot, altcoins, bitcoin" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:site_name" content="Altcoinstalks Notification Bot" />

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"></script>
   <link href="/css/style.css" rel="stylesheet">
</head>
<script src="/components/ad.js" defer></script>
<script src="/components/footer.js" type="text/javascript" defer></script>
<script src="/components/navbar.js" type="text/javascript" defer></script>
<script>
  /* Google tag (gtag.js) */
  (function (w, d, s, l, i) {
    w[l] = w[l] || []; w[l].push({
      'gtm.start':
        new Date().getTime(), event: 'gtm.js'
    }); var f = d.getElementsByTagName(s)[0],
      j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
  })(window, document, 'script', 'dataLayer', 'GTM-MSMJ4VCD');
</script>
<style>
  blockquote {
    font-size: small;
    line-height: 1.4em;
    border-top: 1px solid #99A;
    border-bottom: 1px solid #99A;
    padding: 1.1em 1.4em;
    margin: 0.1em 0 0.3em 0;
    overflow: auto;
    background-color: var(--bs-secondary-bg-subtle);;
    color: var(--bs-secondary-text-emphasis);
    border-radius: 4px;
  }
  .codeheader, .quoteheader {
    color: #666;
    font-size: x-small;
    font-weight: bold;
    padding: 0 0.3em;
}

img {
    max-width: 100%;
    height: auto;
}
</style>
<body>
  <header>
    <base href="/" />
    <navbar-component></navbar-component>
  </header>
   <main class="container-fluid col-lg-12 col-xl-10">
      <ad-component></ad-component>
    <h1 class="h1 display-3 fw-bold">Altcoinstalks Notification Bot</h1>
    <?php
    if (isset($_GET['user'])) {
      $notification_data = loginAndSearch($user);

      // Check if the result is an error message
      if (is_string($notification_data) && strpos($notification_data, 'Error:') === 0) {
          echo '<div style="height:35vh"><div class="alert alert-danger fw-bold">' . htmlspecialchars($notification_data) . '</div></div>';
      } else {
      ?>

      <p>
        In the last 5 days,
        <?php echo $user; ?> was quoted or mentioned in the posts below:
      </p>
      <div class="mt-2">
        <?php foreach ($notification_data as $i) { ?>
          <div class="card my-4">
            <div class="card-body">
              <h6 class="card-title">
                <a href="<?php echo $i['board_link']; ?>" target="_blank" rel="noreferrer">
                  <?php echo $i['board']; ?>
                </a>
                &nbsp;/&nbsp;
                <a href="<?php echo $i['post_link']; ?>" onClick='javascript:markAsRead("<?php echo $i['post_link']; ?>")'
                  target="_blank" rel="noreferrer">
                  <?php echo $i['post']; ?>
                </a>
              </h6>
              <span class="card-text">Mentioned or quoted by <a href="<?php echo $i['by_link']; ?>" target="_blank"
                  rel="noreferrer">
                  <?php echo $i['by'];?>
                </a></span>
                <small class="text-body-secondary fw-semibold">
                  <?php echo $i['date'];?>
                </small>
                <div class="class-text">
                  <?php echo $i['list_posts'];?>
                </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="<?php echo $i['post_link']; ?>label"
                  data-post-link="<?php echo $i['post_link']; ?>">
                <label class="form-check-label" for="<?php echo $i['post_link']; ?>label">Mark as read</label>
              </div>
            </div>
          </div>
        <?php }
        }?></div>       
      <?php
    } else {
      ?>
      <p class="lead">Use this tool to know when you were quoted or mentioned in altcoinstalks posts.</p>
      <h2 class="h3 alert-heading mt-5">Instructions:</h2>
      <p>To use this tool you must specify a valid <code>username</code> in the URL parameter. Example below</p>

      <div
        class="p-4 bg-secondary-subtle border border-1 rounded font-monospace border-secondary-subtle col-lg-10 col-xl-7">
        <a class="link-secondary" href="https://bitcoindata.science/altcoinstalk/notification.php?user=bitmover">
          https://bitcoindata.science/altcoinstalk/notification.php<span class="link-primary">?user=bitmover</span>
        </a>
      </div>

      <p class="mt-4">If your <code>username</code> has any <strong>space character</strong> such as <em>"Crypto
          Library"</em> you must
        use <code>%20</code> instead of space. Example below:</p>

      <div
        class="p-4 bg-secondary-subtle border border-1 rounded font-monospace border-secondary-subtle col-lg-10 col-xl-7">
        <a class="link-secondary" href="https://bitcoindata.science/altcoinstalk/notification.php?user=Crypto%20Library">
          https://bitcoindata.science/altcoinstalk/notification.php<span
            class="link-primary">?user=Crypto%20Library</span>
        </a>
      </div>
      <?php
    }
    ?>
  </main>
   <footer-component><footer-component>/>

</body>
<script>
  function markAsRead(postLink) {
    localStorage.setItem(postLink, 'read');
    closestCheckbox = document.getElementById(postLink+'label')
    closestCheckbox.checked = true;
    const card = closestCheckbox.closest('.card');
    card.classList.add('bg-body-secondary');
  }

  document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    function localStorageHasKey(key) {
      return localStorage.getItem(key) !== null;
    }

    checkboxes.forEach((checkbox) => {
      const postLink = checkbox.getAttribute('data-post-link');
      const card = checkbox.closest('.card');

      if (localStorageHasKey(postLink)) {
        checkbox.checked = true;
        card.classList.add('bg-body-secondary');
      }

      checkbox.addEventListener('change', function () {
        if (this.checked) {
          card.classList.add('bg-body-secondary');
          localStorage.setItem(postLink, 'read');
        } else {
          card.classList.remove('bg-body-secondary');
          localStorage.removeItem(postLink);
        }
      });
    });
  });
</script>

</html>