<?php

include_once('../../core/init.php');
include_once('../../database/Database.php');
include_once('../../models/Buku.php');

$buku = Buku::byGenre($_POST['genre']);

echo json_encode($buku);