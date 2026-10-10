<!-- Tugas Point 3 -->
<?php
// Soal Utama: Mendeklarasikan dan mengakses array asosiatif
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");

// 3.1. Menambahkan lima data baru ke dalam array $height
$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

// Menampilkan format array height
echo "height = (";
$keys = array_keys($height);
$last_key = end($keys);
foreach ($height as $name => $value) {
    echo "\"$name\"=>\"$value\"";
    if ($name !== $last_key) {
        echo ", ";
    }
}
echo ")<br>";

// Menampilkan nilai dengan indeks terakhir
$last_value = end($height);
echo "Nilai dengan indeks terakhir: " . $last_value . "<br><br>";

// 3.1. (Bagian 2) Hapus satu data tertentu (misal menghapus "Barry")
unset($height["Barry"]);

// Menampilkan array height setelah penghapusan
echo "height = (";
$keys = array_keys($height);
$last_key = end($keys);
foreach ($height as $name => $value) {
    echo "\"$name\"=>\"$value\"";
    if ($name !== $last_key) {
        echo ", ";
    }
}
echo ")<br>";

// Menampilkan nilai dengan indeks terakhir setelah dihapus
$last_value_after = end($height);
echo "Nilai dengan indeks terakhir setelah dihapus: " . $last_value_after;

echo "<hr>";

// 3.2. Membuat array baru bernama $weight dengan tiga data
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

// Menampilkan format array weight
echo "weight = (";
$keys_w = array_keys($weight);
$last_key_w = end($keys_w);
foreach ($weight as $name => $value) {
    echo "\"$name\"=>\"$value\"";
    if ($name !== $last_key_w) {
        echo ", ";
    }
}
echo ")<br>";

// Menampilkan data kedua dari array $weight
// Mengambil nilai berdasarkan posisi indeks array (indeks ke-1 atau elemen kedua)
$values_w = array_values($weight);
echo "Data kedua: " . $values_w[1];
?>