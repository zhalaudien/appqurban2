<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputdata">Input Data</button>
                    <a href="/qurban/export" class="btn btn-success">Export Excel</a>
                </div>

                <!-- Modal Input Data -->
                <div class="modal fade" id="inputdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Input Data Qurban Cabang</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/qurban/tambah" method="post">
                                    <div class="mb-3">
                                        <label for="cabang" class="form-label">Cabang</label>
                                        <select class="form-select" name="cabang">
                                            <?php if ($viewcabang): ?>
                                                <?php foreach ($viewcabang as $cabang): ?>
                                                    <option value="<?php echo $cabang['cabang']; ?>"><?php echo $cabang['cabang']; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3"><label class="form-label">Sapi BUMM</label><input type="text" class="form-control" name="sapi_bumm"></div>
                                    <div class="mb-3"><label class="form-label">Sapi BUMM Orang</label><input type="text" class="form-control" name="sapib_bumm"></div>
                                    <div class="mb-3"><label class="form-label">Kambing BUMM</label><input type="text" class="form-control" name="kambing_bumm"></div>
                                    <div class="mb-3"><label class="form-label">Sapi Mandiri</label><input type="text" class="form-control" name="sapi_mandiri"></div>
                                    <div class="mb-3"><label class="form-label">Kambing Mandiri</label><input type="text" class="form-control" name="kambing_mandiri"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal Input Data -->
            </div>
        </div>
    </div>

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row my-3">
                        <div class="col-md">
                            <table id="datatablesSimple" class="table table-striped table-responsive table-hover text-left" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Cabang</th>
                                        <th>Sapi BUMM</th>
                                        <th>Sapi BUMM Orang</th>
                                        <th>Kambing BUMM</th>
                                        <th>Sapi Mandiri</th>
                                        <th>Kambing Mandiri</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php if ($qurban): ?>
                                        <?php foreach ($qurban as $cabang): ?>
                                            <tr class="align-middle">
                                                <td><?= $no++; ?></td>
                                                <td><?= $cabang['cabang']; ?></td>
                                                <td><?= $cabang['sapi_bumm']; ?></td>
                                                <td><?= $cabang['sapib_bumm']; ?></td>
                                                <td><?= $cabang['kambing_bumm']; ?></td>
                                                <td><?= $cabang['sapi_mandiri']; ?></td>
                                                <td><?= $cabang['kambing_mandiri']; ?></td>
                                                <td>
                                                    <div class="btn-group-sm mb-2" role="group">
                                                        <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $cabang['id']; ?>">Edit</a>
                                                        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusdata<?= $cabang['id']; ?>">Hapus</a>
                                                    </div>
                                                    <!-- Modal Edit -->
                                                    <div class="modal fade" id="edit<?= $cabang['id']; ?>" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <form action="<?= site_url('/qurban/edit') ?>" method="post">
                                                                        <input type="hidden" name="id" value="<?= $cabang['id']; ?>">
                                                                        <div class="mb-3"><label class="form-label">Cabang</label><input type="text" class="form-control" name="cabang" value="<?= $cabang['cabang']; ?>" disabled></div>
                                                                        <div class="mb-3"><label class="form-label">Sapi BUMM</label><input type="text" class="form-control" name="sapi_bumm" value="<?= $cabang['sapi_bumm']; ?>"></div>
                                                                        <div class="mb-3"><label class="form-label">Sapi BUMM Orang</label><input type="text" class="form-control" name="sapib_bumm" value="<?= $cabang['sapib_bumm']; ?>"></div>
                                                                        <div class="mb-3"><label class="form-label">Kambing BUMM</label><input type="text" class="form-control" name="kambing_bumm" value="<?= $cabang['kambing_bumm']; ?>"></div>
                                                                        <div class="mb-3"><label class="form-label">Sapi Cabang</label><input type="text" class="form-control" name="sapi_mandiri" value="<?= $cabang['sapi_mandiri']; ?>"></div>
                                                                        <div class="mb-3"><label class="form-label">Kambing Cabang</label><input type="text" class="form-control" name="kambing_mandiri" value="<?= $cabang['kambing_mandiri']; ?>"></div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <button class="btn btn-primary">Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Hapus -->
                                                    <div class="modal fade" id="hapusdata<?= $cabang['id']; ?>" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <h2>Apakah anda yakin?</h2>
                                                                    <p>Menghapus data <?= $cabang['cabang']; ?></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                                                                    <a href="<?= base_url('/qurban/hapus/' . $cabang['id']) ?>" class="btn btn-danger">Hapus</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!--end::App Main-->