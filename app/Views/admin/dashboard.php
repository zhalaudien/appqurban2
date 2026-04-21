<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<main class="app-main py-4" style="background:#f5f7fb;">
    <div class="container-fluid">

        <!-- ROW 1: KPI UTAMA -->
        <div class="row g-4 mb-4">

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div>
                                <i class="bi bi-people text-primary"></i>
                            </div>
                            <small class="text-muted">Total Panitia</small>
                        </div>
                        <h3 class="fw-bold mb-0"><?= number_format($totalPanitia) ?></h3>
                        <small class="text-muted">Personil Terdaftar</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div>
                                <i class="bi bi-people text-primary"></i>
                            </div>
                            <small class="text-muted">Total Pequrban</small>
                        </div>
                        <h3 class="fw-bold mb-0"><?= number_format($totalPequrban) ?></h3>
                        <small class="text-muted">Pequrban Terdaftar</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div>
                                <i class="bi bi-box-fill text-success"></i>
                            </div>
                            <small class="text-muted">Total Sapi</small>
                        </div>
                        <h3 class="fw-bold mb-0"><?= $targetSapi ?></h3>
                        <small class="text-muted">Ekor</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div>
                                <i class="bi bi-box-fill text-info"></i>
                            </div>
                            <small class="text-muted">Total Kambing</small>
                        </div>
                        <h3 class="fw-bold mb-0"><?= number_format($targetKambing) ?></h3>
                        <small class="text-muted">Ekor</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROW 1: KPI UTAMA -->
        <div class="row g-4 mb-4">

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div>
                                <i class="bi bi-box-fill text-success"></i>
                            </div>
                            <small class="text-muted">Sapi BUMM</small>
                        </div>
                        <h3 class="fw-bold mb-0"><?= $sapiBumm ?></h3>
                        <small class="text-muted">Ekor</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div>
                                <i class="bi bi-box-fill text-success"></i>
                            </div>
                            <small class="text-muted">Sapi Cabang</small>
                        </div>
                        <h3 class="fw-bold mb-0"><?= $sapiCabang ?></h3>
                        <small class="text-muted">Ekor</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div>
                                <i class="bi bi-box-fill text-info"></i>
                            </div>
                            <small class="text-muted">Kambing BUMM</small>
                        </div>
                        <h3 class="fw-bold mb-0"><?= number_format($kambingBumm) ?></h3>
                        <small class="text-muted">Ekor</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div>
                                <i class="bi bi-box-fill text-info"></i>
                            </div>
                            <small class="text-muted">Kambing Cabang</small>
                        </div>
                        <h3 class="fw-bold mb-0"><?= number_format($kambingCabang) ?></h3>
                        <small class="text-muted">Ekor</small>
                    </div>
                </div>
            </div>

        </div>

        <!-- ROW 1: KPI UTAMA -->
        <div class="row g-4 mb-4">

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div>
                                <i class="bi bi-people text-primary"></i>
                            </div>
                            <small class="text-muted">Jumlah Cabang</small>
                        </div>
                        <h3 class="fw-bold mb-0"><?= number_format($totalCabang) ?></h3>
                        <small class="text-muted">Cabang</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div>
                                <i class="bi bi-box-fill text-success"></i>
                            </div>
                            <small class="text-muted">Data Muspika</small>
                        </div>
                        <h3 class="fw-bold mb-0"><?= number_format($muspikaCount) ?></h3>
                        <small class="text-muted">Orang</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div>
                                <i class="bi bi-cash-stack text-warning"></i>
                            </div>
                            <small class="text-muted">Dana Masuk</small>
                        </div>
                        <h3 class="fw-bold mb-0">Rp <?= number_format($totalUang / 1000000, 1) ?> JT</h3>
                        <small class="text-success">Total Bayar + Shadaqoh</small>
                    </div>
                </div>
            </div>

        </div>


        <!-- ROW 2: PROGRESS SECTION -->
        <div class="row g-4 mb-4">

            <!-- Pengiriman Hewan BUMM-->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-semibold mb-0">Pengiriman Hewan BUMM</h6>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <small>Sapi BUMM</small>
                                <small><?= $sembelihSapiFmt ?> / <?= $terimaSapiFmt ?></small>
                            </div>
                            <div class="progress" style="height:8px;">
                                <?php $percSapi = $terimaSapi > 0 ? ($sembelihSapi / $terimaSapi) * 100 : 0; ?>
                                <div class="progress-bar bg-primary" style="width:<?= $percSapi ?>%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex justify-content-between">
                                <small>Kambing BUMM</small>
                                <small><?= $sembelihKambing ?> / <?= $terimaKambing ?></small>
                            </div>
                            <div class="progress" style="height:8px;">
                                <?php $percKambing = $terimaKambing > 0 ? ($sembelihKambing / $terimaKambing) * 100 : 0; ?>
                                <div class="progress-bar bg-success" style="width:<?= $percKambing ?>%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengiriman Hewan Cabang-->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-semibold mb-0">Pengiriman Hewan Cabang</h6>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <small>Sapi Cabang</small>
                                <small><?= $sembelihSapiFmt ?> / <?= $terimaSapiFmt ?></small>
                            </div>
                            <div class="progress" style="height:8px;">
                                <?php $percSapi = $terimaSapi > 0 ? ($sembelihSapi / $terimaSapi) * 100 : 0; ?>
                                <div class="progress-bar bg-primary" style="width:<?= $percSapi ?>%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex justify-content-between">
                                <small>Kambing Cabang</small>
                                <small><?= $sembelihKambing ?> / <?= $terimaKambing ?></small>
                            </div>
                            <div class="progress" style="height:8px;">
                                <?php $percKambing = $terimaKambing > 0 ? ($sembelihKambing / $terimaKambing) * 100 : 0; ?>
                                <div class="progress-bar bg-success" style="width:<?= $percKambing ?>%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- ROW 3: STOK KANDANG & K3 -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-md-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 pt-3">
                        <h6 class="fw-bold mb-0">Stok Hewan di Kandang</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6 border-end">
                                <h4 class="fw-bold text-primary mb-0"><?= $stokSapi ?></h4>
                                <small class="text-muted">Sapi Hidup</small>
                            </div>
                            <div class="col-6">
                                <h4 class="fw-bold text-success mb-0"><?= $stokKambing ?></h4>
                                <small class="text-muted">Kambing Hidup</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 pt-3">
                        <h6 class="fw-bold mb-0">Stok Bagian (K3) Harian</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-3">
                                <h5 class="fw-bold mb-0"><?= $k3['ks'] ?></h5>
                                <small class="text-muted" style="font-size: 10px;">Kepala Sapi</small>
                            </div>
                            <div class="col-3">
                                <h5 class="fw-bold mb-0"><?= $k3['kb'] ?></h5>
                                <small class="text-muted" style="font-size: 10px;">Kepala Kmb</small>
                            </div>
                            <div class="col-3">
                                <h5 class="fw-bold mb-0"><?= $k3['kks'] ?></h5>
                                <small class="text-muted" style="font-size: 10px;">Kaki Sapi</small>
                            </div>
                            <div class="col-3">
                                <h5 class="fw-bold mb-0"><?= $k3['kls'] ?></h5>
                                <small class="text-muted" style="font-size: 10px;">Kulit Sapi</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROW 3: STOK KANDANG & K3 -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-md-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 pt-3">
                        <h6 class="fw-bold mb-0">Total Produksi Besek</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-2 border-end">
                                <h4 class="fw-bold text-primary mb-0"><?= number_format($prod->ts ?? 0) ?></h4>
                                <small class="text-muted">TS</small>
                            </div>
                            <div class="col-2">
                                <h4 class="fw-bold text-success mb-0"><?= number_format($prod->tk ?? 0) ?></h4>
                                <small class="text-muted">TK</small>
                            </div>
                            <div class="col-2 border-end">
                                <h4 class="fw-bold text-primary mb-0"><?= number_format($prod->m ?? 0) ?></h4>
                                <small class="text-muted">M</small>
                            </div>
                            <div class="col-2">
                                <h4 class="fw-bold text-success mb-0"><?= number_format($prod->a ?? 0) ?></h4>
                                <small class="text-muted">A</small>
                            </div>
                            <div class="col-2 border-end">
                                <h4 class="fw-bold text-primary mb-0"><?= number_format($prod->os ?? 0) ?></h4>
                                <small class="text-muted">OS</small>
                            </div>
                            <div class="col-2">
                                <h4 class="fw-bold text-success mb-0"><?= number_format($prod->ok ?? 0) ?></h4>
                                <small class="text-muted">OK</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 pt-3">
                        <h6 class="fw-bold mb-0">Produksi Besek Harian</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-2 border-end">
                                <h4 class="fw-bold text-primary mb-0"><?= number_format($harian->ts ?? 0) ?></h4>
                                <small class="text-muted">TS</small>
                            </div>
                            <div class="col-2">
                                <h4 class="fw-bold text-success mb-0"><?= number_format($harian->tk ?? 0) ?></h4>
                                <small class="text-muted">TK</small>
                            </div>
                            <div class="col-2 border-end">
                                <h4 class="fw-bold text-primary mb-0"><?= number_format($harian->m ?? 0) ?></h4>
                                <small class="text-muted">M</small>
                            </div>
                            <div class="col-2">
                                <h4 class="fw-bold text-success mb-0"><?= number_format($harian->a ?? 0) ?></h4>
                                <small class="text-muted">A</small>
                            </div>
                            <div class="col-2 border-end">
                                <h4 class="fw-bold text-primary mb-0"><?= number_format($harian->os ?? 0) ?></h4>
                                <small class="text-muted">OS</small>
                            </div>
                            <div class="col-2">
                                <h4 class="fw-bold text-success mb-0"><?= number_format($harian->ok ?? 0) ?></h4>
                                <small class="text-muted">OK</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>



<?= $this->endSection() ?>