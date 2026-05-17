<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<main class="app-main">
    <div class="app-content-header py-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold mb-0">Manajemen Umum</h4>
                    <small class="text-muted">Pengaturan umum</small>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <!-- Notifikasi Success/Error -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

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

                        <!-- Kode akses pendaftaran user -->
                        <div class="table-responsive mb-4">
                            <h6>Kode Akses Pendaftaran</h6>
                            <table class="table table-bordered table-sm">
                                <tbody>
                                    <tr>
                                        <td><?= $setting['access_password']; ?></td>
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
                                    <?= csrf_field() ?>
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
                                            'access_password' => 'Kode Akses Pendaftaran',
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
                                                <option value="">Pilih Status</option>
                                                <option value="Sementara" <?= $setting['jadwal'] == 'Sementara' ? 'selected' : '' ?>>Sementara</option>
                                                <option value="Final" <?= $setting['jadwal'] == 'Final' ? 'selected' : '' ?>>Final</option>
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
</main>

<?= $this->endSection() ?>