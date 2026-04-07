<?php
// Security Headers
header("X-Frame-Options: SAMEORIGIN");
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://bitcoindata.science https://scripts.simpleanalyticscdn.com; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; img-src 'self' data: blob: https://flagcdn.com https://bitcoindata.science https://queue.simpleanalyticscdn.com; connect-src 'self' https://api.coingecko.com https://api.binance.com https://bitcoindata.science https://mempool.space https://api.blockcypher.com https://api.coindesk.com https://blockchain.info https://queue.simpleanalyticscdn.com; media-src 'self' blob:; worker-src 'self' blob:; frame-ancestors 'self';");

// Title and description defaults, can be overridden by setting $title and $description before including this file
$title = $title ?? 'bitcoin data.science - Data Analysis and bitcoin';
$description = $description ?? 'Data analysis and tools for anything related to bitcoin.';
$keywords = $keywords ?? 'bitcoin, data science, analytics, blockchain, bitcointalk';
$canonical = $canonical ?? 'https://bitcoindata.science';
// Ensure local routes work from the root (even in subdirectories)
$base = '/';
?>
<meta charset="utf-8">
<title><?= htmlspecialchars($title) ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?= htmlspecialchars($description) ?>">
<meta name="robots" content="index, follow" />
<meta name="keywords" content="<?= htmlspecialchars($keywords) ?>" />
<link rel="shortcut icon" href="<?= $base ?>img/favicon.svg">
<link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
<link rel="alternate" hreflang="x-default" href="<?= htmlspecialchars($canonical) ?>" />
<link rel="apple-touch-icon" sizes="180x180" href="<?= $base ?>img/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?= $base ?>img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?= $base ?>img/favicon-16x16.png">
<link rel="manifest" href="<?= $base ?>manifest.json" />
<link rel="mask-icon" href="<?= $base ?>img/safari-pinned-tab.svg" color="#111316">
<meta name="apple-mobile-web-app-title" content="bitcoin data.science">
<meta name="application-name" content="bitcoin data.science">
<meta name="msapplication-TileColor" content="#2b5797">
<meta name="theme-color" content="#111316">
<meta property="og:title" content="<?= htmlspecialchars($title) ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?= htmlspecialchars($canonical) ?>" />
<meta property="og:image" content="https://bitcoindata.science/img/logo.png" />
<meta property="og:description" content="<?= htmlspecialchars($description) ?>" />
<meta property="og:locale" content="en_US" />
<meta property="og:site_name" content="bitcoin data.science" />

<!-- Aplly theme to avoid (FOUC) -->
<script>
  (() => {
    const theme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    document.documentElement.setAttribute('data-bs-theme', theme === 'auto' ? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light') : theme);
  })();
</script>

<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>

<!-- Bootstrap CSS e JS (CDN) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>

<link href="<?= $base ?>css/style.css" rel="stylesheet">
<script src="<?= $base ?>components/navbar.js" defer></script>
<script src="<?= $base ?>components/footer.js" defer></script>
<script src="<?= $base ?>components/ad.js" defer></script>
<!-- Simple Analytics -->
<script async defer src="https://bitcoindata.science/api/simple.php/proxy.js" data-collect-dnt="true"></script>
<script async src="https://bitcoindata.science/api/simple.php/auto-events.js" data-collect="outbound,emails" data-use-title="true" data-full-urls="true"></script>
