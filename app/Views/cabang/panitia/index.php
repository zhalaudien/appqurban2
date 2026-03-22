<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- ================= ALERT ================= -->
    <?php foreach (['success' => 'success', 'error' => 'danger'] as $key => $type): ?>
        <?php if (session()->getFlashdata($key)): ?>
            <div class="alert alert-<?= $type ?> alert-dismissible fade show">
                <?= session()->getFlashdata($key) ?>
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>


    <!-- ================= FORM INPUT ================= -->
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Input Panitia</h3>
        </div>

        <form method="post" action="<?= base_url('cabang/panitia/store') ?>">
            <?= csrf_field() ?>

            <div class="card-body">

                <div class="row">
                    <div class="col-md-4">
                        <label>Nama</label>
                        <input name="nama" class="form-control" required>
                    </div>

                    <div class="col-md-2">
                        <label>No. HP</label>
                        <input name="no_hp" class="form-control" required>
                    </div>

                    <div class="col-md-2">
                        <label>Seksi</label>
                        <select name="seksi_id" class="form-control">
                            <?php foreach ($seksi as $s): ?>
                                <option value="<?= $s['id'] ?>"><?= esc($s['nama_seksi']) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label>Jabatan</label>
                        <select name="jabatan" class="form-control">
                            <option value="koordinator">Koordinator</option>
                            <option value="anggota">Anggota</option>
                        </select>
                    </div>

                    <div class="col-md-1 d-flex align-items-end">
                        <button class="btn btn-success btn-block">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex gap-2">

        </div>

       
        <div class="d-flex gap-2">

        
            <a href="<?= base_url('cabang/pequrban/template') ?>"
                class="btn btn-secondary">
                <i class="bi bi-download"></i> Template
            </a>


            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importExcel">
                <i class="bi bi-upload"></i> Import
            </button>

            
            <a href="<?= base_url('cabang/pequrban/export') ?>"
                class="btn btn-success">
                <i class="bi bi-file-earmark-excel"></i> Export
            </a>

        </div>

        <div class="modal fade" id="importExcel">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form action="<?= base_url('cabang/pequrban/import') ?>" method="post" enctype="multipart/form-data">

                        <div class="modal-header">
                            <h5 class="modal-title">Import Pequrban</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Upload File Excel</label>
                                <input type="file" name="file_excel" class="form-control" accept=".xls,.xlsx" required>
                            </div>

                            <small class="text-muted">
                                Gunakan template agar format sesuai.
                            </small>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary">Import</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
    -->

    <!-- ================= DATA TABLE ================= -->
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">
                Data Panitia cabang
            </h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table id="datatablesSimple"
                    class="table table-bordered table-hover table-striped align-middle">

                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama</th>
                            <th>No. HP</th>
                            <th>Seksi</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1;
                        foreach ($panitia as $p): ?>
                            <tr>

                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= esc($p['nama']) ?> </td>
                                <td><?= esc($p['no_hp']) ?> </td>
                                <td><?= esc($p['nama_seksi']) ?> </td>
                                <td><?= esc($p['jabatan']) ?> </td>
                                <td class="text-center">

                                    <button class="btn btn-warning btn-sm"
                                        data-toggle="modal"
                                        data-target="#edit<?= $p['id'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button class="btn btn-danger btn-sm"
                                        data-toggle="modal"
                                        data-target="#delete<?= $p['id'] ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </td>

                            </tr>
                        <?php endforeach ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>

</div>



<!-- ================= MODALS (DIPINDAH KE LUAR TABLE) ================= -->

<?php foreach ($panitia as $p): ?>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="edit<?= $p['id'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= base_url('cabang/panitia/update/' . $p['id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Panitia</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama"
                                value="<?= esc($p['nama']) ?>"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>No. HP</label>
                            <input type="text" name="no_hp"
                                value="<?= esc($p['no_hp']) ?>"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Seksi</label>
                            <select name="seksi_id" class="form-control" required>
                                <option value="">Pilih Seksi</option>
                                <?php foreach ($seksi as $s): ?>
                                    <option value="<?= $s['id'] ?>" <?= $p['seksi_id'] == $s['id'] ? 'selected' : '' ?>>
                                        <?= esc($s['nama_seksi']) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <select name="jabatan" class="form-control" required>
                                <option value="koordinator" <?= $p['jabatan'] == 'koordinator' ? 'selected' : '' ?>>Koordinator</option>
                                <option value="anggota" <?= $p['jabatan'] == 'anggota' ? 'selected' : '' ?>>Anggota</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary btn-block">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- DELETE MODAL -->
    <div class="modal fade" id="delete<?= $p['id'] ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content text-center">

                <form action="<?= base_url('cabang/panitia/delete/' . $p['id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="modal-body">
                        <p>Yakin hapus:</p>
                        <strong><?= esc($p['nama']) ?></strong>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Batal</button>
                        <button class="btn btn-danger">Hapus</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

<?php endforeach; ?>

<?= $this->endSection() ?>