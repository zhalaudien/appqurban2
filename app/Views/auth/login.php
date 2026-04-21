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
                    Silahkan Login
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

                <form action="<?= base_url('login') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">
                        <i class="fas fa-user me-1"></i> Login
                    </button>
                </form>

                <!-- LOGIN LINK -->
                <div class="text-center mt-3">
                    <small>
                        Belum punya akun?
                        <a href="<?= base_url('register') ?>" class="fw-semibold">
                            Daftar di sini
                        </a>
                    </small>
                </div>
            </div>

        </div>
    </div>


    <script src="<?= base_url('adminlte/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('adminlte/dist/js/adminlte.min.js') ?>"></script>

</body>

</html>