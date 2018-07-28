<?php

class Penerbit {
    public static $TABLE_NAME = 'penerbit';

    var $kodePenerbit;
    var $nama;

    public function __construct($kode, $nama) {
        $this->kodePenerbit = $kode;
        $this->nama = $nama;
    }

    public static function create($data) {
        $query = "INSERT INTO " . self::$TABLE_NAME . " VALUES (?, ?)";
        $db = new Database();
        $db->prepareAndExecute($query, 'ss', $data['kode'], $data['nama'])
            ->close();
    }

    public static function findAll() {
        $db = new Database();
        $db->execute('SELECT * FROM ' . self::$TABLE_NAME);

        $Penerbit = [];
        while($row = $db->fetchAssoc()) {
            $Penerbit[] = new Penerbit($row['kode_penerbit'], $row['nama']);
        }

        $db->close();
        return $Penerbit;
    }

    public static function delete($id) {
        $db = new Database();
        $db->prepareAndExecute('DELETE FROM ' . self::$TABLE_NAME . ' WHERE kode_penerbit=?', 's', $id)
            ->close();
    }

    public static function find($id) {
        $db = new Database();
        $results = $db->prepareAndExecute('SELECT * FROM ' . self::$TABLE_NAME . ' WHERE kode_penerbit=?', 's', $id);

        $results->bind_result($id, $nama);
        while ($results->fetch()) {
            return new Penerbit($id, $nama);
        }

        return null;
    }

    public static function update($data) {
        $query = "UPDATE  " . self::$TABLE_NAME . " SET kode_penerbit=?, nama=? WHERE kode_penerbit=?";
        $db = new Database();
        $db->prepareAndExecute($query, 'sss', $data['kode'], $data['nama'], $data['kodeLama'])
            ->close();
    }
}