<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>

    <?= view('layout/header-partials/stylesheets') ?>
    <?= view('dashboard/shared-style') ?>

</head>

<body>
    <?= view('dashboard/employee/layout/component/top-nav') ?>
    <div class="container-fluid ">
        <div class="row">
            <?= view('dashboard/employee/layout/component/sidebar', ['data' => $this->data]) ?>