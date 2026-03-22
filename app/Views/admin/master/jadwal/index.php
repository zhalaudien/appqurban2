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

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="datatablesSimple"
                            class="table table-hover table-bordered align-middle text-center mb-0">

                            <thead class="table-light">
                                <tr class="align-middle">
                                    <th width="5%">No</th>
                                    <th class="text-start">Cabang</th>
                                    <th>Antrian</th>
                                    <th>Kirim Hewan</th>
                                    <th>Kirim Besek</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1; ?>
                                <?php if (!empty($jadwal)): ?>
                                    <?php foreach ($jadwal as $j): ?>
                                        <tr>
                                            <td><?= esc($no++) ?></td>

                                            <td class="text-start fw-semibold">
                                                <?= esc($j['nama_cabang']) ?>
                                            </td>

                                            <td><?= esc($j['antrian']) ?></td>
                                            <td><?= esc($j['kirim_hewan']) ?></td>
                                            <td><?= esc($j['kirim_besek']) ?></td>
                                            <td><?= esc($j['status']) ?></td>
                                            <td>
                                                <a href="/qurban/amprah/edit/<?= esc($j['id']) ?>"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="12" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                            Tidak ada data amprah tersedia
                                        </td>
                                    </tr>
                                <?php endif ?>
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