<?php

include_once('../../core/init.php');
include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../database/QueryBuilder.php');
include_once('../../models/Buku.php');

$buku = Buku::filter([
    "orderby" => $_POST['orderby'],
    "kode" => $_POST['kode'],
    "judul" => $_POST['judul'],
    "penulis" => $_POST['penulis'],
    "tahun" => $_POST['tahun'],
    "stok" => $_POST['stok'],
    "penulis" => $_POST['penulis'],
    "genre" => $_POST['genre'],
    "penerbit" => $_POST['penerbit']
]);

echo json_encode($buku);