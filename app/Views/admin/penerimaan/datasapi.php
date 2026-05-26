<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!-- Flash Messages -->
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i><?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Filter Tahun -->
                <div class="col-12">
                    <form action="" method="get" id="formFilterTahun" class="row mb-3">
                        <div class="col-md-3 ms-auto">
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-info text-white border-info">
                                    <i class="bi bi-calendar-event me-2"></i> Tahun Data
                                </span>
                                <select name="tahun" class="form-select border-info" onchange="this.form.submit()">
                                    <?php
                                    $tahun_aktif = $tahun_selected ?? date('Y');
                                    for ($i = date('Y'); $i >= 2020; $i--): ?>
                                        <option value="<?= $i ?>" <?= ($tahun_aktif == $i) ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row g-4">
                    <!-- Form Input Hewan -->
                    <div class="col-12 col-lg-12">
                        <div class="card shadow-sm">
                            <!--begin::Header-->
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0">Input Hewan Masuk</h6>
                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <form class="needs-validation" action="/datasapi/create" method="post" novalidate>
                                <?= csrf_field() ?>
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Row-->
                                    <div class="row g-3">
                                        <!--begin::Col-->
                                        <div class="col-md-3">
                                            <label for="cabang" class="form-label">Cabang</label>
                                            <select class="form-select" name="cabang">
                                                <option value="BUMM Sragen">BUMM</option>
                                                <?php if ($viewcabang): ?>
                                                    <?php foreach ($viewcabang as $cabang): ?>
                                                        <option value="<?php echo $cabang['nama_cabang']; ?>">
                                                            <?php echo $cabang['nama_cabang']; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-3">
                                            <label for="berat" class="form-label">Berat</label>
                                            <input type="text" class="form-control" name="berat">
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-3">
                                            <label for="nomor" class="form-label">Nomor Sapi</label>
                                            <input type="text" class="form-control" name="nomor">
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-3">
                                            <label for="harga" class="form-label">Harga</label>
                                            <input type="text" class="form-control" name="harga">
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Body-->
                                <!--begin::Footer-->
                                <div class="card-footer">
                                    <button class="btn btn-info" type="submit">Save Data</button>
                                    <a href="/datasapi/export" type="button" class="btn btn-success">Exsport
                                        Excel</a>
                                </div>
                                <!--end::Footer-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <div class="col-12 col-lg-12">
                        <div class="row g-4">
                            <!-- Data Hewan -->
                            <div class="col-12">
                                <div class="card border-success shadow-sm">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="mb-0"><i class="bi bi-table me-2"></i>Daftar Inventaris Sapi</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatablesSimple" class="table table-hover table-striped align-middle">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="text-center" style="width: 5%">No</th>
                                                        <th>Cabang</th>
                                                        <th class="text-center">Berat (kg)</th>
                                                        <th class="text-center">Nomor Sapi</th>
                                                        <th class="text-end">Harga</th>
                                                        <th class="text-center">Tanggal Input</th>
                                                        <th class="text-center" style="width: 15%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    <?php if ($viewsapi): ?>
                                                        <?php foreach ($viewsapi as $sapi): ?>
                                                            <tr>
                                                                <td class="text-center"><?= $no++; ?></td>
                                                                <td class="fw-bold"><?php echo $sapi['cabang']; ?></td>
                                                                <td class="text-center"><?php echo $sapi['berat']; ?> kg</td>
                                                                <td class="text-center"><span class="badge bg-secondary"><?php echo $sapi['nomor']; ?></span></td>
                                                                <td class="text-end fw-bold">Rp <?= number_format((float)$sapi['harga'], 0, ',', '.'); ?></td>
                                                                <td class="text-center text-muted"><?php echo date('d/m/Y', strtotime($sapi['date_input'])); ?></td>
                                                                <td class="text-center">
                                                                    <div class="btn-group btn-group-sm">
                                                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                                            data-bs-target="#editdata<?php echo $sapi['id']; ?>" title="Edit">
                                                                            <i class="bi bi-pencil"></i>
                                                                        </button>
                                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                                            data-bs-target="#hapusdata<?php echo $sapi['id']; ?>" title="Hapus">
                                                                            <i class="bi bi-trash"></i>
                                                                        </button>
                                                                    </div>

                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="hapusdata<?php echo $sapi['id']; ?>"
                                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body">
                                                                                    <h2 class="h2">Apakah anda yakin ?</h2>
                                                                                    <p>Menghapus data sapi nomor
                                                                                        <?php echo $sapi['nomor']; ?>, dari cabang
                                                                                        <?php echo $sapi['cabang']; ?>
                                                                                    </p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-warning"
                                                                                        data-bs-dismiss="modal">Batal</button>
                                                                                    <a href="<?= base_url('/datasapi/hapus/' . $sapi['id']) ?>"
                                                                                        type="button" class="btn btn-danger">Hapus</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Modal Edit -->
                                                                    <div class="modal fade" id="editdata<?php echo $sapi['id']; ?>" tabindex="-1" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <form action="<?= base_url('/datasapi/update/' . $sapi['id']) ?>" method="post">
                                                                                    <?= csrf_field() ?>
                                                                                    <div class="modal-header bg-warning">
                                                                                        <h5 class="modal-title">Edit Data Sapi</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="mb-3">
                                                                                            <label class="form-label">Cabang</label>
                                                                                            <select class="form-select" name="cabang">
                                                                                                <option value="BUMM Sragen" <?= $sapi['cabang'] == 'BUMM Sragen' ? 'selected' : '' ?>>BUMM</option>
                                                                                                <?php if ($viewcabang): ?>
                                                                                                    <?php foreach ($viewcabang as $cb): ?>
                                                                                                        <option value="<?= $cb['nama_cabang']; ?>" <?= $sapi['cabang'] == $cb['nama_cabang'] ? 'selected' : '' ?>>
                                                                                                            <?= $cb['nama_cabang']; ?>
                                                                                                        </option>
                                                                                                    <?php endforeach; ?>
                                                                                                <?php endif; ?>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label class="form-label">Berat</label>
                                                                                            <input type="text" class="form-control" name="berat" value="<?= $sapi['berat'] ?>">
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label class="form-label">Nomor Sapi</label>
                                                                                            <input type="text" class="form-control" name="nomor" value="<?= $sapi['nomor'] ?>">
                                                                                        </div>
                                                                                        <div class="mb-3">
                                                                                            <label class="form-label">Harga</label>
                                                                                            <input type="text" class="form-control" name="harga" value="<?= $sapi['harga'] ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                                        <button type="submit" class="btn btn-primary">Update Data</button>
                                                                                    </div>
                                                                                </form>
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
    </div>
</main>
<!--end::App Main-->


<?= $this->endSection() ?>