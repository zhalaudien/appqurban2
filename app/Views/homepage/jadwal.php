<!-- Page content-->
<div class="container">
    <div class="text-center mt-5">
        <h1>Jadwal Pengiriman Hewan dan Besek Pusat 7</h1>
    </div>
</div>
<!--begin::App Main-->
<main class="app-main">
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <div class="card mb-4">
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
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
                                    <?php if ($h1): ?>
                                        <?php foreach ($h1 as $cabang): ?>
                                            <tr class="align-middle">
                                                <td><?= $no++; ?></td>
                                                <td><?= $cabang['cabang']; ?></td>
                                                <td><?= $cabang['sapi_bumm']; ?></td>
                                                <td><?= $cabang['kambing_bumm']; ?></td>
                                                <td><?= $cabang['sapi_mandiri']; ?></td>
                                                <td><?= $cabang['kambing_mandiri']; ?></td>
                                                <td><?= $cabang['kirim_hewan']; ?></td>
                                                <td><?= $cabang['kirim_besek']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width: 10px"></th>
                                        <th>Jumlah</th>
                                        <th><?= number_format($sapi_bumm_h1 + ($sapib_bumm_h1 / 7), 1, '.', '') ?>
                                        </th>
                                        <th><?= $kambing_bumm_h1 ?></th>
                                        <th><?= $sapi_mandiri_h1 ?></th>
                                        <th><?= $kambing_mandiri_h1 ?></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!--end::Container-->
            </div>
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
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
                                    <?php if ($h2): ?>
                                        <?php foreach ($h2 as $cabang): ?>
                                            <tr class="align-middle">
                                                <td><?= $no++; ?></td>
                                                <td><?= $cabang['cabang']; ?></td>
                                                <td><?= $cabang['sapi_bumm']; ?></td>
                                                <td><?= $cabang['kambing_bumm']; ?></td>
                                                <td><?= $cabang['sapi_mandiri']; ?></td>
                                                <td><?= $cabang['kambing_mandiri']; ?></td>
                                                <td><?= $cabang['kirim_hewan']; ?></td>
                                                <td><?= $cabang['kirim_besek']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width: 10px"></th>
                                        <th>Jumlah</th>
                                        <th><?= number_format($sapi_bumm_h2 + ($sapib_bumm_h2 / 7), 1, '.', '') ?>
                                        </th>
                                        <th><?= $kambing_bumm_h2 ?></th>
                                        <th><?= $sapi_mandiri_h2 ?></th>
                                        <th><?= $kambing_mandiri_h2 ?></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!--end::Container-->
            </div>
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
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
                                    <?php if ($h3): ?>
                                        <?php foreach ($h3 as $cabang): ?>
                                            <tr class="align-middle">
                                                <td><?= $no++; ?></td>
                                                <td><?= $cabang['cabang']; ?></td>
                                                <td><?= $cabang['sapi_bumm']; ?></td>
                                                <td><?= $cabang['kambing_bumm']; ?></td>
                                                <td><?= $cabang['sapi_mandiri']; ?></td>
                                                <td><?= $cabang['kambing_mandiri']; ?></td>
                                                <td><?= $cabang['kirim_hewan']; ?></td>
                                                <td><?= $cabang['kirim_besek']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width: 10px"></th>
                                        <th>Jumlah</th>
                                        <th><?= number_format($sapi_bumm_h3 + ($sapib_bumm_h3 / 7), 1, '.', '') ?>
                                        </th>
                                        <th><?= $kambing_bumm_h3 ?></th>
                                        <th><?= $sapi_mandiri_h3 ?></th>
                                        <th><?= $kambing_mandiri_h3 ?></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
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
                                    <?php if ($h4): ?>
                                        <?php foreach ($h4 as $cabang): ?>
                                            <tr class="align-middle">
                                                <td><?= $no++; ?></td>
                                                <td><?= $cabang['cabang']; ?></td>
                                                <td><?= $cabang['sapi_bumm']; ?></td>
                                                <td><?= $cabang['kambing_bumm']; ?></td>
                                                <td><?= $cabang['sapi_mandiri']; ?></td>
                                                <td><?= $cabang['kambing_mandiri']; ?></td>
                                                <td><?= $cabang['kirim_hewan']; ?></td>
                                                <td><?= $cabang['kirim_besek']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width: 10px"></th>
                                        <th>Jumlah</th>
                                        <th><?= number_format($sapi_bumm_h4 + ($sapib_bumm_h4 / 7), 1, '.', '') ?>
                                        </th>
                                        <th><?= $kambing_bumm_h4 ?></th>
                                        <th><?= $sapi_mandiri_h4 ?></th>
                                        <th><?= $kambing_mandiri_h4 ?></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!--end::Container-->
            </div>
</main>
<!--end::App Main-->