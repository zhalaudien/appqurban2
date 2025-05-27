<div class="container-fluid mt-4">
    <div class="row g-4">
        <div class="col-lg-6 col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h5 class="card-title">Penerimaan Hewan</h5>
                </div>
                <div class="card-body"><canvas id="chartHewan"></canvas></div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h5 class="card-title">Uang Masuk</h5>
                </div>
                <div class="card-body"><canvas id="chartUang"></canvas></div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h5 class="card-title">Data Besek</h5>
                </div>
                <div class="card-body"><canvas id="chartBesek"></canvas></div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card card-outline card-danger">
                <div class="card-header">
                    <h5 class="card-title">Penyembelihan Hewan</h5>
                </div>
                <div class="card-body"><canvas id="chartPenyembelihan"></canvas></div>
            </div>
        </div>
    </div>
</div>

<script>
    const chartHewan = new Chart(document.getElementById('chartHewan'), {
        type: 'bar',
        data: {
            labels: ['Sapi BUMM', 'Sapi Cabang', 'Kambing BUMM', 'Kambing Cabang'],
            datasets: [{
                label: 'Total Hewan',
                data: [<?= $total_sapi_bumm ?>, <?= $total_sapi_cabang ?>, <?= $total_kambing_bumm ?>, <?= $total_kambing_cabang ?>],
                backgroundColor: ['#3e95cd', '#8e5ea2', '#3cba9f', '#e8c3b9']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Penerimaan Hewan'
                }
            }
        }
    });

    const chartUang = new Chart(document.getElementById('chartUang'), {
        type: 'bar',
        data: {
            labels: ['BUMM', 'Cabang', 'Shadaqoh'],
            datasets: [{
                label: 'Jumlah Uang Masuk',
                data: [<?= $uang_bumm ?>, <?= $uang_cabang ?>, <?= $shadaqoh ?>],
                backgroundColor: ['#ff6384', '#36a2eb', '#ffcd56']
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Sumber Uang Masuk'
                }
            }
        }
    });

    const chartBesek = new Chart(document.getElementById('chartBesek'), {
        type: 'bar',
        data: {
            labels: ['TS', 'TK', 'OS', 'M', 'OK'],
            datasets: [{
                    label: 'Produksi',
                    data: [<?= $ts ?>, <?= $tk ?>, <?= $os ?>, <?= $a ?>, <?= $ok ?>],
                    backgroundColor: '#4caf50'
                },
                {
                    label: 'Keluar',
                    data: [<?= $t_ts ?>, <?= $t_tk ?>, <?= $t_os ?>, <?= $t_a ?>, <?= $t_ok ?>],
                    backgroundColor: '#f44336'
                }
            ]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Data Besek (Produksi vs Keluar)'
                }
            },
            responsive: true
        }
    });

    const chartPenyembelihan = new Chart(document.getElementById('chartPenyembelihan'), {
        type: 'bar',
        data: {
            labels: ['Sapi', 'Kambing'],
            datasets: [{
                    label: 'Masuk',
                    data: [<?= $total_sapi ?>, <?= $total_kambing ?>],
                    backgroundColor: '#2196f3'
                },
                {
                    label: 'Disembelih',
                    data: [<?= $disembelih_sapi ?>, <?= $disembelih_kambing ?>],
                    backgroundColor: '#ff9800'
                }
            ]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Status Penyembelihan'
                }
            },
            responsive: true
        }
    });
</script>