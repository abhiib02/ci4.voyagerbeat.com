<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <?= view('layout/header-partials/header-function') ?>
    <?= view('layout/header-partials/meta-tags') ?>
    <?= view('layout/header-partials/stylesheets') ?>
    <?= view('layout/header-partials/js-scripts') ?>
</head>

<body>

    <main>
        <header class="no-print">
            <?php if (isMobileDevice()): ?>
                <?= view('layout/header-partials/nav-mobile') ?>
            <?php else: ?>
                <?= view('layout/header-partials/navbar') ?>
            <?php endif; ?>
        </header>