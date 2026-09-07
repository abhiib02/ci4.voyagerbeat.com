<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>

    <?= view('layout/header-partials/stylesheets') ?>
    <?= view('dashboard/shared-style') ?>

</head>

<body>
    <?= view('dashboard/admin/layout/component/top-nav') ?>
    <div class="container-fluid ">
        <div class="row">
            <?= view('dashboard/admin/layout/component/sidebar', ['data' => $this->data]) ?>