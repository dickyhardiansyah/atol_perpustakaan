<?php

include_once('../app/core/init.php');
include_once('../app/resources/menu.php');
include_once('../app/database/Database.php');
include_once('../app/models/Peminjaman.php');

$title = 'Lihat Peminjaman - Perpustakaan';
$navMenu = getNavbarMenu($_SESSION['userJenis']);
$navSubMenu = getNavbarSubMenu($_SESSION['userJenis']);
$peminjaman = Peminjaman::findAll();

include_once('../app/views/transaksi/index.php');

