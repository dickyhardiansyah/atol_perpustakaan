<?php

include_once('../../core/init.php');
include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../database/QueryBuilder.php');
include_once('../../models/Anggota.php');

$anggota = Anggota::filter([
    "orderby" => $_POST['orderby'],
    "nama" => $_POST['nama'],
    "jenisKelamin" => $_POST['jenisKelamin'],
    "alamat" => $_POST['alamat'],
    "tanggalLahir" => $_POST['tanggalLahir'],
    "instansi" => $_POST['instansi'],
    "tanggalBergabung" => $_POST['tanggalBergabung']
]);

echo json_encode($anggota);