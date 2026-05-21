<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<main class="app-main">

    <!-- Header -->
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">

                <div>
                    <h4 class="fw-bold mb-0">Presensi Panitia</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">
            <!-- Ringkasan Kehadiran Harian -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 bg-primary text-white">
                        <div class="card-body">
                            <h6 class="mb-1">Total Hadir Hari Ini</h6>
                            <h2 class="fw-bold mb-0"><?= $total_today ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card shadow-sm border-0">
                        <div class="card-body py-2">
                            <small class="text-muted d-block mb-1">Kehadiran per Seksi (Hari Ini):</small>
                            <div class="d-flex flex-wrap gap-2">
                                <?php foreach ($summary as $sum) : ?>
                                    <span class="badge bg-light text-dark border p-2">
                                        <?= $sum['seksi'] ?>: <strong class="text-primary"><?= $sum['total'] ?></strong>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Seksi -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <form action="<?= base_url('presensi') ?>" method="get" class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Pilih Seksi Panitia</label>
                            <select name="seksi_id" class="form-select shadow-none" onchange="this.form.submit()">
                                <option value="">-- Pilih Seksi --</option>
                                <?php foreach ($seksi_list as $s) : ?>
                                    <option value="<?= $s['id'] ?>" <?= $seksi_id == $s['id'] ? 'selected' : '' ?>>
                                        <?= $s['nama_seksi'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <a href="<?= base_url('presensi') ?>" class="btn btn-outline-secondary w-100">Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Form Presensi -->
            <?php if (isset($panitia_list)) : ?>
                <form action="<?= base_url('presensi/create') ?>" method="post">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold">Daftar Panitia Seksi: <span class="text-primary"><?= $panitia_list[0]['nama_seksi'] ?? '' ?></span></h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" style="width: 100px">Presensi</th>
                                            <th>Nama Lengkap</th>
                                            <th>Cabang</th>
                                            <th>Jabatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($panitia_list as $p) : ?>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="checkbox" class="btn-check" id="btncheck<?= $p['id'] ?>" name="attendance[<?= $p['id'] ?>][status]" value="hadir" autocomplete="off">
                                                    <label class="btn btn-sm btn-outline-success w-100 py-2 fw-bold" for="btncheck<?= $p['id'] ?>">Hadir</label>

                                                    <input type="hidden" name="attendance[<?= $p['id'] ?>][nama]" value="<?= $p['nama'] ?>">
                                                    <input type="hidden" name="attendance[<?= $p['id'] ?>][cabang]" value="<?= $p['nama_cabang'] ?>">
                                                    <input type="hidden" name="attendance[<?= $p['id'] ?>][seksi]" value="<?= $p['nama_seksi'] ?>">
                                                </td>
                                                <td class="fw-semibold"><?= $p['nama'] ?></td>
                                                <td><?= $p['nama_cabang'] ?></td>
                                                <td><span class="badge bg-info text-dark"><?= ucfirst($p['jabatan']) ?></span></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white py-3">
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                <i class="bi bi-check2-circle"></i> Simpan Presensi
                            </button>
                        </div>
                    </div>
                </form>
            <?php elseif ($seksi_id) : ?>
                <div class="alert alert-info">Tidak ada data panitia pada seksi ini.</div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?= $this->endSection() ?>