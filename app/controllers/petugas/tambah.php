<?php

include_once('../../core/init.php');

if (!isset($_POST['daftar'])) {
    redirect(ROOT);
}

include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../database/QueryBuilder.php');
include_once('../../models/Petugas.php');

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$jenis = $_POST['jenis'];

if (empty($username) || empty($password) || empty($nama)) {
    echo json_encode([
        "status" => BAD_REQUEST,
        "message" => 'Pastikan tidak ada field yang kosong.'
    ]);
} else {
    $petugas = Petugas::create([
        "nama" => $nama,
        "username" => $username,
        "password" => password_hash($password, PASSWORD_DEFAULT),
        "jenis" => $jenis
    ]);

    echo json_encode([
        "status" => SUCCESS,
        "message" => 'Berhasil menambahkan petugas baru'
    ]);
}