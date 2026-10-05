<?php
$banners = [
  [
    'desktop' => 'https://bitcoindata.science/img/bitlist-desktop.gif',
    'mobile' => 'https://bitcoindata.science/img/bitlist-mobile.gif',
    'link' => 'https://bitlist.co/?utm_source=bitcoindata.science',
    'title' => 'Bilist, list of bitcoin mixers and exchanges',
    'alt' => 'Bitlist'
  ],
  [
    'desktop' => 'https://bitcoindata.science/img/mixtum-desktop.gif',
    'mobile' => 'https://bitcoindata.science/img/mixtum-mobile.gif',
    'link' => 'https://mixtum.io/?utm_source=bitcoindata.science',
    'title' => 'MixTum, your privacy matters, premium bitcoin mixer',
    'alt' => 'MixTum'
  ]
];

// Select banner 1
$selectedBanner = $banners[1];
?>
<div class="container text-center my-3 mb-4 position-relative" style="z-index: 10;" id="sp-content">
  <a href="<?= htmlspecialchars($selectedBanner['link']) ?>" title="<?= htmlspecialchars($selectedBanner['title']) ?>"
    target="_blank" rel="noopener">
    <picture>
      <source media="(min-width: 768px)" srcset="<?= htmlspecialchars($selectedBanner['desktop']) ?>" width="1000"
        height="75">
      <img class="border-1 border-dark img-fluid rounded-3" alt="<?= htmlspecialchars($selectedBanner['alt']) ?>"
        src="<?= htmlspecialchars($selectedBanner['mobile']) ?>" width="320" height="100" fetchpriority="high"
        decoding="async" />
    </picture>
  </a>
  <div class="d-flex justify-content-center align-items-center position-relative" style="z-index: 11;">
    <p class="small mb-0">Sponsored Content</p>
    <button type="button" class="btn-close ms-2" aria-label="Close" title="Click to dismiss"
      style="cursor: pointer; position: relative; z-index: 12;"
      onclick="document.getElementById('sp-content').style.display='none'"></button>
  </div>
</div>