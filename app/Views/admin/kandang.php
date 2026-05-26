<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row g-4">
        <!-- Flash Messages -->
        <div class="col-12">
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
        </div>

        <!-- Filter Tahun -->
        <div class="col-12">
            <form action="" method="get" id="formFilterTahun" class="row mb-2">
                <div class="col-md-3 ms-auto">
                    <div class="input-group shadow-sm border-info">
                        <span class="input-group-text bg-info text-white border-info">
                            <i class="bi bi-calendar-event me-2"></i> Tahun
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

        <!-- Form Input Hewan -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm">
                <!--begin::Header-->
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">Input Hewan Disembelih</h6>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                <form class="needs-validation" action="/kandang/create" method="post" novalidate>
                    <?= csrf_field() ?>
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Row-->
                        <div class="row g-3">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <label for="sapi" class="form-label">Sapi</label>
                                <input type="number" class="form-control" name="sapi" min="0" required>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <label for="kambing" class="form-label">Kambing</label>
                                <input type="number" class="form-control" name="kambing" min="0" required>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                        <button class="btn btn-info" type="submit">Save Data</button>
                        <a href="/kandang/export" type="button" class="btn btn-success">Exsport
                            Exel</a>
                    </div>
                    <!--end::Footer-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Small Box Widget 1-->
        </div>
        <!--end::Col-->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm">
                <!--begin::Header-->
                <div class="card-header bg-warning text-white">
                    <h6 class="mb-0">Data Hewan Kandang</h6>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-sm table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Hewan</th>
                                <th class="text-center">Masuk</th>
                                <th class="text-center">Disembelih</th>
                                <th class="text-center">Sisa Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="align-middle">
                                <td class="fw-bold">Sapi</td>
                                <td class="text-center text-primary fw-bold"><?= $total_sapi ?></td>
                                <td class="text-center text-danger fw-bold"><?= $disembelih_sapi ?></td>
                                <td class="text-center bg-light fw-bold"><?= $total_sapi - $disembelih_sapi ?></td>
                            </tr>
                            <tr class="align-middle">
                                <td class="fw-bold">Kambing</td>
                                <td class="text-center text-primary fw-bold"><?= $total_kambing ?></td>
                                <td class="text-center text-danger fw-bold"><?= $disembelih_kambing ?></td>
                                <td class="text-center bg-light fw-bold"><?= $total_kambing - $disembelih_kambing ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!--end::Small Box Widget 1-->
        </div>
        <!-- Card: Hewan Disembelih Hari Ini -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-primary">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Hewan Disembelih Hari Ini</h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Jenis Hewan</th>
                                <th>Jumlah Disembelih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sapi</td>
                                <td><?= $disembelih_sapi_today ?? 0 ?></td>
                            </tr>
                            <tr>
                                <td>Kambing</td>
                                <td><?= $disembelih_kambing_today ?? 0 ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end::Col-->
        <div class="col-12 col-lg-12">
            <div class="row g-4">
                <!-- Data Hewan -->
                <div class="col-12">
                    <div class="card border-success shadow-sm rounded-3">
                        <div class="card-header bg-success text-white">
                            <h6 class="mb-0"><i class="bi bi-clock-history me-2"></i>Riwayat Penyembelihan Hewan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table table-hover table-striped align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" style="width: 5%">No</th>
                                            <th class="text-center">Sapi (Ekor)</th>
                                            <th class="text-center">Kambing (Ekor)</th>
                                            <th class="text-center">Tanggal Input</th>
                                            <th class="text-center" style="width: 15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php if ($viewkandang): ?>
                                            <?php foreach ($viewkandang as $kandang): ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++; ?></td>
                                                    <td class="text-center fw-bold text-dark"><?php echo $kandang['sapi']; ?></td>
                                                    <td class="text-center fw-bold text-dark"><?php echo $kandang['kambing']; ?></td>
                                                    <td class="text-center text-muted"><?php echo date('d/m/Y H:i', strtotime($kandang['date_input'])); ?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm">
                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                                data-bs-target="#editdata<?php echo $kandang['id']; ?>">
                                                                <i class="bi bi-pencil"></i> Edit
                                                            </button>
                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                                data-bs-target="#hapusdata<?php echo $kandang['id']; ?>">
                                                                <i class="bi bi-trash"></i> Hapus
                                                            </button>
                                                        </div>

                                                        <!-- Modal Edit -->
                                                        <div class="modal fade" id="editdata<?php echo $kandang['id']; ?>" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content text-start">
                                                                    <form action="<?= base_url('/kandang/update/' . $kandang['id']) ?>" method="post">
                                                                        <?= csrf_field() ?>
                                                                        <div class="modal-header bg-warning">
                                                                            <h5 class="modal-title">Edit Data Kandang</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Jumlah Sapi</label>
                                                                                <input type="number" name="sapi" class="form-control" value="<?= $kandang['sapi'] ?>" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Jumlah Kambing</label>
                                                                                <input type="number" name="kambing" class="form-control" value="<?= $kandang['kambing'] ?>" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal -->
                                                        <div class="modal fade"
                                                            id="hapusdata<?php echo $kandang['id']; ?>" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <h2 class="h2">Apakah anda yakin ?</h2>
                                                                        <p>Menghapus data kandang
                                                                            <?php echo $kandang['date_input']; ?>
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-warning"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                                        <a href="<?= base_url('/kandang/delete/' . $kandang['id']) ?>"
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
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::App Content-->
                </main>
                <!--end::App Main-->

                <?= $this->endSection() ?>