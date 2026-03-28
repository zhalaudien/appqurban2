<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">

            <div class="row g-4">

                <!-- ================= FORM INPUT ================= -->
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0">Input Pembayaran Cabang</h6>
                        </div>

                        <form action="/penerimaan/tambah" method="post" class="needs-validation" novalidate>
                            <?= csrf_field(); ?>

                            <div class="card-body row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">Cabang</label>
                                    <select class="form-select" name="cabang_id" required>
                                        <option value="" disabled selected>Pilih Cabang</option>
                                        <?php foreach ($cabang as $c): ?>
                                            <option value="<?= $c['id'] ?>">
                                                <?= $c['nama_cabang'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Jumlah Pembayaran</label>
                                    <input type="text" name="pembayaran_display" class="form-control"
                                        oninput="formatRupiah(this)" required>
                                    <input type="hidden" name="pembayaran" id="pembayaran_clean">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Metode</label>
                                    <select class="form-select" name="keterangan" required>
                                        <option value="" disabled selected>Pilih Metode</option>
                                        <option value="cash">Cash</option>
                                        <option value="transfer_ubs">Transfer UBS</option>
                                        <option value="transfer_bsi">Transfer BSI</option>
                                        <option value="transfer_bri">Transfer BRI</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Catatan</label>
                                    <input type="text" name="catatan" class="form-control">
                                </div>

                            </div>

                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-info">
                                    Simpan Data
                                </button>
                                <a href="/penerimaan/export" class="btn btn-success">
                                    Export Excel
                                </a>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-gradient-info text-white">
                        <h5 class="mb-0">💰 Input Pembayaran Cabang</h5>
                    </div>

                    <form action="/penerimaan/tambah" method="post">
                        <?= csrf_field(); ?>

                        <div class="card-body">
                            <div class="row g-3">

                                <!-- Cabang -->
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Cabang</label>
                                    <select class="form-select">
                                        <option selected disabled>Pilih Cabang</option>
                                    </select>
                                </div>

                                <!-- Nama -->
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Nama Pengirim</label>
                                    <input type="text" class="form-control" placeholder="Masukkan nama...">
                                </div>

                                <!-- Pembayaran -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Jumlah Pembayaran</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" placeholder="0">
                                    </div>
                                </div>

                                <!-- Metode -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Metode Pembayaran</label>
                                    <select class="form-select">
                                        <option selected disabled>Pilih Metode</option>
                                        <option>Cash</option>
                                        <option>Transfer UBS</option>
                                        <option>Transfer BSI</option>
                                        <option>Transfer BRI</option>
                                    </select>
                                </div>

                                <!-- Catatan -->
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Catatan</label>
                                    <textarea class="form-control" rows="2" placeholder="Opsional..."></textarea>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <button type="submit" class="btn btn-info px-4">
                                💾 Simpan
                            </button>

                            <a href="/penerimaan/export" class="btn btn-success px-4">
                                📊 Export Excel
                            </a>
                        </div>
                    </form>
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
                                            <th>Cabang</th>
                                            <th>Nama</th>
                                            <th>Pembayaran</th>
                                            <th>Metode</th>
                                            <th>Catatan</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($viewbembayaran as $p): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $p['cabang'] ?></td>
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

                                                        <a href="<?= base_url('/penerimaan/print/' . $p['id']) ?>"
                                                            class="btn btn-success btn-sm" target="_blank">
                                                            Print
                                                        </a>

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

                                                                <form action="/penerimaan/edit" method="post">
                                                                    <?= csrf_field(); ?>

                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="id" value="<?= $p['id'] ?>">

                                                                        <div class="mb-2">
                                                                            <label>Nama</label>
                                                                            <input type="text" name="nama"
                                                                                class="form-control"
                                                                                value="<?= $p['nama'] ?>">
                                                                        </div>

                                                                        <div class="mb-2">
                                                                            <label>Pembayaran</label>
                                                                            <input type="text"
                                                                                class="form-control"
                                                                                value="<?= number_format($p['pembayaran'], 0, ',', '.') ?>">
                                                                        </div>

                                                                        <div class="mb-2">
                                                                            <label>Keterangan</label>
                                                                            <input type="text" name="keterangan"
                                                                                class="form-control"
                                                                                value="<?= $p['keterangan'] ?>">
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