<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between">
        <h5 class="mb-0">Rekap Qurban Cabang Tahun <?= $year ?></h5>

        <form method="get">
            <select name="year" onchange="this.form.submit()" class="form-select form-select-sm">
                <?php for ($y = date('Y'); $y >= 2024; $y--): ?>
                    <option value="<?= $y ?>" <?= $y == $year ? 'selected' : '' ?>>
                        <?= $y ?>
                    </option>
                <?php endfor ?>
            </select>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th rowspan="2">Cabang</th>
                    <th colspan="2">Sapi</th>
                    <th colspan="2">Kambing</th>
                </tr>
                <tr>
                    <th>Mandiri</th>
                    <th>BUMM</th>
                    <th>Mandiri</th>
                    <th>BUMM</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($rekap)): ?>
                    <?php foreach ($rekap as $r): ?>
                        <tr>
                            <td><?= esc($r['nama_cabang']) ?></td>
                            <td><?= $r['sapi_mandiri'] ?></td>
                            <td><?= $r['sapi_bumm'] ?></td>
                            <td><?= $r['kambing_mandiri'] ?></td>
                            <td><?= $r['kambing_bumm'] ?></td>
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
</div>