<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="app-content-header py-3">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">

        <div>
            <h4 class="fw-bold mb-0">Rekap Hewan Qurban per Cabang</h4>
            <small class="text-muted">Tahun <?= esc($year) ?></small>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="<?= base_url('bumm/pequrban/export?year=' . $year) ?>" class="btn btn-sm btn-success shadow-sm">
                <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
            </a>
            <form method="get" class="d-flex align-items-center gap-2 mb-0">
                <label class="small text-muted mb-0">Pilih Tahun</label>
                <select name="year"
                    onchange="this.form.submit()"
                    class="form-select form-select-sm shadow-sm"
                    style="width:120px">
                    <?php for ($y = date('Y'); $y >= 2020; $y--): ?>
                        <option value="<?= $y ?>" <?= $y == $year ? 'selected' : '' ?>>
                            <?= $y ?>
                        </option>
                    <?php endfor ?>
                </select>
            </form>
        </div>

    </div>
</div>

<?php
// Filter harga berdasarkan jenis hewan untuk header dan kolom dinamis
$kambingBumm = array_filter($prices, fn($p) => $p['jenis_hewan'] === 'kambing');
$sapiBumm    = array_filter($prices, fn($p) => $p['jenis_hewan'] === 'sapi');
?>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center mb-0">
                <thead class="">
                    <tr class="align-middle">
                        <th rowspan="2" width="5%">NO</th>
                        <th rowspan="2" class="text-start">CABANG</th>
                        <th rowspan="2">SAPI MANDIRI</th>
                        <th rowspan="2">KAMBING MANDIRI</th>
                        <th colspan="<?= count($kambingBumm) ?: 1 ?>">KAMBING BUMM</th>
                        <th colspan="<?= count($sapiBumm) ?: 1 ?>">SAPI BUMM</th>
                        <th rowspan="2">Total Uang</th>
                        <th rowspan="2">Pembayaran</th>
                        <th rowspan="2">Kekurangan</th>
                    </tr>
                    <tr class="align-middle">
                        <?php foreach ($kambingBumm as $p): ?>
                            <th><?= number_format($p['harga'], 0, ',', '.') ?></th>
                        <?php endforeach;
                        if (empty($kambingBumm)): ?> <th>-</th> <?php endif; ?>

                        <?php foreach ($sapiBumm as $p): ?>
                            <th><?= number_format($p['harga'], 0, ',', '.') ?></th>
                        <?php endforeach;
                        if (empty($sapiBumm)): ?> <th>-</th> <?php endif; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1; ?>
                    <?php if (!empty($rekap)): ?>
                        <?php foreach ($rekap as $c): ?>
                            <tr>
                                <td><?= esc($no++) ?></td>
                                <td class="text-start fw-semibold"><?= esc($c['nama_cabang']) ?></td>
                                <td><?= esc($c['sapi_mandiri']) ?></td>
                                <td><?= esc($c['kambing_mandiri']) ?></td>

                                <?php foreach ($kambingBumm as $p): ?>
                                    <td><?= esc($c['bumm_kambing_' . $p['harga']] ?? 0) ?></td>
                                <?php endforeach;
                                if (empty($kambingBumm)): ?> <td>0</td> <?php endif; ?>

                                <?php foreach ($sapiBumm as $p): ?>
                                    <td><?= esc($c['bumm_sapi_' . $p['harga']] ?? 0) ?></td>
                                <?php endforeach;
                                if (empty($sapiBumm)): ?> <td>0</td> <?php endif; ?>

                                <td class="text-end fw-bold">Rp <?= number_format($c['total_uang'], 0, ',', '.') ?></td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <?php $totalCol = 7 + (count($kambingBumm) ?: 1) + (count($sapiBumm) ?: 1); ?>
                            <td colspan="<?= $totalCol ?>" class="text-center text-muted py-4">
                                Tidak ada data rekap tahun <?= esc($year) ?>
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?= $this->endSection() ?>