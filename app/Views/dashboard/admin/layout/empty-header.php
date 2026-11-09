<!DOCTYPE html>
<html lang="en">

<head>
    <?= view('layout/header-partials/stylesheets') ?>
    <?= view('dashboard/shared-style') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.css" integrity="sha512-7vaQ4LLdaXd2IuMd4MUQ6LRFIGbEwJI1aq6KYqL3RjbdQyUkRFhwZKmqmkBXurTFdGlx687lTN8FSJfX6Df8Gw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/theme/dracula.css" integrity="sha512-xGcoVXst3s+HA9HMoToxdHRy1NaFxaj1N8KSWVUTiTG2fkbteoxYEX3yUTC6GFW5K4Gd+78s03tMCzuCJElu/g==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body>
    <?= view('dashboard/admin/layout/component/top-nav') ?>