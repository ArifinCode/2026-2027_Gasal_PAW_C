<?php
// koneksi ke database penjualan
$host = "localhost";
$user = "root";
$pass = "";
$db   = "penjualan";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

function format_tanggal($tgl)
{
    return date("d/m/Y", strtotime($tgl));
}

function format_rupiah($angka)
{
    return "Rp " . number_format($angka, 0, ",", ".");
}
?>
