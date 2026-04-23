<!DOCTYPE html>
<html>

<head>
    <title>Login Qurban</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?= base_url('adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('adminlte/css/css/adminlte.min.css') ?>">
</head>

<body class="hold-transition login-page">

    <div class="register-box px-3" style="width: 100%; max-width: 420px; margin-top: 2rem; margin-bottom: 2rem;">
        <div class="card shadow-lg border-0 rounded-4">

            <!-- HEADER -->
            <div class="card-header text-center bg-white border-0 pt-4">
                <img src="<?= base_url('logo.png') ?>" style="width:90px;" class="mb-2">
            </div>

            <!-- BODY -->
            <div class="card-body px-4 pb-4">
                <p class="text-center text-muted mb-4">
                    Pendaftaran Akun Cabang
                </p>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger py-2 small">
                        <i class="fas fa-exclamation-circle me-1"></i> <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger py-2 small">
                        <ul class="mb-0 ps-3">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="" method="post">
                    <?= csrf_field() ?>

                    <!-- CABANG -->
                    <div class="form-group mb-3">
                        <label class="fw-semibold">Cabang</label>
                        <select class="form-control form-control-lg" name="cabang_id" required>
                            <option value="" disabled selected>-- Pilih Cabang --</option>
                            <option value="9999">Bumm</option>
                            <?php foreach ($cabang as $c): ?>
                                <option value="<?= $c['id'] ?>">
                                    <?= $c['nama_cabang'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- NAMA -->
                    <div class="input-group mb-3">
                        <input type="text" name="nama" class="form-control form-control-lg" placeholder="Nama Lengkap" required>
                        <div class="input-group-text bg-light">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>

                    <!-- USERNAME / EMAIL -->
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control form-control-lg" placeholder="username" pattern="^\S+$" title="Username tidak boleh mengandung spasi" required>
                        <div class="input-group-text bg-light">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>

                    <!-- PASSWORD -->
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="password" required>
                        <div class="input-group-text bg-light">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>

                    <!-- KODE AKSES -->
                    <div class="input-group mb-3">
                        <input type="password" name="access_code" class="form-control form-control-lg" placeholder="Kode Akses Pendaftaran" required>
                        <div class="input-group-text bg-light">
                            <i class="fas fa-key"></i>
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">
                        <i class="fas fa-user-plus me-1"></i> Daftar Sekarang
                    </button>
                </form>

                <!-- LOGIN LINK -->
                <div class="text-center mt-3">
                    <small>
                        Sudah punya akun?
                        <a href="<?= base_url('login') ?>" class="fw-semibold">
                            Login di sini
                        </a>
                    </small>
                </div>
                <div class="mt-3">
                    <h5 class="fw-bold mb-3">Petunjuk Pengisian</h5>
                    <ul class="small text-muted ps-3">
                        <li class="mb-2">Daftar akun dengan memilih cabang, dan mengisi nama</li>
                        <li class="mb-2">Mengisi username dan pasword (bebas sesuai keinginan) besar kecil huruf pengaruh mohon diperhatikan</li>
                        <li class="mb-2">Kode akses silahkan hubungi Sekretariat Panitia Qurban</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <script src="<?= base_url('adminlte/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('adminlte/dist/js/adminlte.min.js') ?>"></script>

</body>

</html>