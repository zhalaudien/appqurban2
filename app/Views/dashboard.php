<!--begin::App Main-->
<main class="app-main py-3">
    <!--begin::Container-->
    <div class="app-content-header">
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <!-- Penerimaan Hewan -->
                    <div class="col-12 col-lg-6">
                        <div class="card border-info">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0">Penerimaan Hewan</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="chartHewan" class="w-100"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Uang Masuk -->
                    <div class="col-12 col-lg-6">
                        <div class="card border-warning">
                            <div class="card-header bg-warning text-dark">
                                <h6 class="mb-0">Uang Masuk</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="chartUang" class="w-100"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Data Besek -->
                    <div class="col-12 col-lg-6">
                        <div class="card border-success">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0">Data Besek</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="chartBesek" class="w-100"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Penyembelihan Hewan -->
                    <div class="col-12 col-lg-6">
                        <div class="card border-danger">
                            <div class="card-header bg-danger text-white">
                                <h6 class="mb-0">Penyembelihan Hewan</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="chartPenyembelihan" class="w-100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
</main>
<!--end::App Main-->


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