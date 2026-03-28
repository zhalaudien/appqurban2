<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<main class="app-main py-4" style="background:#f5f7fb;">
    <div class="container-fluid">

        <!-- Header & Filter -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">Dashboard BUMM</h4>
                <small class="text-muted">Ringkasan data qurban tahun <?= esc($year) ?></small>
            </div>
            <form action="" method="get" class="d-flex align-items-center gap-2">
                <select name="year" class="form-select form-select-sm shadow-sm" onchange="this.form.submit()">
                    <?php for ($i = date('Y'); $i >= 2020; $i--): ?>
                        <option value="<?= $i ?>" <?= $i == $year ? 'selected' : '' ?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </form>
        </div>

        <!-- KPI UTAMA -->
        <div class="row g-4 mb-4">

            <div class="col-6 col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <small class="text-muted">Total Sapi</small>
                        <h3 class="fw-bold mt-2 mb-1"><?= number_format($totalSapi / 7) ?></h3>
                        <small class="text-muted">Ekor</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <small class="text-muted">Total Kambing</small>
                        <h3 class="fw-bold mt-2 mb-1"><?= number_format($totalKambing) ?></h3>
                        <small class="text-muted">Ekor</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <small class="text-muted">Uang Masuk</small>
                        <h3 class="fw-bold mt-2 mb-1">Rp <?= number_format($totalUang / 1000000, 1) ?> JT</h3>
                        <small class="text-success"></small>
                    </div>
                </div>
            </div>

        </div>

        <!-- PROGRESS SECTION -->
        <div class="row g-4 mb-4">

            <!-- Penyembelihan -->
            <div class="col-12 col-lg-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3">Progress Pengiriman Hewan</h6>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <small>Sapi</small>
                                <small>65 / <?= $totalSapi ?></small>
                            </div>
                            <div class="progress" style="height:8px;">
                                <div class="progress-bar bg-primary" style="width:92%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex justify-content-between">
                                <small>Kambing</small>
                                <small>50 / <?= $totalKambing ?></small>
                            </div>
                            <div class="progress" style="height:8px;">
                                <div class="progress-bar bg-success" style="width:86%"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



<?= $this->endSection() ?>