<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">

            <div class="row">

                <!-- ================= FORM INPUT ================= -->
                <div class="col-md-12">
                    <div class="col-12">
                        <div class="card shadow border-0 rounded-4 overflow-hidden">

                            <!-- HEADER -->
                            <div class="p-4 text-white" style="background: linear-gradient(135deg, #17a2b8, #138496);">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-file-invoice fa-2x"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1 fw-bold">Input Pembayaran Cabang</h5>
                                        <small>Silakan lengkapi data pembayaran cabang pada form berikut.</small>
                                    </div>
                                </div>
                            </div>

                            <!-- FORM -->
                            <form action="<?= base_url('bumm/pembayaran/store') ?>" method="post" class="needs-validation" novalidate>
                                <?= csrf_field(); ?>

                                <div class="card-body p-4">
                                    <div class="row g-4">

                                        <!-- TANGGAL -->
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Tanggal Pembayaran</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="far fa-calendar"></i>
                                                </span>
                                                <input type="date" name="created_at" class="form-control"
                                                    value="<?= date('Y-m-d') ?>" required>
                                            </div>
                                        </div>

                                        <!-- CABANG -->
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Cabang</label>
                                            <select class="form-select" name="cabang_id" required>
                                                <option value="" disabled selected>Pilih Cabang</option>
                                                <?php foreach ($cabang as $c): ?>
                                                    <option value="<?= $c['id'] ?>">
                                                        <?= $c['nama_cabang'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- METODE -->
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Metode Pembayaran</label>
                                            <select class="form-select" name="keterangan" required>
                                                <option value="" disabled selected>Pilih Metode</option>
                                                <option value="cash">Cash</option>
                                                <option value="transfer_ubs">Transfer UBS</option>
                                                <option value="transfer_bsi">Transfer BSI</option>
                                                <option value="transfer_bri">Transfer BRI</option>
                                            </select>
                                        </div>

                                        <!-- NAMA -->
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Nama</label>
                                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" required>
                                        </div>

                                        <!-- JUMLAH -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Jumlah Pembayaran</label>

                                            <div class="input-group mb-2">
                                                <span class="input-group-text bg-light">Rp</span>
                                                <input type="text" name="pembayaran_display" class="form-control"
                                                    placeholder="0"
                                                    oninput="formatRupiah(this)" required>
                                            </div>

                                            <small class="text-muted">Masukkan nominal pembayaran</small>

                                            <input type="hidden" name="pembayaran" id="pembayaran_clean">
                                        </div>

                                        <!-- CATATAN -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Catatan</label>
                                            <textarea name="catatan" rows="3" class="form-control"
                                                placeholder="Masukkan catatan (opsional)"></textarea>
                                            <small class="text-muted">Opsional</small>
                                        </div>

                                    </div>
                                </div>

                                <!-- FOOTER -->
                                <div class="card-footer bg-white border-0 p-4">
                                    <div class="d-flex justify-content-end gap-2">

                                        <a href="#" class="btn btn-light border rounded-3 px-4">
                                            <i class="fas fa-times me-1"></i> Batal
                                        </a>

                                        <button type="submit" class="btn btn-info rounded-3 px-4">
                                            <i class="fas fa-save me-1"></i> Simpan Data
                                        </button>

                                        <a href="<?= base_url('bumm/pembayaran/export') ?>" class="btn btn-success rounded-3 px-4">
                                            <i class="fas fa-file-excel me-1"></i> Export Excel
                                        </a>

                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <!-- ================= TABLE ================= -->
                    <div class="col-12">
                        <div class="card shadow-sm border-success">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0">Data Pembayaran</h6>
                            </div>

                            <div class="card-body p-2">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Cabang</th>
                                                <th>Nama</th>
                                                <th>Pembayaran</th>
                                                <th>Metode</th>
                                                <th>Catatan</th>
                                                <th>Tanggal</th>
                                                <th width="15%">Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $no = 1;
                                            if (!empty($viewbembayaran)): ?>
                                                <?php foreach ($viewbembayaran as $p): ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $p['cabang_nama'] ?></td>
                                                        <td><?= $p['nama'] ?></td>
                                                        <td>Rp <?= number_format($p['pembayaran'], 0, ',', '.') ?></td>
                                                        <td><?= $p['keterangan'] ?></td>
                                                        <td><?= $p['catatan'] ?></td>
                                                        <td><?= $p['created_at'] ?></td>

                                                        <td>
                                                            <div class="btn-group">
                                                                <button class="btn btn-warning btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#edit<?= $p['id'] ?>">
                                                                    Edit
                                                                </button>

                                                                <!-- <a href="<?= base_url('/penerimaan/print/' . $p['id']) ?>"
                                                            class="btn btn-success btn-sm" target="_blank">
                                                            Print
                                                        </a> -->

                                                                <button class="btn btn-danger btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#hapus<?= $p['id'] ?>">
                                                                    Hapus
                                                                </button>
                                                            </div>

                                                            <!-- ================= MODAL HAPUS ================= -->
                                                            <div class="modal fade" id="hapus<?= $p['id'] ?>">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body text-center">
                                                                            <h5>Yakin hapus data?</h5>
                                                                            <p><?= $p['nama'] ?> - <?= $p['cabang'] ?></p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                            <a href="<?= base_url('/penerimaan/hapus/' . $p['id']) ?>"
                                                                                class="btn btn-danger">
                                                                                Hapus
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- ================= MODAL EDIT ================= -->
                                                            <div class="modal fade" id="edit<?= $p['id'] ?>">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form action="<?= base_url('bumm/pembayaran/update/' . $p['id']) ?>" method="post">
                                                                            <?= csrf_field(); ?>

                                                                            <div class="modal-body">
                                                                                <input type="hidden" name="id" value="<?= $p['id'] ?>">

                                                                                <div class="mb-2">
                                                                                    <label class="form-label">Tanggal pembayaran</label>
                                                                                    <input type="date" name="created_at" class="form-control" value="<?= date('Y-m-d', strtotime($p['created_at'])) ?>" required>
                                                                                </div>

                                                                                <div class="mb-2">
                                                                                    <label class="form-label">Cabang</label>
                                                                                    <select class="form-select" name="cabang_id" required>
                                                                                        <option value="" disabled>Pilih Cabang</option>
                                                                                        <?php foreach ($cabang as $c): ?>
                                                                                            <option value="<?= $c['id'] ?>" <?= $c['id'] == $p['cabang_id'] ? 'selected' : '' ?>>
                                                                                                <?= $c['nama_cabang'] ?>
                                                                                            </option>
                                                                                        <?php endforeach; ?>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="mb-2">
                                                                                    <label>Nama</label>
                                                                                    <input type="text" name="nama"
                                                                                        class="form-control"
                                                                                        value="<?= $p['nama'] ?>">
                                                                                </div>

                                                                                <div class="mb-2">
                                                                                    <label>Pembayaran</label>
                                                                                    <input type="text" name="pembayaran_display"
                                                                                        class="form-control"
                                                                                        value="<?= number_format($p['pembayaran'], 0, ',', '.') ?>">
                                                                                    <input type="hidden" name="pembayaran" id="pembayaran_clean_edit_<?= $p['id'] ?>" value="<?= $p['pembayaran'] ?>">
                                                                                </div>

                                                                                <div class="mb-2">
                                                                                    <label>Keterangan</label>
                                                                                    <select class="form-select" name="keterangan" required>
                                                                                        <option value="cash" <?= $p['keterangan'] == 'cash' ? 'selected' : '' ?>>Cash</option>
                                                                                        <option value="transfer_ubs" <?= $p['keterangan'] == 'transfer_ubs' ? 'selected' : '' ?>>Transfer UBS</option>
                                                                                        <option value="transfer_bsi" <?= $p['keterangan'] == 'transfer_bsi' ? 'selected' : '' ?>>Transfer BSI</option>
                                                                                        <option value="transfer_bri" <?= $p['keterangan'] == 'transfer_bri' ? 'selected' : '' ?>>Transfer BRI</option>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="mb-2">
                                                                                    <label>Catatan</label>
                                                                                    <input type="text" name="catatan"
                                                                                        class="form-control"
                                                                                        value="<?= $p['catatan'] ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="modal-footer">
                                                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                                            </div>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="8" class="text-center text-muted py-4">Tidak ada data pembayaran.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</main>

<?= $this->endSection() ?>