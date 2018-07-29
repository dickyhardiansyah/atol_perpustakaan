<?php

include_once('../../core/init.php');

if (!isset($_GET['id'])) {
    redirect('/perpustakaan/anggota');
}

include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../models/Anggota.php');

Anggota::delete($_GET['id']); 
echo json_encode([
    "status" => SUCCESS,
    "message" => 'Berhasil mengahapus anggota dengan id ' . $_GET['id']
]);