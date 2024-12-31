<?php
namespace Classes;

require_once 'traits/Diskon.php';

use Traits\Diskon;

class Pakaian extends Barang {
    use Diskon;

    private $ukuran;

    public function __construct($nama, $harga, $ukuran) {
        parent::__construct($nama, $harga);
        $this->ukuran = $ukuran;
    }

    public function infoBarang() {
        $hargaDiskon = $this->harga - ($this->harga * $this->diskon / 100);
        return "Pakaian: {$this->nama}, Ukuran: {$this->ukuran}, Harga: {$hargaDiskon} (Diskon: {$this->diskon}%)";
    }
}
