<?php

include_once('../../core/init.php');

if (!isset($_POST['daftar'])) {
    redirect(ROOT);
}

include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../models/Peminjaman.php');
include_once('../../models/Buku.php');

$idAnggota = $_POST['idAnggota'];
$kodeBuku = $_POST['kodeBuku'];
$lama = $_POST['lama'];

if (empty($idAnggota) || empty($kodeBuku) || empty($lama)) {
    echo json_encode([
        "status" => BAD_REQUEST,
        "message" => 'Pastikan tidak ada field yang kosong.'
    ]);
} else {
    $petugas = Peminjaman::create([
        "idAnggota" => $idAnggota,
        "kodeBuku" => $kodeBuku,
        "lama" => $lama
    ]);

    $buku = Buku::find($kodeBuku);
    $buku->stok -= 1;
    $buku->save();

    echo json_encode([
        "status" => SUCCESS,
        "message" => 'Berhasil melakukan peminjaman'
    ]);
}