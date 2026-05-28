<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!--begin::App Main-->
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <form action="" method="get" class="d-flex align-items-center gap-2">
                        <label class="small text-muted mb-0">Pilih Tahun</label>
                        <select name="year"
                            onchange="this.form.submit()"
                            class="form-select form-select-sm shadow-sm"
                            style="width:120px">
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
                <div class="col-sm-6 text-end">
                    <div class="d-flex justify-content-end align-items-center gap-2">
                        <button type="button" class="btn btn-primary shadow-sm"
                            data-bs-toggle="modal" data-bs-target="#inputdata">
                            <i class="bi bi-plus-circle"></i> Input Data
                        </button>
                        <a href="/amprah/export?year=<?= $year ?? date('Y') ?>" class="btn btn-success shadow-sm">
                            <i class="bi bi-file-earmark-excel"></i> Export Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body">

                    <?php if (!empty($grouped_amprah)): ?>
                        <?php foreach ($grouped_amprah as $hari => $items_group): ?>
                            <div class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                                <h5 class="fw-bold text-primary mb-0">
                                    <i class="bi bi-calendar-check me-2"></i> Jadwal: <?= esc($hari) ?>
                                </h5>
                                <span class="badge bg-secondary rounded-pill"><?= count($items_group) ?> Cabang</span>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover text-center mb-4 shadow-sm" style="width:100%">
                                    <thead class="table-light shadow-sm">
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th class="text-start">Cabang</th>
                                            <th>TS</th>
                                            <th>TK</th>
                                            <th>A</th>
                                            <th>M</th>
                                            <th>OS</th>
                                            <th>OK</th>
                                            <th>K_S</th>
                                            <th>K_KB</th>
                                            <th>KK_S</th>
                                            <th>KLS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $totals = array_fill_keys(['TS', 'TK', 'A', 'M', 'OS', 'OK', 'K_S', 'K_KB', 'KK_S', 'KLS'], 0);
                                        ?>
                                        <?php foreach ($items_group as $a): ?>
                                            <?php foreach ($totals as $key => $val) $totals[$key] += (int)($a[$key] ?? 0); ?>
                                            <tr>
                                                <td><?= esc($no++) ?></td>
                                                <td class="text-start fw-bold"><?= esc($a['nama_cabang']) ?></td>
                                                <td><?= esc($a['TS']) ?></td>
                                                <td><?= esc($a['TK']) ?></td>
                                                <td><?= esc($a['A']) ?></td>
                                                <td><?= esc($a['M']) ?></td>
                                                <td><?= esc($a['OS']) ?></td>
                                                <td><?= esc($a['OK']) ?></td>
                                                <td><?= esc($a['K_S']) ?></td>
                                                <td><?= esc($a['K_KB']) ?></td>
                                                <td><?= esc($a['KK_S']) ?></td>
                                                <td><?= esc($a['KLS']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot class="fw-bold">
                                        <tr>
                                            <td colspan="2" class="text-end text-uppercase">TOTAL <?= esc($hari) ?></td>
                                            <?php foreach ($totals as $val): ?>
                                                <td><?= esc($val) ?></td>
                                            <?php endforeach; ?>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info text-center py-4">
                            <i class="bi bi-info-circle fs-2 d-block mb-2"></i>
                            Belum ada data amprah untuk tahun <?= esc($year ?? date('Y')) ?>.
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>

</main>
<!--end::App Main-->

<?= $this->endSection() ?>