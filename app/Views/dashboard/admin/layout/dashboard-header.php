<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>

    <?= view('layout/header-partials/stylesheets') ?>
    <style>
        dialog {
            position: fixed;
            margin: auto;
            inset: 0;
            padding: 10px;
        }
    </style>
    <link href="https://cdn.datatables.net/v/bs5/dt-3.0.3/datatables.min.css" rel="stylesheet" integrity="sha384-Maig33PgZZN3UMUa9qasQfI9v9qsxL0zJWaH6fwalfIfMocpM539Tx00AnbMaE62" crossorigin="anonymous">
</head>

<body>
    <?= view('dashboard/admin/layout/component/top-nav') ?>
    <div class="container-fluid">
        <div class="row">
            <?= view('dashboard/admin/layout/component/sidebar') ?>