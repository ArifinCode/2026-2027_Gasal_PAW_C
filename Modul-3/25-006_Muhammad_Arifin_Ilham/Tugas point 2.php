<!-- Tugas Point 2 -->
<?php
// Soal Utama: Panjang array dan akses array terindeks dengan perulangan
$fruits = array("Avocado", "Blueberry", "Cherry");
$arrlength = count($fruits);

// 2.1. Menambahkan 5 data baru ke dalam array $fruits dengan perulangan
for ($i = 1; $i <= 5; $i++) {
    array_push($fruits, "Buah Tambahan " . $i);
}


$arrlength = count($fruits);

echo "Panjang array saat ini: " . $arrlength . "<br><br>";

for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x] . "<br>";
}

echo "<hr>";

// 2.2. Membuat array baru bernama $vegies dan menampilkan dengan for
$vegies = array("Carrot", "Broccoli", "Spinach");
$veglength = count($vegies);

for ($y = 0; $y < $veglength; $y++) {
    echo $vegies[$y] . "<br>";
}
?>