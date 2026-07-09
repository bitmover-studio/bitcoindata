<?php
require_once 'login_search.php';
if (isset($_GET['user'])) {
  $user = urldecode($_GET['user']);
}

$title = (isset($_GET['user']) ? $user . ' - ' : '') . "Altcoinstalks Notification Bot - bitcoin data.science";
$description = "Altcoinstalks, Notification, forum notification, notification bot, bot, altcoins, bitcoin";
$keywords = "Altcoinstalks Notification Bot";
$canonical = "https://bitcoindata.science/bot/altcoinstalk/notification";
?>
<!doctype html>
<html lang="en">

<head>
  <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/components/head.php'; ?>
  <style>
    blockquote {
      font-size: small;
      line-height: 1.4em;
      border: 1px solid #99A99a22;
      padding: 1.1em 1.4em;
      margin: 0.1em 0 0.3em 0;
      overflow: auto;
      background-color: var(--bs-secondary-bg-subtle);
      ;
      color: var(--bs-secondary-text-emphasis);
      border-radius: 1rem;
    }

    .codeheader,
    .quoteheader {
      color: #666;
      font-size: x-small;
      font-weight: bold;
      padding: 0 0.3em;
    }

    .class-text img {
      max-width: 100%;
      height: auto;
    }
  </style>
</head>

<body>
  <header>
    <base href="/" />
    <navbar-component></navbar-component>
  </header>
  <?php
  $h1 = 'Altcoinstalks Notification Bot';
  $h2 = 'Get notified when you are mentioned or quoted in altcoinstalks posts.';
  include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
  ?>

  <div class="py-3">

    <?php if (isset($_GET['user'])) {
      $notification_data = loginAndSearch($user);

      // Check if the result is an error message
      if (is_string($notification_data) && strpos($notification_data, 'Error:') === 0) {
        echo '<div class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm"><div class="alert alert-danger fw-bold mb-0">' . htmlspecialchars($notification_data) . '</div></div>';
      } else {
    ?>

        <div class="">
          <p class="text-body-secondary mb-4">
            In the last 5 days, <strong class="text-primary"><?php echo htmlspecialchars($user); ?></strong> was quoted or mentioned in the posts below:
          </p>

          <?php foreach ($notification_data as $i) { ?>
            <div class="bg-body-tertiary rounded-4 p-4 mb-3 shadow-sm border border-1">

              <div class="d-flex align-items-start justify-content-between gap-3 mb-2 flex-wrap">
                <div>
                  <p class="fw-semibold mb-1">
                    <a href="<?php echo $i['board_link']; ?>" target="_blank" referrer="ugc noopener nofollow" class="text-decoration-none small">
                      <?php echo $i['board']; ?>
                    </a>
                    <span class="small"> / </span>
                    <a href="<?php echo $i['post_link']; ?>" onClick='javascript:markAsRead("<?php echo $i['post_link']; ?>")'
                      target="_blank" referrer="ugc noopener nofollow" class="text-decoration-none">
                      <?php echo $i['post']; ?>
                    </a>
                  </p>
                  <p class="mb-0 small">
                    Mentioned or quoted by&nbsp;<a href="<?php echo $i['by_link']; ?>" target="_blank" referrer="ugc noopener nofollow" class="fw-semibold"><?php echo $i['by']; ?></a>
                    <span class="text-body-secondary ms-2"><?php echo $i['date']; ?></span>
                  </p>
                </div>
                <a href="<?php echo $i['post_link']; ?>" onClick='javascript:markAsRead("<?php echo $i['post_link']; ?>")'
                  target="_blank" referrer="ugc noopener nofollow" class="btn btn-primary rounded-pill px-3 flex-shrink-0">
                  Go to post
                </a>
              </div>

              <hr class="border-secondary opacity-25 my-3">

              <div class="class-text mb-3">
                <?php echo $i['list_posts']; ?>
              </div>

              <div class="form-check form-switch mb-0">
                <input class="form-check-input" type="checkbox" role="switch"
                  id="<?php echo $i['post_link']; ?>label"
                  data-post-link="<?php echo $i['post_link']; ?>">
                <label class="form-check-label text-body-secondary small" for="<?php echo $i['post_link']; ?>label">Mark as read</label>
              </div>

            </div>
          <?php } ?>

        </div>

      <?php
      }
    } else {
      ?>

      <div class="bg-body-tertiary rounded-4 p-md-5 p-4 shadow-sm">

        <!-- How it works -->
        <p class="section-label mb-5">How it works</p>
        <div class="row g-3 mb-4">
          <div class="col-12 col-sm-6 col-lg-6">
            <div class="d-flex align-items-start gap-3">
              <span class="d-flex align-items-center justify-content-center rounded-circle bg-body-secondary flex-shrink-0" style="width:36px;height:36px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-primary" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>

              </span>
              <div>
                <p class="fw-semibold mb-0">Specify your username</p>
                <p class="text-body-secondary mb-0 small">Use your Altcoinstalks username in the input below to fetch recent mentions and quotes.</p>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-lg-6">
            <div class="d-flex align-items-start gap-3">
              <span class="d-flex align-items-center justify-content-center rounded-circle bg-body-secondary flex-shrink-0" style="width:36px;height:36px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-primary" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                </svg>
              </span>
              <div>
                <p class="fw-semibold mb-0">Bookmarkable link</p>
                <p class="text-body-secondary mb-0 small">Bookmark the URL with your username for quick access anytime on any device.</p>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-lg-6">
            <div class="d-flex align-items-start gap-3">
              <span class="d-flex align-items-center justify-content-center rounded-circle bg-body-secondary flex-shrink-0" style="width:36px;height:36px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                  <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                </svg>
              </span>
              <div>
                <p class="fw-semibold mb-0">Last 5 days</p>
                <p class="text-body-secondary mb-0 small">Shows all posts where you were mentioned or quoted in the past 5 days.</p>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-lg-6">
            <div class="d-flex align-items-start gap-3">
              <span class="d-flex align-items-center justify-content-center rounded-circle bg-body-secondary flex-shrink-0" style="width:36px;height:36px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                  <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
              </span>
              <div>
                <p class="fw-semibold mb-0">Mark as read</p>
                <p class="text-body-secondary mb-0 small">Track which notifications you've already reviewed — saved in your browser.</p>
              </div>
            </div>
          </div>
        </div>

        <hr class="border-secondary opacity-25 mb-4">

        <!-- Username input -->
        <div class="row d-flex g-3">
          <div class="col-md-6">
            <form action="javascript:void(0)" onsubmit="goToUser()">
              <div class="form-floating mb-3 border-0">
                <input type="text" class="form-control border-0 bg-body-secondary rounded-4 fw-medium"
                  id="usernameInput" placeholder="Your Altcoinstalks username"
                  autocomplete="off" spellcheck="false" autofocus
                  oninput="updateCopyInput(this.value)">
                <label for="usernameInput" class="fw-medium fs-6">Your Altcoinstalks username</label>
              </div>
              <div class="d-flex justify-content-start">
                <button type="submit" class="btn btn-primary btn-lg px-4 fs-6">
                  Check Notifications
                </button>
              </div>
            </form>
          </div>
          <div class="col-md-6">
            <!-- URL preview with copy button -->
            <div style="position: relative;">
              <div class="form-floating border-0">
                <input type="text" class="form-control border-0 bg-body-secondary rounded-4 fw-medium font-monospace small"
                  id="copyInput" placeholder="URL" readonly value="https://bitcoindata.science/altcoinstalk/notification?user="
                  style="padding-right: 3rem; font-size: 0.8rem;">
                <label for="copyInput" class="fw-medium fs-6">Bookmarkable URL</label>
              </div>
              <button type="button" id="copy-url-btn" onclick="copyText()"
                title="Copy URL"
                style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; padding:4px; cursor:pointer; color: var(--bs-secondary-color); line-height:1; transition: color 0.15s ease, transform 0.15s ease;"
                onmouseenter="this.style.color='var(--bs-primary)'; this.style.transform='translateY(-50%) scale(1.15)'"
                onmouseleave="this.style.color='var(--bs-secondary-color)'; this.style.transform='translateY(-50%) scale(1)'">
                <svg id="copy-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 -960 960 960">
                  <path d="M360-240q-33 0-56.5-23.5T280-320v-480q0-33 23.5-56.5T360-880h360q33 0 56.5 23.5T800-800v480q0 33-23.5 56.5T720-240H360Zm0-80h360v-480H360v480ZM200-80q-33 0-56.5-23.5T120-160v-560h80v560h440v80H200Zm160-240v-480 480Z" />
                </svg>
                <svg id="check-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" style="display:none; color:var(--bs-success)">
                  <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                </svg>
              </button>
            </div>
          </div>
        </div>

      </div>

    <?php } ?>

  </div>

  </main>
  <footer-component></footer-component>

