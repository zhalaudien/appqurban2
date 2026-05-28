<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!--begin::App Main-->
<main class="app-main">
    <div class="app-content-header py-3"> <!-- Menambahkan padding vertikal untuk spasi -->
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row align-items-center"> <!-- Mengubah align-items-left menjadi align-items-center untuk perataan vertikal -->
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
                <div class="col-sm-6 text-end"> <!-- Menghapus align-self-center dan gap-2 dari col -->
                    <div class="d-flex justify-content-end align-items-center gap-2"> <!-- Menambahkan div baru untuk tombol dengan flex dan gap -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#inputdata">Input Data</button>
                        <a href="/realisasi/export?year=<?= $year ?? date('Y') ?>" class="btn btn-success">Export Excel</a>
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card mb-4"> <!-- Menghapus class w-auto dan struktur row/col yang tidak perlu di dalam card-body -->
                <div class="card-body">
                    <?php if (!empty($grouped_realisasi)): ?>
                        <?php foreach ($grouped_realisasi as $hari => $items_group): ?>
                            <div class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                                <h5 class="fw-bold text-primary mb-0">
                                    <i class="bi bi-calendar-check me-2"></i> Jadwal: <?= esc($hari) ?>
                                </h5>
                                <span class="badge bg-secondary rounded-pill"><?= count($items_group) ?> Cabang</span>
                            </div>
                            <table class="table table-bordered table-striped table-hover text-center mb-4 shadow-sm" style="width:100%">
                                <thead class="table-light">
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
                                        <th style="width: 100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $totals = array_fill_keys(['R_TS', 'R_TK', 'R_A', 'R_M', 'R_OS', 'R_OK', 'R_K_S', 'R_K_KB', 'R_KK_S', 'R_KLS'], 0);
                                    ?>
                                    <?php foreach ($items_group as $r): ?>
                                        <?php
                                        foreach ($totals as $key => $val) $totals[$key] += (int)($r[$key] ?? 0);
                                        ?>
                                        <tr>
                                            <td><?= esc($no++) ?></td>
                                            <td class="text-start fw-bold"><?= esc($r['nama_cabang']) ?></td>

                                            <?php
                                            $cols = [
                                                'R_TS' => 'TS',
                                                'R_TK' => 'TK',
                                                'R_A' => 'A',
                                                'R_M' => 'M',
                                                'R_OS' => 'OS',
                                                'R_OK' => 'OK',
                                                'R_K_S' => 'K_S',
                                                'R_K_KB' => 'K_KB',
                                                'R_KK_S' => 'KK_S',
                                                'R_KLS' => 'KLS'
                                            ];
                                            foreach ($cols as $r_key => $a_key):
                                                $real = (int)($r[$r_key] ?? 0);
                                                $amp  = (int)($r[$a_key] ?? 0);
                                                $color = '';
                                                if ($real > $amp && $amp > 0) $color = 'text-primary fw-bold'; // Surplus
                                                elseif ($real < $amp) $color = 'text-danger'; // Defisit
                                            ?>
                                                <td class="<?= $color ?>"><?= $real ?></td>
                                            <?php endforeach; ?>

                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#edit<?php echo $r['id']; ?>">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </button>
                                                <div class="modal fade" id="edit<?= $r['id']; ?>" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title">
                                                                    Update Realisasi - <?= esc($r['nama_cabang']); ?>
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <form action="<?= base_url('realisasi/update/' . $r['id']) ?>" method="post">
                                                                <?= csrf_field(); ?>

                                                                <div class="modal-body">

                                                                    <input type="hidden" name="id" value="<?= $r['id']; ?>">

                                                                    <div class="row fw-bold mb-2 text-center">
                                                                        <div class="col-3">Item</div>
                                                                        <div class="col-3">Amprah</div>
                                                                        <div class="col-3">Perkiraan</div>
                                                                        <div class="col-3">Realisasi</div>
                                                                    </div>

                                                                    <?php
                                                                    $jenis = ['TS', 'TK', 'A', 'M', 'OS', 'OK', 'kepala Sapi', 'Kepala Kambing', 'Kaki sapi', 'Kulit Sapi'];
                                                                    $items = ['TS', 'TK', 'A', 'M', 'OS', 'OK', 'K_S', 'K_KB', 'KK_S', 'KLS'];
                                                                    foreach ($items as $item): ?>

                                                                        <div class="row mb-2 align-items-center">
                                                                            <div class="col-3 fw-bold">
                                                                                <?= $jenis[array_search($item, $items)] ?>
                                                                            </div>

                                                                            <!-- Amprah -->
                                                                            <div class="col-3">
                                                                                <input type="number"
                                                                                    class="form-control text-primary fw-bold"
                                                                                    value="<?= $r[$item] ?? 0 ?>"
                                                                                    readonly>
                                                                            </div>

                                                                            <!-- PERKIRAAN -->
                                                                            <div class="col-3">
                                                                                <input type="number"
                                                                                    class="form-control text-warning fw-bold"
                                                                                    value="<?= $r['P_' . $item] ?? 0 ?>"
                                                                                    readonly>
                                                                            </div>

                                                                            <!-- Realisasi -->
                                                                            <div class="col-3">
                                                                                <input type="number"
                                                                                    class="form-control text-success fw-bold"
                                                                                    name="R_<?= $item ?>"
                                                                                    value="<?= $r['R_' . $item] ?? 0 ?>">
                                                                            </div>
                                                                        </div>

                                                                    <?php endforeach; ?>

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        Update
                                                                    </button>
                                                                </div>

                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                </div>

                </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot class="table-light fw-bold">
                <tr>
                    <td colspan="2" class="text-end">TOTAL <?= strtoupper($hari) ?></td>
                    <?php foreach ($totals as $val): ?>
                        <td><?= $val ?></td>
                    <?php endforeach; ?>
                    <td></td>
                </tr>
            </tfoot>
            </table>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center py-5">
            <p class="text-muted">Tidak ada data realisasi untuk ditampilkan.</p>
        </div>
    <?php endif; ?>
            </div> <!-- Akhir dari card-body -->
        </div> <!-- Akhir dari card -->
    </div> <!-- Akhir dari container-fluid -->
    </div> <!-- Akhir dari app-content -->
</main>
<!--end::App Main-->
<?= $this->endSection() ?>