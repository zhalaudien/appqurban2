<!DOCTYPE html>
<html>

<head>
    <title>Login Qurban</title>

    <link rel="stylesheet" href="<?= base_url('adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('adminlte/css/css/adminlte.min.css') ?>">
</head>

<body class="hold-transition login-page">

    <div class="register-box" style="max-width: 420px;">
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

                <form action="" method="post">

                    <!-- CABANG -->
                    <div class="form-group mb-3">
                        <label class="fw-semibold">Cabang</label>
                        <select class="form-control" name="cabang_id" required>
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
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                        <div class="input-group-text bg-light">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>

                    <!-- USERNAME / EMAIL -->
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                        <div class="input-group-text bg-light">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>

                    <!-- PASSWORD -->
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-text bg-light">
                            <i class="fas fa-lock"></i>
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
            </div>

        </div>
    </div>

    <?php if (!$hasAccess): ?>
        <div class="modal fade show" id="accessModal" tabindex="-1"
            style="display:block; background: rgba(0,0,0,0.7);">

            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 shadow-lg">

                    <div class="modal-body text-center p-4">
                        <h4 class="fw-bold mb-2">🔐 Akses Pendaftaran</h4>
                        <p class="text-muted mb-3">
                            Masukkan password untuk membuka pendaftaran
                        </p>


                        <form method="post" action="<?= base_url('register/check-access') ?>">
                            <?= csrf_field() ?>

                            <input type="password" name="access_password"
                                class="form-control text-center mb-3"
                                placeholder="Password akses">

                            <button class="btn btn-primary w-100 rounded-pill">
                                Masuk
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    <?php endif; ?>

    <script>
        function checkAccess() {
            let password = document.getElementById('access_password').value;

            fetch("<?= base_url('register/check-access') ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: "<?= csrf_token() ?>=<?= csrf_hash() ?>&access_password=" + encodeURIComponent(password)
                })
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'success') {
                        location.reload();
                    } else {
                        document.getElementById('errorMsg').style.display = 'block';
                    }
                });
        }
    </script>

    <script src="<?= base_url('adminlte/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('adminlte/dist/js/adminlte.min.js') ?>"></script>

</body>

</html>