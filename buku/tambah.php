<?php

include_once('../app/core/init.php');
include_once('../app/database/Database.php');

include_once('../app/models/Penerbit.php');
include_once('../app/models/Genre.php');

$genre = Genre::findAll();
$penerbit = Penerbit::findAll();

include_once('../app/resources/menu.php');

$title = 'Tambah Buku - Perpustakaan';
$navMenu = getNavbarMenu($_SESSION['userJenis']);
$navSubMenu = getNavbarSubMenu($_SESSION['userJenis']);

include_once('../app/views/buku/tambah.php');