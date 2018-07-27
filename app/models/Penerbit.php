<?php

class Penerbit {
    public static $TABLE_NAME = 'penerbit';

    var $kodePenerbit;
    var $nama;

    public function __construct($kode, $nama) {
        $this->kodePenerbit = $kode;
        $this->nama = $nama;
    }
}