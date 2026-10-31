<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= view('layout/header-partials/stylesheets') ?>
    <?= view('dashboard/shared-style') ?>

</head>

<body>
    <?= view('dashboard/manager/layout/component/top-nav') ?>
    <div class="container-fluid ">
        <div class="row">
            <?= view('dashboard/manager/layout/component/sidebar', ['data' => $this->data]) ?>