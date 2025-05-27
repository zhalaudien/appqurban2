<!-- Page content -->
<div class="container">
    <div class="text-center mt-5 mb-4">
        <h1 class="fw-bold">Data Qurban Cabang Pusat 7</h1>
    </div>
</div>

<!--begin::App Main-->
<main class="app-main py-4">
    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-bordered table-hover align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Cabang</th>
                                <th>Sapi BUMM</th>
                                <th>Sapi BUMM<br><small>(Orang)</small></th>
                                <th>Kambing BUMM</th>
                                <th>Sapi Mandiri</th>
                                <th>Kambing Mandiri</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php if ($qurban): ?>
                                <?php foreach ($qurban as $cabang): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $cabang['cabang']; ?></td>
                                        <td class="text-center"><?= $cabang['sapi_bumm']; ?></td>
                                        <td class="text-center"><?= $cabang['sapib_bumm']; ?></td>
                                        <td class="text-center"><?= $cabang['kambing_bumm']; ?></td>
                                        <td class="text-center"><?= $cabang['sapi_mandiri']; ?></td>
                                        <td class="text-center"><?= $cabang['kambing_mandiri']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Tidak ada data tersedia.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>