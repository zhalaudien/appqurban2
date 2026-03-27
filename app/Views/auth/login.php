<!DOCTYPE html>
<html>

<head>
    <title>Login Qurban</title>

    <link rel="stylesheet" href="<?= base_url('adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('adminlte/css/css/adminlte.min.css') ?>">
</head>

<body class="hold-transition login-page">

    <div class="login-box">
        <div class="login-logo">
            <div><img src="<?php echo base_url('') ?>logo.png" class="" style="width: 100px; height: auto;" /></div>
            <b>APP Qurban Pusat 7</b>
        </div>

        <div class="card">
            <div class="card-body login-card-body">

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
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

                    <button type="submit" class="btn btn-primary btn-block">
                        Login
                    </button>

                </form>
            </div>
        </div>
    </div>

    <script src="<?= base_url('adminlte/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('adminlte/dist/js/adminlte.min.js') ?>"></script>

</body>

</html>