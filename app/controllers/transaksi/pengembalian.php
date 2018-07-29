<?php

include_once('../../core/init.php');

if (!isset($_POST['kembali'])) {
    redirect(ROOT);
}

include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../models/Peminjaman.php');
include_once('../../models/Buku.php');

$id = $_POST['id_peminjaman'];
$kodeBuku = $_POST['kode_buku'];

$petugas = Peminjaman::update([
    "id" => $id,
    "status" => "Dikembalikan",
    "dikembalikan" => date('Y/m/d')
]);

$buku = Buku::find($kodeBuku);
$buku->stok += 1;
$buku->save();

echo json_encode([
    "status" => SUCCESS,
    "message" => 'Berhasil melakukan pengembalian'
]);