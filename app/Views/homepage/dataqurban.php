<!-- Page content-->
<div class="container">
    <div class="text-center mt-5">
        <h1>Data Qurban Cabang Pusat 7</h1>
    </div>
</div>
<!--begin::App Main-->
<main class="app-main">
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row my-3">
                        <div class="col-md">
                            <table id="datatablesSimple"
                                class="table table-striped table-responsive table-hover text-left"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Cabang</th>
                                        <th>Sapi BUMM</th>
                                        <th>Sapi BUMM Orang</th>
                                        <th>Kambing BUMM</th>
                                        <th>Sapi Mandiri</th>
                                        <th>Kambing Mandiri</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php if ($qurban): ?>
                                        <?php foreach ($qurban as $cabang): ?>
                                            <tr class="align-middle">
                                                <td><?= $no++; ?></td>
                                                <td><?php echo $cabang['cabang']; ?></td>
                                                <td><?php echo $cabang['sapi_bumm']; ?></td>
                                                <td><?php echo $cabang['sapib_bumm']; ?></td>
                                                <td><?php echo $cabang['kambing_bumm']; ?></td>
                                                <td><?php echo $cabang['sapi_mandiri']; ?></td>
                                                <td><?php echo $cabang['kambing_mandiri']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
</main>
<!--end::App Main-->