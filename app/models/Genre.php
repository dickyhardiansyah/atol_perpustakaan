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
}