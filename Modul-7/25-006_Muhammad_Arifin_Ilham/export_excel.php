<?php
include 'koneksi.php';

$mulai   = $_GET['tanggal_mulai'];
$selesai = $_GET['tanggal_selesai'];

if ($mulai == "" || $selesai == "" || $mulai > $selesai) {
    die("Rentang tanggal tidak valid!");
}

// rekap penjualan harian
$sql = "SELECT waktu_transaksi AS tanggal, SUM(total) AS total_pendapatan
        FROM transaksi
        WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'
        GROUP BY waktu_transaksi
        ORDER BY waktu_transaksi ASC";
$hasil = mysqli_query($conn, $sql);

// ringkasan pelanggan unik dan total pendapatan
$sql2 = "SELECT COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan,
                SUM(total) AS total_keseluruhan
         FROM transaksi
         WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'";
$hasil2   = mysqli_query($conn, $sql2);
$ringkas  = mysqli_fetch_array($hasil2);

// header supaya file ini diunduh sebagai .xls (bisa dibuka Excel)
$namaFile = "rekap_penjualan_" . $mulai . "_sd_" . $selesai . ".xls";
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=" . $namaFile);
header("Pragma: no-cache");
header("Expires: 0");
?>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h3>Rekapitulasi Penjualan Harian</h3>
    <p>Periode: <?= format_tanggal($mulai); ?> s/d <?= format_tanggal($selesai); ?></p>

    <table border="1">
        <tr>
            <th>No</th>
            <th>Total Pendapatan</th>
            <th>Tanggal Transaksi</th>
        </tr>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_array($hasil)) {
        ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $row['total_pendapatan']; ?></td>
                <td><?= format_tanggal($row['tanggal']); ?></td>
            </tr>
        <?php
            $no++;
        }
        ?>
        <!-- baris ringkasan -->
        <tr>
            <td colspan="2"><b>Jumlah Pelanggan Unik</b></td>
            <td><?= $ringkas['jumlah_pelanggan']; ?></td>
        </tr>
        <tr>
            <td colspan="2"><b>Total Pendapatan Keseluruhan</b></td>
            <td><?= $ringkas['total_keseluruhan']; ?></td>
        </tr>
    </table>
</body>
</html>
