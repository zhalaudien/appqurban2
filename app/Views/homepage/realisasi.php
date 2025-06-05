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

            // Hitung total kolom besek
            $total_ts = $total_tk = $total_a = $total_os = $total_ok = $total_ks = $total_kb = $total_kks = $total_kls = 0;
            foreach ($data as $cabang) {
                $total_ts  += (int)$cabang['r_ts'];
                $total_tk  += (int)$cabang['r_tk'];
                $total_a   += (int)$cabang['r_a'];
                $total_os  += (int)$cabang['r_os'];
                $total_ok  += (int)$cabang['r_ok'];
                $total_ks  += (int)$cabang['r_ks'];
                $total_kb  += (int)$cabang['r_kb'];
                $total_kks += (int)$cabang['r_kks'];
                $total_kls += (int)$cabang['r_kls'];
            }
            $totalBesek = $total_ts + $total_tk + $total_a + $total_os + $total_ok;
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
                                    <th>Kaki Sapi</th>
                                    <th>Kulit Sapi</th>
                                    <th>Antrian</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data as $cabang):
                                    $status = strtolower($cabang['status']);
                                    $badgeClass = match ($status) {
                                        'dikirim' => 'badge bg-success',
                                        'proses' => 'badge bg-primary',
                                        default => 'badge bg-secondary',
                                    };
                                ?>
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
                                        <td class="text-center">
                                            <span class="<?= $badgeClass ?>"><?= $cabang['status']; ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="table-light fw-semibold text-center">
                                <tr>
                                    <td colspan="2">Total</td>
                                    <td><?= number_format($total_ts) ?></td>
                                    <td><?= number_format($total_tk) ?></td>
                                    <td><?= number_format($total_a) ?></td>
                                    <td><?= number_format($total_os) ?></td>
                                    <td><?= number_format($total_ok) ?></td>
                                    <td><?= number_format($total_ts) ?></td>
                                    <td><?= number_format($total_kb) ?></td>
                                    <td><?= number_format($total_kks) ?></td>
                                    <td><?= number_format($total_kls) ?></td>
                                    <td colspan="2">Total Besek : <?= number_format($totalBesek) ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</main>