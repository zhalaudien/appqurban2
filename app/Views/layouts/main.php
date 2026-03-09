<?= $this->include('layouts/header') ?>

<div class="wrapper">

    <?= $this->include('layouts/navbar') ?>
    <?= $this->include('layouts/sidebar') ?>

    <div class="content-wrapper">
        <section class="content pt-3">
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </section>
    </div>

    <?= $this->include('layouts/footer') ?>

</div>

<?= $this->include('layouts/scripts') ?>

</body>

</html>