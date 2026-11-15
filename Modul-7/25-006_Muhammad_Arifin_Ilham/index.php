<?php
include 'koneksi.php';

$default = mysqli_query($conn, "SELECT MIN(waktu_transaksi) AS awal, MAX(waktu_transaksi) AS akhir FROM transaksi");
$d = mysqli_fetch_array($default);

$mulai   = isset($_GET['tanggal_mulai'])   ? $_GET['tanggal_mulai']   : $d['awal'];
$selesai = isset($_GET['tanggal_selesai']) ? $_GET['tanggal_selesai'] : $d['akhir'];

$rekap      = array();
$pelanggan_unik      = 0;
$total_pendapatan    = 0;
$adaData  = false;
$error    = "";

if (isset($_GET['tampilkan'])) {

    if ($mulai == "" || $selesai == "") {
        $error = "Tanggal mulai dan tanggal selesai wajib diisi!";
    } elseif ($mulai > $selesai) {
        $error = "Tanggal mulai tidak boleh lebih besar dari tanggal selesai!";
    } else {

        // query rekap penjualan harian (total pendapatan per tanggal)
        $sql = "SELECT waktu_transaksi AS tanggal, SUM(total) AS total_pendapatan
                FROM transaksi
                WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
                GROUP BY waktu_transaksi
                ORDER BY waktu_transaksi ASC";
        $hasil = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($hasil)) {
            $rekap[] = $row;
        }

        $sql2 = "SELECT COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan,
                        SUM(total) AS total_keseluruhan
                 FROM transaksi
                 WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'";
        $hasil2  = mysqli_query($conn, $sql2);
        $ringkas = mysqli_fetch_array($hasil2);

        $pelanggan_unik   = $ringkas['jumlah_pelanggan'];
        $total_pendapatan = $ringkas['total_keseluruhan'];

        if (count($rekap) > 0) {
            $adaData = true;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan Harian</title>
    <!-- chart.js untuk membuat grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            border: 1px solid #ddd;
            padding: 20px;
        }

        h1 {
            font-size: 22px;
            text-align: center;
        }

        /* form filter tanggal */
        .filter {
            padding: 15px;
            background: #eef2f7;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .filter input[type="date"] {
            padding: 6px;
        }

        .btn {
            padding: 8px 15px;
            background: #2c7be5;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-print {
            padding: 8px 15px;
            background: #6c757d;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-excel {
            padding: 8px 15px;
            background: #1e7e34;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-left: 10px;
        }

        /* saat dicetak, sembunyikan tombol dan form filter */
        @media print {
            .filter,
            .btn-print,
            .btn-excel {
                display: none;
            }

            body {
                background: #fff;
                padding: 0;
            }

            .container {
                border: none;
            }
        }

        .error {
            background: #fdecea;
            color: #b3261e;
            padding: 10px;
            border: 1px solid #f3c1bc;
            margin-bottom: 15px;
        }

        .info {
            background: #e8f4fd;
            padding: 10px;
            border: 1px solid #b6d8f2;
            margin-bottom: 15px;
        }

        /* tabel rekap */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        table th {
            background: #dfe6ef;
        }

        .nomor {
            text-align: center;
            width: 60px;
        }

        .angka {
            text-align: right;
        }

        /* card ringkasan di bawah tabel */
        .card {
            width: 45%;
            border: 1px solid #ccc;
            border-left: 5px solid #2c7be5;
            padding: 15px;
            margin: 15px 10px 0 0;
            display: inline-block;
            vertical-align: top;
        }

        .card .judul {
            color: #666;
            font-size: 14px;
        }

        .card .isi {
            font-size: 24px;
            font-weight: bold;
            margin-top: 5px;
        }

        /* grafik */
        .grafik {
            width: 100%;
            height: 350px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Laporan Penjualan Harian</h1>
        <p style="text-align:center; color:#666;">Periode: <?= format_tanggal($mulai); ?> s/d <?= format_tanggal($selesai); ?></p>

        <!-- form filter rentang tanggal -->
        <div class="filter">
            <form method="get" action="">
                <label>Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" value="<?= $mulai; ?>" required>

                <label style="margin-left:15px;">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="<?= $selesai; ?>" required>

                <button type="submit" name="tampilkan" value="1" class="btn" style="margin-left:15px;">Tampilkan</button>
            </form>
        </div>

        <?php if ($error != "") { ?>
            <div class="error"><?= $error; ?></div>
        <?php } elseif (isset($_GET['tampilkan']) && !$adaData) { ?>
            <div class="info">Tidak ada data transaksi pada rentang tanggal ini.</div>
        <?php } ?>

        <?php if ($adaData) { ?>

            <button class="btn-print" onclick="window.print()">Cetak PDF</button>
            <a class="btn-excel" href="export_excel.php?tanggal_mulai=<?= $mulai; ?>&tanggal_selesai=<?= $selesai; ?>">Export Excel</a>

            <div class="grafik">
                <canvas id="grafikPenjualan"></canvas>
            </div>

            <h3>Rekapitulasi Penjualan Harian</h3>
            <table>
                <tr>
                    <th class="nomor">No</th>
                    <th>Total Pendapatan</th>
                    <th>Tanggal Transaksi</th>
                </tr>
                <?php for ($i = 0; $i < count($rekap); $i++) { ?>
                    <tr>
                        <td class="nomor"><?= $i + 1; ?></td>
                        <td class="angka"><?= format_rupiah($rekap[$i]['total_pendapatan']); ?></td>
                        <td><?= format_tanggal($rekap[$i]['tanggal']); ?></td>
                    </tr>
                <?php } ?>
            </table>

            <div>
                <div class="card">
                    <div class="judul">Jumlah Pelanggan Unik</div>
                    <div class="isi"><?= $pelanggan_unik; ?></div>
                </div>
                <div class="card">
                    <div class="judul">Total Pendapatan Keseluruhan</div>
                    <div class="isi"><?= format_rupiah($total_pendapatan); ?></div>
                </div>
            </div>

            <script>
                var labelGrafik = <?= json_encode(array_map(function ($r) {
                                        return format_tanggal($r['tanggal']);
                                    }, $rekap)); ?>;
                var dataGrafik = <?= json_encode(array_map(function ($r) {
                                        return (int)$r['total_pendapatan'];
                                    }, $rekap)); ?>;

                new Chart(document.getElementById("grafikPenjualan"), {
                    type: "bar",
                    data: {
                        labels: labelGrafik,
                        datasets: [{
                            label: "Total Pendapatan (Rp)",
                            data: dataGrafik,
                            backgroundColor: "#2c7be5"
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>

        <?php } ?>
    </div>
</body>
</html>
