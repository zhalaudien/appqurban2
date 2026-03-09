<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<main class="app-main py-4" style="background:#f5f7fb;">
    <div class="container-fluid">

        <!-- KPI UTAMA -->
        <div class="row g-4 mb-4">

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <small class="text-muted">Total Hewan</small>
                        <h3 class="fw-bold mt-2 mb-1">128</h3>
                        <small class="text-success">▲ 12% dari tahun lalu</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <small class="text-muted">Total Sapi</small>
                        <h3 class="fw-bold mt-2 mb-1">70</h3>
                        <small class="text-muted">BUMM & Cabang</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <small class="text-muted">Total Kambing</small>
                        <h3 class="fw-bold mt-2 mb-1">58</h3>
                        <small class="text-muted">BUMM & Cabang</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <small class="text-muted">Uang Masuk</small>
                        <h3 class="fw-bold mt-2 mb-1">Rp 245 JT</h3>
                        <small class="text-success">▲ 8% peningkatan</small>
                    </div>
                </div>
            </div>

        </div>


        <!-- PROGRESS SECTION -->
        <div class="row g-4 mb-4">

            <!-- Penyembelihan -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3">Progress Penyembelihan</h6>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <small>Sapi</small>
                                <small>65 / 70</small>
                            </div>
                            <div class="progress" style="height:8px;">
                                <div class="progress-bar bg-primary" style="width:92%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex justify-content-between">
                                <small>Kambing</small>
                                <small>50 / 58</small>
                            </div>
                            <div class="progress" style="height:8px;">
                                <div class="progress-bar bg-success" style="width:86%"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Produksi Besek -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3">Produksi Besek</h6>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <small>Total Produksi</small>
                                <small>3.200</small>
                            </div>
                            <div class="progress" style="height:8px;">
                                <div class="progress-bar bg-warning" style="width:80%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex justify-content-between">
                                <small>Sudah Distribusi</small>
                                <small>2.850</small>
                            </div>
                            <div class="progress" style="height:8px;">
                                <div class="progress-bar bg-danger" style="width:72%"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>


        <!-- RINGKASAN DETAIL -->
        <div class="row g-4">

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <small class="text-muted">Sapi BUMM</small>
                        <h4 class="fw-bold mt-2">30</h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <small class="text-muted">Sapi Cabang</small>
                        <h4 class="fw-bold mt-2">40</h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <small class="text-muted">Shadaqoh</small>
                        <h4 class="fw-bold mt-2">Rp 45 JT</h4>
                    </div>
                </div>
            </div>

        </div>

    </div>
</main>



<?= $this->endSection() ?>