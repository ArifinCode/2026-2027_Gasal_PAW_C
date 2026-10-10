<!-- Tugas Point 2 -->
<?php
// Soal Utama: Panjang array dan akses array terindeks dengan perulangan
$fruits = array("Avocado", "Blueberry", "Cherry");
$arrlength = count($fruits);

// 2.1. Menambahkan 5 data baru ke dalam array $fruits dengan perulangan
for ($i = 1; $i <= 5; $i++) {
    array_push($fruits, "Buah Tambahan " . $i);
}

// Update panjang array setelah ditambah data baru
$arrlength = count($fruits);

echo "Panjang array saat ini: " . $arrlength . "<br><br>";

// Menampilkan seluruh data dengan perulangan for
// Skrip pada baris #5-#8 perlu diubah karena variabel $arrlength lama 
// hanya bernilai 3, sehingga jika tidak diperbarui, perulangan for tidak 
// akan mencakup 5 data baru yang ditambahkan di bawahnya.
for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x] . "<br>";
}

echo "<hr>";

// 2.2. Membuat array baru bernama $vegies dan menampilkan dengan for
$vegies = array("Carrot", "Broccoli", "Spinach");
$veglength = count($vegies);

// Penjelasan 2.2: 
// Kita membuat skrip baru karena variabel dan struktur datanya berbeda 
// (menggunakan array $vegies, bukan $fruits), sehingga butuh deklarasi 
// dan variabel panjang array baru agar perulangan for bisa berjalan pas.
for ($y = 0; $y < $veglength; $y++) {
    echo $vegies[$y] . "<br>";
}
?>