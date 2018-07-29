<?php

include_once('../../core/init.php');

if (!isset($_POST['ubah'])) {
    redirect(ROOT);
}

include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../models/Penerbit.php');

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$kodeLama = $_POST['kodeLama'];

if (empty($nama)) {
    echo json_encode([
        "status" => BAD_REQUEST,
        "message" => 'Pastikan tidak ada field yang kosong.'
    ]);
} else {
    Penerbit::update([
        "kode" => $kode,
        "nama" => $nama,
        "kodeLama" => $kodeLama
    ]);

    echo json_encode([
        "status" => SUCCESS,
        "message" => 'Berhasil memperbarui penerbit'
    ]);
}