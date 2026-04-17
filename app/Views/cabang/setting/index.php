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

    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline shadow-sm">
                <div class="card-header">
                    <h3 class="card-title fw-bold"><i class="bi bi-gear-fill me-2"></i> Pengaturan Profil Cabang</h3>
                </div>

                <form action="<?= base_url('cabang/setting/update') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= $profil['id'] ?? '' ?>">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label">Alamat Lengkap Cabang</label>
                                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap kantor cabang..."><?= esc($profil['alamat'] ?? '') ?></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Ketua Cabang</label>
                                <input type="text" name="ketua" class="form-control" value="<?= esc($profil['ketua'] ?? '') ?>" placeholder="Nama lengkap ketua">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. HP Ketua Cabang</label>
                                <input type="text" name="ketua_hp" class="form-control" value="<?= esc($profil['ketua_hp'] ?? '') ?>" placeholder="Contoh: 081234567xxx">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Ketua Panitia Qurban</label>
                                <input type="text" name="panitia_nama" class="form-control" value="<?= esc($profil['panitia_nama'] ?? '') ?>" placeholder="Nama ketua panitia">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. HP Ketua Panitia</label>
                                <input type="text" name="panitia_hp" class="form-control" value="<?= esc($profil['panitia_hp'] ?? '') ?>" placeholder="No hp aktif">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama IT Panitia Qurban</label>
                                <input type="text" name="it_nama" class="form-control" value="<?= esc($profil['it_nama'] ?? '') ?>" placeholder="Nama ketua panitia">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. HP IT Panitia</label>
                                <input type="text" name="it_hp" class="form-control" value="<?= esc($profil['it_hp'] ?? '') ?>" placeholder="No hp aktif">
                            </div>

                            <div class="col-12 mb-4">
                                <label class="form-label">Perwakilan</label>
                                <input type="text" name="perwakilan" class="form-control" value="<?= esc($profil['perwakilan'] ?? '') ?>" placeholder="perwakilan">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" value="<?= esc($user['username'] ?? '') ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Pengguna</label>
                                <input type="text" name="nama_user" class="form-control" value="<?= esc($user['nama'] ?? '') ?>" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Password Baru</label>
                                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                                <small class="text-muted">Isi hanya jika ingin mengganti password login Anda.</small>
                            </div>
                        </div>
                    </div>


                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-light">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Petunjuk Pengisian</h5>
                    <ul class="small text-muted ps-3">
                        <li class="mb-2">Pastikan nomor handphone yang dimasukkan adalah nomor aktif (WhatsApp) untuk memudahkan koordinasi antar cabang dan pusat.</li>
                        <li class="mb-2">Alamat lengkap akan digunakan sebagai data referensi pengiriman logistik jika diperlukan.</li>
                        <li>Jangan lupa klik <strong>Simpan Perubahan</strong> setelah melakukan pembaruan data.</li>
                    </ul>
                </div>
            </div>

            <?php if (isset($profil['updated_at'])): ?>
                <div class="text-center mt-3">
                    <small class="text-muted italic">Terakhir diperbarui: <?= date('d M Y H:i', strtotime($profil['updated_at'])) ?></small>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>



<?= $this->endSection() ?>