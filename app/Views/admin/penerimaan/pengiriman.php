<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="app-content-header py-3">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">

        <div>
            <h4 class="fw-bold mb-0">Rekap Pengiriman Hewan Qurban per Cabang</h4>
            <small class="text-muted">Tahun <?= esc($year) ?></small>
        </div>

        <form method="get" class="d-flex align-items-center gap-2">
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


<?php
// Filter harga berdasarkan jenis hewan untuk header dan kolom dinamis
$kambingBumm = array_filter($prices, fn($p) => $p['jenis_hewan'] === 'kambing');
$sapiBumm    = array_filter($prices, fn($p) => $p['jenis_hewan'] === 'sapi');
?>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-0">

        <div class="table-responsive">
            <table class="table table-hover align-middle text-center mb-0">
                <thead class="bg-light border-bottom">
                    <tr class="align-middle">
                        <th rowspan="2" width="5%" class="py-3">NO</th>
                        <th rowspan="2" class="text-start py-3">CABANG</th>
                        <th colspan="3" class="border-bottom-0" style="background-color: rgba(13, 110, 253, 0.05); color: #0d6efd;">
                            <i class="bi bi-patch-check-fill me-1"></i> SAPI (MANDIRI)
                        </th>
                        <th colspan="3" class="border-bottom-0" style="background-color: rgba(25, 135, 84, 0.05); color: #198754;">
                            <i class="bi bi-patch-check-fill me-1"></i> KAMBING (MANDIRI)
                        </th>
                        <th rowspan="2" class="py-3">STATUS</th>
                    </tr>
                    <tr class="align-middle">
                        <th style="background-color: rgba(13, 110, 253, 0.05);">Target</th>
                        <th style="background-color: rgba(13, 110, 253, 0.05);">Masuk</th>
                        <th style="background-color: rgba(13, 110, 253, 0.05);">Kurang</th>
                        <th style="background-color: rgba(25, 135, 84, 0.05);">Target</th>
                        <th style="background-color: rgba(25, 135, 84, 0.05);">Masuk</th>
                        <th style="background-color: rgba(25, 135, 84, 0.05);">Kurang</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    $total_s_target = 0;
                    $total_s_masuk = 0;
                    $total_k_target = 0;
                    $total_k_masuk = 0;
                    ?>
                    <?php if (!empty($rekap)): ?>
                        <?php foreach ($rekap as $c): ?>
                            <?php
                            // Lewati data BUMM Sragen karena kita hanya fokus pada perbandingan hewan Mandiri cabang
                            if ($c['nama_cabang'] == 'BUMM Sragen') continue;

                            $isLengkap = ($c['sapi_kurang'] <= 0 && $c['kambing_kurang'] <= 0);

                            // Akumulasi total
                            $total_s_target += $c['sapi_mandiri'];
                            $total_s_masuk  += $c['sapi_masuk'];
                            $total_k_target += $c['kambing_mandiri'];
                            $total_k_masuk  += $c['kambing_masuk'];
                            ?>
                            <tr>
                                <td class="text-muted"><?= esc($no++) ?></td>
                                <td class="text-start">
                                    <div class="fw-bold text-dark"><?= esc($c['nama_cabang']) ?></div>
                                </td>

                                <!-- Sapi -->
                                <td>
                                    <div class="fw-bold"><?= esc($c['sapi_mandiri']) ?> <span class="fw-normal text-muted small">Org</span></div>
                                    <div class="text-muted" style="font-size: 0.75rem;">≈ <?= number_format($c['sapi_mandiri'] / 7, 1) ?> ekor</div>
                                </td>
                                <td class="text-primary fw-bold bg-light-subtle"><?= esc($c['sapi_masuk']) ?></td>
                                <td>
                                    <?php if ($c['sapi_kurang'] > 0): ?>
                                        <span class="badge rounded-pill bg-danger-subtle text-danger border border-danger-subtle px-2">
                                            -<?= number_format($c['sapi_kurang'], 1) ?>
                                        </span>
                                    <?php elseif ($c['sapi_kurang'] < 0): ?>
                                        <span class="badge rounded-pill bg-primary-subtle text-primary border border-primary-subtle px-2">
                                            +<?= number_format(abs($c['sapi_kurang']), 1) ?>
                                        </span>
                                    <?php else: ?>
                                        <i class="bi bi-check2 text-success"></i>
                                    <?php endif; ?>
                                </td>

                                <!-- Kambing -->
                                <td>
                                    <div class="fw-bold"><?= esc($c['kambing_mandiri']) ?> <span class="fw-normal text-muted small">Ekr</span></div>
                                </td>
                                <td class="text-success fw-bold bg-light-subtle"><?= esc($c['kambing_masuk']) ?></td>
                                <td>
                                    <?php if ($c['kambing_kurang'] > 0): ?>
                                        <span class="badge rounded-pill bg-danger-subtle text-danger border border-danger-subtle px-2">
                                            -<?= $c['kambing_kurang'] ?>
                                        </span>
                                    <?php elseif ($c['kambing_kurang'] < 0): ?>
                                        <span class="badge rounded-pill bg-primary-subtle text-primary border border-primary-subtle px-2">
                                            +<?= abs($c['kambing_kurang']) ?>
                                        </span>
                                    <?php else: ?>
                                        <i class="bi bi-check2 text-success"></i>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if ($isLengkap): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Lengkap</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3">Proses</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted py-5">
                                Tidak ada data rekap tahun <?= esc($year) ?>
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>
                <?php if (!empty($rekap)): ?>
                    <tfoot class="table-light fw-bold">
                        <tr>
                            <td colspan="2" class="text-end py-3">TOTAL KESELURUHAN</td>
                            <td><?= $total_s_target ?> <small class="fw-normal text-muted">Org</small></td>
                            <td class="text-primary"><?= $total_s_masuk ?> <small class="fw-normal text-muted">Ekr</small></td>
                            <td>
                                <?php
                                $diff_s = ($total_s_target / 7) - $total_s_masuk;
                                if ($diff_s > 0): ?>
                                    <span class="text-danger">-<?= number_format($diff_s, 1) ?></span>
                                <?php elseif ($diff_s < 0): ?>
                                    <span class="text-primary">+<?= number_format(abs($diff_s), 1) ?></span>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?= $total_k_target ?> <small class="fw-normal text-muted">Ekr</small></td>
                            <td class="text-success"><?= $total_k_masuk ?> <small class="fw-normal text-muted">Ekr</small></td>
                            <td>
                                <?php
                                $diff_k = $total_k_target - $total_k_masuk;
                                if ($diff_k > 0): ?>
                                    <span class="text-danger">-<?= $diff_k ?></span>
                                <?php elseif ($diff_k < 0): ?>
                                    <span class="text-primary">+<?= abs($diff_k) ?></span>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                <?php endif; ?>
            </table>
        </div>

    </div>
</div>

<?= $this->endSection() ?>