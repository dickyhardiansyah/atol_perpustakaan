<?php

include_once('../../core/init.php');

if (!isset($_GET['id'])) {
    redirect(ROOT . 'genre');
}

include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../models/Genre.php');

Genre::delete($_GET['id']); 
echo json_encode([
    "status" => SUCCESS,
    "message" => 'Berhasil mengahapus genre dengan id ' . $_GET['id']
]);