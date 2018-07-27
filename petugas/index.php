<?php

include_once('../app/core/init.php');
include_once('../app/resources/menu.php');
include_once('../app/database/Database.php');
include_once('../app/models/Petugas.php');

$title = 'Lihat Petugas - Perpustakaan';
$navMenu = getNavbarMenu($_SESSION['userJenis']);
$navSubMenu = getNavbarSubMenu($_SESSION['userJenis']);
$petugas = Petugas::findAll();

include_once('../app/views/petugas/index.php');