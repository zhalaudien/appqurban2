<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Dashboard' ?> | AppQurban V3</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="<?php echo base_url('') ?>adminlte/plugins/fontawesome-free/css/all.min.css" />

    <!-- AdminLTE -->
    <link rel="stylesheet"
        href="<?php echo base_url('') ?>adminlte/dist/css/adminlte.min.css" />

    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?php echo base_url('') ?>adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />

    <?= $this->renderSection('styles') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">