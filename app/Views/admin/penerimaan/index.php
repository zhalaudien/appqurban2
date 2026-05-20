<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!-- Flash Messages (Notifikasi) -->
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i><?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-exclamation-octagon me-2"></i><strong>Gagal menyimpan:</strong>
                        <ul class="mb-0 mt-2">
                            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Filter Tahun -->
                <div class="row mb-3">
                    <div class="col-md-3 ms-auto">
                        <form action="" method="get" id="formFilterTahun">
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
                        </form>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Form Input Hewan -->
                    <div class="col-12 col-lg-6">
                        <div class="card shadow-sm">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0">Input Hewan Masuk</h6>
                            </div>
                            <form action="/penerimaan/create" method="post">
                                <?= csrf_field(); ?>
                                <div class="card-body row g-3">
                                    <div class="col-md-6">
                                        <label for="cabang" class="form-label">Cabang</label>
                                        <select class="form-select" name="cabang_id" required>
                                            <option value="" disabled selected>Pilih Cabang</option>
                                            <option value="9999">BUMM</option>
                                            <?php foreach ($cabang as $c): ?>
                                                <option value="<?= $c['id'] ?>"><?= $c['nama_cabang'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pengirim" class="form-label">Pengirim</label>
                                        <input type="text" name="pengirim" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="sapi" class="form-label">Jumlah Sapi</label>
                                        <input type="number" name="sapi" class="form-control" min="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kambing" class="form-label">Jumlah Kambing</label>
                                        <input type="number" name="kambing" class="form-control" min="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pembayaran" class="form-label">Pembayaran</label>
                                        <input type="text" name="pembayaran_display" class="form-control" id="pembayaran" oninput="formatRupiah(this)">
                                        <input type="hidden" name="pembayaran" id="pembayaran_clean">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="shadaqoh" class="form-label">Shadaqoh</label>
                                        <input type="text" name="shadaqoh_display" class="form-control" id="shadaqoh" oninput="formatRupiah(this)">
                                        <input type="hidden" name="shadaqoh" id="shadaqoh_clean">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="ket" class="form-label">Keterangan</label>
                                        <input type="text" name="ket" class="form-control" id="ket">
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-info">Simpan Data</button>
                                    <a href="/penerimaan/export" class="btn btn-success">Export Data ke Excel</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Ringkasan Data Hewan & Uang -->
                    <div class="col-12 col-lg-6">
                        <div class="row g-4">
                            <!-- Data Hewan -->
                            <div class="col-12">
                                <div class="card border-primary shadow-sm">
                                    <div class="card-header bg-primary text-white">
                                        <h6 class="mb-0">Ringkasan Pengiriman Hewan</h6>
                                    </div>
                                    <div class="card-body p-2">
                                        <table class="table table-bordered table-sm mb-0">
                                            <thead class="table-light">
                                                <tr class="text-center">
                                                    <th>Jenis</th>
                                                    <th>Total Hewan</th>
                                                    <th>Hewan Masuk</th>
                                                    <th>Kekurangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Sapi BUMM</td>
                                                    <td class="text-center"><?= number_format(($sapi_bumm ?? 0) + (($sapib_bumm ?? 0) / 7), 1) ?></td>
                                                    <td class="text-center"><?= $total_sapi_bumm ?? 0 ?></td>
                                                    <td class="text-center text-danger fw-bold"><?= number_format((($sapi_bumm ?? 0) + (($sapib_bumm ?? 0) / 7)) - ($total_sapi_bumm ?? 0), 1) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Sapi Cabang</td>
                                                    <td class="text-center"><?= $sapi_mandiri ?? 0 ?></td>
                                                    <td class="text-center"><?= $total_sapi_cabang ?? 0 ?></td>
                                                    <td class="text-center text-danger fw-bold"><?= ($sapi_mandiri ?? 0) - ($total_sapi_cabang ?? 0) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Kambing BUMM</td>
                                                    <td class="text-center"><?= $kambing_bumm ?? 0 ?></td>
                                                    <td class="text-center"><?= $total_kambing_bumm ?? 0 ?></td>
                                                    <td class="text-center text-danger fw-bold"><?= ($kambing_bumm ?? 0) - ($total_kambing_bumm ?? 0) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Kambing Cabang</td>
                                                    <td class="text-center"><?= $kambing_mandiri ?? 0 ?></td>
                                                    <td class="text-center"><?= $total_kambing_cabang ?? 0 ?></td>
                                                    <td class="text-center text-danger fw-bold"><?= ($kambing_mandiri ?? 0) - ($total_kambing_cabang ?? 0) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Uang Masuk -->
                            <div class="col-12">
                                <div class="card border-warning shadow-sm">
                                    <div class="card-header bg-warning text-dark">
                                        <h6 class="mb-0">Status Pembayaran | Biaya Penyembelihan : Rp. <?= number_format($biaya ?? 0, 0, ',', '.') ?></h6>
                                    </div>
                                    <div class="card-body p-2">
                                        <table class="table table-bordered table-sm mb-0">
                                            <thead class="table-light">
                                                <tr class="text-center">
                                                    <th>Asal</th>
                                                    <th>Masuk</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Total Uang (BUMM + Cabang) Hari Ini</td>
                                                    <td class="text-end fw-bold text-success">Rp. <?= number_format($uang_hari_ini ?? 0, 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Shadaqoh Hari Ini</td>
                                                    <td class="text-end fw-bold text-success">Rp. <?= number_format($shadaqoh_hari_ini ?? 0, 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Uang (BUMM + Cabang)</td>
                                                    <td class="text-end fw-bold text-success">Rp. <?= number_format(($uang_bumm ?? 0) + ($uang_cabang ?? 0), 0, ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Shadaqoh</td>
                                                    <td class="text-end fw-bold text-success">Rp. <?= number_format($total_shadaqah ?? 0, 0, ',', '.') ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-12">
                        <div class="row g-4">
                            <!-- Data Hewan -->
                            <div class="col-12">
                                <div class="card border-top border-4 border-success shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0 text-success fw-bold"><i class="bi bi-list-ul me-2"></i>Riwayat Penerimaan Hewan</h6>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="table-responsive">
                                            <table id="datatablesSimple" class="table table-hover table-striped mb-0 text-nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="text-center" style="width: 50px">No</th>
                                                        <th>Cabang</th>
                                                        <th>Pengirim</th>
                                                        <th class="text-center">Sapi</th>
                                                        <th class="text-center">Kambing</th>
                                                        <th class="text-end">Pembayaran</th>
                                                        <th class="text-end">Shadaqoh</th>
                                                        <th>Keterangan</th>
                                                        <th>Tanggal Input</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $sum_sapi = 0;
                                                    $sum_kambing = 0;
                                                    $sum_bayar = 0;
                                                    $sum_shadaqoh = 0;
                                                    ?>
                                                    <?php if ($penerimaan): ?>
                                                        <?php foreach ($penerimaan as $terima): ?>
                                                            <?php
                                                            $sum_sapi += (int)$terima['sapi'];
                                                            $sum_kambing += (int)$terima['kambing'];
                                                            $sum_bayar += (float)$terima['pembayaran'];
                                                            $sum_shadaqoh += (float)$terima['shadaqoh'];
                                                            ?>
                                                            <tr class="align-middle">
                                                                <td class="text-center"><?= $no++; ?></td>
                                                                <td><?php echo $terima['nama_cabang']; ?></td>
                                                                <td><?php echo $terima['pengirim']; ?></td>
                                                                <td class="text-center"><?php echo $terima['sapi']; ?></td>
                                                                <td class="text-center"><?php echo $terima['kambing']; ?></td>
                                                                <td class="text-end fw-bold">Rp <?= number_format($terima['pembayaran'], 0, ',', '.'); ?></td>
                                                                <td class="text-end fw-bold text-success">Rp <?= number_format($terima['shadaqoh'], 0, ',', '.'); ?></td>
                                                                <td class="text-wrap" style="max-width: 200px;"><?php echo $terima['ket']; ?></td>
                                                                <td><?php echo $terima['created_at']; ?></td>
                                                                <td>
                                                                    <div class="btn-group mb-2" role="group"
                                                                        aria-label="Basic mixed styles example">
                                                                        <a type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                                            data-bs-target="#edit<?php echo $terima['id']; ?>">
                                                                            Edit
                                                                        </a>
                                                                        <a type="button" class="btn btn-success"
                                                                            href="<?= base_url('/penerimaan/print/' . $terima['id']) ?>"
                                                                            target="_blank">
                                                                            Print
                                                                        </a>
                                                                        <a type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                                            data-bs-target="#hapusdata<?php echo $terima['id']; ?>">
                                                                            Hapus
                                                                        </a>
                                                                    </div>
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="hapusdata<?php echo $terima['id']; ?>"
                                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body">
                                                                                    <h2 class="h2">Apakah anda yakin ?</h2>
                                                                                    <p>Menghapus data
                                                                                        <?= $terima['cabang_id'] == 9999 ? 'BUMM' : ($terima['nama_cabang'] ?? 'Tidak Diketahui') ?>, pengirim
                                                                                        <?php echo $terima['pengirim']; ?>
                                                                                    </p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-warning"
                                                                                        data-bs-dismiss="modal">Batal</button>
                                                                                    <a href="<?= base_url('/penerimaan/hapus/' . $terima['id']) ?>"
                                                                                        type="button" class="btn btn-danger">Hapus</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal fade" id="edit<?php echo $terima['id']; ?>"
                                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body">
                                                                                    <form action="<?= base_url('penerimaan/update/' . $terima['id']) ?>" method="post" class="needs-validation" novalidate>
                                                                                        <?= csrf_field(); ?>
                                                                                        <div class="card-body row g-3">
                                                                                            <input type="hidden" name="id" value="<?= $terima['id'] ?>">
                                                                                            <input type="hidden" name="cabang_id" value="<?= $terima['cabang_id'] ?>">

                                                                                            <div class="col-md-6">
                                                                                                <label class="form-label">Cabang</label>
                                                                                                <input type="text" class="form-control" value="<?= $terima['cabang_id'] == 9999 ? 'BUMM' : ($terima['nama_cabang'] ?? 'Tidak Diketahui') ?>" readonly>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label class="form-label">Pengirim</label>
                                                                                                <input type="text" name="pengirim" class="form-control" required value="<?= $terima['pengirim'] ?>">
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label class="form-label">Jumlah Sapi</label>
                                                                                                <input type="number" name="sapi" class="form-control" min="0" required value="<?= $terima['sapi'] ?>">
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label class="form-label">Jumlah Kambing</label>
                                                                                                <input type="number" name="kambing" class="form-control" min="0" required value="<?= $terima['kambing'] ?>">
                                                                                            </div>

                                                                                            <div class="col-md-6">
                                                                                                <label class="form-label">Pembayaran</label>
                                                                                                <input type="text" name="pembayaran_display" id="pembayaran_<?= $terima['id'] ?>" class="form-control" oninput="formatRupiah(this, <?= $terima['id'] ?>)" value="<?= number_format($terima['pembayaran'], 0, ',', '.') ?>">
                                                                                                <input type="hidden" name="pembayaran" id="pembayaran_clean_<?= $terima['id'] ?>">
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label class="form-label">Shadaqoh</label>
                                                                                                <input type="text" name="shadaqoh_display" id="shadaqoh_<?= $terima['id'] ?>" class="form-control" oninput="formatRupiah(this, <?= $terima['id'] ?>)" value="<?= number_format($terima['shadaqoh'], 0, ',', '.') ?>">
                                                                                                <input type="hidden" name="shadaqoh" id="shadaqoh_clean_<?= $terima['id'] ?>">
                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <label class="form-label">Keterangan</label>
                                                                                                <input type="text" name="ket" class="form-control" value="<?= $terima['ket'] ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                                                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </tbody>
                                                <tfoot class="table-light fw-bold border-top border-dark">
                                                    <tr>
                                                        <td colspan="3" class="text-end">TOTAL KESELURUHAN (Halaman Ini):</td>
                                                        <td class="text-center"><?= $sum_sapi ?></td>
                                                        <td class="text-center"><?= $sum_kambing ?></td>
                                                        <td class="text-end">Rp <?= number_format($sum_bayar, 0, ',', '.') ?></td>
                                                        <td class="text-end text-success">Rp <?= number_format($sum_shadaqoh, 0, ',', '.') ?></td>
                                                        <td colspan="3"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Export Button -->
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