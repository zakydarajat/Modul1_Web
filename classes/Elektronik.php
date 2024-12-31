<?php
namespace Classes;

require_once 'traits/Diskon.php';

use Traits\Diskon;

class Elektronik extends Barang {
    use Diskon;

    private $merek;

    public function __construct($nama, $harga, $merek) {
        parent::__construct($nama, $harga);
        $this->merek = $merek;
    }

    public function infoBarang() {
        $hargaDiskon = $this->harga - ($this->harga * $this->diskon / 100);
        return "Elektronik: {$this->nama}, Merek: {$this->merek}, Harga: {$hargaDiskon} (Diskon: {$this->diskon}%)";
    }
}
