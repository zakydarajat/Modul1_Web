<?php
namespace Traits;

trait Diskon {
    private $diskon = 0;

    public function setDiskon($diskon) {
        $this->diskon = $diskon;
    }

    public function getDiskon() {
        return $this->diskon;
    }
}
