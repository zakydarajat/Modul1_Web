<?php
namespace Classes;

class Gudang {
    private $namaGudang;
    private $daftarBarang = [];

    public function __construct($namaGudang) {
        $this->namaGudang = $namaGudang;
    }

    public function getNamaGudang() {
        return $this->namaGudang;
    }

    public function tambahBarang(Barang $barang) {
        $this->daftarBarang[] = $barang;
        echo "Barang '{$barang->infoBarang()}' berhasil ditambahkan ke {$this->namaGudang}.<br>";
    }

    public function lihatBarang() {
        foreach ($this->daftarBarang as $barang) {
            echo $barang->infoBarang() . "<br>";
        }
    }

    public function __destruct() {
        echo "Gudang {$this->namaGudang} selesai dikelola.<br>";
    }
}
