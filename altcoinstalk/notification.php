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
   <?php
   $h1 = 'Altcoinstalks Notification Bot';
   $h2 = 'Get notified when you are mentioned or quoted in altcoinstalks posts.';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/components/page-header.php';
   ?>
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
                <a href="<?php echo $i['post_link']; ?>" onClick='javascript:markAsRead("<?php echo $i['post_link']; ?>")'
                  target="_blank" rel="noreferrer" class="btn btn-sm btn-primary float-end me-4">
                  Go to post
                </a>
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
      <p>To use this tool you must specify a valid <code>username</code> in the URL parameter. Example below:</p>

      <div
        class="p-4 bg-secondary-subtle border border-1 rounded font-monospace border-secondary-subtle col-md-10">
        <a class="link-secondary" href="https://bitcoindata.science/altcoinstalk/notification.php?user=bitmover">
          https://bitcoindata.science/altcoinstalk/notification.php<span class="link-primary">?user=bitmover</span>
        </a>
      </div>

      <?php
    }
    ?>
  </main>
   <footer-component></footer-component>

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