<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>

    <?= view('layout/header-partials/stylesheets') ?>
    <link href="https://cdn.datatables.net/v/bs5/dt-3.0.3/datatables.min.css" rel="stylesheet" integrity="sha384-Maig33PgZZN3UMUa9qasQfI9v9qsxL0zJWaH6fwalfIfMocpM539Tx00AnbMaE62" crossorigin="anonymous">
</head>

<body>
    <?= view('dashboard/user/layout/component/top-nav') ?>
    <div class="container-fluid">
        <div class="row">
            <?= view('dashboard/user/layout/component/sidebar') ?>