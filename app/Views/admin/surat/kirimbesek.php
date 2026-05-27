<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!--begin::Container-->
<div class="container-fluid py-3">
    <div class="row g-4">
        <!-- Form Input Permintaan -->
        <div class="col-12 col-lg-12">
            <div class="card shadow-sm border-0">
                <!--begin::Header-->
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="bi bi-file-earmark-plus me-2"></i>Input Permintaan Besek (Amprah)</h6>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                <form class="needs-validation" action="/kirimbesek/tambah" method="post" novalidate>
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Row-->
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label for="cabang" class="form-label">Cabang</label>
                                <input type="text" class="form-control" name="cabang">
                            </div>
                            <div class="col-md-2">
                                <label for="ts" class="form-label">Besek TS</label>
                                <input type="text" class="form-control" name="ts">
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-2">
                                <label for="tk" class="form-label">Besek TK</label>
                                <input type="text" class="form-control" name="tk">
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-2">
                                <label for="a" class="form-label">Besek M</label>
                                <input type="text" class="form-control" name="a">
                            </div>
                            <div class="col-md-2">
                                <label for="os" class="form-label">Besek OS</label>
                                <input type="text" class="form-control" name="os">
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-2">
                                <label for="ok" class="form-label">Besek OK</label>
                                <input type="text" class="form-control" name="ok">
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-2">
                                <label for="ks" class="form-label">Kepala Sapi</label>
                                <input type="text" class="form-control" name="ks">
                            </div>
                            <div class="col-md-2">
                                <label for="kb" class="form-label">Kepala Kambing</label>
                                <input type="text" class="form-control" name="kb">
                            </div>
                            <div class="col-md-2">
                                <label for="kks" class="form-label">Kaki Sapi</label>
                                <input type="text" class="form-control" name="kks">
                            </div>
                            <div class="col-md-2">
                                <label for="kls" class="form-label">kulit Sapi</label>
                                <input type="text" class="form-control" name="kls">
                            </div>
                            <div class="col-md-2">
                                <label for="status" class="form-label">Status Pengiriman</label>
                                <select class="form-select" name="status">
                                    <option value="Proses">Proses</option>
                                    <option value="Dikirim">Dikirim</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Tertunda">Tertunda</option>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                        <button class="btn btn-info" type="submit">Save Data</button>
                    </div>
                    <!--end::Footer-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Small Box Widget 1-->
        </div>

        <!-- Data Realisasi Pengiriman -->
        <div class="col-12 col-lg-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0"><i class="bi bi-truck me-2"></i>Data Realisasi Pengiriman Besek & K3</h6>
                </div>
                <div class="card-body p-3">
                    <div class="tableresponsive">
                        <table class="table table-hover align-middle mb-0" id="datatablesSimple">
                            <thead class="table-light border-bottom">
                                <tr class="small text-uppercase fw-bold">
                                    <th style="width: 50px">No</th>
                                    <th style="width: 200px">Cabang</th>
                                    <th>TS</th>
                                    <th>TK</th>
                                    <th>A</th>
                                    <th>M</th>
                                    <th>OS</th>
                                    <th>OK</th>
                                    <th>K Sapi</th>
                                    <th>K Kambing</th>
                                    <th>KK Sapi</th>
                                    <th>KL Sapi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php if (!empty($realisasi)): ?>
                                    <?php foreach ($realisasi as $r): ?>
                                        <tr class="align-middle">
                                            <td class="text-muted"><?= $no++; ?></td>
                                            <td class="text-start fw-bold text-dark"><?= esc($r['cabang'] ?? 'BUMM/Pusat') ?></td>
                                            <td><?= esc($r['R_TS']) ?></td>
                                            <td><?= esc($r['R_TK']) ?></td>
                                            <td><?= esc($r['R_A']) ?></td>
                                            <td><?= esc($r['R_M']) ?></td>
                                            <td><?= esc($r['R_OS']) ?></td>
                                            <td><?= esc($r['R_OK']) ?></td>
                                            <td><?= esc($r['R_K_S']) ?></td>
                                            <td><?= esc($r['R_K_KB']) ?></td>
                                            <td><?= esc($r['R_KK_S']) ?></td>
                                            <td><?= esc($r['R_KLS']) ?></td>
                                            <td>
                                                <span class="badge <?= (($r['status_jadwal'] ?? '') == 'Selesai') ? 'bg-success' : 'bg-warning' ?>">
                                                    <?= esc($r['status_jadwal'] ?? 'Belum Ada') ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm shadow-sm">
                                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $r['id'] ?>">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    <a href="<?= base_url('/kirimbesek/print/' . $r['id']) ?>" class="btn btn-outline-success" target="_blank">
                                                        <i class="bi bi-printer"></i>
                                                    </a>
                                                    <a href="<?= base_url('/kirimbesek/pdf/' . $r['id']) ?>" class="btn btn-outline-danger" title="Export PDF">
                                                        <i class="bi bi-file-pdf"></i>
                                                    </a>
                                                </div>
                                                <!-- Modal Edit Realisasi -->
                                                <div class="modal fade" id="edit<?= $r['id'] ?>" tabindex="-1" aria-labelledby="editLabel<?= $r['id'] ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-warning text-dark">
                                                                <h5 class="modal-title" id="editLabel<?= $r['id'] ?>"><i class="bi bi-pencil-square me-2"></i>Edit Realisasi: <?= esc($r['cabang'] ?? 'BUMM/Pusat') ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="<?= base_url('/kirimbesek/edit') ?>" method="post">
                                                                <?= csrf_field() ?>
                                                                <div class="modal-body text-start">
                                                                    <input type="hidden" name="id" value="<?= $r['id'] ?>">
                                                                    <input type="hidden" name="date_input" value="<?= date('Y-m-d H:i:s') ?>">
                                                                    <div class="row g-3">
                                                                        <div class="col-md-4">
                                                                            <label class="form-label fw-bold text-muted small">Besek TS</label>
                                                                            <input type="text" class="form-control" name="r_ts" value="<?= esc($r['R_TS']) ?>">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="form-label fw-bold text-muted small">Besek TK</label>
                                                                            <input type="text" class="form-control" name="r_tk" value="<?= esc($r['R_TK']) ?>">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="form-label fw-bold text-muted small">Besek M</label>
                                                                            <input type="text" class="form-control" name="r_a" value="<?= esc($r['R_A']) ?>">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="form-label fw-bold text-muted small">Besek OS</label>
                                                                            <input type="text" class="form-control" name="r_os" value="<?= esc($r['R_OS']) ?>">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="form-label fw-bold text-muted small">Besek OK</label>
                                                                            <input type="text" class="form-control" name="r_ok" value="<?= esc($r['R_OK']) ?>">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="form-label fw-bold text-muted small">Kepala Sapi</label>
                                                                            <input type="text" class="form-control" name="r_ks" value="<?= esc($r['R_K_S']) ?>">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="form-label fw-bold text-muted small">Kepala Kambing</label>
                                                                            <input type="text" class="form-control" name="r_kb" value="<?= esc($r['R_K_KB']) ?>">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="form-label fw-bold text-muted small">Kaki Sapi</label>
                                                                            <input type="text" class="form-control" name="r_kks" value="<?= esc($r['R_KK_S']) ?>">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="form-label fw-bold text-muted small">Kulit Sapi</label>
                                                                            <input type="text" class="form-control" name="r_kls" value="<?= esc($r['R_KLS']) ?>">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-bold">Status Pengiriman</label>
                                                                            <select name="status" class="form-select">
                                                                                <option value="Proses" <?= (($r['status_jadwal'] ?? '') == 'Proses') ? 'selected' : '' ?>>Proses</option>
                                                                                <option value="Dikirim" <?= (($r['status_jadwal'] ?? '') == 'Dikirim') ? 'selected' : '' ?>>Dikirim</option>
                                                                                <option value="Selesai" <?= (($r['status_jadwal'] ?? '') == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
                                                                                <option value="Tertunda" <?= (($r['status_jadwal'] ?? '') == 'Tertunda') ? 'selected' : '' ?>>Tertunda</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer bg-light">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                        </tr>

                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="13" class="py-3">Tidak ada data riwayat permintaan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </main>
    <!--end::App Main-->

    <?= $this->endSection() ?>