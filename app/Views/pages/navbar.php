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
                    <ul class="navbar-nav">
                        <a href="#" class="btn btn-danger btn-flat float-end">Logout</a>
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
                    <a href="./index.html" class="brand-link">
                        <!--begin::Brand Image-->
                        <img src="<?php echo base_url('') ?>/assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
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
                        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link active">
                                    <i class="nav-icon bi-speedometer"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-box-seam-fill"></i>
                                    <p>
                                        Data
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="./widgets/small-box.html" class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Data Cabang</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./widgets/info-box.html" class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Data Panitia</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./widgets/cards.html" class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Data Qurban</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-clipboard-fill"></i>
                                    <p>
                                        Master Qurban
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="./layout/unfixed-sidebar.html" class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Data Hewan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./layout/fixed-sidebar.html" class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Amprah Besek</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./layout/fixed-sidebar.html" class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Realisasi Besek</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./layout/fixed-sidebar.html" class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Jadwal Pengiriman</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-clipboard-fill"></i>
                                    <p>
                                        Penerimaan
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="./layout/unfixed-sidebar.html" class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Hewan Masuk</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link">
                                    <i class="nav-icon bi-speedometer"></i>
                                    <p>Kandang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link">
                                    <i class="nav-icon bi-speedometer"></i>
                                    <p>Produksi Besek</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-clipboard-fill"></i>
                                    <p>
                                        Master Surat
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="./layout/fixed-sidebar.html" class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Surat Jalan Besek</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./layout/fixed-sidebar.html" class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Surat Jalan Kulit</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./layout/fixed-sidebar.html" class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Surat Muspika</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./layout/fixed-sidebar.html" class="nav-link">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Surat Rekomendasi</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!--end::Sidebar Menu-->
                    </nav>
                </div>
                <!--end::Sidebar Wrapper-->
            </aside>
            <!--end::Sidebar-->
            <!--begin::App Main-->