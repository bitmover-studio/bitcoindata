<?php
$h1 = $h1 ?? '';
$h2 = $h2 ?? '';
$mainClass = $mainClass ?? 'container-fluid px-4 px-lg-5';
$h1Class = $h1Class ?? 'display-5 fw-bold mb-3 lh-sm tracking-tight hero-heading';
$showAd = $showAd ?? true;
$showBG = $showBG ?? false;

// Load shared menu data to pick the tool icon for the hero area
$menuData = include __DIR__ . '/menu-data.php';

if (!isset($heroIcon)) {
   $heroIcon = null;
   $currentUri = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
   $currentScript = $_SERVER['SCRIPT_NAME'] ?? '';

   foreach ($menuData as $cat) {
      foreach ($cat['tools'] as $tool) {
         $link = $tool['link'];
         if (
            $currentUri === $link ||
            $currentUri === $link . '.php' ||
            $currentScript === $link ||
            $currentScript === $link . '.php' ||
            (!empty($h1) && stripos($h1, $tool['name']) !== false)
         ) {
            $heroIcon = $tool['icon'];
            break 2;
         }
      }
   }
}

// Inject internal linearGradient with userSpaceOnUse to properly paint 0-width/0-height lines (Unit Converter, Withdrawal Strategy)
$heroSvg = null;
if (!empty($heroIcon)) {
   $gradientDefs = '<defs><linearGradient id="heroGradient" gradientUnits="userSpaceOnUse" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#26b2a0" /><stop offset="100%" stop-color="#3b82f6" /></linearGradient></defs>';
   $heroSvg = preg_replace('/(<svg[^>]*>)/i', '$1' . $gradientDefs, $heroIcon);
   $heroSvg = str_ireplace('currentColor', 'url(#heroGradient)', $heroSvg);
}
?>
<main
   class="<?= htmlspecialchars($mainClass) ?> <?php if ($showBG): ?> bg-diamond-grid--opacity-low bg-diamond-grid <?php endif; ?>">
   <?php if ($showAd): ?>
      <?php include __DIR__ . '/ad.php'; ?>
   <?php endif; ?>
   <div id="breadcrumb-container" class="mt-2"></div>
   <?php if (!empty($h1)): ?>
      <section class="page-hero-section pt-5 mt-4 pb-2 mb-4">
         <div class="row align-items-center justify-content-between g-4">
            <!-- Left Column: Title & Description -->
            <div class="col-12 col-lg-8 col-xl-8">
               <h1 class="h1 <?= htmlspecialchars($h1Class) ?>"><?= $h1 ?></h1>
               <?php if (!empty($h2)): ?>
                  <h2 class="lead text-muted mb-3 fw-normal"><?= $h2 ?></h2>
               <?php endif; ?>
            </div>

            <!-- Right Column: Tool Icon matching landing page hero -->
            <!-- <?php if (!empty($heroSvg)): ?>
               <div class="col-12 col-lg-5 col-xl-6 d-none d-lg-flex align-items-center justify-content-center">
                  <div
                     class="hero-vector-wrapper position-relative w-100 text-center d-flex align-items-center justify-content-center hero-tool-icon opacity-75"
                     style="max-width: 520px;">
                     <?= $heroSvg ?>
                  </div>
               </div>
            <?php endif; ?> -->
         </div>
      </section>
   <?php endif; ?>