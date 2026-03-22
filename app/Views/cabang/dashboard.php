<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Profil Cabang</h3>
    </div>
    <div class="card-body">
        <strong><?= esc($profil['nama_cabang']) ?></strong><br>
        <?= esc($profil['alamat'] ?? '-') ?>
    </div>
</div>

<!-- INFO BOX -->
<div class="row">

    <div class="col-md-4">
        <div class="info-box bg-info">
            <span class="info-box-icon"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Pequrban</span>
                <span class="info-box-number"><?= $totalPequrban ?></span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="info-box bg-success">
            <span class="info-box-icon"><i class="fas fa-cow"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Sapi</span>
                <span class="info-box-number"><?= $jumlahsapi ?></span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="info-box bg-warning">
            <span class="info-box-icon"><i class="fas fa-horse"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Kambing</span>
                <span class="info-box-number"><?= $totalKambing ?></span>
            </div>
        </div>
    </div>

</div>

<!-- SUMBER HEWAN -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Sumber Hewan Qurban</h3>
    </div>
    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item">
                Sapi BUMM
                <span class="badge badge-success float-right"><?= $sapi_bumm ?></span>
            </li>
            <li class="list-group-item">
                Kambing BUMM
                <span class="badge badge-primary float-right"><?= $kambing_bumm ?></span>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item">
                Sapi Mandiri
                <span class="badge badge-success float-right"><?= $sapi_mandiri ?></span>
            </li>
            <li class="list-group-item">
                Kambing Mandiri
                <span class="badge badge-primary float-right"><?= $kambing_mandiri ?></span>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <!-- PERMINTAAN BESEK -->
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Permintaan Besek</h3>

                <div class="card-tools">
                    <button type="button-sm" class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#modalEditBesek">
                        <i class="fas fa-edit"></i> Edit</button>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>Item</th>
                            <th>Permintaan</th>
                            <th>Realisasi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $items = [
                            'TS' => 'TS',
                            'TK' => 'TK',
                            'A' => 'A',
                            'M' => 'M',
                            'OS' => 'OS',
                            'OK' => 'OK',
                            'kepala_sapi' => 'Kepala Sapi',
                            'kepala_kambing' => 'Kepala Kambing',
                            'kaki_sapi' => 'Kaki Sapi',
                            'kulit_sapi' => 'Kulit Sapi'
                        ];
                        ?>

                        <?php foreach ($items as $field => $label): ?>
                            <tr>
                                <td class="text-left"><strong><?= $field ?></strong></td>

                                <!-- PERMINTAAN -->
                                <td>
                                    <?= $permintaan[$field] ?? 0 ?>
                                </td>

                                <!-- REALISASI -->
                                <td>
                                    <?= $realisasi[$field] ?? 0 ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JADWAL PENGIRIMAN -->
    <div class="col-md-6">
        <div class="card card-warning shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Jadwal Pengiriman</h3>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">

                    <?php if (!empty($jadwalPengiriman)): ?>
                        <?php foreach ($jadwalPengiriman as $jadwal): ?>
                            <li class="list-group-item">
                                <!-- BODY -->
                                <div class="mt-2 text-muted">

                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            Pengiriman Hewan
                                            <span class=" float-right"><?= $jadwal['kirim_hewan'] ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            Pengiriman Besek
                                            <span class=" float-right"><?= $jadwal['kirim_besek'] ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            Antrian Besek
                                            <span class=" float-right"><?= $jadwal['antrian'] ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            Status Besek
                                            <span class=" float-right"><?= $jadwal['status'] ?></span>
                                        </li>
                                    </ul>

                                </div>

                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item text-center text-muted">
                            Belum ada jadwal pengiriman
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="modalEditBesek" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Update Permintaan Besek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= base_url('cabang/amprah/update/' . $cabangId) ?>" method="post">
                <?= csrf_field(); ?>

                <div class="modal-body">

                    <div class="row fw-bold mb-2 text-center">
                        <div class="col-4">Item</div>
                        <div class="col-4">Perkiraan</div>
                        <div class="col-4">Permintaan</div>
                    </div>

                    <?php
                    $items = [
                        'TS' => 'TS',
                        'TK' => 'TK',
                        'A' => 'A',
                        'M' => 'M',
                        'OS' => 'OS',
                        'OK' => 'OK',
                        'kepala_sapi' => 'Kepala Sapi',
                        'kepala_kambing' => 'Kepala Kambing',
                        'kaki_sapi' => 'Kaki Sapi',
                        'kulit_sapi' => 'Kulit Sapi'
                    ];
                    ?>

                    <?php foreach ($items as $field => $label): ?>
                        <div class="row mb-2 align-items-center">

                            <!-- ITEM -->
                            <div class="col-4 fw-bold">
                                <?= $label ?>
                            </div>

                            <!-- PERKIRAAN -->
                            <div class="col-4">
                                <input type="number"
                                    class="form-control text-info fw-bold"
                                    value="<?= $perkiraan[$field] ?? 0 ?>"
                                    readonly>
                            </div>

                            <!-- PERMINTAAN -->
                            <div class="col-4">
                                <input type="number"
                                    class="form-control text-success fw-bold"
                                    name="P_<?= $field ?>"
                                    value="<?= $permintaan[$field] ?? 0 ?>">
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

<?= $this->endSection() ?>