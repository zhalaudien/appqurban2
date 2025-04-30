<!-- Page content-->
<div class="container">
    <div class="text-center mt-5">
        <h1>Data Hewan Sapi Pusat 7</h1>
    </div>
</div>
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
                                        <th>Berat</th>
                                        <th>Nomor Sapi</th>
                                        <th>Harga</th>
                                        <th>Tanggal Input</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php if ($viewsapi): ?>
                                        <?php foreach ($viewsapi as $sapi): ?>
                                            <tr class="align-middle">
                                                <td><?= $no++; ?></td>
                                                <td><?php echo $sapi['cabang']; ?></td>
                                                <td><?php echo $sapi['berat']; ?></td>
                                                <td><?php echo $sapi['nomor']; ?></td>
                                                <td><?php echo $sapi['harga']; ?></td>
                                                <td><?php echo $sapi['date_input']; ?></td>
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