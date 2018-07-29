<?php

include_once('../../core/init.php');

if (!isset($_POST['tambah'])) {
    redirect('/perpustakaan');
}

include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../models/Buku.php');

$kode = $_POST['kode'];
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$tahun = $_POST['tahun'];
$stok = $_POST['stok'];
$kodePenerbit = $_POST['kodePenerbit'];
$idGenre = $_POST['idGenre'];

if (empty($kode) || empty($judul) || empty($penulis) || empty($tahun) || empty($stok)) {
    echo json_encode([
        "status" => BAD_REQUEST,
        "message" => 'Pastikan tidak ada field yang kosong.'
    ]);
} else {
    Buku::create([
        "kode" => $kode,
        "judul" => $judul,
        "penulis" => $penulis,
        "tahun" => $tahun,
        "stok" => $stok,
        "kodePenerbit" => $kodePenerbit,
        "idGenre" => $idGenre
    ]);

    echo json_encode([
        "status" => SUCCESS,
        "message" => 'Berhasil menambahkan buku baru'
    ]);
}