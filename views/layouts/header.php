<?php
require_once __DIR__.'/../../config/constants.php';
require_once __DIR__.'/../../config/session.php';
require_once __DIR__.'/../../core/Functions.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?= APP_NAME ?></title>

<link rel="stylesheet"
href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css')?>">

<link rel="stylesheet"
href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css')?>">

<link rel="stylesheet"
href="<?= base_url('assets/css/style.css')?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">

<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">

</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">