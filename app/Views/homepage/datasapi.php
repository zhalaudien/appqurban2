<!-- Page content -->
<div class="container">
    <div class="text-center mt-5 mb-4">
        <h1 class="fw-bold">Data Hewan Sapi Pusat 7</h1>
    </div>
</div>

<main class="app-main py-4">
    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-striped table-hover align-middle mb-0" style="width:100%">
                        <thead class="table-primary text-center">
                            <tr>
                                <th style="width: 40px;">No</th>
                                <th class="text-center">Cabang</th>
                                <th class="text-center">Berat (kg)</th>
                                <th class="text-center">Nomor Sapi</th>
                                <th class="text-center">Tanggal Input</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php if (!empty($viewsapi)): ?>
                                <?php foreach ($viewsapi as $sapi): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td class="text-center"><?= $sapi['cabang']; ?></td>
                                        <td class="text-center"><?= $sapi['berat']; ?></td>
                                        <td class="text-center"><?= $sapi['nomor']; ?></td>
                                        <td class="text-center"><?= date('d-m-Y', strtotime($sapi['date_input'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-3">
                                        Belum ada data hewan sapi yang tersedia.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>