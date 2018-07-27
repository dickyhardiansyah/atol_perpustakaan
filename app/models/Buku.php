<?php

class Buku {
    public static $TABLE_NAME = 'buku';

    var $kodeBuku;
    var $judul;
    var $penulis;
    var $tahunTerbit;
    var $coverBuku;
    var $stok;
    var $kodePenerbit; 
    var $idGenre;

    public function __construct($kode, $judul, $penulis, $tahun, $cover, $stok, $penerbit, $genre) {
        $this->kodeBuku = $kode;
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->tahunTerbit = $tahun;
        $this->coverBuku = $cover;
        $this->stok = $stok;
        $this->kodePenerbit = $penerbit;
        $this->idGenre = $genre;
    }
}