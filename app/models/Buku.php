<?php

class Buku {
    public static $TABLE_NAME = 'buku';

    var $kodeBuku;
    var $judul;
    var $penulis;
    var $tahunTerbit;
    var $stok;
    var $kodePenerbit; 
    var $idGenre;
    var $penerbit;
    var $genre;

    public function __construct($kode, $judul, $penulis, $tahun, $stok, $penerbit, $genre) {
        $this->kodeBuku = $kode;
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->tahunTerbit = $tahun;
        $this->stok = $stok;
        $this->kodePenerbit = $penerbit;
        $this->idGenre = $genre;
    }

    public static function create($data) {
        $query = "INSERT INTO " . self::$TABLE_NAME . " VALUES (?, ?, ?, ?, ?, ?, ?)";
        $db = new Database();
        $db->prepareAndExecute(
            $query, 
            'ssssdsd', 
            $data['kode'],
            $data['judul'],
            $data['penulis'],
            $data['tahun'],
            $data['stok'],
            $data['kodePenerbit'],
            $data['idGenre']
        )->close();
    }

    public static function findAll() {
        $db = new Database();
        $db->execute('SELECT kode_buku, judul, penulis, tahun_terbit, stok, nama, genre, buku.kode_penerbit, buku.id_genre FROM ' . self::$TABLE_NAME . ' JOIN penerbit USING (kode_penerbit) JOIN genre USING (id_genre) ORDER BY judul ASC');

        $buku = [];
        while($row = $db->fetchAssoc()) {
            $fetchedBook = new Buku($row['kode_buku'], $row['judul'], $row['penulis'], $row['tahun_terbit'], $row['stok'], $row['kode_penerbit'], $row['id_genre']);
            $fetchedBook->penerbit = $row['nama'];
            $fetchedBook->genre = $row['genre'];      
            $buku[] = $fetchedBook;      
        }

        $db->close();
        return $buku;
    }

    public static function find($kode) {
        $db = new Database();
        $results = $db->prepareAndExecute('SELECT kode_buku, judul, penulis, tahun_terbit, stok, nama, genre, buku.kode_penerbit, buku.id_genre FROM ' . self::$TABLE_NAME . ' JOIN penerbit USING (kode_penerbit) JOIN genre USING (id_genre) WHERE kode_buku=?', "s", $kode);

        $results->bind_result($kode, $judul, $penulis, $tahun, $stok, $penerbit, $genre, $kodePenerbit, $idGenre);
        while ($results->fetch()) {
            $fetchedBook = new Buku($kode, $judul, $penulis, $tahun, $stok, $kodePenerbit, $idGenre);
            $fetchedBook->penerbit = $penerbit;
            $fetchedBook->genre = $genre; 
            return $fetchedBook;
        }

        return null;
    }

    public static function update($data) {
        $query = "UPDATE  " . self::$TABLE_NAME . " SET kode_buku=?, judul=?, penulis=?, tahun_terbit=?, stok=?, kode_penerbit=?, id_genre=? WHERE kode_buku=?";
        $db = new Database();
        $db->prepareAndExecute($query, 'ssssdsds', $data['kode'], $data['judul'], $data['penulis'], $data['tahun'], $data['stok'], $data['kodePenerbit'], $data['idGenre'], $data['kodeLama'])
            ->close();
    }

    public static function delete($kode) {
        $db = new Database();
        $db->prepareAndExecute('DELETE FROM ' . self::$TABLE_NAME . ' WHERE kode_buku=?', 's', $kode)
            ->close();
    }

    public static function count($data) {
        $query = "SELECT COUNT(*) FROM " . self::$TABLE_NAME . " WHERE kode_penerbit=? AND id_genre=?";

        $db = new Database();
        $results = $db->prepareAndExecute($query, 'sd', $data['kodePenerbit'], $data['idGenre']);

        $results->bind_result($count);
        while ($results->fetch()) {
            return $count;
        }

        return null;
    }

    public static function byGenre($idGenre) {
        $query = "SELECT kode_buku, judul FROM " . self::$TABLE_NAME . " WHERE id_genre like ?";

        $db = new Database();
        $results = $db->prepareAndExecute($query, 's', '%' . $idGenre . '%');

        $results->bind_result($kode, $nama);
        $judul = [];
        while ($results->fetch()) {
            $judul[] = [
                "kode" => $kode,
                "judul" => $nama
            ];
        }

        return $judul;
    }

    public function save() {
        Buku::update([
            "kode" => $this->kodeBuku,
            "judul" => $this->judul,
            "penulis" => $this->penulis,
            "tahun" => $this->tahunTerbit,
            "stok" => $this->stok,
            "kodePenerbit" => $this->kodePenerbit,
            "idGenre" => $this->idGenre,
            "kodeLama" => $this->kodeBuku
        ]);
    }
}