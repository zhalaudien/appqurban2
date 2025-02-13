<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <!--begin::Col-->
                <div class="w-auto col-lg-6 col-6">
                    <!--begin::Small Box Widget 1-->
                    <div class="card card-info card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <h3 class="card-title">Penerimaan Hewan</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Hewan</th>
                                        <th>Total Hewan</th>
                                        <th>Hewan Masuk</th>
                                        <th>Kekurangan Hewan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        <td>Sapi BUMM</td>
                                        <td><?= number_format($sapi_bumm+($sapib_bumm/7), 1, '.', '')?></td>
                                        <td><?= $total_sapi_bumm ?></td>
                                        <td><?= (number_format($sapi_bumm+($sapib_bumm/7), 1, '.', ''))-$total_sapi_bumm ?>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Sapi Cabang</td>
                                        <td><?= $sapi_mandiri ?></td>
                                        <td><?= $total_sapi_cabang ?></td>
                                        <td><?= $sapi_mandiri-$total_sapi_cabang ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Kambing BUMM</td>
                                        <td><?= $kambing_bumm ?></td>
                                        <td><?= $total_kambing_bumm ?></td>
                                        <td><?= $kambing_bumm-$total_kambing_bumm ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Kambing Cabang</td>
                                        <td><?= $kambing_mandiri ?></td>
                                        <td><?= $total_kambing_cabang ?></td>
                                        <td><?= $kambing_mandiri-$total_kambing_cabang ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Small Box Widget 1-->
                </div>
                <!--end::Col-->
                <div class="w-auto col-lg-6 col-6">
                    <div class="card card-outline card-warning mb-4 ">
                        <div class="card-header">
                            <h3 class="card-title">Uang Masuk</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Uang Masuk</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        <td>BUMM</td>
                                        <td>Rp. <?= number_format($uang_bumm, 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Cabang</td>
                                        <td>Rp. <?= number_format($uang_cabang, 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Shadaqoh</td>
                                        <td>Rp. <?= number_format($shadaqoh, 0, ',', '.'); ?></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="align-middle">
                                        <th> Total Uang Masuk </th>
                                        <th> Rp. <?= number_format(($uang_bumm+$uang_cabang+$shadaqoh), 0, ',', '.'); ?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!--end::Small Box Widget 1-->
                </div>
                <!--end::Col-->
            </div>
            <div class="row">
                <!--begin::Col-->
                <div class="w-auto col-lg-6 col-6">
                    <!--begin::Small Box Widget 1-->
                    <div class="card card-outline card-success mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <h3 class="card-title">Data Besek</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Besek</th>
                                        <th>Produksi</th>
                                        <th>Keluar</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        <td>Besek TS</td>
                                        <td><?= $ts ?></td>
                                        <td><?= $t_ts ?></td>
                                        <td><?= $ts-$t_ts ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Besek OS</td>
                                        <td><?= $os ?></td>
                                        <td><?= $t_os ?></td>
                                        <td><?= $os-$t_os ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Besek M</td>
                                        <td><?= $a ?></td>
                                        <td><?= $t_a ?></td>
                                        <td><?= $a-$t_a ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Besek OS</td>
                                        <td><?= $os ?></td>
                                        <td><?= $t_os ?></td>
                                        <td><?= $os-$t_os ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Besek OK</td>
                                        <td><?= $ok ?></td>
                                        <td><?= $t_ok ?></td>
                                        <td><?= $ok-$t_ok ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Kepala Sapi</td>
                                        <td><?= $ks ?></td>
                                        <td><?= $t_ks ?></td>
                                        <td><?= $ks-$t_ks ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Kepala Kambing</td>
                                        <td><?= $kb ?></td>
                                        <td><?= $t_kb ?></td>
                                        <td><?= $kb-$t_kb ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Kaki Sapi</td>
                                        <td><?= $ks ?></td>
                                        <td><?= $t_ks ?></td>
                                        <td><?= $ks-$t_ks ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Kulit Sapi</td>
                                        <td><?= $kls ?></td>
                                        <td><?= $t_kls ?></td>
                                        <td><?= $kls-$t_kls ?></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th><?= $ts+$ks+$a+$os+$ok+$ks+$kb+$kks+$kls ?></th>
                                        <th><?= $t_ts+$t_ks+$t_a+$t_os+$t_ok+$t_ks+$t_kb+$t_kks+$t_kls ?></th>
                                        <th><?= ($ts+$ks+$a+$os+$ok+$ks+$kb+$kks+$kls)-($t_ts+$t_ks+$t_a+$t_os+$t_ok+$t_ks+$t_kb+$t_kks+$t_kls) ?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Small Box Widget 1-->
                </div>
                <!--end::Col-->
                <div class="w-auto col-lg-6 col-6">
                    <div class="card card-outline card-danger mb-4 ">
                        <div class="card-header">
                            <h3 class="card-title">Data Hewan Kandang</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Hewan</th>
                                        <th>Hewan Masuk</th>
                                        <th>Hewan Disembelih</th>
                                        <th>Stock Hewan Kandang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        <td>Sapi</td>
                                        <td><?= $total_sapi ?></td>
                                        <td><?= $disembelih_sapi ?></td>
                                        <td><?= $total_sapi-$disembelih_sapi ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Kambing</td>
                                        <td><?= $total_kambing ?></td>
                                        <td><?= $disembelih_kambing ?></td>
                                        <td><?= $total_kambing-$disembelih_kambing ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card card-outline card-danger mb-4 ">
                        <div class="card-header">
                            <h3 class="card-title">Data Data</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        <td>Pequrban</td>
                                        <td><?= (($sapi_bumm+$sapi_mandiri)*7)+$kambing_bumm+$kambing_mandiri+$sapib_bumm ?>
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Cabang</td>
                                        <td><?= $jumlahcabang ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Panitia</td>
                                        <td><?= $jumlahpanitia ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Muspika</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!--end::Col-->
            </div>
        </div>
    </div>
</main>