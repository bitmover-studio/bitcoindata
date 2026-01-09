<?php

function loginAndSearch($user)
{
  // The login credentials
  $username = 'bitmoverbot';
  $password = getenv('ALTCOINSPASSWORD');

  define('USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36');

  $forumUrl = 'https://www.altcoinstalks.com/index.php?action=login';
  $cookie_file = 'cookies.txt';
  $ch = curl_init($forumUrl);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $html = curl_exec($ch);
  if (curl_errno($ch)) {
    echo 'Curl error: ' . $user  . curl_error($ch);
    exit;
  }
  curl_close($ch);
  $dom = new DOMDocument();
  @$dom->loadHTML($html);
  $xpath = new DOMXPath($dom);
  $hidden_inputs = $xpath->query('//input[@type="hidden"]');

  $login_form_action_node = $xpath->query('//form[@id="frmLogin"]')->item(0);

  if ($login_form_action_node === null) {
    return 'Error: Login form not found. Altcoinstalks may be down or a CAPTCHA is present.';
  }
  $login_form_action = $xpath->query('//form[@id="frmLogin"]')->item(0)->getAttribute('action');
  $sec_hidden_input = $hidden_inputs->item(1); // second hidden input
  $login_page_data = array(
    'name' => $sec_hidden_input->getAttribute('name'),
    'value' => $sec_hidden_input->getAttribute('value'),
    'login_url' => $login_form_action,
    'session_id' => substr($login_form_action, 50, -14),
  );

  // Login
  $ch = curl_init($login_page_data['login_url']);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'user' => $username,
    'passwrd' => $password,
    'cookielength' => -1,
    'hash_passwrd' => '',
    $login_page_data['name'] => $login_page_data['value'],
    'PHPSESSID' => $login_page_data['session_id'],
    'login' => 'Login',
  ]);
  curl_setopt($ch, CURLOPT_COOKIESESSION, true);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
  curl_exec($ch);

  if (curl_errno($ch)) {
    return 'Curl error: ' . curl_error($ch); // Return error instead of echoing
  }


  // // // Logged in. Go to search URL.
  $search_url = "https://www.altcoinstalks.com/index.php?action=search;search=" . urlencode($user) . ";maxage=5;sort=id_msg|desc&show_complete=1&action=search2;&PHPSESSID=" . $login_page_data['session_id'];
  curl_setopt($ch, CURLOPT_URL, $search_url);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_HEADER, true);
  $search = curl_exec($ch);
  if (curl_errno($ch)) {
    echo 'Curl error: ' . $user . curl_error($ch);
    exit;
  }
  curl_close($ch);

  // Scrap search data
  $search_data = scrapSearch($search, $user);
  return $search_data;
}

// Scrap search data
function scrapSearch($html, $user)
{
  $dom = new DOMDocument();
  @$dom->loadHTML($html);
  $xpath = new DOMXPath($dom);
  $search_results_posts = $xpath->query('//div[@class="search_results_posts"]');
  $result = array();
  foreach ($search_results_posts as $post) {
    $by = $xpath->query('.//span/strong/a', $post)->item(0);
    $board = $xpath->query('.//h5/a', $post)->item(0);
    $post_link = $xpath->query('.//h5/a', $post)->item(1);
    $by = $xpath->query('.//span/strong/a', $post)->item(0);
    $date = $xpath->query('.//em', $post)->item(0)->nodeValue;
    $list_posts = $xpath->query('.//div[@class="list_posts"]', $post)->item(0);

    // future ignore user function
    if ($by->nodeValue !== $user) {
      $result[] = array(
        'board' => $board->nodeValue,
        'board_link' => $board->getAttribute('href'),
        'post' => $post_link->nodeValue,
        'post_link' => $post_link->getAttribute('href'),
        'by' => $by->nodeValue,
        'by_link' => $by->getAttribute('href'),
        'date' => $date,
        'list_posts' => $list_posts->C14N(), // Get the innerHTML of the list_posts div
      );
    }
  }
  return $result;
}