</body>
<script>
  const BASE_URL = 'https://bitcoindata.science/altcoinstalk/notification?user=';

  function updateCopyInput(value) {
    const url = value.trim() ? BASE_URL + encodeURIComponent(value.trim()) : '';
    document.getElementById('copyInput').value = url;
  }

  function copyText() {
    const val = document.getElementById('copyInput').value;
    if (!val) return;
    navigator.clipboard.writeText(val).then(() => {
      const copyIcon = document.getElementById('copy-icon');
      const checkIcon = document.getElementById('check-icon');
      copyIcon.style.display = 'none';
      checkIcon.style.display = 'inline';
      setTimeout(() => {
        copyIcon.style.display = 'inline';
        checkIcon.style.display = 'none';
      }, 2000);
    });
  }

  function goToUser() {
    const username = document.getElementById('usernameInput').value.trim();
    if (username) {
      window.location.href = BASE_URL + encodeURIComponent(username);
    }
  }

  function markAsRead(postLink) {
    localStorage.setItem(postLink, 'read');
    closestCheckbox = document.getElementById(postLink + 'label')
    closestCheckbox.checked = true;
    const card = closestCheckbox.closest('.bg-body-tertiary');
    card.classList.add('opacity-50');
  }

  document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    function localStorageHasKey(key) {
      return localStorage.getItem(key) !== null;
    }

    checkboxes.forEach((checkbox) => {
      const postLink = checkbox.getAttribute('data-post-link');
      const card = checkbox.closest('.bg-body-tertiary');

      if (localStorageHasKey(postLink)) {
        checkbox.checked = true;
        card.classList.add('opacity-50');
      }

      checkbox.addEventListener('change', function() {
        if (this.checked) {
          card.classList.add('opacity-50');
          localStorage.setItem(postLink, 'read');
        } else {
          card.classList.remove('opacity-50');
          localStorage.removeItem(postLink);
        }
      });
    });
  });
</script>

</html>