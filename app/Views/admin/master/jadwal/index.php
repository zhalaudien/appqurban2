<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!--begin::App Main-->
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">

                <div>
                    <h4 class="fw-bold mb-0">Jadwal Cabang</h4>
                    <small class="text-muted">Jadwal pengiriman hewan dan besek cabang</small>
                </div>

                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary shadow-sm"
                        data-bs-toggle="modal" data-bs-target="#inputdata">
                        <i class="bi bi-plus-circle"></i> Input Data
                    </button>

                    <a href="/panitia/export" class="btn btn-success shadow-sm">
                        <i class="bi bi-file-earmark-excel"></i> Export Excel
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            <?php if (!empty($grouped_jadwal)): ?>
                <?php foreach ($grouped_jadwal as $hari => $data_jadwal): ?>
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header bg-light py-3 border-bottom">
                            <h5 class="fw-bold mb-0 text-dark">Jadwal Kirim Besek: <span class="text-primary"><?= esc($hari) ?></span></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered align-middle text-center mb-0">
                                    <thead class="table-light text-nowrap">
                                        <tr class="align-middle">
                                            <th width="5%">No</th>
                                            <th class="text-start">Cabang</th>
                                            <th width="10%">Sapi<br>Cabang</th>
                                            <th width="10%">Kambing<br>Cabang</th>
                                            <th width="10%">Sapi<br>Bumm</th>
                                            <th width="10%">Kambing<br>Bumm</th>
                                            <th width="10%">Antrian</th>
                                            <th>Kirim Hewan</th>
                                            <th>Kirim Besek</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($data_jadwal as $j): ?>
                                            <tr>
                                                <td><?= esc($no++) ?></td>
                                                <td class="text-start fw-semibold"><?= esc($j['nama_cabang']) ?></td>
                                                <td class="fw-bold text-success"><?= esc($j['sapi_mandiri']) ?></td>
                                                <td class="fw-bold text-info"><?= esc($j['kambing_mandiri']) ?></td>
                                                <td class="fw-bold text-success"><?= esc($j['sapi_bumm']) ?></td>
                                                <td class="fw-bold text-info"><?= esc($j['kambing_bumm']) ?></td>
                                                <td><span class="badge bg-secondary">#<?= esc($j['antrian']) ?></span></td>
                                                <td><?= esc($j['kirim_hewan']) ?></td>
                                                <td><?= esc($j['kirim_besek']) ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editJadwal<?= $j['id'] ?>">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>

                                                    <!-- Modal Edit Jadwal -->
                                                    <div class="modal fade" id="editJadwal<?= $j['id'] ?>" tabindex="-1" aria-labelledby="editJadwalLabel<?= $j['id'] ?>" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content text-start">
                                                                <form action="<?= site_url('/jadwal/update') ?>" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editJadwalLabel<?= $j['id'] ?>">Edit Jadwal - <?= esc($j['nama_cabang']) ?></h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="id" value="<?= $j['jadwal_id'] ?>">

                                                                        <div class="mb-3">
                                                                            <label class="form-label">No Antrian</label>
                                                                            <input type="number" name="antrian" class="form-control" value="<?= esc($j['antrian']) ?>" required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Jadwal Kirim Hewan</label>
                                                                            <select name="kirim_hewan" class="form-select">
                                                                                <option value="<?= esc($j['kirim_hewan']) ?>" selected><?= esc($j['kirim_hewan']) ?></option>
                                                                                <option value="H-1 <?= $j_h_1 ?? '' ?> Siang">H-1 <?= $j_h_1 ?? '' ?> Siang</option>
                                                                                <option value="H1 <?= $j_h ?? '' ?> Pagi">H1 <?= $j_h ?? '' ?> Pagi</option>
                                                                                <option value="H1 <?= $j_h ?? '' ?> Siang">H1 <?= $j_h ?? '' ?> Siang</option>
                                                                                <option value="H2 <?= $j_h2 ?? '' ?> Pagi">H2 <?= $j_h2 ?? '' ?> Pagi</option>
                                                                                <option value="H2 <?= $j_h2 ?? '' ?> Siang">H2 <?= $j_h2 ?? '' ?> Siang</option>
                                                                                <option value="H3 <?= $j_h3 ?? '' ?> Pagi">H3 <?= $j_h3 ?? '' ?> Pagi</option>
                                                                                <option value="H3 <?= $j_h3 ?? '' ?> Siang">H3 <?= $j_h3 ?? '' ?> Siang</option>
                                                                                <option value="H4 <?= $j_h4 ?? '' ?> Pagi">H4 <?= $j_h4 ?? '' ?> Pagi</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Jadwal Kirim Besek</label>
                                                                            <select name="kirim_besek" class="form-select">
                                                                                <option value="<?= esc($j['kirim_besek']) ?>" selected><?= esc($j['kirim_besek']) ?></option>
                                                                                <option value="H1 <?= $j_h ?? '' ?>">H1 <?= $j_h ?? '' ?></option>
                                                                                <option value="H2 <?= $j_h2 ?? '' ?>">H2 <?= $j_h2 ?? '' ?></option>
                                                                                <option value="H3 <?= $j_h3 ?? '' ?>">H3 <?= $j_h3 ?? '' ?></option>
                                                                                <option value="H4 <?= $j_h4 ?? '' ?>">H4 <?= $j_h4 ?? '' ?></option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Status</label>
                                                                            <select name="status" class="form-select">
                                                                                <option value="Sementara" <?= ($j['status_jadwal'] ?? '') == 'Sementara' ? 'selected' : '' ?>>Sementara</option>
                                                                                <option value="Final" <?= ($j['status_jadwal'] ?? '') == 'Final' ? 'selected' : '' ?>>Final</option>
                                                                            </select>
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
                            </div>
                            </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-light fw-bold">
                                <td colspan="2" class="text-end text-dark">Total Per Hari:</td>
                                <td class="text-success">
                                    <?php
                                    $total_sm = array_sum(array_column($data_jadwal, 'sapi_mandiri_raw'));
                                    $w = intdiv($total_sm, 7);
                                    $r = $total_sm % 7;
                                    echo ($total_sm == 0) ? '0' : (($r === 0) ? $w : (($w > 0) ? "$w $r/7" : "$r/7"));
                                    ?>
                                </td>
                                <td class="text-info"><?= array_sum(array_column($data_jadwal, 'kambing_mandiri')) ?></td>
                                <td class="text-success">
                                    <?php
                                    $total_sb = array_sum(array_column($data_jadwal, 'sapi_bumm_raw'));
                                    $w = intdiv($total_sb, 7);
                                    $r = $total_sb % 7;
                                    echo ($total_sb == 0) ? '0' : (($r === 0) ? $w : (($w > 0) ? "$w $r/7" : "$r/7"));
                                    ?>
                                </td>
                                <td class="text-info"><?= array_sum(array_column($data_jadwal, 'kambing_bumm')) ?></td>
                                <td colspan="4"></td>
                            </tr>
                        </tfoot>
                        </table>
                        </div>
                    </div>
        </div>
    <?php endforeach ?>
