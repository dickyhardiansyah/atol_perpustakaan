<?php

include_once('../../core/init.php');
include_once('../../database/Database.php');
include_once('../../models/Peminjaman.php');

$peminjaman = Peminjaman::byAnggota($_POST['idAnggota']);

echo json_encode($peminjaman);