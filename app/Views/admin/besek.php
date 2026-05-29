<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="fw-bold mb-0">Data Besek</h4>
                    <small class="text-muted">Produksi Besek Tahun <?= esc($year ?? date('Y')) ?></small>
                </div>
                <div class="col-sm-6 text-end">
                    <form action="" method="get" class="d-flex align-items-center justify-content-end gap-2">
                        <label class="small text-muted mb-0">Pilih Tahun</label>
                        <select name="year" onchange="this.form.submit()" class="form-select form-select-sm shadow-sm" style="width:120px">
                            <?php
                            $tahun_aktif = $year ?? date('Y');
                            for ($y = date('Y'); $y >= 2020; $y--): ?>
                                <option value="<?= $y ?>" <?= $y == $tahun_aktif ? 'selected' : '' ?>>
                                    <?= $y ?>
                                </option>
                            <?php endfor ?>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <!-- Notifikasi Flashdata -->
            <div class="row">
                <div class="col-12">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row g-4">
                <!-- Form Input Hewan -->
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm">
                        <!--begin::Header-->
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0">Input Besek</h6>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form class="needs-validation" action="/besek/create" method="post" novalidate>
                            <?= csrf_field() ?>
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Row-->
                                <div class="row g-3">
                                    <!--begin::Col-->
                                    <div class="col-md-4">
                                        <label for="ts" class="form-label">TS</label>
                                        <input type="number" class="form-control" name="ts" min="0" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tk" class="form-label">TK</label>
                                        <input type="number" class="form-control" name="tk" min="0" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="a" class="form-label">M</label>
                                        <input type="number" class="form-control" name="a" min="0" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="os" class="form-label">OS</label>
                                        <input type="number" class="form-control" name="os" min="0" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="ok" class="form-label">OK</label>
                                        <input type="number" class="form-control" name="ok" min="0" required>
                                    </div>
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer text-end">
                                <button class="btn btn-info" type="submit"><i class="bi bi-save me-1"></i> Simpan Data</button>
                                <a href="<?= base_url('besek/export') ?>?year=<?= $year ?>" class="btn btn-success"><i class="bi bi-file-earmark-excel me-1"></i> Export Excel</a>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Small Box Widget 1-->
                </div>
                <!--end::Col-->
                <div class="col-12 col-lg-6">
                    <div class="card border-warning shadow-sm">
                        <div class="card-header bg-warning text-dark">
                            <h6 class="mb-0">Produksi Dan Stock Besek Hari Ini (<?= date('d-m-Y') ?>)</h6>
                        </div>
                        <div class="card-body p-2">
                            <table class="table table-sm table-bordered mb-0 text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>Besek</th>
                                        <th width="15%">TS</th>
                                        <th width="15%">TK</th>
                                        <th width="15%">M</th>
                                        <th width="15%">OS</th>
                                        <th width="15%">OK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        <td>Produksi Besek</td>
                                        <td><?= $today_ts ?></td>
                                        <td><?= $today_tk ?></td>
                                        <td><?= $today_a ?></td>
                                        <td><?= $today_os ?></td>
                                        <td><?= $today_ok ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td class="text-danger">Keluar</td>
                                        <td class="text-danger"><?= $kirim_ts + $permintaan_ts ?></td>
                                        <td class="text-danger"><?= $kirim_tk + $permintaan_tk ?></td>
                                        <td class="text-danger"><?= $kirim_a + $permintaan_a ?></td>
                                        <td class="text-danger"><?= $kirim_os + $permintaan_os ?></td>
                                        <td class="text-danger"><?= $kirim_ok + $permintaan_ok ?></td>
                                    </tr>
                                </tbody>
                                <tfoot class="table-light">
                                    <tr class="fw-bold">
                                        <th>Stock</th>
                                        <td class="text-primary"><?= $today_ts - ($kirim_ts + $permintaan_ts) ?></td>
                                        <td class="text-primary"><?= $today_tk - ($kirim_tk + $permintaan_tk) ?></td>
                                        <td class="text-primary"><?= $today_a - ($kirim_a + $permintaan_a) ?></td>
                                        <td class="text-primary"><?= $today_os - ($kirim_os + $permintaan_os) ?></td>
                                        <td class="text-primary"><?= $today_ok - ($kirim_ok + $permintaan_ok) ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end::Col-->

                <!-- Total Produksi -->
                <div class="col-12 col-lg-6">
                    <div class="card border-primary shadow-sm h-100">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">Total Produksi Besek Tahun <?= esc($year) ?></h6>
                        </div>
                        <div class="card-body d-flex align-items-center">
                            <table class="table table-sm table-bordered mb-0 text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>TS</th>
                                        <th>TK</th>
                                        <th>M</th>
                                        <th>OS</th>
                                        <th>OK</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle fw-bold">
                                        <td class="text-primary"><?= number_format($total_ts) ?></td>
                                        <td class="text-primary"><?= number_format($total_tk) ?></td>
                                        <td class="text-primary"><?= number_format($total_a) ?></td>
                                        <td class="text-primary"><?= number_format($total_os) ?></td>
                                        <td class="text-primary"><?= number_format($total_ok) ?></td>
                                        <td class="bg-primary text-white"><?= number_format($total_besek) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-12">
                    <div class="row g-4">
                        <!-- Data Hewan -->
                        <div class="col-12">
                            <div class="card border-success shadow-sm">
                                <div class="card-header bg-success">
                                    <h6 class="mb-0 text-white">Riwayat Input Besek Tahun <?= esc($year) ?></h6>
                                </div>
                                <div class="card-body p-2">
                                    <div class="table-responsive">
                                        <table id="datatablesSimple" class="table table-hover table-striped align-middle text-center mb-0" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">No</th>
                                                    <th>Besek TS</th>
                                                    <th>Besek TK</th>
                                                    <th>Besek M</th>
                                                    <th>Besek OS</th>
                                                    <th>Besek OK</th>
                                                    <th>Tanggal Input</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php if ($viewbesek): ?>
                                                    <?php foreach ($viewbesek as $besek): ?>
                                                        <tr class="align-middle">
                                                            <td><?= $no++; ?></td>
                                                            <td><?php echo $besek['ts']; ?></td>
                                                            <td><?php echo $besek['tk']; ?></td>
                                                            <td><?php echo $besek['a']; ?></td>
                                                            <td><?php echo $besek['os']; ?></td>
                                                            <td><?php echo $besek['ok']; ?></td>
                                                            <td><small class="text-muted"><?php echo date('d/m/Y H:i', strtotime($besek['date_input'])); ?></small></td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                                    data-bs-target="#hapusdata<?php echo $besek['id']; ?>">
                                                                    <i class="bi bi-trash"></i> Hapus
                                                                </button>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="hapusdata<?php echo $besek['id']; ?>"
                                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                <h4 class="fw-bold">Apakah anda yakin?</h4>
                                                                                <p class="text-muted">Menghapus data produksi besek tanggal
                                                                                    <strong><?php echo date('d/m/Y', strtotime($besek['date_input'])); ?></strong>
                                                                                </p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-warning"
                                                                                    data-bs-dismiss="modal">Batal</button>
                                                                                <a href="<?= base_url('besek/delete/' . $besek['id']) ?>"
                                                                                    type="button" class="btn btn-danger">Hapus</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::App Content-->
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<!--end::App Main-->

<?= $this->endSection() ?>