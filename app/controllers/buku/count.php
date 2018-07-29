<?php

include_once('../../core/init.php');
include_once('../../database/Database.php');
include_once('../../models/Buku.php');

$count = Buku::count([
    "kodePenerbit" => $_POST['kodePenerbit'],
    "idGenre" => $_POST['idGenre'],
]);

echo $count;