<!-- Page content -->
<div class="container">
    <div class="text-center mt-5">
        <h1 class="fw-bold">Selamat datang di penyembelihan Pusat 7</h1>
    </div>
</div>

<main class="app-main py-4">
    <div class="container-fluid">
        <div class="row g-3">

            <!-- Card Item -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-secondary shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Jumlah Cabang</h5>
                        <p class="card-text fs-4 fw-semibold"><?= $jumlahcabang ?></p>
                    </div>
                </div>
            </div>

            <!-- Total Pequrban -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-secondary shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Pequrban</h5>
                        <p class="card-text fs-4 fw-semibold">
                            <?= $sapib_bumm + ($sapi_bumm * 7) + ($sapi_mandiri * 7) + $kambing_bumm + $kambing_mandiri ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Total Panitia -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-secondary shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Panitia</h5>
                        <p class="card-text fs-4 fw-semibold"><?= $jumlahpanitia ?></p>
                    </div>
                </div>
            </div>

            <!-- Data Muspika -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-secondary shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Data Muspika</h5>
                        <p class="card-text fs-4 fw-semibold"><?= $jumlahmuspika ?></p>
                    </div>
                </div>
            </div>

            <!-- Sapi BUMM -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-secondary shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Sapi BUMM</h5>
                        <p class="card-text fs-4 fw-semibold"><?= number_format($sapi_bumm + ($sapib_bumm / 7), 1, '.', '') ?></p>
                    </div>
                </div>
            </div>

            <!-- Kambing BUMM -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-secondary shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kambing BUMM</h5>
                        <p class="card-text fs-4 fw-semibold"><?= $kambing_bumm ?></p>
                    </div>
                </div>
            </div>

            <!-- Sapi Cabang -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-secondary shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Sapi Cabang</h5>
                        <p class="card-text fs-4 fw-semibold"><?= $sapi_mandiri ?></p>
                    </div>
                </div>
            </div>

            <!-- Kambing Cabang -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-secondary shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kambing Cabang</h5>
                        <p class="card-text fs-4 fw-semibold"><?= $kambing_mandiri ?></p>
                    </div>
                </div>
            </div>

            <!-- Sapi Cabang -->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card border-secondary shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Jumlah Total Sapi</h5>
                        <p class="card-text fs-4 fw-semibold"><?= number_format($sapi_mandiri + $sapi_bumm + ($sapib_bumm / 7), 1, '.', '') ?></p>
                    </div>
                </div>
            </div>

            <!-- Kambing Cabang -->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card border-secondary shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Jumlah Total Kambing</h5>
                        <p class="card-text fs-4 fw-semibold"><?= $kambing_mandiri + $kambing_bumm ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>