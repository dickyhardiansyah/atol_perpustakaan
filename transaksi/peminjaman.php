<?php

include_once('../app/core/init.php');
include_once('../app/database/Database.php');
include_once('../app/models/Buku.php');
include_once('../app/models/Anggota.php');
include_once('../app/models/Genre.php');
include_once('../app/resources/menu.php');

$title = 'Peminjaman - Perpustakaan';
$navMenu = getNavbarMenu($_SESSION['userJenis']);
$navSubMenu = getNavbarSubMenu($_SESSION['userJenis']);

$buku = Buku::findAll();
$genre = Genre::findAll();
$anggota = Anggota::findAll();

include_once('../app/views/transaksi/peminjaman.php');