<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<main class="app-main">

    <!-- Header -->
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">

                <div>
                    <h4 class="fw-bold mb-0">Data Muspika</h4>
                    <small class="text-muted">Manajemen data Muspika</small>
                </div>

                <div class="d-flex gap-6">
                    <button type="button" class="btn btn-primary shadow-sm"
                        data-bs-toggle="modal" data-bs-target="#inputdata">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </button>

                    <a href="<?= base_url('muspika/export') ?>" class="btn btn-success shadow-sm">
                        <i class="bi bi-file-earmark-excel"></i> Export Excel
                    </a>
                </div>

            </div>
        </div>
    </div>
    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <!-- Flash Messages -->
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table id="datatablesSimple"
                            class="table table-hover align-middle"
                            style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 5%">No</th>
                                    <th>Nama</th>
                                    <th>Dinas</th>
                                    <th>Koordinator</th>
                                    <th class="text-center" style="width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php if ($viewmuspika): ?>
                                    <?php foreach ($viewmuspika as $muspika): ?>
                                        <tr>
                                            <td class="text-center text-muted"><?= $no++; ?></td>
                                            <td class="fw-semibold text-dark"><?= $muspika['nama']; ?></td>
                                            <td><?= $muspika['dinas']; ?></td>
                                            <td><span class="badge bg-info text-dark rounded-pill px-3"><?= $muspika['pj']; ?></span></td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-sm btn-warning shadow-sm" data-bs-toggle="modal"
                                                        data-bs-target="#edit<?= $muspika['id']; ?>" title="Edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger shadow-sm" data-bs-toggle="modal"
                                                        data-bs-target="#hapusdata<?= $muspika['id']; ?>" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="edit<?= $muspika['id']; ?>" tabindex="-1" aria-labelledby="editLabel<?= $muspika['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editLabel<?= $muspika['id']; ?>">Edit Data Muspika</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?= base_url('muspika/update/' . $muspika['id']) ?>" method="post">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama</label>
                                                                <input type="text" class="form-control" name="nama" value="<?= $muspika['nama']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Dinas</label>
                                                                <input type="text" class="form-control" name="dinas" value="<?= $muspika['dinas']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Penanggung Jawab</label>
                                                                <input type="text" class="form-control" name="pj" value="<?= $muspika['pj']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="hapusdata<?= $muspika['id']; ?>" tabindex="-1" aria-labelledby="hapusLabel<?= $muspika['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="hapusLabel<?= $muspika['id']; ?>">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus data Muspika <strong><?= $muspika['nama']; ?></strong> dari dinas <strong><?= $muspika['dinas']; ?></strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('muspika/delete/' . $muspika['id']) ?>" class="btn btn-danger">Hapus Data</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="inputdata" tabindex="-1" aria-labelledby="inputdataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputdataLabel">Tambah Data Muspika</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('muspika/create') ?>" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="mb-3">
                            <label for="dinas" class="form-label">Dinas</label>
                            <input type="text" class="form-control" name="dinas" placeholder="Contoh: POLSEK, KORAMIL">
                        </div>
                        <div class="mb-3">
                            <label for="pj" class="form-label">Penanggung Jawab</label>
                            <input type="text" class="form-control" name="pj" placeholder="Masukkan nama penanggung jawab">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>

<?= $this->endSection() ?>