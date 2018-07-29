<?php

include_once('../app/core/init.php');

if (!isset($_GET['id'])) {
    redirect('/pelajaran/Buku');
}

include_once('../app/database/Database.php');
include_once('../app/models/Buku.php');
include_once('../app/models/Penerbit.php');
include_once('../app/models/Genre.php');

$buku = Buku::find($_GET['id']);
$penerbit = Penerbit::findAll();
$genre = Genre::findAll();

if (!$buku) {
    redirect('/pelajaran/buku');
}

include_once('../app/resources/menu.php');

$title = 'Ubah Buku - Perpustakaan';
$navMenu = getNavbarMenu($_SESSION['userJenis']);
$navSubMenu = getNavbarSubMenu($_SESSION['userJenis']);

include_once('../app/views/buku/ubah.php');