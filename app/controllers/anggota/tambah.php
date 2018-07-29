<?php

include_once('../../core/init.php');

if (!isset($_POST['tambah'])) {
    redirect(ROOT);
}

include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../models/Anggota.php');

$nama = $_POST['nama'];
$jk = $_POST['jk'];
$alamat = $_POST['alamat'];
$tanggalLahir = $_POST['tanggalLahir'];
$instansi = $_POST['instansi'];

if (empty($nama) || empty($jk) || empty($alamat) || empty($tanggalLahir) || empty($instansi)) {
    echo json_encode([
        "status" => BAD_REQUEST,
        "message" => 'Pastikan tidak ada field yang kosong.'
    ]);
} else {
    Anggota::create([
        "nama" => $nama,
        "jk" => $jk,
        "alamat" => $alamat,
        "tanggalLahir" => $tanggalLahir,
        "instansi" => $instansi
    ]);

    echo json_encode([
        "status" => SUCCESS,
        "message" => 'Berhasil menambahkan Anggota baru'
    ]);
}