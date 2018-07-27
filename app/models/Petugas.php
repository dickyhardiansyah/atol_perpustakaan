<?php

class Petugas {
    public static $TABLE_NAME = 'petugas';

    var $idPetugas;
    var $nama;
    var $jenis;
    var $username;
    var $password;

    public function __construct($id, $nama, $jenis, $username, $password) {
        $this->idPetugas = $id;
        $this->nama = $nama;
        $this->jenis = $jenis;
        $this->username = $username;
        $this->password = $password;
    }

    public static function get($query, $value) {
        $database = new Database();
        
        $results = $database->prepareAndExecute($query, 's', $value);
        $results->bind_result($id, $nama, $jenis, $username, $password);

        $petugas = [];
        while ($results->fetch()) {
            $petugas[] = new Petugas($id, $nama, $jenis, $username, $password);
        }

        $database->close();

        return $petugas;
    }

    public static function where($selector, $comparator, $value) {
        return new QueryBuilder("SELECT * FROM " . self::$TABLE_NAME . " WHERE $selector $comparator ?", __CLASS__, $value);
    }

    public static function create($data) {
        $query = "INSERT INTO " . self::$TABLE_NAME . " VALUES (NULL, ?, ?, ?, ?)";
        $db = new Database();
        $db->prepareAndExecute($query, 'ssss', $data['nama'], $data['jenis'], $data['username'], $data['password'])
            ->close();
    }

    public static function findAll() {
        $db = new Database();
        $db->execute('SELECT * FROM ' . self::$TABLE_NAME);

        $petugas = [];
        while($row = $db->fetchAssoc()) {
            $petugas[] = new Petugas($row['id_petugas'], $row['nama'], $row['jenis'], $row['username'], $row['password']);
        }

        $db->close();
        return $petugas;
    }

    public static function delete($id) {
        $db = new Database();
        $db->prepareAndExecute('DELETE FROM ' . self::$TABLE_NAME . ' WHERE id_petugas=?', 'd', $id)
            ->close();
    }

    public static function find($id) {
        $db = new Database();
        $results = $db->prepareAndExecute('SELECT * FROM ' . self::$TABLE_NAME . ' WHERE id_petugas=?', 'd', $id);

        $results->bind_result($id, $nama, $jenis, $username, $password);
        while ($results->fetch()) {
            return new Petugas($id, $nama, $jenis, $username, $password);
        }

        return null;
    }

    public static function update($data) {
        $query = "UPDATE  " . self::$TABLE_NAME . " SET nama=?, jenis=?, username=?, password=? WHERE id_petugas=?";
        $db = new Database();
        $db->prepareAndExecute($query, 'ssssd', $data['nama'], $data['jenis'], $data['username'], $data['password'], $data['id'])
            ->close();
    }
}