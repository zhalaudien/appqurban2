<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<main class="app-main">

    <!-- Header -->
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">

                <div>
                    <h4 class="fw-bold mb-0">Data Panitia</h4>
                    <small class="text-muted">Manajemen data panitia qurban</small>
                </div>

                <div class="d-flex gap-6">
                    <button type="button" class="btn btn-primary shadow-sm"
                        data-bs-toggle="modal" data-bs-target="#inputdata">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </button>

                    <a href="/panitia/export" class="btn btn-success shadow-sm">
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

                    <div class="table-responsive">
                        <table id="datatablesSimple"
                            class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama</th>
                                    <th>Cabang</th>
                                    <th>No HP</th>
                                    <th>Seksi</th>
                                    <th>Jabatan</th>
                                    <th width="15%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php if ($viewpanitia): ?>
                                    <?php foreach ($viewpanitia as $p): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td class="fw-semibold"><?= esc($p['nama']); ?></td>
                                            <td><?= esc($p['nama_cabang']); ?></td>
                                            <td><?= esc($p['no_hp']); ?></td>
                                            <td><?= esc($p['nama_seksi']); ?></td>
                                            <td>
                                                <?php if ($p['jabatan'] == 'koordinator'): ?>
                                                    <span class="badge bg-warning text-dark">
                                                        Koordinator
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">
                                                        Anggota
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal<?= $p['id']; ?>">
                                                    <i class="bi bi-pencil"></i>
                                                </button>

                                                <a href="/panitia/delete/<?= $p['id']; ?>"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal<?= $p['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $p['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel<?= $p['id']; ?>">Edit Data Panitia</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="/panitia/update/<?= $p['id']; ?>" method="post">
                                                        <?= csrf_field(); ?>
                                                        <div class="modal-body text-start">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama</label>
                                                                <input type="text" name="nama" class="form-control" value="<?= esc($p['nama']); ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Cabang</label>
                                                                <select name="cabang_id" class="form-select" required>
                                                                    <?php foreach ($viewcabang as $c): ?>
                                                                        <option value="<?= $c['id']; ?>" <?= (int)$p['cabang_id'] === (int)$c['id'] ? 'selected' : ''; ?>>
                                                                            <?= esc($c['nama_cabang']); ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">No HP</label>
                                                                <input type="text" name="no_hp" class="form-control" value="<?= esc($p['no_hp']); ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Seksi</label>
                                                                <select name="seksi_id" class="form-select" required>
                                                                    <?php foreach ($idpanitia as $seksi): ?>
                                                                        <option value="<?= $seksi['id']; ?>" <?= (int)$p['seksi_id'] === (int)$seksi['id'] ? 'selected' : ''; ?>>
                                                                            <?= esc($seksi['nama_seksi']); ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Jabatan</label>
                                                                <select name="jabatan" class="form-select" required>
                                                                    <option value="anggota" <?= (trim(strtolower($p['jabatan'] ?? '')) == 'anggota') ? 'selected' : ''; ?>>Anggota</option>
                                                                    <option value="koordinator" <?= (trim(strtolower($p['jabatan'] ?? '')) == 'koordinator') ? 'selected' : ''; ?>>Koordinator</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
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
                    <h5 class="modal-title" id="inputdataLabel">Tambah Data Panitia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/panitia/create" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body text-start">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama lengkap panitia" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cabang</label>
                            <select name="cabang_id" class="form-select" required>
                                <option value="" selected disabled>Pilih Cabang</option>
                                <?php foreach ($viewcabang as $c): ?>
                                    <option value="<?= $c['id']; ?>"><?= esc($c['nama_cabang']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No HP</label>
                            <input type="text" name="no_hp" class="form-control" placeholder="Contoh: 08123456789">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Seksi</label>
                            <select name="seksi_id" class="form-select" required>
                                <option value="" selected disabled>Pilih Seksi</option>
                                <?php foreach ($idpanitia as $seksi): ?>
                                    <option value="<?= $seksi['id']; ?>"><?= esc($seksi['nama_seksi']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <select name="jabatan" class="form-select" required>
                                <option value="anggota">Anggota</option>
                                <option value="koordinator">Koordinator</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>

<?= $this->endSection() ?>