<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <?= view('layout/header-partials/header-function') ?>
    <?= view('layout/header-partials/meta-tags') ?>
    <?= view('layout/header-partials/stylesheets') ?>
    <?= view('layout/header-partials/js-scripts') ?>
</head>

<body>
    <?= view('pages/component/AnnouncementBar') ?>
    <header class="no-print position-sticky" style="top:0;z-index:1050;">
        <?php if (isMobileDevice()): ?>
            <?= view('layout/header-partials/nav-mobile') ?>
        <?php else: ?>
            <?= view('layout/header-partials/navbar') ?>
        <?php endif; ?>
    </header>
    <main>