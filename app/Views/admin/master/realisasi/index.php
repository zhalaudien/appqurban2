<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                </div>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#inputdata">Input Data</button>
                    <a href="/panitia/export" type="button" class="btn btn-success">Exsport Exel</a>
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
            <div class="w-auto card mb-4">
                <div class="card-body">
                    <div class="row my-3">
                        <div class="col-md">
                            <table id="datatablesSimple"
                                class="table table-striped table-responsive table-hover text-left"
                                style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Cabang</th>
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
                                    <?php $no = 1; ?>
                                    <?php if (!empty($realisasi)): ?>
                                        <?php foreach ($realisasi as $r): ?>
                                            <tr>
                                                <td><?= esc($no++) ?></td>
                                                <td><?= esc($r['nama_cabang']) ?></td>
                                                <td><?= $r['R_TS'] ?></td>
                                                <td><?= $r['R_TK'] ?></td>
                                                <td><?= $r['R_A'] ?></td>
                                                <td><?= $r['R_M'] ?></td>
                                                <td><?= $r['R_OS'] ?></td>
                                                <td><?= $r['R_OK'] ?></td>
                                                <td><?= $r['R_K_S'] ?></td>
                                                <td><?= $r['R_K_KB'] ?></td>
                                                <td><?= $r['R_KK_S'] ?></td>
                                                <td><?= $r['R_KLS'] ?></td>
                                                <td>
                                                    <a type="button-sm" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#edit<?php echo $r['id']; ?>">
                                                        Edit</a>
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

                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-muted">
                            Tidak ada data
                        </td>
                    </tr>
                <?php endif ?>
                </tbody>
                </table>

                    </div>
                    <!--end::App Content-->
</main>
<!--end::App Main-->