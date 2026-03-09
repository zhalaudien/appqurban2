<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Profil Cabang</h3>
    </div>
    <div class="card-body">
        <strong><?= esc($profil['nama_cabang']) ?></strong><br>
        <?= esc($profil['alamat'] ?? '-') ?>
    </div>
</div>

<!-- INFO BOX -->
<div class="row">

    <div class="col-md-4">
        <div class="info-box bg-info">
            <span class="info-box-icon"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Pequrban</span>
                <span class="info-box-number"><?= $totalPequrban ?></span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="info-box bg-success">
            <span class="info-box-icon"><i class="fas fa-cow"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Sapi</span>
                <span class="info-box-number"><?= $totalSapi ?></span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="info-box bg-warning">
            <span class="info-box-icon"><i class="fas fa-horse"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Kambing</span>
                <span class="info-box-number"><?= $totalKambing ?></span>
            </div>
        </div>
    </div>

</div>

<!-- SUMBER HEWAN -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Sumber Hewan Qurban</h3>
    </div>
    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item">
                Mandiri
                <span class="badge badge-success float-right"><?= $mandiri ?></span>
            </li>
            <li class="list-group-item">
                BUMM
                <span class="badge badge-primary float-right"><?= $bumm ?></span>
            </li>
        </ul>
    </div>
</div>

<?= $this->endSection() ?>