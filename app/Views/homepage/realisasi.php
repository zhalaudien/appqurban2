<!-- Page content-->
<div class="container">
    <div class="text-center mt-5">
        <h1>Realisasi Besek Pusat 7 <?= date('d-m-Y') ?></h1>
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
                                    <?php $no = 1; ?>
                                    <?php if ($h1): ?>
                                        <?php foreach ($h1 as $cabang): ?>
                                            <tr class="align-middle">
                                                <td><?= $no++; ?></td>
                                                <td><?php echo $cabang['cabang']; ?></td>
                                                <td><?php echo $cabang['r_ts']; ?></td>
                                                <td><?php echo $cabang['r_tk']; ?></td>
                                                <td><?php echo $cabang['r_a']; ?></td>
                                                <td><?php echo $cabang['r_os']; ?></td>
                                                <td><?php echo $cabang['r_ok']; ?></td>
                                                <td><?php echo $cabang['r_ks']; ?></td>
                                                <td><?php echo $cabang['r_kb']; ?></td>
                                                <td><?php echo $cabang['r_kks']; ?></td>
                                                <td><?php echo $cabang['r_kls']; ?></td>
                                                <td><?php echo $cabang['antrian']; ?></td>
                                                <td><?php echo $cabang['status']; ?></td>
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
</main>
<!--end::App Main-->