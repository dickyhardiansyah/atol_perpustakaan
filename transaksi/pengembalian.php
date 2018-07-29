<?php

include_once('../app/core/init.php');
include_once('../app/database/Database.php');
include_once('../app/models/Anggota.php');
include_once('../app/resources/menu.php');

$title = 'Peminjaman - Perpustakaan';
$navMenu = getNavbarMenu($_SESSION['userJenis']);
$navSubMenu = getNavbarSubMenu($_SESSION['userJenis']);

$anggota = Anggota::findAll();

include_once('../app/views/transaksi/pengembalian.php');