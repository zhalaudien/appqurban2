<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="fw-bold mb-0">Data Pequrban</h4>
                    <small class="text-muted">Daftar pequrban tahun <?= esc($year ?? date('Y')) ?></small>
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
            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-hover table-striped table-bordered align-middle text-center mb-0" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Waktu Update</th>
                                    <th class="text-start">Nama</th>
                                    <th class="text-start">Cabang</th>
                                    <th>Hewan</th>
                                    <th>Sumber</th>
                                    <th class="text-end">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php if (!empty($pequrban)): ?>
                                    <?php foreach ($pequrban as $row): ?>
                                        <tr>
                                            <td><?= esc($no++) ?></td>
                                            <td class="text-muted"><?= date('d/m/Y H:i', strtotime($row['updated_at'])) ?></td>
                                            <td class="text-start fw-bold"><?= esc($row['nama']) ?></td>
                                            <td class="text-start"><?= esc($row['nama_cabang']) ?></td>
                                            <td>
                                                <?php if ($row['jenis_hewan'] == 'sapi'): ?>
                                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3">Sapi</span>
                                                <?php else: ?>
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Kambing</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border rounded-pill small"><?= strtoupper(esc($row['sumber'])) ?></span>
                                            </td>
                                            <td class="text-end fw-semibold">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">Tidak ada data pequrban untuk ditampilkan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->

<?= $this->endSection() ?>