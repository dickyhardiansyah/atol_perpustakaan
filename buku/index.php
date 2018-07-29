<?php

include_once('../app/core/init.php');
include_once('../app/resources/menu.php');
include_once('../app/database/Database.php');
include_once('../app/models/Buku.php');

$title = 'Lihat Buku - Perpustakaan';
$navMenu = getNavbarMenu($_SESSION['userJenis']);
$navSubMenu = getNavbarSubMenu($_SESSION['userJenis']);
$buku = Buku::findAll();

include_once('../app/views/buku/index.php');