<?php else: ?>
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
            <h5 class="text-muted">Tidak ada data jadwal tersedia</h5>
        </div>
    </div>
<?php endif ?>

    </div>
    </div>

    <!-- Modal Input Data -->
    <div class="modal fade" id="inputdata" tabindex="-1" aria-labelledby="inputdataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= site_url('/jadwal/store') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="inputdataLabel">Input Jadwal Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Cabang</label>
                            <select name="cabang_id" class="form-select" required>
                                <option value="" disabled selected>Pilih Cabang</option>
                                <?php foreach ($cabang as $c): ?>
                                    <option value="<?= $c['id'] ?>"><?= esc($c['nama_cabang']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No Antrian</label>
                            <input type="number" name="antrian" class="form-control" placeholder="Masukkan nomor antrian" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jadwal Kirim Hewan</label>
                            <select name="kirim_hewan" class="form-select">
                                <option value="" disabled selected>Pilih Waktu</option>
                                <option value="H-1 <?= $j_h_1 ?? '' ?> Siang">H-1 <?= $j_h_1 ?? '' ?> Siang</option>
                                <option value="H1 <?= $j_h ?? '' ?> Pagi">H1 <?= $j_h ?? '' ?> Pagi</option>
                                <option value="H1 <?= $j_h ?? '' ?> Siang">H1 <?= $j_h ?? '' ?> Siang</option>
                                <option value="H2 <?= $j_h2 ?? '' ?> Pagi">H2 <?= $j_h2 ?? '' ?> Pagi</option>
                                <option value="H2 <?= $j_h2 ?? '' ?> Siang">H2 <?= $j_h2 ?? '' ?> Siang</option>
                                <option value="H3 <?= $j_h3 ?? '' ?> Pagi">H3 <?= $j_h3 ?? '' ?> Pagi</option>
                                <option value="H3 <?= $j_h3 ?? '' ?> Siang">H3 <?= $j_h3 ?? '' ?> Siang</option>
                                <option value="H4 <?= $j_h4 ?? '' ?> Pagi">H4 <?= $j_h4 ?? '' ?> Pagi</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jadwal Kirim Besek</label>
                            <select name="kirim_besek" class="form-select">
                                <option value="" disabled selected>Pilih Waktu</option>
                                <option value="H1 <?= $j_h ?? '' ?>">H1 <?= $j_h ?? '' ?></option>
                                <option value="H2 <?= $j_h2 ?? '' ?>">H2 <?= $j_h2 ?? '' ?></option>
                                <option value="H3 <?= $j_h3 ?? '' ?>">H3 <?= $j_h3 ?? '' ?></option>
                                <option value="H4 <?= $j_h4 ?? '' ?>">H4 <?= $j_h4 ?? '' ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>
<!--end::App Main-->

<?= $this->endSection() ?>