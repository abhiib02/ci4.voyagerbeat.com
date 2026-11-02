<?php

/**
 * @var string $cssversion
 */
?>
<?php $cssversion = $cssversion ?? 'latest'; ?>
<link rel="manifest" href="../../manifest.webmanifest" fetchpriority="high" decoding="async">
<link rel="apple-touch-icon" href="../../assets/logo.png" fetchpriority="high" decoding="async">
<link rel="shortcut icon" type="image/png" href="../../assets/logo-comp.png" fetchpriority="high" decoding="async" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

<link rel="stylesheet" href="/css/fonts.css?v=<?= $cssversion ?>">
<link rel="stylesheet" href="/css/ezToast.css?v=<?= $cssversion ?>">
<link rel="stylesheet" href="/css/bootstrap-overrides.css?v=<?= $cssversion ?>">
<link rel="stylesheet" href="/css/megamenu.css?v=<?= $cssversion ?>">
<link rel="stylesheet" href="/css/style.css?v=<?= $cssversion ?>">
<link rel="stylesheet" href="/css/packageCard.css?v=<?= $cssversion ?>">
<link rel="stylesheet" href="/css/lenis.css?v=<?= $cssversion ?>" rel="preload">
<link rel="stylesheet" href="/css/packageCardSimple.css?v=<?= $cssversion ?>" rel="preload">
<link rel="stylesheet" href="/css/pagination.css?v=<?= $cssversion ?>" rel="preload">
<link rel="stylesheet" href="/css/tinymce-reset.css?v=<?= $cssversion ?>" rel="preload">
<link rel="stylesheet" href="/css/resets.css?v=<?= $cssversion ?>" rel="preload">
<link rel="stylesheet" href="/css/animation.css?v=<?= $cssversion ?>" rel="preload">
<link rel="stylesheet" href="/css/print.css?v=<?= $cssversion ?>" rel="preload">
<link rel="stylesheet" href="/css/boxicons.css?v=<?= $cssversion ?>" rel="preload">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.css" />