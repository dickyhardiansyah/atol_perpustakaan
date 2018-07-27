<?php

class Peminjaman {
    public static $TABLE_NAME = 'peminjaman';

    var $idPeminjaman;
    var $idAnggota;
    var $kodeBuku;
    var $tanggalPeminjaman;
    var $tanggalPengembalian;
    var $status;
    var $tanggalDikembalikan;

    public function __construct($id, $anggota, $buku, $peminjaman, $pengembalian, $status, $tanggalKembali) {
        $this->idPeminjaman = $id;
        $this->idAnggota = $anggota;
        $this->kodeBuku = $buku;
        $this->tanggalPeminjaman = $peminjaman;
        $this->tanggalPengembalian = $pengembalian;
        $this->status = $status;
        $this->tanggalDikembalikan = $tanggalKembali;
    }
}