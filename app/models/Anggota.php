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

    public static function create($data) {
        $query = "INSERT INTO " . self::$TABLE_NAME . " VALUES (NULL, ?, ?, ?, ?, ?, ?)";
        $db = new Database();
        $db->prepareAndExecute($query, 'ssssss', $data['nama'], $data['jk'], $data['alamat'], $data['tanggalLahir'], $data['instansi'], date('Y/m/d'))
            ->close();
    }

    public static function findAll() {
        $db = new Database();
        $db->execute('SELECT * FROM ' . self::$TABLE_NAME . ' ORDER BY nama');

        $anggota = [];
        while($row = $db->fetchAssoc()) {
            $anggota[] = new Anggota($row['id_anggota'], $row['nama'], $row['jenis_kelamin'], $row['alamat'], $row['tanggal_lahir'], $row['instansi'], $row['tanggal_bergabung']);
        }

        $db->close();
        return $anggota;
    }

    public static function delete($id) {
        $db = new Database();
        $db->prepareAndExecute('DELETE FROM ' . self::$TABLE_NAME . ' WHERE id_anggota=?', 'd', $id)
            ->close();
    }

    public static function find($id) {
        $db = new Database();
        $results = $db->prepareAndExecute('SELECT * FROM ' . self::$TABLE_NAME . ' WHERE id_anggota=?', 'd', $id);

        $results->bind_result($id, $nama, $jk, $alamat, $ttl, $instansi, $bergabung);
        while ($results->fetch()) {
            return new Anggota($id, $nama, $jk, $alamat, $ttl, $instansi, $bergabung);
        }

        return null;
    }

    public static function update($data) {
        $query = "UPDATE  " . self::$TABLE_NAME . " SET nama=?, jenis_kelamin=?, alamat=?, tanggal_lahir=?, instansi=? WHERE id_anggota=?";
        $db = new Database();
        $db->prepareAndExecute($query, 'sssssd', $data['nama'], $data['jk'], $data['alamat'], $data['tanggalLahir'], $data['instansi'], $data['id'])
            ->close();
    }

    public static function filter($data) {
        $db = new Database();
        $results = $db->prepareAndExecute('SELECT * FROM ' 
                    . self::$TABLE_NAME . ' WHERE nama LIKE ? AND jenis_kelamin LIKE ? AND alamat LIKE ? AND tanggal_lahir LIKE ? AND instansi LIKE ? AND tanggal_bergabung LIKE ?' 
                    . ' ORDER BY ' . $data['orderby'], "ssssss",
                    '%' . $data['nama'] . '%',
                    '%' . $data['jenisKelamin'] . '%',
                    '%' . $data['alamat'] . '%',
                    '%' . $data['tanggalLahir'] . '%',
                    '%' . $data['instansi'] . '%',
                    '%' . $data['tanggalBergabung'] . '%'
                );

        $results->bind_result($id, $nama, $jk, $alamat, $ttl, $instansi, $bergabung);
        $anggota = [];
        while($results->fetch()) {
            $anggota[] = new Anggota($id, $nama, $jk, $alamat, $ttl, $instansi, $bergabung);
        }

        $db->close();
        return $anggota;
    }
}
