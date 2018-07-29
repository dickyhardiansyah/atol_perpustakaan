<?php

include_once('../../core/init.php');
include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../database/QueryBuilder.php');
include_once('../../models/Petugas.php');

$petugas = Petugas::filter([
    "orderby" => $_POST['orderby'],
    "nama" => $_POST['nama'],
    "jenis" => $_POST['jenis'],
    "username" => $_POST['username']
]);

echo json_encode($petugas);