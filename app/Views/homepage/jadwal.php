<!-- Page content -->
<div class="container">
    <div class="text-center mt-5 mb-4">
        <h1 class="fw-bold">Jadwal Pengiriman Hewan dan Besek Pusat 7</h1>
        <h1 class="fw-bold"><?php echo $s_jadwal ?></h1>
    </div>
</div>

<!-- Begin::App Main -->
<main class="app-main py-4">
    <div class="container-fluid">

        <?php
        $groups = ['h1', 'h2', 'h3', 'h4'];
        foreach ($groups as $hari) :
            $data = $$hari;
            if (!$data) continue;
        ?>
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
                                    <th>Sapi BUMM (orang)</th>
                                    <th>Kambing BUMM</th>
                                    <th>Sapi Cabang</th>
                                    <th>Kambing Cabang</th>
                                    <th>Kirim Hewan</th>
                                    <th>Kirim Besek</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data as $cabang): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $cabang['cabang'] ?></td>
                                        <td><?= $cabang['sapi_bumm'] ?></td>
                                        <td><?= $cabang['sapib_bumm'] ?></td>
                                        <td><?= $cabang['kambing_bumm'] ?></td>
                                        <td><?= $cabang['sapi_mandiri'] ?></td>
                                        <td><?= $cabang['kambing_mandiri'] ?></td>
                                        <td><?= $cabang['kirim_hewan'] ?></td>
                                        <td><?= $cabang['kirim_besek'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th colspan="2" class="text-center">Jumlah</th>
                                    <th colspan="2" class="text-center"><?= ${"sapi_bumm_$hari"} + number_format((${"sapib_bumm_$hari"} / 7), 1, '.', '') ?></th>
                                    <th><?= ${"kambing_bumm_$hari"} ?></th>
                                    <th><?= ${"sapi_mandiri_$hari"} ?></th>
                                    <th><?= ${"kambing_mandiri_$hari"} ?></th>
                                    <th colspan="3"></th>
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