<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= view('layout/header-partials/stylesheets') ?>
    <?= view('dashboard/shared-style') ?>
</head>

<body>

    <div class="">
        <div class="d-flex">
            <?= view('dashboard/user/layout/component/sidebar', ['data' => $this->data]) ?>