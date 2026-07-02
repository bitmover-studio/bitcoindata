<?php
$h1 = $h1 ?? '';
$h2 = $h2 ?? '';
$mainClass = $mainClass ?? 'container-fluid col-lg-12 col-xl-9 px-0 px-xl-0 px-4';
$h1Class = $h1Class ?? 'display-3';
$showAd = $showAd ?? true;
?>
<main class="<?= htmlspecialchars($mainClass) ?>">
   <?php if ($showAd): ?>
   <ad-component></ad-component>
   <?php endif; ?>
   <div class="col-md-10 offset-md-1">
      <h1 class="h1 <?= htmlspecialchars($h1Class) ?> fw-bold mt-5"><?= $h1 ?></h1>
      <?php if (!empty($h2)): ?>
      <h2 class="lead fw-semibold text-muted mb-6"><?= $h2 ?></h2>
      <?php endif; ?>
   </div>
