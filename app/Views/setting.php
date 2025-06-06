<!--begin::App Main-->
<main class="app-main py-3">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-12">
                <div class="card border-primary shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                    </div>
                    <div class="card-body">
                        <?php if ($viewsetting): ?>
                            <?php foreach ($viewsetting as $setting): ?>

                                <!-- Tabel Produksi Besek -->
                                <div class="table-responsive mb-4">
                                    <h6>Perkiraan Produksi Besek</h6>
                                    <table class="table table-bordered table-sm">
                                        <tbody>
                                            <tr>
                                                <td>Kambing</td>
                                                <td><?= $setting['b_kb']; ?> /Ekor</td>
                                            </tr>
                                            <tr>
                                                <td>Sapi</td>
                                                <td><?= $setting['b_sapi']; ?> /Ekor</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Tabel Jadwal Pengiriman -->
                                <div class="table-responsive mb-4">
                                    <h6>Jadwal Pengiriman</h6>
                                    <table class="table table-bordered table-sm">
                                        <tbody>
                                            <tr>
                                                <td>H-1</td>
                                                <td><?= $setting['j_h_1']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>H</td>
                                                <td><?= $setting['j_h']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>H2</td>
                                                <td><?= $setting['j_h2']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>H3</td>
                                                <td><?= $setting['j_h3']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>H4</td>
                                                <td><?= $setting['j_h4']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Tabel Biaya Penyembelihan -->
                                <div class="table-responsive mb-4">
                                    <h6>Biaya Penyembelihan</h6>
                                    <table class="table table-bordered table-sm">
                                        <tbody>
                                            <tr>
                                                <td>Rp. <?= number_format($setting['biaya'], 0, ',', '.'); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Tabel Hari Penyembelihan -->
                                <div class="table-responsive mb-4">
                                    <h6>Seting Hari Penyembelihan</h6>
                                    <table class="table table-bordered table-sm">
                                        <tbody>
                                            <tr>
                                                <td><?= strtoupper($setting['hari']); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Tabel Hari Penyembelihan -->
                                <div class="table-responsive mb-4">
                                    <h6>Seting Status Jadwal</h6>
                                    <table class="table table-bordered table-sm">
                                        <tbody>
                                            <tr>
                                                <td><?= strtoupper($setting['jadwal']); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Tombol Setting -->
                                <div class="mb-3">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $setting['id']; ?>">
                                        Edit Setting
                                    </button>
                                </div>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="edit<?= $setting['id']; ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="<?= site_url('/setting/edit') ?>" method="post" class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Pengaturan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?= $setting['id']; ?>">
                                                <?php
                                                $fields = [
                                                    'b_kb' => 'Besek Kambing',
                                                    'b_sapi' => 'Besek Sapi',
                                                    'j_h_1' => 'Jadwal H-1',
                                                    'j_h' => 'Jadwal H',
                                                    'j_h2' => 'Jadwal H2',
                                                    'j_h3' => 'Jadwal H3',
                                                    'j_h4' => 'Jadwal H4',
                                                    'biaya' => 'Biaya Penyembelihan'
                                                ];
                                                foreach ($fields as $name => $label): ?>
                                                    <div class="mb-3">
                                                        <label for="<?= $name ?>" class="form-label"><?= $label ?></label>
                                                        <input type="text" class="form-control" name="<?= $name ?>" id="<?= $name ?>" value="<?= $setting[$name]; ?>">
                                                    </div>
                                                <?php endforeach; ?>
                                                <div class="mb-3">
                                                    <label for="hari" class="form-label">Seting Hari Penyembelihan</label>
                                                    <select class="form-select" name="hari" id="hari" required>
                                                        <option value="">Pilih Hari</option>
                                                        <?php foreach (['0' => '0', 'h1' => 'H 1', 'h2' => 'H 2', 'h3' => 'H 3', 'h4' => 'H 4'] as $val => $label): ?>
                                                            <option value="<?= $val ?>" <?= $setting['hari'] == $val ? 'selected' : '' ?>><?= $label ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jadwal" class="form-label">Seting Status Jadwal</label>
                                                    <select class="form-select" name="jadwal" id="jadwal" required>
                                                        <option value="">Pilih Hari</option>
                                                        <option value="Sementara">Sementara</option>
                                                        <option value="Final">Final</option>
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
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <div class="col-12 col-lg-12">
                <div class="card border-primary shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                    </div>
                    <div class="card-body">
                        <!-- Tabel Manajemen User -->
                        <div class="table-responsive mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Manajemen User</h6>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahUser">Tambah User</button>
                            </div>
                            <!-- Modal Tambah User -->
                            <div class="modal fade" id="tambahUser" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="<?= site_url('/setting/tambahuser') ?>" method="post" class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nama</label>
                                                <input type="text" class="form-control" name="username" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-bordered table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>Username</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($user)): ?>
                                        <?php foreach ($user as $user): ?>
                                            <tr>
                                                <td><?= $user['username']; ?></td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUser<?= $user['id']; ?>">Edit</button>
                                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusUser<?= $user['id']; ?>">Hapus</button>
                                                </td>
                                            </tr>
                                            <!-- Modal Hapus User -->
                                            <div class="modal fade" id="hapusUser<?= $user['id']; ?>"
                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <p>Yakin ingin menghapus user <strong><?= $user['username']; ?></strong>?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <a href="<?= base_url('/setting/hapususer/' . $user['id']) ?>"
                                                                type="button" class="btn btn-danger">Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Edit User -->
                                            <div class="modal fade" id="editUser<?= $user['id']; ?>"
                                                tabindex=" -1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <form action="<?= site_url('/setting/edituser') ?>" method="post" class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit User</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Username</label>
                                                                        <input type="text" class="form-control" name="username" value="<?= $user['username']; ?>" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Password (Opsional)</label>
                                                                        <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak diubah">
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
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada user.</td>
                                        </tr>
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