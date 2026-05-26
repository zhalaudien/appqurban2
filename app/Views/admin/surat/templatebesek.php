<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Jalan Qurban</title>

    <style>
        @page {
            size: F4 portrait;
            margin: 10mm;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 16px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 210mm;
            min-height: 330mm;
            margin: auto;
            background: #fff;
            padding: 10mm 10mm;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            page-break-after: always;
        }

        .page:last-child {
            page-break-after: avoid;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h2,
        .header h3,
        .header p {
            margin: 0;
            line-height: 1.3;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            margin: 15px 0;
            text-decoration: underline;
        }

        .content {
            margin-top: 20px;
            font-size: 16px;
            line-height: 1.7;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px 12px;
            font-size: 16px;
        }

        table th {
            text-align: center;
        }

        .signature {
            width: 350px;
            margin-left: auto;
            margin-top: 40px;
            text-align: center;
        }

        .signature-space {
            height: 70px;
        }

        .arabic {
            font-size: 22px;
            direction: rtl;
            text-align: center;
            margin: 15px 0;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .text-center {
            text-align: center;
        }

        .no-border td {
            border: none;
            padding: 3px;
        }

        /* Gaya Tombol Aksi */
        .btn-print {
            display: inline-block;
            padding: 10px 20px;
            background: #198754;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            font-family: Arial, sans-serif;
            margin: 5px;
        }

        .btn-print:hover {
            background: #157347;
        }

        .btn-warning {
            display: inline-block;
            padding: 10px 20px;
            background: #ffc107;
            color: #000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            margin: 5px;
            font-family: Arial, sans-serif;
        }

        .btn-warning:hover {
            background: #eab000;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            .page {
                margin: 0;
                box-shadow: none;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="text-center no-print mb-3" style="padding: 20px 0; background: #f8f9fa; border-bottom: 1px solid #ddd;">
        <button class="btn-print" onclick="window.print()">
            🖨 Print Surat Kirim Besek
        </button>
        <button class="btn-warning" onclick="downloadPDF()">
            📄 Download PDF
        </button>
    </div>

    <div id="print-content">
        <!-- HALAMAN 1 -->
        <div class="page">

            <div class="header text-center">
                <!-- Pastikan kopsurat.png sudah Anda letakkan di folder /public/ -->
                <img src="<?= base_url('kopsurat.png') ?>" alt="Kop Surat">
            </div>

            <div class="title">
                SURAT JALAN QURBAN
            </div>

            <div class="content">

                <p>
                    Nomor : ....../Pusat-7/Q/<?= date('Y') ?><br>
                    Lampiran : -<br>
                    Hal : <strong>Pengiriman Daging Qurban</strong><br><br>
                    Kepada Yth. Ketua Cabang MTA <strong><?= $cabang ?></strong><br>
                    Di Tempat.
                </p>

                <div class="arabic">
                    السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ
                </div>

                <p>
                    Puji syukur kehadirat Allah SWT atas segala limpahan rahmat dan hidayah-Nya kepada kita semua.
                </p>

                <p>
                    Bersama ini kami kirimkan paket daging qurban dari Yayasan Majlis Tafsir Al-Qur'an (MTA) Pusat untuk disampaikan kepada yang berhak menerima dengan rincian sebagai berikut:
                </p>

                <table>
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Jenis</th>
                            <th width="30%">Jumlah</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td>TS</td>
                            <td><?= $ts ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">2</td>
                            <td>TK</td>
                            <td><?= $tk ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">3</td>
                            <td>A</td>
                            <td><?= $a ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">3</td>
                            <td>M</td>
                            <td><?= $m ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">4</td>
                            <td>OS</td>
                            <td><?= $os ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">5</td>
                            <td>OK</td>
                            <td><?= $ok ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">6</td>
                            <td>Kepala Sapi</td>
                            <td><?= $ks ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">7</td>
                            <td>Kaki Sapi</td>
                            <td><?= $kks ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">8</td>
                            <td>Kulit Sapi</td>
                            <td><?= $kls ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">9</td>
                            <td>Kepala Kambing</td>
                            <td><?= $kb ?></td>
                        </tr>
                    </tbody>
                </table>

                <p class="mt-20">
                    Demikian surat jalan ini kami sampaikan untuk dapat dipergunakan dan dilaksanakan dengan sebaik-baiknya. Atas perhatian dan kerjasamanya kami ucapkan terima kasih.
                </p>

                <div class="arabic">
                    وَالسَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ
                </div>

                <div class="signature">
                    <p>Surakarta, <?= $date ?></p>

                    <div class="signature-space"></div>

                    <strong>(Drs Irfan)</strong>
                </div>

            </div>

        </div>


        <!-- HALAMAN 2 -->
        <div class="page">

            <div class="title">
                TANDA TERIMA
            </div>

            <div class="content">

                <p>
                    Dari : Ketua MTA Cabang <strong><?= $cabang ?></strong>
                </p>

                <p>
                    Telah diterima dari Panitia Pelaksana Qurban MTA Pusat berupa:
                </p>

                <table>
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Jenis</th>
                            <th width="30%">Jumlah</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td>TS</td>
                            <td><?= $ts ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">2</td>
                            <td>TK</td>
                            <td><?= $tk ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">3</td>
                            <td>A</td>
                            <td><?= $a ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">3</td>
                            <td>M</td>
                            <td><?= $m ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">4</td>
                            <td>OS</td>
                            <td><?= $os ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">5</td>
                            <td>OK</td>
                            <td><?= $ok ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">6</td>
                            <td>Kepala Sapi</td>
                            <td><?= $ks ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">7</td>
                            <td>Kaki Sapi</td>
                            <td><?= $kks ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">8</td>
                            <td>Kulit Sapi</td>
                            <td><?= $kls ?></td>
                        </tr>

                        <tr>
                            <td class="text-center">9</td>
                            <td>Kepala Kambing</td>
                            <td><?= $kb ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="signature">
                    <p>Surakarta, <?= $date ?></p>

                    <div class="signature-space"></div>

                    <strong>( ................................ )</strong>
                    <br>
                    <small>Ketua Cabang <?= $cabang ?></small>
                </div>

            </div>

        </div>
    </div>

    <!-- Library html2pdf.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        function downloadPDF() {
            const element = document.getElementById('print-content');
            const options = {
                margin: 0,
                filename: 'Surat_Jalan_Besek_<?= str_replace([' ', "'", '"'], '_', $cabang) ?>.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true,
                    letterRendering: true
                },
                jsPDF: {
                    unit: 'mm',
                    format: [210, 330], // Ukuran F4 dalam mm
                    orientation: 'portrait'
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                }
            };
            html2pdf().set(options).from(element).save();
        }
    </script>
</body>

</html>