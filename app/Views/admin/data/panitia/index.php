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
                                                <a href="/panitia/edit/<?= $p['id']; ?>"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <a href="/panitia/hapus/<?= $p['id']; ?>"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </a>
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

</main>

<?= $this->endSection() ?>