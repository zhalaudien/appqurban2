<!-- Page content-->
<div class="container">
    <div class="text-center mt-5">
        <h1>Selamat datang di penyembelihan Pusat 7</h1>
    </div>
</div>
<main class="app-main">
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="app-content">
                <!--begin::Container-->
                <div class="card-body p-0">
                    <div class="row">
                        <!--begin::Col-->
                        <div>
                            <!--begin::Small Box Widget 1-->
                            <div class="card card-info card-outline mb-4">
                                <!--begin::Header-->
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
                                                <td>Jumlah Cabang</td>
                                                <td><?= $jumlahcabang ?></td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td>Total Pequrban</td>
                                                <td><?= $sapib_bumm + ($sapi_bumm * 7) + ($sapi_mandiri * 7) + $kambing_bumm + $kambing_mandiri ?></td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td>Total Panitia</td>
                                                <td><?= $jumlahpanitia ?></td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td>Data Muspika</td>
                                                <td><?= $jumlahmuspika ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Form-->
                            </div>
                            <!--end::Small Box Widget 1-->
                        </div>
                        <div>
                            <!--begin::Small Box Widget 1-->
                            <div class="card card-info card-outline mb-4">
                                <!--begin::Header-->
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Hewan</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="align-middle">
                                                <td>Sapi BUMM</td>
                                                <td><?= number_format($sapi_bumm + ($sapib_bumm / 7), 1, '.', '') ?></td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td>Sapi Cabang</td>
                                                <td><?= $sapi_mandiri ?></td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td>Kambing BUMM</td>
                                                <td><?= $kambing_bumm ?></td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td>Kambing Cabang</td>
                                                <td><?= $kambing_mandiri ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Form-->
                            </div>
                            <!--end::Small Box Widget 1-->
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
</main>