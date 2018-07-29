<?php

include_once('../../core/init.php');

if (!isset($_GET['id'])) {
    redirect(ROOT . 'petugas');
}

include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../models/Petugas.php');

Petugas::delete($_GET['id']); 
echo json_encode([
    "status" => SUCCESS,
    "message" => 'Berhasil mengahapus petugas dengan id ' . $_GET['id']
]);