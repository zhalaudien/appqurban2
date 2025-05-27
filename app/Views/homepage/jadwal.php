<!-- Page content -->
<div class="container">
    <div class="text-center mt-5 mb-4">
        <h1 class="fw-bold">Jadwal Pengiriman Hewan dan Besek Pusat 7</h1>
    </div>
</div>

<!-- Begin::App Main -->
<main class="app-main py-4">
    <div class="container-fluid">

        <?php
        $harian = [
            'Hari ke-1' => [$h1, $sapi_bumm_h1, $sapib_bumm_h1, $kambing_bumm_h1, $sapi_mandiri_h1, $kambing_mandiri_h1],
            'Hari ke-2' => [$h2, $sapi_bumm_h2, $sapib_bumm_h2, $kambing_bumm_h2, $sapi_mandiri_h2, $kambing_mandiri_h2],
            'Hari ke-3' => [$h3, $sapi_bumm_h3, $sapib_bumm_h3, $kambing_bumm_h3, $sapi_mandiri_h3, $kambing_mandiri_h3],
            'Hari ke-4' => [$h4, $sapi_bumm_h4, $sapib_bumm_h4, $kambing_bumm_h4, $sapi_mandiri_h4, $kambing_mandiri_h4],
        ];
        ?>

        <?php foreach ($harian as $hari => [$data, $sapi_bumm, $sapib_bumm, $kambing_bumm, $sapi_mandiri, $kambing_mandiri]): ?>
            <div class="card mb-5 shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    <?= $hari ?>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle m-0">
                            <thead class="table-light text-center">
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th>Cabang</th>
                                    <th>Sapi BUMM</th>
                                    <th>Kambing BUMM</th>
                                    <th>Sapi Cabang</th>
                                    <th>Kambing Cabang</th>
                                    <th>Kirim Hewan</th>
                                    <th>Kirim Besek</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php if ($data): ?>
                                    <?php foreach ($data as $cabang): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $cabang['cabang']; ?></td>
                                            <td class="text-center"><?= $cabang['sapi_bumm']; ?></td>
                                            <td class="text-center"><?= $cabang['kambing_bumm']; ?></td>
                                            <td class="text-center"><?= $cabang['sapi_mandiri']; ?></td>
                                            <td class="text-center"><?= $cabang['kambing_mandiri']; ?></td>
                                            <td class="text-center"><?= $cabang['kirim_hewan']; ?></td>
                                            <td class="text-center"><?= $cabang['kirim_besek']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Belum ada data tersedia.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot class="table-secondary text-center fw-semibold">
                                <tr>
                                    <td></td>
                                    <td>Jumlah</td>
                                    <td><?= number_format($sapi_bumm + ($sapib_bumm / 7), 1, '.', '') ?></td>
                                    <td><?= $kambing_bumm ?></td>
                                    <td><?= $sapi_mandiri ?></td>
                                    <td><?= $kambing_mandiri ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</main>
<!-- End::App Main -->