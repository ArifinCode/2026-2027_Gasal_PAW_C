<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mahasiwa"; // Diperbaiki dari "mahasiwa"

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'tampil';
if ($aksi == 'hapus') {
    // Menggunakan parameter 'nama' sesuai dengan link di bawah
    if (isset($_GET['nama'])) {
        $nama = $_GET['nama'];

        // Menggunakan prepared statement atau mysqli_real_escape_string lebih aman, 
        // namun jika mengikuti struktur Anda:
        $nama_aman = mysqli_real_escape_string($koneksi, $nama);
        $query = "DELETE FROM tbl_mahasiswa WHERE nama='$nama_aman'";

        if (mysqli_query($koneksi, $query)) {
            exit;
        } else {
            echo "Gagal menghapus data: " . mysqli_error($koneksi);
        }
    } else {
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Master Supplier</title>
</head>
<body>

    <h2>Data Master Supplier</h2>

    <table border="1">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama</th>
                <th>nim</th>
                <th>prodi</th>
                <th>jenjang</th>
                <th width="20%">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM tbl_mahasiswa");
            while ($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td style="text-align: center;"><?= $no++; ?></td>
                <td><?= ($data['nama']); ?></td>
                <td><?= ($data['nim']); ?></td> 
                <td><?= ($data['prodi']); ?></td> 
                <td><?= ($data['jenjang']); ?></td>
                <td>
                    <a href="?aksi=hapus&nama=<?= urlencode($data['nama']); ?>" class="btn-hapus" onclick="return confirm('Anda yakin akan menghapus data ini?');">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

</body>
</html>