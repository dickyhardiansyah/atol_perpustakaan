<?php

include_once('../../core/init.php');

if (!isset($_GET['kode'])) {
    redirect('/perpustakaan/buku');
}

include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../models/Buku.php');

Buku::delete($_GET['kode']); 
echo json_encode([
    "status" => SUCCESS,
    "message" => 'Berhasil mengahapus buku dengan kode ' . $_GET['kode']
]);