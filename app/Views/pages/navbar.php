<?php

use PhpParser\Node\Stmt\Echo_;
?>
<!--begin::App Wrapper-->
<div class="app-wrapper">
    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Start Navbar Links-->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                        <i class="bi bi-list"></i>
                    </a>
                </li>
            </ul>
            <h3><?= $title ?></h3>
            <ul class="navbar-nav">
                <a href="/logout" class="btn btn-danger btn-flat float-end">Logout</a>
            </ul>
            <!--end::Start Navbar Links-->
            <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
    </nav>
    <!--end::Header-->
    <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
            <!--begin::Brand Link-->
            <a href="<?php echo base_url('') ?>/admin" class="brand-link">
                <!--begin::Brand Image-->
                <img src="<?php echo base_url('') ?>logo.png" alt="AdminLTE Logo"
                    class="brand-image opacity-75 shadow" />
                <!--end::Brand Image-->
                <!--begin::Brand Text-->
                <span class="brand-text fw-light">Pusat7</span>
                <!--end::Brand Text-->
            </a>
            <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <!--begin::Sidebar Menu-->
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="/admin" class="nav-link <?= $active == 'dashboard' ? 'active' : '' ?>">
                            <i class="nav-icon bi-speedometer"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $navbar == 'data' ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Data
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/cabang" class="nav-link <?= $active == 'cabang' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p>Data Cabang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/panitia" class="nav-link <?= $active == 'panitia' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Data Panitia</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/muspika" class="nav-link <?= $active == 'muspika' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-user-tie"></i>
                                    <p>Data Muspika</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= $navbar == 'qurban' ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-brain"></i>
                            <p>
                                Master Qurban
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/qurban" class="nav-link <?= $active == 'qurban' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-server"></i>
                                    <p>Data Qurban Cabang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/amprah" class="nav-link <?= $active == 'amprah' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-server"></i>
                                    <p>Amprah Besek</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/realisasi" class="nav-link <?= $active == 'realisasi' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-server"></i>
                                    <p>Realisasi Besek</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/jadwal" class="nav-link <?= $active == 'jadwal' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-server"></i>
                                    <p>Jadwal Pengiriman</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= $navbar == 'penerimaan' ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>
                                Penerimaan
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/penerimaan" class="nav-link <?= $active == 'penerimaan' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-paw"></i>
                                    <p>Hewan Masuk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/datasapi" class="nav-link <?= $active == 'datasapi' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-paw"></i>
                                    <p>Data Sapi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/kandang" class="nav-link <?= $active == 'kandang' ? 'active' : '' ?>">
                            <i class="nav-icon bi-box-seam-fill"></i>
                            <p>Kandang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/besek" class="nav-link <?= $active == 'besek' ? 'active' : '' ?>">
                            <i class="nav-icon bi-box-seam-fill"></i>
                            <p>Produksi Besek</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/k3" class="nav-link <?= $active == 'k3' ? 'active' : '' ?>">
                            <i class="nav-icon bi-box-seam-fill"></i>
                            <p>K3</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $navbar == 'surat' ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                                Master Surat
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/kirimbesek" class="nav-link <?= $active == 'kirimbesek' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-envelope-open"></i>
                                    <p>Kirim Besek</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/kirimkulit" class="nav-link <?= $active == 'kirimkulit' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-envelope-open"></i>
                                    <p>Kirim Kulit</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/suratmuspika"
                                    class="nav-link <?= $active == 'suratmuspika' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-envelope-open"></i>
                                    <p>Surat Muspika</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/rekomendasi" class="nav-link <?= $active == 'rekomendasi' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-envelope-open"></i>
                                    <p>Surat Rekomendasi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/setting" class="nav-link <?= $active == 'setting' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-gear"></i>
                            <p>Setting</p>
                        </a>
                    </li>
                </ul>
                <!--end::Sidebar Menu-->
            </nav>
        </div>
        <!--end::Sidebar Wrapper-->
    </aside>
    <!--end::Sidebar-->
    <!--begin::App Main-->