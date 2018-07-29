<?php

include_once('../../core/init.php');
include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../database/QueryBuilder.php');
include_once('../../models/Peminjaman.php');

$peminjaman = Peminjaman::filter([
    "orderby" => $_POST['orderby'],
    "id" => $_POST['id'],
    "peminjam" => $_POST['nama'],
    "status" => $_POST['status'],
    "buku" => $_POST['buku'],
    "tanggalPeminjaman" => $_POST['tanggalPeminjaman'],
    "tanggalPengembalian" => $_POST['tanggalPengembalian'],
    "tanggalDikembalikan" => $_POST['tanggalDikembalikan']
]);

echo json_encode($peminjaman);