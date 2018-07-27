<?php

include_once('../../core/init.php');

if (!isset($_POST['ubah'])) {
    redirect('/perpustakaan');
}

include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../models/Genre.php');

$id = $_POST['id'];
$nama = $_POST['nama'];

if (empty($nama)) {
    echo json_encode([
        "status" => BAD_REQUEST,
        "message" => 'Pastikan tidak ada field yang kosong.'
    ]);
} else {
    Genre::update([
        "id" => $id,
        "nama" => $nama
    ]);

    echo json_encode([
        "status" => SUCCESS,
        "message" => 'Berhasil memperbarui genre'
    ]);
}