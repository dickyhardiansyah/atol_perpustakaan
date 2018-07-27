<?php

class Anggota {
    public static $TABLE_NAME = 'anggota';

    var $idAnggota;
    var $nama;
    var $jenisKelamin;
    var $alamat;
    var $tanggalLahir;
    var $instansi;
    var $tanggalBergabung;

    public function __construct($id, $nama, $jk, $alamat, $tanggalLahir, $instansi, $tanggalBergabung) {
        $this->idAnggota = $id;
        $this->nama = $nama;
        $this->jenisKelamin = $jk;
        $this->alamat = $alamat;
        $this->tanggalLahir = $tanggalLahir;
        $this->instansi = $instansi;
        $this->tanggalBergabung = $tanggalBergabung;
    }
}
