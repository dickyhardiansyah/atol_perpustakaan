<?php

class Genre {
    public static $TABLE_NAME = 'genre';

    var $idGenre;
    var $genre;

    public function __construct($id, $genre) {
        $this->idGenre = $id;
        $this->genre = $genre;
    }

    public static function create($nama) {
        $query = "INSERT INTO " . self::$TABLE_NAME . " VALUES (NULL, ?)";
        $db = new Database();
        $db->prepareAndExecute($query, 's', $nama)
            ->close();
    }

    public static function findAll() {
        $db = new Database();
        $db->execute('SELECT * FROM ' . self::$TABLE_NAME);

        $genre = [];
        while($row = $db->fetchAssoc()) {
            $genre[] = new Genre($row['id_genre'], $row['genre']);
        }

        $db->close();
        return $genre;
    }

    public static function delete($id) {
        $db = new Database();
        $db->prepareAndExecute('DELETE FROM ' . self::$TABLE_NAME . ' WHERE id_genre=?', 'd', $id)
            ->close();
    }

    public static function find($id) {
        $db = new Database();
        $results = $db->prepareAndExecute('SELECT * FROM ' . self::$TABLE_NAME . ' WHERE id_genre=?', 'd', $id);

        $results->bind_result($id, $nama);
        while ($results->fetch()) {
            return new Genre($id, $nama);
        }

        return null;
    }

    public static function update($data) {
        $query = "UPDATE  " . self::$TABLE_NAME . " SET genre=? WHERE id_genre=?";
        $db = new Database();
        $db->prepareAndExecute($query, 'sd', $data['nama'], $data['id'])
            ->close();
    }
}