<?php

include_once('../../core/init.php');

if (!isset($_POST['ubah'])) {
    redirect('/perpustakaan');
}

include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../models/Anggota.php');

$id = $_POST['id'];
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
    Anggota::update([
        "id" => $id,
        "nama" => $nama,
        "jk" => $jk,
        "alamat" => $alamat,
        "tanggalLahir" => $tanggalLahir,
        "instansi" => $instansi
    ]);

    echo json_encode([
        "status" => SUCCESS,
        "message" => 'Berhasil memperbarui anggota'
    ]);
}