<?php
require_once 'classes/Barang.php';
require_once 'classes/Elektronik.php';
require_once 'classes/Pakaian.php';
require_once 'classes/Gudang.php';
require_once 'traits/Diskon.php';

use Classes\Elektronik;
use Classes\Pakaian;
use Classes\Gudang;

// Inisialisasi gudang
$gudang = new Gudang("Gudang Pusat");

// Membuat objek barang elektronik
$tv = new Elektronik("TV LED", 3000000, "Samsung");
$tv->setDiskon(10); // Diskon 10%

$kulkas = new Elektronik("Kulkas", 4000000, "LG");
$kulkas->setDiskon(15); // Diskon 15%

// Membuat objek barang pakaian
$kaos = new Pakaian("Kaos Polos", 50000, "L");
$kaos->setDiskon(5); // Diskon 5%

$jaket = new Pakaian("Jaket Jeans", 200000, "M");
$jaket->setDiskon(20); // Diskon 20%

// Menambahkan barang ke dalam gudang
$gudang->tambahBarang($tv);
$gudang->tambahBarang($kulkas);
$gudang->tambahBarang($kaos);
$gudang->tambahBarang($jaket);

// Melihat daftar barang di gudang
echo "<h3>Daftar Barang di {$gudang->getNamaGudang()}:</h3>";
$gudang->lihatBarang();
?>
