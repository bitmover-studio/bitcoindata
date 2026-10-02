<?php
$h1 = $h1 ?? '';
$h2 = $h2 ?? '';
$mainClass = $mainClass ?? 'container-fluid col-lg-12 col-xl-9 px-0 px-xl-0 px-4';
$h1Class = $h1Class ?? 'display-5';
$showAd = $showAd ?? true;
?>
<main class="<?= htmlspecialchars($mainClass) ?>">
   <div id="breadcrumb-container" class="mt-2"></div>
   <?php if ($showAd): ?>
      <?php include __DIR__ . '/ad.php'; ?>
   <?php endif; ?>
   <div class="pt-4">
      <h1 class="h1 <?= htmlspecialchars($h1Class) ?> fw-bold mt-5"><?= $h1 ?></h1>
      <?php if (!empty($h2)): ?>
         <h2 class="lead text-muted mb-5"><?= $h2 ?></h2>
      <?php endif; ?>
   </div>