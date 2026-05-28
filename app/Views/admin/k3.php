<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="fw-bold mb-0">Data K3</h4>
                    <small class="text-muted">Manajemen Kepala, Kaki, dan Kulit Hewan Qurban</small>
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
            <div class="row g-4">
                <!-- Form Input Hewan -->
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm">
                        <!--begin::Header-->
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0">Input K3</h6>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form class="needs-validation" action="<?= base_url('k3/create') ?>" method="post" novalidate>
                            <?= csrf_field() ?>
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Row-->
                                <div class="row g-3">
                                    <!--begin::Col-->
                                    <div class="col-md-4">
                                        <label for="ks" class="form-label">Kepala Sapi</label>
                                        <input type="number" class="form-control" name="ks" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="kb" class="form-label">Kepala Kambing</label>
                                        <input type="number" class="form-control" name="kb" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="kks" class="form-label">Kaki Sapi</label>
                                        <input type="number" class="form-control" name="kks" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="kls" class="form-label">Kulit Sapi</label>
                                        <input type="number" class="form-control" name="kls" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="buntut" class="form-label">Buntut Sapi</label>
                                        <input type="number" class="form-control" name="buntut" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="klsb" class="form-label">Kulit Kambing</label>
                                        <input type="number" class="form-control" name="klsb" min="0">
                                    </div>
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer text-end">
                                <button class="btn btn-info" type="submit">Save Data</button>
                                <a href="<?= base_url('k3/export') ?>?year=<?= $year ?>" class="btn btn-success">Export Excel</a>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <!--end::Col-->
                <!--begin::Card Stock K3 Hari Ini-->
                <div class="col-12 col-lg-6">
                    <div class="card border-primary shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">Stock K3 Hari Ini (<?= date('d-m-Y') ?>)</h6>
                        </div>
                        <div class="card-body p-2">
                            <table class="table table-sm mb-0 text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>Jenis</th>
                                        <th>Kepala Sapi</th>
                                        <th>Kepala Kambing</th>
                                        <th>Kaki Sapi</th>
                                        <th>Buntut Sapi</th>
                                        <th>Kulit Sapi</th>
                                        <th>Kulit Kambing</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        <td>Masuk</td>
                                        <td><?= $ks_today ?></td>
                                        <td><?= $kb_today ?></td>
                                        <td><?= $kks_today ?></td>
                                        <td><?= $buntut_today ?></td>
                                        <td><?= $kls_today ?></td>
                                        <td><?= $klsb_today ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Keluar</td>
                                        <td><?= $kirim_ks + $permintaan_ks ?></td>
                                        <td><?= $kirim_kb  + $permintaan_kb ?></td>
                                        <td><?= $kirim_kks + $permintaan_kks ?></td>
                                        <td>0</td>
                                        <td><?= $kirim_kls + $permintaan_kls ?></td>
                                        <td>0</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Stock</th>
                                        <td><?= $ks_today - ($kirim_ks + $permintaan_ks) ?></td>
                                        <td><?= $kb_today - ($kirim_kb + $permintaan_kb) ?></td>
                                        <td><?= $kks_today - ($kirim_kks + $permintaan_kks) ?></td>
                                        <td><?= $buntut_today ?></td>
                                        <td><?= $kls_today - ($kirim_kls + $permintaan_kls) ?></td>
                                        <td><?= $klsb_today ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end::Card Stock K3 Hari Ini-->
                <div class="col-12 col-lg-12">
                    <div class="row g-4">
                        <!-- Data Hewan -->
                        <div class="col-12">
                            <div class="card border-success shadow-sm">
                                <div class="card-header bg-success">
                                    <h6 class="mb-0 text-white">Riwayat Input K3 Tahun <?= esc($year) ?></h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatablesSimple" class="table table-hover table-striped align-middle text-center mb-0" style="width:100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 10px">No</th>
                                                    <th>K_S</th>
                                                    <th>K_K</th>
                                                    <th>KK_S</th>
                                                    <th>BT_S</th>
                                                    <th>KL_S</th>
                                                    <th>KL_K</th>
                                                    <th>Waktu Input</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php if ($viewk3): ?>
                                                    <?php foreach ($viewk3 as $k3): ?>
                                                        <tr class="align-middle">
                                                            <td><?= $no++; ?></td>
                                                            <td><?php echo $k3['ks']; ?></td>
                                                            <td><?php echo $k3['kb']; ?></td>
                                                            <td><?php echo $k3['kks']; ?></td>
                                                            <td><?php echo $k3['buntut']; ?></td>
                                                            <td><?php echo $k3['kls']; ?></td>
                                                            <td><?php echo $k3['klsb']; ?></td>
                                                            <td><small class="text-muted"><?= date('d/m/Y H:i', strtotime($k3['date_input'])) ?></small></td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                                    data-bs-target="#hapusdata<?php echo $k3['id']; ?>">
                                                                    <i class="bi bi-trash"></i> Hapus
                                                                </button>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="hapusdata<?php echo $k3['id']; ?>"
                                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                <h2 class="h2">Apakah anda yakin ?</h2>
                                                                                <p>Menghapus data K3
                                                                                    tanggal <?= date('d/m/Y', strtotime($k3['date_input'])) ?>
                                                                                </p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-warning"
                                                                                    data-bs-dismiss="modal">Batal</button>
                                                                                <a href="<?= base_url('/k3/delete/' . $k3['id']) ?>"
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!--end::App Main-->

<?= $this->endSection() ?>