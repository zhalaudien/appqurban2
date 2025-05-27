<!-- Page content -->
<div class="container">
    <div class="text-center mt-5 mb-4">
        <h1 class="fw-bold">Realisasi Besek Pusat 7 <?php echo $s_hari ?></h1>
    </div>
</div>

<!--begin::App Main-->
<main class="app-main py-4">
    <div class="container-fluid">
        <?php
        $groups = explode(',', $s_hari);
        foreach ($groups as $hari) :
            $data = $$hari;
            if (!$data) continue;
        ?>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0 align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th style="width: 40px;">No</th>
                                    <th>Cabang</th>
                                    <th>TS</th>
                                    <th>TK</th>
                                    <th>M</th>
                                    <th>OS</th>
                                    <th>OK</th>
                                    <th>K Sapi</th>
                                    <th>K Kambing</th>
                                    <th>KK Sapi</th>
                                    <th>KL Sapi</th>
                                    <th>Antrian</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data as $cabang): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $cabang['cabang'] ?></td>
                                        <td class="text-center"><?= $cabang['r_ts']; ?></td>
                                        <td class="text-center"><?= $cabang['r_tk']; ?></td>
                                        <td class="text-center"><?= $cabang['r_a']; ?></td>
                                        <td class="text-center"><?= $cabang['r_os']; ?></td>
                                        <td class="text-center"><?= $cabang['r_ok']; ?></td>
                                        <td class="text-center"><?= $cabang['r_ks']; ?></td>
                                        <td class="text-center"><?= $cabang['r_kb']; ?></td>
                                        <td class="text-center"><?= $cabang['r_kks']; ?></td>
                                        <td class="text-center"><?= $cabang['r_kls']; ?></td>
                                        <td class="text-center"><?= $cabang['antrian']; ?></td>
                                        <td class="text-center"><?= $cabang['status']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </table>
        <?php endforeach; ?>
    </div>
</main>