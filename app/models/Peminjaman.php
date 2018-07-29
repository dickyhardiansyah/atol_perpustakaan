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
    var $peminjam;
    var $buku;

    public function __construct($id, $anggota, $buku, $peminjaman, $pengembalian, $status, $tanggalKembali) {
        $this->idPeminjaman = $id;
        $this->idAnggota = $anggota;
        $this->kodeBuku = $buku;
        $this->tanggalPeminjaman = $peminjaman;
        $this->tanggalPengembalian = $pengembalian;
        $this->status = $status;
        $this->tanggalDikembalikan = $tanggalKembali;
    }

    public static function create($data) {
        $query = "INSERT INTO " . self::$TABLE_NAME . " VALUES (NULL, ?, ?, ?, ?, 'Dipinjam', NULL)";
        $db = new Database();

        $tanggalPeminjaman = date_create();
        $tanggalPengembalian = date_add($tanggalPeminjaman, date_interval_create_from_date_string($data['lama'] . ' days'));

        $db->prepareAndExecute(
            $query, 
            'dsss', 
            $data['idAnggota'], 
            $data['kodeBuku'], 
            date_format(date_create(), 'Y/m/d'), 
            date_format($tanggalPengembalian, 'Y/m/d')
        )->close();
    } 

    public static function findAll() {
        $db = new Database();
        $db->execute('SELECT * FROM ' . self::$TABLE_NAME . ' JOIN anggota USING(id_anggota) JOIN buku USING(kode_buku) ORDER BY status');

        $peminjaman = [];
        while($row = $db->fetchAssoc()) {
            $fetchedItem = new Peminjaman(
                $row['id_peminjaman'],
                $row['id_anggota'],
                $row['kode_buku'],
                $row['tanggal_peminjaman'],
                $row['tanggal_pengembalian'],
                $row['status'],
                $row['tanggal_dikembalikan']
            );
            $fetchedItem->peminjam = $row['nama'];
            $fetchedItem->buku = $row['judul'];
            $peminjaman[] = $fetchedItem;
        }

        $db->close();
        return $peminjaman;
    }

    public static function byAnggota($idAnggota) {
        $db = new Database();
        $results = $db->prepareAndExecute('SELECT id_peminjaman, judul, tanggal_pengembalian, kode_buku FROM ' . self::$TABLE_NAME . ' JOIN buku USING(kode_buku) WHERE id_anggota=? AND status="Dipinjam"', 'd', $idAnggota);

        $results->bind_result($id, $judul, $tanggalPengembalian, $kode);
        $peminjaman = [];
        while ($results->fetch()) {
            $peminjaman[] = [
                "id" => $id, 
                "judul" => $judul, 
                "deadline" => $tanggalPengembalian,
                "kode" => $kode
            ];
        }

        return $peminjaman;
    }

    public static function update($data) {
        $query = "UPDATE  " . self::$TABLE_NAME . " SET status=?, tanggal_dikembalikan=? WHERE id_peminjaman=?";
        $db = new Database();
        $db->prepareAndExecute($query, 'ssd', $data['status'], $data['dikembalikan'], $data['id'])
            ->close();
    }
}