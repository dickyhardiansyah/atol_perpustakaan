<?php

include_once('../../core/init.php');

if (!isset($_POST['tambah'])) {
    redirect(ROOT);
}

include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../models/Genre.php');

$nama = $_POST['nama'];

if (empty($nama)) {
    echo json_encode([
        "status" => BAD_REQUEST,
        "message" => 'Pastikan tidak ada field yang kosong.'
    ]);
} else {
    Genre::create($nama);

    echo json_encode([
        "status" => SUCCESS,
        "message" => 'Berhasil menambahkan genre baru'
    ]);
}