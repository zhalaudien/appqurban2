<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="app-content-header py-3">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">

        <div>
            <h4 class="fw-bold mb-0">Rekap Hewan Qurban per Cabang</h4>
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


<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body">

        <div class="table-responsive">
            <table id="datatablesSimple"
                class="table table-hover table-bordered align-middle text-center mb-0">

                <thead class="table-light">
                    <tr class="align-middle">
                        <th width="5%">No</th>
                        <th class="text-start">Cabang</th>
                        <th>Sapi Mandiri Orang</th>
                        <th>Sapi BUMM Orang</th>
                        <th>Kambing Mandiri</th>
                        <th>Kambing BUMM</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1; ?>
                    <?php if (!empty($rekap)): ?>
                        <?php foreach ($rekap as $c): ?>
                            <tr>
                                <td><?= esc($no++) ?></td>

                                <td class="text-start fw-semibold">
                                    <?= esc($c['nama_cabang']) ?>
                                </td>

                                <td><?= esc($c['sapi_mandiri']) ?></td>
                                <td><?= esc($c['sapi_bumm']) ?></td>
                                <td><?= esc($c['kambing_mandiri']) ?></td>
                                <td><?= esc($c['kambing_bumm']) ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-4 d-block mb-2"></i>
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