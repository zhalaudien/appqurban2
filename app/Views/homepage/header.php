<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Panitia Pusat 7</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('') ?>logo.png" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?php echo base_url('') ?>homepage/css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url('') ?>">Pusat 7</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link <?= $active == 'home' ? 'active' : '' ?>"
                            aria-current="page" href="<?php echo base_url('') ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link <?= $active == 'jadwal2' ? 'active' : '' ?>"
                            href="<?php echo base_url('') ?>jadwal2">Jadwal
                            Pengiriman</a>
                    </li>
                    <li class="nav-item"><a class="nav-link <?= $active == 'datasapi2' ? 'active' : '' ?>"
                            href="<?php echo base_url('') ?>datasapi2">Data
                            Sapi</a></li>
                    <li class="nav-item"><a class="nav-link <?= $active == 'dataqurban' ? 'active' : '' ?>"
                            href="<?php echo base_url('') ?>dataqurban">Data
                            Qurban</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" hidden>Dropdown</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </li>
                </ul>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('') ?>admin">Login</a></li>
                </li>
                </ul>
            </div>
        </div>
    </nav>