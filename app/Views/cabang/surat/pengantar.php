<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Pengantar Qurban Cabang</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 0;
            padding: 20px;
            background: #f1f3f5;
        }

        .page {
            width: 190mm;
            /* Lebar dikurangi agar pas dengan margin PDF (190mm + 10mm kiri + 10mm kanan = 210mm) */
            min-height: 270mm;
            margin: auto;
            background: #fff;
            padding: 10mm 10mm;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .fw-bold {
            font-weight: bold;
        }

        .mb-1 {
            margin-bottom: 4px;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .mb-3 {
            margin-bottom: 12px;
        }

        .mb-4 {
            margin-bottom: 20px;
        }

        .mt-3 {
            margin-top: 12px;
        }

        .mt-4 {
            margin-top: 20px;
        }

        .header {
            /* border-bottom: 3px solid #000; */
            /* Matikan jika gambar sudah menyertakan garis pembatas */
            padding-bottom: 0;
            margin-bottom: 16px;
        }

        .header img {
            width: 100%;
            height: auto;
            display: block;
        }

        .header h1,
        .header h2,
        .header h3,
        .header p {
            margin: 0;
        }

        .header h2 {
            font-size: 18px;
        }

        .header h3 {
            font-size: 15px;
            margin-top: 2px;
        }

        .header p {
            font-size: 11px;
            margin-top: 4px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 12px;
        }

        .info-table td {
            padding: 2px 4px;
            vertical-align: top;
        }

        .info-table td:first-child {
            width: 220px;
        }

        .section-title {
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            margin: 16px 0 10px;
            background: #f2f2f2;
            padding: 6px;
            border: 1px solid #000;
        }

        table.table {
            width: 100%;
            /* Mengurangi sedikit lebar agar garis kanan tidak terpotong di PDF */
            border-collapse: collapse;
            margin-bottom: 14px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 11px;
        }

        /* Mencegah baris tabel terpotong saat pindah halaman */
        .table tr {
            page-break-inside: avoid;
        }

        .table th {
            background: #e9ecef;
            text-align: center;
            font-weight: bold;
        }

        .table td {
            height: 28px;
        }

        .table-sm td,
        .table-sm th {
            padding: 4px;
            font-size: 10px;
        }

        .text-nowrap {
            white-space: nowrap;
        }

        .signature-wrapper {
            width: 100%;
            margin-top: 25px;
        }

        .signature {
            width: 280px;
            float: right;
            text-align: center;
        }

        .signature .ttd-space {
            height: 70px;
        }

        .clearfix::after {
            content: "";
            display: block;
            clear: both;
        }

        .note-box {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 15px;
            font-size: 11px;
        }

        .page-break {
            page-break-before: always;
        }

        /* Mencegah elemen penting terpotong di tengah */
        .section-title,
        .note-box,
        .signature-wrapper,
        .info-table {
            page-break-inside: avoid;
        }

        @media print {
            body {
                background: #fff;
                margin: 0;
                padding: 0;
            }

            .page {
                width: 100%;
                min-height: auto;
                box-shadow: none;
                padding: 10mm;
                margin: 0;
            }

            .no-print {
                display: none !important;
            }

            @page {
                size: A4 portrait;
                margin: 10mm;
            }
        }

        .btn-print {
            display: inline-block;
            padding: 10px 18px;
            background: #198754;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-bottom: 15px;
            font-size: 14px;
            width: 200px;
            height: 40px;
        }

        .btn-print:hover {
            background: #157347;
        }

        .btn-warning {
            display: inline-block;
            padding: 10px 18px;
            background: #ffc107;
            color: #000;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-bottom: 15px;
            font-size: 14px;
            width: 200px;
            height: 40px;
        }

        .btn-warning:hover {
            background: #ffca2c;
        }
    </style>
</head>

<body>

    <div class="text-center no-print mb-3">
        <button class="btn-print" onclick="window.print()">
            🖨 Print Surat Pengantar
        </button>
        <button class="btn-warning" onclick="downloadPDF()">
            📄 Download PDF
        </button>
    </div>

    <div class="page">

        <!-- ================= HEADER ================= -->
        <div class="header text-center">
            <!-- Pastikan kopsurat.png sudah Anda letakkan di folder /public/ -->
            <img src="<?= base_url('kopsurat.png') ?>" alt="Kop Surat">
        </div>

        <!-- ================= INFORMASI CABANG ================= -->
        <table class="info-table">
            <tr>
                <td class="fw-bold">TEMPAT PENYEMBELIHAN</td>
                <td>: PUSAT 7 (NGRAMPAL)</td>
            </tr>

            <tr>
                <td class="fw-bold">CABANG</td>
                <td>: <?= $cabang['nama_cabang'] ?? '-' ?></td>
            </tr>

            <tr>
                <td class="fw-bold">PERWAKILAN</td>
                <td>: <?= $cabang['perwakilan'] ?? '-' ?></td>
            </tr>
        </table>

        <!-- ================= DATA REKAP ================= -->
        <div class="section-title">
            DATA QURBAN TAHUN <?= $tahun_hijriyah ?? '1447 H' ?> /
            <?= $tahun_masehi ?? date('Y') ?> M
        </div>

        <table class="table table-sm">
            <thead>
                <tr>
                    <th colspan="5">PENGIRIMAN KE PUSAT</th>
                </tr>

                <tr>
                    <th>KAMBING<br>CABANG</th>
                    <th>SAPI<br>CABANG</th>
                    <th>KAMBING<br>BUMM</th>
                    <th>SAPI<br>BUMM</th>
                    <th>UANG<br>SHADAQOH</th>
                </tr>
            </thead>

            <tbody>
                <tr class="text-center">
                    <td><?= $rekap['kambing_sendiri'] ?? 0 ?></td>
                    <td><?= $rekap['sapi_sendiri'] ?? 0 ?></td>
                    <td><?= $rekap['kambing_bumm'] ?? 0 ?></td>
                    <td><?= $rekap['sapi_bumm'] ?? 0 ?></td>
                    <td>
                        Rp <?= number_format($rekap['shadaqoh'] ?? 0, 0, ',', '.') ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-sm">
            <thead>
                <tr>
                    <th colspan="11">PERMINTAAN BESEK</th>
                </tr>

                <tr>
                    <th>TS</th>
                    <th>TK</th>
                    <th>A</th>
                    <th>M</th>
                    <th>OS</th>
                    <th>OK</th>
                    <th>KEPALA<br>SAPI</th>
                    <th>KAKI<br>SAPI</th>
                    <th>KULIT<br>SAPI</th>
                    <th>KEPALA<br>KAMBING</th>
                    <th>LAIN-LAIN</th>
                </tr>
            </thead>

            <tbody>
                <tr class="text-center">
                    <td><?= $rekap['ts'] ?? 0 ?></td>
                    <td><?= $rekap['tk'] ?? 0 ?></td>
                    <td><?= $rekap['a'] ?? 0 ?></td>
                    <td><?= $rekap['m'] ?? 0 ?></td>
                    <td><?= $rekap['os'] ?? 0 ?></td>
                    <td><?= $rekap['ok'] ?? 0 ?></td>
                    <td><?= $rekap['ks'] ?? 0 ?></td>
                    <td><?= $rekap['kks'] ?? 0 ?></td>
                    <td><?= $rekap['kls'] ?? 0 ?></td>
                    <td><?= $rekap['kk'] ?? 0 ?></td>
                    <td><?= $rekap['lain'] ?? 0 ?></td>
                </tr>
            </tbody>
        </table>

        <!-- ================= INFORMASI PENYETOR ================= -->
        <table class="info-table">
            <tr>
                <td class="fw-bold">Penyetor Hewan</td>
                <td>: <?= $penyetor['nama'] ?? '-' ?></td>
            </tr>

            <tr>
                <td class="fw-bold">Nomor Telepon</td>
                <td>: <?= $penyetor['telepon'] ?? '-' ?></td>
            </tr>

            <tr>
                <td class="fw-bold">Pimpinan Cabang</td>
                <td>: <?= $penyetor['atas_nama'] ?? '-' ?></td>
            </tr>

            <tr>
                <td class="fw-bold">Nomor Telepon</td>
                <td>: <?= $penyetor['telepon2'] ?? '-' ?></td>
            </tr>
        </table>

        <!-- ================= TANDA TANGAN ================= -->
        <div class="signature-wrapper clearfix">

            <div class="signature">

                <div class="mb-2">
                    <?= $cabang['kota'] ?? '................' ?>,
                    <?= (new \IntlDateFormatter('id_ID', \IntlDateFormatter::LONG, \IntlDateFormatter::NONE))->format(new \DateTime()) ?>
                </div>

                <div class="fw-bold">
                    PIMPINAN CABANG
                </div>

                <div class="ttd-space"></div>

                <div class="fw-bold">
                    <?= $penyetor['atas_nama'] ?? '-' ?>
                </div>

            </div>

        </div>


        <!-- ================= DATA PEQURBAN ================= -->
        <div class="page-break"></div>

        <div class="header text-center">
            <img src="<?= base_url('kopsurat.png') ?>" alt="Kop Surat">
        </div>

        <div class="section-title">
            LAMPIRAN: DATA PEQURBAN CABANG
            <?= $cabang['nama_cabang'] ?? '' ?>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th width="40">No</th>
                    <th>Nama</th>
                    <th width="90">Jenis Hewan</th>
                    <th width="130">Harga Hewan</th>
                    <th width="100">Asal Hewan</th>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($pequrban)) : ?>
                    <?php foreach ($pequrban as $i => $row) : ?>

                        <tr>
                            <td class="text-center">
                                <?= $i + 1 ?>
                            </td>

                            <td>
                                <?= $row['nama'] ?>
                            </td>

                            <td class="text-center">
                                <?= $row['jenis_hewan'] ?>
                            </td>

                            <td class="text-right">
                                Rp <?= number_format($row['biaya'], 0, ',', '.') ?>
                            </td>

                            <td class="text-center">
                                <?= $row['asal_hewan'] ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php else : ?>

                    <?php for ($i = 1; $i <= 15; $i++) : ?>
                        <tr>
                            <td class="text-center"><?= $i ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php endfor; ?>

                <?php endif; ?>

            </tbody>
        </table>

        <!-- ================= CATATAN ================= -->
        <div class="note-box">
            <strong>Catatan:</strong>

            <ul style="margin-top:8px; margin-bottom:0;">
                <li>Mohon data diperiksa kembali sebelum diserahkan ke pusat.</li>
                <li>Pastikan nomor telepon aktif dan mudah dihubungi.</li>
                <li>Dokumen ini dicetak melalui sistem AppQurban V3.</li>
            </ul>
        </div>

    </div>

    <!-- Library html2pdf.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        function downloadPDF() {
            const element = document.querySelector('.page');
            const options = {
                margin: [10, 10, 10, 10], // Margin simetris 10mm di setiap sisi
                filename: 'Surat_Pengantar_<?= str_replace(' ', '_', $cabang['nama_cabang'] ?? 'Cabang') ?>.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 3, // Meningkatkan skala untuk ketajaman garis
                    useCORS: true,
                    letterRendering: true
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                } // Menangani pemotongan halaman secara cerdas
            };

            // Jalankan proses konversi dan download
            html2pdf().set(options).from(element).save();
        }
    </script>

</body>

</html>