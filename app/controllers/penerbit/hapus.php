<?php

include_once('../../core/init.php');

if (!isset($_GET['id'])) {
    redirect(ROOT . 'penerbit');
}

include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../models/Penerbit.php');

Penerbit::delete($_GET['id']); 
echo json_encode([
    "status" => SUCCESS,
    "message" => 'Berhasil mengahapus penerbit dengan id ' . $_GET['id']
]);