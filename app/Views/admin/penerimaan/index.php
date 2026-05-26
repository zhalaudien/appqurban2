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
                                    <a href="/penerimaan/perbandingan" class="btn btn-primary">Cek Perbandingan</a>
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
                                                    <td class="text-center"><?= $sapi_bumm ?? 0 ?></td>
                                                    <td class="text-center"><?= $total_sapi_bumm ?? 0 ?></td>
                                                    <td class="text-center text-danger fw-bold"><?= number_format(($sapi_bumm_raw ?? 0) - ($total_sapi_bumm ?? 0), 1) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Sapi Cabang</td>
                                                    <td class="text-center"><?= $sapi_mandiri ?? 0 ?></td>
                                                    <td class="text-center"><?= $total_sapi_cabang ?? 0 ?></td>
                                                    <td class="text-center text-danger fw-bold"><?= number_format(($sapi_mandiri_raw ?? 0) - ($total_sapi_cabang ?? 0), 1) ?></td>
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
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 text-success fw-bold">
                                            <i class="bi bi-list-ul me-2"></i>Riwayat Penerimaan Hewan
                                        </h6>
                                        <!-- Search Box -->
                                        <div class="col-md-4 col-12 mt-2 mt-md-0">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-white border-success text-success"><i class="bi bi-search"></i></span>
                                                <input type="text" id="searchInput" class="form-control border-success" placeholder="Cari Cabang atau Pengirim...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="table-responsive">
                                            <table id="penerimaanTable" class="table table-hover table-striped mb-0 text-nowrap">
                                                <thead class="table-light shadow-sm">
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
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </tbody>
                                                <tfoot class="table-light fw-bold border-top border-dark" id="tableFooter">
                                                    <tr>
                                                        <td colspan="3" class="text-end">TOTAL (Data Tampil):</td>
                                                        <td class="text-center" id="foot_sum_sapi"><?= $sum_sapi ?></td>
                                                        <td class="text-center" id="foot_sum_kambing"><?= $sum_kambing ?></td>
                                                        <td class="text-end" id="foot_sum_bayar">Rp <?= number_format($sum_bayar, 0, ',', '.') ?></td>
                                                        <td class="text-end text-success" id="foot_sum_shadaqoh">Rp <?= number_format($sum_shadaqoh, 0, ',', '.') ?></td>
                                                        <td colspan="3"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- Pagination Container -->
                                        <div id="paginationContainer" class="mt-3 d-flex justify-content-center"></div>
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

<!-- ===================================================== -->
<!-- MODAL AREA (DI LUAR TABEL)                            -->
<!-- ===================================================== -->
<?php if ($penerimaan): ?>
    <?php foreach ($penerimaan as $terima): ?>
        <!-- Modal Hapus -->
        <div class="modal fade" id="hapusdata<?php echo $terima['id']; ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title"><i class="bi bi-trash me-2"></i>Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center py-4">
                        <i class="bi bi-exclamation-circle text-danger" style="font-size: 3rem;"></i>
                        <h4 class="mt-3">Apakah anda yakin?</h4>
                        <p class="text-muted">Data dari pengirim <strong><?= $terima['pengirim'] ?></strong> akan dihapus permanen.</p>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href="<?= base_url('/penerimaan/hapus/' . $terima['id']) ?>" class="btn btn-danger px-4">Ya, Hapus</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="edit<?php echo $terima['id']; ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Data Penerimaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('penerimaan/update/' . $terima['id']) ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="modal-body p-4">
                            <div class="row g-3">
                                <input type="hidden" name="id" value="<?= $terima['id'] ?>">
                                <input type="hidden" name="cabang_id" value="<?= $terima['cabang_id'] ?>">

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Cabang</label>
                                    <input type="text" class="form-control bg-light" value="<?= $terima['cabang_id'] == 9999 ? 'BUMM' : ($terima['nama_cabang'] ?? 'Tidak Diketahui') ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Pengirim</label>
                                    <input type="text" name="pengirim" class="form-control" required value="<?= $terima['pengirim'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Jumlah Sapi</label>
                                    <input type="number" name="sapi" class="form-control" min="0" value="<?= $terima['sapi'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Jumlah Kambing</label>
                                    <input type="number" name="kambing" class="form-control" min="0" value="<?= $terima['kambing'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-primary">Pembayaran</label>
                                    <input type="text" name="pembayaran_display" id="pembayaran_<?= $terima['id'] ?>" class="form-control" oninput="formatRupiah(this, <?= $terima['id'] ?>)" value="<?= number_format($terima['pembayaran'], 0, ',', '.') ?>">
                                    <input type="hidden" name="pembayaran" id="pembayaran_clean_<?= $terima['id'] ?>" value="<?= $terima['pembayaran'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-success">Shadaqoh</label>
                                    <input type="text" name="shadaqoh_display" id="shadaqoh_<?= $terima['id'] ?>" class="form-control" oninput="formatRupiah(this, <?= $terima['id'] ?>)" value="<?= number_format($terima['shadaqoh'], 0, ',', '.') ?>">
                                    <input type="hidden" name="shadaqoh" id="shadaqoh_clean_<?= $terima['id'] ?>" value="<?= $terima['shadaqoh'] ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Keterangan</label>
                                    <textarea name="ket" class="form-control" rows="2"><?= $terima['ket'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<script>
    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function updateFooterTotals() {
        let rows = document.querySelectorAll('#penerimaanTable tbody tr');
        let totalSapi = 0;
        let totalKambing = 0;
        let totalBayar = 0;
        let totalShadaqoh = 0;

        rows.forEach(row => {
            if (row.style.display !== 'none') {
                // Kolom index: Sapi(3), Kambing(4), Bayar(5), Shadaqoh(6)
                totalSapi += parseInt(row.cells[3].innerText) || 0;
                totalKambing += parseInt(row.cells[4].innerText) || 0;

                // Bersihkan string Rp dan titik sebelum dihitung
                let bayarStr = row.cells[5].innerText.replace(/[^\d]/g, '');
                totalBayar += parseFloat(bayarStr) || 0;

                let shadaqohStr = row.cells[6].innerText.replace(/[^\d]/g, '');
                totalShadaqoh += parseFloat(shadaqohStr) || 0;
            }
        });

        document.getElementById('foot_sum_sapi').innerText = totalSapi;
        document.getElementById('foot_sum_kambing').innerText = totalKambing;
        document.getElementById('foot_sum_bayar').innerText = 'Rp ' + formatNumber(totalBayar);
        document.getElementById('foot_sum_shadaqoh').innerText = 'Rp ' + formatNumber(totalShadaqoh);
    }

    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#penerimaanTable tbody tr');

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });

        updateFooterTotals();
    });
</script>

<?= $this->endSection() ?>