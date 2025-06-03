<!--begin::App Main-->
<main class="app-main py-3">
    <div class="container-fluid">

        <!--begin::Main Data Table-->
        <div class="card mb-4">
            <div class="card-header fw-bold">Data Jadwal Cabang</div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover align-middle w-100" id="datatablesSimple">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Cabang</th>
                            <th>Sapi BUMM</th>
                            <th>Sapi BUMM Orang</th>
                            <th>Kambing BUMM</th>
                            <th>Sapi Cabang</th>
                            <th>Kambing Cabang</th>
                            <th>No Antrian</th>
                            <th>Kirim Hewan</th>
                            <th>Kirim Besek</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        if ($jadwal): foreach ($jadwal as $cabang): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $cabang['cabang'] ?></td>
                                    <td><?= $cabang['sapi_bumm'] ?></td>
                                    <td><?= $cabang['sapib_bumm'] ?></td>
                                    <td><?= $cabang['kambing_bumm'] ?></td>
                                    <td><?= $cabang['sapi_mandiri'] ?></td>
                                    <td><?= $cabang['kambing_mandiri'] ?></td>
                                    <td><?= $cabang['antrian'] ?></td>
                                    <td><?= $cabang['kirim_hewan'] ?></td>
                                    <td><?= $cabang['kirim_besek'] ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $cabang['id'] ?>">Edit</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="edit<?= $cabang['id'] ?>" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <form action="<?= site_url('/jadwal/edit') ?>" method="post">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Jadwal - <?= $cabang['cabang'] ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="<?= $cabang['id'] ?>">

                                                            <div class="mb-3">
                                                                <label class="form-label">Cabang</label>
                                                                <input type="text" class="form-control" value="<?= $cabang['cabang'] ?>" readonly disabled>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">No Antrian</label>
                                                                <input type="text" name="antrian" class="form-control" value="<?= $cabang['antrian'] ?>">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Jadwal Kirim Hewan</label>
                                                                <select name="kirim_hewan" class="form-select">
                                                                    <option selected value="<?= $cabang['kirim_hewan'] ?>"><?= $cabang['kirim_hewan'] ?></option>
                                                                    <option value="H-1 <?= $j_h_1 ?> Siang">H-1 <?= $j_h_1 ?> Siang</option>
                                                                    <option value="H1 <?= $j_h ?> Pagi">H1 <?= $j_h ?> Pagi</option>
                                                                    <option value="H1 <?= $j_h ?> Siang">H1 <?= $j_h ?> Siang</option>
                                                                    <option value="H2 <?= $j_h2 ?> Pagi">H2 <?= $j_h2 ?> Pagi</option>
                                                                    <option value="H2 <?= $j_h2 ?> Siang">H2 <?= $j_h2 ?> Siang</option>
                                                                    <option value="H3 <?= $j_h3 ?> Pagi">H3 <?= $j_h3 ?> Pagi</option>
                                                                    <option value="H3 <?= $j_h3 ?> Siang">H3 <?= $j_h3 ?> Siang</option>
                                                                    <option value="H4 <?= $j_h4 ?> Pagi">H4 <?= $j_h4 ?> Pagi</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Jadwal Kirim Besek</label>
                                                                <select name="kirim_besek" class="form-select">
                                                                    <option selected value="<?= $cabang['kirim_besek'] ?>"><?= $cabang['kirim_besek'] ?></option>
                                                                    <option value="H1 <?= $j_h ?>">H1 <?= $j_h ?></option>
                                                                    <option value="H2 <?= $j_h2 ?>">H2 <?= $j_h2 ?></option>
                                                                    <option value="H3 <?= $j_h3 ?>">H3 <?= $j_h3 ?></option>
                                                                    <option value="H4 <?= $j_h4 ?>">H4 <?= $j_h4 ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                    </td>
                                </tr>
                        <?php endforeach;
                        endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--end::Main Data Table-->

        <?php
        $groups = ['h1', 'h2', 'h3', 'h4'];
        foreach ($groups as $hari) :
            $data = $$hari;
            if (!$data) continue;
        ?>
            <div class="card mb-4">
                <div class="card-header fw-bold text-uppercase"><?= strtoupper($hari) ?> - Jadwal Pengiriman</div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-hover mb-0 text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Cabang</th>
                                <th>Sapi BUMM</th>
                                <th>Sapi Cabang</th>
                                <th>Kambing BUMM</th>
                                <th>Kambing Cabang</th>
                                <th>No Antrian</th>
                                <th>Kirim Hewan</th>
                                <th>Kirim Besek</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $cabang): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $cabang['cabang'] ?></td>
                                    <td>
                                        <?php
                                        // Gunakan Brick\Math untuk tampilkan pecahan per cabang
                                        $sapi_bumm = $cabang['sapi_bumm'] ?? 0;
                                        $sapib_bumm = $cabang['sapib_bumm'] ?? 0;

                                        $r1 = \Brick\Math\BigRational::of($sapi_bumm);
                                        $r2 = \Brick\Math\BigRational::of($sapib_bumm)->dividedBy(7);
                                        $hasil = $r1->plus($r2);

                                        $num = $hasil->getNumerator()->toInt();
                                        $den = $hasil->getDenominator()->toInt();
                                        $whole = intdiv($num, $den);
                                        $remain = $num % $den;

                                        if ($remain === 0) {
                                            echo $whole;
                                        } elseif ($whole > 0) {
                                            echo "$whole $remain/$den";
                                        } else {
                                            echo "$remain/$den";
                                        }
                                        ?>
                                    </td>
                                    <td><?= $cabang['sapi_mandiri'] ?></td>
                                    <td><?= $cabang['kambing_bumm'] ?></td>
                                    <td><?= $cabang['kambing_mandiri'] ?></td>
                                    <td><?= $cabang['antrian'] ?></td>
                                    <td><?= $cabang['kirim_hewan'] ?></td>
                                    <td><?= $cabang['kirim_besek'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="2" class="text-center">Jumlah</th>
                                <th colspan="2" class="text-center">
                                    <?= ${"sapi_total_$hari"} ?> <!-- Sudah dalam bentuk campuran dari controller -->
                                </th>
                                <th colspan="2" class="text-center">
                                    <?= ${"kambing_bumm_$hari"} + ${"kambing_mandiri_$hari"} ?>
                                </th>
                                <th colspan="3"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>

</main>
<!--end::App Main-->