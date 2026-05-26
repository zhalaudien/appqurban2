<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Jalan Qurban</title>

    <style>
        @page {
            size: F4 portrait;
            margin: 15mm;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 210mm;
            min-height: 330mm;
            margin: auto;
            padding: 10mm;
            box-sizing: border-box;
            page-break-after: always;
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
            line-height: 1.7;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
            font-size: 14px;
        }

        table th {
            text-align: center;
        }

        .signature {
            width: 300px;
            margin-left: auto;
            margin-top: 40px;
            text-align: center;
        }

        .signature-space {
            height: 70px;
        }

        .arabic {
            font-size: 18px;
            text-align: right;
            direction: rtl;
            margin: 10px 0;
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

        @media print {
            .page {
                margin: 0;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>

    <!-- HALAMAN 1 -->
    <div class="page">

        <div class="header">
            <h2>YAYASAN MAJLIS TAFSIR AL QUR’AN</h2>
            <h3>PANITIA QURBAN PUSAT 7</h3>
            <p>Sekretariat: Dk. Mentir RT 07, Bener, Ngrampal, Sragen</p>
        </div>

        <div class="title">
            SURAT JALAN QURBAN
        </div>

        <div class="content">

            <p>
                Kepada Yth.<br>
                Ketua Cabang <strong><?= $cabang ?></strong><br>
                Di Tempat.
            </p>

            <div class="arabic">
                السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ
            </div>

            <p>
                Dengan hormat.
            </p>

            <p>
                Bersama ini kami kirimkan daging qurban dari Yayasan Majlis Tafsir Al-Qur'an (MTA) Pusat
                untuk disampaikan kepada yang berhak menerima:
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
                        <td>M</td>
                        <td><?= $a ?></td>
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
                Demikian untuk dapat dipergunakan dengan sebaik-baiknya.
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

        <div class="header">
            <h2>YAYASAN MAJLIS TAFSIR AL QUR’AN</h2>
            <h3>PANITIA QURBAN PUSAT 7</h3>
            <p>Sekretariat: Dk. Mentir RT 07, Bener, Ngrampal, Sragen</p>
        </div>

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
                        <td>M</td>
                        <td><?= $a ?></td>
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

                <strong>(<?= $cabang ?>)</strong>
            </div>

        </div>

    </div>

</body>

</html>